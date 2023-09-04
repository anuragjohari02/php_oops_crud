<?php
include_once('../config/app.php');
?>

<nav class="sb-topnav navbar navbar-expand navbar-primary bg-primary">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 text-white" href="index.html">PHP OOPS ADMIN</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars text-white"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary bg-secondary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <?php if(isset($_SESSION['authenticated'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                <?= $_SESSION['auth_user']['user_fname']." ".$_SESSION['auth_user']['user_lname'] ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <form action="" method="POST">
                            <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        <?php else : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('../login.php') ?>">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('../register.php') ?>">Register</a>
        </li>
        <?php endif; ?>
      </ul>
    </ul>
</nav>