        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="sidebar-brand-text mx-1">SIS.AUTOMOTOR</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MÓDULOS
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuVehiculo"
                    aria-expanded="true" aria-controls="menuVehiculo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Vehículos</span>
                </a>
                <div id="menuVehiculo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        @can('vehiculo-list')
                        <a class="collapse-item" href="{{ route('vehiculo.index') }}">Vehículos</a>
                        @can('vehiculo_entrada-list')
                        <a class="collapse-item" href="{{ route('vehiculo_entrada.index') }}">Entradas</a>
                        @endcan
                        @can('vehiculo_salida-list')
                        <a class="collapse-item" href="{{ route('vehiculo_salida.index') }}">Salidas</a>
                        @endcan
                        @can('mantenimiento-list')
                        <a class="collapse-item" href="{{ route('mantenimiento.index') }}">Mantenimiento</a>
                        @endcan
                        @can('programa_mantenimiento-list')
                        <a class="collapse-item" href="{{ route('programa_mantenimiento.index') }}">Programar mantenimiento</a>
                        @endcan
                        @endcan
                        @can('repuesto-list')
                        <a class="collapse-item" href="{{ route('repuesto.index') }}">Repuestos</a>
                        @endcan
                        @can('tipo_mantenimiento-list')
                        <a class="collapse-item" href="{{ route('tipo_mantenimiento.index') }}">Tipo de mantenimiento</a>
                        @endcan
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuCombustible"
                    aria-expanded="true" aria-controls="menuCombustible">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Combustibles</span>
                </a>
                <div id="menuCombustible" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        @can('combustible-list')
                        <a class="collapse-item" href="{{ route('combustible.index') }}">Combustible</a>
                        @endcan
                        @can('proveedor-list')
                        <a class="collapse-item" href="{{ route('proveedor.index') }}">Proveedores</a>
                        @endcan
                        @can('combustible_entrada-list')
                        <a class="collapse-item" href="{{ route('combustible_entrada.index') }}">Entradas</a>
                        @endcan
                        @can('combustible_salida-list')
                        <a class="collapse-item" href="{{ route('combustible_salida.index') }}">Salidas</a>
                        @endcan
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                REPORTES
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuReportes"
                    aria-expanded="true" aria-controls="menuReportes">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Reportes</span>
                </a>
                <div id="menuReportes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        @can('reporte-list')
                        <a class="collapse-item" href="{{ route('reporte_combustible.view_entradas_form') }}">Entrada de combustible</a>
                        <a class="collapse-item" href="{{ route('reporte_combustible.view_salidas_form') }}">Salida de combustible</a>
                        <a class="collapse-item" href="{{ route('reporte_combustible.view_consumo_form') }}">Consumo de combustible</a>
                        @endcan
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                ADMINISTRACIÓN
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuUsuario"
                    aria-expanded="true" aria-controls="menuUsuario">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Usuarios</span>
                </a>
                <div id="menuUsuario" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        @can('user-list')
                        <a class="collapse-item" href="{{ route('users.index') }}">Usuarios</a>
                        @endcan
                        @can('role-list')
                        <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                        @endcan
                        @can('permiso-list')
                        <a class="collapse-item" href="{{ route('permiso.index') }}">Permisos</a>
                        @endcan
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>