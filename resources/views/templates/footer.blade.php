            </div>
        </div>
        <footer class="text-right py-5 px-3">
            <div class="font-medium text-gray-500"><i class="far fa-code"></i> Developed by Farid Azhar.</div>
        </footer>
        @if(config('setting.darkmode') == 'on')
        <div data-url="{{route('darkmode')}}" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
            <div class="dark-mode-switcher__toggle @dark dark-mode-switcher__toggle--active @enddark border"></div>
        </div>
        @endif
        @notauth
            @include('user.loginmodal')
        @endnotauth
        @include('sweetalert::alert')
        <script src="{{asset('assets/js/app.js')}}" type="text/javascript"></script>
    </body>
</html>
