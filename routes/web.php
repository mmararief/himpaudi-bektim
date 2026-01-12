<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicSiteController;
// Redirect ke situs resmi HIMPAUDI nasional
Route::get('/anggota-himpaudi', function () {
    return redirect()->away('https://himpaudi.org');
})->name('anggota.himpaudi');

// Publik: Pencarian dan detail lembaga
Route::get('/cari', [PublicSiteController::class, 'search'])->name('public.search');
Route::get('/lembaga/{lembaga_master}', [PublicSiteController::class, 'lembaga'])->name('public.lembaga.show');
Route::get('/lembaga/npsn/{npsn}', [PublicSiteController::class, 'lembagaByNpsn'])->name('public.lembaga.npsn');
Route::get('/profil/{user}', [PublicSiteController::class, 'profile'])->name('public.profile.show');

use App\Http\Controllers\BeritaController as PublicBeritaController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/struktur-organisasi', [HomeController::class, 'strukturOrganisasi'])->name('struktur-organisasi');

Route::get('/dashboard', function () {
    $latestBerita = \App\Models\Berita::published()->latest()->take(5)->with('user')->get();
    return view('dashboard', compact('latestBerita'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Profile - Data Pribadi & Data Lembaga
    Route::get('/profile/lembaga', [ProfileController::class, 'showLembaga'])->name('profile.lembaga');
    Route::patch('/profile/data-pribadi', [ProfileController::class, 'updateDataPribadi'])->name('profile.data-pribadi.update');
    Route::patch('/profile/data-lembaga', [ProfileController::class, 'updateDataLembaga'])->name('profile.data-lembaga.update');

    // Cetak KTA (PDF)
    Route::get('/cetak-kta', [\App\Http\Controllers\KtaController::class, 'cetak'])->name('cetak-kta');
    Route::get('/download-kta', [\App\Http\Controllers\KtaController::class, 'download'])->name('download-kta');
});

// Galeri Routes (Public)
use App\Http\Controllers\GaleriController;

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{galeri}', [GaleriController::class, 'show'])->name('galeri.show');

// Berita Routes (Public)
Route::get('/berita', [PublicBeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [PublicBeritaController::class, 'show'])->name('berita.show');
Route::post('/berita/{slug}/comment', [PublicBeritaController::class, 'storeComment'])->middleware('auth')->name('berita.comment.store');

// Forum Routes
use App\Http\Controllers\ForumController;

Route::prefix('forum')->name('forum.')->group(function () {
    // Public routes
    Route::get('/', [ForumController::class, 'index'])->name('index');
    Route::get('/{slug}', [ForumController::class, 'show'])->name('show');

    // Auth required routes
    Route::middleware('auth')->group(function () {
        Route::get('/create/new', [ForumController::class, 'create'])->name('create');
        Route::post('/', [ForumController::class, 'store'])->name('store');
        Route::get('/{slug}/edit', [ForumController::class, 'edit'])->name('edit');
        Route::put('/{slug}', [ForumController::class, 'update'])->name('update');
        Route::delete('/{slug}', [ForumController::class, 'destroy'])->name('destroy');

        // Balasan routes
        Route::post('/{slug}/balasan', [ForumController::class, 'storeBalasan'])->name('balasan.store');
        Route::delete('/balasan/{id}', [ForumController::class, 'destroyBalasan'])->name('balasan.destroy');
    });
});

// Admin Routes
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\LembagaMasterController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management
    Route::resource('users', UserController::class);

    // Contact Info Management
    Route::resource('contact-info', ContactInfoController::class);
    Route::post('/contact-info/{contactInfo}/toggle-active', [ContactInfoController::class, 'toggleActive'])->name('contact-info.toggle-active');

    // Member Management
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/pending', [MemberController::class, 'pending'])->name('members.pending');
    Route::get('/members/rejected', [MemberController::class, 'rejected'])->name('members.rejected');
    Route::get('/members/{user}', [MemberController::class, 'show'])->name('members.show');
    Route::post('/members/{user}/approve', [MemberController::class, 'approve'])->name('members.approve');
    Route::post('/members/{user}/reject', [MemberController::class, 'reject'])->name('members.reject');
    Route::delete('/members/{user}', [MemberController::class, 'destroy'])->name('members.destroy');

    // Galeri Management
    Route::resource('galeri', AdminGaleriController::class);

    // Berita Management
    Route::resource('berita', AdminBeritaController::class)->parameters([
        'berita' => 'beritum' // avoid conflict with Indonesian pluralization
    ]);

    // Lembaga Master Management
    Route::resource('lembaga-master', LembagaMasterController::class)->except(['show']);
    Route::get('/lembaga-master-import', [LembagaMasterController::class, 'import'])->name('lembaga-master.import');
    Route::post('/lembaga-master-import', [LembagaMasterController::class, 'processImport'])->name('lembaga-master.import.process');

    // Visi Misi Management
    Route::resource('visi-misi', VisiMisiController::class);
    Route::post('/visi-misi/{visiMisi}/toggle-active', [VisiMisiController::class, 'toggleActive'])->name('visi-misi.toggle-active');

    // FAQ Management
    Route::resource('faq', FaqController::class);
    Route::post('/faq/{faq}/toggle-active', [FaqController::class, 'toggleActive'])->name('faq.toggle-active');

    // Forum Management
    Route::get('/forum', [AdminForumController::class, 'index'])->name('forum.index');
    Route::post('/forum/{id}/toggle-pin', [AdminForumController::class, 'togglePin'])->name('forum.toggle-pin');
    Route::post('/forum/{id}/toggle-lock', [AdminForumController::class, 'toggleLock'])->name('forum.toggle-lock');
    Route::delete('/forum/{id}', [AdminForumController::class, 'destroy'])->name('forum.destroy');
});

require __DIR__ . '/auth.php';
