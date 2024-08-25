<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AccountController;


// Ana sayfa
Route::get('/', function () {
    return view('welcome');
});

// Kullanıcı kayıt  rotaları
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//Kullanıcı Giriş rotaları
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Home sayfası
Route::get('/home', [HomeController::class, 'homePage'])->name('homePage');

// Randevu sayfası
Route::get('/appointment', [AppointmentController::class, 'appointmentForm'])->name('appointment');
//appointment URL'ine GET isteği yapıldığında AppointmentController  sınıfının appointmentform metodunun çağrılmasını sağlar.Rota ası appointment.

// İlgili verileri getirme rotaları
Route::get('/districts/{city_id}', [HomeController::class, 'getDistricts'])->name('districts.get');
Route::get('/hospitals/{district_id}', [HomeController::class, 'getHospitals'])->name('hospitals.get');
Route::get('/clinics/{hospital_id}', [HomeController::class, 'getClinics'])->name('clinics.get');
Route::get('/doctors/{clinic_id}', [HomeController::class, 'getDoctors'])->name('doctors.get');

// Randevu kaydetme rotası
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/homePage', [AppointmentController::class, 'store'])->name('appointments.store');
Route::post('/delete/appointment', [AppointmentController::class, 'delete'])->name('appointment.delete');

// Hesap bilgileri formunu görüntüleme rotası
Route::get('/account', [AccountController::class, 'accountForm'])->name('account');

// Hesap bilgilerini güncelleme rotası
Route::post('/account/update', [AccountController::class, 'accountUpdate'])->name('account.update');
