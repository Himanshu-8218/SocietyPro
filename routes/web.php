<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\SocietyController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Livewire\Admin\StaffManagement;
use App\Http\Livewire\ComplaintForm;
use App\Http\Livewire\ManageComplaints;
use App\Livewire\Admin\NoticeBoard;

use App\Livewire\BillingComponent;

use App\Http\Controllers\PaymentController;

Route::get('/billing/success/{billId}', [PaymentController::class, 'success'])->name('billing.success');
Route::get('/billing/cancel', [PaymentController::class, 'cancel'])->name('billing.cancel');



Route::get('/users',[StaffManagement::class,'render']);
// Route::get('/users/edit/{id}',[StaffManagement::class,'edit_staff']);
// Route::get('/users/delete/{id}',[StaffManagement::class,'delete_staff']);


Route::get('/', function () {
    return view('auth.register');
});

// Route::get('/dashboard', function () {
//     return view('resident.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'contactupdate'])->name('profile.contactupdate');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'ResidentMiddleware'])->group(function () {
    Route::get('/dashboard', [ResidentController::class, 'index'])->name('dashboard');
    // Route::get('/complaints', ComplaintForm::class)->name('complaints.form');
});

Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin/dashboard');
    Route::get('admin/auth/register-staff',function(){return view('auth.register-staff');})->name('admin/create/staff');
    Route::get('admin/auth/register-security',function(){return view('auth.register-security');})->name('admin/create/security');
    Route::get('admin/register', [RegisteredUserController::class, 'create'])->name('admin/register');
    Route::post('admin/register', [RegisteredUserController::class, 'store_admin']);
    Route::view('admin/notice-board', 'admin.notice-board')->name('admin/notice-board');
    Route::view('admin/staff-management', 'admin.staff-management')->name('admin/staff-management');

    
    // Only admins or maintenance can access this
    // Route::get('/admin/complaints', ManageComplaints::class)->name('admin.complaints');
});

Route::middleware(['auth', 'StaffMiddleware'])->group(function () {
    Route::get('staff/dashboard', [StaffController::class, 'index'])->name('staff/dashboard');
});

Route::middleware(['auth', 'SecurityMiddleware'])->group(function () {
    Route::get('security/dashboard', [SecurityController::class, 'index'])->name('security/dashboard');
});
