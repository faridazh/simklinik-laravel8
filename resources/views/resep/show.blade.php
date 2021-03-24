@extends('templates.main')

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
    <div class="flex mt-10 justify-end">
        <form action="{{ route('resep_confirm', $rmcode) }}" method="post">
            @csrf
            <button class="btn btn-success text-gray-800 dark:text-gray-700" type="submit"><i class="fas fa-check mr-2"></i> Selesai</button>
        </form>
    </div>
</div>
@endsection
