<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/17
 * Time: 13:52
 */

function error ($msg) {
    echo $msg;
    include('footer.php');
    exit;
}

function connRedis() {
    static $r = null;

    if ($r !== null) {
        return $r;
    }
    $r = new redis();
    $r->connect('localhost');
    return $r;
}

function isLogin(){
    if (!$_COOKIE['userid'] || !$_COOKIE['username']){
        return false;
    }
    return ['userid' => $_COOKIE['userid'], 'username' => $_COOKIE['username']];
}