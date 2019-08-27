### 关闭git文件权限跟踪

`git`默认会跟踪文件的权限修改

1. 在项目下，``cat .git/config` `，查看目前状况，是否已经设置过
<img src="https://cdn.xinhaonaner.cn/xinhaonaner_cn/image_79dfe011f869ce4f6a8327676b84b88a.png">

2. `filemode=true`时，会跟踪文件的权限修改

3. 运行`git config core.filemode false`即可

   <img src="https://cdn.xinhaonaner.cn/xinhaonaner_cn/image_b84146ee2ea868ce3db09b3b55e5bbbd.png">
