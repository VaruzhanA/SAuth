@extends('auth.layouts.app')

@section('content')
    {{ Form::open(['route' => 'login.post', 'class' => 'form-horizontal validate-on-submit', 'name' =>'login_form', 'role' => 'form', 'method' => 'post', 'id' => 'login-tab-login']) }}

        <div class="modal-body">
            <fieldset>
                <div class="form-group mb-3">
                    <div class="col-sm-12"><h3>Log in to your account</h3>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label label--mandatory">Your email</span>
                            {{ Form::text('email', '', ['class' => 'validate[required,custom[email]]', 'maxlength' => '80', 'autofocus' => 'autofocus', 'placeholder' => 'Your email:*']) }}
                        </label>

                    </div>
                </div>

                <div class="form-group login-password-wrapper">
                    <div class="col-sm-12">
                        <input type="hidden" name="can_view_password" value="1">
                        <label class="input_group">
                            <span class="form-input form-input--text form-input--pseudo">
                                <span class="form-input--pseudo-label label--mandatory">Password</span>
                                 {{ Form::password('password',  ['class' => 'validate[required]', 'id' => 'login-password', 'maxlength' => '40', 'autofocus' => 'off', 'placeholder' => 'Password:*']) }}
                            </span>

                            <span class="input_group-icon">
                                <span class="view-pwd">
                                    <button type="button"
                                            class="btn-link button--plain showPass"
                                            data-target="#login-password">
                                        <span class="sr-only">Show password?</span>

                                        <span class="fa fa-eye icon icon-eye"
                                              aria-hidden="true"></span>
                                    </button>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 login-remember_me">
                        <input type="hidden" name="remember" value="false"><!-- Value when unchecked -->
                        <label class="checkbox-switch">
                            <span class="checkbox-switch-label">Keep me for signed in for 30 minutes.&nbsp; </span>
                            <input type="checkbox" name="remember" value="true">
                            <span class="checkbox-switch-helper"></span>
                        </label>
                    </div>
                </div>

                <div class="form-group vertically_center login-disclaimer">
                    <div class="col-xs-8 col-sm-9">
                        <p>By signing up, you agree to the
                            <a href="#"><strong>privacy policy</strong></a> and
                            <a href="#"><strong>terms of use</strong></a>.
                            <strong>Also note not to sign-up twice. This process is only required once.&nbsp;</strong>
                        </p>
                    </div>

                    <div class="col-xs-4 col-sm-3" style="display: flex; justify-content: flex-end;">
                        <img src="{{asset('assets/images/comodo-secure-logo.png')}}" alt="Comodo Secure"  style="width: 69px;height:39px;max-width:none;">
                    </div>
                </div>

                <div class="form-group login-buttons">
                    <div class="col-sm-12">
                        {{ Form::submit('Log in', ['class' => 'button btn btn-lg btn--full btn-success', 'id' => 'login_button']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <p class="login-form-forgot_password">
                            <a href="#" id="passwordlink"><strong>Forgot password?</strong></a>
                        </p>
                        <p>
                            <a href="mailto:info@company.com">Can't log in</a>
                        </p>
                    </div>
                </div>
            </fieldset>

            <div class="form-group clearfix">
                <div class="col-sm-12 layout-login-alternative_option text-center">
                    <p>
                        Do you need an account?
                        <span class="signup-text">
                            <a href="{{route('user.signup')}}}" data-toggle="tab" aria-expanded="false">Sign up now!</a>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    {{ Form::close() }}
@endsection
