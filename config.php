<?php
$sn ="localhost";
$un ="ibrhm92";
$pass = "1992";
$dbname = "testdb";

//create connection
$con = new PDO("mysql:host=$sn;dbname=$dbname",$un ,$pass );

//check connection
if ($con){
   // echo "connected";
        }
    else{
        echo "error";
    }
