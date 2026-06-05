<?php

use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminTransferStudentController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\StudentAuthController;   // disabled — student section hidden
// use App\Http\Controllers\StudentController;       // disabled — student section hidden
use App\Http\Controllers\UnifiedLoginController;
use App\Http\Controllers\PendaftaranController;
// use App\Http\Controllers\PendaftaranPindahanController; // disabled — redirect ke pendaftaran
use App\Http\Controllers\StudentImportController;
use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminContactMessageController;
use App\Http\Controllers\AdminBranchController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminPartnershipController;
use App\Http\Controllers\AdminCertificateController;
use App\Http\Controllers\SuperAdminUserController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [PageController::class, 'index'])->name('home');

// About page
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');

// News page
Route::get('/berita', [PageController::class, 'news'])->name('news');

// Branch detail page
Route::get('/cabang/{branch:slug}', [PageController::class, 'showBranch'])->name('branch.show');

// News detail page
Route::get('/berita/{news}', [PageController::class, 'showNews'])->name('news.show');

// Contact page
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

// Kemitraan page
Route::get('/kemitraan', [PageController::class, 'kemitraan'])->name('kemitraan');

// Certificates page
Route::get('/certificates', [PageController::class, 'certificates'])->name('certificates');

// Global Search
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Old /login — disabled, redirect to home
Route::middleware('guest')->group(function () {
    Route::get('/login', function () { return redirect()->route('home'); })->name('unified.login');
    Route::post('/login', function () { return redirect()->route('home'); })->name('unified.login.submit');
});

