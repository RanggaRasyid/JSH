<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//landing-page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('landing-page')->middleware('guest');
/**
 * socialite auth
 */
Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::prefix('/super-admin')->middleware('can:read.only.superadmin')->group(function () {
        
        Route::get('/dashboard', [App\Http\Controllers\Auth\SuperAdminController::class, 'index'])->name('admin.dashboard');

        Route::prefix('master-mahasiswa')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterMahasiswaiController::class, 'index'])->name('master.index');
            Route::get('/show', [App\Http\Controllers\MasterMahasiswaiController::class, 'show'])->name('master.show');
            Route::post('/status/{id}', [App\Http\Controllers\MasterMahasiswaiController::class, 'status'])->name('master.status');
            Route::get('/edit/{id}', [App\Http\Controllers\MasterMahasiswaiController::class, 'edit'])->name('master.edit');
            Route::post('/store', [App\Http\Controllers\MasterMahasiswaiController::class, 'store'])->name('master.store');
            Route::post('/update/{id}', [App\Http\Controllers\MasterMahasiswaiController::class, 'update'])->name('master.update');

        });
        Route::prefix('data-pegawai')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterPegawaiController::class, 'index'])->name('super.pegawai.index');
            Route::get('/show', [App\Http\Controllers\MasterPegawaiController::class, 'show'])->name('super.pegawai.show');
            Route::post('/status/{id}', [App\Http\Controllers\MasterPegawaiController::class, 'status'])->name('super.pegawai.status');
            Route::get('/edit/{id}', [App\Http\Controllers\MasterPegawaiController::class, 'edit'])->name('super.pegawai.edit');
            Route::post('/update/{id}', [App\Http\Controllers\MasterPegawaiController::class, 'update'])->name('super.pegawai.update');
            Route::post('/store', [App\Http\Controllers\MasterPegawaiController::class, 'store'])->name('super.pegawai.store');

        });
        Route::prefix('master-jurusan')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterJurusanController::class, 'index'])->name('jurusan.index');
            Route::get('/show', [App\Http\Controllers\MasterJurusanController::class, 'show'])->name('jurusan.show');
            Route::post('/status/{id}', [App\Http\Controllers\MasterJurusanController::class, 'status'])->name('jurusan.status');
            Route::get('/edit/{id}', [App\Http\Controllers\MasterJurusanController::class, 'edit'])->name('jurusan.edit');
            Route::post('/update/{id}', [App\Http\Controllers\MasterJurusanController::class, 'update'])->name('jurusan.update');
            Route::post('/store', [App\Http\Controllers\MasterJurusanController::class, 'store'])->name('jurusan.store');

        });
        Route::prefix('master-universitas')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterUniversitasController::class, 'index'])->name('univ.index');
            Route::get('/show', [App\Http\Controllers\MasterUniversitasController::class, 'show'])->name('univ.show');
            Route::post('/status/{id}', [App\Http\Controllers\MasterUniversitasController::class, 'status'])->name('univ.status');
            Route::get('/edit/{id}', [App\Http\Controllers\MasterUniversitasController::class, 'edit'])->name('univ.edit');
            Route::post('/update/{id}', [App\Http\Controllers\MasterUniversitasController::class, 'update'])->name('univ.update');
            Route::post('/store', [App\Http\Controllers\MasterUniversitasController::class, 'store'])->name('univ.store');

        });
        Route::prefix('master-masa-magang')->group(function () {
            Route::get('/', [App\Http\Controllers\MasaMagangController::class, 'index'])->name('masa.index');
            Route::get('/show', [App\Http\Controllers\MasaMagangController::class, 'show'])->name('masa.show');
            Route::post('/status/{id}', [App\Http\Controllers\MasaMagangController::class, 'status'])->name('masa.status');
            Route::get('/edit/{id}', [App\Http\Controllers\MasaMagangController::class, 'edit'])->name('masa.edit');
            Route::post('/update/{id}', [App\Http\Controllers\MasaMagangController::class, 'update'])->name('masa.update');
            Route::post('/store', [App\Http\Controllers\MasaMagangController::class, 'store'])->name('masa.store');

        });
        Route::prefix('/presensi')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterPresensiController::class, 'index'])->name('admin.presensi.index');
            Route::get('/show/{id}', [App\Http\Controllers\MasterPresensiController::class, 'show'])->name('admin.presensi.show');
            Route::get('/show-detail/{id}', [App\Http\Controllers\DetailPresensiController::class, 'index'])->name('admin.presensi.show.detail');
            Route::get('/detail/{id}', [App\Http\Controllers\DetailPresensiController::class, 'detail'])->name('admin.presensi.detail');
        });
        Route::prefix('/logbook')->group(function () {
            Route::get('/', [App\Http\Controllers\KelolaLogbookController::class, 'index'])->name('master.logbook.index');
            Route::get('/show', [App\Http\Controllers\KelolaLogbookController::class, 'show'])->name('master.logbook.show');
            Route::post('/approve/{id}', [App\Http\Controllers\KelolaLogbookController::class, 'approve'])->name('logbook.approve');
            Route::post('/tolak/{id}', [App\Http\Controllers\KelolaLogbookController::class, 'rejected'])->name('logbook.rejected');
        });
        Route::prefix('/background')->group(function () {
            Route::get('/', [App\Http\Controllers\BackgroundController::class, 'index'])->name('background.index');
            Route::get('/show', [App\Http\Controllers\BackgroundController::class, 'show'])->name('background.show');
            Route::post('/store', [App\Http\Controllers\BackgroundController::class, 'store'])->name('background.store');
            Route::post('/status/{id}', [App\Http\Controllers\BackgroundController::class, 'status'])->name('background.status');
            Route::get('/edit/{id}', [App\Http\Controllers\BackgroundController::class, 'edit'])->name('background.edit');
            Route::post('/update/{id}', [App\Http\Controllers\BackgroundController::class, 'rejected'])->name('background.rejected');
            Route::delete('/destroy/{id}', [App\Http\Controllers\BackgroundController::class, 'destroy'])->name('background.destroy');
        });
    });
});

