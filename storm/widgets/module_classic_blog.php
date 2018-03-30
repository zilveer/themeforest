<?php
/**
 * Plugin Name: BK-Ninja: Classic Blog Module
 * Plugin URI: http://bk-ninja.com
 * Description: This module displays latest posts in classic blog layout
 * Version: 1.0
 * Author: BK-Ninja
 * Author URI: http://bk-ninja.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'bk_register_classic_blog_module');

function bk_register_classic_blog_module(){
	register_widget('bk_classic_blog');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class bk_classic_blog extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function __construct(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'module-classic-blog', 'description' => __('[Content module] Displays latest posts in classic blog layout in content section.','bkninja'));
		
		/* Create the widget. */
		parent::__construct('bk_classic_blog', __('*BK: Module Classic Blog','bkninja'), $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
        $defaults = array('size' => 'small','category1' => '', 'category2' => 'disable','category3' => 'disable',
                            'category4' => 'disable', 'category5' => 'disable', 'entries_display' => 4, 'entries_loadmore' => 4, 'display' => 'thumbnail');
        $instance = wp_parse_args((array) $instance, $defaults);
		extract($args);
        $display = $instance['display'];
        $entries_display = $instance['entries_display'];
        $entries_loadmore = $instance['entries_loadmore'];
        $cat_id = array();
        $args = array();
        $title_first = 1;
        $content_first = 1;
        $size = $instance['size'];
        $category_name = array();
		echo $before_widget;
        
        for($i=1; $i<=5; $i++){
            $args[$i] = null;
            $cat_id[$i] = $instance['category'.$i];
            if ($cat_id[$i] != 'disable'){
                $args[$i] = array(
                    			'cat' => $cat_id[$i],
                    			'post_status' => 'publish',
                    			'ignore_sticky_posts' => 1,
                                'posts_per_page' => $entries_display
                            );
                if($cat_id[$i] != '')
                    $category_name[$i] = get_cat_name($cat_id[$i]);
                else
                    $category_name[$i] = 'Latest Posts';
            }
        }

        ?>                               
        <div class="bk-classic-blog-tabs" >
            <div class="bk-entries-display" style="display: none;"><?php echo $entries_display; ?></div><div class="bk-entries-loadmore" style="display: none;"><?php echo $entries_loadmore; ?></div>        
    		<div class="bk-classic-blog-tabs-title-container widget-tabs-title-container">
            			<ul class="bk-classic-blog-tab-titles widget-tabs-title">
                            <?php for ($i=1; $i<=5; $i++){ 
                                if ($cat_id[$i] == 'disable')
                                    continue;
                                if ($title_first) {
                                    $title_first = 0;?>
            				        <li class="active"><h3><a href="#bk-classic-blog-tab<?php echo $i;?>-content"><?php _e($category_name[$i], 'bkninja'); ?></a></h3></li>
                                <?php } else {?>
                                    <li class=""><h3><a href="#bk-classic-blog-tab<?php echo $i;?>-content"><?php _e($category_name[$i], 'bkninja'); ?></a></h3></li>
                                <?php } ?>
                            <?php } ?>
            			</ul>
    		</div>
         	
    		<div class="classic-blog-post section blog-<?php echo $display; ?>"  style="position: relative;">
                <?php for ($i=1; $i<=5; $i++){ 
                    if ($cat_id[$i] != 'disable') {
                        if ($content_first) {
                            $content_first = 0;?>
                            <div id="bk-classic-blog-tab<?php echo $i;?>-content" class="bk-classic-blog-tab-content" style=" position: static;">       
                                <div class="bk-classic-blog-content js-classic-blog <?php echo 'bk-classic-'.$size; ?>">
                                    <?php $query = new WP_Query( $args[$i] ); ?>
                            		<?php if ( $query -> have_posts() ) : ?>
                            			<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>  	
                                            <?php bk_get_classic_blog_content($size, $display);?>
                            			<?php endwhile; ?>
                            		<?php endif; ?>	                    
                                </div>	<!-- End bk-classic-blog-content -->
                                <?php if($instance['category'.$i] != 'disable'){ ?>
                                <div class='<?php echo $cat_id[$i];?> load-more'><div class="inner"><span class="load-more-text"><?php _e('Load more','bkninja');?></span><span class="loading-animation"></span></div></div>                                               
                                 <?php }?>
                            </div>                        
                        <?php }else {                    ?>
                    
                            <div id="bk-classic-blog-tab<?php echo $i;?>-content" class="bk-classic-blog-tab-content" style="position: absolute; top: -9999999px;">            
                                <div class="bk-classic-blog-content js-classic-blog <?php echo 'bk-classic-'.$size; ?>" >
                            		<?php $query = new WP_Query( $args[$i] ); ?>
                            		<?php if ( $query -> have_posts() ) : ?>
                            			<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>  	
                                            <?php bk_get_classic_blog_content($size, $display);?>
                            			<?php endwhile; ?>
                            		<?php endif; ?>	                    
                                </div>	<!-- End bk-classic-blog-content -->
                                <?php if($instance['category'.$i] != 'disable'){ ?>
                                <div class='<?php echo $cat_id[$i];?> load-more'><div class="inner"><span class="load-more-text"><?php _e('Load more','bkninja');?></span><span class="loading-animation"></span></div></div>                
                                <?php }?>
                            </div>
                            <?php }
                            }
                        }?>
                
    		</div>
        </div>                        
	<!-- End category -->	
					
		<?php
		echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
        $instance['size'] = $new_instance['size'];
		$instance['category1'] = $new_instance['category1'];
        $instance['category2'] = $new_instance['category2'];
        $instance['category3'] = $new_instance['category3'];
        $instance['category4'] = $new_instance['category4'];
        $instance['category5'] = $new_instance['category5'];
        $instance['entries_display'] = $new_instance['entries_display'];
        $instance['entries_loadmore'] = $new_instance['entries_loadmore'];
        $instance['display'] = $new_instance['display'];
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array('size' => 'small','category1' => '', 'category2' => 'disable','category3' => 'disable',
                            'category4' => 'disable', 'category5' => 'disable', 'entries_display' => 4, 'entries_loadmore' => 4, 'display' => 'thumbnail');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
        <p>
			<label for="<?php echo $this->get_field_id('size'); ?>"><strong><?php _e('Choose layout:', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" class="widefat size" style="width:100%;">
				<option value='small' <?php if ('small' == $instance['size']) echo 'selected="selected"'; ?>><?php _e( 'Small', 'bkninja' ); ?></option>
                <option value='big' <?php if ('big' == $instance['size']) echo 'selected="selected"'; ?>><?php _e( 'Big', 'bkninja' ); ?></option>
			</select>
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id('category1'); ?>"><strong><?php _e('Tab Category:', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('category1'); ?>" name="<?php echo $this->get_field_name('category1'); ?>" class="widefat categories1" style="width:100%;">
                <option value='disable' <?php if ('disable' == $instance['category1']) echo 'selected="selected"'; ?>><?php _e( '--disable--', 'bkninja' ); ?></option>
                <option value='' <?php if ('' == $instance['category1']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php $categories1 = get_categories('hide_empty=1&type=post'); ?>
				<?php foreach($categories1 as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['category1']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('category2'); ?>"><strong><?php _e('Tab Category:', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('category2'); ?>" name="<?php echo $this->get_field_name('category2'); ?>" class="widefat categories2" style="width:100%;">
				<option value='disable' <?php if ('disable' == $instance['category2']) echo 'selected="selected"'; ?>><?php _e( '--disable--', 'bkninja' ); ?></option>
                <option value='' <?php if ('' == $instance['category2']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php $categories2 = get_categories('hide_empty=1&type=post'); ?>
				<?php foreach($categories2 as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['category2']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('category3'); ?>"><strong><?php _e('Tab Category:', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('category3'); ?>" name="<?php echo $this->get_field_name('category3'); ?>" class="widefat categories3" style="width:100%;">
				<option value='disable' <?php if ('disable' == $instance['category3']) echo 'selected="selected"'; ?>><?php _e( '--disable--', 'bkninja' ); ?></option>
                <option value='' <?php if ('' == $instance['category3']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php $categories3 = get_categories('hide_empty=1&type=post'); ?>
				<?php foreach($categories3 as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['category3']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
        
                <p>
			<label for="<?php echo $this->get_field_id('category4'); ?>"><strong><?php _e('Tab Category:', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('category4'); ?>" name="<?php echo $this->get_field_name('category4'); ?>" class="widefat categories4" style="width:100%;">
				<option value='disable' <?php if ('disable' == $instance['category4']) echo 'selected="selected"'; ?>><?php _e( '--disable--', 'bkninja' ); ?></option>
                <option value='' <?php if ('' == $instance['category4']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php $categories4 = get_categories('hide_empty=1&type=post'); ?>
				<?php foreach($categories4 as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['category4']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('category5'); ?>"><strong><?php _e('Tab Category:', 'bkninja'); ?></strong></label> 
			<select id="<?php echo $this->get_field_id('category5'); ?>" name="<?php echo $this->get_field_name('category5'); ?>" class="widefat categories5" style="width:100%;">
				<option value='disable' <?php if ('disable' == $instance['category5']) echo 'selected="selected"'; ?>><?php _e( '--disable--', 'bkninja' ); ?></option>
                <option value='' <?php if ('' == $instance['category5']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'bkninja' ); ?></option>
				<?php $categories5 = get_categories('hide_empty=1&type=post'); ?>
				<?php foreach($categories5 as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['category5']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><strong><?php _e('Number of entries to display', 'bkninja'); ?></strong></label>
            <input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'entries_loadmore' ); ?>"><strong><?php _e('Number of entries to load more', 'bkninja'); ?></strong></label>
            <input type="text" id="<?php echo $this->get_field_id('entries_loadmore'); ?>" name="<?php echo $this->get_field_name('entries_loadmore'); ?>" value="<?php echo $instance['entries_loadmore']; ?>" style="width:100%;" />
        </p>
        
        <p>     
            <label for="<?php echo $this->get_field_id( 'display' ); ?>"><strong><?php   _e('Video thumbnail option: ','bkninja'); ?></strong></label>    		 	
            <select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">            
                <option value="thumbnail" <?php if ($instance['display'] == 'thumbnail') echo 'selected="selected"'; ?>><?php _e('Thumbnail', 'bkninja');?></option>               
                <option value="video" <?php if ($instance['display'] == 'video') echo 'selected="selected"'; ?>><?php _e('Video', 'bkninja');?></option>                           	
             </select>          
        </p>
	<?php }
}
?>