```
server {
  listen 80;
	listen [::]:80;
	server_name xinhaonaner.cn www.xinhaonaner.cn;
	#http 跳转 htpps
	rewrite ^(.*) https://$server_name$1 permanent;
	 #HTTP_TO_HTTPS_START
    # if ($server_port !~ 443){
    #    rewrite ^(/.*)$ https://$host$1 permanent;
    # }
    #HTTP_TO_HTTPS_END

}
```

# SSL configuration
```
server {
	listen 443 ssl;
    listen [::]:443 ssl;
	ssl on;
	ssl_certificate /etc/nginx/ssl/www.xinhaonaner.cn/1_www.xinhaonaner.cn_bundle.crt;
	ssl_certificate_key /etc/nginx/ssl/www.xinhaonaner.cn/2_www.xinhaonaner.cn.key;
	server_tokens off;
	ssl_session_timeout  5m;

	# include snippets/snakeoil.conf;
	
	root /var/www/xinhaonaner;
	
	index index.php index.html;
	
	server_name xinhaonaner.cn www.xinhaonaner.cn;
	charset utf-8;
	
	location / {
		# First attempt to serve request as file, then
		# as directory, then fall back to displaying a 404.
		#try_files $uri $uri/ =404;
		try_files $uri $uri/ /index.php?$query_string;
	}
	#如果是全站 HTTPS 并且不考虑 HTTP 的话，可以加入 HSTS 告诉你的浏览器本网站全站加密，并且强制用 HTTPS 访问
	fastcgi_param  HTTPS  on;
	fastcgi_param  HTTP_SCHEME  https;
	
	ssl_protocols TLSv1 TLSv1.1 TLSv1.2; #按照这个协议配置
	ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:HIGH:!aNULL:!MD5:!RC4:!DHE; #按照这个套件配置
	
	access_log /var/log/nginx/web/www.xinhaonaner.cn.log;
	error_log /var/log/nginx/web/www.xinhaonaner.cn.error.log;
	
	# pass PHP scripts to FastCGI server
	#
	location ~ \.php$ {
		include snippets/fastcgi-php.conf;
	#
	#	# With php-fpm (or other unix sockets):
		fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
	#	# With php-cgi (or other tcp sockets):
	#	fastcgi_pass 127.0.0.1:9000;
	}
	
	location ~ /\.(?!well-known).* {
	    deny all;
	}
}

```