<?php
$user_image = detailUser()->pu_user_image;
$user = detailUser()->pu_role_id;

// connect to request uri
$request = \Config\Services::request();
$uri = $request->uri->getSegment(1);
$menus = menu()
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: cornflowerblue;">
    <!-- Brand Logo -->
    <a href="<?= base_url('home') ?>" class="brand-link">
        <img src="<?= logoApp(); ?>" alt="<?= namaApp(); ?> Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-weight: bolder;"><?= namaApp(); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('img/' . detailUser()->pu_user_image) ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/admin/detail/<?= detailUser()->pu_id; ?>" class="nama-pengguna d-block"><?= detailUser()->pu_fullname; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2" style="color: aliceblue;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php foreach ($menus as $menu) {
                    // make 5 level menu with tm_status as status = 1 and tm_grup_akses as grup_akses >= $user
                    if ($menu['tm_status'] == 1 && $menu['tm_grup_akses'] >= $user) {
                        if ($menu['tm_parent_id'] == 0) {
                            // if menu has child

                            if (menu_child($menu['tm_id']) != null) {
                                echo '<li class="nav-item has-treeview">';
                                echo '<a href="' . base_url($menu['tm_url']) . '" class="nav-link">';
                                echo '<i class="nav-icon ' . $menu['tm_icon'] . '"></i>';
                                echo '<p>' . $menu['tm_nama'] . '<i class="right fas fa-angle-left"></i></p>';
                                echo '</a>';
                                echo '<ul class="nav nav-treeview nav-second-level">';
                                foreach (menu_child($menu['tm_id']) as $menu_child) {
                                    // make 4 level menu with tm_status as status = 1 and tm_grup_akses as grup_akses >= $user
                                    if ($menu_child['tm_status'] == 1 && $menu_child['tm_grup_akses'] >= $user) {
                                        if (menu_child_child($menu_child['tm_id']) != null) {
                                            echo '<li class="nav-item has-treeview">';
                                            echo '<a href="' . base_url($menu_child['tm_url']) . '" class="nav-link">';
                                            echo '<i class="nav-icon ' . $menu_child['tm_icon'] . '"></i>';
                                            echo '<p>' . $menu_child['tm_nama'] . '<i class="right fas fa-angle-left"></i></p>';
                                            echo '</a>';
                                            echo '<ul class="nav nav-treeview nav-third-level">';
                                            foreach (menu_child_child($menu_child['tm_id']) as $menu_child_child) {
                                                // make 3 level menu with tm_status as status = 1 and tm_grup_akses as grup_akses >= $user
                                                if ($menu_child_child['tm_status'] == 1 && $menu_child_child['tm_grup_akses'] >= $user) {
                                                    if (menu_child_child_child($menu_child_child['tm_id']) != null) {
                                                        echo '<li class="nav-item has-treeview">';
                                                        echo '<a href="' . base_url($menu_child_child['tm_url']) . '" class="nav-link">';
                                                        echo '<i class="nav-icon ' . $menu_child_child['tm_icon'] . '"></i>';
                                                        echo '<p>' . $menu_child_child['tm_nama'] . '<i class="right fas fa-angle-left"></i></p>';
                                                        echo '</a>';
                                                        echo '<ul class="nav nav-treeview nav-fourth-level">';
                                                        foreach (menu_child_child_child($menu_child_child['tm_id']) as $menu_child_child_child) {
                                                            // make 2 level menu with tm_status as status = 1 and tm_grup_akses as grup_akses >= $user
                                                            if ($menu_child_child_child['tm_status'] == 1 && $menu_child_child_child['tm_grup_akses'] >= $user) {
                                                                echo '<li class="nav-item">';
                                                                echo '<a href="' . base_url($menu_child_child_child['tm_url']) . '" class="nav-link">';
                                                                echo '<i class="nav-icon ' . $menu_child_child_child['tm_icon'] . '"></i>';
                                                                echo '<p>' . $menu_child_child_child['tm_nama'] . '</p>';
                                                                echo '</a>';
                                                                echo '</li>';
                                                            }
                                                        }
                                                        echo '</ul>';
                                                        echo '</li>';
                                                    } else {
                                                        echo '<li class="nav-item">';
                                                        echo '<a href="' . base_url($menu_child_child['tm_url']) . '" class="nav-link">';
                                                        echo '<i class="nav-icon ' . $menu_child_child['tm_icon'] . '"></i>';
                                                        echo '<p>' . $menu_child_child['tm_nama'] . '</p>';
                                                        echo '</a>';
                                                        echo '</li>';
                                                    }
                                                }
                                            }
                                            echo '</ul>';
                                            echo '</li>';
                                        } else {
                                            echo '<li class="nav-item">';
                                            echo '<a href="' . base_url($menu_child['tm_url']) . '" class="nav-link">';
                                            echo '<i class="nav-icon ' . $menu_child['tm_icon'] . '"></i>';
                                            echo '<p>' . $menu_child['tm_nama'] . '</p>';
                                            echo '</a>';
                                            echo '</li>';
                                        }
                                    }
                                }
                                echo '</ul>';
                                echo '</li>';
                            } else {
                                echo '<li class="nav-item">';
                                echo '<a href="' . base_url($menu['tm_url']) . '" class="nav-link">';
                                echo '<i class="nav-icon ' . $menu['tm_icon'] . '"></i>';
                                echo '<p>' . $menu['tm_nama'] . '</p>';
                                echo '</a>';
                                echo '</li>';
                            }
                        }
                    }
                } ?>
                <li class="nav-item" id="keluar">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fa-fw fa fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>