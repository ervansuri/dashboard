<?php
include("config.php");
session_start();
$user_check=$_SESSION['login_user'];
$admin = $db->prepare('SELECT * FROM user u, identitas i WHERE u.`kd_user`=i.`kd_user` AND username = :username');
$admin->execute(array(
                  ':username' => $user_check
                  ));
$row = $admin->fetch(PDO::FETCH_ASSOC);

$login_session=$row['nama'];
$kd_season=$row['kd_user'];
$jns_user=$row['jns_user'];

if(!isset($login_session))
{
header("Location: index.php");
}
?>