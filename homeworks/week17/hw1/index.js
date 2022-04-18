const express = require("express")
const bodyParser = require('body-parser')
const session = require('express-session')
const flash = require('connect-flash');

const app = express()
const port = process.env.PORT || 5001


const userController = require('./controllers/user')
const articlesController = require('./controllers/Articles')

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
	res.locals.errorMessage = req.flash('errorMessage')
	next()
})

app.get('/', articlesController.homePage) 

function redirectBack(req, res) {
	res.redirect('back')	
}

app.get('/login', userController.login)
app.post('/login', userController.handleLogin, redirectBack)
app.get('/logout', userController.logout)

app.get('/register', userController.register)
app.post('/register', userController.handleRegister, redirectBack)

app.post('/articles',articlesController.add)

app.get('/article-page/:id', articlesController.articlePage)

app.get('/delete_articles/:id', articlesController.delete)
app.get('/update_articles/:id', articlesController.update)
app.post('/update_articles/:id', articlesController.handleUpdate)


app.listen(port, () => {
	console.log(`Example app listening on port ${port}!`)
})