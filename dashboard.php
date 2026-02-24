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

$sql = "SELECT * FROM system_user";
$result = mysqli_query($conn, $sql);


?>

<link rel="stylesheet" href="./dashboard.css">
<!-- Basic Icons -->
<link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
<!-- Filled Icons -->
<link href="https://cdn.boxicons.com/3.0.8/fonts/filled/boxicons-filled.min.css" rel="stylesheet">
<!-- Brand Icons -->
<link href="https://cdn.boxicons.com/3.0.8/fonts/brands/boxicons-brands.min.css" rel="stylesheet">

<div class="container-fluid">
    <div class="row vh-100">
        <div class="col-lg-3 border sidebar-container">
            <div class="row text-white">
                <div class="col-lg-12 d-flex justify-content-center align-items-center logo-container">HND SE 25</div>
                <div class="col-lg-12 navigation-container"> 
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white active" href="#"> <i class="bx bx-dashboard" ></i>  Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"> <i class="bx bx-user" ></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"> <i class="bx bx-cog" ></i> Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-9 border main-container">
            <div class="row">
                <div class="col-lg-12 border d-flex justify-content-between align-items-center">
                    <h3>Dashboard</h3>
                    <b class="text-uppercase d-flex align-items-center"><?php echo htmlspecialchars($_SESSION['username']); ?> <form method="post" action=""><button class="btn" type="submit" name="logout">Logout</button></form> </b>
                </div>
            <div class="col-lg-12 border">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No users found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>


<?php 
include './layout/PageFooter.php';
?>