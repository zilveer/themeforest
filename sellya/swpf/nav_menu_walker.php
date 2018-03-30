<?php
class Main_nav_menu_walker extends Walker_Nav_Menu{
	
	/*function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){
		
		if(!empty($args) and gettype($args) != 'object'):
		
			$classes = '';
		
			foreach(get_post_class() as $k=>$class):
			
				$classes .= $class;	
			
				if($k<count(get_post_class())-1)
					$classes .= ' ';
			
			
			endforeach;
				
				
			//var_dump($args);
				
			$output .= "<li id='menu-item-$item->ID' class='$classes'>";
	
			$attributes  = '';
	
			$attributes .= ' title="'  . esc_attr( $item->post_title ) .'"';
			
			$attributes .= ' href="'   . get_permalink($item->ID) .'"';
	
			$title = apply_filters( 'the_title', $item->post_title, $item->ID );
			
			$item_output = $args['before']
				. "<a $attributes>"
				. $args['link_before']
				. $title
				. '</a> '
				. $args['link_after']				
				. $args['after'];
	
			// Since $output is called by reference we don't need to return anything.
			$output .= apply_filters(
				'walker_nav_menu_start_el'
			,   $item_output
			,   $item
			,   $depth
			,   $args
			);
		else:
		
			parent::start_el($output, $item, $depth, $args, $id);
		
		endif;
		
	}*/
	
	function end_el(&$output, $item, $depth = 0, $args = array()){
		
		global $smof_data, $wpdb;
		
		$table_exists = $wpdb->get_row("SHOW TABLES LIKE '{$wpdb->prefix}icl_translations'");
		
		if($item->object_id == (int)$smof_data['sellya_menu_categories_page'] and $depth == 0 and gettype($args) == 'object'):		
			$output .= $this->product_category_listing();
		
		elseif(!empty($table_exists)):
		
			$row = array();
		
			if(!empty($item->object_id))
		
				$row = $wpdb->get_row("SELECT trid FROM {$wpdb->prefix}icl_translations WHERE element_id={$item->object_id}");
			
			if(!empty($row) and $row->trid == (int)$smof_data['sellya_menu_categories_page']):
			
				$output .= $this->product_category_listing();
			
			endif;
			
		endif;	
		
		parent::end_el($output, $item, $depth, $args);
		
		
	}
	
	function product_category_listing(){
		
		global $smof_data, $woocommerce;
	
		if(!isset($woocommerce)) return ;
		
		ob_start();
		
		$args = array('hide_empty'=>false,'parent'=>0);
        $terms = get_terms('product_cat',$args);
		
		if(!empty($terms)):
		
			if($smof_data['sellya_menu_categories_style'] == 'Horizontal'):
		
		?>
            <ul class="span10 sub-menu">
                <?php
                foreach($terms as $i=>$term):
                
                    $args = array('hide_empty'=>false,'parent'=>$term->term_id);
                    $t2 = get_terms('product_cat',$args);
						
                ?>
                <div class="span2<?php echo $i%5 == 0?" span-first-child":""?>">
                
                	<?php
					
					if($smof_data['sellya_mm2_main_category_icon_status'] != 0):
					
						$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
				
						$image = wp_get_attachment_image_src($thumbnail_id,'full');
						
						$image = $image[0]; 
						
						$img_class = '';
						
						if(!$thumbnail_id):
							$image = sprintf("%s/image/no_image-100x100.png",get_template_directory_uri());
							$img_class = 'no_image';
							
						endif;
					
					?>                
                	<div class="image catmegamenu"><a href="<?php echo get_term_link($term->slug,'product_cat');?>"><img alt="<?php echo $term->name?>" class="<?php echo $img_class;?>" title="<?php echo $term->name?>" src="<?php echo $image?>"></a></div>
                
                	<?php 
					endif;
					?>
                
                    <div class="menu-category-wall-sub-name">
                        <a href="<?php echo get_term_link($term->slug,'product_cat');?>"><?php echo $term->name?></a>
                    </div>
                    <?php if(!empty($t2)):?>
                    <div>
                        <ul>
                        <?php foreach($t2 as $t):?>
                            <li><a href="<?php echo get_term_link($t->slug,'product_cat');?>"><?php echo $t->name?> (<?php echo $t->count?>)</a></li>
                        
                        <?php endforeach;?>
                        </ul>
                    </div>
                    <?php endif;?>
                </div>
            
                <?php
                endforeach;
                ?>
            
            </ul>
        <?php
			else:		
		?>
			<ul class="sub-menu">
                <?php
                foreach($terms as $i=>$term):
                
                    $args = array('hide_empty'=>false,'parent'=>$term->term_id);
                    $t2 = get_terms('product_cat',$args);		
                ?>
                <li>
					<a href="<?php echo get_term_link($term->slug,'product_cat');?>"><?php echo $term->name?></a>
				<?php if(!empty($t2)):?>
                    <ul class="sub-menu">
                    <?php foreach($t2 as $t):?>
                        <li><a href="<?php echo get_term_link($t->slug,'product_cat');?>"><?php echo $t->name?> (<?php echo $t->count?>)</a></li>
                    
                    <?php endforeach;?>
                    </ul>
                <?php endif;?>
                </li>
            
                <?php
                endforeach;
                ?>
            
            </ul>
		<?php
			endif;//
		endif;//if(!empty($terms)):
		
		$content = ob_get_contents();
		
		ob_end_clean();
		
		return $content;
		
	}
	
}

?>