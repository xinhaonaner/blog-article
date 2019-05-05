### Nginx 对访问量的控制

# 目的

了解 Nginx 的 ngx_http_limit_conn_module 和 ngx_http_limit_req_module 模块，对请求访问量进行控制。



# Nginx 模块化

nginx 的内部结构是由核心模块和一系列的功能模块所组成。模块化架构使得每个模块的功能相对简单，实现高内聚，同时也便于对 Nginx 进行功能扩展。
针对 web 请求，Nginx 所有开启的模块会组成一条链，类似于闯关游戏中的一道道关卡，每个模块负责特定的功能，例如实现压缩的 ngx_http_gzip_module 模块，实现验证的 ngx_http_auth_basic_module 模块和实现代理的 ngx_http_proxy_module 模块等。连接到服务器的请求，会依次经过Nginx各个模块的处理，只有通过这些模块处理之后的请求才会真正的传递给后台程序代码进行处理。



# Nginx 并发访问控制

对于 web 服务器而言，当遇到网络爬虫，或者恶意大流量攻击访问时，会造成服务器内存和 CPU 爆满，带宽也会跑满，所以作为成熟的服务器代理软件，需要可以对这些情况进行控制。
Nginx 控制并发的方法有两种，一种是通过IP或者其他参数控制其并发量；另外一种是控制单位时间内总的请求处理量。即对并发和并行的控制，这两个功能分别由 ngx_http_limit_conn_module 和 ngx_http_limit_req_module 模块负责实现。



# ngx_http_limit_conn_module 模块



## 说明

该模块主要用于对请求并发量进行控制。



## 参数配置

- limit_conn_zone

  > 指令配置 limit_conn_zone key zone=name:size
  > 配置的上下文：http
  > 说明：key 是 Nginx 中的变量，通常为 $binary_remote_addr | $server_name；name 为共享内存的名称，size 为该共享内存的大小；此配置会申请一块共享内存空间 name，并且保存 key 的访问情况

- limit_conn_log_level

  > 语法：limit_conn_log_level info|notice|warn|error
  > 默认值：error
  > 配置上下文：http，server，location
  > 说明：当访问达到最大限制之后，会将访问情况记录在日志中

- limit_conn

  > 语法：limit_conn zone_name number
  > 配置上下文：http，server，location
  > 说明：使用 zone_name 进行访问并发控制，当超过 number 时返回对应的错误码

- limit_conn_status

  > 语法：limit_conn_status code
  > 默认值：503
  > 配置上下文：http，server，location
  > 说明：当访问超过限制 number 时，给客户端返回的错误码，此错误码可以配合 error_page 等参数，在访问超量时给客户返回友好的错误页面

- limit_rate

  > 语法：limit_rate rate
  > 默认值：0
  > 配置上下文：http，server，location
  > 说明：对每个链接的速率进行限制，rate 表示每秒的下载速度；

- limit_rate_after

  > 语法：limit_rate_after size
  > 配置上下文：http，server，location
  > 说明：此命令和 limit_rate 配合，当流量超过 size 之后，limit_rate 才开始生效



## 简单配置示例

```nginx
limit_conn_zone $binary_remote_addr zone=addr:10m;
server {
    listen       80;
    server_name  www.domain.com;
    root   /path/;
    index  index.html index.htm;
    location /ip {
      limit_conn_status 503; # 超限制后返回的状态码；
      limit_conn_log_level warn; # 日志记录级别
      limit_rate 50; # 带宽限制
      limit_conn addr 1; # 控制并发访问
    }
    # 当超过并发访问限制时，返回503错误页面
    error_page 503  /503.html;
}
```



# ngx_http_limit_req_module 模块



## 说明

该模块主要控制单位时间内的请求数。使用 “leaky bucket” (漏斗)算法进行过滤，在设置好限制 rate 之后，当单位时间内请求数超过 rate 时，模块会检测 burst 值，如果值为0，则请求会依据 delay|nodelay 配置返回错误或者进行等待；如果 burst 大于0时，当请求数大于 rate 但小于 burst 时，请求进入等待队列进行处理。



## 参数配置

- limit_req_zone

  > 语法：limit_req_zone key zone=name:size rate=rate
  > 配置上下文：http
  > 说明：key 是 Nginx 中的变量，通常为 $binary_remote_addr | $server_name；name 为共享内存的名称，size 为该共享内存的大小；rate 为访问频率，单位为 r/s 、r/m 。此配置会申请一块共享内存空间 name，并且保存 $key 的访问情况；

- limit_req

  > 语法： limit_rate zone=name [burst=number] [nodelay|delay=number]
  > 配置上下文：http，server，location
  > 说明：开启限制，burst设置最多容量，nodelay决定当请求超量是，是等待处理还是返回错误码；

- limit_req_log_level 和 limit_req_status 配置参数左右与ngx_http_limit_conn_module模块一致；



## 简单配置示例

```nginx
limit_req_zone $binary_remote_addr zone=req:10m rate=2r/m;
server {
    listen       80;
    server_name  www.domain.com;
    root   /path/;
    index  index.html index.htm;
    location / {
      limit_req zone=req burst=3 nodelay;
    }
    # 当超过并发访问限制时，返回503错误页面
    error_page 503  /503.html;
}
```



# 注意

这两种访问控制都需要申请内存空间，既然有内存空间，当然会存在内存耗尽的情况，这时新的请求都会被返回错误，所以当开启访问量限制时，需要通过监控防止此类情况发生。



# 小结

通过对 Nginx 模块化架构的简单介绍，重点了解 ngx_http_limit_conn_module 和 ngx_http_limit_req_module 模块的功能和配置参数，实现 Nginx 对请求的并发控制。如有不对，还请指教



参考：

https://www.jianshu.com/p/f9888812e89c

https://zhangge.net/4879.html

