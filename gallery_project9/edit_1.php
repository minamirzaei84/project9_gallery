<?php
require './includes/init.php';
$id = (int) $_GET['id'];
$gallery = new Gallery();
$photo = $gallery->selectimagewithid($id);
$row = $gallery->selectcategory();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category = $_POST['category'];
    if (isset($_POST['private'])) {
        $private = 1;
    } else {
        $private = 0;
    }
    $file = $_FILES['photo'];
    if ($file['size'] > 0) {

        $arr = explode(".", $file['name']);
        $ext = $arr[count($arr) - 1];
        $imagename = uniqid();
        if (is_uploaded_file($file['tmp_name']) && $file['error'] == 0) {
            $imgname = $imagename . "." . $ext;

            move_uploaded_file($file['tmp_name'], "images/" . $imgname);
            $gallery->make_thumb("images/" . $imgname, "", $imagename, 1, $ext, 50);
            $gallery->make_thumb("images/" . $imgname, "", $imagename, 2, $ext, 100);
            $gallery->make_thumb("images/" . $imgname, "", $imagename, 3, $ext, 200);
        }
        $res = $gallery->editnewphoto($id, $title, $body, $category, $private, $imagename, $ext);
        if ($res == TRUE) {
            unlink("images/" . $photo['imagename'] . "." . $photo['ext']);
            unlink("images/thumbnail/" . $photo['imagename'] . "-thumb1" . "." . $photo['ext']);
            unlink("images/thumbnail/" . $photo['imagename'] . "-thumb2" . "." . $photo['ext']);
            unlink("images/thumbnail/" . $photo['imagename'] . "-thumb3" . "." . $photo['ext']);
            redirect('admin.php');
        } else {
            echo "moshkel";
            die();
        }
    }
    $gallery->editphoto($id, $title, $body, $category, $private);
    redirect('admin.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="includes/style.css" rel="stylesheet" type="text/css"/>
        <title>Edit</title>
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
                    <h3>Edit a photo</h3>
                </td>
                <td>
                    <form method="POST" action="" id="form1" enctype="multipart/form-data">
                        <br>
                        <label> Title:<input type="text" name="title" value="<?php echo $photo['title']; ?>"> </label><br><br>
                        <label> Body:<textarea name="body"><?php echo $photo['body']; ?></textarea> </label><br><br>
                        <label> Thumbnail size2 :&nbsp;&nbsp;&nbsp;<img src="images/thumbnail/<?php echo $photo['imagename']; ?>-thumb2.<?php echo $photo['ext']; ?>"> </label><br><br>
                        <label> New image:<input type="file" name="photo" value=""> </label><br><br>
                        <label> Category:<select name="category">
                                <?php
                                foreach ($row as $r) {
                                    if ($r['title'] == $photo['category']) {
                                        $check = "selected";
                                    } else {
                                        $check = "";
                                    }

                                    echo "<option $check>";
                                    echo $r['title'];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </label><br><br>
                        <?php
                        if ($photo['private'] == 1) {
                            $checked = "checked";
                        } else {
                            $checked = "";
                        }
                        ?>
                        <label> private:<input type="checkbox" name="private" value="private" <?php echo $checked; ?>> </label><br><br>
                        <input type="submit" name="submit" value="Edit">
                        <br>
                    </form>
                </td>
            </tr>
        </table> <br><br><br>
    </center>
</body>
</html>




