<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */
?>
<aside class="grid_4 right" id="sidebar">
  <div>
  <?php
		$has_subpages = false;
		// Check to see if the current page has any subpages
		$children = wp_list_pages('&child_of='.$post->ID.'&echo=0');
		if($children) {
		    $has_subpages = true;
		}
		// Reseting $children
		$children = "";
		
		// Fetching the right thing depending on if we're on a subpage or on a parent page (that has subpages)
		if(is_page() && $post->post_parent) {
		    // This is a subpage
		    $children .= wp_list_pages("title_li=&child_of=".$post->post_parent ."&echo=0");
		} else if($has_subpages) {
		    // This is a parent page that have subpages
		    $children .= wp_list_pages("title_li=&child_of=".$post->ID ."&echo=0");
		}
	?>
    <?php if ($children) { ?>
    <nav id="subnavigation"  class="clearfix">
      <h2>Subnavigation</h2>
      <ul>
    	<?php echo $children; ?>
      </ul>
    </nav>
    <?php } ?>
	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()): ?>
		<div class="widget clearfix widget_archive">
			<h2>Archives</h2>
			<ul>
				<?php wp_get_archives('type=monthly') ?>
			</ul>
		</div>
		<div class="widget clearfix widget_categories">
			<h2>Categories</h2>
			<ul>
				<?php wp_list_categories('title_li=') ?>
			</ul>
		</div>
		<?php if (is_home() || is_page()): ?>
			<?php wp_list_bookmarks('title_li=&category_before=<div class="widget clearfix widget_links">&category_after=</div>&') ?>
			<div class="widget clearfix widget_meta widget_meta">
				<h2>Meta</h2>
				<ul>
					<?php wp_register() ?>
					<li>
						<?php wp_loginout() ?>
					</li>
					<?php wp_meta() ?>
				</ul>
			</div>
		<?php endif ?>
	<?php endif ?>

  </div>
</aside>