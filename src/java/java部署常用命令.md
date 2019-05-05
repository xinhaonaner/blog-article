### Java部署常用命令

1. 运行jar包
	a. ` java -jar xxx.jar`
	b.  `java -jar xxx.jar &`
	c. ` nohup Java -jar xxx.jar &` (nohup 意思是不挂断运行命令,当账户退出或终端关闭时,程序仍然运行)
	d. `nohup java -jar xxx.jar >demo.log &` (demo.log 是将command的输出重定向到文件)
2. `netstat -nlp |grep :80`
3. `jps` -l (输出应用程序主类完整package名称或jar完整名称.)

