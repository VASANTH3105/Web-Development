<?php
$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$Confirm_Password = $_POST['Confirm_Password'];
if (!empty($Username) || !empty($Email) || !empty($Password)| !empty($Confirm_Password)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "Registrat";
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT Username From regist Where Username = ? Limit 1";
     $INSERT = "INSERT Into regist (Username, Email, Password, Confirm_Password) values('$Username','$Email','$Password','$Confirm_Password')";

     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $Username);
     $stmt->execute();
     $stmt->bind_result($Username);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $result=$stmt->execute();
        echo "New record created successfully";

        
     } else {
      echo "New record inserted sucessfully";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>