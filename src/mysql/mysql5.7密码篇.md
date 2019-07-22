## mysql 密码篇

修改密码：

`update mysql.user set authentication_string=password("pwd123456") where User="username" and Host="%";`
`flush privileges;`

