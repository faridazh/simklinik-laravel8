@extends('templates.main')

@section('meta_csrf')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="box p-5 mb-10 w-1/2 mx-auto">
    <div class="mb-5">
        <div class="text-xl font-bold">Tambah Obat</div>
        <div class="">Menambahkan obat ke resep</div>
    </div>
    <form class="flex" action="{{ route('konsultasi_resep_store', $id) }}" method="post">
        @csrf
        <input type="hidden" name="code" value="{{ $consultation->code }}">
        <input type="hidden" name="norm" value="{{ $consultation->norm }}">
        <input type="hidden" name="nama" value="{{ $consultation->nama }}">
        <div class="input-group w-full">
            <div class="input-group-text text-center w-24">Cari Obat</div>
            <input type="text" class="form-control" id="inputCariObat" list="ObatList" name="namaobat" autocomplete="off">
            <datalist id="ObatList"></datalist>
        </div>
        <button type="submit" class="btn btn-primary ml-3">Tambah</button>
    </form>
</div>

<div class="box p-5 overflow-x-auto">
    <table class="table">
        <thead>
            <tr class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                <th width="10%">Kode Obat</th>
                <th width="20%">Nama Obat</th>
                <th>Isi Obat</th>
                <th width="20%">Jumlah</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $reseps_count; $i++)
            <tr class="border-b dark:border-dark-5 whitespace-nowrap text-center">
                <td class="font-medium">{{ $isi_resep[$i][0] }}</td>
                <td>{{ $isi_resep[$i][1] }}</td>
                <td>{{ $isi_resep[$i][2] }}</td>
                <td>
                    <form class="me-2" action="{{ route('konsultasi_resep_save') }}" method="post">
                        @method('patch')
                        @csrf
                        <input type="hidden" name="id" value="{{ $resep_id[$i] }}">
                        <div class="input-group">
                            <input type="number" class="form-control text-center" name="jumlah" value="{{ $isi_resep[$i][3] }}" autocomplete="off">
                            <div class="input-group-text">{{ $isi_resep[$i][4] }}</div>
                        </div>
                    </form>
                </td>
                <td class="flex justify-center">
                    <form action="{{ route('konsultasi_resep_delete') }}" method="post">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id" value="{{ $resep_id[$i] }}">
                        <input type="hidden" name="code" value="{{ $isi_resep[$i][0] }}">
                        <input type="hidden" name="namaobat" value="{{ $isi_resep[$i][1] }}">
                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
    <div class="flex mt-10 items-center">
        <div class="mr-auto">* Klik <em class="font-medium">Enter</em> untuk merubah jumlah obat.</div>
        <form action="{{ route('konsultasi_resep_confirm', $id) }}" method="post">
            @csrf
            <button class="btn btn-primary" type="submit"><i class="fas fa-plus mr-2"></i> Konfirmasi Resep</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#inputCariObat').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
            type: 'get',
            url: '{{ route("konsultasi_cari_obat") }}',
            data: {'cari':$value},
            success:function(data){
                $('#ObatList').html(data);
            }
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection
