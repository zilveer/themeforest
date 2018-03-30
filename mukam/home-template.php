<?php 
/* Template Name: Home Template */ 
?>
<?php get_header(); ?>
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

    if(isset($theme_options['blog_header'])) { /* dont */ }
    else { $theme_options['blog_header'] = "Set from Theme Option"; }
    if(isset($theme_options['blog_caption'])) { /*dont */ }
    else { $theme_options['blog_caption'] = "Set from Theme Option"; }  

    $animy2 = $animy3 = ''; 
    $animy = get_option_tree('enable_load_animation', $theme_options);
    if ( $animy == 'Yes' ) {
      
      $animy2 = ' fadein anim_2';
      $animy3 = ' fadein anim_3'; 
    }       
    ?>
<section class="mukam-waypoint" data-animate-down="mukam-header-small <?php echo $headertype; ?>" data-animate-up="mukam-header-large <?php echo $headertype; ?>">
		<?php 
    if ( $animy == 'Yes' ) {?>
    <div class="<?php echo $animy2;?>"> <?php } ?>

    <?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

		<?php endwhile; // end of the loop. ?>
    <?php if ( $animy == 'Yes') { ?>
    </div> <?php } ?>
</section>
<?php get_footer(); ?> 