Route::prefix('/supervisor')->middleware('auth', 'can:only.supervisor')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\SupervisiController::class, 'index'])->name('spv.dashboard');

    Route::prefix('/logbook')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminLogbookController::class, 'index'])->name('spv.logbook.index');
        Route::get('/show', [App\Http\Controllers\AdminLogbookController::class, 'show'])->name('spv.logbook.show');
        Route::post('/approve/{id}', [App\Http\Controllers\AdminLogbookController::class, 'approve'])->name('spv.approve');
        Route::post('/tolak/{id}', [App\Http\Controllers\AdminLogbookController::class, 'rejected'])->name('spv.rejected');
    });

    Route::prefix('/presensi')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminPresensiController::class, 'index'])->name('spv.presensi.index');
        Route::get('/show', [App\Http\Controllers\AdminPresensiController::class, 'show'])->name('spv.presensi.show');
        Route::get('/show-detail/{id}', [App\Http\Controllers\AdminPresensiController::class, 'view'])->name('spv.presensi.show');
        Route::get('/detail/{id}', [App\Http\Controllers\AdminPresensiController::class, 'detail'])->name('spv.presensi.detail');
    });

    Route::prefix('/mahasiswa')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminMahasiswaController::class, 'index'])->name('spv.mahasiswa.index');
        Route::get('/show', [App\Http\Controllers\AdminMahasiswaController::class, 'show'])->name('spv.mahasiswa.show');
        Route::get('/show-detail/{id}', [App\Http\Controllers\AdminMahasiswaController::class, 'view'])->name('spv.mahasiswa.show');
        Route::post('/update/{id}', [App\Http\Controllers\AdminMahasiswaController::class, 'update'])->name('spv.mahasiswa.update');
        Route::post('/status/{id}', [App\Http\Controllers\AdminMahasiswaController::class, 'status'])->name('spv.mahasiswa.status');
    });

    Route::prefix('/profile-mahasiswa')->group(function () {
        Route::get('/', [App\Http\Controllers\ProfileMahasiswaController::class, 'index'])->name('spv.show.profile');
        Route::get('detail/', [App\Http\Controllers\ProfileMahasiswaController::class, 'index'])->name('spv.detail.profile');
    });

});

Route::prefix('mahasiswa')->middleware('auth', 'can:read.only.mahasiswa')->group(function () {
    Route::get('/data', [App\Http\Controllers\Auth\SocialiteController::class, 'data'])->name('data.index');
    Route::post('/register', [App\Http\Controllers\Auth\SocialiteController::class, 'created'])->name('created.index');
    Route::get('/dashboard', [App\Http\Controllers\ProfileMahasiswaController::class, 'index'])->name('dashboard.mahasiswa.index');

    Route::prefix('/profile')->group(function () {
        Route::get('/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'profile'])->name('profile.mahasiswa.index');
        Route::get('/edit/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'edit'])->name('edit.mahasiswa.profile');
        Route::post('/update/{id}', [App\Http\Controllers\ProfileMahasiswaController::class, 'update'])->name('update.mahasiswa.profile');
    });

    Route::prefix('/loogbook')->group(function() {
        route::get('/', [App\Http\Controllers\LoogBookController::class, 'index'])->name('index.loogbook');
        route::get('/show', [App\Http\Controllers\LoogBookController::class, 'show'])->name('show.loogbook');
        route::post('/store', [App\Http\Controllers\LoogBookController::class, 'store'])->name('store.loogbook');
        route::get('/edit/{id}', [App\Http\Controllers\LoogBookController::class, 'edit'])->name('edit.loogbook');
        route::post('/update/{id}', [App\Http\Controllers\LoogBookController::class, 'update'])->name('update.loogbook');
        route::delete('/destroy/{id}', [App\Http\Controllers\LoogBookController::class, 'destroy'])->name('destroy.loogbook');
    });

    Route::prefix('/presensi')->group(function() {
        route::get('/', [App\Http\Controllers\PresensiController::class, 'index'])->name('presensi');
        route::get('/show/{id}', [App\Http\Controllers\PresensiController::class, 'show'])->name('presensi.show');
        route::post('/store', [App\Http\Controllers\PresensiController::class, 'store'])->name('presensi.store');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/aktivasi', [SocialiteController::class, 'aktivasi'])->name('aktivasi.mahasiswa');