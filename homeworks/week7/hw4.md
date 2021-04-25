## 什麼是 DOM？
Ans:把一個Document(文件)轉換成object。瀏覽器提供DOM這個橋梁讓我們用JavaScript去改變畫面上的東西，再利用JavaScript，去抓到每個元素去做改變。
DOM 是瀏覽器所產生出來的資料結構，一方面表現出 HTML 的內容與架構，另一方面讓開發者有機會使用 JavaScript 透過 DOM 來操作頁面。

透過js去拿到dom的物件(拿到元素)，針對元素做改變

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
Ans:事件傳遞的機制是，先捕獲後冒泡。(當事件傳遞到target的時候沒有分捕獲和冒泡)
冒泡:由事件目標依序向外，過程中觸發個別元素的冒泡階段事件監聽。
捕獲:由 DOM 樹的最外層依序向內曾跑，過程中觸發個別元素的捕獲階段事件監聽。

## 什麼是 event delegation，為什麼我們需要它？
Ans:event delegation，稱為事件代理，假設今天一個表單內，有10個按鈕，這樣要對10個按鈕都下監聽
會很費力又不省事。
有效的使用event delegation，可以透過事件的冒泡機制，達到只對單一元素做監聽，就能傳到其他按鈕上。


## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
Ans: 
event.preventDefault() : 阻止預設事件發生。 下了這個之後事件就不會觸發。會停下來。
event.stopPropagation() : stopPropagation只是阻止上層的監聽，這個只適用於阻止上一層的事件發生。簡言之event.stopPropagation()的作用就是為了阻止事件繼續冒泡!

範例 :event.preventDefault() 
<a id="clickMe" href="https://ithelp.ithome.com.tw/articles?tab=tech">跳到google</a>
<script>
document.getElementById('clickMe').onclick = () =>{
  console.log('跳頁的事件')
  //取消DOM預設功能
  event.preventDefault()
}
</script>
## 如此一來就會取消，連結的預設事件。(即點了連結沒反應)

範例 :event.stopPropagation() 
<div id="outside" style="background-color:#AAAAAA">
	<div id="inside" style="background-color:#888888">
	<input id="clickMe" type="button" value="點我"/>
	</div>
</div>

<script>
document.getElementById('outside').onclick = () =>{
  console.log('外面的div')
}
document.getElementById('inside').onclick = () =>{
  console.log('裡面的div')
}

document.getElementById('clickMe').onclick = () =>{
  console.log('觸發按鈕的事件')
  //阻止事件繼續冒泡
  event.stopPropagation()
}

## 這個範例，因為三個DOM很剛好的重疊了，所以點擊後會觸發所有的click事件，這個現象我們稱呼為「事件冒泡」。
而event.stopPropagation()可以阻止事件繼續冒泡。
原本點擊按鈕後執行完的順序會是:
觸發按鈕的事件
裡面的div
外面的div

加了event.stopPropagation()，就阻止事件冒泡，只會 "執行觸發按鈕的事件"。
</script>
