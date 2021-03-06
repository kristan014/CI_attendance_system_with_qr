<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('SystemSetup/dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Attendance Sys</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php if ($this->session->userdata('JOB_TITLE') == "System Administrator") {
    ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $this->uri->segment(2) == 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('SystemSetup/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= in_array($this->uri->segment(1), array(
                            'user',
                        )) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>User Management</span>
        </a>
        <div id="collapseUser" class="collapse <?= in_array($this->uri->segment(1), array(
                                                    'user'
                                                )) ? 'show' : '' ?>" aria-labelledby="headingUser" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management:</h6>
                <a class="collapse-item <?= $this->uri->segment(1) == 'user' ? 'active' : '' ?>" href="<?= base_url('user') ?>">User</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?= in_array($this->uri->segment(1), array(
                            'department', 'job_title', 'employee', 'shift',
                        )) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Employee Management</span>
        </a>
        <div id="collapseEmployee" class="collapse <?= in_array($this->uri->segment(1), array(
                                                        'department', 'job_title', 'employee', 'shift',
                                                    )) ? 'show' : '' ?>" aria-labelledby="headingEmployee" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Employee Management:</h6>
                <a class="collapse-item <?= $this->uri->segment(1) == 'department' ? 'active' : '' ?>" href="<?= base_url('department') ?>">Department</a>

                <a class="collapse-item <?= $this->uri->segment(1) == 'job_title' ? 'active' : '' ?>" href="<?= base_url('job_title') ?>">Job Title</a>
                <a class="collapse-item <?= $this->uri->segment(1) == 'employee' ? 'active' : '' ?>" href="<?= base_url('employee') ?>">Employee</a>
                <!-- <a class="collapse-item <?= $this->uri->segment(1) == 'shift' ? 'active' : '' ?>" href="<?= base_url('shift') ?>">Shift</a> -->
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAttendance" aria-expanded="true" aria-controls="collapseAttendance">
            <i class="fas fa-fw fa-clock"></i>
            <span>Time and Attendance</span>
        </a>
        <div id="collapseAttendance" class="collapse <?= in_array($this->uri->segment(1), array(
                                                    'attendance_sheet'
                                                )) ? 'show' : '' ?>"" aria-labelledby="headingAttendance" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Time and Attendance:</h6>
                <a class="collapse-item <?= $this->uri->segment(1) == 'attendance_sheet' ? 'active' : '' ?>" href="<?= base_url('attendance_sheet') ?>">Attendance</a>


            </div>
        </div>
    </li>
    <?php
    }
    ?>


    <?php if ($this->session->userdata('JOB_TITLE') == "Attendance Clerk") {
    ?>
        <li class="nav-item <?= $this->uri->segment(1) == 'time_in' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('time_in') ?>">
            <i class="fas fa-fw fa-sign-in-alt"></i>
                <span>Time In</span></a>
        </li>

        <li class="nav-item <?= $this->uri->segment(1) == 'time_out' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('time_out') ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Time Out</span></a>
        </li>
    <?php
    }
    ?>

   


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>



            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">


                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('FIRSTNAME') . " " . $this->session->userdata('LASTNAME') ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets') ?>/img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->