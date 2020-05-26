## Mac brew install MySQL 开启binlog日志

1. vi /usr/local/etc/my.cnf

   ```
   [mysqld]
   #log_bin
   log-bin = mysql-bin #开启binlog
   binlog-format = ROW #选择row模式
   server_id = 1 #配置mysql replication需要定义，不能和canal的slaveId重复
   ```


2. mysql.server restart   // 重启mysql 或者 brew services restart mysql@5.7
3. show variables like '%log_bin%'; // 查看是否开启
4. show master status; //查看日志状态
5. flush logs; //刷新日志，刷新之后会新建一个新的Binlog日志
6. reset master; //清空日志文件
7. mysqlbinlog /usr/local/var/mysql/mysql-bin.000001;  // 查看日志文件
