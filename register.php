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

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$password2 = $_REQUEST['password2'];

if (!$username || !$password || !$password2) {
    error('请完善注册信息');
}

if ($password !== $password2) {
    error('输入密码不一致');
}

$r = connRedis();
if($r->get('user:username:'.$username.':userid')) {
    error('该用户名已被注册');
}

$userid = $r->incr('global:userid');

$r->set('user:userid:'.$userid.':username',$username);
$r->set('user:userid:'.$userid.':password', $password);

$r->set('user:username:'.$username.':userid', $userid);
$r->lPush('newuserlink', $userid);
$r->lTrim('newuserlink', 0, 49);

include 'footer.php';