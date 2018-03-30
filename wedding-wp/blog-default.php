<?php

get_header();
GLOBAL $webnus_options;
?>
<?php 

if( 1 == $webnus_options->webnus_blog_page_title_enable() )
{
?>
 <section id="headline">
    <div class="container">
      <h3><?php
					if ( is_day() ) :
						printf('<small>'. __( 'Daily Archives', 'WEBNUS_TEXT_DOMAIN' ) . ':</small> %s', get_the_date() );
					elseif ( is_month() ) :
						printf('<small>'. __( 'Monthly Archives', 'WEBNUS_TEXT_DOMAIN' ) . ':</small> %s', get_the_date( _x( 'F Y', 'monthly archives date format', 'WEBNUS_TEXT_DOMAIN' ) ) );
					elseif ( is_year() ) :
						printf('<small>'. __( 'Yearly Archives', 'WEBNUS_TEXT_DOMAIN' ) .':</small> %s', get_the_date( _x( 'Y', 'yearly archives date format', 'WEBNUS_TEXT_DOMAIN' ) ) );
						
					elseif ( is_category() ):
						printf(  '%s', single_cat_title( '', false ) );
					elseif ( is_tag() ):
						printf('<small>'. __( 'Tag', 'WEBNUS_TEXT_DOMAIN' ) .':</small> %s', single_tag_title( '', false ) );

					else :
						echo $webnus_options->webnus_blog_page_title();
					endif;
				?></h3>
    </div>
  </section>
<?php
}
?>

    <section class="container page-content" >
    <hr class="vertical-space2">
	<?php
	if( 'none' != $webnus_options->webnus_blog_sidebar() )
	if( 'left' == $webnus_options->webnus_blog_sidebar() || 'both' == $webnus_options->webnus_blog_sidebar() ){
		get_sidebar('bleft');
	}
	?>
	<!-- begin-main-content -->
    <section class="<?php echo ( 'both' == $webnus_options->webnus_blog_sidebar() )? 'col-md-4 alpha omega':( ('none' != $webnus_options->webnus_blog_sidebar() )?'col-md-8': 'col-md-12 omega') ?>">
     <?php
    $args = array( 'category_name' => 'featured' );
	 query_posts($args);	
	 if(have_posts()):
		while( have_posts() ): the_post();
			
			if( 'both' == $webnus_options->webnus_blog_sidebar() )
			{
				get_template_part('parts/blogloop','bothsidebar');
			}
			else{
				switch( $webnus_options->webnus_blog_template() )
				{
					case 1:
						get_template_part('parts/blogloop');
						break;
					case 2:
						get_template_part('parts/blogloop','type2');
						break;
					default:
						get_template_part('parts/blogloop');
						break;
					
					
				}
			}
		endwhile;
	 else:
		get_template_part('blogloop-none');
	 endif;
	 wp_reset_query();
	 $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	 $idObj = get_category_by_slug('featured'); 
  	 
	 $id=array();
  	 if($idObj)
  	 $id = $idObj->term_id;
	 
	 query_posts(array('category__not_in' => array( $id ), 'paged'=>$paged));
	 
	 if(have_posts()):
		while( have_posts() ): the_post();
			
			if( 'both' == $webnus_options->webnus_blog_sidebar() )
			{
				get_template_part('parts/blogloop','bothsidebar');
			}
			else{
				switch( $webnus_options->webnus_blog_template() )
				{
					case 1:
						get_template_part('parts/blogloop');
						break;
					case 2:
						get_template_part('parts/blogloop','type2');
						break;
					default:
						get_template_part('parts/blogloop');
						break;
					
					
				}
			}
		endwhile;
	 else:
		get_template_part('blogloop-none');
	 endif;
	 wp_reset_query();
	 ?>
       
      <br class="clear">
   
	  <?php 
		if(function_exists('wp_pagenavi'))
		{
			wp_pagenavi();
		}
	  ?>
      <div class="vertical-space3"></div>
    </section>
    <!-- end-main-content -->
	<?php 
	if( 'none' != $webnus_options->webnus_blog_sidebar() )
	if( 'right' == $webnus_options->webnus_blog_sidebar() || 'both' == $webnus_options->webnus_blog_sidebar() ){ 
		get_sidebar('bright');
	}
	?>
    <hr class="vertical-space">
  </section>

  <?php 
  get_footer();
  ?>