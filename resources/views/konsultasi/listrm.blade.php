@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('konsultasi_list', $consultations[0]->norm))

@section('content')
<div class="box p-5">
    @foreach($consultations as $consultation)
    <div class="accordion col-span-12" id="accordion">
        <div class="accordion-item col-span-12">
            <div class="accordion-header">
                <button class="accordion-button text-lg font-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#RekamMedis-{{ $consultation->id }}" aria-expanded="false" aria-controls="RekamMedis-{{ $consultation->id }}">{{ date('j M, Y, h:i:s A', strtotime($consultation->created_at)) }}</button>
            </div>
            <div class="accordion-collapse collapse" id="RekamMedis-{{ $consultation->id }}" data-bs-parent="#accordion" style="display: none;">
                <div class="accordion-body grid grid-cols-12 gap-2">
                    <div class="col-span-12 sm:col-span-6 mb-3">
                        <label for="inputDiagnosa" class="form-label">Diagnosa</label>
                        <input type="text" class="form-control" id="inputDiagnosa" value="{{ $consultation->diagnosa }}" readonly>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mb-3">
                        <label for="inputDiagnosaLain" class="form-label">Diagnosa Lain</label>
                        <textarea class="form-control" id="inputDiagnosaLain" rows="@if($consultation->diagnosalain === null) 1 @else 3 @endif" readonly>{{ $consultation->diagnosalain }}</textarea>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mb-3">
                        <label for="inputAnamnesis" class="form-label">Anamnesis</label>
                        <textarea class="form-control" id="inputAnamnesis" rows="3" readonly>{{ $consultation->anamnesis }}</textarea>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mb-3">
                        <label for="inputTindakan" class="form-label">Tindakan</label>
                        <textarea class="form-control" id="inputTindakan" rows="3" readonly>{{ $consultation->tindakan }}</textarea>
                    </div>
                </div>
                @if(in_array($consultation->resep, ['Sedang', 'Sudah']))
                <div class="col-span-12">
                    <div class="flex mt-5 justify-end">
                        <a class="btn btn-primary" href="{{ route('konsultasi_show_resep', $consultation->id) }}" target="_blank"><i class="fas fa-eye mr-2"></i> Lihat Resep</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-12 mt-2 mb-5"><hr></div>
    @endforeach
</div>
@endsection
