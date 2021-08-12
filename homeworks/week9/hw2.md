## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
text 和 varchar不同的是，text不可以有默認值。

１、 varchar可變長度，可以設置最大長度；適合用在長度可變的屬性。（經常變化的欄位用varchar）

２、 text不設置長度， 當不知道屬性的最大長度時，適合用text。

補充：按照查詢速度： char最快， varchar次之，text最慢。
char長度固定， 即每條數據佔用等長字節空間；適合用在身份證號碼、手機號碼等定。


## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？

Cookie 是什麼？　Ans:指某些網站為了辨別使用者身分而儲存在用戶端（Client Side）上的資料
在 HTTP 這一層要怎麼設定 Cookie? Ans: server端可以透過HTTP的response，(在HTTP的HEADER裡有一個叫Set-cookie)，
把資料寫到cookie並儲存於瀏覽器中，在由瀏覽器發送request給Server端。


## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
1、暱稱重複的問題，可能會造成使用者無法辨別?
2、留言區塊，網址列有留言ID，可以更改ID去改別人家的留言。

