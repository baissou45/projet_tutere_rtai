<div class="topbar">

    <nav class="navbar-custom">
        <ul class="list-inline mb-0">
            <li class="list-inline-item mb-5">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <!-- User-->
            <li class="float-right list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('template/back/assets/images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle">
                    {{-- <img src="{{ asset(auth()->user()->get_profil_img() ?? 'template/back/assets/images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle"> --}}
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="dripicons-user text-muted"></i> Profile</a>
                    <form action="{{ route('logout') }}" method="post" id="dec_form">
                        @csrf

                        <a class="dropdown-item" href="#" id="deconnexion" onclick="logout()">
                            <i class="dripicons-exit text-danger"></i>
                            <span class="text-danger"> Déconnection </span>
                        </a>
                    </form>
                </div>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>

@section("script")
    {{-- <script>
        $("#deconnexion").click(function (e) {
            console.log('deconnexion');
            $('#dec_form').submit();
        });
    </script> --}}
@endsection