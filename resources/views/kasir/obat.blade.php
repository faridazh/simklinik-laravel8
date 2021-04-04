@extends('templates.main')

@section('meta_csrf')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection

@section('content')
<div class="box p-5 mb-10 w-1/2 mx-auto">
    <div class="mb-5">
        <div class="text-xl font-bold">Tambah Obat</div>
        <div class="">Menambahkan obat ke resep</div>
    </div>
    <form class="flex" action="" method="post">
        @csrf
        <div class="input-group w-full">
            <div class="input-group-text text-center w-24">Cari Obat</div>
            <input type="text" class="form-control" id="inputCariObat" list="ObatList" name="namaobat" autocomplete="off">
            <datalist id="ObatList"></datalist>
        </div>
        <button type="submit" class="btn btn-primary ml-3"><i class="fas fa-plus mr-2"></i> Tambah</button>
    </form>
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
