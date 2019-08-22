# nginx 图片不存在时 返回一张默认的图片

```
location ^~ /public/upload/ {
    if (!-f $request_filename) {
        #error_page 404 default.jpg;
        #error_page 404 =200 default.jpg;
        rewrite ^(.*) /public/default.jpg last;
    }
}
```

上面3种都可实现