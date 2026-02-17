<?php 
include './services/databaseConfig.php';
include './layout/PageHead.php'; 

$temp = "";
session_start();

if(isset($_SESSION['userId'])) {
    header("Location: dashboard.php");
    exit();
}


if(isset($_POST['loginUserForm'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from system_user su WHERE su.username = '$username' and 
    su.password = '$password' ";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['userId'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}


?>



<div class="container mt-5">
    <div class="row vh-100 align-items-center justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                            <input type="checkbox" class="form-check-input mt-2" id="showPassword" onclick="togglePassword()">
                            <label class="form-check-label mt-2" for="showPassword">Show Password</label>
                            <script>
                                function togglePassword() {
                                    var passwordInput = document.getElementById("password");
                                    if (passwordInput.type === "password") {
                                        passwordInput.type = "text";
                                    } else {
                                        passwordInput.type = "password";
                                    }
                                }
                                </script>
                        </div>
                        <button type="submit" name="loginUserForm" class="btn btn-primary w-100">Login</button>
                    </form>
                    <a href="createNewAccount.php" class="btn btn-secondary w-100 mt-3">Create an account</a>
                </div>
            </div>
    </div>
</div>

<?php include './layout/PageFooter.php'; ?>