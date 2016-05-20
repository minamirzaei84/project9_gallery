<?php
require './includes/init.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = new User();
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $user->login($uname, $pass);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="includes/style.css" rel="stylesheet" type="text/css"/>
        <title>Login</title>
    </head>
    <body>
    <center>
        <table border="3">
            <tr>
                <td><a href="index.php">Sign up</a></td>
                <td><a href="login.php">Login</a></td>
                <td><a href="admin.php">Admin</a></td>
                <td><a href="gallery.php">gallery</a></td>
            </tr>
        </table>
        <br>
        <br>
        <h4 id="error1">
            <?php
            if(isset($_SESSION['msg2']))
            {
                echo $_SESSION['msg2'];
                $_SESSION['msg2']=FALSE;
            }
            
            ?>
        </h4>
        <br>
        <br>
        <table border="2" id="table1">
            <tr>
                <td>
                    <h3> Login</h3>
                </td>
                <td>
                    <form method="POST" action="login.php" id="form1">
                        <br>
                        <label> Username/email:<input type="text" name="uname" value=""> </label><br><br>
                        <label> Password:<input type="password" name="pass" value=""> </label><br><br>
                        <input type="submit" name="submit" value="Login">
                        <br>
                    </form>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>

