@extends('templates.main')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="col-span-12 sm:col-span-6 xl:col-span-4">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-4xl font-medium truncate">Dokter</h2>
        </div>
        <div class="intro-y mt-12 sm:mt-5">
            @asyncWidget('antrean_dokter')
        </div>
    </div>
    <div class="col-span-12 sm:col-span-6 xl:col-span-4">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-4xl font-medium truncate">Apotek</h2>
        </div>
        <div class="intro-y mt-12 sm:mt-5">
            @asyncWidget('antrean_apotek')
        </div>
    </div>
    <div class="col-span-12 sm:col-span-6 xl:col-span-4">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-4xl font-medium truncate">Kasir</h2>
        </div>
        <div class="intro-y mt-12 sm:mt-5">
            @asyncWidget('antrean_kasir')
        </div>
    </div>
</div>
@endsection
