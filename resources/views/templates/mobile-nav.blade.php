<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{ asset('uploads/images'.'/'.config('setting.weblogo')) }}" onerror="this.src='{{asset('assets/images/logo.png')}}';">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"><i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i></a>
    </div>
    <ul class="border-t border-theme-29 py-5 hidden">
        @authcheck
        <li>
            <a href="{{route('dashboard')}}" class="menu menu{{Request::routeIs('dashboard') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-home fa-fw text-lg"></i></div>
                <div class="menu__title">Dashboard</div>
            </a>
        </li>
        @else
        <li>
            <a href="{{route('home')}}" class="menu menu{{Request::routeIs('home') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-home fa-fw text-lg"></i></div>
                <div class="menu__title">Beranda</div>
            </a>
        </li>
        <li>
            <a href="{{route('login')}}" class="menu menu{{Request::routeIs('login') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-sign-in-alt fa-fw text-lg"></i></div>
                <div class="menu__title">Login</div>
            </a>
        </li>
        <li>
            <a href="{{route('about')}}" class="menu menu{{Request::routeIs('about') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-info fa-fw text-lg"></i></div>
                <div class="menu__title">Tentang Kami</div>
            </a>
        </li>
        @endauthcheck
        @resepsionis
        <li>
            <a href="javascript:;" class="menu menu{{Request::routeIs('registrasi_index','antrean_apotek','antrean_dokter','antrean_kasir','antrean') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-chair fa-fw text-lg"></i></div>
                <div class="menu__title">Antrian
                    <div class="menu__sub-icon"><i data-feather="chevron-down"></i></div>
                </div>
            </a>
            <ul class="{{Request::routeIs('registrasi_index','antrean_apotek','antrean_dokter','antrean_kasir','antrean') ? 'menu__sub-open' : ''}}">
                <li>
                    <a href="{{route('registrasi_index')}}" class="menu menu{{Request::routeIs('registrasi_index') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('registrasi_index') ? 'fas' : 'fal'}} fa-plus fa-fw text-lg"></i></div>
                        <div class="menu__title">Antrian Baru</div>
                    </a>
                </li>
                <li class="menu__devider my-6"></li>
                <li>
                    <a href="{{route('antrean_apotek')}}" class="menu menu{{Request::routeIs('antrean_apotek') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('antrean_apotek') ? 'fas' : 'fal'}} fa-dot-circle fa-fw text-lg"></i></div>
                        <div class="menu__title">Antrian Apotek</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('antrean_dokter')}}" class="menu menu{{Request::routeIs('antrean_dokter') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('antrean_dokter') ? 'fas' : 'fal'}} fa-dot-circle fa-fw text-lg"></i></div>
                        <div class="menu__title">Antrian Dokter</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('antrean_kasir')}}" class="menu menu{{Request::routeIs('antrean_kasir') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('antrean_kasir') ? 'fas' : 'fal'}} fa-dot-circle fa-fw text-lg"></i></div>
                        <div class="menu__title">Antrian Kasir</div>
                    </a>
                </li>
                <li class="menu__devider my-6"></li>
                <li>
                    <a href="{{route('antrean')}}" class="menu menu{{Request::routeIs('antrean') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('antrean') ? 'fas' : 'fal'}} fa-dot-circle fa-fw text-lg"></i></div>
                        <div class="menu__title">Semua Antrian</div>
                    </a>
                </li>
            </ul>
        </li>
        @endresepsionis
        @staff
        <li>
            <a href="javascript:;" class="menu menu{{Request::routeIs('dokter_index','dokter_show','dokter_edit') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-user-md fa-fw text-lg"></i></div>
                <div class="menu__title">Dokter
                    <div class="menu__sub-icon"><i data-feather="chevron-down"></i></div>
                </div>
            </a>
            <ul class="{{Request::routeIs('dokter_index','dokter_create','dokter_show','dokter_edit') ? 'menu__sub-open' : ''}}">
                <li>
                    <a href="{{route('dokter_create')}}" class="menu menu{{Request::routeIs('dokter_create') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('dokter_create') ? 'fas' : 'fal'}} fa-plus fa-fw text-lg"></i></div>
                        <div class="menu__title">Dokter Baru</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('dokter_index')}}" class="menu menu{{Request::routeIs('dokter_index','dokter_show','dokter_edit') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('dokter_index','dokter_show','dokter_edit') ? 'fas' : 'fal'}} fa-dot-circle fa-fw text-lg"></i></div>
                        <div class="menu__title">Data Dokter</div>
                    </a>
                </li>
            </ul>
        </li>
        @endstaff
        @dokter
        <li>
            <a href="{{route('konsultasi_index')}}" class="menu menu{{Request::routeIs('konsultasi_index','konsultasi_create','konsultasi_show','konsultasi_resep','konsultasi_show_resep','konsultasi_list') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-stethoscope fa-fw text-lg"></i></div>
                <div class="menu__title">Konsultasi</div>
            </a>
        </li>
        @enddokter
        @apoteker
        <li>
            <a href="javascript:;" class="menu menu{{Request::routeIs('obat_index','obat_edit','obat_create','obat_stok') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-capsules fa-fw text-lg"></i></div>
                <div class="menu__title">Obat
                    <div class="menu__sub-icon"><i data-feather="chevron-down"></i></div>
                </div>
            </a>
            <ul class="{{Request::routeIs('obat_index','obat_edit','obat_create','obat_stok') ? 'menu__sub-open' : ''}}">
                <li>
                    <a href="{{route('obat_create')}}" class="menu menu{{Request::routeIs('obat_create') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('obat_create') ? 'fas' : 'fal'}} fa-plus fa-fw text-lg"></i></div>
                        <div class="menu__title">Obat Baru</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('obat_index')}}" class="menu menu{{Request::routeIs('obat_index','obat_edit') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('obat_index','obat_edit') ? 'fas' : 'fal'}} fa-dot-circle fa-fw text-lg"></i></div>
                        <div class="menu__title">Data Obat</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('obat_stok')}}" class="menu menu{{Request::routeIs('obat_stok') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('obat_stok') ? 'fas' : 'fal'}} fa-dot-circle fa-fw text-lg"></i></div>
                        <div class="menu__title">Stok Obat</div>
                    </a>
                </li>
            </ul>
        </li>
        @endapoteker
        @resepsionis
        <li>
            <a href="javascript:;" class="menu menu{{Request::routeIs('pasien_index','pasien_create','pasien_show','pasien_edit') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-user-injured fa-fw text-lg"></i></div>
                <div class="menu__title">Pasien
                    <div class="menu__sub-icon"><i data-feather="chevron-down"></i></div>
                </div>
            </a>
            <ul class="{{Request::routeIs('pasien_index','pasien_create','pasien_show','pasien_edit') ? 'menu__sub-open' : ''}}">
                <li>
                    <a href="{{route('pasien_create')}}" class="menu menu{{Request::routeIs('pasien_create') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('pasien_create') ? 'fas' : 'fal'}} fa-plus fa-fw text-lg"></i></div>
                        <div class="menu__title">Pasien Baru</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('pasien_index')}}" class="menu menu{{Request::routeIs('pasien_index','pasien_show','pasien_edit') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('pasien_index','pasien_show','pasien_edit') ? 'fas' : 'fal'}} fa-dot-circle fa-fw text-lg"></i></div>
                        <div class="menu__title">Data Pasien</div>
                    </a>
                </li>
            </ul>
        </li>
        @endresepsionis
        @staff
        <li>
            <a href="javascript:;" class="menu menu{{Request::routeIs('penyakit_index','penyakit_show','penyakit_edit') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-viruses fa-fw text-lg"></i></div>
                <div class="menu__title">Penyakit
                    <div class="menu__sub-icon"><i data-feather="chevron-down"></i></div>
                </div>
            </a>
            <ul class="{{Request::routeIs('penyakit_index','penyakit_create','penyakit_show','penyakit_edit') ? 'menu__sub-open' : ''}}">
                <li>
                    <a href="{{route('penyakit_create')}}" class="menu menu{{Request::routeIs('penyakit_create') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('penyakit_create') ? 'fas' : 'fal'}} fa-plus fa-fw text-lg"></i></div>
                        <div class="menu__title">Penyakit Baru</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('penyakit_index')}}" class="menu menu{{Request::routeIs('penyakit_index','penyakit_show','penyakit_edit') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('penyakit_index','penyakit_show','penyakit_edit') ? 'fas' : 'fal'}} fa-dot-circle fa-fw text-lg"></i></div>
                        <div class="menu__title">Data Penyakit</div>
                    </a>
                </li>
            </ul>
        </li>
        @endstaff
        @apoteker
        <li>
            <a href="{{route('resep_index')}}" class="menu menu{{Request::routeIs('resep_index','resep_show') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-mortar-pestle fa-fw text-lg"></i></div>
                <div class="menu__title">Resep</div>
            </a>
        </li>
        @endapoteker
        @admin
        <li>
            <a href="javascript:;" class="menu menu{{Request::routeIs('pegawai_index','pegawai_create','pegawai_show','pegawai_edit','pegawai_forgot_password') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-user-tie fa-fw text-lg"></i></div>
                <div class="menu__title">Staff
                    <div class="menu__sub-icon"><i data-feather="chevron-down"></i></div>
                </div>
            </a>
            <ul class="{{Request::routeIs('pegawai_index','pegawai_create','pegawai_show','pegawai_edit','pegawai_forgot_password') ? 'menu__sub-open' : ''}}">
                <li>
                    <a href="{{route('pegawai_create')}}" class="menu menu{{Request::routeIs('pegawai_create') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('pegawai_create') ? 'fas' : 'fal'}} fa-plus fa-fw text-lg"></i></div>
                        <div class="menu__title">Staff Baru</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('pegawai_index')}}" class="menu menu{{Request::routeIs('pegawai_index','pegawai_show','pegawai_edit','pegawai_forgot_password') ? '--active' : ''}}">
                        <div class="menu__icon"><i class="{{Request::routeIs('pegawai_index','pegawai_show','pegawai_edit','pegawai_forgot_password') ? 'fas' : 'fal'}} fa-dot-circle fa-fw text-lg"></i></div>
                        <div class="menu__title">Data Staff</div>
                    </a>
                </li>
            </ul>
        </li>
        @endadmin
        @staff
        <li>
            <a href="{{route('settings_index')}}" class="menu menu{{Request::routeIs('settings_index') ? '--active' : ''}}">
                <div class="menu__icon"><i class="fal fa-cog fa-fw text-lg"></i></div>
                <div class="menu__title">Pengaturan</div>
            </a>
        </li>
        @endstaff
    </ul>
</div>
