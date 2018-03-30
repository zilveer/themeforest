<!-- #page-header -->
<div id="page-header">
<div class="ht-container">

	<h1><?php if (bbp_is_search()) {  _e("Search: ", "framework"); } ?><?php echo of_get_option('st_forum_title'); ?></h1>
    
    <!-- #live-search -->
<div id="live-search">

      <form role="search" method="get" id="searchform" class="clearfix" action="<?php bbp_search_url(); ?>" autocomplete="off">
        <input type="text" onfocus="if (this.value == '<?php _e("Search the forum...", "framework") ?>') {this.value = '';}" onblur="if (this.value == '')  {this.value = '<?php _e("Search the forum...", "framework") ?>';}" value="<?php _e("Search the forum...", "framework") ?>" name="bbp_search" id="s" />
      </form>

</div>
<!-- /#live-search -->

</div>
</div>
<!-- #page-header -->

<!-- #page-subnav -->
<div id="page-subnav" class="clearfix">
<div class="ht-container">
	<?php 
	$st_bbpress_breadcrumbs_args = array(
			// Modify default BBPress Breadcrumbs
			'before'          => '<nav class="bbp-breadcrumb">',
			'after'           => '</nav>',
			'sep'             => __( '&frasl;', 'bbpress' ),
	);
	bbp_breadcrumb($st_bbpress_breadcrumbs_args); ?>
</div>    
</div>
<!-- /#page-subnav -->