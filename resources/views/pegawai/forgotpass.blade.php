@extends('templates.main')

@section('content')
<div class="box p-5">
    <form class="grid grid-cols-12 gap-2" action="{{ route('pegawai_update_password', $pegawai->id) }}" method="post">
        @method('patch')
        @csrf
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 lg:col-span-2 mb-3">
                    <label for="inputStaffID" class="form-label">Staff ID</label>
                    <input type="text" class="form-control text-center" id="inputStaffID" value="{{ $pegawai->staffid }}" readonly disabled>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputUNama" class="form-label">Username</label>
            <input type="text" class="form-control text-center" id="inputUNama" value="{{ $pegawai->username }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputNama" class="form-label">Nama Staff</label>
            <input type="text" class="form-control text-center" id="inputNama" value="{{ $pegawai->name }}" readonly>
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputPass" class="form-label">Password Baru</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPass" name="password" value="">
        </div>
        <div class="col-span-12 sm:col-span-6 mb-3">
            <label for="inputConfirmPass" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputConfirmPass" name="password_confirmation" value="">
        </div>
        <div class="col-span-12">
            <div class="flex mt-5 justify-end">
                <button class="btn btn-danger" type="submit"><i class="fas fa-lock mr-2"></i> Perbarui Password</button>
            </div>
        </div>
    </form>
</div>
@endsection
