<div class="author-info">
	<div class="author-avatar">
		<?php
		$author_bio_avatar_size = 170;
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div>
	<div class="author-description">
		<h2 class="author-title"><?php printf( get_the_author() ); ?></h2>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p>
		<?php 
		$facebook = get_the_author_meta('facebook');
		$twitter = get_the_author_meta('twitter');
		$google = get_the_author_meta('google');
		$linkedin = get_the_author_meta('linkedin');
		$pinterest = get_the_author_meta('pinterest');
		if($facebook || $twitter || $google || $linkedin || $pinterest):
		?>
		<div class="author-social">
			<?php if($facebook): ?>
			<span class="author-social-facebook">
				<a href="<?php echo esc_url($facebook); ?>" target="_blank" title="<?php printf( esc_attr__( '%s on Facebook', 'jakiro' ), get_the_author() ); ?>"><i class="fa fa-facebook"></i></a>
			</span>
			<?php endif;?>
			<?php if($twitter): ?>
			<span class="author-social-twitter">
				<a href="<?php echo esc_url($twitter) ?>" class="author-social-twitter"  target="_blank" title="<?php printf( esc_attr__( '%s on Twitter', 'jakiro' ), get_the_author() ); ?>"><i class="fa fa-twitter"></i></a>
			</span>
			<?php endif;?>
			<?php if($google): ?>
			<span class="author-social-google-plus">
				<a href="<?php echo esc_url($google) ?>" class="author-social-google"  target="_blank" title="<?php printf( esc_attr__( '%s on Google +', 'jakiro' ), get_the_author() ); ?>"><i class="fa fa-google"></i></a>
			</span>
			<?php endif;?>
			<?php if($linkedin): ?>
			<span class="author-social-linkedin">
				<a href="<?php echo esc_url($linkedin); ?>" class="author-social-linkedin"  target="_blank" title="<?php printf( esc_attr__( '%s on Linked In', 'jakiro' ), get_the_author() );?>"><i class="fa fa-linkedin"></i></a>
			</span>
			<?php endif;?>
			<?php if($pinterest): ?>
			<span class="author-social-pinterest">
				<a href="<?php echo esc_url($pinterest) ?>" class="author-social-pinterest"  target="_blank" title="<?php printf( esc_attr__( '%s on Pinterest', 'jakiro' ), get_the_author() );?>"><i class="fa fa-pinterest"></i></a>
			</span>
			<?php endif;?>
		</div>
		<?php endif;?>
	</div>
</div>