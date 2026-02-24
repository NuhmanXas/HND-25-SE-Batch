<?php 
    include './layout/PageHead.php'; 
    include './services/databaseConfig.php';


    // print_r($_POST);

    if(isset($_POST['createAccount'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "INSERT INTO system_user (name, username, password) VALUES ('$name', '$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Account created successfully,'); window.location.href='index.php'; </script>";
        } else {
            echo "<script>alert('Error creating account: " . mysqli_error($conn) . "');</script>";
        }
    }




?>


<div class="container mt-5">
    <div class="row vh-100 align-items-center justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Create An Account</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                        </div>
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
                        <button type="submit" name="createAccount" class="btn btn-primary w-100">Create Account</button>
                        <a href="index.php" class="btn btn-secondary w-100 mt-3">Back to Login</a>
                    
                    </form>
                </div>
            </div>
    </div>
</div>

<?php include './layout/PageFooter.php'; ?>