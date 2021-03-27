@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('obat_create'))

@section('content')
<div class="box p-5">
    <form class="grid grid-cols-12 gap-2" action="{{ route('obat_store') }}" method="post">
        @csrf
        <div class="col-span-12 mb-3">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 sm:col-span-4 mb-3">
                    <label for="inputCode" class="form-label">Kode Obat</label>
                    <input type="text" class="form-control text-center" id="inputCode" placeholder="Auto Generate" readonly disabled>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputNama" class="form-label">Nama Obat</label>
            <input type="text" class="form-control @error('namaobat') is-invalid @enderror" id="inputNama" name="namaobat" value="{{ old('namaobat') }}">
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputGolongan" class="form-label">Golongan Obat</label>
            <select class="form-select @error('golongan') is-invalid @enderror" name="golongan" id="inputGolongan">
                <option value="Bebas" selected>Bebas</option>
                <option value="Bebas Terbatas">Bebas Terbatas</option>
                <option value="Fitofarmaka">Fitofarmaka</option>
                <option value="Golongan Narkotik">Golongan Narkotik</option>
                <option value="Herbal Terstandar (OHT)">Herbal Terstandar (OHT)</option>
                <option value="Herbal (Jamu)">Herbal (Jamu)</option>
                <option value="Keras">Keras</option>
            </select>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputJenis" class="form-label">Jenis Obat</label>
            <select class="form-select @error('jenis') is-invalid @enderror" name="jenis" id="inputJenis">
                <option value="Drops">Drops</option>
                <option value="Gas">Gas</option>
                <option value="Gel">Gel</option>
                <option value="Injeksi">Injeksi</option>
                <option value="Kaplet">Kaplet</option>
                <option value="Kapsul">Kapsul</option>
                <option value="Koyo">Koyo</option>
                <option value="Krim">Krim</option>
                <option value="Larutan">Larutan</option>
                <option value="Pil">Pil</option>
                <option value="Puyer">Puyer</option>
                <option value="Salep">Salep</option>
                <option value="Sirop">Sirop</option>
                <option value="Spray">Spray</option>
                <option value="Suntik">Suntik</option>
                <option value="Tablet" selected>Tablet</option>
            </select>
        </div>
        <div class="col-span-12">
            <label for="inputIsi" class="form-label">Isi Obat</label>
            <textarea class="form-control @error('isiobat') is-invalid @enderror" id="inputIsi" name="isiobat" rows="3">{{ old('isiobat') }}</textarea>
        </div>
        <div class="col-span-12 mt-2 mb-5"><hr></div>
        <div class="col-span-12 lg:col-span-4 mb-3">
            <label for="inputStok" class="form-label">Stok Obat</label>
            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="inputStok" name="stok" value="{{ old('stok') ?? '0' }}">
        </div>
        <div class="col-span-12 lg:col-span-4 mb-3">
            <label for="inputBeli" class="form-label">Harga Beli</label>
            <div class="input-group">
                <div class="input-group-text text-center">{{config('setting.currency')}}</div>
                <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" id="inputBeli" name="harga_beli" value="{{ old('harga_beli') ?? '0' }}">
                <div class="input-group-text text-center">/pcs</div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-4 mb-3">
            <label for="inputJual" class="form-label">Harga Jual</label>
            <div class="input-group">
                <div class="input-group-text text-center">{{config('setting.currency')}}</div>
                <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="inputJual" name="harga_jual" value="{{ old('harga_jual') ?? '0' }}">
                <div class="input-group-text text-center">/pcs</div>
            </div>
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <button class="btn btn-primary" type="submit"><i class="fas fa-plus mr-2"></i> Tambah Obat</button>
            </div>
        </div>
    </form>
</div>
<script>
  $("#inputBeli").on("keyup", function() {
      var hargaBeli = parseInt($("#inputBeli").val());
      var hargaJual = hargaBeli + (hargaBeli * {{config('setting.harga_jual')}} / 100) || '0';
      // var fix_harga = ret.toString().replace(/(\d)(?=(\d{3})+(\d{3})+(?!\d))/g, "$1.");
      $("#inputJual").val(hargaJual);
  });
</script>
@endsection
