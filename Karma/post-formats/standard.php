<?php
/**
 * The template for displaying posts in the Standard post format
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-section'); ?>>
	<?php truethemes_post_thumbnail(); ?>
		<header class="entry-header">
			<div class="entry-meta">
				<?php tt_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			global $ttso;
			$htag = $ttso->ka_heading_type;
			if(empty($htag)){
			$htag = 'h2';
			}
			if ( is_single() ) :
			    the_title( "<{$htag} class='entry-title'>", "</{$htag}>" );
			else :
			    the_title( "<{$htag} class='entry-title'><a href='" . esc_url( get_permalink() ) . "' rel='bookmark'>", "</a></{$htag}>" );
			endif;
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			global $ttso;
			$ka_blogbutton            = $ttso->ka_blogbutton;
			$ka_blogbutton_color      = $ttso->ka_blogbutton_color;
			$ka_blogbutton_size       = $ttso->ka_blogbutton_size;
			$content_default          = $ttso->ka_tt_content_default;
			
			
			//pre-define values for backward compatibility
			if ('' == $ka_blogbutton_color): 'black'  == $ka_blogbutton_color; endif;
			if ('' == $ka_blogbutton_size):  'small'  == $ka_blogbutton_size;  endif;
			if ('' == $content_default):     'false'  == $content_default;     endif;
			
			//format "continue reading" button
			$formatted_size    =  strtolower($ka_blogbutton_size);
			$formatted_button  =  $formatted_size.'_button '.$formatted_size.'_'.$ka_blogbutton_color;
					
			//check for content() enabled in Site Options, if not load custom function
			if ("true" == $content_default) {
				the_content('<span class="ka_button '.$formatted_button.'"><span>'.$ka_blogbutton.'</span></span>');
			} else {
				limit_content(80,  true, '');
				echo '<a class="ka_button '.$formatted_button.'" href="'.get_permalink().'" rel="bookmark" title="';_e('Continue reading ', 'truethemes_localize'); echo get_the_title().'">
				<span>'.$ka_blogbutton.'</span></a>';
			}
			?>
		</div><!-- .entry-content -->
</article><!-- .masonry-section -->