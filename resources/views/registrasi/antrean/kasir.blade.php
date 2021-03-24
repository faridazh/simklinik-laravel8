@extends('templates.main')

@section('content')
<div class="w-1/4 ml-auto mr-auto">
    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-4xl font-medium truncate">Kasir</h2>
    </div>
    <div class="intro-y mt-12 sm:mt-5">
        @asyncWidget('antrean_apotek')
    </div>
</div>
@endsection
