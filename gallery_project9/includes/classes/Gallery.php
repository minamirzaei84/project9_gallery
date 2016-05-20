<?php

class Gallery {

    /**
     * 
     * @return mysqli
     */
    private function globaldb() {
        global $db;
        return $db;
    }

    public function selectcategory() {

        $db = $this->globaldb();
        $query = " SELECT title FROM categorytable";
        $res = $db->query($query);
        $row = $res->fetch_all(MYSQLI_ASSOC);
        return $row;
    }

    public function addphoto($title,$body, $imagename, $ext, $category, $user_id, $private) {
        $db = $this->globaldb();
        $query = "INSERT INTO gallery SET title='$title' , body ='$body',imagename='$imagename' , ext='$ext' , category ='$category' , user_id='$user_id', private=$private ";
        $res = $db->query($query);
        return TRUE;
    }

    public function selectphotoswithuserid($user_id) {

        $db = $this->globaldb();
        $query = " SELECT * FROM gallery WHERE user_id='$user_id' ";
        $res = $db->query($query);
        $row = $res->fetch_all(MYSQLI_ASSOC);
        return $row;
    }

    public function selectallphotos() {

        $db = $this->globaldb();
        $query = " SELECT * FROM gallery WHERE private=0 ";
        $res = $db->query($query);
        $row = $res->fetch_all(MYSQLI_ASSOC);
        return $row;
    }

    public function selectimagewithid($id) {

        $db = $this->globaldb();
        $query = " SELECT * FROM gallery WHERE id='$id' ";
        $res = $db->query($query);
        $row = $res->fetch_assoc();
        return $row;
    }

    public function editphoto($id, $title,$body, $category, $private) {

        $db = $this->globaldb();
        $query = "UPDATE gallery SET title='$title' ,body='$body', category ='$category' , private='$private' WHERE id='$id'";
        $res = $db->query($query);
        return TRUE;
    }

    public function editnewphoto($id, $title,$body, $category, $private, $imagename, $ext) {

        $db = $this->globaldb();
        $query = "UPDATE gallery SET title='$title' , body='$body', category ='$category' , private='$private',imagename='$imagename', ext='$ext' WHERE id='$id'";
        $res = $db->query($query);
        if ($res == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function removephoto($id) {
        $db = $this->globaldb();
        $query = "DELETE FROM gallery WHERE id='$id' ";
        $res = $db->query($query);
        return TRUE;
    }
    
    function make_thumb($src, $dest,$name,$imagenumber,$ext, $desired_width) {
    $dest = "./images/thumbnail/$name-thumb$imagenumber.$ext";
	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}

}
