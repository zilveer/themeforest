<?php get_header();?>
	<?php 
    if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
    } 
	$header_style = get_option_tree('header_style',$theme_options);
          if ( $header_style == "header_style_1" || $header_style == ""): 
            $headertype = "header-1";
          elseif ( $header_style == "header_style_2"): 
            $headertype = "header-2";
          elseif ( $header_style == "header_style_3" ):
            $headertype = "header-4";
          elseif ( $header_style == "header_style_4" ):
            $headertype = "header-3";
          elseif ( $header_style == "header_style_5" ):
            $headertype = "header-5";
          elseif ( $header_style == "header_style_6" ):
            $headertype = "shopheader";
          elseif ( $header_style == "header_style_7" ):
            $headertype = "header-7";
          elseif ( $header_style == "header_style_8" ):
            $headertype = "header-6";
          endif;
    $animy2 = $animy3 = $animy4 = $animy5 = ''; 
    $animy = get_option_tree('enable_load_animation', $theme_options);
    if ( $animy == 'Yes' ) {
      
      $animy2 = ' fadein scaleInv anim_2';
      $animy3 = ' fadein scaleInv anim_3';
      $animy4 = ' fadein scaleInv anim_4';
      $animy5 = ' fadein scaleInv anim_5'; 
    }      
    ?>
<section class="mukam-waypoint" data-animate-down="mukam-header-small <?php echo $headertype; ?>" data-animate-up="mukam-header-large <?php echo $headertype; ?>">
<div class="caption-out<?php echo $animy2;?>">
    <div class="container">
      <div class="row">
        <div class="col-md-9 caption">
          <h3><?php echo __('404 Error Page', 'mukam'); ?></h3>
          <p><?php echo __('Stay calm and return to homepage...', 'mukam');?></p>
        </div>
        <div class="col-md-3 breadcrumb">
        <ul><li><a href="<?php echo home_url() ?>">Home</a></li>/ 404 </li></ul>
        </div>
      </div>
    </div>
</div>
  <?php if ( $animy == 'Yes') {
  ?><div class="<?php echo $animy3;?>">
  <?php } ?>
<div class="error-page<?php echo $animy3;?>">
  <div class="container">
    <div class="row">
    <h1 class="<?php echo $animy3;?>"><?php echo __('404', 'mukam');?></h1>
    <h2 class="<?php echo $animy4;?>"><?php echo __('PAGE NOT FOUND!', 'mukam');?></h2>
    <p class="<?php echo $animy5;?>"><?php echo __('Sorry, the page you requested may have been moved or deleted', 'mukam');?></p>
    <span class="buton b_asset buton-2 buton-large <?php echo $animy5;?>"><a class="trigger" href="<?php echo home_url(); ?>"><?php echo __('GET ME BACK TO HOME PAGE', 'mukam');?></a></span>
    </div>
  </div>
</div>
  <?php if ( $animy == 'Yes') {
  ?></div>
  <?php } ?>

</section>
<?php get_footer();?>