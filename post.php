<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/18
 * Time: 11:28
 */
include 'lib.php';
include "header.php";

if (($user = isLogin() == false)) {
    header('location: index.php');
    exit();
}

$content = isset($_REQUEST['status'])?$_REQUEST['status']:'';
if ($content === '') {
    error('请填写内容');
}
$r = connRedis();
$postid = $r->incr('global:postid');
$r->set('post:postid:'.$postid.':userid', $user['userid']);
$r->set('post:postid:'.$postid.':time', time());
$r->set('post:postid:'.$postid.':content', $content);
header('location:home.php');

include "footer.php";