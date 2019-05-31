## 文件 & 目录操作（16 个）



#### ls

- ls -a 查看所有文件，包含隐藏文件
- ls -l 简写 ll，查看详细信息
- ls -h 文件大小以易读的方式显示



#### cd

- cd ../ 返回上级目录
- cd ~ 前往家目录
- cd - 返回上一次所在目录



#### cp

- cp -r 复制目录及目录下文件



#### find

- find /-name 'target' 查询根目录下面文件名为 target 的文件



#### mkdir

- mkdir -p /tmp/test 递归创建目录



#### mv

- mv -f source destination 强制



#### pwd

- pwd 显示当前路径



#### rm

- rm -rf / 强制删除根目录及目录下的文件，就是我们通常所说的删库跑路



#### touch

- touch target 创建 target 文件，若文件存在则改变文件时间戳



#### tree

- tree 功能是以树形结构显示目录下的内容



#### basename

- basename /tmp/1 显示文件名



#### dirname

- dirname /tmp/1 显示路径



#### chattr

- chattr +i /tmp/1 加 i 属性，防止文件被修改



#### lsattr

- lsattr /tmp/1 查看文件的扩展属性



#### file

- file /tmp/1 显示文件类型



#### md5

- md5 /tmp/1 显示文件 MD5 值

## 查看文件 & 内容处理（18 个）



#### cat

- cat -n 显示行号
- cat file1 file2 打开文件 1 和 2



#### more

- more file1 逐页显示



#### less

- less file1 也是逐页显示，与 more 方向相反



#### head

- head -n file 显示文件头 n 行



#### tail

- tail -n file 显示文件尾 n 行
- tailf file 实时显示文件尾 10 行，常用于跟踪日志信息



#### cut

- who|cut -b 1-3,5 输出每行的 1 至 3 个字节和第 5 个字节
- who|cut -c -3 输出每行的 1 至 3 个字符
- who|cut -c 3- 输出每行的第 3 个字符到行尾
- who|cut -d ' ' -f 1 以空格为分隔符，输出第一个域



#### split

- split -b 10k date.file 将文件分割为 10k 的多个子文件
- split -b 10k date.file split_file 指定子文件前缀为 split_file



#### paste

- psate file1 file2 file3 将 3 个文件按列合并



#### sort

- sort -n 按照数值大小排序
- sort -r 倒序排序
- sort -t 指定分隔符
- sort -u 忽略相同行



#### uniq

- uniq -c 显示出现次数，只有相邻的才算重复
- uniq -d 只显示重复的行
- unqi -u 只显示不重复的行



#### wc

- wc -l 显示列数



#### diff

- diff file1 file2 比较两个文件差异



#### rev

- rev file 反向输出文件内容



#### grep

- grep 'target' file 过滤输出文件中包含 target 的行
- grep -v 'target' file 过滤输出文件中不包含 target 的行
- grep -c 'target' file 过滤输出文件中包含 target 的行数
- grep -i 'target' file 忽略大小写
- egrep '[1-9]|a' file 过滤输出正则匹配到的行
- seq 10 | grep "5" -A 3 显示匹配某个结果之后的 3 行
- seq 10 | grep "5" -B 3 显示匹配某个结果之前的 3 行
- seq 10 | grep "5" -C 3 显示匹配某个结果的前三行和后三行



#### join

- join file1 file2 将两个文件中，指定栏位内容相同的行连接起来



#### tr

- cat text | tr '\t' ' ' 将制表符替换成空格



#### vim

###### 三种模式：

- 编辑模式（命令模式）

- 输入模式

- 末行模式

  ###### 模式的转换

  编辑 -> 输入

  ```php
  i: 在当前光标所在字符的前面，转为输入模式；
  
  a: 在当前光标所在字符的后面，转为输入模式；
  
  o: 在当前光标所在行的下方，新建一行，并转为输入模式；
  
  I：在当前光标所在行的行首，转换为输入模式
  
  A：在当前光标所在行的行尾，转换为输入模式
  
  O：在当前光标所在行的上方，新建一行，并转为输入模式；
  ```

  输入 -> 编辑

  ```php
  ESC
  ```

  编辑 -> 末行：

  ```php
  :
  ```

  末行 -> 编辑：

  ```php
  ESC,ESC
  ```

  ###### 打开文件

  ```php
  vim +# :打开文件，并定位于第#行
  
  vim +：打开文件，定位至最后一行
  
  vim +/PATTERN : 打开文件，定位至第一次被PATTERN匹配到的行的行首
  ```

  ###### 关闭文件

  ```php
  :q  退出
  
  :wq 保存并退出
  
  :q! 不保存并退出
  
  :w 保存
  
  :w! 强行保存
  ```

  ###### 移动光标（编辑模式）

- 逐字符移动

  ```php
  h: 左
  
  l: 右
  
  j: 下
  
  k: 上
  
  #h: 移动#个字符
  ```

- 以单词为单位移动

  ```php
  w: 移至下一个单词的词首
  
  e: 跳至当前或下一个单词的词尾
  
  b: 跳至当前或前一个单词的词首
  
  #w: 移动#个单词
  ```

