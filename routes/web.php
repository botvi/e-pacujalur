<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\{
    DashboardController,
};

use App\Http\Controllers\superadmin\{
    DashboardSuperAdminController,
    JalurController,
    GelanggangController,
    EventController,
    JuaraPacuJalurController,
    UndianPacuController,
    ProfilController,

};

use App\Http\Controllers\user\{
    WebHomeController,
    WebDaftarJalurController,
    WebJuaraPacuJalurController,
    WebUndianPacuController,
};
use App\Http\Controllers\auth\{
    LoginController,
    RegisterController,
    GoogleController,
    ForgotPasswordController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/run-superadmin', function () {
    Artisan::call('db:seed', [
        '--class' => 'SuperAdminSeeder'
    ]);

    return "SuperAdminSeeder has been create successfully!";
});
// Manual
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/auth/google/complete', [GoogleController::class, 'showCompleteForm'])->name('google.complete');
Route::post('/auth/google/complete-register', [GoogleController::class, 'completeRegister'])->name('google.complete.register');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequestOtpForm'])->name('forgot-password');
Route::get('/forgot-password/verify', [ForgotPasswordController::class, 'showVerifyOtpForm'])->name('forgot-password.verify');
Route::get('/forgot-password/reset', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('forgot-password.reset');

Route::post('/forgot-password/request-otp', [ForgotPasswordController::class, 'requestOtp'])->name('forgot-password.request-otp');
Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot-password.verify-otp');
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot-password.reset-password');


// Web Routes (Public)
Route::get('/', [WebHomeController::class, 'index'])->name('web.home');
Route::get('/daftar-jalur', [WebDaftarJalurController::class, 'index'])->name('web.daftarjalur');
Route::get('/daftar-jalur/{id}', [WebDaftarJalurController::class, 'detail'])->name('web.daftarjalur.detail');
Route::get('/juara-pacu-jalur', [WebJuaraPacuJalurController::class, 'index'])->name('web.juarapacujalur');
Route::get('/juara-pacu-jalur/{id}', [WebJuaraPacuJalurController::class, 'detail'])->name('web.juarapacujalur.detail');
Route::get('/undian-pacu', [WebUndianPacuController::class, 'index'])->name('web.undianpacu');
Route::get('/undian-pacu/{id}', [WebUndianPacuController::class, 'detail'])->name('web.undianpacu.detail');

// Admin Routes
Route::group(['middleware' => ['role:superadmin']], function () {
    Route::get('/dashboard-superadmin', [DashboardSuperAdminController::class, 'index'])->name('dashboard-superadmin');
    Route::resource('managejalur', JalurController::class);
    Route::resource('managegelanggang', GelanggangController::class);
    Route::resource('manageevent', EventController::class);
    Route::resource('managejuarapacujalur', JuaraPacuJalurController::class);
    Route::resource('manageundianpacu', UndianPacuController::class);
    Route::get('manageundianpacu/{id}/export', [UndianPacuController::class, 'export'])->name('manageundianpacu.export');
    
    // Profile Routes
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.update-password');
});


