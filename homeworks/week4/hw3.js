//按國家名稱搜尋 https://restcountries.eu/rest/v2/name/{name}
const request = require('request');
const process = require('process');
const { argv } = require('process');

API_url ='https://restcountries.eu/rest/v2'
countryName = process.argv[2]


request(
	`https://restcountries.eu/rest/v2/name/${countryName}`,
		function(err,res,body){
			if (err) {
				return console.log('抓取失敗', err);
			}
			if (res.statusCode == 404) {
				return console.log('找不到國家資訊');
			}
			let data = JSON.parse(body);
		
			//抓回應的那一大串裡面的國家、首都...
			for (let i = 0; i < data.length; i ++) {
				console.log(
				'國家：' + data[i].name,
				'首都' + data[i].capital,
				'使用的貨幣名稱' + data[i].currency,
				'電話國碼' + data[i].callingCodes);
			  }		
		}
)




// ``` js
// 這個程式很簡單，只要輸入國家的英文名字，就能夠查詢符合的國家的資訊，會輸出以下幾項：

// 1. 國家名稱 name
// 2. 首都 capital
// 3. 使用的貨幣名稱 currency
// 4. 電話國碼 callingCodes

// 請參考以下範例：
// node hw3.js tai

// ============
// 國家：Taiwan
// 首都：Taipei
// 貨幣：TWD
// 國碼：886
// ============
// 國家：United Kingdom of Great Britain and Northern Ireland
// 首都：London
// 貨幣：GBP
// 國碼：44
// ============
// 國家：Lao People's Democratic Republic
// 首都：Vientiane
// 貨幣：LAK
// 國碼：856
// ```