// Secret Admin Login — URL tidak terlihat di navbar publik
Route::middleware('guest')->group(function () {
    Route::get('/lt-9x2k7m-staf-p4n3l', [AuthController::class, 'showLoginForm']);
    Route::post('/lt-9x2k7m-staf-p4n3l', [AuthController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [UnifiedLoginController::class, 'logout'])->name('unified.logout');

// Contact form submission
Route::post('/kontak', [PageController::class, 'sendContact'])->name('contact.send');

// Pendaftaran page
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// Pendaftaran Pindahan — redirect ke halaman pendaftaran terpadu
Route::get('/pendaftaran-pindahan', function () {
    return redirect()->route('pendaftaran');
})->name('pendaftaran-pindahan');

// =============================================
// STUDENT ROUTES — DINONAKTIFKAN SEMENTARA
// Uncomment semua blok ini untuk mengaktifkan kembali
// =============================================

// Student Register Routes (Guest only)
// Route::middleware('guest')->controller(StudentAuthController::class)->group(function () {
//     Route::get('/student-register', 'showRegisterForm')->name('student.register');
//     Route::post('/student-register', 'register')->name('student.register.submit');
// });

// Student Routes (Authenticated)
// Route::middleware('auth:students')->controller(StudentController::class)->prefix('student')->name('student.')->group(function () {
//     Route::get('/dashboard', 'dashboard')->name('dashboard');
//     Route::get('/profile', 'profile')->name('profile');
//     Route::get('/profile/edit', 'editProfile')->name('profile.edit');
//     Route::put('/profile/update', 'updateProfile')->name('profile.update');
//     Route::get('/graduation-status', 'graduationStatus')->name('graduation.status');
//     Route::get('/certificate', 'downloadCertificate')->name('certificate.download');
//     Route::get('/change-password', 'changePassword')->name('change-password');
//     Route::post('/change-password', 'updatePassword')->name('update-password');
//     Route::post('/logout', 'logout')->name('logout');
// });

// Placeholder routes agar nama route tidak error di views yang masih ada
Route::get('/student-register', function () { return redirect()->route('home'); })->name('student.register');
Route::post('/student-register', function () { return redirect()->route('home'); })->name('student.register.submit');
Route::get('/student/dashboard', function () { return redirect()->route('home'); })->name('student.dashboard');
Route::get('/student/profile', function () { return redirect()->route('home'); })->name('student.profile');
Route::get('/student/graduation-status', function () { return redirect()->route('home'); })->name('student.graduation.status');
Route::get('/student/change-password', function () { return redirect()->route('home'); })->name('student.change-password');

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
    Route::patch('/news/{id}/toggle', [AdminNewsController::class, 'togglePublish'])->name('news.toggle');
    Route::get('/news/{id}/preview', [AdminNewsController::class, 'preview'])->name('news.preview');

    // Site Settings
    Route::get('/settings/about', [AdminSettingController::class, 'editAbout'])->name('settings.about');
    Route::post('/settings/about', [AdminSettingController::class, 'updateAbout'])->name('settings.about.update');
    Route::get('/settings/contact', [AdminSettingController::class, 'editContact'])->name('settings.contact');
    Route::post('/settings/contact', [AdminSettingController::class, 'updateContact'])->name('settings.contact.update');
    Route::get('/settings/homepage', [AdminSettingController::class, 'editHomepage'])->name('settings.homepage');
    Route::post('/settings/homepage', [AdminSettingController::class, 'updateHomepage'])->name('settings.homepage.update');
    Route::get('/settings/registration', [AdminSettingController::class, 'editRegistration'])->name('settings.registration');
    Route::post('/settings/registration', [AdminSettingController::class, 'updateRegistration'])->name('settings.registration.update');

    // Branch Management
    Route::get('/branches', [AdminBranchController::class, 'index'])->name('branches.index');
    Route::post('/branches', [AdminBranchController::class, 'store'])->name('branches.store');
    Route::get('/branches/{branch}/edit', [AdminBranchController::class, 'edit'])->name('branches.edit');
    Route::put('/branches/{branch}', [AdminBranchController::class, 'update'])->name('branches.update');
    Route::patch('/branches/{branch}/toggle', [AdminBranchController::class, 'toggleStatus'])->name('branches.toggle');
    Route::delete('/branches/{branch}', [AdminBranchController::class, 'destroy'])->name('branches.destroy');

    // Partnerships CRUD
    Route::get('/partnerships', [AdminPartnershipController::class, 'index'])->name('partnerships.index');
    Route::get('/partnerships/create', [AdminPartnershipController::class, 'create'])->name('partnerships.create');
    Route::post('/partnerships', [AdminPartnershipController::class, 'store'])->name('partnerships.store');
    Route::get('/partnerships/{partnership}/edit', [AdminPartnershipController::class, 'edit'])->name('partnerships.edit');
    Route::put('/partnerships/{partnership}', [AdminPartnershipController::class, 'update'])->name('partnerships.update');
    Route::post('/partnerships/{partnership}/toggle', [AdminPartnershipController::class, 'toggleActive'])->name('partnerships.toggle');
    Route::delete('/partnerships/{partnership}', [AdminPartnershipController::class, 'destroy'])->name('partnerships.destroy');

    // Certificates CRUD
    Route::get('/certificates', [AdminCertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/create', [AdminCertificateController::class, 'create'])->name('certificates.create');
    Route::post('/certificates', [AdminCertificateController::class, 'store'])->name('certificates.store');
    Route::get('/certificates/{certificate}/edit', [AdminCertificateController::class, 'edit'])->name('certificates.edit');
    Route::put('/certificates/{certificate}', [AdminCertificateController::class, 'update'])->name('certificates.update');
    Route::post('/certificates/{certificate}/toggle', [AdminCertificateController::class, 'toggleActive'])->name('certificates.toggle');
    Route::delete('/certificates/{certificate}', [AdminCertificateController::class, 'destroy'])->name('certificates.destroy');

    Route::get('/transfer-students', [AdminTransferStudentController::class, 'index'])->name('transfer-students.index');
    Route::get('/transfer-students/{transferStudent}', [AdminTransferStudentController::class, 'show'])->name('transfer-students.show');
    Route::patch('/transfer-students/{transferStudent}/status', [AdminTransferStudentController::class, 'updateStatus'])->name('transfer-students.updateStatus');

    // Contact Messages
    Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
    Route::patch('/messages/{message}/read', [AdminContactMessageController::class, 'markAsRead'])->name('messages.markAsRead');

    // Superadmin — Manajemen Pengguna
    Route::middleware(\App\Http\Middleware\IsSuperadmin::class)->prefix('superadmin')->name('superadmin.')->group(function () {
        Route::get('/users', [SuperAdminUserController::class, 'index'])->name('users.index');
        Route::post('/users', [SuperAdminUserController::class, 'store'])->name('users.store');
        Route::patch('/users/{user}/toggle', [SuperAdminUserController::class, 'toggleActive'])->name('users.toggle');
        Route::patch('/users/{user}/reset-password', [SuperAdminUserController::class, 'resetPassword'])->name('users.reset-password');
        Route::delete('/users/{user}', [SuperAdminUserController::class, 'destroy'])->name('users.destroy');
    });
});
