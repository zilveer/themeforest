<?php
$is_disqus = function_exists( 'dsq_is_installed' ) && function_exists( 'dsq_can_replace' ) && 
	dsq_is_installed() && dsq_can_replace();

if( $is_disqus ) : ?>

<section id="comments" class="entry-comments-wrap">

<?php endif; ?>

	<?php if( comments_open() || have_comments() ):
		comments_template();
	endif; ?>

<?php if( $is_disqus ) : ?>

</section>

<?php endif; ?>
