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