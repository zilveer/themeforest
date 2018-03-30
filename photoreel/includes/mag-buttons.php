<div class="buttons">


<!-- ******************* twitter button ******************* -->





<div style="float: left; margin-right:0; padding-bottom: 0px; width:110px;">
<script type="text/javascript">// <![CDATA[
(function() {

    document.write('<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-url="<?php the_permalink() ?>" data-text="<?php the_title(); ?>" data-via="<?php echo get_option('themnific_twitter_id'); ?>">Tweet</a>');

    var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];

    s.type = 'text/javascript';

    s.async = true;

    s.src = 'http://platform.twitter.com/widgets.js';

    s1.parentNode.insertBefore(s, s1);

})();
// ]]></script></div>





<!-- ******************* facebook button ******************* -->


<iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink() ?>&layout=button_count&show_faces=false&width=80&action=like&font=lucida+grande&colorscheme=light" allowtransparency="true" style="border: medium none; overflow: hidden; width: 80px; height: 21px; margin-left:40px !important;" frameborder="0" scrolling="no"></iframe>




<!-- ******************* google+ button ******************* -->
<div style="margin:0 10px 0 0; float:left;">
<g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone>
<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
<script type="text/javascript"> 
			function plusone_vote( obj ) {
				_gaq.push(['_trackEvent','plusone',obj.state]);
			}
</script>
</div>

<!-- ******************* pin button ******************* -->

<?php $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
<script type="text/javascript">
(function() {
    window.PinIt = window.PinIt || { loaded:false };
    if (window.PinIt.loaded) return;
    window.PinIt.loaded = true;
    function async_load(){
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = "http://assets.pinterest.com/js/pinit.js";
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    }
    if (window.attachEvent)
        window.attachEvent("onload", async_load);
    else
        window.addEventListener("load", async_load, false);
})();
</script>



<div class="clear"></div>
</div>  