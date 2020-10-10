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

-- 删除分区文件
alter table good_exposure_clicks_test
    drop partition '2020-07-14';
-- 系统分区
select *
from system.mutations;
```



```
-- 查询、写入

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
```

