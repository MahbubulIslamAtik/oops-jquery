<?php

$db=new mysqli("localhost","root","","test");
class User{
    public $id;
    public $role_id;
    public $username;
    public $password;
 
    public function __construct($_id,$_role_id,$_username,$_password){
       $this->id=$_id;
       $this->role_id=$_role_id;  
       $this->username=$_username;      
       $this->password=$_password;
    }
 
    public function save(){
     global $db;
     $db->query("insert into users(username,password,role_id,created_at)values('$this->username','$this->password','$this->role_id',now())");
     return $db->insert_id;
    }  
                                    
   
    static function get_users(){
     global $db;      
     $result=$db->query("select u.id,u.username,r.name role from users u,roles r where r.id=u.role_id");      
     $html="<table class='table table-hover'>";
     $html.="<tr><td>Id</td><td>Name</td><td>Role</td></tr>";
     while(list($id,$username,$role)=$result->fetch_row()){   

       $html.="<tr><td>$id</td><td>$username</td><td>$role</td></tr>";
     }
     $html.="</table>";
   
     return $html;
   
   }
}

?>