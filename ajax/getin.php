<?php
include('../includes/app_top.php');

$action=secure_string($_GET['action']);
switch($action) {
    case 'signup':
        $username=strtolower(secure_string($_GET['username']));
        $email=strtolower(secure_string($_GET['email']));
        $password=secure_string($_GET['password']);
        $rpassword=secure_string($_GET['rpassword']);
        if($password==$rpassword)
            $pass=md5($password);
        else
            $msg='The passwords did not match!';
        if($db->db_query("INSERT INTO ".$conf->USERS_TABLE." (".$conf->USERNAME.",".$conf->EMAIL.",".$conf->PASSWORD.",".$conf->JOINDATE.") VALUES('$username','$email','$pass',NOW())"))
            $msg='The user was created!';
        echo $msg;
        break;
    case'login':
        $username=strtolower(secure_string($_GET['username']));
        $password=md5(secure_string($_GET['password']));

        $error='0';
        $msg='';

        $sql_check=$db->db_query("SELECT ".$conf->USERNAME.",".$conf->PASSWORD.",".$conf->USR_ID." FROM ".$conf->USERS_TABLE." WHERE ".$conf->USERNAME."='$username' AND ".$conf->PASSWORD."='$password'");

        if(mysql_num_rows($sql_check)) {
            $row=mysql_fetch_assoc($sql_check);
            $session->start_secure_session();
            $session->add_param("user_id",$row[$conf->USR_ID]);
            $session->add_param("username",$username);
        }else {
            $error='1';
            $msg='This user does not exist!';
        }

        echo '&error='.$error.'&msg='.$msg;
        break;
    case 'logout':
        $session->destroy();
        break;
    default:
        echo 'Oppsssyyy!';
        break;
}

?>

