<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LineItemController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\TransactionController;
use App\Models\Inventory; // Assuming these are used elsewhere or for dashboard
use App\Models\Pharmacy as PharmacyModel; // Alias if Pharmacy controller is also Pharmacy
use App\Models\Prescription;
use App\Models\Product;
use App\Models\Profile as ProfileModel; // Alias
use App\Models\Quotation;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ... (your existing welcome and dashboard routes) ...
Route::get('/', function () {
    $topPharmacies = PharmacyModel::orderBy('name', 'desc')->take(5)->get();
    $trendingProducts = Product::orderBy('brand_name', 'desc')->take(10)->get();
    return view('welcome', compact('topPharmacies', 'trendingProducts'));
})->name('home');

Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) {
        // Should be caught by 'auth' middleware, but as a failsafe
        return redirect()->route('login')->with('error', 'Authentication required.');
    }

    $userProfile = $user->profile;

    if (!$userProfile) {
        Auth::logout();
        return redirect()->route('login')->with('error', 'Your profile is not set up. Please contact support.');
    }

    $assignedPharmacy = null; // To store the fetched pharmacy model for relevant roles

    // Pre-checks for roles requiring a valid pharmacy_id
    if ($userProfile->role === 'Pharmacist' || $userProfile->role === 'Manager') {
        if (!$userProfile->pharmacy_id) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your profile is not assigned to a pharmacy. Please contact support.');
        }
        $assignedPharmacy = PharmacyModel::find($userProfile->pharmacy_id);
        if (!$assignedPharmacy) {
            // Data integrity issue: profile references a non-existent pharmacy
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your assigned pharmacy could not be found. Please contact support.');
        }
    }

    // Initialize Query Builders
    $prescriptionQuery = Prescription::query();
    $quotationQuery = Quotation::query();
    $transQuery = Transaction::query();
    $inventoryQuery = Inventory::query();
    $pharmacyQuery = PharmacyModel::query();
    $productQuery = Product::query();
    $profileQuery = ProfileModel::query();
    $userQuery = User::query();

    // Apply role-based filters
    if ($userProfile->role === 'User') {
        $prescriptionQuery->where('profile_id', $userProfile->id);
        $quotationQuery->where('profile_id', $userProfile->id);
        $transQuery->where('profile_id', $userProfile->id);
    }

    if ($userProfile->role === 'Pharmacist') {
        // $userProfile->pharmacy_id and $assignedPharmacy are guaranteed to be valid here
        $inventoryQuery->where('pharmacy_id', $userProfile->pharmacy_id);
        $pharmacyQuery->where('id', $userProfile->pharmacy_id); // For $totalPharmacies, it will be 1
        $productQuery->whereHas('inventories', fn($q) => $q->where('pharmacy_id', $userProfile->pharmacy_id));
    }

    if ($userProfile->role === 'Manager') {
        // $userProfile->pharmacy_id and $assignedPharmacy are guaranteed to be valid here
        // $pharmacyQuery->where('id', $userProfile->pharmacy_id); // For $totalPharmacies, it will be 1
        $productQuery->whereHas('inventories', fn($q) => $q->where('pharmacy_id', $userProfile->pharmacy_id));
        $profileQuery->where('pharmacy_id', $userProfile->pharmacy_id);
        $quotationQuery->where('pharmacy_id', $userProfile->pharmacy_id);
        $transQuery->where('pharmacy_id', $userProfile->pharmacy_id);
        $inventoryQuery->where('pharmacy_id', $userProfile->pharmacy_id);

    }
    // Note: Admins see all data, so no additional filters on queries like $pharmacyQuery, $productQuery etc. by default.

    // Calculate totals
    $totalPrescriptions = $prescriptionQuery->count();
    $totalQuotations = $quotationQuery->count();
    $totalTransactions = $transQuery->count();
    $totalInventories = $inventoryQuery->count();
    $totalPharmacies = $pharmacyQuery->count(); // For Admin, all pharmacies. For Pharmacist/Manager, 1 (their own).
    $totalProducts = $productQuery->count();
    $totalProfiles = $profileQuery->count();
    $totalUsers = $userQuery->count();

    switch ($userProfile->role) {
        case 'Admin':
            return view('dashboard.adminDashboard', compact('totalPharmacies', 'totalProducts', 'totalProfiles', 'totalUsers'));
        case 'Pharmacist':
             return view('dashboard.pharmacistDashboard', compact('totalPrescriptions', 'totalQuotations','totalTransactions', 'totalInventories', 'totalProducts', 'assignedPharmacy','totalProfiles'));
        case 'Manager':
            return view('dashboard.managerDashboard', compact('totalPrescriptions', 'totalQuotations','totalTransactions', 'totalInventories', 'totalProducts', 'assignedPharmacy','totalProfiles'));
        case 'User':
            return view('dashboard.patientDashboard', compact('totalPrescriptions', 'totalQuotations', 'totalTransactions'));
        default:
             Auth::logout();
             return redirect()->route('login')->with('error', 'Invalid role. Access denied.');
    }
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resources([
        'profiles' => ProfileController::class,
        'products' => ProductController::class,
        'pharmacies' => PharmacyController::class,
        'inventories' => InventoryController::class,
        'prescriptions' => PrescriptionController::class,
        'transactions' => TransactionController::class,
        'quotations' => QuotationController::class,
        'lineitems' => LineItemController::class,
    ]);

    // New routes for assigning roles
    Route::get('/pharmacies/{pharmacy}/assign-manager', [ProfileController::class, 'showAssignManagerForm'])->name('profiles.showAssignManagerForm');
    Route::get('/profiles/assign-pharmacist', [ProfileController::class, 'showAssignPharmacistForm'])->name('profiles.showAssignPharmacistForm');
    // An admin might also want to assign a pharmacist to a specific pharmacy they select
    Route::get('/admin/pharmacies/{pharmacy}/assign-pharmacist', [ProfileController::class, 'showAssignPharmacistForm'])->name('admin.profiles.showAssignPharmacistForm');


    Route::post('/profiles/process-assignment', [ProfileController::class, 'processRoleAssignment'])->name('profiles.processRoleAssignment');

    // Remove old assign route if it was: Route::get('/profiles/assign/{pharmacy_id}', [ProfileController::class, 'assign'])->name('profiles.assign');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Guest Routes (Unchanged from your provided snippet)
Route::middleware('guest')->group(function () {
    Route::view('/auth/register', 'auth.register')->name('register');
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::view('/auth/login', 'auth.login')->name('login');
    Route::post('auth/login', [AuthController::class, 'login']);
});