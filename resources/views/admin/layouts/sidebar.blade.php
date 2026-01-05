<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../admin/img/{{Auth::user()->Img}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <!-- Dashboard -->
            <li>
                <a href="/admin/dashboard">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Website Settings -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Website Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/settings_general"><i class="fa fa-circle-o"></i>General</a></li>
                    <li><a href="/admin/settings_branding"><i class="fa fa-circle-o"></i>Branding</a></li>
                    <li><a href="/admin/settings/seo"><i class="fa fa-circle-o"></i>SEO</a></li>
                    <li><a href="/admin/settings/integration"><i class="fa fa-circle-o"></i>Integrations</a></li>
                </ul>
            </li>

            <!-- Landing Page -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-desktop"></i>
                    <span>Landing Page</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/landing/hero"><i class="fa fa-circle-o"></i>Hero Section</a></li>
                    <li><a href="/admin/landing/about"><i class="fa fa-circle-o"></i>About Section</a></li>
                    <li><a href="/admin/landing/features"><i class="fa fa-circle-o"></i>Features</a></li>
                    <li><a href="/admin/landing/services"><i class="fa fa-circle-o"></i>Services</a></li>
                    <li><a href="/admin/landing/testimonials"><i class="fa fa-circle-o"></i>Testimonials</a></li>
                    <li><a href="/admin/landing/cta"><i class="fa fa-circle-o"></i>CTA Section</a></li>
                </ul>
            </li>

            <!-- Page Manager -->
            <li>
                <a href="/admin/pages">
                    <i class="fa fa-file-text"></i>
                    <span>Pages</span>
                </a>
            </li>

            <!-- Content Manager -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pencil"></i>
                    <span>Contents</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/articles"><i class="fa fa-circle-o"></i>Articles</a></li>
                    <li><a href="/admin/categories"><i class="fa fa-circle-o"></i>Categories</a></li>
                </ul>
            </li>

            <!-- Media -->
            <li>
                <a href="/admin/media">
                    <i class="fa fa-picture-o"></i>
                    <span>Media Library</span>
                </a>
            </li>

            <!-- Products (Existing) -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/product"><i class="fa fa-circle-o"></i>Product List</a></li>
                    <li><a href="/admin/brand"><i class="fa fa-circle-o"></i>Brands</a></li>
                    <li><a href="/admin/category"><i class="fa fa-circle-o"></i>Categories</a></li>
                </ul>
            </li>

            <!-- Transactions -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Transactions</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/order"><i class="fa fa-shopping-cart"></i>Orders</a></li>
                </ul>
            </li>

            <!-- Users -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/admin"><i class="fa fa-user"></i>Admin</a></li>
                    <li><a href="/admin/customer"><i class="fa fa-users"></i>Customer</a></li>
                    <li><a href="/admin/roles"><i class="fa fa-shield"></i>Roles & Permissions</a></li>
                </ul>
            </li>

        </ul>

    </section>
    <!-- /.sidebar -->
</aside>