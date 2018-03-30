
	<div class="post_share_wrap clearfix">

		<ul>
				
			<li><a class="facebook" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode(the_permalink()) ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(the_permalink()) ?>"><i class="fa fa-facebook-square fa-2x"></i></a></li>
				
			<li><a class="twitter" onclick="window.open('http://twitter.com/share?url=<?php echo urlencode(the_permalink()) ?>&amp;text=<?php echo urlencode(get_the_title()) ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php echo urlencode(the_permalink()) ?>&amp;text=<?php echo urlencode(get_the_title()) ?>"><i class="fa fa-twitter-square"></i></a></li>
				
			<li><a class="google" onclick="window.open('https://plus.google.com/share?url=<?php echo urlencode(the_permalink()) ?>','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="https://plus.google.com/share?url=<?php echo urlencode(the_permalink()) ?>"><i class="fa fa-google-plus-square"></i></a></li>

			<li><a class="pinterest" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(the_permalink()) ?>&amp;description=<?php echo urlencode(get_the_title()) ?>"data-pin-do="buttonPin"data-pin-config="above"><i class="fa fa-pinterest-square"></i></a></li>

			<li><a class="email_share" href="mailto:?Subject=<?php get_site_url(); ?>&amp;Body=<?php echo urlencode(the_permalink()) ?>"><i class="fa fa-envelope-square"></i></a></li>

		</ul>

	</div><!-- .post_share_wrap -->