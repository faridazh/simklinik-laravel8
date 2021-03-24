@extends('templates.main')

@section('content')
<div class="box p-5">
    <form action="{{ route('pegawai_store') }}" method="post" class="grid grid-cols-12 gap-2">
        @csrf
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 lg:col-span-2 mb-3">
                    <label for="inputStaffID" class="form-label">Staff ID</label>
                    <input type="text" class="form-control text-center" id="inputStaffID" value="{{ $staffid }}" readonly disabled>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputUNama" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="inputUNama" name="username" value="{{ old('username') }}" autofocus>
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputNama" class="form-label">Nama Staff</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputNama" name="name" value="{{ old('name') }}">
        </div>
        <div class="col-span-12 sm:col-span-4 mb-3">
            <label for="inputLevel" class="form-label">Level</label>
            <select class="form-select @error('level') is-invalid @enderror" id="inputLevel" name="level">
                <option value="Administrator">Administrator</option>
                <option value="Apoteker">Apoteker</option>
                <option value="Dokter">Dokter</option>
                <option value="Kasir">Kasir</option>
                <option value="Resepsionis">Resepsionis</option>
                <option value="Staff" selected>Staff</option>
            </select>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputeMail" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputeMail" name="email" value="{{ old('email') }}">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputeConfirmMail" class="form-label">Konfirmasi Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputeConfirmMail" name="email_confirmation" value="">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputPass" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPass" name="password" value="">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputConfirmPass" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputConfirmPass" name="password_confirmation" value="">
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <button class="btn btn-primary" type="submit"><i class="fas fa-plus mr-2"></i> Tambah Staff</button>
            </div>
        </div>
    </form>
</div>
@endsection
