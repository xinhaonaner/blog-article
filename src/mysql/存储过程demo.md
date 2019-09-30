## Mysql 存储过程
存储过程是为了完成特定功能的SQL语句集，经编译创建并保存在数据库中，用户可通过指定存储过程的名字并给定参数(需要时)来调用执行。

存储过程，可以说是数据库 SQL 语言层面的代码封装与重用。

下面是一位测试同学，让我帮忙写的
用于查询，某个手机号，在一段时间内发送短信统计：

```
# 表结构 大致如下，按天生成
CREATE TABLE `sms_order_20190830` (
  `sms_order_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `app_id` int(9) NOT NULL COMMENT '应用编号',
  `channel_id` int(11) NOT NULL COMMENT '渠道编号',
  `mobile` varchar(20) NOT NULL COMMENT '手机号码',
  `order_retry` int(11) DEFAULT '0' COMMENT '1=压单重试，0=正常发送',
  `order_retry_time` datetime(3) DEFAULT NULL COMMENT '1=压单恢复时间',
  PRIMARY KEY (`sms_order_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='日订单表';
```

```
DROP PROCEDURE IF EXISTS `Static_mobile`;

# 创建存储过程
CREATE PROCEDURE `Static_mobile`(IN `mobile` varchar(255),IN `begin_date` int(10),IN `end_date` int(10))

BEGIN
 # 表名
 DECLARE table_name VARCHAR(255);
 # 执行sql
 DECLARE query_sql VARCHAR(1000) DEFAULT '';
 # 日期时间
 DECLARE query_date VARCHAR(255);
 # 查询字段，此处*号，可以替换为 具体字段
 DECLARE basic_sql VARCHAR(255) DEFAULT 'SELECT * FROM ';
 # 查询条件语句
 DECLARE basi_where_sql VARCHAR(255) DEFAULT ' WHERE mobile = ';

 # 格式化查询日期
 SET query_date = FROM_UNIXTIME(begin_date,'%Y%m%d');


  # 循环拼接查询sql
  WHILE begin_date < end_date  DO
			
			# 表名设置
			SET table_name = CONCAT("sms_order_", FROM_UNIXTIME(begin_date,'%Y%m%d'));
			# 动态拼接sql
			SET query_sql = CONCAT(query_sql, basic_sql, table_name, basi_where_sql , mobile);

			# 如果是最后一天，不拼接 UNION ALL
			IF (begin_date + 86400) < end_date THEN
			SET query_sql = CONCAT(query_sql,' UNION ALL ');
			END IF;

			# 时间按天递增
			SET begin_date = begin_date + 86400;
   END WHILE;
		
		# 赋值给全局变量
		SET @ms=query_sql; 
    # 预处理需要执行的动态SQL
    PREPARE stmt FROM @ms;  
		# 执行sql
    EXECUTE stmt;
		# 释放prepare
		deallocate prepare stmt;
END;

```

参考文献：
https://www.runoob.com/w3cnote/mysql-stored-procedure.html