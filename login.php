<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/17
 * Time: 13:52
 */
error_reporting(0);

include ('header.php');
include ('lib.php');

if(isLogin() !== false) {
    header('location: home.php');
    exit();
}

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if (!$username || !$password ) {
    error('请完善信息');
}


$r = connRedis();
$userid = $r->get('user:username:'.$username.':userid');
if(!$userid) {
    error('没有该用户');
}

$realpass = $r->get('user:userid:'.$userid.':password');
if ($password != $realpass) {
    error('密码不正确');
}

setcookie('username', $username);
setcookie('userid', $userid);

header('location:home.php');