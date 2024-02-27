<div class="topbar">

    <nav class="navbar-custom">
        <ul class="list-inline float-right mb-0">
            <!-- User-->
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('template/back/assets/images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle">
                    {{-- <img src="{{ asset(auth()->user()->get_profil_img() ?? 'template/back/assets/images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle"> --}}
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="dripicons-user text-muted"></i> Profile</a>
                    <form action="{{ route('logout') }}" method="post" id="dec_form">
                        @csrf

                        <a class="dropdown-item" href="#" id="deconnexion">
                            <i class="dripicons-exit text-danger"></i>
                            <span class="text-danger"> Déconnection </span>
                        </a>
                    </form>
                    {{-- <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted"></i> Logout</a> --}}
                </div>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>

@section("script")
    <script>
        $("#deconnexion").click(function (e) {
            $('#dec_form').submit();
        });
    </script>
@endsection