## PHP源码安装

1. [下载地址](https://secure.php.net/downloads.php)，[php-7.2.10.tar.bz2](https://php.net/get/php-7.2.10.tar.bz2/from/a/mirror) [(sig)](https://php.net/get/php-7.2.10.tar.bz2.asc/from/a/mirror) 

2. 解压：`tar -xzvf php-7.2.10.tar.bz2`

3. 安装：

   `apt-get install -y gcc autoconfig libxml-dev `

   `./configure --prefix=/usr/local/php7.2 --enable-fpm`

   `make `

   `make install`

4. 复制创建php.ini和php-fpm.conf和www.conf

   ```
   cp /usr/src/php-7.2.10/php.ini-production /usr/local/php7.2/etc/php.ini
   
   cp /usr/local/php7.2/etc/php-fpm.conf.default /usr/local/php7.2/etc/php-fpm.conf
   
   cp /usr/local/php7.2/etc/php-fpm.d/www.conf.default /usr/local/php7.2/etc/php-fpm.d/www.conf
   ```

5. 编辑PHP全局命令 

   ```
   vim ~/.bash_profile
   
   alias php=/usr/local/php7.2/bin/php
   alias php-fpm=/usr/local/php7.2/sbin/php-fpm
   ```

6. 启动php-fpm  

   `/usr/local/php7.2/sbin/php-fpm`

   没报错就启动成功，lsof -i:9000 可以看到进程

   添加6的命令到`/etc/rc.local `开机启动

7. 

8. 