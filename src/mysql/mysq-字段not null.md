### mysql列属性尽量用NOT NULL
我们在设计表的时候，经常会有DBA告诉我们。
字段尽可能用NOT NULL，而不是NULL，除非特殊情况。

1. mysql官网上有这么一段话：
   ![avatar](https://cdn.xinhaonaner.cn/461ce5ed7a08af5d8d88b2ef7afedbd0.jpg)

*<u>译：记录null字段需要额外1个字节的存储空间</u>*；会增加额外来标识是否为null值

2. 如果查询中包含null列，会增加mysql的优化难度，使得索引、索引统计和值比较，更加复杂，降低了查询效率，避免全表扫描

3. null在一些强类型语言中，是一种特殊的类型，降低了代码的可读性

所以嘛，老司机建议我们，字段尽量使用NOT NULL



参考文献：

https://www.jikewenku.com/8385.html

https://www.yiichina.com/question/4388