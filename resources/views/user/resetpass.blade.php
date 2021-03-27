@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('reset_pass_myprofile'))

@section('content')
<div class="box p-5 w-1/2 mx-auto">
    <form class="grid grid-cols-12 gap-2" action="{{ route('myprofile_update_pass') }}" method="post">
        @method('patch')
        @csrf
        <div class="col-span-12 lg:col-span-6 mb-3">
            <label for="inputStaffID" class="form-label">Staff ID</label>
            <input type="text" class="form-control text-center" id="inputStaffID" value="{{ $myprofile->staffid }}" readonly>
        </div>
        <div class="col-span-12 lg:col-span-6 mb-3">
            <label for="inputUsername" class="form-label">Username</label>
            <input type="text" class="form-control text-center" id="inputUsername" value="{{ $myprofile->username }}" readonly>
        </div>
        <div class="col-span-12 lg:col-span-6 mb-3">
            <label for="inputPass" class="form-label">Password:</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPass" name="password" value="">
        </div>
        <div class="col-span-12 lg:col-span-6 mb-3">
            <label for="inputConfirmPass" class="form-label">Password:</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputConfirmPass" name="password_confirmation" value="">
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <button class="btn btn-danger" type="submit"><i class="fas fa-lock mr-2"></i> Reset Password</button>
            </div>
        </div>
    </form>
</div>
@endsection
