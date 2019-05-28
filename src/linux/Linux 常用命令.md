## Linux 常用命令

1. `kill -HUP pid 或者 killall -HUP pName `

   其中pid是进程标识，pName是进程的名称

   eg：`kill -HUP php-fpm`

2. ` lsof -i :port`

   查看端口占用情况，(list open files）

3. `unrar x day1.rar`（首先需要先安装 unrar）

   解压缩 .rar文件

4. `ps -ef  |grep pwd`

5. ps 命令用于查看当前正在运行的进程。
	 a：显示当前终端下的所有进程信息，包括其他用户的进程。
	 u：使用以用户为主的格式输出进程信息。
	 x：显示当前用户在所有终端下的进程。
	 -e：显示系统内的所有进程信息。
	 -l：使用长（long）格式显示进程信息。
	 -f：使用完整的（full）格式显示进程信息。
   `ps -ef | grep java`

