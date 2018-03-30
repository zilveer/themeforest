
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( ', ' );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', ', ' );
		
		?>
		<ul class="single-post-meta clearfix">
						<li><span class="date-stamp"><?php printf( __('Posted on', 'morphis') ); ?></span><?php echo esc_attr( get_the_date() ); ?></li>
						<li><span class="author"><?php printf( __('By', 'morphis') ); ?></span><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'morphis' ), get_the_author() ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></li>
						<li><span><?php printf( __('Categories', 'morphis') ); ?></span><?php echo $categories_list; ?></li>
						<?php if($tag_list != ''): ?>
						<li><span><?php printf( __('Tags', 'morphis') ); ?></span><?php echo $tag_list; ?></li>
						<?php endif; ?>
						
		</ul>
		<?php endif; ?>
	

	<div class="entry-content">
	
			<?php $_post_format = get_post_format(); ?>
			<?php if($_post_format == '') : ?> 
					<?php $_post_format = 'standard'; ?>
					<?php enqueue_native_gallery_style(); ?>
			<?php endif; ?>
			<?php if( $_post_format == 'gallery' ) { ?>
				<?php gallery_carouFredSel($post->ID, get_the_content()); ?>
			<?php } elseif ( $_post_format == 'audio' ) { ?>
				<?php jPlayer_audio($post->ID, FALSE); ?>
			<?php } elseif ( $_post_format == 'image' ) { ?>
				<?php $image_pf = get_post_meta($post->ID,'_cmb_image_pf_upload',TRUE); ?>	
				<?php if ( $image_pf != '' ) { ?>
				<?php printf( '<div class="overlay squared remove-bottom"><figure><div class="overlay-mask"><a class="icon-view" href="%1$s" rel="prettyPhoto" title=""></a><a class="icon-link" href="'. get_permalink() .'"></a></div><img src="%1$s" alt="' . get_the_title() . '" /></figure></div>', $image_pf ); ?>					
				<?php } ?>
			<?php } elseif ( $_post_format == 'video' ) { ?>
				<?php $codeEmbed = get_post_meta($post->ID, '_cmb_video_pf_embedded', true); ?>
				<?php if( !empty($codeEmbed) ) { ?>
				<?php morphis_embed_video($post->ID, $codeEmbed) ?>
				<?php } else { ?>
					<div class="half-bottom">
				<?php jPlayer_video($post->ID, FALSE); ?>
					</div>
				<?php } ?>
			<?php } elseif ( $_post_format == 'aside' ) { ?>					
				<?php $aside_pf_text = get_post_meta($post->ID,'_cmb_aside_pf_text',TRUE); ?>
				<p><?php echo $aside_pf_text; ?></p>					
			<?php } elseif ( $_post_format == 'status' ) { ?>
				<div class="status">
					<?php $statusMsg = get_post_meta($post->ID, '_cmb_status_pf_message', true); ?>
					<?php echo '<p class="status_pf">' . $statusMsg . '</p>'; ?>
				</div>
			<?php } elseif ( $_post_format == 'quote' ) { ?>
					<div class="quote-pf-home half-bottom">
						<?php $postformat_quote = get_post_meta($post->ID,'_cmb_quote_pf_text',TRUE); ?>
						<?php $postformat_quote_cite = get_post_meta($post->ID,'_cmb_quote_cite_pf_text',TRUE); ?>
				<h6>&#147;<?php echo $postformat_quote; ?>&#148; <span class="cite-quote">--<?php echo $postformat_quote_cite; ?></span></h6>
					</div>
			<?php } elseif ( $_post_format == 'link' ) { ?>
					<?php $postformat_link = get_post_meta($post->ID,'_cmb_link_pf_url',TRUE); ?>
				
					<div class="home-meta">
						<h3 class="entry-title link-format"><a href="<?php echo $postformat_link; ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" target="_blank"><?php the_title(); ?> &rarr;</a></h3>												
					</div>
			<?php } elseif ( $_post_format == 'chat' ) { ?>
					<?php $postformat_chat = get_post_meta($post->ID,'_cmb_chat_pf_text',TRUE); ?>
					<?php $chatHolder = trim($postformat_chat); ?>
					<?php $textAr = explode("\n", $chatHolder); ?>
					<?php echo '<div class="chat-post-format"><p>'; ?>
					<?php foreach ($textAr as $line) { ?>				  
					<?php    $line = preg_replace('/:/', ':</strong>', $line, 1); ?>				
					<?php    $htmlLine .= '<strong>' . $line . '<br />'; ?>
					<?php } ?>
					<?php echo $htmlLine; ?>
					<?php echo '</p></div>'; ?>
			<?php } else { ?>
				
			<?php } ?>
		
			<?php the_content(); ?>
		
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'morphis' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
<div class="clear"></div>
	<footer class="entry-meta">
		<div class="clear"></div>
		<?php edit_post_link( __( 'Edit', 'morphis' ), '<span class="edit-link">', '</span>' ); ?>

		
		<?php 
		global $NHP_Options; 
		$options_morphis = $NHP_Options;
		$remove_post_navigation = '';		
		?>
		
		<?php if(!empty($options_morphis['toggle_remove_post_nav'])): ?>
			<?php $remove_post_navigation = $options_morphis['toggle_remove_post_nav']; ?>				
		<?php endif; ?>
		
		<?php if($remove_post_navigation != '1') : ?>		
		<hr />
		<nav id="nav-single">						
			<span class="nav-previous"><?php previous_post_link( '%link', '&larr; %title' ); ?></span>
			<span class="nav-next"><?php next_post_link( '%link', '%title &rarr;' ); ?></span>
		</nav><!-- #nav-single -->
		<?php endif; ?>
		
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->