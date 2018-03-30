<?php

/*
 * Theme Dynamic Stylesheet
 */
 
header("Content-type: text/css;");

$current_url = dirname(__FILE__);
$wp_content_pos = strpos($current_url, 'wp-content');
$wp_content = substr($current_url, 0, $wp_content_pos);

require_once($wp_content . 'wp-load.php');



//$th_main_color = '#d0ad55'; // Default theme color
//$th_hover_color = '#D8BA6F'; // Default color on hover

$th_custom_color=th_theme_data('th_custom_color','');
$th_custom_hover_color=th_theme_data('th_custom_hover_color','');

$th_custom_nav_color=th_theme_data('th_custom_nav_color','');
$th_custom_nav_hover_color=th_theme_data('th_custom_nav_hover_color','');

if( $th_custom_color !== ''){
    $th_main_color = $th_custom_color;
}
else{
    $th_main_color ='';
}
if( $th_custom_hover_color !== ''){
	$th_hover_color = $th_custom_hover_color;
}
else{
    $th_hover_color ='';
}
?>

<?php
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		General
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
?>

.gold-btn{	
	background-color: <?php echo $th_main_color ?>;
    border-color: <?php echo $th_main_color ?>;
}
.gold-btn:hover{
	background-color: <?php echo $th_hover_color ?>;
	border-color: <?php echo $th_hover_color ?>;
}
.navbar-default .navbar-nav>li>a{
    color: <?php if (!empty($th_custom_nav_color)){echo $th_custom_nav_color;} else{ echo $th_main_color; } ?>;
}
.navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus {
	color: <?php if (!empty($th_custom_nav_hover_color)){echo $th_custom_nav_hover_color;} else{ echo $th_main_color; } ?> !important;
}
.navbar-default .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus {
	color: <?php echo $th_main_color ?>;
}
.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus {
	color: <?php if (!empty($th_custom_nav_hover_color)){echo $th_custom_nav_hover_color;} else{ echo th_theme_data('th_custom_color',''); } ?>;
}
.about-caption i{
	color: <?php echo $th_main_color ?>;
}
.cbp-l-filters-alignRight .cbp-filter-item.cbp-filter-item-active {
	background-color: <?php echo $th_main_color ?>;
}
.cbp-l-filters-alignRight .cbp-filter-counter {
	background: <?php echo $th_main_color ?>;
}
.cbp-l-filters-alignRight .cbp-filter-counter:before {
	border-top: 4px solid <?php echo $th_main_color ?>;
}
.service-box i {
	color: <?php echo $th_main_color ?>;
}
.team-details h5 {
	color: <?php echo $th_main_color ?>;
}
a:hover, a:focus {
	color: <?php echo $th_hover_color ?>;
}
.price-table:hover {
	border: 3px solid <?php echo $th_hover_color ?>;
}
.blog-title a:hover {
	color: <?php echo $th_hover_color ?>;
}
.f-cta {
	background-color: <?php echo $th_main_color ?>;	
}
.f-inner:hover {
	background-color: <?php echo $th_hover_color ?>;
}
.f-inner i {
	color: <?php echo $th_main_color ?>;
}
.close {
	color: <?php echo $th_main_color ?>;
}
.i-blog-btn {
	background-color: <?php echo $th_main_color ?> !important;
	border-color: <?php echo $th_main_color ?> !important;
}
.i-blog-btn:hover {
	border-color: <?php echo $th_hover_color ?> !important;
	background-color: <?php echo $th_hover_color ?> !important;
}
#contact input:focus, textarea:focus, select:focus {
	border: 1px solid <?php echo $th_main_color ?>;
}
.mm-list > li a:hover {
	color: <?php echo $th_hover_color ?>;
}
.project-details p {
	color: <?php echo $th_main_color ?>;
}
.contact-icon i {
	color: <?php echo $th_main_color ?>;
}
.progress-bar, .vc_progress_bar .vc_single_bar .vc_bar {
	background-color: <?php echo $th_main_color ?> !important;
}
.input-group-btn .btn {
	background-color: <?php echo $th_main_color ?>;
	border-color: <?php echo $th_main_color ?>;
}
.input-group-btn .btn:hover {
	background-color: <?php echo $th_hover_color ?>;
	border-color: <?php echo $th_hover_color ?>;
}
.comment-respond p.form-submit input.submit {
	background-color: <?php echo $th_main_color ?>;
	border-color: <?php echo $th_main_color ?>;
}
.comment-respond p.form-submit input.submit:hover {
	border-color: <?php echo $th_hover_color ?>;
	background-color: <?php echo $th_hover_color ?>;
}
#wp-calendar td a{
	color: <?php echo $th_main_color ?>;
}
.i-blog-comments input:focus, textarea:focus, select:focus {
	border: 1px solid <?php echo $th_main_color ?>;
}
.i-blog-title a:hover {
	color: <?php echo $th_hover_color ?>;
}
.i-blog-info a:hover {
	color: <?php echo $th_hover_color ?>;
}
.input-group input:focus, textarea:focus, select:focus {
	border: 1px solid <?php echo $th_main_color ?>;
}
.new-project-info h3, .new-project-date h3, .new-project-category h3, .new-project-social h3, .new-project-web h3 {	
	color: <?php echo $th_main_color ?>;	
}
.navbar-default .navbar-toggle .icon-bar {
	background-color: <?php echo $th_main_color ?>;
}
.c-soon h1 {
	color: <?php echo $th_main_color ?>;
}
.tp-caption.c-soon, .c-soon {
	color: <?php echo $th_main_color ?>;
}
span.wpcf7-not-valid-tip {
	color: <?php echo $th_main_color ?>;
}
div.wpcf7-validation-errors {
	background-color: <?php echo $th_main_color ?>;
}
.i-blog-pagination span {
	color: <?php echo $th_main_color ?>;
}


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
//		Navigation
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

.navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus {
color: <?php echo $th_main_color ?> !important;
}