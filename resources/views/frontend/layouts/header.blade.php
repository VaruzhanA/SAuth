<header class="header">
    <div class="row gutters hidden--tablet hidden--desktop" id="header-mobile">
        <div class="col-xs-3">
            <button type="button" class="mobile-menu-toggle button--plain" id="mobile-menu-toggle">
                <span class="fa fa-bars"></span>
            </button>
        </div>

        <div class="col-xs-6">
            <a href="{{url('/')}}" class="header-logo">
                <img src="{{asset('assets/images/sauth-m-logo.png')}}" alt="Home">
            </a>
        </div>
    </div>


    <div class="row hidden--mobile" id="header-desktop">
        <div class="header-left">
            <a href="{{url('/')}}" class="header-item header-logo">
                <img src="{{asset('assets/images/sauth-m-logo.png')}}" alt="Home">
            </a>
            <div class="header-item">
            </div>
        </div>

        @if(Auth::user())
            <div class="header-actions">
                <div class="header-item header-action">
                    @role(1)
                        <a href="{{url('/admin')}}" class="button button--continue">Admin Panel</a>
                    @endauth
                </div>

                <div class="header-item header-action">
                    <img src="{{asset('assets/images/male.png')}}" alt="">
                    <a href="#" class="button button--continue user-btn">
                        <span>{{Auth::user()->first_name}}</span>
                        <span>{{Auth::user()->last_name}}</span>
                    </a>
                </div>
            </div>

        <div class="header-right">
            <div class="header-item header-action header-action--login">
                <a href="{{route('logout')}}" class="button button--continue">Log Out</a>
            </div>
        </div>
        @endif
    </div>
</header>
