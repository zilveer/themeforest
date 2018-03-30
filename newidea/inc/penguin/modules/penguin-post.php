<?php

/**
	Penguin Framework

	Copyright (c) 2009-2015 ThemeFocus

	@url http://penguin.themefocus.co
	@package Penguin
	@version 4.0
**/


class PenguinPost {
	
	public $posts;
	function PenguinPost($posts = array()){
		
		$this->posts = $posts;
		
		if(count($posts) > 0){
			add_action( 'init', array($this,'penguin_posts_register') );
			add_action( 'admin_head', array($this,'penguin_posts_admin_icon') );
			add_filter( 'post_type_link', array($this,'penguin_posts_rewrite_link') , 10, 2 );
			add_action( 'after_switch_theme', array($this,'penguin_posts_flush_rewrite_rules') );
		}
		
	}
	
	// Register post
	function penguin_posts_register(){
		
		foreach($this->posts as $post){
			 $labels = array(
				'name' 					=>	__($post['name'],Penguin::$THEME_NAME),
				'singular_name' 		=>	__($post['singular_name'],Penguin::$THEME_NAME),
				'add_new' 				=>	__($post['add_new'],Penguin::$THEME_NAME),
				'add_new_item' 			=>	__($post['add_new_item'],Penguin::$THEME_NAME),
				'edit_item' 			=>	__($post['edit_item'],Penguin::$THEME_NAME),
				'new_item' 				=>	__($post['new_item'],Penguin::$THEME_NAME),
				'all_items' 			=>	__($post['all_items'],Penguin::$THEME_NAME),
				'view_item' 			=>	__($post['view_item'],Penguin::$THEME_NAME),
				'search_items' 			=>	__($post['search_items'],Penguin::$THEME_NAME),
				'not_found'				=>	__($post['not_found'],Penguin::$THEME_NAME),
				'not_found_in_trash'	=>	__($post['not_found_in_trash'],Penguin::$THEME_NAME),
				'parent_item_colon' 	=>	__($post['parent_item_colon'],Penguin::$THEME_NAME),
				'menu_name' 			=> 	__($post['menu_name'],Penguin::$THEME_NAME),
			  );
			
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'show_in_menu' => true, 
				'query_var' => true,
				'rewrite' => array('slug'=>$post['rewrite'],'with_front'=>false),
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position'	=> $post['menu_position'],
				'supports' => $post['supports']
			  );
			  
			register_post_type($post['id'],$args);
			
			if(isset($post['categories']) && count($post['categories']) > 0){
				foreach($post['categories'] as $category){
					$labels = array(
						'name' 					=>	__($category['name'],Penguin::$THEME_NAME),
						'singular_name' 		=>	__($category['singular_name'],Penguin::$THEME_NAME),
						'add_new_item' 			=>	__($category['add_new_item'],Penguin::$THEME_NAME),
						'edit_item' 			=>	__($category['edit_item'],Penguin::$THEME_NAME),
						'all_items' 			=>	__($category['all_items'],Penguin::$THEME_NAME),
						'search_items' 			=>	__($category['search_items'],Penguin::$THEME_NAME),
						'parent_item_colon' 	=>	__($category['parent_item_colon'],Penguin::$THEME_NAME),
						'menu_name' 			=> 	__($category['menu_name'],Penguin::$THEME_NAME),
						'parent_item'			=>	__($category['parent_item'],Penguin::$THEME_NAME),
						'update_item'			=>	__($category['update_item'],Penguin::$THEME_NAME),
						'new_item_name'			=>	__($category['new_item_name'],Penguin::$THEME_NAME),
					); 
					
					register_taxonomy($category['id'],array($post['id']), array(
						'hierarchical'      => $category['hierarchical'],
						'labels'            => $labels,
						'show_ui'           => true,
						'show_admin_column' => true,
						'query_var'         => true
					));
				}
			}
		}
	}
	
	// show icon
	function penguin_posts_admin_icon(){
		?>
			<style>
		<?php
			foreach($this->posts as $item){
				if($item['menu_icon'] != ''){
					echo '#adminmenu #menu-posts-'.$item['id'].' div.wp-menu-image:before { content: "'.$item['menu_icon'].'"; }';
				}
			}	
		?>
            </style>
		<?php
	}
	
	// rewrite link
	function penguin_posts_rewrite_link($post_link, $id = 0){
		
		$post = get_post($id);
		
    	if (!is_wp_error($post) ) {
			foreach($this->posts as $item){
				if($item['id'] == $post->post_type && $item['rewrite_rule'] != ''){
					$terms = get_the_terms($post->ID, $item['rewrite_rule']); 
					
					if( is_wp_error($terms) || !$terms ) {  
						$terms = 'uncategorised';  
						return str_replace( '%'.$item['rewrite_rule'].'%' , $terms , $post_link );
					}else{
						$terms_obj = array_pop($terms);
        				$terms_slug = $terms_obj->slug;  
						return str_replace( '%'.$item['rewrite_rule'].'%' , $terms_slug , $post_link );
					}
				}
			}
			
		}
        return $post_link;  
		
	}
	
	// rewrite rules
	function penguin_posts_flush_rewrite_rules(){
		flush_rewrite_rules();
	}
	
	
}


?>