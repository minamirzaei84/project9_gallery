<?php
require './includes/init.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="includes/style.css" rel="stylesheet" type="text/css"/>
        <title>Sign up</title>
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
        <br>
        <h4 id="msg1">
            <?php
            if(isset($_SESSION['msg']))
            {
                echo $_SESSION['msg'];
                $_SESSION['msg']=FALSE;
            }
            
            ?>
        </h4>
        <br>
        <table border="2" id="table1">
            <tr>
                <td>
                    <h3> Sign up</h3>
                </td>
                <td>
                    <form method="POST" action="signup.php" id="form1">
                        <br>
                        <label> First name:<input type="text" name="fname" value=""> </label><br><br>
                        <label> Last name:<input type="text" name="lname" value=""> </label><br><br>
                        <label> Username/email:<input type="text" name="uname" value=""> </label><br><br>
                        <label> Password:<input type="password" name="pass" value=""> </label><br><br>
                        <input type="submit" name="submit" value="Signup">
                        <br>
                    </form>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>
