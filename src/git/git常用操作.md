1. 远程分支版本回退

	- `git reflog` 或者 `git log` 查看需要回退版本的commit id
	 ![commit_id](https://cdn.xinhaonaner.cn/git_log.png)
	- `git reset --hard 【commit id】` 
	- `git push -f` 强制推送远程分支
	- 然后远程分支版本已回退
