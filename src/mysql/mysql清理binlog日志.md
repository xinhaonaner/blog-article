## Mac brew install MySQL 开启binlog日志

##### 一.手动清理binlog

```
# 查看主库和从库正在使用的binlog是哪个文件
show master status
show slave status

# 删除指定日期以前的日志索引中binlog日志文件
purge master logs before '2020-07-01 17:20:00'; 
# 删除指定日志文件的日志索引中binlog日志文件
purge master logs to'mysql-bin.000022'; 
```

这种删除方式：会将对应的文件和mysql-bin.index中对应路径删除

- `reset master`：将删除日志索引文件中记录的所有binlog文件，创建一个新的日志文件，起始值从000001开始。不要轻易使用该命令，这个命令通常仅仅用于第一次用于搭建主从关系的时的主库
- `reset slave`:清除master.info文件、relay-log.info文件，以及所有的relay log文件,并重新启用一个新的relaylog文件，使用reset slave之前必须使用stop slave 命令将复制进程停止。

##### 修改conf配置文件

- `show variables like 'expire_logs_days';  ` #查看binlog过期时间，这个值默认是0天，也就是说不自动清理
- `set global expire_logs_days = 7;`    #设置binlog 7天过期
- 手动执行flush logs
- purge binary logs to 'bin.000055';  #将bin.000055之前的binlog清掉
- purge binary logs before '2020-05-01 13:09:51';  #将指定时间之前的binlog清掉
- mysqld在每个二进制日志名后面添加一个数字扩展名。每次你启动服务器或刷新日志时该数字则增加。如果当前日志大小达到max_binlog_size,还会自动创建新的二进制日志。如果你正则使用大的事务，二进制日志还会超过max_binlog_size:事务全写入一个二进制日志中，绝对不要写入不同的二进制日志中。
- 在 my.cnf 中添加 expire_logs_days = 30，设置过期时间为30天
- max_binlog_size 默认为1G