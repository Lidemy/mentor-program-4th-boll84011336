const db = require('../models')
const Prizes = db.Prizes 
const lottery = require('../public/scripts/prizes.js')

const prizeController = {
	index: (req, res) => {
		res.render('index')
	},

	// 去撈獎項
	lotteryPage: (req, res) => {
		Prizes.findAll({
			where: {
				isDelete: 1
			},
			order: [['backstagePrizeOrder', 'ASC']]
		}).then(prizes => {
			res.render('lottery', {
				prizes
			})
		})	
	},


	//抽獎結果顯示
	lotteryResult: async(req, res) => {		
		const prizes = await Prizes.findAll({
			where: {
				isDelete: 1
			},
			order: [['backstagePrizeOrder', 'ASC']]
		})
		try {
			const Weight_result = lottery.prizeWeight_result(prizes) 
			const results = lottery.result_prize(prizes,Weight_result)
			const result = JSON.parse(JSON.stringify(results))
			res.render('lotteryResult', {
				result
			})    
		} catch (err) {
			console.log('系統不穩定，請再試一次', err.toString())
		}				
	},

	//後台獎項
	backStagePage: (req, res) => {		
		try {
			Prizes.findAll({
				order: [['backstagePrizeOrder', 'ASC']]
			}).then(prizes => {
				res.render('backstage', {
					prizes
				})
			})
		} catch (err) {
      req.flash('errorMessage', err.toString())
    }			
	},

	//抽獎新增
	handleAddAdmin: async(req, res) => {
    const { backstagePrizeOrder, prizeItem, prizeName, prizeDesc, imageUrl, prizesNumber, prizeProbability } = req.body
    if (!backstagePrizeOrder || !prizeItem || !prizeName || !prizeDesc || !imageUrl || !prizesNumber || !prizeProbability) {
			req.flash('errorMessage', 'Incomplete input fields')
			return res.redirect('back')
    }
    try {
      await Prizes.create({   
				backstagePrizeOrder,
				prizeItem,
        prizeName,
        prizeDesc,
        imageUrl,
        prizesNumber,
				prizeProbability,
				isDelete: 1
      })
			await res.redirect('/backstage')
    } catch (err) {
      req.flash('errorMessage', err.toString())
      res.redirect('back')
    }
  },

	//後台抽獎更新
	updatePage: (req, res) => {
		const { id } = req.params
		console.log("網址上面的ID", typeof(id))
		Prizes.findAll({
      order: [['backstagePrizeOrder', 'ASC']]
    }).then(prizes => {
      res.render('updateLottery', {
        prizes,
				id  
      })

    })
	},

	//req.body.content 這邊是從view的form的 name來的
	handleUpdate: async(req, res) => {
		const { backstagePrizeOrder, prizeItem, prizeName, prizeDesc, imageUrl, prizesNumber, prizeProbability } = req.body

		const isDelete = 1 //預設上架

    if (!backstagePrizeOrder || !prizeItem || !prizeName || !prizeDesc || !imageUrl || !prizesNumber || !prizeProbability) {
					
			req.flash('errorMessage', 'Incomplete input fields')
			return res.redirect('back')
    }
	
		//從ALL裡面傳回一筆要更新的
		try {
			const prize = await Prizes.findOne({
        where: {
          id: req.params.id
        }
      })		

      await prize.update({   
				backstagePrizeOrder,
				prizeItem,
        prizeName,
        prizeDesc,
        imageUrl,
        prizesNumber,
				prizeProbability,
				isDelete
      })
			
			await res.redirect('/backstage')
    } catch (err) {
      req.flash('errorMessage', err.toString())
      res.redirect('back')
    }
	},

	//刪除
	delete: async(req, res) => {
		try {
			const prize = await Prizes.findOne({
        where: {
          id: req.params.id
        }
      })		
      await prize.update({   
				isDelete: 0	
      })		
			await res.redirect('/backstage')
    } catch (err) {
      req.flash('errorMessage', err.toString())
      res.redirect('back')
    }
  }

}

module.exports = prizeController