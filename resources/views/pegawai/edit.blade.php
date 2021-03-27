@extends('templates.main')

@section('breadcrumb', Breadcrumbs::render('pegawai_edit', $pegawai->id))

@section('content')
<div class="box p-5">
    <form class="grid grid-cols-12 gap-2" action="{{ route('pegawai_update', $pegawai->id) }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 lg:col-span-2 mb-3">
                    <label for="inputStaffID" class="form-label">Staff ID</label>
                    <input type="text" class="form-control text-center" id="inputStaffID" value="{{ $pegawai->staffid }}" readonly disabled>
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
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="inputUname" name="username" value="{{ old('username') ?? $pegawai->username }}">
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputNama" class="form-label">Nama Staff</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputNama" name="name" value="{{ old('name') ?? $pegawai->name }}">
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputLevel" class="form-label">Level</label>
            <select class="form-select @error('level') is-invalid @enderror" id="inputLevel" name="level">
                <option value="{{ $pegawai->level }}" selected>{{ $pegawai->level }}</option>
                <option value="Administrator">Administrator</option>
                <option value="Apoteker">Apoteker</option>
                <option value="Dokter">Dokter</option>
                <option value="Kasir">Kasir</option>
                <option value="Resepsionis">Resepsionis</option>
                <option value="Staff">Staff</option>
            </select>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputeMail" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputeMail" name="email" value="{{ old('email') ?? $pegawai->email }}">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputeConfirmMail" class="form-label">Konfirmasi Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputeConfirmMail" name="email_confirmation" value="{{ old('email_confirmation') ?? $pegawai->email }}">
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <button class="btn btn-warning" type="submit"><i class="fas fa-edit mr-2"></i> Edit Data</button>
                <a class="btn btn-danger ml-2" href="{{ route('pegawai_forgot_password', $pegawai->id) }}"><i class="fas fa-lock mr-2"></i> Reset Password</a>
            </div>
        </div>
    </form>
</div>
@endsection
