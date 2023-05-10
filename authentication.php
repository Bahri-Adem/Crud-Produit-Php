<?php
session_start();
include "connection.php";
if (isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    if (empty($uname)) {
        header("Location: login.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM simple1 WHERE username='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                if (!empty($_POST["checkbox"])) {
                    setcookie("username", $_POST["uname"], time() + 3600);
                    setcookie("password", $_POST["password"], time() + 3600);
                } else {
                    setcookie("username", "");
                    setcookie("password", "");
                }
                header("Location: index.php");
                exit();
            } else {
                header("Location: login.php?error=Incorect password");
                exit();
            }
        } else {
            header("Location: login.php?error=Incorect User name or password");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}
?>
<?php
/*if (isset($_POST['checkbox'])) {
if(!isset($_COOKIE['username']) AND !isset($_COOKIE['password']) ){
if(isset($_POST['uname']) AND isset($_POST['password'])){
$username=$_POST['uname'];
$password=$_POST['password'];
$expir=time() + 2*30*24*3600;
setcookie("username",$username,$expir);
setcookie("password",$password,$expir);
}else{
$username="";
$password="";
}
}
else {
if(isset($_POST['uname']) AND isset($_POST['password'])){
$username=$_POST['uname'];
$password=$_POST['password'];
$expir=time() + 2*30*24*3600;
setcookie("username",$username,$expir);
setcookie("password",$password,$expir);
}else {
$username=$_COOKIE['username'];
$password=$_COOKIE['password'];
}
}
}
*/
?>