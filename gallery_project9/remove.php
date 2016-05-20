<?php
require './includes/init.php';

$id = (int) $_REQUEST['id'];

$gallery = new Gallery();

$photo = $gallery->selectimagewithid($id);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['submit'] == "Yes") {
        $gallery->removephoto($id);
        unlink("images/" . $photo['imagename'] .  "." . $photo['ext']);
        unlink("images/thumbnail/" . $photo['imagename'] . "-thumb1" . "." . $photo['ext']);
        unlink("images/thumbnail/" . $photo['imagename'] . "-thumb2" . "." . $photo['ext']);
        unlink("images/thumbnail/" . $photo['imagename'] . "-thumb3" . "." . $photo['ext']);
        redirect('admin.php');
    } else {
        redirect('admin.php');
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="includes/style.css" rel="stylesheet" type="text/css"/>
        <title>Delete</title>
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
        <table border="2" id="table1">
            <tr>
                <td>
                    <h3>Delete a photo</h3>
                </td>
                <td>
                    <form method="post" action="" id="form1">
                        <br>
                        <label>Do you really want to delete 
                            <img src="images/<?php echo $photo['imagename']; ?>.<?php echo $photo['ext']; ?>" width="75" height="75"> ? </label>
                        <input type="submit" name="submit" value="Yes">
                        <input type="submit" name="submit" value="No">
                        <br>
                    </form>
                </td>
            </tr>
        </table> <br><br><br>
    </center>
</body>
</html>




