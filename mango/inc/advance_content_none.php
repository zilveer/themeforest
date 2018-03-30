<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage mango
 * @since mango 1.0
 */
?>

<div class="container  main">
    <h2><?php _e( 'Nothing Found', 'mango' ); ?></h2>
	<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mango'); ?></p>
 <div class="entry">	
 <div class="header-search-container">
<form action="<?php echo home_url(); ?>" method="get" class="search-form<?php echo $s ? ' input-visible' : ''; ?>" enctype="application/x-www-form-urlencoded">
<div class="input-group">
 <input type="text" class="form-control" name="s" placeholder="<?php _e('Search...', 'mango'); ?>" value="<?php echo esc_attr($s); ?>">
   <span class="input-group-btn">
       <button class="btn<?php echo esc_attr ( $search_button_class ) ?>" type="submit">
			 <i class="fa fa-search"></i></button>
   </span>
 </form>
 </div></div>