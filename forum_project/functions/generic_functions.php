<?php
    function startSession(){
        if(!isset($_SESSION)){
            session_start();
        }
    }
    function defineSessionValues(){ 
    if(!isset($_SESSION['username'],$_SESSION['password'])){
        $_SESSION['username']="";
        $_SESSION['password']="";
        // $_SESSION['role']="user";
    }
    }   
    function isRequestMethodPost(){
        return $_SERVER["REQUEST_METHOD"]==="POST";
    }
?>