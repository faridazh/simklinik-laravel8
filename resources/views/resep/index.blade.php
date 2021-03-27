@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('resep_index'))

@section('content')
<div class="flex justify-center mb-10">
    <div class="box p-5 w-auto lg:w-1/2 flex flex-col justify-center items-center">
        @asyncWidget('antri_resep')
    </div>
</div>
<div class="box p-5 overflow-x-auto">
    @asyncWidget('resep_index')
</div>
@endsection
