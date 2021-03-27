<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;

// Dark Mode
Route::get('/dark', [PageController::class, 'darkmode'])->name('darkmode');

// Halaman Non-Member/Guest
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
//

// Login Page
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postlogin'])->name('postlogin');
//

Route::group(['as' => 'antrean'], function()
{
    Route::get('/antrean/apotek', [AntrianController::class, 'antreanApotek'])->name('_apotek');
    Route::get('/antrean/dokter', [AntrianController::class, 'antreanDokter'])->name('_dokter');
    Route::get('/antrean/kasir', [AntrianController::class, 'antreanKasir'])->name('_kasir');
});

// Perlu Level Akses
Route::group(['middleware' => ['auth']], function()
{
    // Logout Page
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    //

    // Dashboard
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    //

    // Halaman Semua Antrian
    Route::get('/antrean', [AntrianController::class, 'antrean'])->name('antrean');
    //

    Route::group(['as' => 'myprofile'], function()
    {
        Route::get('/profile', [UserController::class, 'myprofile'])->name('_index');
        Route::get('/profile/edit', [UserController::class, 'edit_myprofile'])->name('_edit');
        Route::patch('/profile', [UserController::class, 'update_myprofile'])->name('_update');
        Route::get('/profile/reset_password', [UserController::class, 'reset_mypass'])->name('_reset_pass');
        Route::patch('/profile/update_pass', [UserController::class, 'update_mypass'])->name('_update_pass');
        # Method Error Handle
        Route::get('/profile/update_pass', [UserController::class, 'get_error']);
    });

    // Level: Administrator //
    Route::group(['middleware' => ['ceklevel:admin']], function()
    {
        Route::group(['as' => 'pegawai'], function()
        {
            Route::get('/pegawai', [UserController::class, 'index'])->name('_index');
            Route::get('/pegawai/create', [UserController::class, 'create'])->name('_create');
            Route::post('/pegawai', [UserController::class, 'store'])->name('_store');
            Route::get('/pegawai/{pegawai}', [UserController::class, 'show'])->name('_show');
            Route::get('/pegawai/edit/{pegawai}', [UserController::class, 'edit'])->name('_edit');
            Route::patch('/pegawai/update/{pegawai}', [UserController::class, 'update'])->name('_update');
            Route::delete('/pegawai/delete/{pegawai}', [UserController::class, 'destroy'])->name('_destroy');
            # Reset Password Pegawai
            Route::get('/pegawai/forgot_password/{pegawai}', [UserController::class, 'forgot_password'])->name('_forgot_password');
            Route::patch('/pegawai/update_password/{pegawai}', [UserController::class, 'update_password'])->name('_update_password');
            # Method Error Handle
            Route::get('/pegawai/update/{pegawai}', [UserController::class, 'get_error']);
            Route::get('/pegawai/delete/{pegawai}', [UserController::class, 'get_error']);
            Route::get('/pegawai/update_password/{pegawai}', [UserController::class, 'get_error']);
        });

        Route::group(['as' => 'registrasi'], function()
        {
            Route::post('/registrasi/destroy_all', [AntrianController::class, 'destroy_all'])->name('_destroy_all');
            # Method Error Handle
            Route::get('/registrasi/destroy_all', [AntrianController::class, 'get_error']);
        });
    });

    // Level: Staff //
    Route::group(['middleware' => ['ceklevel:staff']], function()
    {
        Route::group(['as' => 'dokter'], function()
        {
            Route::get('/dokter', [DokterController::class, 'index'])->name('_index');
            Route::get('/dokter/create', [DokterController::class, 'create'])->name('_create');
            Route::post('/dokter', [DokterController::class, 'store'])->name('_store');
            Route::get('/dokter/{dokter}', [DokterController::class, 'show'])->name('_show');
            Route::get('/dokter/edit/{dokter}', [DokterController::class, 'edit'])->name('_edit');
            Route::patch('/dokter/update/{dokter}', [DokterController::class, 'update'])->name('_update');
            Route::delete('/dokter/delete/{dokter}', [DokterController::class, 'destroy'])->name('_destroy');
            # Method Error Handle
            Route::get('/dokter/update/{dokter}', [DokterController::class, 'get_error']);
            Route::get('/dokter/delete/{dokter}', [DokterController::class, 'get_error']);
        });

        Route::group(['as' => 'obat'], function()
        {
            Route::delete('/obat/delete/{obat}', [MedicineController::class, 'destroy'])->name('_destroy');
            # Method Error Handle
            Route::get('/obat/delete/{obat}', [MedicineController::class, 'get_error']);
        });

        Route::group(['as' => 'resep'], function()
        {
            Route::delete('/resep/delete/{resep}', [ResepController::class, 'destroy'])->name('_destroy');
            # Method Error Handle
            Route::get('/resep/delete/{resep}', [ResepController::class, 'get_error']);
        });

        Route::group(['as' => 'settings'], function()
        {
            Route::get('/settings', [SettingController::class, 'index'])->name('_index');
            Route::patch('/settings/update/website', [SettingController::class, 'update_website'])->name('_update_website');
            Route::patch('/settings/update/dokter', [SettingController::class, 'update_dokter'])->name('_update_dokter');
            Route::patch('/settings/update/obat', [SettingController::class, 'update_obat'])->name('_update_obat');
            Route::patch('/settings/update/kasir', [SettingController::class, 'update_kasir'])->name('_update_kasir');
            Route::patch('/settings/update/profile', [SettingController::class, 'update_profile'])->name('_update_profile');
        });
    });

    // Level: Resepsionis //
    Route::group(['middleware' => ['ceklevel:resepsionis']], function()
    {
        Route::group(['as' => 'pasien'], function()
        {
            Route::get('/pasien', [PasienController::class, 'index'])->name('_index');
            Route::get('/pasien/create', [PasienController::class, 'create'])->name('_create');
            Route::post('/pasien', [PasienController::class, 'store'])->name('_store');
            Route::get('/pasien/{pasien}', [PasienController::class, 'show'])->name('_show');
            Route::get('/pasien/edit/{pasien}', [PasienController::class, 'edit'])->name('_edit');
            Route::patch('/pasien/update/{pasien}', [PasienController::class, 'update'])->name('_update');
            Route::delete('/pasien/delete/{pasien}', [PasienController::class, 'destroy'])->name('_destroy');
            # Method Error Handle
            Route::get('/pasien/update/{pasien}', [PasienController::class, 'get_error']);
            Route::get('/pasien/delete/{pasien}', [PasienController::class, 'get_error']);
        });

        Route::group(['as' => 'registrasi'], function()
        {
            Route::get('/daftar', [AntrianController::class, 'index'])->name('_index');
            Route::post('/daftar', [AntrianController::class, 'store'])->name('_store');
            Route::delete('/daftar/delete/{antrian}', [AntrianController::class, 'destroy'])->name('_destroy');
            # Method Error Handle
            Route::get('/daftar/delete/{antrian}', [AntrianController::class, 'get_error']);
        });
    });

    // Level: Dokter //
    Route::group(['middleware' => ['ceklevel:dokter']], function()
    {
        Route::group(['as' => 'konsultasi'], function()
        {
            Route::get('/konsultasi/medicine', [ConsultationController::class, 'cariobat'])->name('_cari_obat'); //AJAX
            Route::get('/konsultasi/penyakit', [ConsultationController::class, 'caripenyakit'])->name('_cari_penyakit'); //AJAX
            Route::post('/konsultasi/update_antrian/{antrian}', [ConsultationController::class, 'update_antrian'])->name('_update_antrian');
            Route::get('/konsultasi/rekam', [ConsultationController::class, 'listrm'])->name('_list');
            Route::get('/konsultasi', [ConsultationController::class, 'index'])->name('_index');
            Route::get('/konsultasi/create', [ConsultationController::class, 'create'])->name('_create');
            Route::post('/konsultasi', [ConsultationController::class, 'store'])->name('_store');
            Route::get('/konsultasi/{konsultasi}', [ConsultationController::class, 'show'])->name('_show');
            Route::get('/konsultasi/resep/{resep}', [ConsultationController::class, 'resep'])->name('_resep');
            Route::post('/konsultasi/resep/store/{resep}', [ConsultationController::class, 'resep_store'])->name('_resep_store');
            Route::post('/konsultasi/resep/confirm/{resep}', [ConsultationController::class, 'resep_confirm'])->name('_resep_confirm');
            Route::patch('/konsultasi/resep/save', [ConsultationController::class, 'resep_save'])->name('_resep_save');
            Route::delete('/konsultasi/resep/delete', [ConsultationController::class, 'resep_delete'])->name('_resep_delete');
            Route::get('/konsultasi/resep/view/{konsultasi}', [ConsultationController::class, 'show_resep'])->name('_show_resep');
            # Method Error Handle
            Route::get('/konsultasi/update_antrian/{antrian}', [ConsultationController::class, 'get_error']);
            Route::get('/konsultasi/resep/store/{resep}', [ConsultationController::class, 'get_error']);
            Route::get('/konsultasi/resep/confirm/{resep}', [ConsultationController::class, 'get_error']);
            Route::get('/konsultasi/resep/save', [ConsultationController::class, 'get_error']);
            Route::get('/konsultasi/resep/delete', [ConsultationController::class, 'get_error']);
        });

        Route::group(['as' => 'penyakit'], function()
        {
            Route::get('/penyakit', [DiseaseController::class, 'index'])->name('_index');
            Route::get('/penyakit/create', [DiseaseController::class, 'create'])->name('_create');
            Route::post('/penyakit', [DiseaseController::class, 'store'])->name('_store');
            Route::get('/penyakit/{penyakit}', [DiseaseController::class, 'show'])->name('_show');
            Route::get('/penyakit/edit/{penyakit}', [DiseaseController::class, 'edit'])->name('_edit');
            Route::patch('/penyakit/update/{penyakit}', [DiseaseController::class, 'update'])->name('_update');
            Route::delete('/penyakit/delete/{penyakit}', [DiseaseController::class, 'destroy'])->name('_destroy');
            # Method Error Handle
            Route::get('/penyakit/update/{penyakit}', [DiseaseController::class, 'get_error']);
            Route::get('/penyakit/delete/{penyakit}', [DiseaseController::class, 'get_error']);
        });
    });

    // Level: Apoteker //
    Route::group(['middleware' => ['ceklevel:apoteker']], function()
    {
        Route::group(['as' => 'obat'], function()
        {
            Route::get('/obat', [MedicineController::class, 'index'])->name('_index');
            Route::get('/obat/create', [MedicineController::class, 'create'])->name('_create');
            Route::post('/obat', [MedicineController::class, 'store'])->name('_store');
            Route::get('/obat/edit/{obat}', [MedicineController::class, 'edit'])->name('_edit');
            Route::patch('/obat/update/{obat}', [MedicineController::class, 'update'])->name('_update');
            Route::get('/obat/stok', [MedicineController::class, 'sisastok'])->name('_stok');
            # Method Error Handle
            Route::get('/obat/update/{obat}', [MedicineController::class, 'get_error']);
        });

        Route::group(['as' => 'resep'], function()
        {
            Route::get('/resep', [ResepController::class, 'index'])->name('_index');
            Route::get('/resep/{resep}', [ResepController::class, 'show'])->name('_show');
            Route::post('/resep/confirm/{resep}', [ResepController::class, 'resep_confirm'])->name('_confirm');
            Route::post('/resep/antrian/{resep}', [ResepController::class, 'update_antrian'])->name('_update_antrian');
            # Method Error Handle
            Route::get('/resep/confirm/{resep}', [ResepController::class, 'get_error']);
            Route::get('/resep/antrian/{resep}', [ResepController::class, 'get_error']);
        });
    });

    Route::group(['middleware' => ['ceklevel:kasir']], function()
    {
        Route::group(['as' => 'invoice'], function()
        {
            Route::get('/invoice', [InvoiceController::class, 'index'])->name('_index');
            Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('_show');
        });
    });
});
