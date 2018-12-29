## Linux 常用命令

1. `kill -HUP pid 或者 killall -HUP pName `

   其中pid是进程标识，pName是进程的名称

   eg：`kill -HUP php-fpm`

2. ` lsof -i :port`

   查看端口占用情况，(list open files）