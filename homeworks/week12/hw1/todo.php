<head>
<style>
	/* Include the padding and border in an element's total width and height */
* {
  box-sizing: border-box;
}

/* Remove margins and padding from the list */
ul {
  margin: 0;
  padding: 0;
}

/* Style the list items */
ul li {
  cursor: pointer;
  position: relative;
  padding: 12px 8px 12px 40px;
  background: #eee;
  font-size: 18px;
  transition: 0.2s;

  /* make the list items unselectable */
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Set all odd list items to a different color (zebra-stripes) */
ul li:nth-child(odd) {
  background: #f9f9f9;
}

/* Darker background-color on hover */
ul li:hover {
  background: #ddd;
}

/* When clicked on, add a background color and strike out text */
ul li.checked {
  background: #888;
  color: #fff;
  text-decoration: line-through;
}

/* Add a "checked" mark when clicked on */
ul li.checked::before {
  content: '';
  position: absolute;
  border-color: #fff;
  border-style: solid;
  border-width: 0 2px 2px 0;
  top: 10px;
  left: 16px;
  transform: rotate(45deg);
  height: 15px;
  width: 7px;
}

/* Style the close button */
.close {
  position: absolute;
  right: 0;
  top: 0;
  padding: 12px 16px 12px 16px;
}

.close:hover {
  background-color: #f44336;
  color: white;
}

/* Style the header */
.header {
  background-color: wheat;
  padding: 30px 40px;
  color: white;
  text-align: center;
 
}

/* Clear floats after the header */
.header:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the input */
input {
  margin: 0;
  border: none;
  border-radius: 0;
  width: 75%;
  padding: 10px;
  float: left;
  font-size: 16px;
}

/* Style the "Add" button */
.addBtn {
  padding: 10px;
  width: 25%;
  background: pink;
  color: #555;
  float: left;
  text-align: center;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 5px;
  border-style: groove

}

.addBtn:hover {
  background-color: #bbb;
}
.checkBTN
{
	padding: 10px;
  width: 25%;
  background: #d9d9d9;
  color: #555;
  float: left;
  text-align: center;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 5px;
	background-color: lightblue;
  border-style: groove;
  margin-bottom:5px
  
}
.buttonactive
{
	background-color: beige;
  
}
</style>

</head>
<body>
<div id="myDIV" class="header">
  <h2>My To Do List</h2>
  <span onclick="show_all()" class="checkBTN buttonactive">ALL</span>
  <span onclick="show_done()" class="checkBTN">completed</span>
  <span onclick="show_undo()" class="checkBTN">undo</span>
  <span onclick="remove_all()" class="addBTN">reset</span>
  <input type="text" id="myInput" placeholder="Title...">
  <span onclick="newElement()" class="addBtn">Add</span>
</div>

<ul id="myUL">
  
</ul>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script>
var save
// Click on a close button to hide the current list item
$(document).ready(function(){
	$(function(){
		$("ul").on('click','li',function(){
			$(this).toggleClass('checked')
		});
		$(".checkBTN").on('click',function(){
			$('.checkBTN').not(this).removeClass('buttonactive'); // remove buttonactive from the others
			$(this).toggleClass('buttonactive');
		})
		
		
	});
});
function remove_all()
{
	$("li").remove();
}
function show_all()
{
	$("li").show();
}
function show_done()
{
	$("li.checked").show();
	$("li:not(.checked)").hide();
}
function show_undo()
{
	$("li.checked").hide();
	$("li:not(.checked)").show();
}
// Create a new list item when clicking on the "Add" button
function newElement() {
  var li = document.createElement("li");
  var inputValue = $("#myInput").val();
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    $("#myUL").append('<li>'+inputValue+'<span class=close>x</span></li>');
  }
  $("#myInput").val('');

  $(".close").on('click',function() {
		  $(this).parent().remove();
		});
}
</script>
