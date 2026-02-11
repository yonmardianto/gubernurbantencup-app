<div class="wsus__dashboard_sidebar">
    <div class="wsus__dashboard_sidebar_top">
        <div class="dashboard_banner">
            <img src="{{ asset('frontend/assets/images/single_topic_sidebar_banner.jpg') }}" alt="img" class="img-fluid">
        </div>
        <div class="img">
            <img src="{{ asset('default-files/avatar.png') }}" alt="profile" class="img-fluid w-100">
        </div>
        <h4>{{ auth()->user()->name }}</h4>
        <p>{{ auth()->user()->club }} <br/>Manager Team</p>
    </div>
    <ul class="wsus__dashboard_sidebar_menu">
        <li>
            <a href="{{ route('manager-team.dashboard') }}" class="{{ request()->is('manager-team/dashboard') ? 'active' : '' }}"><i class="fa fa-edit"></i> &nbsp; Entry By Name</a>

        </li>

        <li>
            <a href="{{ route('manager-team.participants.index') }}" class="{{ request()->routeIs('manager-team.participants.*') ? 'active' : '' }}"><i class="fa fa-list"></i> &nbsp; Peserta </a>
        </li>

        <li>
            <a href="{{ route('manager-team.payments.index') }}" class="{{ request()->routeIs('manager-team.payments.*') ? 'active' : '' }}"><i class="fa fa-money"></i> &nbsp; Upload Bukti Transfer </a>
        </li>


        <li>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="javascript:;" onclick="event.preventDefault(); this.closest('form').submit();">
                    <div class="img">
                        <img src="{{ asset('frontend/assets/images/dash_icon_16.png') }}" alt="icon" class="img-fluid w-100">
                    </div>
                    Sign Out
                </a>
          </form>
        </li>
    </ul>
</div>
