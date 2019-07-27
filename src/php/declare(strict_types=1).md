# php 7 declare(strict_types=1) 用法

### 基本语法


`declare(strict_type=1);` 是php7引入的严格类型检查模式的指定语法

```
<?php
function add(int $a, int $b): int
{
    return $a + $b;
}

var_dump(add(1.0, 2.0));
```
输出 int(3)
我们提供的是`double`类型，但是PHP7 和PHP5处理没区别，都是隐式转换未`int`

修改
```
<?php
declare(strict_types=1);    //加入这句

function add(int $a, int $b): int
{
    return $a + $b;
}

var_dump(add(1.0, 2.0));
```
有`TypeError`错误，如下：
```
PHP Fatal error:  Uncaught TypeError: Argument 1 passed to add() must be of the type integer, float given, called in E:\www\index.php on line 9 and defined in E:\www\index.php:4
Stack trace:
#0 E:\www\index.php(9): add(1, 2)
#1 {main}
  thrown in E:\www\index.php on line 4

Fatal error: Uncaught TypeError: Argument 1 passed to add() must be of the type integer, float given, called in E:\www\index.php on line 9 and defined in E:\www\index.php:4
Stack trace:
#0 E:\www\index.php(9): add(1, 2)
#1 {main}
  thrown in E:\www\index.php on line 4
```
1. strict_types不能写在脚本中间
2. 只有在写declare的文件的执行部分才会执行严格模式,该文件中调用的其它函数(其它文件中的函数)也会被影响



参考链接：https://segmentfault.com/a/1190000018389227





