const request = require('request');
request(
	`https://lidemy-book-store.herokuapp.com/books?_limit=10`,
		function(err,response,body){
			if (err) {
				return console.log('抓取失敗', err);
			}
			let data = JSON.parse(body);
			for (let i = 0; i < data.length; i += 1) {
				console.log(`${data[i].id} ${data[i].name}`);
			  }		
		}
)