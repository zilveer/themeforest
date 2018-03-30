<?php
$hideheader = '';
GLOBAL $webnus_options;
if( is_page())
{
GLOBAL $webnus_page_options_meta;
@$hideheader_meta = (isset($webnus_page_options_meta))?$webnus_page_options_meta->the_meta():null;
$hideheader =(isset($hideheader_meta) && is_array($hideheader_meta) && isset($hideheader_meta['webnus_page_options'][0]['maxone_hideheader']))?$hideheader_meta['webnus_page_options'][0]['maxone_hideheader']:null;
}
?>


<header id="header" class="horizontal-w <?php 

$menu_icon = $webnus_options->webnus_header_menu_icon();

if(!empty($menu_icon)) echo ' sm-rgt-mn ';


echo ($hideheader == 'yes')? ' hi-header ' : '';
echo ' '.$webnus_options->webnus_header_color_type()

 ?>">
<div class="container">
<div class="col-md-3 col-sm-3 logo-wrap">
<div class="logo">
<?php
/* Check if there is one logo exists at least. */
$has_logo = false;

$logo ='';
$logo_width = '';


$transparent_logo = '';
$transparent_logo_width = '150';

$sticky_logo = '';
$sticky_logo_width = '150';


$logo = $webnus_options->webnus_logo();
$logo_width = $webnus_options->webnus_logo_width();

$transparent_logo = $webnus_options->webnus_transparent_logo();
$transparent_logo_width = $webnus_options->webnus_transparent_logo_width();

$sticky_logo = $webnus_options->webnus_sticky_logo();
$sticky_logo_width = $webnus_options->webnus_sticky_logo_width();


if( !empty($logo) || !empty($transparent_logo) || !empty($sticky_logo) ) $has_logo = true;


if((TRUE === $has_logo))
{

if(!empty($logo))
	echo '<a href="'.home_url( '/' ).'"><img src="'.$logo.'" width="'. (!empty($logo_width)?$logo_width:"150"). '" id="img-logo-w1" alt="logo" class="img-logo-w1"></a>';

if(!empty($transparent_logo))
	echo '<a href="'.home_url( '/' ).'"><img src="'.$transparent_logo.'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:"150"). '" id="img-logo-w2" alt="logo" class="img-logo-w2"></a>';
else 
	echo '<a href="'.home_url( '/' ).'"><img src="'.$logo.'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:$logo_width). '" id="img-logo-w2" alt="logo" class="img-logo-w2"></a>';

if(!empty($sticky_logo))
	echo '<span class="logo-sticky"><a href="'.home_url( '/' ).'"><img src="'.$sticky_logo.'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:"150"). '" id="img-logo-w3" alt="logo" class="img-logo-w3"></a></span>';
else 
	echo '<span class="logo-sticky"><a href="'.home_url( '/' ).'"><img src="'.$logo.'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:$logo_width). '" id="img-logo-w3" alt="logo" class="img-logo-w3"></a></span>';


 
}else{ ?>
<h5 id="site-title"><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?>
<small>
<?php 
                
	$slogan = $webnus_options->webnus_slogan();
   
	if( empty($slogan))
		bloginfo( 'description' );
	else
		echo $slogan;
                
                
?>
</a>
</small></h5>

<?php } ?></div></div>
<nav id="nav-wrap" class="nav-wrap1 col-md-9 col-sm-9">
	<div class="container">
		<?php 
		if(is_active_sidebar('woocommerce_header')) {
			dynamic_sidebar('woocommerce_header');
		} 
		if($webnus_options->webnus_header_search_enable())
		{

?>



		<div id="search-form">
		<a href="javascript:void(0)" class="search-form-icon"><i id="searchbox-icon" class="fa-search"></i></a>
	<div id="search-form-box" class="search-form-box">
			<form action="<?php echo home_url( '/' ); ?>" method="get">
				<input type="text" class="search-text-box" id="search-box" name="s">
			</form>
			</div>
		</div>
		<?php } ?>
				<?php
					if(is_page_template('page-onepage.php'))
					{
					
					if ( has_nav_menu( 'onepage-header-menu' ) ) { 
						wp_nav_menu( array( 'theme_location' => 'onepage-header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker()) );
						
					}
					}
					else{
					if ( has_nav_menu( 'header-menu' ) ) { 
						wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker()) );
					}
					}
				?>
	</div>
</nav>
		<!-- /nav-wrap -->
</div>

</header>

<!-- end-header -->
