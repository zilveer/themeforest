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


<header id="header"  class="duplex-hd horizontal-w <?php
$menu_icon = $webnus_options->webnus_header_menu_icon();
if(!empty($menu_icon)) echo ' sm-rgt-mn ';
echo ($hideheader == 'yes')? ' hi-header ' : '';
echo ' '.$webnus_options->webnus_header_color_type()
 ?>">
	<div class="container">
		<nav class="nav-wrap1 col-md-4 duplex-menu dm-left">
			<div class="container">	
				<?php
					if ( has_nav_menu( 'duplex-menu-left' ) ) { 
						wp_nav_menu( array( 'theme_location' => 'duplex-menu-left', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul class="duplex-menu" id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker() ) );}
				?>
			</div>
		</nav>
	<div class="col-md-4 logo-wrap center">
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
<?php } ?>
		</div></div>
	
	<nav class="nav-wrap1 col-md-4 duplex-menu dm-right">
		<div class="container">	
			<?php
				if ( has_nav_menu( 'duplex-menu-right' ) ) { 
					wp_nav_menu( array( 'theme_location' => 'duplex-menu-right', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul class="duplex-menu" id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker() ) );}
			?>
		</div>
	</nav>
	<!-- /nav-wrap -->
	
	<nav id="nav-wrap" class="full-menu-duplex">
		<div class="container">	
		<ul id="nav" class="main-menu"><?php
				if ( has_nav_menu( 'duplex-menu-left' ) ) { 
					wp_nav_menu( array( 'theme_location' => 'duplex-menu-left', 'container' => 'false', 'depth' => '5', 'items_wrap' => '%3$s', 'fallback_cb' => 'wp_page_menu', 'walker' => new webnus_description_walker() ) );}
				if ( has_nav_menu( 'duplex-menu-right' ) ) { 
					wp_nav_menu( array( 'theme_location' => 'duplex-menu-right', 'container' => 'false', 'depth' => '5', 'items_wrap' => '%3$s', 'fallback_cb' => 'wp_page_menu', 'walker' => new webnus_description_walker() ) );}
			?></ul>
		</div>
	</nav>
</div>	
</header>
	
<!-- end-header -->