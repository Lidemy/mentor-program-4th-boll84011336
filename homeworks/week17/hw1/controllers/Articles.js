const db = require('../models')
const User = db.User
const Articles = db.Articles

const articlesController = {
  homePage: async(req, res) => {
    const articles = await Articles.findAll({
      order: [['id', 'DESC']],
      include: User  
    })
    res.render('index', {
      articles
    })
  },
  add: (req, res) => {
		const {userId} = req.session //這從登入帳號存在session的帳號 ，用解構語法拿出來的
		const {content} = req.body //從輸入框拿的
		const {title} = req.body
		if (!userId || !content) {
			return res.redirect('/')
		}

		Articles.create({
			title,
			content,
			UserId: userId
		}).then(() => {
			res.redirect('/')
		})
  },

	articlePage: async(req, res) => {
    // id 本來就是 URL 的一部分，所以不用特地檢查
    const { id } = req.params

		Articles.findOne({
      where: {
        id: req.params.id,
      },
			include: User
    }).then(article => {
      res.render('page/article_page', {
        article      
      })
    })
  },


	//這邊傳username是為了確認這個id是不是真的有這篇文章，不然id可以隨意竄改
	delete: (req, res) => {
    Articles.findOne({
      where: {
        id: req.params.id,
        UserId: req.session.userId
      }
    }).then(articles => {
      return articles.destroy()
    }).then(() => {
      res.redirect('/')
    }).catch(() => {
      res.redirect('/')
		})
  },


	update: (req, res) => {
		Articles.findOne({
      where: {
        id: req.params.id,
      }
    }).then(article => {
      res.render('update', {
        article      
      })
    })
	},

	//req.body.content 這邊是從view的form的 name來的
	handleUpdate: (req, res) => {
		Articles.findOne({
      where: {
        id: req.params.id,
        UserId: req.session.userId
      }
    }).then(article => {
      return article.update({
				title: req.body.title,
				content: req.body.content
			})
    }).then(() => {
      res.redirect('/')
    }).catch(() => {
      res.redirect('/')
		})
	}
}

module.exports = articlesController