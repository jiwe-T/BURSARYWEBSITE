<?php 

session_start(); 

include "config.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $username = validate($_POST['username']);

    $password = validate($_POST['password']);

    if (empty($username)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($password)){

        header("Location: index.php?error=Password is required");

        exit();

    }

        $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['username'] === $username && $row['password'] === $password) {

                echo "Logged in!";

                $_SESSION['username'] = $row['username'];

                $_SESSION['FirstName'] = $row['FirstName'];

                $_SESSION['id'] = $row['id'];

                header("Location: admindash0.php ");

                exit();

            }else{

                header("Location: index.php?error=Incorect User name or password");

                exit();

            }

        

}else{

    header("Location: index.php");

    exit();

}
}
?>