<div class="search__wrapper">
	<button class="search__close  js-search-close"></button>
	<div class="search__container">
		<form class="search-fullscreen" method="get" action="<?php echo home_url( '/' ); ?>" role="search">
			<input type="text" name="s" class="search-input  js-search-input" placeholder="<?php _e('Type to search', 'heap') ?>" autocomplete="off" value="<?php the_search_query(); ?>" /><!--
			--><button class="search-button" id="searchsubmit"><i class="icon  icon-search"></i></button>
		</form>
		<hr class="separator" />
		<p class="search-description"><?php _e('Begin typing your search above and press return to search. Press Esc to cancel.', 'heap') ?></p>
	</div>
</div>