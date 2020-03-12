
<link rel="stylesheet" href="{{ admin_asset('dcat-admin/css/pages/authentication.css') }}">

<section class="row flexbox-container">
    <div class="col-xl-8 col-11 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                    <img src="{{ admin_asset('dcat-admin/images/pages/login.png') }}" alt="branding logo">
                </div>
                <div class="col-lg-6 col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2">
                        <div class="card-header pb-1">
                            <div class="card-title">
                                <h4 class="mb-0">Login</h4>
                            </div>
                        </div>
                        <p class="px-2">Welcome back, please login to your account.</p>
                        <div class="card-content">
                            <div class="card-body pt-1">
                                <form method="POST" action="{{ admin_url('auth/login') }}">
                                    @csrf
                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                        <input
                                                type="text"
                                                class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                                name="username"
                                                placeholder="{{ trans('admin.username') }}"
                                                value="{{ old('username') }}"
                                                required
                                                autofocus
                                        >

                                        <div class="form-control-position">
                                            <i class="feather icon-user"></i>
                                        </div>

                                        <label for="email">{{ trans('admin.username') }}</label>
                                        @if($errors->has('username'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            @foreach($errors->get('username') as $message)
                                                <span class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</span><br>
                                            @endforeach
                                        </span>
                                        @endif
                                    </fieldset>

                                    <fieldset class="form-label-group position-relative has-icon-left">
                                        <input
                                                id="password"
                                                type="password"
                                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                name="password"
                                                placeholder="{{ trans('admin.password') }}"
                                                required
                                                autocomplete="current-password"
                                        >

                                        <div class="form-control-position">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                        <label for="password">{{ trans('admin.password') }}</label>

                                        @if($errors->has('password'))
                                            <span class="invalid-feedback text-danger" role="alert">
                                            @foreach($errors->get('password') as $message)
                                                    <span class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{$message}}</span><br>
                                            @endforeach
                                            </span>
                                        @endif
                                    </fieldset>
                                    <div class="form-group d-flex justify-content-between align-items-center">
                                        <div class="text-left">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input id="remember" name="remember"  value="1" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                          <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span> {{ trans('admin.remember_me') }}</span>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right btn-inline">{{ __('admin.login') }}</button>
                                </form>
                            </div>
                        </div>
                        <div class="login-footer">
                            <div class="divider"></div>
                            <div class="footer-btn d-inline"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
