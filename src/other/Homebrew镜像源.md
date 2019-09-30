##  Homebrew 镜像

我们执行 brew 命令安装软件的时候，跟以下 3 个仓库地址有关：
1. brew.git
2. homebrew-core.git
3. homebrew/cask

```
禁用掉每次安装前的更新！之后需要自行手动定时更新
# ~/.zshrc 
export HOMEBREW_NO_AUTO_UPDATE=true
```

清华源:

```
git -C "$(brew --repo)" remote set-url origin https://mirrors.tuna.tsinghua.edu.cn/git/homebrew/brew.git

git -C "$(brew --repo homebrew/core)" remote set-url origin https://mirrors.tuna.tsinghua.edu.cn/git/homebrew/homebrew-core.git

git -C "$(brew --repo homebrew/cask)" remote set-url origin https://mirrors.tuna.tsinghua.edu.cn/git/homebrew/homebrew-cask.git

brew update

```

还原默认:
```
git -C "$(brew --repo)" remote set-url origin https://github.com/Homebrew/brew.git

git -C "$(brew --repo homebrew/core)" remote set-url origin https://github.com/Homebrew/homebrew-core.git

git -C "$(brew --repo homebrew/cask)" remote set-url origin https://github.com/Homebrew/homebrew-cask.git

brew update
```





参考文献：

https://mirror.tuna.tsinghua.edu.cn/help/homebrew/
https://learnku.com/articles/18908