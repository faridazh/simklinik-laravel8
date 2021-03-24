@extends('templates.main')

@section('content')
<div class="box p-5">
    <form action="{{ route('pasien_update', $pasien->id) }}" method="post" class="grid grid-cols-12 gap-2">
        @method('patch')
        @csrf
        <div class="col-span-12 text-theme-1 text-lg font-medium">Identitas Pasien</div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputRekamMedis" class="form-label">Rekam Medis</label>
            <input type="text" class="form-control text-center font-medium" id="inputRekamMedis" value="{{ $pasien->norm }}" readonly disabled>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputNama" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="inputNama" name="nama" value="{{ $pasien->nama }}" autofocus>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputKelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select @error('kelamin') is-invalid @enderror" id="inputKelamin" name="kelamin">
                <option value="{{ $pasien->kelamin }}" selected readonly>{{ $pasien->kelamin }}</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputKK" class="form-label">Kepala Keluarga</label>
            <input type="text" class="form-control @error('headfamily') is-invalid @enderror" id="inputKK" name="headfamily" value="{{ $pasien->headfamily }}">
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputHubFamily" class="form-label">Hubungan Keluarga</label>
            <input type="text" class="form-control @error('hubfamily') is-invalid @enderror" id="inputHubFamily" name="hubfamily" value="{{ $pasien->hubfamily }}">
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputAgama" class="form-label">Agama</label>
            <select class="form-select @error('agama') is-invalid @enderror" id="inputAgama" name="agama">
                <option value="{{ $pasien->agama }}" selected readonly>{{ $pasien->agama }}</option>
                <option value="Islam">Islam</option>
                <option value="Protestantisme">Protestantisme</option>
                <option value="Katolisisme">Katolisisme</option>
                <option value="Hinduisme">Hinduisme</option>
                <option value="Buddhisme">Buddhisme</option>
                <option value="Konghucu">Konghucu</option>
                <option value="Tidak Beragama">Tidak Beragama</option>
            </select>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputTempatLahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control @error('tempatlahir') is-invalid @enderror" id="inputTempatLahir" name="tempatlahir" value="{{ $pasien->tempatlahir }}">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputTanggalLahir" class="form-label">Tanggal Lahir</label><small class="ml-3">Bulan/Tanggal/Tahun</small>
            <div class="input-group">
                <input type="date" class="form-control @error('datelahir') is-invalid @enderror" id="inputTanggalLahir" name="datelahir" value="{{ $pasien->datelahir }}">
                <span class="input-group-text text-center w-32" id="basic-addon2">{{ $umurDia }} Tahun</span>
            </div>
        </div>
        <div class="col-span-12 mb-3">
            <label for="inputAlamat" class="form-label">Alamat</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" id="inputAlamat" name="alamat" spellcheck="false" rows="3">{{ $pasien->alamat }}</textarea>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputTelepon" class="form-label">Telepon</label>
            <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="inputTelepon" name="telepon" value="{{ $pasien->telepon }}" maxlength="15">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputBPJS" class="form-label">BPJS</label>
            <input type="text" class="form-control @error('bpjs') is-invalid @enderror" id="inputBPJS" name="bpjs" value="{{ $pasien->bpjs }}" maxlength="13">
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputStatusNikah" class="form-label">Status Pernikahan</label>
            <select class="form-select @error('statusnikah') is-invalid @enderror" id="inputStatusNikah" name="statusnikah">
                <option value="{{ $pasien->statusnikah }}" selected readonly>{{ $pasien->statusnikah }}</option>
                <option value="Belum Menikah">Belum Menikah</option>
                <option value="Sudah Menikah">Sudah Menikah</option>
            </select>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputPendidikan" class="form-label">Pendidikan Terakhir</label>
            <select class="form-select @error('pendidikan') is-invalid @enderror" id="inputPendidikan" name="pendidikan">
                <option value="{{ $pasien->pendidikan }}" selected readonly>{{ $pasien->pendidikan }}</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="Diploma">Diploma</option>
                <option value="Sarjana">Sarjana</option>
            </select>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputKerja" class="form-label">Pekerjaan</label>
            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="inputKerja" name="pekerjaan" value="{{ $pasien->pekerjaan }}">
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="col-span-12 lg:col-span-6 mb-3">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 sm:col-span-6">
                    <label for="inputBerat" class="form-label">Berat Badan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('berat') is-invalid @enderror" id="inputBerat" name="berat" value="{{ $rmringan[0] }}">
                        <div class="input-group-text text-center w-16">Kg</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="inputTinggi" class="form-label">Tinggi Badan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('tinggi') is-invalid @enderror" id="inputTinggi" name="tinggi" value="{{ $rmringan[1] }}">
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
                        <input type="text" class="form-control @error('tensi_sistol') is-invalid @enderror" id="inputSistolik" name="tensi_sistol" value="{{ $rmringan[2] }}">
                        <div class="input-group-text text-center w-24">mmHg</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="inputDiastolik" class="form-label">Diastolik</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('tensi_diastol') is-invalid @enderror" id="inputDiastolik" name="tensi_diastol" value="{{ $rmringan[3] }}">
                        <div class="input-group-text text-center w-24">mmHg</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="inputPulse" class="form-label">Pulse</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('tensi_pulse') is-invalid @enderror" id="inputPulse" name="tensi_pulse" value="{{ $rmringan[4] }}">
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
                            <textarea class="form-control @error('alergi') is-invalid @enderror" id="inputAlergi" rows="3" name="alergi">{{ $pasien->alergi }}</textarea>
                        </div>
                        <div class="col-span-12 mb-3">
                            <label for="inputDeritaNow" class="form-label">Riwayat Penyakit Yang Diderita Saat Ini</label>
                            <textarea class="form-control @error('penyakitskrg') is-invalid @enderror" id="inputDeritaNow" rows="3" name="penyakitskrg">{{ $pasien->penyakitskrg }}</textarea>
                        </div>
                        <div class="col-span-12 mb-3">
                            <label for="inputPadaFamily" class="form-label">Riwayat Penyakit Pada Keluarga</label>
                            <textarea class="form-control @error('penyakitfamily') is-invalid @enderror" id="inputPadaFamily" rows="3" name="penyakitfamily">{{ $pasien->penyakitfamily }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="accordion col-span-12" id="accordion">
            <div class="accordion-item col-span-12">
                <div class="accordion-header">
                    <button class="accordion-button text-lg font-medium" type="button" data-bs-toggle="collapse" data-bs-target="#RiwayatImunisasi" aria-expanded="false" aria-controls="RiwayatImunisasi">Riwayat Imunisasi</button>
                </div>
                <div class="accordion-collapse" id="RiwayatImunisasi" data-bs-parent="#accordion" style="display: block;">
                    <div class="accordion-body grid grid-cols-12 gap-2">
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputBCG" class="form-label">BCG</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('imunisasi_bcg') is-invalid @enderror" id="inputBCG" placeholder="Usia..." name="imunisasi_bcg" value="{{ $imunisasi[0] }}">
                                <div class="input-group-text">Tahun</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputPolio" class="form-label">Polio</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('imunisasi_polio') is-invalid @enderror" id="inputPolio" placeholder="Usia..." name="imunisasi_polio" value="{{ $imunisasi[1] }}">
                                <div class="input-group-text">Tahun</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputHepatitis" class="form-label">Hepatitis</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('imunisasi_hepatitis') is-invalid @enderror" id="inputHepatitis" placeholder="Usia..." name="imunisasi_hepatitis" value="{{ $imunisasi[2] }}">
                                <div class="input-group-text">Tahun</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputDPT" class="form-label">DPT</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('imunisasi_dpt') is-invalid @enderror" id="inputDPT" placeholder="Frekuensi..." name="imunisasi_dpt" value="{{ $imunisasi[3] }}">
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputCampak" class="form-label">Campak</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('imunisasi_campak') is-invalid @enderror" id="inputCampak" placeholder="Frekuensi..." name="imunisasi_campak" value="{{ $imunisasi[4] }}">
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputDT" class="form-label">DT</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('imunisasi_dt') is-invalid @enderror" id="inputDT" placeholder="Frekuensi..." name="imunisasi_dt" value="{{ $imunisasi[5] }}">
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputCovid19" class="form-label">Covid-19</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('imunisasi_covid19') is-invalid @enderror" id="inputCovid19" placeholder="Frekuensi..." name="imunisasi_covid19" value="{{ $imunisasi[6] }}">
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
                            <input type="text" class="form-control @error('kb_suntik') is-invalid @enderror" id="inputSuntik" placeholder="Sejak Tahun..." name="kb_suntik" value="{{ $kb_riwayat[0] }}">
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputImplant" class="form-label">Implant</label>
                            <input type="text" class="form-control @error('kb_implant') is-invalid @enderror" id="inputImplant" placeholder="Sejak Tahun..." name="kb_implant" value="{{ $kb_riwayat[1] }}">
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputTubektomi" class="form-label">Tubektomi</label>
                            <input type="text" class="form-control @error('kb_tubektomi') is-invalid @enderror" id="inputTubektomi" placeholder="Sejak Tahun..." name="kb_tubektomi" value="{{ $kb_riwayat[2] }}">
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputParitas" class="form-label">Paritas</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('kb_paritas') is-invalid @enderror" id="inputParitas" placeholder="Frekuensi..." name="kb_paritas" value="{{ $kb_riwayat[3] }}">
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputPil" class="form-label">Pil</label>
                            <input type="text" class="form-control @error('kb_pil') is-invalid @enderror" id="inputPil" placeholder="Sejak Tahun..." name="kb_pil" value="{{ $kb_riwayat[4] }}">
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputAKDR" class="form-label">AKDR</label>
                            <input type="text" class="form-control @error('kb_akdr') is-invalid @enderror" id="inputAKDR" placeholder="Sejak Tahun..." name="kb_akdr" value="{{ $kb_riwayat[5] }}">
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputVasektomi" class="form-label">Vasektomi</label>
                            <input type="text" class="form-control @error('kb_vasektomi') is-invalid @enderror" id="inputVasektomi" placeholder="Sejak Tahun..." name="kb_vasektomi" value="{{ $kb_riwayat[6] }}">
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mb-3">
                            <label for="inputAbortus" class="form-label">Abortus</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('kb_abortus') is-invalid @enderror" id="inputAbortus" placeholder="Frekuensi..." name="kb_abortus" value="{{ $kb_riwayat[7] }}">
                                <div class="input-group-text">Kali</div>
                            </div>
                        </div>
                        <div class="col-span-12 mb-3">
                            <label for="inputkb_operasi" class="form-label">Operasi</label>
                            <textarea class="form-control @error('kb_operasi') is-invalid @enderror" id="inputkb_operasi" rows="1" name="kb_operasi">{{ $pasien->kb_operasi }}</textarea>
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
                                    <input type="text" class="form-control @error('riwayatrawat_tempat') is-invalid @enderror" placeholder="Tempat operasi..." name="riwayatrawat_tempat" value="{{ $riwayatrawat[0] }}">
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <input type="date" class="form-control @error('riwayatrawat_date') is-invalid @enderror" id="inputRiwayatOperasi" name="riwayatrawat_date" value="{{ $riwayatrawat[1] }}">
                                </div>
                            </div>
                            <input type="text" class="form-control mt-3 @error('riwayatrawat_alasan') is-invalid @enderror" placeholder="Alasan operasi..." name="riwayatrawat_alasan" value="{{ $riwayatrawat[2] }}">
                        </div>
                        <div class="col-span-12 lg:col-span-6 mb-3">
                            <label for="inputRiwayatRawat" class="form-label">Riwayat Rawat</label>
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-12 sm:col-span-6">
                                    <input type="text" class="form-control @error('riwayatoperasi_tempat') is-invalid @enderror" placeholder="Tempat rawat..." name="riwayatoperasi_tempat" value="{{ $riwayatoperasi[0] }}">
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <input type="date" class="form-control @error('riwayatoperasi_date') is-invalid @enderror" id="inputRiwayatRawat" name="riwayatoperasi_date" value="{{ $riwayatoperasi[1] }}">
                                </div>
                            </div>
                            <input type="text" class="form-control mt-3 @error('riwayatoperasi_alasan') is-invalid @enderror" placeholder="Alasan rawat..." name="riwayatoperasi_alasan" value="{{ $riwayatoperasi[2] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <button class="btn btn-success" type="submit" name="submit"><i class="fas fa-save mr-2"></i> Simpan Data</button>
            </div>
        </div>
    </form>
</div>
@endsection
