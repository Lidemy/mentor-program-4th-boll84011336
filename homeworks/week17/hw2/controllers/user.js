const bcrypt = require('bcrypt');
const saltRounds = 10;
const db = require('../models')
const User = db.User

const userController = {

	login: (req, res) => {
		res.render('user/login')
	},

	handleLogin: (req, res, next) => {
		const { username, password } = req.body
		if (!username || !password) {
			req.flash('errorMessage', '請輸入帳號或密碼')
			return next()
		}

		User.findOne({
			where: {
				username
			}
		}).then(user => {
			if (!user) {
				req.flash('errorMessage', '使用者不存在')
				return next()
			}
			//使用者輸入的Password , 資料庫來的Password 看密碼有沒有正確
			bcrypt.compare(password, user.password, function (err, isSuccess) {
				// res == true 
				if (err || !isSuccess) {
					req.flash('errorMessage', '密碼錯誤')
					return next()
				}
				req.session.username = user.username
				req.session.userId = user.id
				console.log("USER 是誰",user)
				if (user.role === 1) {
					req.session.isAdmin = true			
				}
				res.redirect('/')
			});

		}).catch(err => {
			req.flash('errorMessage', err.toString())
			return next()
		})

	},

	register: (req, res) => {
		res.render('user/register')
	},

	handleRegister: (req, res, next) => {
		const { username, password, nickname } = req.body
		if (!username || !password || !nickname) {
			return req.flash('errorMessage', '缺少必要欄位')
		}

		User.findOne({
			where: {
				username
			}
		}).then(user => {
			if (user) {
				req.flash('errorMessage', '此帳號已被註冊')
				return next()
			}
		})

		bcrypt.hash(password, saltRounds, function (err, hash) {
			if (err) {
				req.flash('errorMessage', err.toString())
				return next()
			}

			User.create({
				username,
				nickname,
				password: hash
			}).then(user => {
				req.session.username = username //新增username 之後直接是登入狀態所以把username存進session
				req.session.userId = user.id

				res.redirect('/')
			}).catch(err => {
				req.flash('errorMessage', err.toString())
				return next()
			})
		});
	},

	logout: (req, res) => {
		req.session.username = null
		req.session.isAdmin = null
		res.redirect('/')
	},

	faqPage: (req, res) => {
    res.render('faq')
  },
}

module.exports = userController