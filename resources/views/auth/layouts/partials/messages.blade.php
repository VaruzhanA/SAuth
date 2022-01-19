@if ($errors->any())
    <div class="alert alert-danger popup_box popup_box">
        <a class="close" data-dismiss="alert">×</a>
        @foreach ($errors->all() as $error)
            {!! $error !!}<br/>
        @endforeach
    </div>
@elseif (session()->get('auth_flash_success'))
    <div class="alert alert-success popup_box popup_box">
        <a class="close" data-dismiss="alert">×</a>
        Nearly there!<br>We have sent an email to  {!! session()->get('auth_flash_success') !!}, have a look for it, click the link to activate your account <br>Didn't get the email?
        <a href="#" class="text-nowrap"><strong>Please  re-send it</strong></a>
    </div>
@endif
