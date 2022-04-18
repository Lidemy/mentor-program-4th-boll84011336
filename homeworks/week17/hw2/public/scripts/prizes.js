const db = require('../../models')
const Prizes = db.Prizes
const lottery = {
	//獎項權重
	prizeWeight_result: (prizes) => {
		let prizeWeight = [];
		for (let i=0 ; i<prizes.length; i++) {
			if(prizes[i].isDelete == 1) {
				prizeWeight.push(prizes[i].prizeProbability) // [15 35]
			}
		}
		return prizeWeight
	},


	// //抽獎func
	result_prize: (prizes,prizeWeight) => {
		let weightSum = prizeWeight.reduce(function(prev,currVal){    
			return prev + currVal;    //prev 是前一次累加後的數值，currVal 是本次待加的數值
		},0);

		//生成一個權重亂數（0 到 weightSum 之間）
		let random_number = Math.floor(Math.random()*weightSum);

		let res = "未中獎"; 

		//權重陣列重組並排序
		let concatWeightArr = prizeWeight.concat(random_number)
		let sortedWeightArr = concatWeightArr.sort(function(a,b){return a-b});

		//索引隨機數在新權重陣列中的位置
		let randomIndex = sortedWeightArr.indexOf(random_number); 	   
		
		//取出對應獎項 頭獎 
		if(randomIndex <=1) {
			return prizes[1]
		}

		//無 arr[0] 是無 沒中獎
		if(randomIndex >=prizeWeight.length) {
			return prizes[0]
		}
		res = prizes[randomIndex];    //從獎項陣列中取出本次抽獎結果
		return res	
	}
}
module.exports = lottery