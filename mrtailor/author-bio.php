<div class="author-info">
	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 140 ); ?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h2 class="author-title"><?php printf( __( 'About %s', 'mr_tailor' ), get_the_author() ); ?></h2>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<div>
                <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                    <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'mr_tailor' ), get_the_author() ); ?>
                </a>
            </div>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->