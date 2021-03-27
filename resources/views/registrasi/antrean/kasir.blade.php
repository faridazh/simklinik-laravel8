@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('antrean_kasir'))

@section('content')
<div class="w-auto ml-auto mr-auto sm:w-3/4 lg:w-1/2">
    <div class="intro-y block sm:flex items-center h-10">
        <h2 class="text-4xl font-medium truncate">Kasir</h2>
    </div>
    <div class="intro-y mt-12 sm:mt-5">
        @asyncWidget('antrean_apotek')
    </div>
</div>
@endsection
