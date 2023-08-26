<div class="container-fluid">
    <div class="row">
        <!-- Top Bar -->
        <div class="col-12 top-bar bg-dark text-light d-flex justify-content-between align-items-center">
            <button class="btn btn-dark d-md-none" id="toggleSidebar">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">
                <img src="./assets/img/OSYN.jpeg" class="me-2" height="50" alt="OSYN Logo" loading="lazy" />
                <small>OSYN Voting System</small>
            </a>
            <a class="text-white"><?php echo $_SESSION['login_name'] ?></a>
            <!-- Other top bar content here -->
        </div>
    </div>
    <div class="row">
        <!-- Navigation Bar -->
        <nav id="sidebar" class="col-md-2 d-none d-md-block bg-dark">
            <div class="sidebar-list">
                <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i
                            class="fa fa-home"></i></span> Home</a>
                <?php if ($_SESSION['login_type'] == 1): ?>
                <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i
                            class="fa fa-users"></i></span> Users</a>
                <?php endif; ?>
                <a href="ajax.php?action=logout" class="text-white"><i class="fa fa-power-off"></i> Logout</a>
            </div>
        </nav>
    </div>
</div>
<script>
$(document).ready(function() {
    // Toggle the navigation bar on mobile view
    $('#toggleSidebar').click(function() {
        $('#sidebar').toggleClass('d-md-block');
    });
});
</script>