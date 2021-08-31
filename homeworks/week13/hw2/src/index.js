import { getComments, addComments } from './api'
import { appendCommentToDom, appendStyle } from './utils'
import { cssTemplate, getLoadMoreButton, getForm } from './Template'
import $ from 'jquery'

//初始化 (傳一個物件進去，options是一個物件)
export function init (options) {
	let siteKey = ''
	let apiUrl = ''
	let containerElement = null
	let commentDOM = null
	let before = null
	let isEnd = false

	let loadMoreClassName
	let commentsClassName
	let commentSelector
	let formClassName
	let formSelector

	siteKey = options.siteKey  //這邊的siteKey 是 options 底下的 key
	apiUrl = options.apiUrl
	loadMoreClassName = `${siteKey}-load-more`
	commentsClassName = `${siteKey}-comments`
	commentSelector = '.' + commentsClassName
	formClassName = `${siteKey}-add-comment-form`
	formSelector = '.' + formClassName

	containerElement = $(options.container)			
	containerElement.append(getForm(formClassName, commentsClassName))
	appendStyle(cssTemplate)

	
	getNewComments() // 呼叫loadmore

	$(commentSelector).on('click', '.' + loadMoreClassName, () => {
		getNewComments() // 呼叫loadmore
	})
	
	$(formSelector).submit(e => {
		e.preventDefault();
		const nicknameDOM = $(`${formSelector} input[name=nickname]`)
		const contentDOM = $(`${formSelector} textarea[name=content]`)

		const CommentData = {
			'site_key': siteKey,
			'nickname': nicknameDOM.val(),
			'content' : contentDOM.val()
		}	
		
		addComments(apiUrl, siteKey, CommentData, data => {
			if(!data.ok){
				console.log(data.message)
				//alert(data.message)
				return
			}
			//clear input
			nicknameDOM.val('')
			contentDOM.val('')				
			//to do
			appendCommentToDom(commentDOM, CommentData, true)
		})
		
	})

	function getNewComments () {
		const commentDOM = $(commentSelector)
		$("." + loadMoreClassName).hide()
		if (isEnd) {
			return
		}
		getComments(apiUrl, siteKey, before, data => {
			if (!data.ok) {
				alert(data.message)
				return
			}	
			const comments = data.discussions;	
			for (let comment of comments) {
				appendCommentToDom(commentDOM, comment) //把comment +到前面的$('.comments')
			}
	
			//改變before 並+按鈕
			let length = comments.length			
			if (length === 0) {
				isEnd = true
				$("." + loadMoreClassName).hide()
			} else {
				before = comments[length - 1].id
				const loadMoreButtonHTML = getLoadMoreButton(loadMoreClassName)	
				$(commentSelector).append(loadMoreButtonHTML)
			}
		})
	}
}		

	


