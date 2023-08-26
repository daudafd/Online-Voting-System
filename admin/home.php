<?php
  if ($_SESSION['login_type'] != 1 ){
    header("location: login.php"); 
    session_destroy();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <style>
    .grey-bg {
        background-color: #F5F7FA;
    }

    /* Add custom CSS to push cards to the right */
    .custom-container {
        display: flex;
        justify-content: flex-end;
    }

    .custom-container .content {
        width: 100%;
        /* margin-left: 18%; */
    }

    .candidate {
        margin: auto;
        width: 30vw;
        padding: 0 1px;
        border-radius: 20px;
        margin-bottom: 1em;
        display: flex;
        border: 3px solid #00000008;
        background: #8080801a;
    }

    @media (max-width: 767px) {

        /* Your mobile-specific styles go here */
        .custom-container {
            justify-content: center;
            /* Center content vertically on mobile */
        }

        .custom-container .content {
            width: 100%;
            /* margin-left: 1%; */
        }
    }
    </style>
    <!-- Include Bootstrap and other stylesheets here -->
</head>

<body>
    <?php include('db_connect.php');

        $voting = $conn->query("SELECT * FROM voting_list where  is_default = 1 ");
        foreach ($voting->fetch_array() as $key => $value) {
            $$key = $value;
        }
        $votes  = $conn->query("SELECT * FROM votes where voting_id = $id ");
        $v_arr = array();
        while($row=$votes->fetch_assoc()){
            if(!isset($v_arr[$row['voting_opt_id']]))
                $v_arr[$row['voting_opt_id']] = 0;

            $v_arr[$row['voting_opt_id']] += 1;
        }
        $opts = $conn->query("SELECT * FROM voting_opt where voting_id=".$id);
        $opt_arr = array();
            while($row=$opts->fetch_assoc()){
            $opt_arr[$row['category_id']][] = $row;

        }

?>
    <div class="grey-bg custom-container">
        <div class="content container-fluid">
            <!-- Your card sections go here -->

            <!-- Section 1 -->
            <section id="stats-subtitle">
                <!-- <h2 class="font-weight-bold mb-2">Latest Statistics</h2>
  				<p class="font-italic text-muted mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p> -->
                <header class="text-center">
                    <h1 class="display-5 font-weight-bold"><?php echo $title ?></h1>
                </header>
                <div class="row pb-3">

                    <div class="col-lg-6 col-md-6 mb-4 mb-lg-0 sm-3">
                        <!-- Card -->
                        <div class="card rounded shadow-sm border-0">
                            <div class="card-body p-5"><i class="fa fa-users fa-2x mb-3 text-success"></i>
                                <h5>Registered Voters</h5>
                                <div class="align-self-center">
                                    <h1><b><?php echo $conn->query('SELECT * FROM users where type = 2')->num_rows ?></b>
                                    </h1>
                                </div>
                                <div class="progress rounded-pill">
                                    <div role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 100%;" class="progress-bar bg-success rounded-pill"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 mb-4 mb-lg-0 sm-3">
                        <!-- Card -->
                        <div class="card rounded shadow-sm border-0">
                            <div class="card-body p-5"><i class="fa fa-tasks fa-2x mb-3 text-primary"></i>
                                <h5>Total Vote</h5>
                                <div class="align-self-center">
                                    <h1><b><?php echo $conn->query('SELECT distinct(user_id) FROM votes where voting_id = '.$id)->num_rows ?></b>
                                    </h1>
                                </div>
                                <div class="progress rounded-pill">
                                    <div role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 80%;" class="progress-bar bg-primary rounded-pill"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <div class="container py-5">

        <div class="row pb-5 mb-4">
            <div class="alert alert-dark" role="alert">
                <div class="col-lg-12 col-md-12 mb-4 mb-lg-2">
                    <?php 
                    $cats = $conn->query("SELECT * FROM category_list where id in (SELECT category_id from voting_opt where voting_id = '".$id."' )");
                    while($row = $cats->fetch_assoc()):
                    ?>

                    <header class="text-center mt-4 mb-4">
                        <h3 class="display-5 font-weight-bold"><?php echo $row['category'] ?></h3>
                    </header>

                    <?php foreach ($opt_arr[$row['id']] as $candidate) {
						?>
                    <div class="card rounded shadow-sm border-0">
                        <div class="card-body p-0">
                            <div class="bg-primary px-5 py-4 text-center card-img-top"><img
                                    src="assets/img/<?php echo $candidate['image_path'] ?>" alt="..." width="100"
                                    class="rounded-circle mb-2 img-thumbnail d-block mx-auto">
                                <h5 class="text-white mb-0"><?php echo $candidate['opt_txt'] ?></h5>
                            </div>

                            <div class="p-4 d-flex justify-content-center">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-success position-relative">
                                            Vote
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                <?php echo isset($v_arr[$candidate['id']]) ? number_format($v_arr[$candidate['id']]) : 0 ?>
                                            </span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Include scripts and closing tags here -->
</body>

</html>