<?php
GLOBAL $webnus_options;
?>

<div id="sticker">

<header id="header">
<div  class="container">
<div class="col-md-3 col-sm-3">
<div class="logo"><a href="<?php echo home_url( '/' ); ?>">
<?php

$logo = '';
$logo_width = '';

$logo = !empty($logo) ? $logo : $webnus_options->webnus_halfdark_logo();
$logo_width = !empty($logo_width)? $logo_width : $webnus_options->webnus_logo_width();

if(!empty($logo))
{
?>
<img src="<?php echo $logo; ?>" width="<?php  echo !empty($logo_width)?$logo_width:"150"; ?>" id="img-logo" alt="logo">
<?php 
}else{ ?>
<h5 id="site-title"><?php bloginfo( 'name' ); ?>
<small>
<?php 
                
	$slogan = $webnus_options->webnus_slogan();
   
	if( empty($slogan))
		bloginfo( 'description' );
	else
		echo $slogan;
                
                
?>
</small></h5>

<?php } ?>
</a></div></div>
<nav id="nav-wrap" class="nav-wrap1 col-md-9 col-sm-9">
		<div id="search-form">
			<form action="<?php echo home_url( '/' ); ?>" method="get">
				<input type="text" class="search-text-box" id="search-box" name="s">
			</form>
		</div>
				<?php
					if ( has_nav_menu( 'header-menu' ) ) { 
						wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new description_walker()) );
					}
				?>
	</nav>
		<!-- /nav-wrap -->
</div>
<div id="search-form2">
<form action="<?php echo home_url( '/' ); ?>" method="get">
	<input name="s" type="text" class="search-text-box2">
</form>
</div>
</header>

</div>

<!-- end-header -->
