<?php

use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminTransferStudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UnifiedLoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PendaftaranPindahanController;
use App\Http\Controllers\StudentImportController;
use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminContactMessageController;
use App\Http\Controllers\AdminBranchController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [PageController::class, 'index'])->name('home');

// About page
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');

// News page
Route::get('/berita', [PageController::class, 'news'])->name('news');

// News detail page
Route::get('/berita/{news}', [PageController::class, 'showNews'])->name('news.show');

// Contact page
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

// Global Search
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Unified Login Routes (replaces old student.login and login routes)
Route::middleware('guest')->controller(UnifiedLoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('unified.login');
    Route::post('/login', 'login')->name('unified.login.submit');
});

Route::post('/logout', [UnifiedLoginController::class, 'logout'])->name('unified.logout');

// Contact form submission
Route::post('/kontak', [PageController::class, 'sendContact'])->name('contact.send');

// Pendaftaran page
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// Pendaftaran Pindahan page
Route::get('/pendaftaran-pindahan', [PendaftaranPindahanController::class, 'create'])->name('pendaftaran-pindahan');
Route::post('/pendaftaran-pindahan', [PendaftaranPindahanController::class, 'store'])->name('pendaftaran-pindahan.store');

// Student Register Routes (Guest only)
Route::middleware('guest')->controller(StudentAuthController::class)->group(function () {
    Route::get('/student-register', 'showRegisterForm')->name('student.register');
    Route::post('/student-register', 'register')->name('student.register.submit');
});

// Student Routes (Authenticated)
Route::middleware('auth:students')->controller(StudentController::class)->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/graduation-status', 'graduationStatus')->name('graduation.status');
    Route::get('/certificate', 'downloadCertificate')->name('certificate.download');
    Route::get('/change-password', 'changePassword')->name('change-password');
    Route::post('/change-password', 'updatePassword')->name('update-password');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin Routes (Diproteksi Login Session)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/students', [AdminStudentController::class, 'index'])->name('students.index');
    Route::patch('/students/{student}/status', [AdminStudentController::class, 'updateStatus'])->name('students.updateStatus');
    
    // Student Import Routes
    Route::get('/students/import/form', [StudentImportController::class, 'showImportForm'])->name('students.importForm');
    Route::post('/students/import', [StudentImportController::class, 'importExcel'])->name('students.import');
    Route::get('/students/template', [StudentImportController::class, 'downloadTemplate'])->name('students.template');
    
    // News CRUD
    Route::resource('news', AdminNewsController::class)->except(['show'])->parameters(['news' => 'news:id']);

    // Site Settings
    Route::get('/settings/about', [AdminSettingController::class, 'editAbout'])->name('settings.about');
    Route::post('/settings/about', [AdminSettingController::class, 'updateAbout'])->name('settings.about.update');
    Route::get('/settings/contact', [AdminSettingController::class, 'editContact'])->name('settings.contact');
    Route::post('/settings/contact', [AdminSettingController::class, 'updateContact'])->name('settings.contact.update');
    Route::get('/settings/homepage', [AdminSettingController::class, 'editHomepage'])->name('settings.homepage');
    Route::post('/settings/homepage', [AdminSettingController::class, 'updateHomepage'])->name('settings.homepage.update');

    // Branch Management
    Route::get('/branches', [AdminBranchController::class, 'index'])->name('branches.index');
    Route::post('/branches', [AdminBranchController::class, 'store'])->name('branches.store');
    Route::put('/branches/{branch}', [AdminBranchController::class, 'update'])->name('branches.update');
    Route::patch('/branches/{branch}/toggle', [AdminBranchController::class, 'toggleStatus'])->name('branches.toggle');
    Route::delete('/branches/{branch}', [AdminBranchController::class, 'destroy'])->name('branches.destroy');

    Route::get('/transfer-students', [AdminTransferStudentController::class, 'index'])->name('transfer-students.index');
    Route::get('/transfer-students/{transferStudent}', [AdminTransferStudentController::class, 'show'])->name('transfer-students.show');
    Route::patch('/transfer-students/{transferStudent}/status', [AdminTransferStudentController::class, 'updateStatus'])->name('transfer-students.updateStatus');

    // Contact Messages
    Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
    Route::patch('/messages/{message}/read', [AdminContactMessageController::class, 'markAsRead'])->name('messages.markAsRead');
});
