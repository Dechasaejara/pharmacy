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
use App\Models\Pharmacy;
use App\Models\Product;
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
    $user = Auth::user(); // Get the authenticated user
    // Check if the user has a profile
    if (!$user->profile) {
        abort(403, 'Unauthorized: No profile associated with this user.');
    }
    $role = $user->profile->role; // Get the user's role from the profile
    $totalPrescriptions = 76756; // $user->prescriptions()->count();
    $totalQuotations = 757657; // $user->quotations()->count();
    $totalTransactions = 433; //$user->transactions()->count();

    // Redirect based on role
    switch ($role) {
        case 'Admin':
            return view('dashboard.adminDashboard');
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
    Route::resource('profiles', ProfileController::class);
    Route::resource('products', ProductController::class);
    Route::resource('pharmacies', PharmacyController::class);
    Route::resource('inventories', InventoryController::class);
    Route::resource('prescriptions', PrescriptionController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('quotations', QuotationController::class);
    Route::resource('lineitems', LineItemController::class);
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
