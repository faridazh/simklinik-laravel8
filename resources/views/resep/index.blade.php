@extends('templates.main')

@section('content')
<div class="box p-5 overflow-x-auto">
    @asyncWidget('resep_index')
</div>
@endsection
