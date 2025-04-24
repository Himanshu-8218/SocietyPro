<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/', function () {
    return view('auth.register');
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'contactupdate'])->name('profile.contactupdate');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'ResidentMiddleware'])->group(function () {
    Route::get('/dashboard', [ResidentController::class, 'index'])->name('dashboard');
    Route::view('/notice-board', 'resident.notice-board')->name('/notice-board');
    Route::view('/complaint-board', 'resident.complaint-board')->name('/complaint-board');
    Route::view('resident/bill', 'resident.bill')->name('resident/bill');
    Route::view('resident/facility', 'resident.facility')->name('resident/facility');
    Route::view('resident/visitor', 'resident.visitor')->name('resident/visitor');
    Route::view('resident/profile', 'resident.profile')->name('resident/profile');

    Route::get('resident/pay/{bill}', [BillingController::class, 'pay'])->name('resident/pay');
    Route::get('resident/paypal/success', [BillingController::class, 'success'])->name('resident/paypal/success');
    Route::get('resident/paypal/cancel', [BillingController::class, 'cancel'])->name('resident/paypal/cancel');
    Route::get('resident/receipt/{bill}', [BillingController::class, 'downloadReceipt'])->name('resident/receipt');
    
});

Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin/dashboard');
    Route::get('admin/auth/register-staff',function(){return view('auth.register-staff');})->name('admin/create/staff');
    Route::get('admin/auth/register-security',function(){return view('auth.register-security');})->name('admin/create/security');
    Route::get('admin/register', [RegisteredUserController::class, 'create'])->name('admin/register');
    Route::post('admin/register', [RegisteredUserController::class, 'store_admin']);
    Route::view('admin/notice-board', 'admin.notice-board')->name('admin/notice-board');
    Route::view('admin/staff-management', 'admin.staff-management')->name('admin/staff-management');
    Route::view('admin/complaint-board', 'admin.complaint-board')->name('admin/complaint-board');
    Route::view('admin/bill', 'admin.bill')->name('admin/bill');
    Route::view('admin/attendence', 'admin.attendence')->name('admin/attendence');
    Route::view('admin/profile', 'admin.profile')->name('admin/profile');
    Route::view('admin/visitor', 'admin.visitor')->name('admin/visitor');
    Route::view('admin/facility/view', 'admin.facility')->name('admin/facility/view');
    //Property Routes
    Route::view('admin/buildings', 'admin.buildings')->name('admin/buildings');
    Route::view('admin/floors', 'admin.floors')->name('admin/floors');
    Route::view('admin/units', 'admin.units')->name('admin/units');


});
//All Staff Routes
Route::middleware(['auth', 'StaffMiddleware'])->group(function () {
    Route::get('staff/dashboard', [StaffController::class, 'index'])->name('staff/dashboard');
    Route::view('staff/profile', 'staff.profile')->name('staff/profile');
    Route::view('staff/activity', 'staff.activity')->name('staff/activity');
    Route::view('staff/complaint-board', 'staff.complaint-board')->name('staff/complaint-board');
});


//All Security Routes
Route::middleware(['auth', 'SecurityMiddleware'])->group(function () {
    Route::get('security/dashboard', [SecurityController::class, 'index'])->name('security/dashboard');
    Route::view('security/profile', 'security.profile')->name('security/profile');
    Route::view('security/activity', 'security.activity')->name('security/activity');
});
