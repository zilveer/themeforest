// JavaScript Document
var always;
var $loadmenu = jQuery.noConflict();
window.onload=function(){
var menu = $loadmenu('#nav-primary li:not(#nav-primary li li)');
var k = 0;
var l = 0;
var c = readCookie('menumemory');
if (c != 1 ) {
$loadmenu(function displ() {
         menu.eq(k++).fadeIn(140, displ);
	});
if (always != 1) {
setTimeout(function hidem(){
					menu.fadeOut(500);
					},2000);

createCookie('menumemory', 1, 1);
}
}
};


var $submenu = jQuery.noConflict();
$submenu(function(){	
	$submenu('#nav-primary ul li').hover(
		function () {
			//show its submenu
			$submenu('ul', this).css("display","inline-block");
			}, 
		function () {
			//hide its submenu
			$submenu('ul', this).fadeOut(400);		
		}
	);
});


var $mainmenu = jQuery.noConflict();
// Wrapping, self invoking function prevents globals
$mainmenu(function() {
   // Hide the elements initially
   var lis = $mainmenu('#nav-primary li:not(#nav-primary li li)').hide();
   // When some anchor tag is clicked. (Being super generic here)
   $mainmenu('#logo').mouseover(function() {
      var i = 0;
      // FadeIn each list item over 200 ms, and,
      // when finished, recursively call displayImages.
      // When eq(i) refers to an element that does not exist,
      // jQuery will return an empty object, and not continue
      // to fadeIn.
      $mainmenu(function displayImages() {
		if (always != 1) {
         lis.eq(i++).fadeIn(140, displayImages);
		}
      });
   });
   $mainmenu('#nav-primary ul:not(#nav-primary ul ul)').mouseleave(function() {
		var j = 0;
		$mainmenu(function hideImages() {
		if (always != 1) {
        lis.eq(j++).fadeOut(140, hideImages);
		}
      });
	 });
});



// cookie functions http://www.quirksmode.org/js/cookies.html
function createCookie(name,value,days)
{
	if (days)
	{
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name)
{
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
function eraseCookie(name)
{
	createCookie(name,"",-1);
}
// /cookie functions
