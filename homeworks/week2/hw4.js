function printFactor(n) {
  
    others=1
    for(i=2;i<=n;i++){
        if(n%i===0){
            console.log(i)
        }
    }
    //假設數字N=10，要印出因數要用10/2，10/3，10/4，10/.....有整除的都是因數
    //1.一樣寫迴圈去看，從2開始除，除到最後一個， 例如10/2 =5..0 整除 ，那2就是10的因數
    //把一設在條件外，因1是所有數的因數，額外看。
}

printFactor(10);
console.log(others)