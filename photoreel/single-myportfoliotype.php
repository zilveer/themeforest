<?php get_header(); ?>
<?php
$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
$large_image = $large_image[0]; 
$video_input = get_post_meta($post->ID, 'themnific_video_embed', true);
$project_url = get_post_meta($post->ID, 'themnific_project_url', true);
$project_description = get_post_meta($post->ID, 'themnific_project_description', true);
$attachments = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image') );
?>

<?php the_post(); ?>
<div class="container">

    <div id="homecontent">
    
		<?php if($video_input) { echo ($video_input); 
        
        	} elseif ($attachments) { echo get_template_part( '/includes/folio-types/gallery-slider' );

        } else {
            
            echo the_post_thumbnail('format-image' );
            
        }?> 
        
        <div style="clear: both;"></div>
    
        <h2 class="itemtitle"><?php the_title(); ?></h2>
        
            <?php if($project_url) : ?>
            
                <a class="tmnf-sc-button btt custom xl" href="<?php echo $project_url; ?>"><?php _e('Visit Project','themnific');?> <i class="icon-signout"></i></a>
            
            <?php endif; ?>  
            
            <p class="folio_meta fr">
            
            	<i class="icon-time"></i> <?php the_time(get_option('date_format')); ?> &bull; 
            
            	<i class="icon-copy"></i> <?php $terms_of_post = get_the_term_list( $post->ID, 'categories', '',' &bull; ', ' ', '' ); echo $terms_of_post; ?>
        
        	</p>
            
            <div class="hrline"></div> 
                 
                
            <div class="entry item_entry">
             
                <?php the_content(); ?>
                
                <div class="hrline"></div>  
                
                
        
                <span class="fl"><i class="icon-double-angle-left"></i> <?php previous_post_link('%link') ?></span>
            
                <span class="fr"><?php next_post_link('%link') ?> <i class="icon-double-angle-right"></i></span>
            
            
                
                <div class="hrline"></div>  
            
            </div>
                
           	<?php comments_template( '', true ); ?>
         
    </div>
     
</div>
        
<?php get_footer(); ?>