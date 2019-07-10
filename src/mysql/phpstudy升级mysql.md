## phpstudy环境 升级mysql

1. [官网下载](https://dev.mysql.com/downloads/)，需要的版本，本次使用mysql 5.7，选择`MySQL Community Serve` 主程序下载

2. 点击跳过登录注册直接开始下载， No thanks, just start my download

3. 处理旧版本，进入 phpstudy Mysql/bin 目录下， `mysqld -remove`

4. 关闭 phpstudy 服务

5. 安装mysql 服务

6. `mysqld --install`

7. net start mysql

8. mysqld --initialize-insecure --initialize-insecure --user=mysql;

9. 首次进入 mysql -uroot -p， 回车后提示输入密码继续回车，因为没有密码。

10. `update user set authentication_string=password('你要的密码') where user='root'; `

    `flush privileges;`

11. `net stop mysql`，启动 `net start mysql`


参考文章：https://blog.csdn.net/qq_37540398/article/details/81510488

