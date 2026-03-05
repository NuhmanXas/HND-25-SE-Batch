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

if(isset($_POST['save_profile'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO system_user (name, username, password) VALUES ('$name', '$username', '$password')";
    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Profile created successfully');</script>";
    } else {
        echo "<script>alert('Error creating profile: " . mysqli_error($conn) . "');</script>";
    }
    
}


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
        <div class="col-lg-3 sidebar-container">
            <div class="row text-white">
                <div class="col-lg-12 d-flex justify-content-center align-items-center logo-container">HND SE 25</div>
                <div class="col-lg-12 navigation-container"> 
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white " href="dashboard.php"> <i class="bx bx-dashboard" ></i>  Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white active" href="profile.php"> <i class="bx bx-user" ></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="settings.php"> <i class="bx bx-cog" ></i> Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-9 border main-container">
            <div class="row">
                <div class="col-lg-12 border d-flex justify-content-between align-items-center">
                    <h3>Profile</h3>
                    <b class="text-uppercase d-flex align-items-center"><?php echo htmlspecialchars($_SESSION['username']); ?> <form method="post" action=""><button class="btn" type="submit" name="logout">Logout</button></form> </b>
                </div>
            <div class="col-lg-12 border">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create New Profile
                </button>
<form method="post" action="">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                                
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"    placeholder="Enter username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="save_profile" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>
</form>


  <!-- // create table to display profiles -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>    
        <tbody>
            <?php
            $sql = "SELECT id, name, username FROM system_user";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['username'] . "</td><td><a href='edit_profile.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Edit</a> <a href='delete_profile.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger'>Delete</a></td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No profiles found</td></tr>";
            }
            ?>
        </tbody>


            </div>
            </div>
        </div>
    </div>
</div>


<?php 
include './layout/PageFooter.php';
?>