@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('login'))

@section('content')
<div class="box p-5 ml-auto mr-auto w-full sm:w-3/4 lg:w-1/2">
    <div class="text-center mb-10">
        <div class="text-4xl font-bold">SIM Klinik</div>
        <div class="text-lg font-meidum">Sistem Informasi Manajemen Klinik</div>
    </div>
    <form action="{{ route('postlogin') }}" method="post">
        @csrf
        <div class="form-inline">
        	<label for="inputUsername" class="form-label sm:w-20 font-medium">Username</label>
            <div class="input-group w-full">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="inputUsername" name="username" value="{{ old('username') }}">
                <div id="input-group-price" class="input-group-text"><i class="far fa-user"></i></div>
            </div>
        </div>
        <div class="form-inline mt-5">
        	<label for="inputPassword" class="form-label sm:w-20 font-medium">Password</label>
            <div class="input-group w-full">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password">
                <div id="input-group-price" class="input-group-text"><i class="far fa-lock"></i></div>
            </div>
        </div>
        <div class="form-check sm:ml-20 sm:pl-5 mt-5">
        	<input id="rememberCheck" class="form-check-input" type="checkbox" name="rememberMe" checked>
        	<label class="form-check-label" for="rememberCheck">Remember me</label>
        </div>
        <div class="flex mt-5 items-center">
            <div class="">
                <a href="#" class="text-theme-1 dark:text-theme-10 tooltip" title="Reset password">Lupa Password</a>
            </div>
            <div class="ml-auto">
            	<button class="btn btn-primary" type="submit"><i class="far fa-sign-in-alt mr-2"></i> Login</button>
            </div>
        </div>
    </form>
</div>
@endsection