- 行内跳转

  ```php
  0: 绝对行首
  
  ^: 行首的第一个非空白字符
  
  $: 绝对行尾
  ```

- 行间跳转

  ```php
  #G：跳转至第#行
  
  gg: 第一行
  
  G：最后一行
  ```

  ###### 翻屏

  ```php
  Ctrl+f: 向下翻一屏
  
  Ctrl+b: 向上翻一屏
  
  Ctrl+d: 向下翻半屏
  
  Ctrl+u: 向上翻半屏
  ```

  ###### 删除单个字符

  ```php
  x: 删除光标所在处的单个字符
  
  #x: 删除光标所在处及向后的共#个字符
  ```

  ###### 删除命令: d

  ```php
  dd: 删除当前光标所在行
  #dd: 删除包括当前光标所在行在内的#行；
  ```

  ###### 撤消编辑操作

  ```php
  u：撤消前一次的编辑操作
  
  #u: 直接撤消最近#次编辑操作
  
  连续u命令可撤消此前的n次编辑操作
  
  撤消最近一次撤消操作：Ctrl+r
  ```

  ###### 查找

  ```php
  /PATTERN
  
  ?PATTERN
  
  n 下一个
  
  N 上一个
  ```



## 文件压缩 & 解压缩（3 个）

#### tar

- tar zxvf FileName.tar.gz 解压
- tar zcvf FileName.tar.gz DirName 压缩



#### zip

- zip -r html.zip/home/html 递归压缩



#### unzip

unzip test.zip -d /tmp 解压到指定目录下

## 信息显示（11 个）



#### uname

- uanme -a 显示系统全部信息



#### hostname

- hostname 显示主机名



#### dmesg

- dmesg 显示开机信息



#### uptime

- uptime 显示系统运行时间及负载



#### stat

- stat 显示文件的状态信息



#### du

- du -sh 显示路径下所有文件大小
- du -sh local 显示路径下 local 目录文件大小
- du -sh * 显示路径下所有目录文件大小



#### df

- df -h 显示系统磁盘空间的使用情况



#### top

- top 实时显示系统资源使用情况



#### free

- free -m 以 M 为单位查看系统内存



#### date

- date +"%Y-%m-%d" 2019-05-28
- date -d "1 day ago" +"% Y-% m-% d" 输出昨天日期
- date -d "+1 day" +% Y% m% d 显示前一天的日期
- date -d "-1 day" +% Y% m% d 显示后一天的日期
- date -d "-1 month" +% Y% m% d 显示上一月的日期
- date -d "+1 month" +% Y% m% d 显示下一月的日期
- date -d "-1 year" +% Y% m% d 显示前一年的日期
- date -d "+1 year" +% Y% m% d 显示下一年的日期



#### cal

- cal 日历信息

