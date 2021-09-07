	//拿留言的API	
	export function getComments(apiUrl, siteKey, before, cb) {
		let url = `${apiUrl}/api_comments.php?site_key=${siteKey}`
		if (before) {		
			url = `${url}&before=${before}`		
		}
		$.ajax({
			url,		
		}).done(function(data) {	
			cb(data)
		});
	}

	//新增留言API ,只處理API
	export function addComments(apiUrl, siteKey, data, cb){
		$.ajax({
			type: 'POST',
			url: `${apiUrl}/api_add_comments.php`,
			data: data
		}).done(function(data){				
			cb(data)					
		});
	}