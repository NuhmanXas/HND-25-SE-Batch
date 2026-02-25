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

<script>
const data = {
  labels: ["January", "February", "March", "April", "May", "June", "July"],
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    backgroundColor: [
      'rgba(255, 99, 133, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};

const config = {
  type: 'bar',
  data: data,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};

const config2 = {
  type: 'line',
  data: data,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};
</script>

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
               <div class="row">
                <div class="col-lg-6"><canvas id="myChart"></canvas></div>
               <div class="col-lg-6"><canvas id="myChart2"></canvas></div>
               </div>
                <script>
                 const myChart = new Chart(
                      document.getElementById('myChart'),
                      config
                 );
                    const myChart2 = new Chart(
                        document.getElementById('myChart2'),
                        config2
                    );
                 </script>
            </div>
            </div>
        </div>
    </div>
</div>


<?php 
include './layout/PageFooter.php';
?>