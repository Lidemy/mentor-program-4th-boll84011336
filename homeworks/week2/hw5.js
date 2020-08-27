function join(arr, concatStr) {
    
    result = ''  
    //先看接收的arr是幾個元素，在元素跟元素之間加入字串，回傳字串，
    //如果跑到最後一個了a!b!c! 去掉!
    for(i=0; i<arr.length-1 ; i++){
       result += arr[i] + concatStr    //["a"] = a+! =>a! 
     				                   //a! =["b"]+! =>a!b!
     }
  //加上最後一個    
  result += arr[arr.length-1]			 
   
return result
    


}

//join 會接收兩個參數：一個陣列跟一個字串，會在陣列的每個元素中間插入一個字串，最後回傳合起來的字串。

function repeat(str, times) {
    result=''
    for(i=1;i<=times;i++){   
    result = result + str  //''=''+a =>a 
                              /* a=a+a =>aa
                           aa=aa+a =>aaa
                           aaa=aaa+a =>aaaa
                           aaaa=aaaa+a =>aaaaa
                           */
      
  }
  return result
}

console.log(join(['a'], '!'));
console.log(repeat('a', 5));

// function join(arr, concatStr) {
  
//     //1.這裡面要吐回傳的東西進console
//    //2.想辦法輸出字串
//  }
 

//  console.log(join(['a,b,c'], '!')); //=>a!b!c
//  console.log(repeat('a', 5));