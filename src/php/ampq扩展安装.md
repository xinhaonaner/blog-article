homestead中添加ampq扩展

一、rabbitmq服务端
`sudo apt-get install rabbitmq-server`
`service rabbitmq-server status` #查看rabbitmq状态
`service rabbitmq-server start` #开启rabbitmq
二、安装rabbitmq的php扩展
1. `sudo apt-get install install librabbitmq-devel` 安装扩展依赖库

2. perl上下载 ampq扩展，https://pecl.php.net/package/amqp

3. 安装

4. ```
   sudo apt-get install php-bcmatch，apt-get install php-dom
   tar xzvf amqp-1.9.4 #解压
   cd amqp-1.0.4 
   ./configure  --with-amqp
   sudo make && make install
   修改php.ini
   extension=amqp.so 
   ```

5. 安装后，扩展存放在`/usr/lib/php`目录下，具体对应安装时的php版本
     <img src="https://upload-images.jianshu.io/upload_images/7112828-056963ba296c79ab.png">

6. 重启`service php5.6-fpm restart`
  <img src="//upload-images.jianshu.io/upload_images/2268624-762ca221dab913b3.png">



### rabbitmq常用命令
`sudo rabbitmq-plugins enable rabbitmq_management` 安装图形界面客户端

`sudo rabbitmqctl list_queues` 查看队列、消息数