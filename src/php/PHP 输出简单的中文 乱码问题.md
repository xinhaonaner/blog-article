# PHP 输出简单的中文 乱码问题

```
// 解决方案有两种，都必须在文件输出字符前声明(哪怕一个换行一个空格也不行，都会导致设置上的失效)
 
// 解决方案1：HTML方式
echo '<meta http-equiv="Content-Type" content="text/hmtl; charset=utf-8" />';
 
// 解决方案2：PHP方式
header('Content-Type:text/html; charset=utf-8;');
```

