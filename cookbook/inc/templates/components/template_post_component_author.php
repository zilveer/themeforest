<?php
	
    $author_description = get_the_author_meta('description');
    $author_description = (!empty($author_description)) ? $author_description : "This author has not supplied a bio yet."

?>

    				<div class="boxy author clearfix">

    					<h3><?php the_author_posts_link(); ?></h3>

    					<div class="left stay"><?php echo get_avatar(get_the_author_meta('ID'), 65, '', 'author-avatar'); ?></div>
    					
    					<p><?php echo wp_kses_post($author_description); ?></p>

						<div class="author-social">
								
							<ul class="social-links">
								<?php if ( get_the_author_meta('user_url') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-globe"></em></a></li>', esc_url(get_the_author_meta('user_url')) ); } ?>
								<?php if ( get_the_author_meta('facebook') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-facebook-square"></em></a></li>', esc_url(get_the_author_meta('facebook')) ); } ?>
								<?php if ( get_the_author_meta('twitter') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-twitter-square"></em></a></li>', esc_url(get_the_author_meta('twitter')) ); } ?>
								<?php if ( get_the_author_meta('googleplus') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-google-plus-square"></em></a></li>', esc_url(get_the_author_meta('googleplus')) ); } ?>
								<?php if ( get_the_author_meta('linkedin') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-linkedin-square"></em></a></li>', esc_url(get_the_author_meta('linkedin')) ); } ?>
							</ul>
							
						</div>

    				</div>