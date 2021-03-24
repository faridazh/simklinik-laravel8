            </div>
        </div>
        <footer class="text-right py-5 px-3">
            <div class="font-medium text-gray-500"><i class="far fa-code"></i> Developed by Farid Azhar.</div>
        </footer>
        @notauth
            @include('user.loginmodal')
        @endnotauth
        @include('sweetalert::alert')
        <script src="{{asset('assets/js/app.js')}}" type="text/javascript"></script>
    </body>
</html>
