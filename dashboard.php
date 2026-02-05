<?php 

session_start();
if(!isset($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
}

if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}


include './services/databaseConfig.php';
include './layout/PageHead.php';
?>

<link rel="stylesheet" href="./dashboard.css">

<div class="container-fluid">
    <div class="row vh-100">
        <div class="col-lg-3 border sidebar-container">
            <div class="row text-white">
                <div class="col-lg-12 d-flex justify-content-center align-items-center logo-container">HND SE 25</div>
                <div class="col-lg-12 navigation-container"> Navigation Area</div>
            </div>
        </div>
        <div class="col-lg-9 border main-container">
            <div class="row">
                <div class="col-lg-12 border d-flex justify-content-between align-items-center">
                    <h3>Dashboard</h3>
                    <b class="text-uppercase d-flex align-items-center"><?php echo $_SESSION['username']; ?> <form method="post" action=""><button class="btn" type="submit" name="logout">Logout</button></form> </b>
                </div>
            <div class="col-lg-12 border">Main container</div>
            </div>
        </div>
    </div>
</div>


<?php 
include './layout/PageFooter.php';
?>