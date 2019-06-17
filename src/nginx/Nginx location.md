## nginx 之 location 详解
location [=|~|~*|^~] /uri/ { … }

```
location  = / {
   # 精确匹配 / ，主机名后面不能带任何字符串
    [ configuration A ] 
}  
```

```
location  / {
  # 因为所有的地址都以 / 开头，所以这条规则将匹配到所有请求
  # 但是正则和最长字符串会优先匹配
  [ configuration B ] 
}
```

```
location ~ /documents/Abc {
  # 匹配任何以 /documents/ 开头的地址，匹配符合以后，还要继续往下搜索
  # 只有后面的正则表达式没有匹配到时，这一条才会采用这一条
  [ configuration C ] 
}
```

```
location ^~ /images/ {
  # 匹配任何以 /images/ 开头的地址，匹配符合以后，停止往下搜索正则，采用这一条。
  [ configuration D ] 
}
```

```
location ~* \.(gif|jpg|jpeg)$ {
  # 匹配所有以 gif,jpg或jpeg 结尾的请求
  # 然而，所有请求 /images/ 下的图片会被 config D 处理，因为 ^~ 到达不了这一条正则
  [ configuration E ] 
}
```

```
location /images/ {
  # 字符匹配到 /images/，继续往下，会发现 ^~ 存在
  [ configuration F ] 
}
```

```
location /images/abc {
  # 最长字符匹配到 /images/abc，继续往下，会发现 ^~ 存在
  # F与G的放置顺序是没有关系的
  [ configuration G ] 
}
```

```
location ~ /images/abc/ {
  # 只有去掉 config D 才有效：先最长匹配 config G 开头的地址，继续往下搜索，匹配到这一条正则，采用
    [ configuration H ] 
}
```

## 符号解释
`location ~* /js/.*/\.js`
 =    开头表示精确匹配
 ^~ 开头表示url以某个常规字符串开头，理解为匹配url路径即可，nginx不对url做编码，因此请求为/static/20%/aa,可以被规则 ^$ /static/ /aa 匹配到
 ~  区分大小写的正则匹配
 ~* 不区分大小写的正则匹配
 !~ !~* 区分大小写不匹配及不区分大小写不匹配的正则
 / 通用匹配，任何请求都会匹配到

location = / {多个location配置的情况下匹配顺序为首先匹配 = 其次匹配 ^~ 其次是按文件中的顺序的正则匹配，最后是交给 / 通用匹配。 当匹配成功的时候，停止匹配，按当前匹配规则处理请求

##  常用变量
```
$args ： #这个变量等于请求行中的参数，同$query_string
$content_length ： 请求头中的Content-length字段。
$content_type ： 请求头中的Content-Type字段。
$document_root ： 当前请求在root指令中指定的值。
$host ： 请求主机头字段，否则为服务器名称。
$http_user_agent ： 客户端agent信息
$http_cookie ： 客户端cookie信息
$limit_rate ： 这个变量可以限制连接速率。
$status  请求状态
$body_bytes_sent 发送字节
$request_method ： 客户端请求的动作，通常为GET或POST。
$remote_addr ： 客户端的IP地址。
$remote_port ： 客户端的端口。
$remote_user ： 已经经过Auth Basic Module验证的用户名。
$request_filename ： 当前请求的文件路径，由root或alias指令与URI请求生成。
$scheme ： HTTP方法（如http，https）。
$server_protocol ： 请求使用的协议，通常是HTTP/1.0或HTTP/1.1。
$server_addr ： 服务器地址，在完成一次系统调用后可以确定这个值。
$server_name ： 服务器名称。
$server_port ： 请求到达服务器的端口号。
$request_uri ： 包含请求参数的原始URI，不包含主机名，如：”/foo/bar.php?arg=baz”。
$uri ： 不带请求参数的当前URI，$uri不包含主机名，如”/foo/bar.html”。
$document_uri ： 与$uri相同。
```