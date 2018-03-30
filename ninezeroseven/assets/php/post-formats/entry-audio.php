<?php 

$id = get_the_id();

$content = get_the_content();
$post_meta = wbc_get_meta( $id );

$has_audio = false;

$audio_ogg_url    = (isset($post_meta['wbc-audio-ogg']) && !empty($post_meta['wbc-audio-ogg'])) ? esc_url( $post_meta['wbc-audio-ogg'] ) : false;
$audio_mp3_url    = (isset($post_meta['wbc-audio-mp3']) && !empty($post_meta['wbc-audio-mp3'])) ? esc_url( $post_meta['wbc-audio-mp3'] ) : false;
$audio_embed_code = (isset($post_meta['wbc-audio-embed']) && !empty($post_meta['wbc-audio-embed'])) ? $post_meta['wbc-audio-embed'] : false;

$extra_class = 'clearfix';

if( $audio_ogg_url !== false || $audio_mp3_url !== false){


	$extra_class .= ' self-hosted';
	
	$has_audio   = true;
	
	$sc_markup   = '[audio ';

	if($audio_ogg_url !== false){ 
		$sc_markup .= 'ogg="'.$audio_ogg_url.'" ';
	}

	if($audio_mp3_url !== false){ 
		$sc_markup .= 'mp3="'.$audio_mp3_url.'" ';
	}

	$sc_markup .= ']';

}elseif($audio_embed_code !== false ){

	$has_audio = true;

	$sc_markup = $audio_embed_code;
}
?>
<article id="post-<?php the_id();?>" <?php post_class($extra_class);?>>
      
      <?php 

    	if( $has_audio == true ){
    		echo '<div class="post-featured audio-format">';
    		echo do_shortcode($sc_markup);
    		echo '</div>';
    	}

       ?>

      <div class="post-contents">
      
	      	<header class="post-header">
		      	<?php 
		      		if(is_single()){
		      			echo '<h1 class="entry-title">'.get_the_title().'</h1>';
		      		}else{
		      			echo '<h2 class="entry-title"><a href="'.esc_attr( get_permalink() ).'">'.get_the_title().'</a></h2>';
		      		}

		      	?>
		        <div class="entry-meta">
					<span class="date"><i class="fa fa-calendar"></i> <?php echo get_the_date( get_option( 'date_format' ) )?></span>
		            <span class="user"><i class="fa fa-user"></i> <?php esc_html_e( 'By', 'ninezeroseven' ); ?> <?php the_author_posts_link(); ?></span>
		           	<?php if ( get_post_type() == 'post' ) { ?> <span class="post-in"><i class="fa fa-pencil"></i> <?php esc_html_e( 'In', 'ninezeroseven' ); ?> <?php the_category( ', ' ) ?></span><?php } ?>
		            <span class="comments"><i class="fa fa-comments"></i> <?php comments_number( esc_html__( 'No Comments', 'ninezeroseven' ), esc_html__( '1 Comment', 'ninezeroseven' ), esc_html__( '% Comments', 'ninezeroseven' ) );?></span>
	        	</div>
	     	</header>

	      <div class="entry-content clearfix">

			<?php 
				if(is_single()){

					echo apply_filters('the_content', $content);

				}else{

					the_excerpt();

					printf('<div class="more-link"><a href="%1s" class="button btn-primary">%2s</a></div>',
							get_permalink(),
							esc_html__('Read More','ninezeroseven')
							);

				}
			?>
			
			<?php if( is_single() && has_tag() ): ?>

				<div class="tags">
				<?php the_tags(); ?>
				</div>

			<?php endif; ?>

		</div>
    </div>

</article> <!-- ./post -->