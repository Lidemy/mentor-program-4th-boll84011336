// node hw2.js list // 印出前二十本書的 id 與書名
// node hw2.js read 1 // 輸出 id 為 1 的書籍
// node hw2.js delete 1 // 刪除 id 為 1 的書籍
// node hw2.js create "I love coding" // 新增一本名為 I love coding 的書
// node hw2.js update 1 "new name" // 更新 id 為 1 的書名為 new name


const request = require('request');
const process = require('process');
const API_url = 'https://lidemy-book-store.herokuapp.com';
const action = process.argv[2] //抓取動作
const variable =  process.argv[3]


const expr = 'Papayas';
switch (action) {
	case 'list':
		list();
		break;
	case 'read':
		readbooks();
		break;
	case 'delete':
		deletebook();
		break;
	case 'create':
		addbook();
		break;
	case 'update':
		updatebook();
		break;
  default:
	//當 expression 的值都不符合上述條件
	//要執行的陳述句
    console.log(`Sorry, No conditions met.`);
}

// 印出前二十本書的 id 與書名
function list(){
	request(`${API_url}`+ "/books?_limit=20",
	function(err, res, body){
		if (err) {
			return console.log('抓取失敗', err);
		}
		let data = JSON.parse(body);
		for (let i = 0; i < data.length; i += 1) {
			console.log(`${data[i].id} ${data[i].name}`);
		  }
	})

}

// node hw2.js read 1 // 輸出 id 為 1 的書籍
function readbooks(){
	request(`https://lidemy-book-store.herokuapp.com/books/`+ variable,
	function(err, res, body){
	    let data = JSON.parse(body);
		if (err) {
			return console.log(err);
		}	
			console.log(data);     
	}) 

}


// node hw2.js delete 1 // 刪除 id 為 1 的書籍
function deletebook(){
	request.delete(
		`https://lidemy-book-store.herokuapp.com/books/`+variable,
		function(err, res, body){	
			if (err) {
				return console.log(err);
			}		
			console.log("刪除成功");      
		}
	)
	
}

// 新增一本名為 I love coding 的書

function addbook(){
	request.post(
	{
		url:`https://lidemy-book-store.herokuapp.com/books/`+variable,
		form:{
			name : variable
		}
	},	
		function(err, res, body){		
			if (error) {
				return console.log(err);
			}	
			console.log("新增成功");      
		}
	)

}

// node hw2.js update 1 "new name" // 更新 id 為 1 的書名為 new name  
// /books/:id
//更新有五個位置
function updatebook(){
	request.patch(
		{
			url:`https://lidemy-book-store.herokuapp.com/books/`+ process.argv[3],
			form:{
				name : process.argv[4]
			}
		},	
			function(err, res, body){	
				if (error) {
					return console.log(err);
				}	
				console.log("更新成功");      
			}
		)
}





