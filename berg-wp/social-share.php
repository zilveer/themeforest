<div class="social-share">
	<ul>
		<?php if (YSettings::g('share_on_facebook', '1') == '1') : ?>
		<li>
			<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="_blank" title=""><i class="fa fa-facebook"></i></a>
		</li>
		<?php endif; ?>
		<?php if (YSettings::g( 'share_on_twitter', '1') == '1' ) : ?>
		<li>
			<a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" title=""><i class="fa fa-twitter"></i></a>
		</li>
		<?php endif; ?>
		<?php if (YSettings::g( 'share_on_google_plus', '1') == '1' ) : ?>
		<li>
			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" title=""><i class="fa fa-google-plus"></i></a>
		</li>
		<?php endif; ?>
		<?php if (YSettings::g( 'share_on_pinterest', '1') == '1' ) : ?>
		<li>
			<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" target="_blank" title=""><i class="fa fa-pinterest"></i></a>
		</li>
		<?php endif; ?>
		<?php if (YSettings::g( 'share_on_linkedin', '1') == '1' ) : ?>
		<li>
			<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>" target="_blank" title=""><i class="fa fa-linkedin"></i></a>
		</li>
		<?php endif; ?>
	</ul>
</div>