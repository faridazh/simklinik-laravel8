@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('konsultasi_show', $consultation->id))

@section('content')
<div class="box p-5">
    <div class="grid grid-cols-12 gap-2">
        @csrf
        <div class="col-span-12 sm:col-span-3 mb-3">
            <label for="inputnorm" class="form-label">No. Rekam Medis</label>
            <input type="text" class="form-control text-center" id="inputnorm" value="{{ $consultation->norm }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-3 mb-3">
            <label for="inputNama" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control text-center" id="inputNama" value="{{ $consultation->nama }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-3 mb-3">
            <label for="inputTanggal" class="form-label">Tanggal</label>
            <div class="input-group">
                <div class="input-group-text my-auto">
                    <i class="far fa-calendar"></i>
                </div>
                <input class="datepicker form-control" id="inputTanggal" value="{{ $consultation->tanggal }}" data-single-mode="true" readonly>
                <div class="litepicker-backdrop"></div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-3 mb-3">
            <label for="inputResep" class="form-label">Resep</label>
            <input type="text" class="form-control" id="inputResep" value="{{ $consultation->resep }}" readonly>
        </div>
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
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputDiagnosa" class="form-label">Diagnosa</label>
            <input type="text" class="form-control" id="inputDiagnosa" value="{{ $consultation->diagnosa }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputDiagnosaLain" class="form-label">Diagnosa Lain</label>
            <textarea class="form-control" id="inputDiagnosaLain" rows="5" readonly>{{ $consultation->diagnosalain }}</textarea>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputAnamnesis" class="form-label">Anamnesis</label>
            <textarea class="form-control" id="inputAnamnesis" rows="5" readonly>{{ $consultation->anamnesis }}</textarea>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputTindakan" class="form-label">Tindakan</label>
            <textarea class="form-control" id="inputTindakan" rows="5" readonly>{{ $consultation->tindakan }}</textarea>
        </div>
        <div class="col-span-12">
            <div class="flex mt-5">
                <div class="mr-auto my-auto">Status Resep:
                    @if($consultation->resep == 'Tidak')
                    <span class="px-2 py-1 text-xs px-1 bg-theme-1 font-medium text-white rounded">{{ $consultation->resep }}</span>
                    @elseif($consultation->resep == 'Belum')
                    <span class="px-2 py-1 text-xs px-1 bg-theme-6 font-medium text-white rounded">{{ $consultation->resep }}</span>
                    @elseif($consultation->resep == 'Sedang')
                    <span class="px-2 py-1 text-xs px-1 bg-theme-12 font-medium text-gray-700 dark:text-gray-600 rounded">{{ $consultation->resep }}</span>
                    @elseif($consultation->resep == 'Sudah')
                    <span class="px-2 py-1 text-xs px-1 bg-theme-3 font-medium text-white rounded">{{ $consultation->resep }}</span>
                    @endif
                </div>
                @if(in_array($consultation->resep, ['Belum']))
                <a class="btn btn-primary ms-auto me-3" href="{{ route('konsultasi_resep', $consultation->id) }}"><i class="fas fa-file-medical mr-2"></i> Buat Resep</a>
                @elseif(in_array($consultation->resep, ['Sedang', 'Sudah']))
                <a class="btn btn-primary ms-auto me-3" href="{{ route('konsultasi_show_resep', $consultation->id) }}"><i class="fas fa-eye mr-2"></i> Lihat Resep</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
