@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('konsultasi_show_resep', $consultation->id))

@section('content')
<div class="box p-5">
    <table class="table">
        <thead>
            <tr class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                <th width="10%">Kode Obat</th>
                <th width="20%">Nama Obat</th>
                <th>Isi Obat</th>
                <th width="20%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $reseps_count; $i++)
            <tr class="text-center align-middle">
                <td class="font-medium">{{ $isi_resep[$i][0] }}</td>
                <td>{{ $isi_resep[$i][1] }}</td>
                <td>{{ $isi_resep[$i][2] }}</td>
                <td>{{ $isi_resep[$i][3] }} {{ $isi_resep[$i][4] }}</td>
            </tr>
            @endfor
        </tbody>
    </table>
    <div class="mt-10">Status Resep:
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
</div>
@endsection
