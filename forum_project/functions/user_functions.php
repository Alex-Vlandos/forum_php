<?php
    function isLoggedInUser($username,$password){
        return (isset($username,$password) && !empty($username));
    }
    function isThereSuchUser($username,$password){
            $sqlExistsUser="SELECT user_id
            FROM users WHERE user_name='$username' AND user_password='$password'";
            $data=selectFromDb($sqlExistsUser);
            if(!empty($data)){
                return true;
            }
            return false;
    }
    function isAdmin($role){
         if(isset($role) && $role==="admin")
         {
            return true;
         }
         return false;
    }
?>   
          