<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="mt-2">
            <a href="{{ route('dashboard') }}" class="logo"><img src="{{ asset('logo.png') }}" class="w-50" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu" class="mt-4">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="text-white waves-effect">
                        <i class="text-white fa fa-home" aria-hidden="true"></i>
                        </i><span> Accueil </span></a>
                </li>

                @if (auth()->user()->type == 'a')
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
                @endif

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="text-white dripicons-user-group"></i>
                        <span class="text-white"> Inspecteurs <span class="float-right"><i class="text-white mdi mdi-chevron-right"></i></span> </span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="{{ route('users.inspecteur') }}">Liste</a></li>
                        @if (auth()->user()->type == 'a')
                            <li><a class="text-white" href="{{ route('inspecteur.create') }}">Ajouter un inspecteur</a></li>
                            <li><a class="text-white" href="{{ route('inspecteur.trash') }}">Corbeille</a></li>
                        @endif
                    </ul>
                </li>

                <li>
                    <a href="{{ route('rapports.index') }}" class="text-white waves-effect">
                        <i class="text-white fa fa-files-o" aria-hidden="true"></i>
                        <span> Rapports </span></a>
                </li>

                <li>
                    <a href="{{ route('tournees.index') }}" class="waves-effect text-white">
                        <i class="fa fa-calendar text-white" aria-hidden="true"></i>
                        <span> Inspections </span></a>
                </li>

                @if (auth()->user()->type == 'a')
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
                @endif
            </ul>
            
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->