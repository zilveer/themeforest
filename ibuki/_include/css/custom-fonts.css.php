<?php header("Content-type: text/css; charset=utf-8"); 

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

require_once( $path_to_wp . '/wp-load.php' );

$options_ibuki = get_option('ibuki');

?>

<?php
if(!empty($options_ibuki['enable-custom-fonts']) && $options_ibuki['enable-custom-fonts'] == 1 ) {

$body = $options_ibuki['body-font'];
$logo = $options_ibuki['logo-font'];
$menu = $options_ibuki['menu-font'];

$page_header = $options_ibuki['pageheader-font'];
$page_caption = $options_ibuki['pagecaption-font'];

$other_heading = $options_ibuki['heading-elements-font'];

$h1 = $options_ibuki['heading1-font'];
$h2 = $options_ibuki['heading2-font'];
$h3 = $options_ibuki['heading3-font'];
$h4 = $options_ibuki['heading4-font'];
$h5 = $options_ibuki['heading5-font'];
$h6 = $options_ibuki['heading6-font'];

if(!empty($options_ibuki['enable-body-fonts']) && $options_ibuki['enable-body-fonts'] == '1') {
echo '
/* Body Custom Fonts */

body {
	font-family: '.$body['font-family'].';
	font-size: '.$body['font-size'].';';
	if(!empty($body['font-style'])){
	echo '
	font-style: '.$body['font-style'].';';
	}
	echo '
	font-weight: '.$body['font-weight'].';
	line-height: '.$body['line-height'].';
}

input,
button,
select,
textarea {
	font-family: '.$body['font-family'].';
	font-size: '.$body['font-size'].';
	font-weight: '.$body['font-weight'].';
}';
}

if(!empty($options_ibuki['enable-header-fonts']) && $options_ibuki['enable-header-fonts'] == '1') {
echo '
/* Header and Mobile Custom Fonts */

#logo.logo-text {
	font-family: '.$logo['font-family'].';
	font-size: '.$logo['font-size'].';';
	if(!empty($logo['font-style'])){
	echo '
	font-style: '.$logo['font-style'].';';
	}
	echo '
	font-weight: '.$logo['font-weight'].';
}';

echo '
#my-menu > .mm-panel li a,
#my-menu > .mm-panel .sub-menu li.has-ul > a,
#my-menu > .mm-panel .sub-menu li a,
#navigation-mobile ul li a {
	font-family: '.$menu['font-family'].';';
	if(!empty($menu['font-style'])){
	echo '
	font-style: '.$menu['font-style'].';';
	}
	echo '
	font-weight: '.$menu['font-weight'].';
}';
}

if(!empty($options_ibuki['enable-headings-fonts']) && $options_ibuki['enable-headings-fonts'] == '1') {
echo '
/* Headings Custom Fonts */

h1 {
	font-family: '.$h1['font-family'].';
	font-size: '.$h1['font-size'].';';
	if(!empty($h1['font-style'])){
	echo '
	font-style: '.$h1['font-style'].';';
	}
	echo '
	font-weight: '.$h1['font-weight'].';
	line-height: '.$h1['line-height'].';
}';

echo '
h2 {
	font-family: '.$h2['font-family'].';
	font-size: '.$h2['font-size'].';';
	if(!empty($h2['font-style'])){
	echo '
	font-style: '.$h2['font-style'].';';
	}
	echo '
	font-weight: '.$h2['font-weight'].';
	line-height: '.$h2['line-height'].';
}';

echo '
h3 {
	font-family: '.$h3['font-family'].';
	font-size: '.$h3['font-size'].';';
	if(!empty($h3['font-style'])){
	echo '
	font-style: '.$h3['font-style'].';';
	}
	echo '
	font-weight: '.$h3['font-weight'].';
	line-height: '.$h3['line-height'].';
}';

echo '
h4 {
	font-family: '.$h4['font-family'].';
	font-size: '.$h4['font-size'].';';
	if(!empty($h4['font-style'])){
	echo '
	font-style: '.$h4['font-style'].';';
	}
	echo '
	font-weight: '.$h4['font-weight'].';
	line-height: '.$h4['line-height'].';
}';

echo '
h5 {
	font-family: '.$h5['font-family'].';
	font-size: '.$h5['font-size'].';';
	if(!empty($h5['font-style'])){
	echo '
	font-style: '.$h5['font-style'].';';
	}
	echo '
	font-weight: '.$h5['font-weight'].';
	line-height: '.$h5['line-height'].';
}';

echo '
h6 {
	font-family: '.$h6['font-family'].';
	font-size: '.$h6['font-size'].';';
	if(!empty($h6['font-style'])){
	echo '
	font-style: '.$h6['font-style'].';';
	}
	echo '
	font-weight: '.$h6['font-weight'].';
	line-height: '.$h6['line-height'].';
}';

echo '
/* Page Header Font */

.title {
	font-family: '.$page_header['font-family'].';
	font-size: '.$page_header['font-size'].';';
	if(!empty($page_header['font-style'])){
	echo '
	font-style: '.$page_header['font-style'].';';
	}
	echo '
	font-weight: '.$page_header['font-weight'].';
	line-height: '.$page_header['line-height'].';
}';

echo '
/* Page Header Caption Font */
.caption {
	font-family: '.$page_caption['font-family'].';
	font-size: '.$page_caption['font-size'].';';
	if(!empty($page_caption['font-style'])){
	echo '
	font-style: '.$page_caption['font-style'].';';
	}
	echo '
	font-weight: '.$page_caption['font-weight'].';
	line-height: '.$page_caption['line-height'].';
}';

echo '
/* Other Heading Elements */
.copyright-text,
.copyright-text a,
.close-modal,
#myModalSearch #searchform input[type="text"],
footer .footer-copyright,
footer .footer-copyright a,
#logo-content .loading-text,
#loader-percentage,
.nav-tabs > li > a,
a.share-btn {
	font-family: '.$other_heading['font-family'].';';
	if(!empty($other_heading['font-style'])){
	echo '
	font-style: '.$other_heading['font-style'].';';
	}
	echo'
}';
}

}
?>