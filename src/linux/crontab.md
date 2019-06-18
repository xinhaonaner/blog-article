##  Crontab定时任务

1. `crontab -e` 编写模式 
2. 第一次进入，会选择相应编辑器，习惯使用 vim，选择 ` /usr/bin/vim.tiny`
3. 从新选择编辑器：`select-editor`
4. `* * * * * /usr/bin/curl http:// www.xxx.com >> /log/cron/aaa.log`
	五个星号分别代表了分、时、日、月、周/星期。后面的url链接更换为相应的链接即可
	<font color=red>注意：星期中的0表示，周日</font>
5. 保存后，需要重启 `crontab`服务，`sudo service cron restart`
6. 查看已有的定时任务：`crontab -l`，查看当前用户下的任务


### example

```
分	 小时 	日 		月 	  星期	 命令
0-59  0-23	  1-31 	  1-12    0-6	 command


*/15   *	   *       *       *       ls  		#每15分钟执行1次 ls命令
0	   */2     *	   * 	   *       ls		#每隔2小时执行 ls命令
```

