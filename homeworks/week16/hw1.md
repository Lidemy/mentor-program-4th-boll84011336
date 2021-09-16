結果會是
1
3
5
2
4
因為在js中執行settimeout會將該function放入queue中等待
必須等到目前執行的主要程式都執行完之後才會去執行在queue中等待的function
所以會先執行主程式 console.log(1) console.log(3) console.log(5)
之後才會依序執行放入queue中的 setttimeout的 console.log(2)跟console.log(4)