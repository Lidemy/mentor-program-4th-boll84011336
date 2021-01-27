//GET https://api.twitch.tv/kraken/games/top

const request = require('request');



request({
		method: 'GET',
		url: 'https://api.twitch.tv/kraken/games/top',
		headers: {
		'Client-ID': 'vex7okvg18rlwasna1b59nbtnxqgpw',
		'Accept': 'application/vnd.twitchtv.v5+json'
		}
	},function(err,response,body){
			if (err) {
				return console.log('抓取失敗', err);
			}
			let data = JSON.parse(body);
			//data印出來是 total總比數 和 一個top的物件 這個top裡面有很多筆資料
			//抓第一個到最後一個依序印出
			for (let i = 0; i < data.top.length; i += 1) {
				const view = data.top[i].viewers;
				const game = data.top[i].game.name;
				console.log(view, game);
			  }
	
	})





// 請參考 [Twitch API v5]
// (https://dev.twitch.tv/docs/v5) 的文件，寫一隻程式去呼叫 Twitch API，並拿到「最受歡迎的遊戲列表（Get Top Games）」，
// 並依序印出目前觀看人數跟遊戲名稱。

// 在這個作業中，你必須自己看懂 Twitch API 的文件，知道怎麼去申請一個 Application 拿到 ClientID，
// 並且在 API 文件當中找到對的那一個 API（Get Top Games），
// 而且務必記得要在 request header 中帶上 ClientID 跟另一個參數 Accept，值是：`application/vnd.twitchtv.v5+json`。

// 還有一件事情要提醒大家，Twitch API 有兩個版本，一個是最新版（New Twitch API，代號 Helix），
// 一個是舊版的（Twitch API v5，代號 kraken），我們這次要串接的是舊版的，不要搞錯版本囉。