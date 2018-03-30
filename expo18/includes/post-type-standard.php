	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="post-date"><?php the_time( get_option('date_format') ); ?></div>		
		<?php if(has_post_thumbnail()) { ?>
			<div class="post-thumb">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			</div>
		<?php } ?>
		<div class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
		<div class="post-text">
			<?php 
				if( has_excerpt() ) {
					// echo apply_filters( 'the_excerpt', get_the_excerpt() . ' <a href="'.get_permalink().'">'.__('Read more...', 'om_theme').'</a>' );
					the_excerpt();
					echo '<p><a href="'.get_permalink().'">'.__('Read more...', 'om_theme').'</a></p>';
				} else {
					the_content(__('Read more...', 'om_theme'));
				}
			?>
			<div class="clear"></div>
		</div>

		<div class="post-meta">
			
			<?php
				if(get_option(OM_THEME_PREFIX.'post_hide_categories') != 'true') {
					if($categories = get_the_category_list(', ')) { ?>
						<span class="post-categories">
							<?php echo $categories; ?>
						</span>
			<?php
					}
				} ?>
			
			<?php if($tags = get_the_tag_list('', ', ', '' )) { ?>
				<span class="post-tags">
					<?php echo $tags; ?>
				</span>
			<?php } ?>
			
			<?php comments_popup_link(); ?>
		</div>
				
		<div class="clear"></div>
	</div>