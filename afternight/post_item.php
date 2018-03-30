<?php 
/*
Template Name: Post item
*/ 

get_header(); 

?> 
<section id="main" class="single">

	<div class="row">

        <div class="twelve columns" id="primary">
            <div id="content" role="main">
                
	
<?php	

$first_column_class = 'three';
$second_column_class = 'nine';


if(!is_numeric(options::get_value( 'upload' , 'post_item_page' ))){
	_e('Post submission is disabled','cosmotheme');
}else if(is_user_logged_in()){

	/*check settings to see what categories are allowed*/

	$subcategories = get_categories( array( 'hide_empty' => false ) );  /*get all categories*/
    $unselected_subcategories ='0';
    $settings_categories = options::get_value( 'upload' , 'post_item_categories' );

    foreach( $subcategories as $subcategory ){
        
        if(!in_array($subcategory -> cat_ID, $settings_categories)){
        	$unselected_subcategories .= ',' . $subcategory -> cat_ID;	
        }
    	
    }

    $portfolios_cat_ids = options::get_value( 'upload' , 'post_item_portfolio_categories' );
    $portfolios = array();
    $portfolio_categ_options = '';
    
    $assigned_portfolios = array();
    if(isset ($_GET['post']) && is_numeric($_GET['post'])){
    	$post_portfolios = wp_get_post_terms($_GET['post'], 'portfolio-category' );
    	foreach ($post_portfolios as $post_portfolio) {
    		$assigned_portfolios[] = $post_portfolio -> term_id; 
    	}
    }


    if(is_array($portfolios_cat_ids)){
	    foreach($portfolios_cat_ids as $id) {
	    	$term = get_term( $id, 'portfolio-category' );
	    	$selected = '';
	    	if(in_array(trim($term->term_id), $assigned_portfolios)){
	    		$selected = 'selected="selected"';
	    	}
	    	$portfolio_categ_options .= '<option  value="'.$term->term_id.'" '.$selected.'>'.$term->name.'</option>';
	    }
	    $display_post_type_class = '  ';
	}else{
		$display_post_type_class = ' hidden '; /*if no portfolio categories are selected then we hide the possibility to choose portfolios*/
	}    

    if(strlen($portfolio_categ_options)){
    	$portfolio_categ_options = '<select name="portfolio-category"  class="postform portfolio-category" disabled>'.$portfolio_categ_options.'</select>';
    } 

    $category_class = '';
    $portfolio_info_class = 'hide';
    $post_format = '';

    /*default val for post type = 'post'*/
    $post_type = '<label post_type_label><input type="radio" class="post_type_rd" name="post_type" value="post" checked> '.__('Post','cosmotheme').'</label>';
    $post_type .= '<label post_type_label><input type="radio" class="post_type_rd" name="post_type" value="portfolio" > '.__('Portfolio','cosmotheme').'</label>';
    
    if(isset ($_GET['post']) && is_numeric($_GET['post'])){

    	$current_post_type = get_post_type($_GET['post']);
    	if($current_post_type == 'post'){
    		$post_type = '<label post_type_label><input type="radio" class="post_type_rd" name="post_type" value="post" checked> '.__('Post','cosmotheme').'</label>';
    		$post_type .= '<label post_type_label><input type="radio" class="post_type_rd" name="post_type" value="portfolio" > '.__('Portfolio','cosmotheme').'</label>';
    	}else{
    		$category_class = 'hide';
    		$portfolio_info_class = '';	
    		$post_type = '<label post_type_label><input type="radio" class="post_type_rd" name="post_type" value="post" > '.__('Post','cosmotheme').'</label>';
    		$post_type .= '<label post_type_label><input type="radio" class="post_type_rd" name="post_type" value="portfolio" checked > '.__('Portfolio','cosmotheme').'</label>';

    		/*overwrite categ select to remove disable*/
    		if(strlen(trim($portfolio_categ_options) )){
		    	$portfolio_categ_options = str_replace(' disabled','',$portfolio_categ_options);
		    } 
    	}
    	
    

        $post_id = $_GET['post'];
		
		$the_source = '';
		$source_meta = meta::get_meta( $post_id , 'source' );
		if(is_array($source_meta) && sizeof($source_meta) && isset($source_meta['post_source']) && trim($source_meta['post_source']) != ''){
			$the_source = $source_meta['post_source'];
			
		}
			
		$the_client = '';
		if(is_array($source_meta) && sizeof($source_meta) && isset($source_meta['post_client']) && trim($source_meta['post_client']) != ''){
			$the_client = $source_meta['post_client'];
			
		}

		$the_services = '';
		if(is_array($source_meta) && sizeof($source_meta) && isset($source_meta['post_services']) && trim($source_meta['post_services']) != ''){
			$the_services = $source_meta['post_services'];
			
		}
		
        $post_edit = get_post($post_id);
        
		$post_categories = wp_get_post_categories( $post_id );	
        switch(get_post_format( $post_id )){
            case 'video':
                $post_format = 'video';
                $action_edit_video = true;    
                break;
            case 'audio':
                $post_format = 'audio';
                $action_edit_audio = true;
                break;
            case 'link':
                $post_format = 'link';
                $action_edit_link = true;
                break;
            case 'image':
                $post_format = 'image';
                $action_edit_image = true;
                break;
            case 'gallery':
                $post_format = 'gallery';
                $action_edit_image = true;
                break;
            default:
                $post_format = 'default';
                $action_edit_text = true;
        }
        
		if(has_post_thumbnail( $post_id )){
			$thumb_id = get_post_thumbnail_id($post_id);
		}
        
    }
	CosmoUploader::init();
?>
<div class="cosmo-box error medium hidden" id="video_error_msg_box">
	<span class="cosmo-ico"></span> 
	<span id="video_error_msg" ></span> 
</div>
<div class="cosmo-tabs submit post-item-page" id="d39">
	<div class="row single-title ">
		<div class="twelve columns">
	    	<h2><?php the_title(); ?></h2>
		</div>
	</div> 
    <?php if(!isset($post_id)) { ?>
	    <div class="bottom-separator left full">
	    	<div class="<?php echo $first_column_class; ?> columns">
	    		<h4><?php echo __( 'Choose format' , 'cosmotheme' );?></h4>
	    	</div>
	    	<div class="<?php echo $second_column_class; ?> columns">
				<ul class="tabs-nav"> 
					<?php if( (options::logic( 'upload' , 'enb_image' ) )  ){	?>
					<li class="first image tabs-selected"><a href="#pic_upload"><span><?php _e('Image','cosmotheme'); ?></span></a></li>
					<?php } ?> 
					<?php if( options::logic( 'upload' , 'enb_gallery' ) ){	?>
			        <li class="gallery <?php if( isset($post_id) && $post_format =='gallery'){echo 'first tabs-selected'; } ?>"> <a href="#pic_upload"><span><?php _e('Gallery','cosmotheme'); ?></span></a></li>
					<?php } ?> 
					<?php if( options::logic( 'upload' , 'enb_video' ) ){	?>
			        <li class="video <?php if( isset($post_id) && $post_format =='video'){echo 'first tabs-selected'; } ?>"> <a href="#video_upload"><span><?php _e('Video','cosmotheme'); ?></span></a></li>
					<?php } ?> 
					<?php if( options::logic( 'upload' , 'enb_text' ) && !isset($post_id)  ){	?>
					<li class="text <?php if( isset($post_id) && $post_format =='standard'){echo 'first tabs-selected'; } ?>"> <a href="#text_post"><span><?php _e('Text','cosmotheme'); ?></span></a></li>
					<?php } ?> 
					<?php if( options::logic( 'upload' , 'enb_audio' ) && !isset($post_id)  ){	?>
					<li class="audio <?php if( isset($post_id) && $post_format =='audio'){echo 'first tabs-selected'; } ?>"> <a href="#audio_post"><span><?php _e('Audio','cosmotheme'); ?></span></a></li>
					<?php } ?>
					<?php if( options::logic( 'upload' , 'enb_file' ) && !isset($post_id)  ){	?>
					<li class="attach <?php if( isset($post_id) && $post_format =='link'){echo 'first tabs-selected'; } ?>"> <a href="#file_post"><span><?php _e('File','cosmotheme'); ?></span></a></li>
					<?php } ?> 
				</ul>
			</div>
		</div>
    <?php } ?>
	<?php if( ( (options::logic( 'upload' , 'enb_image' ) || options::logic( 'upload' , 'enb_gallery' )) && !isset($post_id) ) || ( isset($post_id) && ($post_format == 'image' || $post_format == 'gallery' ) ) ){	?>
	<div class="tabs-container" id="pic_upload">
			<div class="field">
				<?php if( options::logic( 'upload' , 'enb_gallery' ) ){	CosmoUploader::print_form("Attached images","gallery",true,true, $first_column_class, $second_column_class ); } ?>
				<?php if( (options::logic( 'upload' , 'enb_image' ) ) ){ CosmoUploader::print_form("Attached images","image",true,true, $first_column_class, $second_column_class ); } ?>
			</div>
			<form method="post" action="/post-item?phase=post" id="form_post_image">
			  <input type="hidden" value="" name="feat_image_id" id="feat_img_upload"  class="generic-record generic-single-record " />
			
			
			<div class="field <?php echo $display_post_type_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Post type','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php echo $post_type; ?>
				</div>
			</div>

			<div class="field">
					<div class="<?php echo $first_column_class; ?> columns">
						<label>
							<h4><?php _e('Title','cosmotheme')?></h4>
						</label>
					</div>
					<div class="<?php echo $second_column_class; ?> columns">
						<input type="text" class="text tipped front_post_input" name="title" id="img_post_title"  value="<?php if(isset($action_edit_image)){echo $post_edit -> post_title; } ?>">
						<p class="info"  id="img_post_title_info">
							<span class="warning" style="display:none; " id="img_post_title_warning"></span>
							<?php _e('Be descriptive or interesting!','cosmotheme'); ?>
						</p>
					</div>
			</div>
			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Text content','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php
						if(isset($action_edit_image)){
							wp_editor($post_edit -> post_content,'image_content');
						}else{
							wp_editor('','image_content');
						}
					?>
				</div>
			</div>
			<div class="field post_categ <?php echo $category_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Category','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php 
					if(isset($action_edit_image) && is_array($post_categories) && sizeof($post_categories) ){
						//$cat = get_category( $post_categories[0] );
                        $args = array(  'orderby'            => 'ID', 
								    'order'              => 'ASC',
								    'hide_empty'         => 0, 
								    'exclude' 			 => $unselected_subcategories,
                                    'selected'           => $post_categories[0],
								    'id'                 => 'img_post_cat',
							    );
                    }else{
                        $args = array(  'orderby'            => 'ID', 
								    'order'              => 'ASC',
								    'hide_empty'         => 0, 
								    'exclude' 			 => $unselected_subcategories,
								    'id'                 => 'img_post_cat',
							    );    
                    }
					
					wp_dropdown_categories( $args );		    
					?>
				</div>
			</div>

			<?php if(strlen($portfolio_categ_options)){ ?>

			<div class="field portfolio_categ <?php echo $portfolio_info_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Portfolio categories','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php 
						echo $portfolio_categ_options;    
					?>
				</div>
			</div>

			<?php   } ?>
			
				

			<div class="field"> 
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Tags','cosmotheme'); ?> <span>(<?php _e('recommended','cosmotheme'); ?>)</span></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input id="photo_tag_input" type="text" class="text tag_input tipped front_post_input" name="tags" value="<?php if(isset($action_edit_image)){ echo post::list_tags($post_id); } ?>" placeholder="tag 1, tag 2, tag 3, tag 4, tag 5" autocomplete="off">
					<p class="info"  id="photo_tag_input_info"><?php _e('Use comma to separate each tag. E.g. design, wtf, awesome.','cosmotheme'); ?></p>
				</div>
			</div>
			
			
			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Source','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="source" id="img_post_source"  value="<?php if(isset($action_edit_image)){ echo $the_source; } ?>">
					<p class="info" id="image_source_input_info"><?php _e('Example: http://cosmothemes.com','cosmotheme'); ?></p>
				</div>
			</div>
			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Client','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="client" id="img_post_client"  value="<?php if(isset($action_edit_image)){ echo $the_client; } ?>">
					<p class="info" id="image_client_input_info"><?php _e('Example: John Doe','cosmotheme'); ?></p>
				</div>
			</div>

			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Services','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="services" id="img_post_client"  value="<?php if(isset($action_edit_image)){ echo $the_services; } ?>">
					<p class="info" id="image_services_input_info"><?php _e('Example: Graphic design, Print','cosmotheme'); ?></p>
				</div>
			</div>

			<?php if( (isset($post_id) && $post_format =='gallery') || !options::logic( 'upload' , 'enb_image' )  ){ ?>
				<input type="hidden" value="gallery" class="image_gallery" name="post_format">
			<?php }else{ ?>
				<input type="hidden" value="image" class="image_gallery" name="post_format">
			<?php } ?>

			<?php if(isset($post_id)) { ?>
			<input type="hidden" value="<?php echo $post_id; ?>"  name="post_id">
			<?php } ?>
			<div class="field button">
				<div class="<?php echo $first_column_class; ?> columns">&nbsp;</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<p class="submit button gray">
						<input type="button" id="submit_img_btn"  onclick="add_image_post()" value="<?php if(isset($post_id)){ _e('Update post','cosmotheme'); }else{ _e('Submit post','cosmotheme'); } ?>"/>
					</p>
				</div>
			</div>	
		</form>
	</div>
	<?php } ?> 
	<?php if( (options::logic( 'upload' , 'enb_video' ) && !isset($post_id) ) || ( isset($post_id) && $post_format =='video') ){	?>
	<div class="tabs-container tabs-hide" id="video_upload">
		<?php CosmoUploader::print_form("Attached video","video",true,true, $first_column_class, $second_column_class)?>
		<form method="post" action="/post-item?phase=post" id="form_post_video" >

			<div class="field <?php echo $display_post_type_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Post type','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php echo $post_type; ?>
				</div>
			</div>

			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Title','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="title" id="video_post_title"  value="<?php if(isset($action_edit_video)){echo $post_edit -> post_title; } ?>">
					<p class="info"  id="video_post_title_info">
						<span class="warning" style="display:none; " id="video_post_title_warning"></span>
						<?php _e('Be descriptive or interesting!','cosmotheme'); ?>
					</p>
				</div>
			</div>
			<div class="field post_categ <?php echo $category_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Category','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php 
					if(isset($action_edit_video) && is_array($post_categories) && sizeof($post_categories) ){
						
                        $args = array(  'orderby'            => 'ID', 
								    'order'              => 'ASC',
								    'hide_empty'         => 0, 
								    'exclude' 			 => $unselected_subcategories,
                                    'selected'           => $post_categories[0],
								    'id'                 => 'video_post_cat',
							    );
                    }else{
                        $args = array(  'orderby'            => 'ID', 
								    'order'              => 'ASC',
								    'hide_empty'         => 0, 
								    'exclude' 			 => $unselected_subcategories,
								    'id'                 => 'video_post_cat',
							    );    
                    }			
					wp_dropdown_categories( $args );		    
					?>
				</div>
			</div>
			
			<?php if(strlen($portfolio_categ_options)){ ?>

			<div class="field portfolio_categ <?php echo $portfolio_info_class; ?> ">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Portfolio categories','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php 
						echo $portfolio_categ_options;    
					?>
				</div>
			</div>

			<?php   } ?>

			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Text content','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php
						if(isset($action_edit_video)){
							wp_editor($post_edit -> post_content,'video_content');
						}else{
							wp_editor('','video_content');
						}
							
					?>
				</div>
			</div>
			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Tags','cosmotheme'); ?> <span>(<?php _e('recommended','cosmotheme'); ?>)</span></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input id="video_tag_input" type="text" class="text tag_input tipped front_post_input" name="tags" value="<?php if(isset($action_edit_video)){ echo post::list_tags($post_id); } ?>" placeholder="tag 1, tag 2, tag 3, tag 4, tag 5" autocomplete="off">
					<p class="info" id="video_tag_input_info"><?php _e('Use comma to separate each tag. E.g. design, wtf, awesome.','cosmotheme'); ?></p>
				</div>
			</div>
			
			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Source','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="source" id="img_post_source"  value="<?php if(isset($action_edit_video)){ echo $the_source; } ?>">
					<p class="info" id="image_source_input_info"><?php _e('Example: http://cosmothemes.com','cosmotheme'); ?></p>
				</div>
			</div>
			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Client','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="client" id="img_post_client"  value="<?php if(isset($action_edit_video)){ echo $the_client; } ?>">
					<p class="info" id="image_client_input_info"><?php _e('Example: John Doe','cosmotheme'); ?></p>
				</div>
			</div>

			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Services','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="services" id="img_post_client"  value="<?php if(isset($action_edit_video)){ echo $the_services; } ?>">
					<p class="info" id="image_services_input_info"><?php _e('Example: Graphic design, Print','cosmotheme'); ?></p>
				</div>
			</div>

			<input type="hidden" value="video"  name="post_format">
			<?php if(isset($post_id)) { ?>
                <input type="hidden" value="<?php echo $post_id; ?>"  name="post_id">
			<?php } ?>
			<div class="field button">
				<div class="<?php echo $first_column_class; ?> columns">
					&nbsp;
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<p class="submit button gray">
						<input type="button" id="submit_video_btn"  onclick="add_video_post()" value="<?php if(isset($post_id)){ _e('Update post','cosmotheme'); }else{ _e('Submit post','cosmotheme'); } ?>" />
					</p>
				</div>
			</div>
		</form>
	</div>
	<?php } ?> 
	<?php if( (options::logic( 'upload' , 'enb_text' ) && !isset($post_id) ) || ( isset($post_id) && $post_format == 'default') ){	?>
	<div class="tabs-container" id="text_post">
		<form method="post" action="/post-item?phase=post" id="form_post_text" >  	
			<div class="field <?php echo $display_post_type_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Post type','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php echo $post_type; ?>
				</div>
			</div>

			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Title','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="title" id="text_post_title"  value="<?php if(isset($action_edit_text)){echo $post_edit -> post_title; } ?>">
					<p class="info"  id="text_post_title_info">
						<span class="warning" style="display:none; " id="text_post_title_warning"></span>
						<?php _e('Be descriptive or interesting!','cosmotheme'); ?>
					</p>
				</div>
			</div>
			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<h4><?php _e('Text content','cosmotheme')?></h4>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php
						if(isset($action_edit_text)){
							wp_editor($post_edit -> post_content,'text_content');
						}else{
							wp_editor('','text_content');
						}
					?>
				</div>
			</div>
			<div class="field post_categ <?php echo $category_class; ?> ">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Category','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php 
					
					if(isset($action_edit_text) && is_array($post_categories) && sizeof($post_categories) ){
						
                        $args = array(  'orderby'            => 'ID', 
								    'order'              => 'ASC',
								    'hide_empty'         => 0, 
								    'exclude' 			 => $unselected_subcategories,
                                    'selected'           => $post_categories[0],
								    'id'                 => 'text_post_cat',
							    );
                    }else{
                        $args = array(  'orderby'            => 'ID', 
								    'order'              => 'ASC',
								    'hide_empty'         => 0, 
								    'exclude' 			 => $unselected_subcategories,
								    'id'                 => 'text_post_cat',
							    );    
                    }			
					wp_dropdown_categories( $args );		    
					?>
				</div>
			</div>
			
			<?php if(strlen($portfolio_categ_options)){ ?>

			<div class="field portfolio_categ <?php echo $portfolio_info_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Portfolio categories','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php 
						echo $portfolio_categ_options;    
					?>
				</div>
			</div>

			<?php   } ?>

			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Tags','cosmotheme'); ?> <span>(<?php _e('recommended','cosmotheme'); ?>)</span></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input id="text_tag_input" type="text" class="text tag_input tipped front_post_input" name="tags" value="<?php if(isset($action_edit_text)){ echo post::list_tags($post_id); } ?>" placeholder="tag 1, tag 2, tag 3, tag 4, tag 5" autocomplete="off">
					<p class="info"  id="text_tag_input_info"><?php _e('Use comma to separate each tag. E.g. design, wtf, awesome.','cosmotheme'); ?></p>
				</div>
			</div>
			
			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Source','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="source" id="img_post_source"  value="<?php if(isset($action_edit_text)){ echo $the_source; } ?>">
					<p class="info" id="image_source_input_info"><?php _e('Example: http://cosmothemes.com','cosmotheme'); ?></p>
				</div>
			</div>
			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Client','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="client" id="img_post_client"  value="<?php if(isset($action_edit_text)){ echo $the_client; } ?>">
					<p class="info" id="image_client_input_info"><?php _e('Example: John Doe','cosmotheme'); ?></p>
				</div>
			</div>

			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Services','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="services" id="img_post_client"  value="<?php if(isset($action_edit_text)){ echo $the_services; } ?>">
					<p class="info" id="image_services_input_info"><?php _e('Example: Graphic design, Print','cosmotheme'); ?></p>
				</div>
			</div>

			<input type="hidden" value=""  name="post_format">
            <?php if(isset($post_id)) { ?>
                <input type="hidden" value="<?php echo $post_id; ?>"  name="post_id">
			<?php } ?>
			<div class="field button">
				<div class="<?php echo $first_column_class; ?> columns">
					&nbsp;
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<p class="submit button gray">
						<input type="button" id="submit_text_btn"  onclick="add_text_post()" value="<?php if(isset($post_id)){ _e('Update post','cosmotheme'); }else{ _e('Submit post','cosmotheme'); } ?>"/>
					</p>
				</div>
			</div>		
		</form>
	</div>
	<?php } ?> 
	<?php if( (options::logic( 'upload' , 'enb_audio' ) && !isset($post_id) ) || ( isset($post_id) && $post_format == 'audio') ){	?>

	<div class="tabs-container" id="audio_post">
			<?php CosmoUploader::print_form("Attached audio","audio",true,false, $first_column_class, $second_column_class);
				  CosmoUploader::print_feat_img_form("audio", $first_column_class, $second_column_class );?>
	
		  <form method="post" action="/post-item?phase=post" id="form_post_audio" > 
				
			<div class="field <?php echo $display_post_type_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Post type','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php echo $post_type; ?>
				</div>
			</div>
				
			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Title','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="title" id="audio_post_title"  value="<?php if(isset($action_edit_audio)){echo $post_edit -> post_title; } ?>">
					<p class="info"  id="audio_img_post_title_info">
						<span class="warning" style="display:none; " id="audio_img_post_title_warning"></span>
						<?php _e('Be descriptive or interesting!','cosmotheme'); ?>
					</p>
				</div>
			</div>
			
			
			
			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<h4><?php _e('Text content','cosmotheme')?></h4>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php
						if(isset($action_edit_audio)){
							wp_editor($post_edit -> post_content,'audio_content');
						}else{
							wp_editor('','audio_content');
						}
					?>
				</div>
			</div>
			<div class="field post_categ <?php echo $category_class; ?> ">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Category','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php 
					
					if(isset($action_edit_audio) && is_array($post_categories) && sizeof($post_categories) ){
						
                        $args = array(  'orderby'            => 'ID', 
								    'order'              => 'ASC',
								    'hide_empty'         => 0, 
								    'exclude' 			 => $unselected_subcategories,
                                    'selected'           => $post_categories[0],
								    'id'                 => 'audio_post_cat',
							    );
                    }else{
                        $args = array(  'orderby'            => 'ID', 
								    'order'              => 'ASC',
								    'hide_empty'         => 0, 
								    'exclude' 			 => $unselected_subcategories,
								    'id'                 => 'audio_post_cat',
							    );   
                    }				
					wp_dropdown_categories( $args );		    
					?>
				</div>
			</div>
			
			<?php if(strlen($portfolio_categ_options)){ ?>

			<div class="field portfolio_categ <?php echo $portfolio_info_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Portfolio categories','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php 
						echo $portfolio_categ_options;    
					?>
				</div>
			</div>

			<?php   } ?>

			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Tags','cosmotheme'); ?> <span>(<?php _e('recommended','cosmotheme'); ?>)</span></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input id="audio_photo_tag_input" type="text" class="text tag_input tipped front_post_input" name="tags" value="<?php if(isset($action_edit_audio)){ echo post::list_tags($post_id); } ?>" placeholder="tag 1, tag 2, tag 3, tag 4, tag 5" autocomplete="off">
					<p class="info"  id="audio_photo_tag_input_info"><?php _e('Use comma to separate each tag. E.g. design, wtf, awesome.','cosmotheme'); ?></p>
				</div>
			</div>
			
			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Source','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="source" id="img_post_source"  value="<?php if(isset($action_edit_audio)){ echo $the_source; } ?>">
					<p class="info" id="image_source_input_info"><?php _e('Example: http://cosmothemes.com','cosmotheme'); ?></p>
				</div>
			</div>
			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Client','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="client" id="img_post_client"  value="<?php if(isset($action_edit_audio)){ echo $the_client; } ?>">
					<p class="info" id="image_client_input_info"><?php _e('Example: John Doe','cosmotheme'); ?></p>
				</div>
			</div>

			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Services','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="services" id="img_post_client"  value="<?php if(isset($action_edit_audio)){ echo $the_services; } ?>">
					<p class="info" id="image_services_input_info"><?php _e('Example: Graphic design, Print','cosmotheme'); ?></p>
				</div>
			</div>

			<input type="hidden" value="audio"  name="post_format">
            <?php if(isset($post_id)) { ?>
                <input type="hidden" value="<?php echo $post_id; ?>"  name="post_id">
			<?php } ?>
			<div class="field button">
				<div class="<?php echo $first_column_class; ?> columns">
					&nbsp;
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<p class="submit button gray">
						<input type="button" id="submit_audio_btn"  onclick="add_audio_post()" value="<?php if(isset($post_id)){ _e('Update post','cosmotheme'); }else{ _e('Submit post','cosmotheme'); } ?>"/>
					</p>
				</div>
			</div>		
		</form>
	</div>
	<?php } ?> 
	<?php if( (options::logic( 'upload' , 'enb_file' ) && !isset($post_id) ) || ( isset($post_id) && $post_format == 'link') ){	?>
	<div class="tabs-container" id="file_post">
		<?php CosmoUploader::print_form("Attached files","link",false,false, $first_column_class, $second_column_class);
			  CosmoUploader::print_feat_img_form("link", $first_column_class, $second_column_class)?>
		<form method="post" action="/post-item?phase=post" id="form_post_file" >  
			<div class="field <?php echo $display_post_type_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Post type','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php echo $post_type; ?>
				</div>
			</div>

			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Title','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="title" id="file_post_title" value="<?php if(isset($action_edit_link)){echo $post_edit -> post_title; } ?>">
					<p class="info"  id="file_img_post_title_info">
						<span class="warning" style="display:none; " id="file_img_post_title_warning"></span>
						<?php _e('Be descriptive or interesting!','cosmotheme'); ?>
					</p>
				</div>
			</div>
			
			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Text content','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php
						if(isset($action_edit_link)){
							wp_editor($post_edit -> post_content,'file_content');
						}else{
							wp_editor('','file_content');
						}
							
					?>
				</div>
			</div>
			<div class="field post_categ <?php echo $category_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Category','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php 
					
					
								
					if(isset($action_edit_link) && is_array($post_categories) && sizeof($post_categories) ){
						
                        $args = array(  'orderby'            => 'ID', 
								    'order'              => 'ASC',
								    'hide_empty'         => 0, 
								    'exclude' 			 => $unselected_subcategories,
                                    'selected'           => $post_categories[0],
								    'id'                 => 'file_post_cat',
							    );
                    }else{
                        $args = array(  'orderby'            => 'ID', 
								    'order'              => 'ASC',
								    'hide_empty'         => 0, 
								    'exclude' 			 => $unselected_subcategories,
								    'id'                 => 'file_post_cat',
							    );  
                    }				
					wp_dropdown_categories( $args );		    
					?>
				</div>
			</div>
			
			<?php if(strlen($portfolio_categ_options)){ ?>

			<div class="field portfolio_categ <?php echo $portfolio_info_class; ?>">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Portfolio categories','cosmotheme')?></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<?php 
						echo $portfolio_categ_options;    
					?>
				</div>
			</div>

			<?php   } ?>

			<div class="field">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Tags','cosmotheme'); ?> <span>(<?php _e('recommended','cosmotheme'); ?>)</span></h4>
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input id="file_photo_tag_input" type="text" class="text tag_input tipped front_post_input" name="tags" value="<?php if(isset($action_edit_link)){ echo post::list_tags($post_id); } ?>" placeholder="tag 1, tag 2, tag 3, tag 4, tag 5" autocomplete="off">
					<p class="info"  id="file_photo_tag_input_info"><?php _e('Use comma to separate each tag. E.g. design, wtf, awesome.','cosmotheme'); ?></p>
				</div>
			</div>
			
			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Source','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="source" id="img_post_source"  value="<?php if(isset($action_edit_link)){ echo $the_source; } ?>">
					<p class="info" id="image_source_input_info"><?php _e('Example: http://cosmothemes.com','cosmotheme'); ?></p>
				</div>
			</div>
			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Client','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="client" id="img_post_client"  value="<?php if(isset($action_edit_link)){ echo $the_client; } ?>">
					<p class="info" id="image_client_input_info"><?php _e('Example: John Doe','cosmotheme'); ?></p>
				</div>
			</div>

			<div class="field <?php echo $portfolio_info_class; ?> portfoloiinfo">
				<div class="<?php echo $first_column_class; ?> columns">
					<label>
						<h4><?php _e('Services','cosmotheme')?></h4> 
					</label>
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<input type="text" class="text tipped front_post_input" name="services" id="img_post_client"  value="<?php if(isset($action_edit_link)){ echo $the_services; } ?>">
					<p class="info" id="image_services_input_info"><?php _e('Example: Graphic design, Print','cosmotheme'); ?></p>
				</div>
			</div>

			<?php if(isset($post_id)) { ?>
                <input type="hidden" value="<?php echo $post_id; ?>"  name="post_id">
			<?php } ?>
			<input type="hidden" value="link"  name="post_format">
			<div class="field button">
				<div class="<?php echo $first_column_class; ?> columns">
					&nbsp;
				</div>
				<div class="<?php echo $second_column_class; ?> columns">
					<p class="submit button gray">
						<input type="button" id="submit_file_btn"  onclick="add_file_post()" value="<?php if(isset($post_id)){ _e('Update post','cosmotheme'); }else{ _e('Submit post','cosmotheme'); } ?>"/>
					</p>
				</div>
			</div>		
		</form>
	</div>
	<?php } ?> 

	<div class="field">
		<div class="<?php echo $first_column_class;?> columns">
			&nbsp;
		</div>
		<div class="<?php echo $second_column_class;?> columns">
			<div id="success_msg" style="display:none"></div>
		</div>
	</div>

	<div class="field">
		<div class="<?php echo $first_column_class;?> columns">
			&nbsp;
		</div>
		<div class="<?php echo $second_column_class;?> columns">
			<div id="not_logged_msg" style="display:none"><?php _e('You must be logged in to submit an post','cosmotheme'); ?></div>
		</div>
	</div>
	
</div>

<div id="loading_" style="position:fixed; margin-left:-77px; margin-top:-39px; top:50%; left:50%;display:none">
	<div id="fountainG" style="display:block;">
	    <div id="fountainG_1" class="fountainG"></div>
	    <div id="fountainG_2" class="fountainG"></div>
	    <div id="fountainG_3" class="fountainG"></div>
	    <div id="fountainG_4" class="fountainG"></div>
	    <div id="fountainG_5" class="fountainG"></div>
	    <div id="fountainG_6" class="fountainG"></div>
	    <div id="fountainG_7" class="fountainG"></div>
	    <div id="fountainG_8" class="fountainG"></div>
	</div>                
</div>
<?php 
}else{
	echo '<div id="not_logged_msg" style="margin-bottom:30px">';
	_e('You must be <a href="#" onclick="get_login_box(\'\')" class=" link">logged in</a> to submit a post.','cosmotheme');
	echo '</div>';
}
?>
				</div>
	        </div>
  
    </div>  				
</section>
<?php
get_footer(); 
?>