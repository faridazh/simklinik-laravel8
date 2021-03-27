@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('konsultasi_create'))

@section('meta_csrf')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="box p-5">
    <form class="grid grid-cols-12 gap-2" action="{{ route('konsultasi_store') }}" method="post">
        @csrf
        <div class="col-span-12 sm:col-span-3 mb-3">
            <label for="inputnorm" class="form-label">No. Rekam Medis</label>
            <input type="text" class="form-control text-center @error('norm') is-invalid @enderror" id="inputnorm" name="norm" value="{{ $antrian->norm }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-3 mb-3">
            <label for="inputNama" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control text-center @error('nama') is-invalid @enderror" id="inputNama" name="nama" value="{{ $antrian->nama }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-3 mb-3">
            <label for="inputTanggal" class="form-label">Tanggal</label>
            <div class="input-group">
                <div class="input-group-text my-auto">
                    <i class="far fa-calendar"></i>
                </div>
                <input class="datepicker form-control" id="inputTanggal" data-single-mode="true" readonly>
                <div class="litepicker-backdrop"></div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-3 mb-3">
            <label class="form-label">Resep</label>
            <div class="flex flex-col sm:flex-row mt-2">
                <div class="form-check mr-2">
                    <input class="form-check-input" type="radio" name="resep" id="radioResepYes" value="Belum" checked>
                    <label class="form-check-label @error('resep') color-invalid @enderror" for="radioResepYes">Ada Resep</label>
                </div>
                <div class="form-check mr-2 mt-2 sm:mt-0">
                    <input class="form-check-input" type="radio" name="resep" id="radioResepNo" value="Tidak">
                    <label class="form-check-label @error('resep') color-invalid @enderror" for="radioResepNo">Tidak Ada</label>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 mb-3">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 sm:col-span-6">
                    <label for="inputBerat" class="form-label">Berat Badan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('berat') is-invalid @enderror" id="inputBerat" name="berat" value="{{ old('berat') ?? $rmringan[0] }}">
                        <div class="input-group-text text-center w-16">Kg</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="inputTinggi" class="form-label">Tinggi Badan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('tinggi') is-invalid @enderror" id="inputTinggi" name="tinggi" value="{{ old('tinggi') ?? $rmringan[1] }}">
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
                        <input type="text" class="form-control @error('tensi_sistol') is-invalid @enderror" id="inputSistolik" name="tensi_sistol" value="{{ old('tensi_sistol') ?? $rmringan[2] }}">
                        <div class="input-group-text text-center w-24">mmHg</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="inputDiastolik" class="form-label">Diastolik</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('tensi_diastol') is-invalid @enderror" id="inputDiastolik" name="tensi_diastol" value="{{ old('tensi_diastol') ?? $rmringan[3] }}">
                        <div class="input-group-text text-center w-24">mmHg</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="inputPulse" class="form-label">Pulse</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('tensi_pulse') is-invalid @enderror" id="inputPulse" name="tensi_pulse" value="{{ old('tensi_pulse') ?? $rmringan[4] }}">
                        <div class="input-group-text text-center w-24">/menit</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputDiagnosa" class="form-label">Diagnosa</label>
            <input type="text" class="form-control @error('diagnosa') is-invalid @enderror" list="ICD10List" id="inputDiagnosa" name="diagnosa" value="{{ old('diagnosa') }}" autocomplete="off">
            <datalist id="ICD10List"></datalist>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputDiagnosaLain" class="form-label">Diagnosa Lain</label>
            <textarea class="form-control @error('diagnosalain') is-invalid @enderror" id="inputDiagnosaLain" name="diagnosalain" rows="3">{{ old('diagnosalain') }}</textarea>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputAnamnesis" class="form-label">Anamnesis</label>
            <textarea class="form-control @error('anamnesis') is-invalid @enderror" id="inputAnamnesis" name="anamnesis" rows="3">{{ old('anamnesis') }}</textarea>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputTindakan" class="form-label">Tindakan</label>
            <textarea class="form-control @error('tindakan') is-invalid @enderror" id="inputTindakan" name="tindakan" rows="3">{{ old('tindakan') }}</textarea>
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Tambah Data</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $("document").ready(()=>{
        $('#inputDiagnosa').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route("konsultasi_cari_penyakit") }}',
                data: {'disease':$value},
                success:function(data){
                    $('#ICD10List').html(data);
                }
            });
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection
