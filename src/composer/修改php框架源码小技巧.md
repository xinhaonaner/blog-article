1. 近期某个需求，需要修改`Laravel`中 `failed_jobs`表结构，新增一个`job_id`字段，将队列ID 从`payload`字段中 移到外部
	```
	#表DDL
	CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '失败创建时间',
  `job_id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '队列id',
  PRIMARY KEY (`id`),
  KEY `idx_queue` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC
	```
2. 查看源码

	```
	此处触发：
vendor/laravel/framework/src/Illuminate/Queue/Failed/DatabaseFailedJobProvider.php
	```
	
3. 替换框架源码操方法A
	【此法实用性更高】
	
	```
	新增 DatabaseFailedJobProvider.php 文件
	路径：database/failedJob/DatabaseFailedJobProvider.php
	将源码DatabaseFailedJobProvider中的内容复制到新文件中，不要改任何东西，包括命名空间等
	
	修改composer.json，注意下面2个文件位置与格式
  "autoload": {
        "classmap": [
            "database/failedJob/DatabaseFailedJobProvider.php"
        ],
        "exclude-from-classmap": [
         "vendor/laravel/framework/src/Illuminate/Queue/Failed/DatabaseFailedJobProvider.php"
        ]
    },
    
	  最后更新composer依赖：composer dump-autoload
	```
	
4. 替换框架源码操方法B
	【有些公司，可能不允许修改composer.json 文件，鉴于这个情况，可使用方法B】
	```
	 bootstrap/app.php 文件中，require 新增文件，eg：
	 require "database/failedJob/DatabaseFailedJobProvider.php";
	 这样就会替代框架源码了
	```
	
5. `exclude-from-classmap` 属性代表，从类别图中排除某些文件或文件夹



参考连接：

https://www.jianshu.com/p/fdf21d971099

https://learnku.com/laravel/t/32290?#reply118939