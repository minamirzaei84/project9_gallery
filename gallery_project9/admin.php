<?php
require './includes/init.php';
$gallery = new Gallery();
$user = new User();
$row = $gallery->selectcategory();
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $photo = $_FILES['photo'];
    $body = $_POST['body'];
    $category = $_POST['category'];
    if (isset($_POST['private'])) {
        $private = 1;
    } else {
        $private = 0;
    }
    $arr = explode(".", $photo['name']);
    $ext = $arr[count($arr) - 1];
    $imagename = uniqid();

    $gallery->addphoto($title,$body, $imagename, $ext, $category, $user_id, $private);

    if (is_uploaded_file($photo['tmp_name']) && $photo['error'] == 0) {
        $imgname = $imagename . "." . $ext;
        move_uploaded_file($photo['tmp_name'], "images/" . $imgname);
        
        $gallery->make_thumb("images/" . $imgname, "" , $imagename,1, $ext, 50);
        $gallery->make_thumb("images/" . $imgname, "" , $imagename,2, $ext, 100);
        $gallery->make_thumb("images/" . $imgname, "" , $imagename,3, $ext, 200);
                
    }
}
if (isset($_REQUEST['exit']))
{
    session_destroy();
    redirect('admin.php');
}
    
$photosrow = $gallery->selectphotoswithuserid($user_id);
if ( $user->islogin()== TRUE) {
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
            <h4>
    <?php
    $name = $_SESSION['user_name'];
    $family = $_SESSION['user_family'];
    echo "Welcome $name $family";
    ?>

                <br>
                <form method="GET" action="admin.php">
                    <input type="submit" name="exit" value="Sign out">
                </form>
            </h4>
            <br>
            <table border="2" id="table1">
                <tr>
                    <td>
                        <h3>Upload a photo</h3>
                    </td>
                    <td>
                        <form method="POST" action="admin.php" id="form1" enctype="multipart/form-data">
                            <br>
                            <label> Title:<input type="text" name="title" value=""> </label><br><br>
                            <label> Body:<textarea name="body"></textarea></label><br><br>
                            <label> Image:<input type="file" name="photo" value=""> </label><br><br>
                            <label> Category:<select name="category">
    <?php
    foreach ($row as $r) {

        echo "<option>";
        echo $r['title'];
        echo "</option>";
    }
    ?>
                                </select>
                            </label><br><br>
                            <label> private:<input type="checkbox" name="private" value="private"> </label><br><br>
                            <input type="submit" name="submit" value="Upload">
                            <br>
                        </form>
                    </td>
                </tr>
            </table> <br><br><br>
            <h3> Photos </h3>
            <?php 
            if ($photosrow == FALSE){
                
                echo "<h2>No photo!</h2>";
                exit();
            }
                
                ?>
    <?php foreach ($photosrow as $img) { ?>
                <table border='1' id="table1">

                    <tr>
                        <th>
                            Title
                        </th>
                        <td>
        <?php echo $img['title']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Body
                        </th>
                        <td>
        <?php echo $img['body']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Category
                        </th>
                        <td>
        <?php echo $img['category']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Image
                        </th>
                        <td>
        <?php echo "<img src='images/$img[imagename].$img[ext]' width='300' height ='300'>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Private
                        </th>
                        <td>
        <?php
        if ($img['private'] == 1) {
            echo "Yes";
        } else {
            echo "No";
        }
        ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Actions
                        </th>
                        <td>
                            <?php echo "(<a href='edit_1.php?id=$img[id]'>edit</a>-<a href='remove.php?id=$img[id]'>remove</a>)"; ?>
                        </td>
                    </tr>

                </table>
                <br><br>

    <?php } ?>




        </center>
    </body>
    </html>





    <?php
} else {

    redirect('login.php');
}


