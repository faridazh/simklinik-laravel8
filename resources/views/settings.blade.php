@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('pengaturan'))

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Website</h2>
            </div>
            <div class="p-5">
                <form action="{{route('settings_update_website')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div>
                        <label for="inputWebname" class="form-label">Nama Website</label>
                        <input id="inputWebname" type="text" class="form-control @error('webname') is-invalid @enderror" name="webname" value="{{ config('setting.webname') ?? 'SIM Klinik' }}">
                    </div>
                    <div class="mt-5">
                        <label for="inputLogo" class="form-label">Logo Website</label>
                        <input type="file" name="weblogo" accept="image/x-png,image/gif,image/jpeg" class="form-control @error('weblogo') is-invalid @enderror">
                        <div class="form-help @error('weblogo') text-invalid @enderror">* Maksimal {{ $logo_maxSize }}</div>
                    </div>
                    <div class="mt-5">
                        <label for="inputFavicon" class="form-label">Icon Website</label>
                        <input type="file" name="favicon" accept="image/x-png,image/gif,image/jpeg" class="form-control @error('favicon') is-invalid @enderror">
                        <div class="form-help @error('favicon') text-invalid @enderror">* Maksimal {{ $icon_maxSize }}</div>
                    </div>
                    <div class="mt-5">
                        <label for="inputDark" class="form-label">Dark Mode</label>
                        <div class="form-check mt-1">
                            <span class="form-check-label ml-0">OFF</span>
                            <input id="inputDark" class="form-check-switch ml-3 mr-1 @error('darkmode') text-invalid @enderror" type="checkbox" name="darkmode" @if(config('setting.darkmode') == 'on') checked @endif>
                            <span class="form-check-label">ON</span>
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt mr-2"></i> Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="intro-y box mt-8">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Dokter</h2>
            </div>
            <div class="p-5">
                <form action="{{route('settings_update_dokter')}}" method="post">
                    @csrf
                    @method('patch')
                    <div>
                        <label for="inputDokterJaga" class="form-label">Dokter Jaga</label>
                        <select id="inputDokterJaga" class="tail-select w-full @error('dokterjaga') is-invalid @enderror" name="dokterjaga" data-search="true">
                            @if(config('setting.dokterjaga') != null)<option value="{{ config('setting.dokterjaga') }}" selected>{{ config('setting.dokterjaga') }}</option>@endif
                            @foreach($dokters as $dokter)
                            <option value="{{ $dokter->namagelar }}">{{ $dokter->namagelar }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-5">
                        <label for="inputFeeDokter" class="form-label">Fee Dokter</label>
                        <div class="input-group">
                            <div class="input-group-text">{{ config('setting.currency') }}</div>
                            <input id="inputFeeDokter" type="number" class="form-control @error('fee_dokter') is-invalid @enderror" name="fee_dokter" value="{{ config('setting.fee_dokter') ?? '0' }}">
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt mr-2"></i> Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Obat</h2>
            </div>
            <div class="p-5">
                <form action="{{route('settings_update_obat')}}" method="post">
                    @csrf
                    @method('patch')
                    <div>
                        <label for="inputPersentaseJual" class="form-label">Persentase Jual</label>
                        <div class="input-group">
                            <input id="inputPersentaseJual" type="number" class="form-control @error('harga_jual') is-invalid @enderror" name="harga_jual" value="{{ config('setting.harga_jual') ?? '0' }}">
                            <div class="input-group-text">%</div>
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt mr-2"></i> Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="intro-y box mt-8">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Kasir</h2>
            </div>
            <div class="p-5">
                <form action="{{route('settings_update_kasir')}}" method="post">
                    @csrf
                    @method('patch')
                    <div>
                        <label for="inputCurrency" class="form-label">Mata Uang</label>
                        <input id="inputCurrency" type="text" class="form-control @error('currency') is-invalid @enderror" name="currency" value="{{ config('setting.currency') ?? 'Rp.' }}">
                    </div>
                    <div class="mt-5 flex justify-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt mr-2"></i> Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="intro-y box mt-8">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Profile</h2>
            </div>
            <div class="p-5">
                <form action="{{route('settings_update_profile')}}" method="post">
                    @csrf
                    @method('patch')
                    <div>
                        <label for="inputSize" class="form-label">Maksimal Ukuran Avatar</label>input
                        <div class="input-group">
                            <input id="inputSize" type="number" class="form-control @error('max_size') is-invalid @enderror" name="max_size" value="{{ config('setting.max_size') ?? '0' }}">
                            <div class="input-group-text">KB</div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <label for="inputHeight" class="form-label">Maksimal Tinggi Avatar</label>
                        <div class="input-group">
                            <input id="inputHeight" type="number" class="form-control @error('max_height') is-invalid @enderror" name="max_height" value="{{ config('setting.max_height') ?? '0' }}">
                            <div class="input-group-text">Pixel</div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <label for="inputWidth" class="form-label">Maksimal Lebar Avatar</label>
                        <div class="input-group">
                            <input id="inputWidth" type="number" class="form-control @error('max_width') is-invalid @enderror" name="max_width" value="{{ config('setting.max_width') ?? '0' }}">
                            <div class="input-group-text">Pixel</div>
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt mr-2"></i> Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="intro-y box">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">Input</h2>
        </div>
        <div class="p-5">
            <form class="" action="#" method="post">

            </form>
        </div>
    </div> -->
</div>

@endsection
