<?php

// .
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Beranda', route('home'));
});
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});
Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push('Tentang Kami', route('about'));
});
Breadcrumbs::for('pengaturan', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Pengaturan', route('settings_index'));
});


// Dokter
Breadcrumbs::for('dokter_index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Dokter', route('dokter_index'));
});
Breadcrumbs::for('dokter_create', function ($trail) {
    $trail->parent('dokter_index');
    $trail->push('Baru', route('dokter_create'));
});
Breadcrumbs::for('dokter_show', function ($trail, $id) {
    $trail->parent('dokter_index');
    $trail->push('Detail', route('dokter_show', $id));
});
Breadcrumbs::for('dokter_edit', function ($trail, $id) {
    $trail->parent('dokter_show', $id);
    $trail->push('Edit', route('dokter_edit', $id));
});


// Kasir
Breadcrumbs::for('invoice_index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Invoice', route('invoice_index'));
});

// Konsultasi
Breadcrumbs::for('konsultasi_index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Konsultasi', route('konsultasi_index'));
});
Breadcrumbs::for('konsultasi_create', function ($trail) {
    $trail->parent('konsultasi_index');
    $trail->push('Baru', route('konsultasi_create'));
});
Breadcrumbs::for('konsultasi_show', function ($trail, $id) {
    $trail->parent('konsultasi_index');
    $trail->push('Detail', route('konsultasi_show', $id));
});
Breadcrumbs::for('konsultasi_resep', function ($trail, $id) {
    $trail->parent('konsultasi_show', $id);
    $trail->push('Buat Resep', route('konsultasi_resep', $id));
});
Breadcrumbs::for('konsultasi_show_resep', function ($trail, $id) {
    $trail->parent('konsultasi_show', $id);
    $trail->push('Isi Resep', route('konsultasi_show_resep', $id));
});
Breadcrumbs::for('konsultasi_list', function ($trail, $id) {
    $trail->parent('konsultasi_index');
    $trail->push('Rekam Medis', route('konsultasi_list', $id));
});


// obat
Breadcrumbs::for('obat_index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Obat', route('obat_index'));
});
Breadcrumbs::for('obat_create', function ($trail) {
    $trail->parent('obat_index');
    $trail->push('Baru', route('obat_create'));
});
Breadcrumbs::for('obat_stok', function ($trail) {
    $trail->parent('obat_index');
    $trail->push('Stok', route('obat_stok'));
});
Breadcrumbs::for('obat_edit', function ($trail, $id) {
    $trail->parent('obat_index');
    $trail->push('Edit', route('obat_edit', $id));
});


// Pasien
Breadcrumbs::for('pasien_index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Pasien', route('pasien_index'));
});
Breadcrumbs::for('pasien_create', function ($trail) {
    $trail->parent('pegawai_index');
    $trail->push('Baru', route('pasien_create'));
});
Breadcrumbs::for('pasien_show', function ($trail, $id) {
    $trail->parent('pasien_index');
    $trail->push('Detail', route('pasien_show', $id));
});
Breadcrumbs::for('pasien_edit', function ($trail, $id) {
    $trail->parent('pasien_show', $id);
    $trail->push('Edit', route('pasien_edit', $id));
});


// Pegawai
Breadcrumbs::for('pegawai_index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Staff', route('pegawai_index'));
});
Breadcrumbs::for('pegawai_create', function ($trail) {
    $trail->parent('pegawai_index');
    $trail->push('Baru', route('pegawai_create'));
});
Breadcrumbs::for('pegawai_show', function ($trail, $id) {
    $trail->parent('pegawai_index');
    $trail->push('Profile', route('pegawai_show', $id));
});
Breadcrumbs::for('pegawai_edit', function ($trail, $id) {
    $trail->parent('pegawai_show', $id);
    $trail->push('Edit', route('pegawai_edit', $id));
});
Breadcrumbs::for('pegawai_reset_pass', function ($trail, $id) {
    $trail->parent('pegawai_edit', $id);
    $trail->push('Reset Password', route('pegawai_update_password', $id));
});


// Penyakit
Breadcrumbs::for('penyakit_index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Penyakit', route('penyakit_index'));
});
Breadcrumbs::for('penyakit_create', function ($trail) {
    $trail->parent('penyakit_index');
    $trail->push('Baru', route('penyakit_create'));
});
Breadcrumbs::for('penyakit_show', function ($trail, $id) {
    $trail->parent('penyakit_index');
    $trail->push('Detail', route('penyakit_show', $id));
});
Breadcrumbs::for('penyakit_edit', function ($trail, $id) {
    $trail->parent('penyakit_show', $id);
    $trail->push('Edit', route('penyakit_edit', $id));
});


// Registrasi
Breadcrumbs::for('registrasi', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Registrasi', route('registrasi_index'));
});
Breadcrumbs::for('antrean_semua', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Antrian', route('antrean'));
});
Breadcrumbs::for('antrean_apotek', function ($trail) {
    $trail->parent('antrean_semua');
    $trail->push('Apotek', route('antrean_apotek'));
});
Breadcrumbs::for('antrean_dokter', function ($trail) {
    $trail->parent('antrean_semua');
    $trail->push('Dokter', route('antrean_dokter'));
});
Breadcrumbs::for('antrean_kasir', function ($trail) {
    $trail->parent('antrean_semua');
    $trail->push('Kasir', route('antrean_kasir'));
});


// Resep
Breadcrumbs::for('resep_index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Resep', route('resep_index'));
});
Breadcrumbs::for('resep_show', function ($trail, $id) {
    $trail->parent('resep_index');
    $trail->push('Racik', route('resep_show', $id));
});


// User
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('home');
    $trail->push('Login', route('login'));
});
Breadcrumbs::for('myprofile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('myprofile_index'));
});
Breadcrumbs::for('edit_myprofile', function ($trail) {
    $trail->parent('myprofile');
    $trail->push('Edit', route('myprofile_edit'));
});
Breadcrumbs::for('reset_pass_myprofile', function ($trail) {
    $trail->parent('edit_myprofile');
    $trail->push('Reset Password', route('myprofile_reset_pass'));
});
