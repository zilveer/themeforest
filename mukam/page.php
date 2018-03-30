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
    $animy2 = $animy3 = ''; 
    $animy = get_option_tree('enable_load_animation', $theme_options);
    if ( $animy == 'Yes' ) {
      
      $animy2 = ' fadein scaleInv anim_2';
      $animy3 = ' fadein scaleInv anim_3'; 
    }      
    ?>
<?php while ( have_posts() ) : the_post(); ?>    
<section class="mukam-waypoint" data-animate-down="mukam-header-small <?php echo $headertype; ?>" data-animate-up="mukam-header-large <?php echo $headertype; ?>">
	<div class="caption-out<?php echo $animy2;?>">
    <div class="container">
      <div class="row">
        <div class="col-md-9 caption">
          <h3><?php the_title(); ?></h3>
          <p><?php echo get_post_meta($post->ID, 'caption', true); ?></p>
        </div>
        <div class="col-md-3 breadcrumb">
        <?php mukam_breadcrumb(); ?>
        </div>
      </div>
    </div>
    </div>
	<!-- Blog Content Start -->
  <?php if ( $animy == 'Yes') {
  ?><div class="<?php echo $animy3;?>">
  <?php } ?>
  	  <div class="bg-color">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
				<?php the_content(); ?>
		  </div>
		</div>
	   </div>
	   </div>

    <?php if (comments_open()){ ?>    
    <div class="bg-color white"><div class="container"><div class="row"><div class="col-md-9">    
        <div id="comment" class="comments-wrapper">
              <?php comments_template(); ?>
        </div>
    </div></div></div></div>
    <?php } ?>
	<?php if ( $animy == 'Yes') {
  ?></div>
  <?php } ?>
</section>
<?php endwhile; // end of the loop. ?>
<?php get_footer();?>