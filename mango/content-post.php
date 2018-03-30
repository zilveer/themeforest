<?php
/**
 * The template for displaying posts content
 *
 * @package WordPress
 * @subpackage Mango
 * @since Mango 1.0
 */
?>
<?php 
		global $mango_settings, $post_format, $blog_settings, $post; ?>
		<div class="entry-content">
		<?php
				$post_format = get_post_format();
				$quote = false;
		if($post_format=='quote'){
					$quote = get_post_meta( $post->ID, 'mango_quote_content', true ) ? get_post_meta( $post->ID, 'mango_quote_content', true ) : '';
					$quote_author = get_post_meta( $post->ID, 'mango_quote_author', true ) ? get_post_meta( $post->ID, 'mango_quote_author', true ) : '';
					$quote_icon = get_post_meta( $post->ID, 'mango_quote_icon', true ) ? ' class="blockquote-icon"': '';
		?>
		<?php 
			if($quote){
				if ( post_password_required() ) {
					if(!is_single()) echo  get_the_password_form ();
				}else{ ?>
						<blockquote <?php echo esc_attr($quote_icon); ?>>
						<?php if(!is_single() && $blog_settings['blog_excerpt'] ){
									$quote = mango_get_blockquote_excerpt($quote);
								} ?>
						<p><?php echo force_balance_tags($quote); ?></p>
					<?php   if($quote_author){ ?>
								<cite>-- <?php echo force_balance_tags($quote_author); ?></cite>
					<?php    } ?>
						</blockquote>
    <?php 		} 
			} 
		} ?>
<?php
    if(is_single()){
        the_content();
    }else{
        if(!empty($blog_settings['blog_excerpt'])){
            if( gallery_shortcode_exists() ){
                mango_gallery();
            }else{
                if(!$quote) {
                    echo mango_excerpt ( $blog_settings[ 'blog_excerpt_limit' ] );
                }
            }
        } else {
              the_content();
        }
    } ?>
</div><!-- End .entry-content -->
<?php
    if( !is_single() && $blog_settings['blog_excerpt'] && !post_password_required()){?>
        <a  href= "<?php the_permalink(); ?>" class= "entry-readmore" title="<?php _e("Go to Post","mango") ?>" ><?php _e("Read More","mango") ?> </a>
    <?php } ?>
<?php if(!$blog_settings['hide_blog_post_tags'] && is_single() && has_tag()){ ?>
            <div class="entry-tags"><span><?php _e("Tags","mango")?>:</span>
                <?php  the_tags("", ", "); ?>
            </div>
<?php } ?>