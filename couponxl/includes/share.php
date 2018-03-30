<ul class="list-unstyled share-networks animation <?php echo is_singular( 'post' ) ? 'opened' : ''; ?>">
	<li>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ) ?>" class="share" target="_blank">
		    <i class="fa fa-facebook"></i>
		</a>
	</li>
	<li>
		<a href="http://twitter.com/intent/tweet?text=<?php echo urlencode( get_permalink() ) ?>" class="share" target="_blank">
		    <i class="fa fa-twitter"></i>
		</a>
	</li>
	<li>
		<a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ) ?>" class="share" target="_blank">
		    <i class="fa fa-google-plus"></i>
		</a>
	</li>
</ul>

<a href="javascript:;" class="share open-share">
    <i class="fa fa-share-alt"></i>
</a>