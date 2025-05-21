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
use App\Models\Inventory;
use App\Models\Pharmacy;
use App\Models\Prescription;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Quotation;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Fetch top pharmacies (e.g., based on ratings or some criteria)
    $topPharmacies = Pharmacy::orderBy('name', 'desc')->get();
    // Fetch trending products (e.g., based on sales or popularity)
    $trendingProducts = Product::orderBy('brand_name', 'desc')->get();

    return view('welcome', compact('topPharmacies', 'trendingProducts'));
})->name('home');

// Dashboard Route Based on Role
Route::get('/dashboard', function () {
    $user = Auth::user()->profile; // Get the authenticated user

    // dd($user->profile);
    // Check if the user has a profile
    if (!$user) {
        abort(403, 'Unauthorized: Please consult your the administrator.');
    }

    $Prescriptionquery = Prescription::query();
    $quotationQuery = Quotation::query();
    $transQuery = Transaction::query();
    $inventoryquery = Inventory::query();
    $pharmacyQuery = Pharmacy::query();
    $productQuery = Product::query();
    $profileQuery = Profile::query();
    $userQuery = User::query();

    if ($user->role === 'User') {
        $Prescriptionquery->where('profile_id', $user->id);
        $quotationQuery->where('profile_id', $user->id);
        $transQuery->where('profile_id', $user->id);
    }
    if ($user->role === 'Pharmacist') {
        $inventoryquery->where('pharmacy_id', $user->pharmacy_id);
        $pharmacyQuery->where('id', $user->pharmacy_id);
        $productQuery->where('pharmacy_id', $user->pharmacy_id);
    }
    if ($user->role === 'Admin') {
        $profileQuery->where('role', 'Manager');
    }
    if ($user->role === 'Manager') {
        $pharmacyQuery->where('id', $user->pharmacy_id);
        $productQuery->where('pharmacy_id', $user->pharmacy_id);
    }
    $totalPrescriptions = $Prescriptionquery->count(); // $user->prescriptions()->count();
    $totalQuotations = $quotationQuery->count(); // $user->quotations()->count();
    $totalTransactions = $transQuery->count(); //$user->transactions()->count();
    $totalInventories = $inventoryquery->count(); // $user->inventories()->count();
    $totalPharmacies = $pharmacyQuery->count(); // $user->pharmacies()->count();
    $totalProducts = $productQuery->count(); // $user->products()->count();
    $totalProfiles = $profileQuery->count(); // $user->profiles()->count();
    $totalUsers = $userQuery->count(); // $user->users()->count();

    // Redirect based on role
    switch ($user->role) {
        case 'Admin':
            return view('dashboard.adminDashboard', compact('totalPharmacies', 'totalProducts', 'totalProfiles'));
        case 'Pharmacist':
            return view('dashboard.pharmacistDashboard');
        case 'Manager':
            return view('dashboard.managerDashboard'); // Add a manager dashboard if needed
        case 'User':
        case 'Patient': // Assuming 'User' and 'Patient' are interchangeable
            return view('dashboard.patientDashboard', compact('totalPrescriptions', 'totalQuotations', 'totalTransactions'));
        default:
            abort(403, 'Unauthorized'); // Handle unknown roles
    }
})->middleware(['auth'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Resources
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
    Route::get('/profiles/assign/{pharmacy_id}', [ProfileController::class, 'assign'])->name('profiles.assign');
    // Auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    // Register
    Route::view('/auth/register', 'auth.register')->name('register');
    Route::post('auth/register', [AuthController::class, 'register']);
    // Login
    Route::view('/auth/login', 'auth.login')->name('login');
    Route::post('auth/login', [AuthController::class, 'login']);
});
