## 請以自己的話解釋 API 是什麼
API 是一個介面，說是介面又很不好懂。我把他理解成，一套規範，類似傳紙條故事裡面的賣便當需要在紙條上寫下某些規定。
在把這個已經制定好的一套標準規範傳給大家 ，大家依照這個規範去做。

例如我要取得 20本書的書名，我必須要依照他提供的API去寫入相對應的資料，這個它提供的東西就是API。


## 請找出三個課程沒教的 HTTP status code 並簡單介紹
`409 Conflict`
表示請求與伺服器目前狀態衝突

`414 URI Too Long`
客戶端的URI請求超過伺服器願意解析的長度。


`413 Payload Too Large`
請求的實體資料大小超過了伺服器定義的上限，伺服器會關閉連接或返回一個 Retry-After 回應頭。'

## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。


Base URL: https://lidemy-book-store.herokuapp.com

| 說明     | Method | path       | 參數                  | 範例            |
|--------  |--------|------------|----------------------|----------------|
| 回傳所有餐廳資料 | GET    | /restaurant     | _limit:限制回傳資料數量           | /restaurant?_limit=5 |
| 回傳單一餐廳資料 | GET    | /restaurant/:id | 無                    | /restaurant/10      |
| 新增餐廳   | POST   | /restaurant     | name: 餐廳名稱 | 無              |
| 刪除餐廳   | DELETE   | /restaurant/:id     | 無 | 無              |
| 更改餐廳   | PATCH   | /restaurant/:id     | name: 餐廳名稱 | 無              |
