<?php 
/**
 * Template Name: Releases
 *
 * This is a custom post type template.
 *
 */
  
get_header();
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
          <div id="releases-container">
              <?php
			  
			  //get all terms from genre taxonomy
			  $terms = get_terms( 'genre', array('fields' => 'names') );
			  $term_count = 0;
              foreach($terms as $term) {
				  if( $term_count % 2 == 0 && $term_count != 0) echo '<div class="clear"></div>';
				  $term_count++;
				  
				  ?>
                  <div class="genre-container grid_6 <?php if($term_count % 2 ) echo 'genre-right-margin'; ?>">
                  <h2 class="genre-title"><?php echo $term; ?></h2>
                  <div class="divider"></div>
                  <ul class="record-list">
					  <?php
					      global $stylico_theme_options;
					      
                          //get releases associated by term
                          $query = new WP_Query( array('genre' => $term));
                          
                          if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                          
                          //get custom fields
                          $custom_fields = get_post_custom( get_the_ID() );
                          $release_mp3 = $custom_fields["release_mp3"][0];
                          $release_download = $custom_fields["release_download"][0];
                      ?>        
                      <li class="record clearfix">
                          <?php if ( has_post_thumbnail() ) : $image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'large');  ?>
                          <a href="<?php echo $image_attributes[0]; ?>" title="<?php the_title(); ?>" rel="prettyphoto"><?php the_post_thumbnail( array(90, 90), array('class' => 'record-image') ); ?></a>           
                          <?php endif; ?>
                          <div class="record-content">
                              <div class="record-text"><?php the_content(); ?></div>
                              <div class="record-buttons clearfix">
                                  <?php if( !empty($release_mp3) ) : ?>
                                  <a href="<?php echo $release_mp3; ?>" title="<?php the_title(); ?>" class="play-now fmp-my-track"><?php echo $stylico_theme_options['releases']['play_button_text']?> <span class="record-play"></span></a>
                                  <?php endif; ?>
                                  
                                  <?php if( !empty($release_download) ) : ?>
                                  <a href="<?php echo $release_download; ?>" target="_blank" title="<?php $stylico_theme_options['releases']['link_button_text']?>" class="buy-now"><?php echo $stylico_theme_options['releases']['link_button_text']?> <span class="record-buy"></span></a>
                                   <?php endif; ?>
                              </div>
                          </div>
                      </li>
                      <?php endwhile; endif; wp_reset_query(); ?>
                  </ul>
                  </div>
                  <?php
			  }
			  ?>

          </div>
          
          <div class="clear"></div>
          
          <?php stylico_social_menu(false); ?>
          
          <?php edit_post_link(__('Edit this entry.', 'stylico'), '<div>', '</div>'); ?>

          <?php comments_template(); ?>
          
          <?php endwhile; endif; rewind_posts(); ?>
          
        </div><!-- Gigs Container End -->
        
	</section>
        
<?php get_footer(); ?>