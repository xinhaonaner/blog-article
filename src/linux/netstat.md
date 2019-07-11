###  netstat命令
`netstat [-acCeFghilMnNoprstuvVwx][-A<网络类型>][--ip]`

```
-a或--all 显示所有选项, 默认不显示LISTEN相关
-t (tcp)仅显示tcp相关选项
-u (udp)仅显示udp相关选项
-n 拒绝显示别名，直接使用IP地址，能显示数字的全部转化成数字。
-l 仅列出有在 Listen (监听) 的服务状态
-p或--programs 显示建立相关链接的程序名

-c或--continuous 持续列出网络状态。
-C或--cache 显示路由器配置的快取信息。
-e或--extend 显示网络其他相关信息。
-F或--fib 显示FIB。
-g或--groups 显示多重广播功能群组组员名单。
-h或--help 在线帮助。
-i或--interfaces 显示网络界面信息表单。
-M或--masquerade 显示伪装的网络连线。

-N或--netlink或--symbolic 显示网络硬件外围设备的符号连接名称。
-o或--timers 显示计时器。
-r或--route 显示Routing Table。
-s或--statistice 显示网络工作信息统计表。
-v或--verbose 显示指令执行过程。
-V或--version 显示版本信息。
-w或--raw 显示RAW传输协议的连线状况。
-x或--unix 此参数的效果和指定"-A unix"参数相同。
--ip或--inet 此参数的效果和指定"-A inet"参数相同。

提示：LISTEN和LISTENING的状态只有用-a或者-l才能看到
```

常用：
1. `netstat -ntlp` 显示正在监听中tcp端口