- ## 搜索文件（4 个）

  

  #### which

  - which pwd 显示命令路径

  

  #### find

  - find /-name 'target' 查询根目录下面文件名为 target 的文件

  

  #### whereis

  - whereis php 查找二进制命令

  

  #### locate

  - locate target 从数据库 (/var/lib/mlocate/mlocate.db) 查找目标文件，使用 updatedb 更新库

  

  ## 进程管理（11 个）

  

  #### jobs

  - jobs 查看当前有多少在后台运行的命令

  

  #### bg

  - bg 1 将一个在后台暂停的命令，继续执行，1 为作业号
    （ctrl+z）可以挂起程序，返回作业号

  

  #### fg

  - fg 1 将后台中的命令调至前台继续运行 ，1 为作业号

  

  #### kill

  - kill 进程号 杀进程
  - kill -9 进程号 强杀进程

  

  #### killall

  - killall php 通过进程名字杀进程
  - killall -9 php 通过进程名字强杀进程

  

  #### pkill

  - 用法同上

  

  #### crontab

  - crontab -l 查看定时任务
  - crontab -e 编辑定时任务
  - crontab -l -u user1 查看 user1 定时任务，只有 root 才有权限
  - crontab -e -u user1 编辑 user1 定时任务，只有 root 才有权限

  

  #### ps

  - ps -ef 查看进程，显示 UID,PPIP,C 与 STIME，每个程序所使用的环境变量栏位
  - ps -axu 查看所有进程，并显示属于用户

  

  #### pstree

  - pstree -p 显示当前所有进程的进程号和进程 id 树
  - pstree -a 显示所有进程的所有详细信息树

  

  #### nohup

  - nohup command & 退出账户时不挂断程序，仍在后台运行

  

  #### pgrep

  - pgrep -l httpd 查找 http 相关的进程号

  ## 用户管理（7 个）

  

  #### useradd

  - useradd boy -u 888 建立一个新用户账户，并设置 ID
  - useradd –g sales jack –G company,employees
    -g：加入主要组 -G：加入次要组

  

  #### usermod

  - usermod -G staff newuser2 将 newuser2 添加到组 staff 中
  - usermod -l newuser1 newuser 修改 newuser 的用户名为 newuser1
  - usermod -L newuser1 锁定账号 newuser1
  - usermod -U newuser1 解除对 newuser1 的锁定

  

  #### userdel

  - userdel -f user1 强制删除用户
  - userdel -r user1 删除用户的同时，删除与用户相关的所有文件

  

  #### groupadd

  - groupadd -g 1000 group1 建立一个新组，并设置组 ID 加入系统

  

  #### passwd

  - passwd user1 修改 user1 密码
  - passwd -l user1 锁住密码
  - passwd -d user1 删除密码

  

  #### su

  - su root 切换身份

  

  #### sudo

  - sudo command 已管理员身份运行命令
  
  ## 网络操作（11 个）
  
  
  
  #### telnet
  
  - telnet 127.0.0.1 登录远程主机
  
  
  
  #### ssh
  
  - ssh root@127.0.0.1 -p22 登录远程主机
  
  
  
  #### scp
  
  - scp local_file remote_username@remote_ip:remote_folder 本地拷贝到远程
  - scp remote_username@remote_ip:remote_folder local_file 远程拷贝到本地
  
  
  
  #### wget
  
  - wget url 下载一个文件
  - wget --limit-rate=300k url 限速下载
  - wget -c url 断点续传
  - wget -b url 后台下载
  
  
  
  #### ping
  
  - ping www.baidu.com -c 2 收到两个包就结束
  
  
  
  #### route
  
  - route 显示当前路由
  
  
  
  #### ifconfig
  
  - ifconfig 查看、配置、启用或禁用网络接口
  
  
  
  #### ifup
  
  - ifup eth0 开启 eth0 网卡
  
  
  
  #### ifdown
  
  - ifdown eth0 关闭 eth0 网卡
  
  
  
  #### netstat
  
  - netstat -at 列出所有 tcp 端口
  - netstat -au 列出所有 udp 端口
  - netstat -l 只显示监听端口
  
  
  
  #### ss
  
  - ss -t -a 显示所有 tcp 链接
  - ss -l 显示处于监听状态的套接字
  
  ## 磁盘 & 文件系统（7 个）
  
  
  
  #### mount
  
  - mount /dev/hda1 /mnt 将 /dev/hda1 挂载到 /mnt 目录下
  
  
  
  #### umount
  
  - umount -v /mnt/mymount/ 卸载 /mnt/mymount/
  
  
  
  #### fsck
  
  - fsck -y /dev/hda2 检查并修复 Linux 文件系统
  
  
  
  #### dumpe2fs
  
  - dumpe2fs /dev/hda1 查看文件系统信息
  
  
  
  #### dump
  
  - ‍dump -0u -f /tmp/homeback.bak /home
    将 /home 目录所有内容备份到 /tmp/homeback.bak 文件中，备份层级为 0 并在 /etc/dumpdates 中记录相关信息
  
  
  
  #### fdisk
  
  - fdisk /dev/sdb
    输入 m 列出可以执行的命令
    输入 p 列出磁盘目前的分区情况
    输入 d 然后选择分区，删除现有分区
    输入 print 查看分区情况，确认分区已经删除
    输入 n 建立新的磁盘分区
    输入 w 最后对分区操作进行保存
  
  
  
  #### mkfs
  
  - mkfs -t ext3 /dev/sda6 将 sda6 分区格式化为 ext3 格式
  
  ## 系统权限（3 个）
  
  
  
  #### chmod
  
  - chmod 777 file1 修改 file1 文件权限为 777
  - chmod u+x,g+w file1 为 file1 设置自己可以执行，组员可以写入的权限
  
  
  
  #### chown
  
  - chown -R root /usr/meng 修改将目录 /usr/meng 及其下面的所有文件、子目录的文件主改成 root
  
  
  
  #### chgrp
  
  - chgrp -R mengxin /usr/meng 将 /usr/meng 及其子目录下的所有文件的用户组改为 mengxin
  
  
  
  ## 关机重启（5 个）
  
  
  
  #### shutdown
  
  - shutdown -h now 立即关机
  - shutdown +5 "System will shutdown after 5 minutes" 指定 5 分钟后关机，同时送出警告信息给登入用户
  
  
  
  #### halt
  
  - halt -p 关闭系统后关闭电源
  - halt -d 关闭系统，但不留下纪录
  
  
  
  #### poweroff
  
  - poweroff -f 强制关闭操作系统
  
  
  
  #### logout
  
  - logout 退出当前登录的 Shell
  
  
  
  #### exit
  
  - exit 退出当前登录的 Shell
  
  ## 其他（6 个）
  
  
  
  #### echo
  
  - echo 'hello' 打印字符串、变量
  
  
  
  #### print
  
  - printf 'hell0' 格式化输出字符串
  
  
  
  #### rpm
  
  - rpm -ivh your-package.rpm 安装 rpm 包
  - rpm -Uvh your-package.rpm 升级 rpm 包
  - rpm -e package 卸载
  - rpm -qa 列出所有安装过的包
  - rpm -ql 包名 rpm 包中的文件安装到那里去
  
  
  
  #### yum
  
  - yum install php 安装 php
  - yum remove php 卸载 php
  
  
  
  #### clear
  
  - clear 清屏
  
  
  
  #### history
  
  - history 10 最近使用的 10 条历史命令