        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
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
                        <a class="collapse-item" href="{{ route('vehiculo.index') }}">Vehículo</a>
                        <a class="collapse-item" href="#">Repuestos</a>
                        <a class="collapse-item" href="#">Entradas</a>
                        <a class="collapse-item" href="#">Salidas</a>
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
                        <a class="collapse-item" href="{{ route('combustible.index') }}">Combustible</a>
                        <a class="collapse-item" href="{{ route('proveedor.index') }}">Proveedores</a>
                        <a class="collapse-item" href="#">Entradas</a>
                        <a class="collapse-item" href="#">Salidas</a>
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
                        <a class="collapse-item" href="{{ route('users.index') }}">Usuarios</a>
                        <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                        <a class="collapse-item" href="{{ route('permiso.index') }}">Permisos</a>
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