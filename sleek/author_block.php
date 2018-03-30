<!-- Template part: Author Block-->

<div class="author-block">

	<div class="author-block__image">
		<?php
			echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">';
			echo get_avatar(get_the_author_meta('ID'), 300);
			echo '</a>';
		?>
	</div>

	<div class="author-block__content">

		<h2>
			<span class="above"><?php echo __('The Author', 'sleek'); ?></span>
			<?php echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">' . get_the_author() . '</a>'; ?>
		</h2>

		<div class="author-block__description">
			<?php echo wpautop( get_the_author_meta('description') ); ?>
		</div>

		<!-- &nbsp; -->

	</div>

</div>