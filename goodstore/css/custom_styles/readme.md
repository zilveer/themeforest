Custom styles
=============

Dear customers, into this folder you can upload your css stylesheets.
All files with .css extension will be loaded on frontend.


Custom Fonts
------------

If you want to link new custom font, so please upload your 
- my-font.ttf
- my-font.eot
- my-font.woff
- my-font.svg 
files into this folder, and then create new css stylesheet with this content:

     @font-face {
	font-family: 'my-font';
	src:url('my-font.eot');
	src:url('my-font.eot') format('embedded-opentype'),
		url('my-font.woff') format('woff'),
		url('my-font.ttf') format('truetype'),
		url('my-font.svg') format('svg');
	font-weight: normal;
	font-style: normal;
     }

Then go to Theme Options -> Styling Options -> And turn off "Use Google Fonts" option.
As "Title Font" or "Paragraph Font" set "my-font"