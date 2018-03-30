<?php 
/**
 * Template Name: Gigs
 *
 * This is a custom post type template.
 *
 */
  
get_header();

global $stylico_theme_options;
?>
	<section id="main" class="content-box container_12">
        
        <div class="inner-content">
		  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>       
          <article>
          
              <h2 class="post-title"><?php the_title(); ?></h2>
              
              <?php if ( has_post_thumbnail() ) : 
              
                  $image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'large');  
                  $image_title = get_post( get_post_thumbnail_id() )->post_title; 
                  
              ?>
              <a href="<?php echo $image_attributes[0]; ?>" title="<?php echo $image_title; ?>" rel="prettyphoto" class="post-teaser"><?php the_post_thumbnail( 'post-teaser-fullwidth' ); ?></a>
              <?php endif; ?>
              
              <div class="entry-content"><?php the_content(); ?></div>
              
          </article>    
          
          <!-- Gigs Container Start -->
          <div id="gigs-container">
          
              <div class="divider"></div>
              
              <ul class="gigs-list">
				  <?php
				      //show only upcoming gigs
				      if( $stylico_theme_options['gigs']['only_upcoming'] )
					      add_filter( 'posts_where', 'show_upcoming_gigs' );
						 
					  //get all gigs 
					  $query = new WP_Query( 'posts_per_page=-1&post_type=gig&orderby=meta_value&meta_key=gig_date&order=ASC' );
					  
					  if( $stylico_theme_options['gigs']['only_upcoming'] )
					      remove_filter( 'posts_where', 'show_upcoming_gigs' );
					  
                      if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
					  
					  //get custom fields
                      $custom_fields = get_post_custom( get_the_ID() );
                      $gig_date = new DateTime( $custom_fields["gig_date"][0]);
                      $gig_website = $custom_fields["gig_website"][0];
					  $gig_address = $custom_fields["gig_address"][0];
					  
                  ?>        
                  <li class="clearfix">
                      <div class="gig-date"><div class="gig-day"><?php echo $gig_date->format('d'); ?></div ><div class="gig-month"><?php echo $gig_date->format('M'); ?></div ></div>
                      <div class="gig-content">
                          <h2 class="gig-venue"><?php the_title(); ?></h2>
                          <span class="gig-text"><?php the_content(); ?></span>
                          <div class="gig-sub-menu">
                              <?php if ( has_post_thumbnail() ) : $image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'large');  ?>
                              <a href="<?php echo $image_attributes[0]; ?>" title="<?php echo $stylico_theme_options['gigs']['image_link_title']; ?>" rel="prettyphoto"><?php echo $stylico_theme_options['gigs']['image_link_title']; ?></a>           
                              <?php endif; ?>
                              
                              <?php if(!empty($gig_website)) : ?>
							  <a href="<?php echo $gig_website; ?>" title="<?php echo $stylico_theme_options['gigs']['website_link_title']; ?>" target="_blank"><?php echo $stylico_theme_options['gigs']['website_link_title']; ?></a> 
							  <?php endif; ?>
                              
                              <?php if(!empty($gig_address)) : ?>
							  <a href="<?php echo 'http://maps.google.com/?q='.urlencode($gig_address); ?>" title="Google Maps: <?php echo $gig_address;?>" target="_blank"><?php echo $gig_address; ?></a> 
							  <?php endif; ?>
                          </div>
                      </div>
                  </li>
              <?php endwhile; endif; wp_reset_query(); ?>
              </ul>
              
          </div>
          
          <?php stylico_social_menu( false ); ?>
                    
          <?php edit_post_link(__('Edit this entry.', 'stylico'), '<div>', '</div>'); ?>

          <?php comments_template(); ?>
          
          <?php endwhile; endif; rewind_posts(); ?>
          
        </div><!-- Gigs Container End -->
        
	</section>
        
<?php get_footer(); ?>