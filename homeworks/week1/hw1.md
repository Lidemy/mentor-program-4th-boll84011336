## 交作業流程
首先將git hub設好 做好這些前置作業後
將作業下載到自己的電腦 再來開啟作業

1.新開一個 branch：`git branch hw1`
2.切換到這個分支 : `git checkout hw1`
編寫完作業後將所有改動的檔案加入 staged 區 : `git add`
3.寫完這次的作業之後儲存並提交 `git commit 'hw1作業完成'`
4.推到遠端 : `Git push origin hw1` 


5.再來回到github 點 pull Reuest 完成交作業。`把 local 當前的 branch hw1 push 到 github 的 repository 的 branch hw1`

6.打 merge 的標題跟 comment，最後按下 `Create pull request`

7.前往 Lidemy Learning System 的 `作業列表`，並選擇 `新增作業` 然後貼上PR，確認作業沒問題以及也看過檢討後，按確認

8.助教改完，這邊會幫你把hw1分支合併到你的master

9.助教合併完之後，
回到本地端做 git pull 同步遠端以及地端的 master
`git checkout master`
`git pull origin master`

10.同步完成後，就可以刪掉本地端的 week1 branch
`git branch -d week1`
`$ git branch -v` 檢查分支


完成!!