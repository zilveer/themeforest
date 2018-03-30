<?php if( !defined('ABSPATH') ) exit;?>
<?php global $videotube;?>
<form role="form" class="form-inline" method="get" action="<?php print home_url();?>">	
	<div class="form-group">	
		<input class="form-control" value="<?php print get_search_query();?>" name="s" type="text" placeholder="<?php _e('Search here...','mars')?>" id="search">
		<?php if( isset( $videotube['video_search'] ) && $videotube['video_search'] == 1 ):?>
			<input type="hidden" name="post_type" value="video">
		<?php endif;?>		
		<span class="glyphicon glyphicon-search search-icon"></span>
	</div>
</form>	

