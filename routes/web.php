<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\FinancialChart;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Livewire\Admin\StaffManagement;
use App\Livewire\Admin\FloorForm;
use App\Livewire\Admin\BuildingForm;
use App\Livewire\Admin\UnitForm;
use App\Livewire\Admin\NoticeBoard;

use App\Livewire\BillingComponent;

use App\Http\Controllers\PaymentController;

Route::get('/resident/payment-success/{billId}', [PaymentController::class, 'paymentSuccess'])->name('/paymentSuccess');
Route::get('/resident/payment-cancel/{billId}', [PaymentController::class, 'paymentCancel'])->name('/paymentCancel');

// Route for downloading invoice
Route::get('/resident/download-invoice/{billId}', [PaymentController::class, 'downloadInvoice'])->name('resident.downloadInvoice');




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
    Route::view('/notice-board', 'resident.notice-board')->name('/notice-board');
    Route::view('/complaint-board', 'resident.complaint-board')->name('/complaint-board');
    Route::get('/payment/success', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [App\Http\Controllers\PaymentController::class, 'cancel'])->name('payment.cancel');
    Route::get('/invoice/download/{id}', [PaymentController::class, 'downloadInvoice'])->name('invoice.download');
    
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
    Route::view('admin/complaint-board', 'admin.complaint-board')->name('admin/complaint-board');
    Route::view('admin/facility/view', 'admin.facility')->name('admin/facility/view');

    Route::view('admin/buildings', 'admin.buildings')->name('admin/buildings');
    Route::view('admin/floors', 'admin.floors')->name('admin/floors');
    Route::view('admin/units', 'admin.units')->name('admin/units');


});

Route::middleware(['auth', 'StaffMiddleware'])->group(function () {
    Route::get('staff/dashboard', [StaffController::class, 'index'])->name('staff/dashboard');
});

Route::middleware(['auth', 'SecurityMiddleware'])->group(function () {
    Route::get('security/dashboard', [SecurityController::class, 'index'])->name('security/dashboard');
});
