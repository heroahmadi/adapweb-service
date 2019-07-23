<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-title">Monitoring</li><!-- /.menu-title -->
                <li id="dashboards">
                    <a href="{{ url('/dashboards') }}"><i class="menu-icon fa fa-laptop"></i>Dashboards </a>
                </li>
                {{--  <li id="traefik">
                    <a href="{{ url('/dashboard/traefik') }}"><i class="menu-icon fa fa-laptop"></i>Traefik </a>
                </li>
                <li id="prometheus">
                    <a href="{{ url('/dashboard/prometheus') }}"><i class="menu-icon fa fa-laptop"></i>Prometheus </a>
                </li>
                <li id="jenkins">
                    <a href="{{ url('/dashboard/jenkins') }}"><i class="menu-icon fa fa-laptop"></i>Jenkins </a>
                </li>  --}}
                {{-- <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <i class="menu-icon fa fa-cogs"></i>Components
                    </a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html">Buttons</a></li>
                        <li><i class="fa fa-id-badge"></i><a href="ui-badges.html">Badges</a></li>
                        <li><i class="fa fa-bars"></i><a href="ui-tabs.html">Tabs</a></li>

                        <li><i class="fa fa-id-card-o"></i><a href="ui-cards.html">Cards</a></li>
                        <li><i class="fa fa-exclamation-triangle"></i><a href="ui-alerts.html">Alerts</a></li>
                        <li><i class="fa fa-spinner"></i><a href="ui-progressbar.html">Progress Bars</a></li>
                        <li><i class="fa fa-fire"></i><a href="ui-modals.html">Modals</a></li>
                        <li><i class="fa fa-book"></i><a href="ui-switches.html">Switches</a></li>
                        <li><i class="fa fa-th"></i><a href="ui-grids.html">Grids</a></li>
                        <li><i class="fa fa-file-word-o"></i><a href="ui-typgraphy.html">Typography</a></li>
                    </ul>
                </li> --}}
                
                <li class="menu-title">Konfigurasi</li><!-- /.menu-title -->

                <li id="deploy">
                    <a href="{{ url('deploy') }}"><i class="menu-icon fa fa-laptop"></i>Application </a>
                </li>
                <li id="settings">
                    <a href="{{ url('settings') }}"><i class="menu-icon fa fa-laptop"></i>Settings </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>