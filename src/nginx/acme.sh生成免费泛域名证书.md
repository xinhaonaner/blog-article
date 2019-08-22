# acme.sh从Letsencrypt生成免费的泛域名证书

#### 一、安装 acme.sh

```
依赖环境：curl、cron
下载并安装 `acme.sh`
curl  https://get.acme.sh | sh
```

安装完成后，在当前用户文件夹下建立一个 `.acme.sh`目录

`source ~/.bashrc`

执行 `.acme.sh`命令出现如图，表示安装成功

<img src="https://cdn.xinhaonaner.cn/xinhaonaner_cn/image_f68f54152451300da174c9d443ad1efe.png">

#### 二、申请域名解析服务商API TOKEN，并完成验证

腾讯云域名登录：[dnspod后台](https://www.dnspod.cn/Login?r=/console/user/security)

生成记得保存ID与TOKEN

<img src="https://cdn.xinhaonaner.cn/xinhaonaner_cn/image_02141ddcb06d2fce61bf2be216e33bbe.png">

执行命令，将DP_ID和DP_KEY 导入 

```
export DP_Id="xxxxxxxx"
export DP_Key="xxxxxxxxxxxxxxxxxxxxxxxxxxxx"
```

#### 三、生成泛域名证书

```
acme.sh --issue -dns dns_dp -d xinhaonaner.cn -d *.xinhaonaner.cn
```

执行成功后会在 `~/.acme.sh/xinhaonaner`目录下生成【该目录会改变】

```
ca.cer  fullchain.cer  xinhaonaner.cn.cer  xinhaonaner.cn.conf  xinhaonaner.cn.csr  xinhaonaner.cn.csr.conf  xinhaonaner.cn.key 
这些文件
```

如果web服务器是Ng的话，只需要使用到 `fullchain.cer`和 `xinhaonaner.cn.key`



到这，证书已经全部生成OK，后面就是部署了.



参考链接：

[https://github.com/Neilpang/acme.sh/wiki/%E8%AF%B4%E6%98%8E](https://github.com/Neilpang/acme.sh/wiki/说明)

https://juejin.im/post/5c38647f51882524206280ae