Cufon('#nav > li > a', {
  color: '-linear-gradient(#f5f2eb, 0.5=#f5f2eb, 0.8=#acaaa4, #acaaa4)', textShadow: '-1px -1px #000'
});
Cufon('#nav > li.current_page_item > a, #nav > li.current-menu-item > a', {
  color: '-linear-gradient(#aba197, 0.5=#aba197, 0.8=#887d72, #887d72)', textShadow: '-1px -1px #000'
});

Cufon('.widget .header, .folio_caption, .folio_just_caption', {
  fontWeight: 'bold',
  color: '-linear-gradient(#f5f2eb, 0.5=#f5f2eb, 0.8=#acaaa4, #acaaa4)', textShadow: '-1px -1px #000'
});
Cufon('._cf, .article h1, .article h2, .article h3, .article h4, .article h5, .article h6', {
  fontWeight: 'bold',
  color: '-linear-gradient(#473e2b, 0.4=#473e2b, #1c1a19)', textShadow: '0 1px #fff',
  hover: {
	color: '-linear-gradient(#60543a, 0.4=#60543a, #433e3c)', textShadow: '0 1px #fff'
  }
});
Cufon('.quote_author', {
  fontWeight: 'bold',
  color: '#221f1c', textShadow: '1px 1px #fff'
});
Cufon('.paginator li', {
  fontWeight: 'bold',
  color: '-linear-gradient(#f5f2eb, #bfbcb7)', textShadow: '-1px -1px #000'
});
Cufon('.paginator li.act', {
  fontWeight: 'bold',
  color: '#857d74', textShadow: '-1px -1px #000'
});
Cufon('.go_up', {
  fontWeight: 'bold',
  color: '-linear-gradient(#f5f2eb, #bfbcb7)', textShadow: '-1px -1px #000'
});
Cufon('.article_footer .header', {
  fontWeight: 'bold',
  color: '-linear-gradient(#f5f2eb, 0.5=#f5f2eb, 0.8=#acaaa4, #acaaa4)', textShadow: '-1px -1px #000'
});

var _n = 0;
jQuery('.nav > ul > li > a').each(function () {
  _n++;
  var idd = "a"+_n;
  var ee = jQuery(this);
  ee.attr("id", idd);
  ee.hover(function () {
	 Cufon.replace( "#"+idd , {
		color: '-linear-gradient(#aba197, 0.5=#aba197, 0.8=#887d72, #887d72)', textShadow: '-1px -1px #000'
	 });
	 Cufon.now();
  }, function () {
	 if (
		jQuery(this).parent().hasClass('current_page_item') ||
		jQuery(this).parent().hasClass('current-menu-item')
	 )
		return;
	 Cufon.replace( "#"+idd , {
		color: '-linear-gradient(#f5f2eb, 0.5=#f5f2eb, 0.8=#acaaa4, #acaaa4)', textShadow: '-1px -1px #000'
	 });
	 Cufon.now();
  });
});