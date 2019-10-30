# 正确的 Composer 扩展包安装方法

```
composer install - 如有 composer.lock 文件，直接安装，否则从 composer.json 安装最新扩展包和依赖；
composer update - 从 composer.json 安装最新扩展包和依赖；
composer update vendor/package - 从 composer.json 或者对应包的配置，并更新到最新；
composer require new/package - 添加安装 new/package, 可以指定版本，如： composer require new/package ~2.5.
```


```
刷新 composer.lock 文件
使用以下命令：
composer update nothing
或者：
composer update --lock
或者：
暴力删除composer.lock文件 （哈哈）
```

```
线上安装
composer install --no-dev
```