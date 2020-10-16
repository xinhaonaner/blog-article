### ClickHouse 常用语句

```
-- 建表
CREATE TABLE default.good_exposure_clicks
(
    id          UInt32 COMMENT '主键id',
    good_id     UInt32  default 0 COMMENT '商品id',
    exposure    UInt32  default 0 COMMENT '曝光次数',
    click       UInt32  default 0 COMMENT '点击次数',
    exposure_pv UInt32  default 0 COMMENT '曝光pv',
    click_pv    UInt32  default 0 COMMENT '点击人数',
    detail_pv   UInt32  default 0 COMMENT '商详页浏览PV',
    detail_uv   UInt32  default 0 COMMENT '商详页浏览uV',
    carts_pv    UInt32  default 0 COMMENT '加购次数',
    carts_uv    UInt32  default 0 COMMENT '加购人数',
    order_uv    UInt32  default 0 COMMENT '下单人数',
    orders      UInt32  default 0 COMMENT '日销量',
    amount      Float64 default 0 COMMENT 'skuId销量额',
    country     String  default '' COMMENT '国家/中文',
    date        Date COMMENT '日期',
    created_at  DateTime,
    updated_at  Nullable(DateTime)
) ENGINE = ReplacingMergeTree
      PARTITION BY toYYYYMM(date) ORDER BY (date, good_id, country) SETTINGS index_granularity = 8192;
      
-- 删除表
drop table good_exposure_clicks;

-- 拉取mysql数据
insert into  goods select id, created_at from mysql('127.0.0.1', 'db', 'table', 'user', 'password');

-- 优化表
optimize table good_exposure_clicks;

-- 修改字段类型
alter table good_exposure_clicks modify column good_id UInt32;

```

```
-- 分区
-- 优化分区
optimize table good_exposure_clicks partition '2020-10-08';

-- 查看表分区文件
select database, table, partition, partition_id, name, path
from system.parts
where table = 'good_exposure_clicks';

alter table test detach partition 202004 -- 卸载分区
alter table test attach partition 202004 -- 根据'分区键'挂载分区
alter table test_new attach partition 202004 from test -- 从其他表中挂载分区
alter table test attach part '202004_0_0_1' -- 根据'目录名'挂载分区

-- 删除分区文件
alter table good_exposure_clicks_test
    drop partition '2020-07-14';

```



```
-- 维护常用sql

-- 查看任务进度
select * from system.mutations;
-- 杀死进程
kill mutation where mutation_id = 'trx_id';
-- 查看连接数量
select * from system.metrics where metric like '%Connection%';
-- 查看表占用大小
select database, table, formatReadableSize(sum(bytes)) as size from system.parts group by database, table order by database, table;
-- 查看集群信息
select * from system.clusters;
-- 优化表分区
optimize table test [PARTITION partition] [FINAL]

-- 系统配置
select * from system.settings;
set send_logs_level = 'debug'; -- 修改日志级别，如 trace|debug 等等
set insert_deduplicate = 0; -- 关闭重复数据自动删除，测试数据时关闭会比较好用

-- 查询系统表当前在跑的所有megre
select * from system.merges;
```



```
-- CURD

-- 写入
insert into good_exposure_clicks (id, good_id, exposure, click, exposure_pv, click_pv, detail_pv, detail_uv,
                                  carts_pv, carts_uv, order_uv, orders, amount, country, date, created_at,
                                  updated_at)
values (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, '2020-07-15', '2020-05-14 08:10:13', '2020-06-14 08:10:13');

-- 查询
SELECT good_id,
       SUM(exposure)                    as exposures,
       SUM(click_pv)                    as click_pvs,
       SUM(detail_pv)                   as detail_pvs,
       SUM(detail_uv)                   as detail_uvs,
       SUM(carts_pv)                    as carts_pvs,
       SUM(carts_uv)                    as carts_uvs,
       SUM(order_uv)                    as order_uvs,
       ROUND(click_pvs / exposures, 2)  as click_rate,
       ROUND(order_uvs / detail_uvs, 2) as transform_rate,
       ROUND(carts_uvs / detail_uvs, 2) as carts_rate,
       SUM(orders)                      as orderses,
       ROUND(SUM(amount), 2)            as amounts,
       ROUND(orderses / amounts, 2)     as ava_price,
       any(supply_price) as supply_price
FROM good_exposure_clicks as c
         LEFT JOIN goods ON goods.id = c.good_id
WHERE c.date BETWEEN '2020-08-01' AND '2020-09-30'
and goods.category_id=1513
GROUP BY c.good_id
ORDER BY any(goods.supply_price) desc
LIMIT 0, 10;

-- 删除/更新数据
-- 该命令是异步的，并不会马上执行
alter table good_exposure_clicks delete where id > 0;
alter table good_exposure_clicks update orders=1, carts_pv=2 where id > 0;
```

参考资料：

文档

- https://clickhouse.tech/docs/en/
- https://www.jianshu.com/p/f9a54193dc63
- https://www.sohu.com/a/332065480_411876

表引擎
- https://my.oschina.net/maoxiang/blog/4617507
- https://jiamaoxiang.top/2020/09/14/%E7%AF%87%E4%BA%8C-%E4%BB%80%E4%B9%88%E6%98%AFClickHouse%E7%9A%84%E8%A1%A8%E5%BC%95%E6%93%8E/#MergeTree%E8%A1%A8%E5%BC%95%E6%93%8E

配置文件

- https://www.cnblogs.com/zhoujinyi/p/12627780.html