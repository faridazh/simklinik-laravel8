@extends('templates.main')

@section('content')
<div class="box p-5">
    <form class="grid grid-cols-12 gap-2" action="{{ route('myprofile_update') }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 lg:col-span-2 mb-3">
                    <label for="inputStaffID" class="form-label">Staff ID</label>
                    <input type="text" class="form-control text-center" id="inputStaffID" value="{{ $myprofile->staffid }}" readonly>
                </div>
                <div class="col-span-12 lg:col-span-4 mb-3">
                    <label for="inputAvatar" class="form-label">Avatar</label>
                    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" accept="image/x-png,image/gif,image/jpeg">
                    <div class="form-help @error('avatar') text-invalid @enderror">* Maksimal {{ $maxsize }} & {{ $maxdimensions }}</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputUNama" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="inputUname" name="username" value="{{ old('username') ?? $myprofile->username }}">
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputNama" class="form-label">Nama Staff</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputNama" name="name" value="{{ old('name') ?? $myprofile->name }}">
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputLevel" class="form-label">Level</label>
            <input type="text" class="form-control" id="inputLevel" value="{{ $myprofile->level }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputeMail" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputeMail" name="email" value="{{ old('email') ?? $myprofile->email }}">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputeConfirmMail" class="form-label">Konfirmasi Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputeConfirmMail" name="email_confirmation" value="{{ old('email_confirmation') ?? $myprofile->email }}">
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <button class="btn btn-primary" type="submit"><i class="fas fa-save mr-2"></i> Simpan</button>
                <a class="btn btn-danger ml-2" href="{{ route('myprofile_reset_pass') }}"><i class="fas fa-lock mr-2"></i> Reset Password</a>
            </div>
        </div>
    </form>
</div>
@endsection
