const express = require("express")
const bodyParser = require('body-parser')
const session = require('express-session')
const flash = require('connect-flash');

const app = express()
const port = process.env.PORT || 5001


const userController = require('./controllers/user')
const prizeController = require('./controllers/prizes')


app.set('view engine','ejs')

// app.use('/static', express.static(__dirname + '/public'));
app.use(express.static(`${__dirname}/public`))


app.use(session({
	secret: 'keyboard cat',
	resave: false,
	saveUninitialized: true
}))


app.use(bodyParser.urlencoded({extended: false}))
app.use(bodyParser.json())
app.use(flash())


app.use((req, res, next) => {
	res.locals.username = req.session.username
	res.locals.isAdmin = req.session.isAdmin
	res.locals.errorMessage = req.flash('errorMessage')
	next()
})



function checkIsAdmin(req, res, next) {
  // 沒有權限 去看他有沒有進後台
	if (!req.session.isAdmin) {
    if (req.url === '/update-lottery') {
      req.flash('errorMsg', '權限不足！')
      return res.redirect('/')
    } else {
      // 取得資料前，要權限認證
      // 不能只有 res.status() 後面必須加上 .send()，這樣 fetch 的 .then 才會有 resp 能接收
      return res.status(404).send('無法顯示')
      
    }
  }
  next()
}

app.get('/', prizeController.index) //首頁
app.get('/FAQ', userController.faqPage) //常見問題

app.get('/lottery', prizeController.lotteryPage) //抽獎頁
app.get('/lottery__result', prizeController.lotteryResult)


app.get('/backstage', checkIsAdmin, prizeController.backStagePage)//後台獎項管理
app.post('/backstage', prizeController.handleAddAdmin) //後台新增
app.get('/update-lottery/:id', prizeController.updatePage) //後台更新
app.post('/update-lottery/:id', prizeController.handleUpdate) 
app.get('/delete-lottery/:id', prizeController.delete)


function redirectBack(req, res) {
	res.redirect('back')	
}



app.get('/login', userController.login)//登入
app.post('/login', userController.handleLogin, redirectBack)
app.get('/logout', userController.logout)

app.get('/register', userController.register)//註冊
app.post('/register', userController.handleRegister, redirectBack)




app.listen(port, () => {
	console.log(`Example app listening on port ${port}!`)
})