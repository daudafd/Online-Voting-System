<?php
session_start();
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
 include('./header.php'); 
 // include('./auth.php'); 
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voting System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">

    <style type="text/css">
    body {
        background: #80808045;
    }

    main {
        margin-left: unset !important;
        width: calc(100%) !important
    }

    #counter {
        width: 400px;
        background: #FF3131;
        box-shadow: 0px 2px 4px 0px black;
    }
    </style>
</head>

<body>
    <?php include 'topbar.php' ?>
    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
            <!-- jjjjjjjjjjjjjjjjj -->
        </div>
    </div>
    <main id="view-panel">
        <?php 
    // $page = isset($_GET['page']) ? $_GET['page'] :'vote_sheet';
     ?>
        <?php 
//   include $page.'.php' 
  ?>


    </main>

    <div class="container mt-12">
        <div class="row">
            <div class="col-md-12 mt-40">
                <h1>Voting Process will start on:</h1>
                <h2 id="counter" class="text-center"></h2>
            </div>
        </div>
    </div>


    <?php 
 $dateTime = strtotime('August 24, 2023 01:42:00');
 $getDateTime = date("F d, Y H:i:s", $dateTime); 
?>
    <!-- Script -->
    <script>
    var countDownTimer = new Date("<?php echo "$getDateTime"; ?>").getTime();
    // Update the count down every 1 second
    var interval = setInterval(function() {
        var current = new Date().getTime();
        // Find the difference between current and the count down date
        var diff = countDownTimer - current;
        // Countdown Time calculation for days, hours, minutes and seconds
        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
        var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((diff % (1000 * 60)) / 1000);

        document.getElementById("counter").innerHTML = days + "Day : " + hours + "h " +
            minutes + "m " + seconds + "s ";
        // Display Expired, if the count down is over
        if (diff < 0) {
            clearInterval(interval);
            // document.getElementById("counter").innerHTML = "EXPIRED";
            window.location.href = 'voting.php';
            return;
        }
    }, 1000);
    </script>
</body>

</html>