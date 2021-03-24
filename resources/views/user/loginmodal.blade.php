<div id="login-modal" class="modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="font-medium text-base mr-auto">Login</h2>
				<a data-dismiss="modal" href="javascript:;"><i data-feather="x" class="w-8 h-8 text-gray-500"></i></a>
			</div>
            <form action="{{ route('postlogin') }}" method="post" class="mx-5">
                @csrf
    			<div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
    				<div class="col-span-12 sm:col-span-6">
                        <label for="inputUsernameModal" class="form-label font-medium">Username</label>
						<div class="input-group w-full">
							<div id="input-group-price" class="input-group-text"><i class="far fa-user"></i></div>
	                        <input type="text" class="form-control" id="inputUsernameModal" name="username" value="{{ old('username') }}">
				        </div>
                    </div>
    				<div class="col-span-12 sm:col-span-6">
    					<label for="inputPasswordModal" class="form-label font-medium">Password</label>
						<div class="input-group w-full">
							<div id="input-group-price" class="input-group-text"><i class="far fa-lock"></i></div>
	    					<input type="password" class="form-control" id="inputPasswordModal" name="password">
				        </div>
                    </div>
                    <div class="col-span-12 form-check">
                        <input class="form-check-input" type="checkbox" id="rememberCheckModal" name="rememberMe" checked>
                        <label class="form-check-label" for="rememberCheckModal">Remember Me</label>
                    </div>
    			</div>
    			<div class="modal-footer text-right">
    				<button type="submit" class="btn btn-primary"><i class="far fa-sign-in-alt mr-2"></i> Login</button>
    			</div>
			</form>
    	</div>
	</div>
</div>
