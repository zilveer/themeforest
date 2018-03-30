<!-- #advance starts here-->
<div id="seo" class="bpanel-content">
  	<!-- .bpanel-main-content starts here-->
    <div class="bpanel-main-content">
        <ul class="sub-panel">
			<li><a href="#my-title"><?php _e("Title",'dt_themes');?></a></li>
            <li><a href="#my-meta"><?php _e("Meta",'dt_themes');?></a></li>                    
        </ul>

        <!-- #my-title starts here --> 
        <div id="my-title" class="tab-content">
        	<!-- Title Formats -->
        	<div class="bpanel-box">
            	<div class="box-title"><h3><?php _e('Title Formats','dt_themes');?></h3></div>
                <div class="box-content">
                

                    	 <div class="column one-fifth">
                        	<label><?php _e('Title Delimiter','dt_themes');?></label>
                            <div class="clear"></div>
                            <input id="mytheme-title-delimiter" name="mytheme[seo][title-delimiter]" type="text" class="small" 
                            value="<?php echo trim(stripslashes(dttheme_option('seo','title-delimiter')));?>" />
                        </div>
                        <div class="column four-fifth last">
                        	<div class="hr_invisible"></div>
                            <div class="hr_invisible"></div>
	                        <p class="note"><?php _e('This is the symbol that will appear on the browser and Search engine title. Some common examples would be : | /  - , ::','dt_themes');?></p>
                        </div>
                        
                        <div class="clear"></div>

                    
                    <?php $options = array(
								array(
									"title"=>__('Post Title Format','dt_themes'),
									"name"=> "mytheme[seo]",
									"id"=>"post-title-format",
									"tooltip"=>__('Choose Post Title Format','dt_themes'),
									"options"=>array( 	"blog_title"=>__("Blog Title",'dt_themes'),	"blog_description"=>__("Blog Description",'dt_themes'),
														"post_title"=> __("Post Title",'dt_themes'),	"category_title"=>__("Category Title",'dt_themes'),
														"tag_title"=>__("Tag Title",'dt_themes'),
														"post_author_nicename"=>__('Post\'s Author Nicename','dt_themes'),
														"post_author_firstname"=>__('Post\'s Author First Name','dt_themes'),
														"post_author_lastname"=>__('Post\'s Author Last Name','dt_themes'))	
								),
								array(
									"title"=>__('Page Title Format','dt_themes'),
									"name"=> "mytheme[seo]",
									"id"=>"page-title-format",
									"tooltip"=>__('Choose Page Title Format','dt_themes'),
									"options"=>array( 	"blog_title"=>__("Blog Title",'dt_themes'),	"blog_description"=>__("Blog Description",'dt_themes'),
														"post_title"=> __("Page Title",'dt_themes'),	
														"post_author_nicename"=>__('Page\'s Author Nicename','dt_themes'),
														"post_author_firstname"=>__('Page\'s Author First Name','dt_themes'),
														"post_author_lastname"=>__('Page\'s Author Last Name','dt_themes'))	
								),
								array(
									"title"=>__('Category Title Format','dt_themes'),
									"name"=> "mytheme[seo]",
									"id"=>"category-page-title-format",
									"tooltip"=>__('Choose Category Page Title Format','dt_themes'),
									"options"=>array( 	"blog_title"=>__("Blog Title",'dt_themes'),	"blog_description"=>__("Blog Description",'dt_themes'),
														"category_title"=>__("Category Title",'dt_themes'),"category_desc"=>__("Category Description",'dt_themes'))	
								),	
								array(
									"title"=>__('Archive Title Format','dt_themes'),
									"name"=> "mytheme[seo]",
									"id"=>"archive-page-title-format",
									"tooltip"=>__('Choose Archieve Page Title Format','dt_themes'),
									"options"=>array("blog_title"=>__("Blog Title",'dt_themes'),
													"blog_description"=>__("Blog Description",'dt_themes'),
													"date"=>__("Default Date",'dt_themes'))	
								),
								array(
									"title"=>__('Tag Title Format','dt_themes'),
									"name"=> "mytheme[seo]",
									"id"=>"tag-page-title-format",
									"tooltip"=>__('Choose Tag Page Title Format','dt_themes'),
									"options"=>array("blog_title"=>__("Blog Title",'dt_themes'),
													"blog_description"=>__("Blog Description",'dt_themes'),
													"tag"=>__("The name of the tag",'dt_themes'))	
								),
								array(
									"title"=>__('Search Title Format','dt_themes'),
									"name"=> "mytheme[seo]",
									"id"=>"search-page-title-format",
									"tooltip"=>__('Choose Search Page Title Format','dt_themes'),
									"options"=>array("blog_title"=>__("Blog Title",'dt_themes'),
													"blog_description"=>__("Blog Description",'dt_themes'),
													"search"=>__("What was searched for",'dt_themes'))	
								),
								array(
									"title"=>__('404 Title Format','dt_themes'),
									"name"=> "mytheme[seo]",
									"id"=>"404-page-title-format",
									"tooltip"=>__('Choose 404 Page Title Format','dt_themes'),
									"options"=>array("blog_title"=>__("Blog Title",'dt_themes'),"blog_description"=>__("Blog Description",'dt_themes'))
								));
					$loopcount = 1;			
					foreach($options as $option):
						$loopcount ++;
						$last = $loopcount === 2 ? 'one-half-content': 'one-half-content last';
						if($loopcount == 2) $loopcount = 0;?>
                        <div class="<?php echo $last;?>">
                            <div class="bpanel-option-set">
                            	<label><?php echo $option['title'];?></label>
                                <p class="no-margin note"><?php echo($option['tooltip']);?></p>
                                <div class="clear"></div>
                                <!-- <select name="<?php echo $option["name"]."[".$option['id']."]";?>">
                                	<option value=""><?php _e("Select",'dt_themes');?></option>
                                    <?php foreach($option["options"] as $key => $value): ?>
                                    	<option value="<?php echo $key;?>" <?php selected($key,dttheme_option('seo',$option['id']));?>>
											<?php echo $value;?></option>
                                    <?php endforeach;?>
                                </select> -->
                                <ul class="menu-to-edit drag-list">
                                	<?php $t = is_array(dttheme_option('seo',$option['id'])) ? dttheme_option('seo',$option['id']) : array();
										 if(sizeof($t) > 0):
										 	foreach($t as $key):?>
                                                <li><label><input  type="checkbox" name="<?php echo $option["name"]."[".$option['id']."][]";?>" value="<?php echo $key;?>"
                                                checked="checked"/><?php echo $option["options"][$key];?></label></li>                                            
									<?php		 unset($option["options"][$key]);
											endforeach;
										 endif;?>
									<?php foreach($option["options"] as $key => $value): ?>
                                        <li><label> <input type="checkbox" name="<?php echo $option["name"]."[".$option['id']."][]";?>" value="<?php echo $key;?>" />
                                            <?php echo $value;?></label></li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                            <div class="hr"> </div>
                         </div>
              <?php endforeach;?>         
                </div>
            </div><!-- Title Formats End -->
        </div><!-- #my-title ends here -->
        
        <!-- #my-meta starts here -->
        <div id="my-meta" class="tab-content">
        	<!-- Metadata info -->
        	<div class="bpanel-box">
            	<div class="box-title"><h3><?php _e('Metadata and others','dt_themes');?></h3></div>
                <div class="box-content">
                <?php $others = array(
						array("id"=>"use_canonical_urls","label"=>__("Canonical URLs",'dt_themes'),"tooltip"=>__("This option will automatically generate Canonical URLS for your entire WordPress installation. This will help to prevent duplicate content penalties by Google.",'dt_themes')),
						array("id"=>"use_noindex_in_cats_page","label"=>__("Use noindex for Categories",'dt_themes'),"tooltip"=>__("Check this for excluding category pages from being crawled. Useful for avoiding duplicate content.",'dt_themes')),
						array("id"=>"use_noindex_in_archives_page","label"=>__("Use noindex for Archives",'dt_themes'),"tooltip"=>__("Check this for excluding archive pages from being crawled. Useful for avoiding duplicate content.",'dt_themes')),
						array("id"=>"use_noindex_in_tags_archieve_page","label"=>__("Use noindex for Tag Archives",'dt_themes'),"tooltip"=>__("Check this for excluding tag pages from being crawled. Useful for avoiding duplicate content.",'dt_themes')),
						array("id"=>"use_tags_in_meta_keword","label"=>__("Use Tags for META keywords",'dt_themes'),"tooltip"=>__("Check this if you want your tags for a given post used as the META keywords (in addition to any keywords you specify on the post edit page).",'dt_themes')),						
						
						array("id"=>"auto_generate_desc","label"=>__("Autogenerate Descriptions",'dt_themes'),"tooltip"=>__("Check this and your META descriptions will get autogenerated for post and page.",'dt_themes')),						
						
						array("id"=>"use_cats_in_meta_keword","label"=>__("Use Categories for META keywords",'dt_themes'),"tooltip"=>__("Check this if you want your categories for a given post used as the META keywords (in addition to any keywords and tags you specify on the post edit page).",'dt_themes'))
						
				);
				$loopcount = 1;
				foreach($others as $option):
					$last = ($loopcount%2==0) ? 'one-half-content last': 'one-half-content';
					$loopcount++;?>
                    <div class="<?php echo $last;?>">
               	 		<div class="bpanel-option-set">
                        	<label>
                            	<input id="mytheme[seo][<?php echo $option['id'];?>]" type="checkbox" name="mytheme[seo][<?php echo $option['id'];?>]" 
                                	value="<?php echo $option['id'];?>" <?php checked($option['id'],dttheme_option('seo',$option['id']));?> /> <?php echo $option['label'];?>
                            </label>
                            <p class="note"><?php echo $option["tooltip"]?> </p>
                        </div>
                    </div>
		 <?php  endforeach;?>
                </div>
            </div><!-- Metadata info end-->        
        </div><!-- #my-meta ends here -->
        
        
        
     </div><!-- .bpanel-main-content ends here-->   
</div><!-- #advance ends here -->