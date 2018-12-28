### mac-ngrok转发配置

这个在前后端联调、微信/APP本地开发调试时，可能使用到

1. 下载对应客户端： https://natapp.cn/，注册账号+实名认证

2. 解压缩：`unzip /natapp_darwin_amd64_2_3_8.zip /tmp`

3. 购买免费隧道，并且配置 

   - 如图：

   <img src='https://cdn.nlark.com/yuque/445/2018/png/209999/1543550488000-21c91ef1-73bd-44ec-aa14-5647673a91bb.png'>

   - 说明：

     本地 端口建议使用 端口<font color='red'>80</font>，原因是 公司局域网路由 支持的端口我们不清楚，一般 80端口是 开发的。

      地址IP就写项目 访问的IP，如果是本机直接安装就写 `127.0.0.1`如果是虚拟机 就写分配给 虚拟机的`IP`

4. 运行ngrok

   - `cd /tmp`切换到软件解压缩目录
   - `./natapp -authtoken=xxxxx`

5. 图中标出的是，外网访问的<font color='red'>域名</font>，指向的本机IP访问地址。

   再每次重新启动的时候，ngrok服务商都会 从新分配一个 域名（谁让这是 免费的 (*^__^*) ……）

   <img src='https://cdn.nlark.com/yuque/445/2018/png/209999/1543566551165-64b19541-c1d9-4abb-b745-eb01c9fa1eb5.png'>



   *开始你的穿透之旅吧。。。*


### 方案二 nginx转发

```
# 代理转发
server {
        listen          443 ssl;
        server_name     www.yourdomain.com; #修改为需要的一级域名即可
 
        access_log      logs/ssl.access.log;
        error_log       logs/ssl.error.log crit;
 
        include ssl_params;
 
        location / {
                index  index.html index.htm index.php;
                index  proxy_set_header Host $host;
                index  proxy_set_header X-Real-IP $remote_addr;
                index  proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
                proxy_pass http://server_cluster; #后端服务器，具体配置upstream部分即可
        }
 
    }
```

