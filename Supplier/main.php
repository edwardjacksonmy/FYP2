<?php include_once("controller.php"); ?>
<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];

if($email != false && $password != false){
    $query = "SELECT * FROM usersInfo WHERE email = '$email' AND password = '$password'";
    $run_query = mysqli_query($conn , $query);
    if($run_query){
        $fetch_data = mysqli_fetch_assoc($run_query);
        $status = $fetch_data['status'];
        if($status != "Verified"){
            header("location: otp.php");
        }
    }
}else{
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div id="container">
    <div id="header">
    <div id="logo">Brand Name</div>
    <div id="logout"><a href="logout.php">Logout</a></div>
    <div id="content">Welcome <?php
    if(isset($_SESSION['name'])){
        echo $_SESSION['name'];
    }
    ?>!</div>
    </div>
    </div>
</body>
</html>