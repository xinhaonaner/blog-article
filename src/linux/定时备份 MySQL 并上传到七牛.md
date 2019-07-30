### Linux下定时备份mysql，并上传七牛

#### 准备工作

- `crontb`服务
  服务处于启动状态

- `gzip`命令

  用于压缩文件

- `mysqldump`命令

  备份数据命令

- `qshell`工具

  qshell是利用七牛文档上公开的API实现的一个方便开发者测试和使用七牛API服务的命令行工具

  文档链接：<https://developer.qiniu.com/kodo/tools/1302/qshell>

- 七牛云账号

  使用七牛云，账户当然是必须的^_^。对个人有10G免费的存储空间

  注册链接：https://portal.qiniu.com/signup?code=1hfz31vxf4zte

- 七牛存储空间

  控制台下手动创建一个空间【bucket】来存放数据
  
  

#### qshell配置
版本自行选择哦：

<img src="https://cdn.xinhaonaner.cn/xinhaonaner_cn/image_e392279767153b40d85660bb18112b8d.png">

- 下载`wget http://devtools.qiniu.com/qshell-linux-x64-v2.4.0.zip`

- 解压`unzip qshell-linux-x64-v2.4.0.zip`

- `chmod +x qshell-linux-x64-v2.4.0` 添加执行权限

- `mv unzip qshell-linux-x64-v2.4.0 /usr/local/bin/qshell`，移动bin目录下，方便全局使用，并重命名文件

- ```
密钥设置，七牛账号，ak、sk 在七牛云控制台 > 个人中心 > 密钥管理内。
  qshell account ak sk name
  该命令会将 ak/sk 账号写入 ~/.qshell/account.json
  qshell user ls 可以列举账户下所有的账户信息
  ```
  
 - 我们这里用的 qshell 命令是 rput，即以分片上传的方式上传一个文件，使用文档: https://github.com/qiniu/qshell/blob/master/docs/rput.md

 - `qshell rput if-pbl qiniu.mp4 /Users/jemy/Documents/qiniu.mp4`
    上传本地文件/Users/jemy/Documents/qiniu.mp4到空间if-pbl里面
    
    
    
  #### 撸代码

    ```
    #!/bin/sh
    # mysql data backup script
    #
    # use mysqldump --help,get more detail.
    dbname=your_dbname
    user=your_db_username
    password=your_db_password
    bakDir=/opt/backup/sql
    logFile=/opt/backup/mysqlbak.log
    datetime=`date +%Y%m%d%H%M%S`
    keepDay=7
    echo "-------------------------------------------" >> $logFile
    echo $(date +"%y-%m-%d %H:%M:%S") >> $logFile
    echo "--------------------------" >> $logFile
    cd $bakDir
    bakFile=$dbname.$datetime.sql.gz
    mysqldump -u$user -p$password $dbname | gzip > $bakFile
    echo "数据库 [$dbname] 备份完成" >> $logFile
    echo "$bakDir/$bakFile" >> $logFile
    echo "开始上传备份文件至七牛云存储" >> $logFile
    sudo /usr/local/bin/qshell rput log database/$bakFile $bakDir/$bakFile 
    echo "删除${keepDay}天前的备份文件" >> $logFile
    find $bakDir -ctime +$keepDay >> $logFile
    find $bakDir -ctime +$keepDay -exec rm -rf {} \;
    echo " " >> $logFile
    echo " " >> $logFile
    ```
    
    脚本中的数据库配置、日志文件、存放路径、`<Bucket>`等需自行修改，并存在。`database/$bakFile`，表示的是 `<Key>`，即在七牛存储中的路径&文件名，可自定义。
    
    脚本文件需可执行权限，然后可以执行脚本进行测试。



#### 定时任务

```
# 每天凌晨2点执行备份脚本
0 2 * * * /opt/backup/baksql.sh
```
- `sudo service crontal restart` 重启cron服务
- 如果定时任务未执行，可查看日志 `/var/log/cron` 排查问题，或者查看`sudo service cron status` 是否处于运行状态。