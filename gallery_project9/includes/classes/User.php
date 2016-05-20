<?php

class User {
    /**
     * 
     * @return mysqli
     */
    private function globaldb() {
        global $db;
        return $db;    
    }
    public function signup($fname,$lname,$uname,$pass) {
        
       $db= $this->globaldb();
       $query= " INSERT INTO user SET firstname='$fname',lastname='$lname',username='$uname',password='$pass' " ;
       $db->query($query);
       return TRUE;
    }
    public function login($uname,$pass) {
        
        $db= $this->globaldb();
        $query=" SELECT id,firstname,lastname FROM user WHERE username='$uname' AND password='$pass'   ";
        $res = $db->query($query);
        if ($res->num_rows == 0)
        {    
            $_SESSION['msg2']="Username/Password incorect!";
            redirect('login.php');
        }else{
            
        $row = $res->fetch_assoc();
        
        $_SESSION['user_id']=$row['id'];
        $_SESSION['user_name']=$row['firstname'];
        $_SESSION['user_family']=$row['lastname'];
        
        redirect('admin.php');
        }
        
        
    }
    
    public function selectpersonwithuserid($user_id) {
         $db= $this->globaldb();
         $query="SELECT username FROM user WHERE id=$user_id";
         $res=$db->query($query);
         $result=$res->fetch_assoc();
         return $result;        
    }
    public function islogin() {
        if ( isset($_SESSION['user_id'])  ){
            return TRUE;
        }
        else {
            return FALSE;
        }
        
    }
    
}
