<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="@dark dark @else light @enddark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta_csrf')

        @if(config('setting.favicon') != null)<link rel="shortcut icon" href="{{ asset('uploads/images'.'/'.config('setting.favicon')) }}">@endif

        <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/fonts/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css">

        <script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
        @yield('chart')
        @yield('jscript')

        <title>{{ $pagetitle }} - {{ config('setting.webname') }}</title>
    </head>
    <body id="{{ $pageid }}" class="main">
        @include('templates.mobile-nav')
        <div class="flex">
            @include('templates.navbar')
            <div class="content">
                <div class="top-bar mb-6 noPrint">
                    <div class="breadcrumb mr-auto hidden sm:flex">
                        @yield('breadcrumb')
                    </div>
                    @authcheck
                    <div class="intro-x dropdown w-8 h-8">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false">
                            <img src="{{asset('uploads/avatar'.'/'.Auth::user()->avatar)}}" onerror="this.src='{{asset('assets/images/default_avatar.png')}}';">
                        </div>
                        <div class="dropdown-menu w-56">
                            <div class="dropdown-menu__content box bg-theme-26 dark:bg-dark-6 text-white">
                                <div class="p-4 border-b border-theme-27 dark:border-dark-3">
                                    <div class="font-medium">{{ Auth::user()->username }}</div>
                                    <div class="text-xs text-theme-28 mt-0.5 dark:text-gray-600">{{ Auth::user()->level }}</div>
                                </div>
                                <div class="p-2">
                                    <a href="{{route('myprofile_index')}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                    <a href="{{route('myprofile_reset_pass')}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                                    @staff
                                    <a href="{{route('settings_index')}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i class="fal fa-cog w-4 h-4 mr-2"></i> Pengaturan </a>
                                    @endstaff
                                </div>
                                <div class="p-2 border-t border-theme-27 dark:border-dark-3">
                                    <a href="{{route('logout')}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="power" class="w-4 h-4 mr-2"></i> Logout </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <a class="btn btn-outline-primary" data-toggle="modal" data-target="#login-modal"><i class="far fa-sign-in-alt mr-2"></i> Login</a>
                    @endauthcheck
                </div>
                @if(!Request::routeIs('dashboard','login','home','invoice_show'))
                <div class="mb-6">
                    <div class="text-3xl font-bold mr-auto">{!! $pagetitle !!}</div>
                    <div class="text-lg font-medium mr-auto">{!! $pagedesc !!}</div>
                </div>
                @endif
