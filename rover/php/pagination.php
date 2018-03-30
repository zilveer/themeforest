<?php
/**
 * Pagination
 * @package by Theme Record
 * @auther: MattMao
*/

#
#Theme pagination
#
if ( !function_exists( 'theme_pagination' ) )
{
	function theme_pagination() 
	{
		global $tr_config;

		if($tr_config['pagination'] == 'style')
		{
			theme_style_pagination();
		}
		elseif($tr_config['pagination'] == 'default')
		{
			theme_normal_pagination();
		}
	}
}


#
#Normal Pagination
#
if ( !function_exists( 'theme_normal_pagination' ) )
{
	function theme_normal_pagination() 
	{
		
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}

		if(1 != $pages) 
		{
		?>
		<nav class="normal-pagination">
		<ul class="clearfix col-width">
		<?php if( get_previous_posts_link() ): ?>
		<li class="prev"><?php previous_posts_link(__('Newer Entries', 'TR')) ?></li>
		<?php endif; ?>
		<?php if( get_next_posts_link() ): ?>
		<li class="next"><?php next_posts_link(__('Older Entries', 'TR')); ?></li>
		<?php endif; ?>
		</ul>
		</nav>
		 <?php
		}
	}
}

?>