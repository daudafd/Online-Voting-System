<!-- <div class="container-fluid">

    <div class="row">
        <nav id="sidebar" class="col-md-2 d-none d-md-block bg-dark">
            <div class="sidebar-list">
                <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
                <?php if ($_SESSION['login_type'] == 1): ?>
                <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</div> -->

<nav class="navbar navbar-expand-lg navbar-dark text-light bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="./assets/img/OSYN.jpeg" class="me-2" height="50" alt="OSYN Logo" loading="lazy" />
                <small>OSYN Voting System</small>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?page=home">Home</a>
        </li>
        <li class="nav-item">
          <?php if ($_SESSION['login_type'] == 1): ?>
                <a class="nav-link active" aria-current="page" href="index.php?page=users" >Users</a>
                <?php endif; ?>
        </li>
      </ul>
      <a href="ajax.php?action=logout" class="text-white">
         <?php echo $_SESSION['login_name'] ?><i class="fa fa-power-off"></i>
        </a>
    </div>
  </div>
</nav>