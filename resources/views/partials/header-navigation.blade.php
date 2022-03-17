<nav class="navbar is-link is-primary-color">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{url('/')}}">
            SINTESA
        </a>

        <div class="navbar-burger burger" data-target="main-navigation">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="main-navigation" class="navbar-menu">
        <div class="navbar-start is-hidden-desktop">
            <ul class="menu-list">
                <li>
                    <a class="target-link" href="dashboard#welcome">
                        <i class="uil uil-estate"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a class="sidebar-link" data-id="#subsidebar-myuser">
                        Profil
                    </a>
                </li>
            </ul>
            @if(in_array(auth_data()->user_status, [10]))
            <ul class="menu-list">
                <li>
                    <a class="navbar-item target-link" href="dashboard#cashier">
                        Kasir
                    </a>
                </li>
                <li>
                    <a class="navbar-item target-link" href="dashboard#product-partner">
                        Produk Lain
                    </a>
                </li>
                <li>
                    <a class="navbar-item target-link" href="dashboard#customer">
                        Pelanggan
                    </a>
                </li>
                <li>
                    <a class="navbar-item target-link" href="dashboard#partner-finance">
                        Keuangan
                    </a>
                </li>
                <li>
                    <a class="sidebar-link" data-id="#subsidebar-partner-report">
                        Laporan
                    </a>
                </li>
            </ul>
            @elseif(in_array(auth_data()->user_status, [100, 101]))
            <ul class="menu-list">
                <li>
                    <a class="sidebar-link" data-id="#subsidebar-user">
                        Pengguna
                    </a>
                </li>
                <li>
                    <a class="sidebar-link" data-id="#subsidebar-finance">
                        Keuangan
                    </a>
                </li>
                <li>
                    <a class="sidebar-link" data-id="#subsidebar-material">
                        Bahan Mentah
                    </a>
                </li>
                <li>
                    <a class="sidebar-link" data-id="#subsidebar-product">
                        Menu
                    </a>
                </li>
                <li>
                    <a class="sidebar-link" data-id="#subsidebar-reporting">
                        Laporan
                    </a>
                </li>
            </ul>
            @elseif(in_array(auth_data()->user_status, [100, 102]))
            @endif
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
            @if(in_array(auth_data()->user_status, [10]))
            MITRA {{auth_data()->username}}
            @elseif(in_array(auth_data()->user_status, [100, 101]))
            ADMIN
            @elseif(in_array(auth_data()->user_status, [100, 102]))
            Halo, {{auth_data()->fullname}}
            @endif
            </div>
            <a class="navbar-item" href="{{url('signout')}}">
                <i class="uil uil-signout"></i>&nbsp; Keluar
            </a>
        </div>
    </div>
</nav>