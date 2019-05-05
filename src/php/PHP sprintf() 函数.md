# PHP sprintf() 函数



基本语法格式：sprintf("%格式化类型","$str1","$str2") ；先别急我会一个个慢慢说

先看一下类型参照表，也就是要转换成什么类型的格式

![image](https://images2015.cnblogs.com/blog/989977/201607/989977-20160710133614452-779011077.png)

```
<?php
$str1="1234";

echo sprintf("hello%s","$str1");

//效果为： hello1234

?>
```

这什么意思呢

要点：

%s = %符号和后面属性符号(s)总称为插入标记组合，也就是把后面准备进行格式化的值($str1)替换在这个位置 

hello = 这个单词就是很多人蒙蔽的地方，告诉你这个什么代表也没有，就单纯的代表一个hello，用于分割或者修饰用，一般用[ %s ]、<%s>这样格式化出来后就直接在标签里



参考链接 [https://www.cnblogs.com/bushuo/p/5657730.html](https://www.cnblogs.com/bushuo/p/5657730.html)

