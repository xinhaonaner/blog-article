## mysql5.7  binlog配置
在mysqld模块下，添加如下配置，重启服务即可
<img src="https://cdn.xinhaonaner.cn/xinhaonaner_cn/image_17ea5cc28c383d38f7bef7e6ebbc46b2.png">

binlog_format为二进制日志的类型，分别有STATEMENT、ROW、MIXED 。
5.7之后默认为ROW
1. 基于SQL语句的复制(statement-based replication, SBR)
2. 基于行的复制(row-based replication, RBR)
3. 混合模式复制(mixed-based replication, MBR)


`show variables like '%log_bin%';` 展示log_bin配置信息

<img src="https://cdn.xinhaonaner.cn/xinhaonaner_cn/image_a2e2cfd4b50954167e71742c8e08ee4b.png">

`show master status` 每次重启，从新生成一个binlog文件

`flush logs` 也会新生成 binlog文件

`reset master` 清空binlog文件

`mysqlbinlog mysql-bin.000001` mysql提供查看binlog文件工具
`mysqlbinlog -v mysql-bin.000001` 优雅的查看binlog文件
