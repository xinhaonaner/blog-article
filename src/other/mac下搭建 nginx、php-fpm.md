### mac下搭建 nginx、php-fpm

1. `brew install nginx`

   常用2个目录

   ```
   /usr/local/Cellar/nginx/1.15.2
   /usr/local/etc/nginx/
   ```

```
修改配置文件
sudo vim /usr/local/etc/nginx/nginx.conf

修改php解析配置为：
location ~ \.php$ {
    root   /var/www;
    fastcgi_pass   127.0.0.1:9000;
    fastcgi_index  index.php;
    fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
    #include        fastcgi_params;
    include /usr/local/etc/nginx/fastcgi.conf;
}
```

2. `brew install php72`

    现在`php-fpm`已经成为php内核的一部分了，所以直接 安装php即可

   常用目录:
   /usr/local/Cellar/php
   /usr/local/etc/php/7.2

   ```
   cd /usr/local/etc/php/7.2
   在php-fpm.d 下修改www.conf ，可以将监听端口从9000修改为其他的
   如果安装的是5.6的php版本，可能会没有 php-fpm.d 目录
   ```