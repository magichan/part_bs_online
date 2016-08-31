<?php



// You said that you starts session with a check:
// The fact is the $_SESSION always exists and if you aren't put 
// something in it then it will be always empty, 
// so the statment will return always true.
// --stackoverflow

//Start session

session_start();

// $_SESSION['mem_id']="cuilei";
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['mem_id']) || (trim($_SESSION['mem_id']) == '')) {
    header("location: ../stulogin.php");
    exit();
}
