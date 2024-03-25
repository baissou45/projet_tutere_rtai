<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="mt-2">
            <!--<a href="index.html" class="text-center logo">Fonik</a>-->
            <a href="{{ route('dashboard') }}" class="logo"><img src="{{ asset('logo.png') }}" class="w-50" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu" class="mt-4">
            <ul>
                <li>
                    <a href="index.html" class="text-white waves-effect">
                        <i class="text-white fa fa-home" aria-hidden="true"></i>
                        </i><span> Accueil </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="text-white dripicons-user-group"></i>
                        <span class="text-white"> Utilisateurs <span class="float-right"><i class="text-white mdi mdi-chevron-right"></i></span> </span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ route('users.index') }}">Liste</a></li>
                        <li><a class="text-white" href="{{ route('users.create') }}">Nouvel utilisateur</a></li>
                        <li><a class="text-white" href="{{ route('users.trash') }}">Corbeille</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="text-white dripicons-user-group"></i>
                        <span class="text-white"> Inspecteurs <span class="float-right"><i class="text-white mdi mdi-chevron-right"></i></span> </span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('users.inspecteur') }}">Liste</a></li>
                        <li><a href="#">Ajouter un inspecteur</a></li>
                    </ul>
                </li>

                <li>
                    <a href="index.html" class="text-white waves-effect">
                        <i class="text-white fa fa-files-o" aria-hidden="true"></i>
                        <span> Rapports </span></a>
                </li>

                <li>
                    <a href="index.html" class="text-white waves-effect">
                        <i class="text-white fa fa-calendar" aria-hidden="true"></i>
                        <span> Tournées </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="text-white fa fa-bar-chart" aria-hidden="true"></i>
                        <span class="text-white"> Statistiques <span class="float-right"><i class="text-white mdi mdi-chevron-right"></i></span> </span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('statistiques.tournees') }}">Tournées</a></li>
                        <li><a href="{{ route('statistiques.rapports') }}">Rapports</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->