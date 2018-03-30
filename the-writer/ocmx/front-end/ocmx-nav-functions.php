<?php function ocmx_page_menu()
	{
		if(get_option("ocmx_page_order") !== "post_title") :
			$page_args = array("sort_column" => get_option("ocmx_page_order"), "sort_order" => get_option("ocmx_page_updown"), "depth" => "1");
		else :
			$page_args = array("sort_order" => get_option("ocmx_page_updown"), "depth" => "1");
		endif;
		$fetch_pages = get_pages($page_args);
		foreach ($fetch_pages as $this_page) :
			$this_option = "ocmx_menu_page_".$this_page->ID;
			if(get_option($this_option)) :
				$sub_page_count = 0;
				if(get_option("ocmx_page_order") !== "post_title") :
					$sub_page_defaults = array("child_of" => $this_page->ID, "sort_column" => get_option("ocmx_page_order"), "sort_order" => get_option("ocmx_page_updown"));
				else :
					$sub_page_defaults = array("child_of" => $this_page->ID, "sort_order" => get_option("ocmx_page_updown"));
				endif;
				$sub_pages = get_pages($sub_page_defaults);
				foreach ($sub_pages as $sub_page) :
					$this_sub_page_option = "ocmx_subpage_".$sub_page->ID;
					if(get_option($this_sub_page_option)) :
						$sub_page_count++;
					endif;
				endforeach; 
?>
				<li class="parent-item">
                	<a href="<?php echo get_page_link($this_page->ID); ?>" id="main-menu-page-item-<?php echo $this_page->ID; ?>" class="parent-link"><span><?php echo $this_page->post_title; ?></span></a>
					<?php if($sub_page_count !== 0) : ?>
                    	<ul class="sub-menu" id="sub-page-menu-<?php echo $this_page->ID; ?>" style="display: none;">
							<?php
                                foreach ($sub_pages as $sub_page) :
                                    $this_sub_page_option = "ocmx_subpage_".$sub_page->ID;
                                    if(get_option($this_sub_page_option)) :
                            ?>
                                <li><a href="<?php echo get_page_link($sub_page->ID); ?>"><?php echo $sub_page->post_title; ?></a></li>
                            <?php
                                    endif;
                                endforeach;
                            ?>
					</ul>               
                    <?php endif; ?>
				</li>
<?php
			endif;
		endforeach;
		$parent_count = 0;
	}
function ocmx_category_menu()
	{
        $defaults = array("type" => "post", "child_of" => 0, "orderby" => get_option("ocmx_category_order"), "order" => get_option("ocmx_category_updown"), "hide_empty" => false);
		$parent_categories = get_categories($defaults);
		// Count the Parent Categories (That is Categories without Parents themselves (To be used in the loop, explained below)
		foreach ($parent_categories as $this_category) :
			$this_option = "ocmx_maincategory_".$this_category->cat_ID;				
			if(get_option($this_option)) :
				$sub_category_count = 0;
				$sub_category_defaults = array('type' => 'post', 'child_of' => $this_category->cat_ID, 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false);
				$sub_categories = get_categories($sub_category_defaults);
				// Below will loop through the sub categories and populate the sub_category_count if there is an option selected for the category
				foreach ($sub_categories as $sub_category) :
					$this_sub_option = "ocmx_subcategory_".$sub_category->cat_ID;
					if(get_option($this_sub_option)) :
						$sub_category_count++;
					endif;
				endforeach; ?>
				<li class="parent-item">
					<a href="<?php echo get_category_link($this_category->term_id); ?>" class="parent-link" id="main-menu-item-<?php echo $this_category->cat_ID; ?>">
						<span>
							<?php echo $this_category->cat_name; ?>
                        </span>
					</a>
<?php
				if($sub_category_count !== 0) :
?>
					<ul class="sub-menu" id="sub-menu-<?php echo $this_category->cat_ID; ?>" style="display: none;">
<?php
						foreach ($sub_categories as $sub_category) :
							$this_sub_option = "ocmx_subcategory_".$sub_category->cat_ID;
							if(get_option($this_sub_option)) :
?>
								<li><a href="<?php echo get_category_link($sub_category->term_id); ?>"><?php echo $sub_category->cat_name; ?></a></li>
<?php
							endif;
						endforeach;
?>
					</ul>               
<?php 
				endif;
?>
				</li>         
<?php
			endif;
		endforeach;
	}
function ocmx_menu()
	{
		if(get_option("ocmx_page_category_order") == "pages_first") :
			ocmx_page_menu();
			ocmx_category_menu();
		else :
			ocmx_category_menu();
			ocmx_page_menu();
		endif;
	}
?>