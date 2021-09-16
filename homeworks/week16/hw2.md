結果會是
i: 0
i: 1
i: 2
i: 3
i: 4
之後間隔一秒 每秒都會印出
5
js會把settimeout的function放入queue中等待執行
而先執行主程式 所以會先執行console.log('i: ' + i) 印出 i: 0, i: 1...
等到執行settimeout中的console.log(i)的時候i的值已經都被改成5了
所以才會間隔1秒印出5個5
而之所以會是間隔1秒印出是因為執行settimeout的時候i的值會依序是0,1,2,3,4
因此會是指等待0,1000,2000,3000,4000(ix1000) 毫秒後再做裡面console.log的function