## php安装redis扩展

### 主要介绍php安装phpredis扩展

1. 下载地址：https://pecl.php.net/package/redis

2. ```
   tar -zvf php-redis-4.0.1.tar.gz
   cd php-redis-4.0.1.tar.gz
   phpize
   ./configure --with-php-config=/usr/bin/php-config
   make
   sudo make install
   
   ```

3. 编译成功后会提示一个路径，表示已经将扩展放置在该位置。

4. `php-i | grep php.ini` 添加 `extension=redis.so`
