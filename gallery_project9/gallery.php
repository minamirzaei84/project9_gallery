<?php
require './includes/init.php';
$gallery = new Gallery();
$photosrow = $gallery->selectallphotos();
    ?>

    <html>
        <head>
            <meta charset="UTF-8">
            <link href="includes/style.css" rel="stylesheet" type="text/css"/>
            <title>Gallery</title>
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
            <h3> Gallery </h3>
                <br>
            <br>
<?php
if ($photosrow == FALSE)
{
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
                            Image by thumbnail
                        </th>
                        <td>
        <?php echo "<img src='images/thumbnail/$img[imagename]-thumb1.$img[ext]'>"; ?>
        <?php echo "<img src='images/thumbnail/$img[imagename]-thumb2.$img[ext]'>"; ?>
        <?php echo "<img src='images/thumbnail/$img[imagename]-thumb3.$img[ext]'>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Photo by
                        </th>
                        <td>
        <?php 
        $user = new User();
        $user_id=$img['user_id'];
        $person=$user->selectpersonwithuserid($user_id);
        echo $person['username'];
        ?>
                        </td>
                    </tr>
                </table>
                <br><br>

    <?php } ?>




        </center>
    </body>
    </html>


