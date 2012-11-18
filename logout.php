<?php
 //remove all the variables in the session 
 @session_start(); 
 session_unset(); 
 
 // destroy the session 
 session_destroy();
 header('Location: ' . $_SERVER['HTTP_REFERER']);
?>