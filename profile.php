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

    $stmt = mysqli_prepare($conn, "INSERT INTO system_user (name, username, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $name, $username, $password);
    if(mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Profile created successfully');</script>";
    } else {
        echo "<script>alert('Error creating profile');</script>";
    }
}

if(isset($_POST['save_edit_profile'])) {
    $id = (int)$_POST['edit_id'];
    $name = $_POST['edit_name'];
    $username = $_POST['edit_username'];
    $password = $_POST['edit_password'];

    if(!empty($password)) {
        $stmt = mysqli_prepare($conn, "UPDATE system_user SET name=?, username=?, password=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssi", $name, $username, $password, $id);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE system_user SET name=?, username=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "ssi", $name, $username, $id);
    }

    if(mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Profile updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating profile');</script>";
    }
}

if(isset($_POST['delete_profile'])) {
    $id = (int)$_POST['delete_id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM system_user WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}


?>

<link rel="stylesheet" href="./dashboard.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


<!-- Edit Profile Modal -->
<form method="post" action="">
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_id" name="edit_id">
                <div class="form-group">
                    <label for="edit_name">Name</label>
                    <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="edit_username">Username</label>
                    <input type="text" class="form-control" id="edit_username" name="edit_username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="edit_password">Password</label>
                    <input type="password" class="form-control" id="edit_password" name="edit_password" placeholder="Leave blank to keep current">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="save_edit_profile" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</form>

<!-- Hidden Delete Form -->
<form method="post" action="" id="deleteForm">
    <input type="hidden" name="delete_id" id="delete_id_input">
    <input type="hidden" name="delete_profile" value="1">
</form>

  <!-- // create table to display profiles -->
    <table class="table table-striped table-hover mt-4">
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
                    $eid = $row['id'];
                    $ename = htmlspecialchars($row['name'], ENT_QUOTES);
                    $eusername = htmlspecialchars($row['username'], ENT_QUOTES);
                    echo "<tr>
                        <td>" . $eid . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['username']) . "</td>
                        <td>
                            <button class='btn btn-sm btn-primary edit-btn'
                                data-id='" . $eid . "'
                                data-name='" . $ename . "'
                                data-username='" . $eusername . "'
                                data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button>
                            <button class='btn btn-sm btn-danger delete-btn' data-id='" . $eid . "'>Delete</button>
                        </td>
                    </tr>";
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.edit-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById('edit_id').value = this.dataset.id;
            document.getElementById('edit_name').value = this.dataset.name;
            document.getElementById('edit_username').value = this.dataset.username;
            document.getElementById('edit_password').value = '';
        });
    });

    document.querySelectorAll('.delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Are you sure?',
                text: 'This profile will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    document.getElementById('delete_id_input').value = id;
                    document.getElementById('deleteForm').submit();
                }
            });
        });
    });
});
</script>

<?php 
include './layout/PageFooter.php';
?>