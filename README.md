redis 项目
===========
## 注册用户
redis key 设计 是冗余设计

如关系型数据库表的user表需分别用到userid和username查找数据时，在redis是要分开设计key

如下：


### 以userid 查找
*   set user:userid:1:username zhansan
*   set user:userid:2:username lisi

### 以username 查找
*   set user:username:zhansan:userid:1
*   set user:username:lisi:userid:2

### 记录用户自增id
*   incr global:userid

## 记录最新注册用户

### 注册时用list 存入
*   lpush newuserlink userid
*   ltrim newuserlink 0 49
#### php使用方法
~~~
写入时
$r->lPush('newuserlink', $userid);
$r->lTrim('newuserlink', 0, 49);
读取时
$newuserlist = $r->sort('newuserlink', ['sort' => 'desc', 'get' => 'user:userid:*:username']);
~~~

## 关注用户

### key 设计

使用set
* 
### php 使用
~~~

~~~