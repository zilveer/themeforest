<?php
    /* social sharing  */
    if( (get_post_type() == 'page' && options::get_value( 'blog_post' , 'page_sharing' ) == 'yes') || ( (get_post_type() == 'post' || get_post_type() == 'event' || get_post_type() == 'portfolio') && options::get_value( 'blog_post' , 'post_sharing' ) == 'yes' ) ) {
    
    	if( meta::logic( $post , 'settings' , 'sharing' ) ){
?>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-502cec784e2c0ebc"></script>
<div class="share-container">
	<div class="article-share">
		<!-- AddThis Button BEGIN -->
		<div class="share">
			<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_pinterest_pinit"></a>
				<a class="addthis_counter addthis_pill_style"></a>
			</div>
		</div>
	</div>
</div>
<!-- AddThis Button END -->
<?php
    	}
    }
?>