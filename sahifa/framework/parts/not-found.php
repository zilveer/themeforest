<div id="post-0" class="post not-found post-listing">
	<h1 class="post-title"><?php _eti( 'Not Found' ); ?></h1>
	<div class="entry">
		<p><?php _eti( 'Apologies, but the page you requested could not be found. Perhaps searching will help.' ); ?></p>

		<div class="search-block-large">
			<form method="get" action="<?php echo home_url(); ?>/">
				<button class="search-button" type="submit" value="<?php if( !$is_IE ) _eti( 'Search' , 'tie' ) ?>"><i class="fa fa-search"></i></button>	
				<input type="text" id="s" name="s" value="<?php _eti( 'Search' ) ?>" onfocus="if (this.value == '<?php _eti( 'Search' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _eti( 'Search' ) ?>';}"  />
			</form>
		</div><!-- .search-block /-->
	</div>
</div>