function reverse(str) {
    revstr =''
    for(i=str.length-1 ;i>=0;i--){
       revstr = revstr + str[i]
       //console.log(revstr)
     
      //先假設str=hello ，這時候要印出來取str[4]+str[3]+str[2]+str[1]+str[0]
      //用迴圈寫，從最後一個跑到第一個，最後一個是n-1，
      //也就是字串長度-1，因為陣列從0開始，
      //然後跑到i>=0,i-1
      //跑完之後會發現上面呈現的樣子是陣列 總共跑了五行o、l、l、e、h 但要把它變成字串，要用一個空的變數去接
      //試跑一次 ''+O O跑第二次 Ol
    }
}    

reverse('hello');
console.log(revstr)



