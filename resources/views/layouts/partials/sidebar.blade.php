<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="mt-2">
            <!--<a href="index.html" class="logo text-center">Fonik</a>-->
            <a href="{{ route('dashboard') }}" class="logo"><img src="{{ asset('logo.png') }}" class="w-50" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu" class="mt-4">
            <ul>
                <li>
                    <a href="index.html" class="waves-effect text-white">
                        <i class="fa fa-home text-white" aria-hidden="true"></i>
                        </i><span> Accueil </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="dripicons-user-group text-white"></i>
                        <span class="text-white"> Utilisateurs <span class="float-right"><i class="mdi mdi-chevron-right text-white"></i></span> </span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ route('users.index') }}">Liste</a></li>
                        <li><a class="text-white" href="#">Nouvel utilisateur</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="dripicons-user-group text-white"></i>
                        <span class="text-white"> Inspecteurs <span class="float-right"><i class="mdi mdi-chevron-right text-white"></i></span> </span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="#">Liste</a></li>
                        <li><a href="#">Nouvel utilisateur</a></li>
                    </ul>
                </li>

                <li>
                    <a href="index.html" class="waves-effect text-white">
                        <i class="fa fa-files-o text-white" aria-hidden="true"></i>
                        <span> Rapports </span></a>
                </li>

                <li>
                    <a href="index.html" class="waves-effect text-white">
                        <i class="fa fa-calendar text-white" aria-hidden="true"></i>
                        <span> Tournées </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="fa fa-bar-chart text-white" aria-hidden="true"></i>
                        <span class="text-white"> Statistiques <span class="float-right"><i class="mdi mdi-chevron-right text-white"></i></span> </span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="#">Tournées</a></li>
                        <li><a href="#">Rapports</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->