# ngnix支持thinkphp3.2路由重写模式的配置

即URL_MODEL=>2的情况

```
对应网站的nginx配置添加
location / {
	if (!-e $request_filename){
    	rewrite ^/(.*)$ /index.php?s=/$1 last;
    }
}
```

