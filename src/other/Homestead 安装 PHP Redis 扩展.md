# Homestead 安装 PHP Redis 扩展

1. 进入homestead 虚拟机

2. `sudo apt-get install -y php5.6-dev`

3. 下载 & 编译 PHP Redis 扩展 

   ```
   git clone https://github.com/phpredis/phpredis.git
   cd phpredis
   /usr/bin/phpize5.6 （不同php版本的情况phpize版本不同）
   ./configure --with-php-config=/usr/bin/php-config5.6 （这里边也需要根据情况指定 php-config 的版本，且和 phpize 的版本保持一致。）
   make && make install
   ```

4. 编译完成后，redis的php扩展在module目录中，它的文件名是redis.so*

5. 查看 PHP 的 extension_dir： `php -i|grep extension_dir`

6. 把 redis.so 扩展模块移入 PHP 扩展目录中

   `sudo mv ./modules/redis.so /usr/lib/php/20131226`

7. 修改 PHP 配置文件的 ini 文件

   ```
   sudo vim /etc/php/5.6/fpm/php.ini
   添加 extension=redis.so
   ```

8. 重启 `sudo service php5.6-fpm restart`