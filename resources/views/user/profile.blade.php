@extends('templates.main')

@section('content')

<div class="box pb-5 px-5 w-1/2 mx-auto">
    <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5">
        <div class="flex flex-1 p-5 items-center justify-center lg:justify-start">
            <div class="w-16 h-16 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                <img class="rounded-full" src="{{asset('uploads/avatar'.'/'.Auth::user()->avatar)}}" onerror="this.src='{{asset('uploads/avatar/default_avatar.png')}}';">
            </div>
            <div class="ml-5">
                <div class="sm:whitespace-normal font-medium text-lg lg:text-3xl">{{$myprofile->username}}</div>
                <div class="text-gray-600 sm:text-lg">{{$myprofile->level}}</div>
            </div>
        </div>
        <div class="flex-1 dark:text-gray-300 px-5 lg:border-l border-gray-200 dark:border-dark-5 border-t lg:border-t-0 py-5 lg:pb-0 lg:pt-0 my-auto">
            <div class="flex flex-col justify-center items-center lg:items-start">
                <div class="truncate sm:whitespace-normal flex items-center"><i class="far fa-id-badge mr-3"></i> {{$myprofile->staffid}}</div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3"><i class="far fa-user mr-3"></i> {{$myprofile->name}}</div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3"><i class="far fa-envelope mr-3"></i> {{$myprofile->email}}</div>
            </div>
        </div>
    </div>
    <div class="flex flex-col lg:flex-row text-center justify-center pt-5">
        <a href="{{ route('myprofile_edit') }}" class="mb-2 lg:mb-0 bg-theme-12 rounded px-2 py-1"><i class="fas fa-edit"></i> Edit Profile</a>
        <a href="{{ route('myprofile_reset_pass') }}" class="lg:ml-2 bg-theme-6 text-white rounded px-2 py-1"><i class="fas fa-edit"></i> Reset Password</a>
    </div>
</div>
@endsection
