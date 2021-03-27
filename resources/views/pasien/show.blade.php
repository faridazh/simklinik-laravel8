@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('pasien_show', $pasien->id))

@section('content')
<div class="box p-5">
    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-12 text-theme-1 text-lg font-medium">Identitas Pasien</div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputRekamMedis" class="form-label">Rekam Medis</label>
            <input type="text" class="form-control text-center font-medium" id="inputRekamMedis" value="{{ $pasien->norm }}" readonly disabled>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputNama" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control" id="inputNama" value="{{ $pasien->nama }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputKelamin" class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control" id="inputKelamin" value="{{ $pasien->kelamin }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputKK" class="form-label">Kepala Keluarga</label>
            <input type="text" class="form-control" id="inputKK" value="{{ $pasien->headfamily }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputHubFamily" class="form-label">Hubungan Keluarga</label>
            <input type="text" class="form-control" id="inputHubFamily" value="{{ $pasien->hubfamily }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputAgama" class="form-label">Agama</label>
            <input type="text" class="form-control" id="inputAgama" value="{{ $pasien->agama }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputTempatLahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="inputTempatLahir" value="{{ $pasien->tempatlahir }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputTanggalLahir" class="form-label">Tanggal Lahir</label><small class="ml-3">Bulan/Tanggal/Tahun</small>
            <div class="input-group">
                <input type="date" class="form-control" id="inputTanggalLahir" value="{{ $pasien->datelahir }}" readonly>
                <span class="input-group-text text-center w-32" id="basic-addon2">{{ $umurDia }} Tahun</span>
            </div>
        </div>
        <div class="col-span-12 mb-3">
            <label for="inputAlamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="inputAlamat" spellcheck="false" rows="3" readonly>{{ $pasien->alamat }}</textarea>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputTelepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="inputTelepon" value="{{ $pasien->telepon }}" maxlength="15" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputBPJS" class="form-label">BPJS</label>
            <input type="text" class="form-control" id="inputBPJS" value="{{ $pasien->bpjs }}" maxlength="13" readonly>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputStatusNikah" class="form-label">Status Pernikahan</label>
            <input type="text" class="form-control" id="inputStatusNikah" value="{{ $pasien->statusnikah }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputPendidikan" class="form-label">Pendidikan Terakhir</label>
            <input type="text" class="form-control" id="inputPendidikan" value="{{ $pasien->pendidikan }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputKerja" class="form-label">Pekerjaan</label>
            <input type="text" class="form-control" id="inputKerja" value="{{ $pasien->pekerjaan }}" readonly>
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="col-span-12 lg:col-span-6 mb-3">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 sm:col-span-6">
                    <label for="inputBerat" class="form-label">Berat Badan</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputBerat" value="{{ $rmringan[0] }}" readonly>
                        <div class="input-group-text text-center w-16">Kg</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="inputTinggi" class="form-label">Tinggi Badan</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputTinggi" value="{{ $rmringan[1] }}" readonly>
                        <div class="input-group-text text-center w-16">Cm</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 mb-3">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 sm:col-span-4">
                    <label for="inputSistolik" class="form-label">Sistolik</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputSistolik" value="{{ $rmringan[2] }}" readonly>
                        <div class="input-group-text text-center w-24">mmHg</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="inputDiastolik" class="form-label">Diastolik</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputDiastolik" value="{{ $rmringan[3] }}" readonly>
                        <div class="input-group-text text-center w-24">mmHg</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="inputPulse" class="form-label">Pulse</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputPulse" value="{{ $rmringan[4] }}" readonly>
                        <div class="input-group-text text-center w-24">/menit</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="accordion col-span-12" id="accordion">
            <div class="accordion-item col-span-12">
                <div class="accordion-header">
                    <button class="accordion-button text-lg font-medium" type="button" data-bs-toggle="collapse" data-bs-target="#RiwayatPenyakit" aria-expanded="false" aria-controls="RiwayatPenyakit">Riwayat Penyakit</button>
                </div>
                <div class="accordion-collapse" id="RiwayatPenyakit" data-bs-parent="#accordion" style="display: block;">
                    <div class="accordion-body grid grid-cols-12 gap-2">
                        <div class="col-span-12 mb-3">
                            <label for="inputAlergi" class="form-label">Alergi</label>
                            <textarea class="form-control" id="inputAlergi" rows="3" readonly>{{ $pasien->alergi }}</textarea>
                        </div>
                        <div class="col-span-12 mb-3">
                            <label for="inputDeritaNow" class="form-label">Riwayat Penyakit Yang Diderita Saat Ini</label>
                            <textarea class="form-control" id="inputDeritaNow" rows="3" readonly>{{ $pasien->penyakitskrg }}</textarea>
                        </div>
                        <div class="col-span-12 mb-3">
                            <label for="inputPadaFamily" class="form-label">Riwayat Penyakit Pada Keluarga</label>
                            <textarea class="form-control" id="inputPadaFamily" rows="3" readonly>{{ $pasien->penyakitfamily }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="accordion col-span-12" id="accordion">
            <div class="accordion-item col-span-12">
                <div class="accordion-header">
                    <button class="accordion-button text-lg font-medium" type="button" data-bs-toggle="collapse" data-bs-target="#RiwayatImunisasi" aria-expanded="false" aria-controls="RiwayatImunisasi" readonly>Riwayat Imunisasi</button>
                </div>
                <div class="accordion-collapse" id="RiwayatImunisasi" data-bs-parent="#accordion" style="display: block;">
                    <div class="accordion-body grid grid-cols-12 gap-2">
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputBCG" class="form-label">BCG</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputBCG" placeholder="Usia..." value="{{ $imunisasi[0] }}" readonly>
                                <div class="input-group-text">Tahun</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputPolio" class="form-label">Polio</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputPolio" placeholder="Usia..." value="{{ $imunisasi[1] }}" readonly>
                                <div class="input-group-text">Tahun</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputHepatitis" class="form-label">Hepatitis</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputHepatitis" placeholder="Usia..." value="{{ $imunisasi[2] }}" readonly>
                                <div class="input-group-text">Tahun</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputDPT" class="form-label">DPT</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputDPT" placeholder="Frekuensi..." value="{{ $imunisasi[3] }}" readonly>
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputCampak" class="form-label">Campak</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputCampak" placeholder="Frekuensi..." value="{{ $imunisasi[4] }}" readonly>
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputDT" class="form-label">DT</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputDT" placeholder="Frekuensi..." value="{{ $imunisasi[5] }}" readonly>
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputCovid19" class="form-label">Covid-19</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputCovid19" placeholder="Frekuensi..." value="{{ $imunisasi[6] }}" readonly>
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="accordion col-span-12" id="accordion">
            <div class="accordion-item col-span-12">
                <div class="accordion-header">
                    <button class="accordion-button text-lg font-medium" type="button" data-bs-toggle="collapse" data-bs-target="#RiwayatKB" aria-expanded="false" aria-controls="RiwayatKB">Riwayat Keluarga Berencana / Kandungan</button>
                </div>
                <div class="accordion-collapse" id="RiwayatKB" data-bs-parent="#accordion" style="display: block;">
                    <div class="accordion-body grid grid-cols-12 gap-2">
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputSuntik" class="form-label">Suntik</label>
                            <input type="text" class="form-control" id="inputSuntik" placeholder="Sejak Tahun..." value="{{ $kb_riwayat[0] }}" readonly>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputImplant" class="form-label">Implant</label>
                            <input type="text" class="form-control" id="inputImplant" placeholder="Sejak Tahun..." value="{{ $kb_riwayat[1] }}" readonly>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputTubektomi" class="form-label">Tubektomi</label>
                            <input type="text" class="form-control" id="inputTubektomi" placeholder="Sejak Tahun..." value="{{ $kb_riwayat[2] }}" readonly>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputParitas" class="form-label">Paritas</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputParitas" placeholder="Frekuensi..." value="{{ $kb_riwayat[3] }}" readonly>
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputPil" class="form-label">Pil</label>
                            <input type="text" class="form-control" id="inputPil" placeholder="Sejak Tahun..." value="{{ $kb_riwayat[4] }}" readonly>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputAKDR" class="form-label">AKDR</label>
                            <input type="text" class="form-control" id="inputAKDR" placeholder="Sejak Tahun..." value="{{ $kb_riwayat[5] }}" readonly>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputVasektomi" class="form-label">Vasektomi</label>
                            <input type="text" class="form-control" id="inputVasektomi" placeholder="Sejak Tahun..." value="{{ $kb_riwayat[6] }}" readonly>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputAbortus" class="form-label">Abortus</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputAbortus" placeholder="Frekuensi..." value="{{ $kb_riwayat[7] }}" readonly>
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                        <div class="col-span-12 mb-3">
                            <label for="inputkb_operasi" class="form-label">Operasi</label>
                            <textarea class="form-control" id="inputkb_operasi" rows="1" readonly>{{ $pasien->kb_operasi }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="accordion col-span-12" id="accordion">
            <div class="accordion-item col-span-12">
                <div class="accordion-header">
                    <button class="accordion-button text-lg font-medium" type="button" data-bs-toggle="collapse" data-bs-target="#RiwayatLain" aria-expanded="false" aria-controls="RiwayatLain">Riwayat Operasi & Riwayat Rawat</button>
                </div>
                <div class="accordion-collapse" id="RiwayatLain" data-bs-parent="#accordion" style="display: block;">
                    <div class="accordion-body grid grid-cols-12 gap-2">
                        <div class="col-span-12 lg:col-span-6 mb-3">
                            <label for="inputRiwayatOperasi" class="form-label">Riwayat Operasi</label>
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-12 sm:col-span-6">
                                    <input type="text" class="form-control" placeholder="Tempat operasi..." value="{{ $riwayatrawat[0] }}" readonly>
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <input type="date" class="form-control" id="inputRiwayatOperasi" value="{{ $riwayatrawat[1] }}" readonly>
                                </div>
                            </div>
                            <input type="text" class="form-control mt-3" placeholder="Alasan operasi..." value="{{ $riwayatrawat[2] }}" readonly>
                        </div>
                        <div class="col-span-12 lg:col-span-6 mb-3">
                            <label for="inputRiwayatRawat" class="form-label">Riwayat Rawat</label>
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-12 sm:col-span-6">
                                    <input type="text" class="form-control" placeholder="Tempat rawat..." value="{{ $riwayatoperasi[0] }}" readonly>
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <input type="date" class="form-control" id="inputRiwayatRawat" value="{{ $riwayatoperasi[1] }}" readonly>
                                </div>
                            </div>
                            <input type="text" class="form-control mt-3" placeholder="Alasan rawat..." value="{{ $riwayatoperasi[2] }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <a class="btn btn-warning" role="button" href="{{ route('pasien_edit', $pasien->id) }}"><i class="fas fa-edit mr-2"></i> Edit Data</a>
                <a href="javascript:;" data-toggle="modal" data-target="#delete-modal" class="btn btn-danger ml-2"><i class="fas fa-trash-alt mr-2"></i> Hapus Data</a>
            </div>
        </div>
    </div>
</div>
<div id="delete-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <a data-dismiss="modal" href="javascript:;"><i data-feather="x" class="w-8 h-8 text-gray-500"></i></a>
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Apakah anda yakin?</div>
                    <div class="text-gray-600 mt-2">Apakah anda benar-benar ingin menghapus data ini? <br>Proses ini tidak dapat dibatalkan.</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Batal</button>
                    <form action="{{ route('pasien_destroy', $pasien->id) }}" method="post" class="inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt mr-2"></i> Hapus Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
