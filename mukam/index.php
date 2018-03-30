<?php 
/*Template Name: Blog */
get_header();?>
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
      
      $animy2 = ' fadein scaleInv anim_2';
      $animy3 = ' fadein scaleInv anim_3'; 
    }       
    ?>

<section class="mukam-waypoint" data-animate-down="mukam-header-small <?php echo $headertype; ?>" data-animate-up="mukam-header-large <?php echo $headertype; ?>">
<?php $blog_template = get_option_tree('blog_style',$theme_options);

if ( $blog_template != "homepage" ) { ?>    	
<div class="caption-out<?php echo $animy2;?>">
    <div class="container">
      <div class="row">
        <div class="col-md-9 caption">
            <h3><?php if ( is_search() ) : // Only display for Search?>
		        <?php printf( __( 'Search Results for: %s', 'BLICCA_THEME' ), '<span>' . get_search_query() . '</span>' ); ?> 
			    <?php else: echo $theme_options['blog_header']; ?><?php endif; ?>
		    </h3>
          <p class="fadein"><?php echo $theme_options['blog_caption']; ?></p>
        </div>
        <div class="col-md-3 breadcrumb">
        <?php mukam_breadcrumb(); ?>
        </div>
      </div>
    </div>
    </div>
	<!-- Blog Content Start -->	
		<div class="bg-color grey<?php echo $animy3;?>">
			<div class="container">
				<div class="row">
					<?php 
					if ( $blog_template == "big_thumbnail_right_sidebar" || $blog_template == ""): 
						get_template_part( 'includes/blog/blog', 'right-sidebar' ); 
					elseif ( $blog_template == "big_thumbnail_left_sidebar"): 
						get_template_part( 'includes/blog/blog', 'left-sidebar' );
					elseif ( $blog_template == "full_width" ):
						get_template_part( 'includes/blog/blog', 'fullwidth');
					endif;
					?>
				</div>
			</div>
		</div>
<?php }

else {
get_template_part( 'includes/blog/blog', 'home');
}
?>    
</section>

<?php get_footer();?>