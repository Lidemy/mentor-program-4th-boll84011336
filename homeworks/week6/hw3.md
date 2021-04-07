## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
ans:
b 元素 (<b>) 的效果是加粗。
Strong 元素 (<strong>)表示內容十分重要，一般用粗體顯示。
<nav> 元素代表一個網頁中提供導覽列連結的區域

## 請問什麼是盒模型（box modal）
就像是一個盒子，封裝周圍的HTML元素，它包括：padding(內距)、margin(外距)、border(邊框)，和實際内容。

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
block:寬高都可以調，每個元素站一行(橫的)

Inline:設定寬高沒用，他會根據內容去變寬高(內容多他就會變)，但單獨設定他的寬高都沒用。

Inline-block: 對外可以並排，對內像block可以設定寬高。

併排的時候用inline、要換一行的時候用block。


## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
1.static : 預設值，沒定位。

2.relative  : 針對自己的這個元素做定位。

3.fixed:針對瀏覽器做定位
不管怎麼改其他地方 這個固定定位都不會變。

4.abosolute:絕對定位
針對某個參考點做定位，就稱為絕對定位。
某個參考點=>網上找不是static 的元素。

東西不用特別規劃在某個位置時，使用static 

relative:寫好一個元素要將該元素放到指定區域時使用。


fixed: 要將寫好的元素放到指定區域，又不想改動到別的元素時使用。

abosolute: 要在某元素裡面對某個內容或區塊做定位時使用。(搭配relative做使用)
往上找不是static 的元素稱為參考點。
