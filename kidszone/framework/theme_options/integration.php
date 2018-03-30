<!-- #integration -->
<div id="integration" class="bpanel-content">
	<!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel">   
            <li><a href="#integration-general"><?php _e("General",'iamd_text_domain');?></a></li>
            <li><a href="#integration-post"><?php _e("Post",'iamd_text_domain');?></a></li>
            <li><a href="#integration-page"><?php _e("Page",'iamd_text_domain');?></a></li>
            <li><a href="#integration-gallery"><?php _e("Gallery",'iamd_text_domain');?></a></li>            
        </ul>
	    
        <!-- #integration-general-->    
        <div id="integration-general">
        	<?php $integration_general = array( 
					array(
						"title"=>		__('Add Code Inside the &lt;head&gt','iamd_text_domain'),
						"tooltip"=>		__('Any code you place here will appear in the head section of every page of your site. This code wrapped between scripts tags.','iamd_text_domain'),
						"textarea"=>	"header-code",
						"checkbox"=>	"enable-header-code",
						"label"=>		__('Enable Header Code','iamd_text_domain')
					),
					array(
						"title"=>		__('Add Code above &lt;/body&gt;','iamd_text_domain'),
						"tooltip"=>		__('You can paste your Google Analytics or other website tracking codes in this box. This code wrapped between scripts tags.','iamd_text_domain'), 
						"textarea"=>	"body-code",
						"checkbox"=>	"enable-body-code",
						"label"=>		__('Enable Body Code','iamd_text_domain')
					),
					array(
						"title"=> 	__('Custom CSS','iamd_text_domain'),
						"tooltip"=>		__('Paste your custom CSS code here.','iamd_text_domain'), 
						"textarea"=>	"custom-css",
						"checkbox"=>	"enable-custom-css",
						"label"=>		__('Enable Custom CSS','iamd_text_domain')
						
					)
			);
			
			foreach($integration_general as $i_general): ?>
                <!-- .bpanel-box-->
                <div class="bpanel-box">
                	<div class="box-title"><h3><?php echo $i_general['title'];?></h3></div>
                    <!-- .box-content -->
                	<div class="box-content">
                    	 <h6><?php echo $i_general['label'];?></h6>
                         <div class="column one-fifth">
							 <?php $switchclass = (dt_theme_option('integration',$i_general['checkbox'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
                             <div data-for="<?php echo $i_general['checkbox'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>                         
                             <input id="<?php echo $i_general['checkbox'];?>" class="hidden" type="checkbox" name="mytheme[integration][<?php echo $i_general['checkbox'];?>]" 
                             value="<?php echo $i_general['checkbox'];?>" <?php checked($i_general['checkbox'],dt_theme_option('integration',$i_general['checkbox'])); ?> />                         </div>

                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php echo $i_general['tooltip'];?></p>
                        </div>  
                             
                         <div class="clear"></div>
	                     <div class="hr_invisible"></div>
                         <div class="hr_invisible"></div>
                         <textarea id="mytheme[integration][<?php echo $i_general['textarea']?>]" 
                         	name="mytheme[integration][<?php echo $i_general['textarea']?>]"><?php echo stripslashes(dt_theme_option('integration',$i_general['textarea']));?></textarea>
                    </div><!-- .box-content end-->

                </div><!-- .bpanel-box end-->
	  <?php endforeach;?>
        </div><!-- #integration-general end-->

        <!-- #integration-post-->
        <div id="integration-post">
        <?php $integration_post = array(
					array(
						"title"=>		__('Add code to the top of your posts','iamd_text_domain'),
						"tooltip"=>		__('Place any codes to show on top of all single post. This is useful if you are looking to integrate things such as social bookmarking links, AD etc.,.','iamd_text_domain'),
						"textarea"=>	"single-post-top-code", 
						"checkbox"=>	"enable-single-post-top-code",
						"label"=>		__('Enable single post top code','iamd_text_domain')
					),
					array(
						"title"=>		__('Add code to the bottom of your posts, before the comments','iamd_text_domain'),
						"tooltip"=>		__('Place any codes to show on bottom of all single post. This is useful if you are looking to integrate things such as social bookmarking links, AD etc.,.','iamd_text_domain'),
						"textarea"=>	"single-post-bottom-code",
						"checkbox"=>	"enable-single-post-bottom-code",
						"label"=>		__('Enable single post bottom code','iamd_text_domain')
					));
				foreach($integration_post as $i_post): ?>
                	<!-- .bpanel-box-->
                    <div class="bpanel-box">
                    	<div class="box-title"><h3><?php echo $i_post['title'];?></h3></div>
                        
                        <!-- .box-content -->
                        <div class="box-content">
                        	<h6><?php echo $i_post['label'];?></h6>
                            <div class="column one-fifth">
	                   	    	<?php $switchclass = (dt_theme_option('integration',$i_post['checkbox'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
								<div data-for="<?php echo $i_post['checkbox'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
        	                    <input id="<?php echo $i_post['checkbox'];?>" class="hidden" type="checkbox" name="mytheme[integration][<?php echo $i_post['checkbox'];?>]"
            	                value="<?php echo $i_post['checkbox'];?>" <?php checked($i_post['checkbox'],dt_theme_option('integration',$i_post['checkbox'])); ?>/>
                             </div>

                            <div class="column four-fifth last">
                                <p class="note no-margin"><?php echo $i_post['tooltip'];?></p>
                            </div>  
                            
                            <div class="clear"></div>
                            <div class="hr_invisible"></div>
                            <div class="hr_invisible"></div>
                    	<textarea id="mytheme[integration][<?php echo $i_post['textarea']?>]"  name="mytheme[integration][<?php echo $i_post['textarea']?>]"><?php echo stripslashes(dt_theme_option('integration',$i_post['textarea']));?></textarea>
                    	</div><!-- .box-content end-->
                </div><!-- .bpanel-box end-->
        <?php	endforeach;?>
        

            <!-- Socialshare Module -->
            <!-- .bpanel-box-->
            <div class="bpanel-box">
            
                <div class="box-title">
                    <h3><?php _e("Social Shares",'iamd_text_domain'); ?></h3>
                </div>
                
                <div class="box-content">
                 <p class="note no-margin"><?php _e("Manage social share options and its layout to show in the blog post.",'iamd_text_domain')?></p>
                 
                 <div class="hr_invisible"> </div>
                 
                <?php global $dt_theme_social_bookmarks;
                    $count = 1;
                    foreach($dt_theme_social_bookmarks as $social_bookmark):?>
                        <div class="one-half-content <?php echo ($count%2 == 0)?"last":''; ?>">
                        <div class="bpanel-option-set">                        
                         <label><?php echo $social_bookmark["label"];?></label>
                            <?php $switchclass = (dt_theme_option('integration',"post-".$social_bookmark['id'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
                            <div data-for="<?php echo "post-".$social_bookmark['id'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            
                            <input id="<?php echo "post-".$social_bookmark['id'];?>" type="checkbox" name="mytheme[integration][<?php echo "post-".$social_bookmark['id'];?>]" 
                            value="<?php echo $social_bookmark['id'];?>" <?php checked($social_bookmark['id'],dt_theme_option('integration',"post-".$social_bookmark['id']));?>
                            class="hidden"/>
                            <div class="hr_invisible"></div>
                            <?php if(array_key_exists("username",$social_bookmark)):?>
                                <div class="clear"></div>
                                <?php _e("Username",'iamd_text_domain');?>
                                <div class="clear"></div>
                                <input type="text" class="medium" name="mytheme[integration][<?php echo "post-".$social_bookmark['id']."-username";?>]"
                                     value="<?php echo dt_theme_option('integration',"post-".$social_bookmark['id']."-username");?>" />
                                <br/><br/>
                            <?php endif;?>
                            
                            
                            <?php if( array_key_exists("options",$social_bookmark)):?>
                                <div class="clear"></div>
                                <?php _e("Layout",'iamd_text_domain');?>
                                <select name="mytheme[integration][<?php echo "post-".$social_bookmark['id']."-layout";?>]">
                                <?php 	foreach($social_bookmark['options'] as $key => $value):
                                            $rs = selected($key,dt_theme_option('integration',"post-".$social_bookmark['id']."-layout"),false); ?>
                                            <option value="<?php echo $key?>" <?php echo $rs;?>><?php echo $value?></option>
                                <?php	endforeach;?>
                                </select>                                
                            <?php endif;?>
    
                            <?php if(array_key_exists("color-scheme",$social_bookmark)): ?>
                                <div class="hr_invisible"></div><br/>
                                <?php _e("Color Scheme",'iamd_text_domain');?>
                                <select name="mytheme[integration][<?php echo "post-".$social_bookmark['id']."-color-scheme";?>]">
                                    <?php foreach($social_bookmark['color-scheme'] as $options):
                                            $rs = selected($options,dt_theme_option('integration',"post-".$social_bookmark['id']."-color-scheme"),false);?>
                                            <option value="<?php echo $options?>" <?php echo $rs;?>><?php echo $options?></option>
                                    <?php endforeach;?>
                                </select>
                            <?php endif;?>
    
                            <?php if(array_key_exists('lang',$social_bookmark)):?>
                                <div class="hr_invisible"></div><br/>
                                <?php _e("Language",'iamd_text_domain');?>
                                    <select name="mytheme[integration][<?php echo "post-".$social_bookmark['id']."-lang";?>]">
                                    <?php foreach($social_bookmark['lang'] as $key => $value): 
                                            $rs = selected($key,dt_theme_option('integration',"post-".$social_bookmark['id']."-lang"),false);?>
                                        <option value="<?php echo $key?>" <?php echo $rs;?>><?php echo $value?></option>
                                    <?php endforeach;?>
                                    </select>
                            <?php endif;?>
    
                            <?php if(array_key_exists("text",$social_bookmark)):?>
                                <div class="clear"></div>
                                <?php _e("Default Text",'iamd_text_domain');?>
                                <div class="clear"></div>
                                <input type="text" class="medium" name="mytheme[integration][<?php echo "post-".$social_bookmark['id']."-text";?>]"
                                     value="<?php echo dt_theme_option('integration',"post-".$social_bookmark['id']."-text");?>" />
                                <br/><br/>
                            <?php endif;?>
                            <div class="hr"></div>
                         </div><!-- bpanel-option-set-->
                    </div><!-- .one-half-content-->
                  <?php $count++;
                      endforeach;?>
                </div><!--.box-content end-->
            </div><!-- .bpanel-box end -->    
            <!-- Socialshare Module -->
            
            <!-- Social Bookmark module -->
            <!-- .bpanel-box-->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php _e("Social Bookmark",'iamd_text_domain'); ?></h3>
                </div>
                <div class="box-content">
	                <p class="note no-margin"><?php _e("Manage social media bookmark options and its layout to show in the blog post",'iamd_text_domain')?></p>
                	<?php global $dt_theme_social_bookmarks;
					  $temp = $dt_theme_social_bookmarks;
			   		  unset($temp[2], $temp[3], $temp[6]);
					  $count = 1;
						foreach($temp as $social_bookmark):?>
                        <div class="one-half-content <?php echo ($count%2 == 0)?"last":''; ?>">
                            <div class="bpanel-option-set">
                             <label><?php echo $social_bookmark["label"];?></label>
                                <?php $switchclass = (dt_theme_option('integration',"sb-post-".$social_bookmark['id'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
                                <div data-for="<?php echo "sb-post-".$social_bookmark['id'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
                                <input id="<?php echo "sb-post-".$social_bookmark['id'];?>" type="checkbox" 
                                	name="mytheme[integration][<?php echo "sb-post-".$social_bookmark['id'];?>]" value="<?php echo $social_bookmark['id'];?>" 
									<?php checked($social_bookmark['id'],dt_theme_option('integration',"sb-post-".$social_bookmark['id']));?>
                                class="hidden"/>
                            </div>
                        </div>
                <?php  $count++;
						 endforeach;?>  
                </div>
            </div><!-- Social Bookmark module end-->
            
        
        </div><!-- #integration-post end-->
        


        <div id="integration-page">
        	<?php $integration_page = array( 
					array(
						"title"=>		__('Add code to the top of your pages','iamd_text_domain'),
						"tooltip"=>		__('Place any codes to show on top of all single page. This is useful if you are looking to integrate things such as social bookmarking links, AD etc.,.','iamd_text_domain'),
						"textarea"=>	"single-page-top-code",
						"checkbox"=>	"enable-single-page-top-code",
						"label"=>		__('Enable single page top code','iamd_text_domain')
					),
					array(
						"title"=>		__('Add code to the bottom of your pages, before the comments','iamd_text_domain'),
						"tooltip"=>		__('Place any codes to show on bottom of all single page. This is useful if you are looking to integrate things such as social bookmarking links, AD etc.,.','iamd_text_domain'),
						"textarea"=>	"single-page-bottom-code",
						"checkbox"=>	"enable-single-page-bottom-code",
						"label"=>		__('Enable single page bottom code','iamd_text_domain')
					)
				);
			foreach($integration_page as $i_page): ?>
                <!-- .bpanel-box-->
                <div class="bpanel-box">
                	<div class="box-title"><h3><?php echo $i_page['title'];?></h3></div>
                    
                    <!-- .box-content -->
                	<div class="box-content">
                    	<h6><?php echo $i_page['label'];?></h6>
                        <div class="column one-fifth">
                   	    <?php $switchclass = (dt_theme_option('integration',$i_page['checkbox'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
						<div data-for="<?php echo $i_page['checkbox'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
                        <input id="<?php echo $i_page['checkbox'];?>" class="hidden" type="checkbox" name="mytheme[integration][<?php echo $i_page['checkbox'];?>]" 
                        value="<?php echo $i_page['checkbox'];?>" <?php checked($i_page['checkbox'],dt_theme_option('integration',$i_page['checkbox'])); ?>/>
                        </div>
                        
                        <div class="column four-fifth last"><p class="note no-margin"><?php echo $i_page['tooltip'];?></p></div>  
                        
	                    <div class="clear"></div>
                        <div class="hr_invisible"></div>
                        <div class="hr_invisible"></div>
                    	<textarea id="mytheme[integration][<?php echo $i_page['textarea']?>]" 
                        name="mytheme[integration][<?php echo $i_page['textarea']?>]"><?php echo stripslashes(dt_theme_option('integration',$i_page['textarea']));?></textarea>
                    </div><!-- .box-content end-->
                </div><!-- .bpanel-box end-->
	  <?php endforeach;?>
      
            <!-- Socialshare Module -->
            <!-- .bpanel-box-->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php _e("Social Shares",'iamd_text_domain'); ?></h3>
                </div>
                
                <div class="box-content">
                
                 <p class="note no-margin"><?php _e("Manage social share options and its layout to show in the page.",'iamd_text_domain')?></p>
                 
                 <div class="hr_invisible"> </div>
                 
                <?php global $dt_theme_social_bookmarks;
                    $count = 1;
                    foreach($dt_theme_social_bookmarks as $social_bookmark):?>
                        <div class="one-half-content <?php echo ($count%2 == 0)?"last":''; ?>">
                        <div class="bpanel-option-set">
                         <label><?php echo $social_bookmark["label"];?></label>
                            <?php $switchclass = (dt_theme_option('integration',"page-".$social_bookmark['id'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
                            <div data-for="<?php echo "page-".$social_bookmark['id'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input id="<?php echo "page-".$social_bookmark['id'];?>" type="checkbox" name="mytheme[integration][<?php echo "page-".$social_bookmark['id'];?>]" 
                            value="<?php echo $social_bookmark['id'];?>" <?php checked($social_bookmark['id'],dt_theme_option('integration',"page-".$social_bookmark['id']));?>
                            class="hidden"/>
                            <div class="hr_invisible"></div>
                            
                            <?php if(array_key_exists("username",$social_bookmark)):?>
                                <div class="clear"></div>
                                <?php _e("Username",'iamd_text_domain');?>
                                <div class="clear"></div>
                                <input type="text" class="medium" name="mytheme[integration][<?php echo "page-".$social_bookmark['id']."-username";?>]"
                                     value="<?php echo dt_theme_option('integration',"page-".$social_bookmark['id']."-username");?>" />
                                <br/><br/>
                            <?php endif;?>
                            
                            <?php if( array_key_exists("options",$social_bookmark)):?>
                                <div class="clear"></div>
                                <?php _e("Layout",'iamd_text_domain');?>
                                <select name="mytheme[integration][<?php echo "page-".$social_bookmark['id']."-layout";?>]">
                                <?php 	foreach($social_bookmark['options'] as $key => $value):
                                            $rs = selected($key,dt_theme_option('integration',"page-".$social_bookmark['id']."-layout"),false); ?>
                                            <option value="<?php echo $key?>" <?php echo $rs;?>><?php echo $value?></option>
                                <?php	endforeach;?>
                                </select>                                
                            <?php endif;?>
    
                            <?php if(array_key_exists("color-scheme",$social_bookmark)): ?>
                                <div class="hr_invisible"></div><br/>
                                <?php _e("Color Scheme",'iamd_text_domain');?>
                                <select name="mytheme[integration][<?php echo "page-".$social_bookmark['id']."-color-scheme";?>]">
                                    <?php foreach($social_bookmark['color-scheme'] as $options):
                                            $rs = selected($options,dt_theme_option('integration',"page-".$social_bookmark['id']."-color-scheme"),false);?>
                                            <option value="<?php echo $options?>" <?php echo $rs;?>><?php echo $options?></option>
                                    <?php endforeach;?>
                                </select>
                            <?php endif;?>
    
                            <?php if(array_key_exists('lang',$social_bookmark)):?>
                                <div class="hr_invisible"></div><br/>
                                <?php _e("Language",'iamd_text_domain');?>
                                    <select name="mytheme[integration][<?php echo "page-".$social_bookmark['id']."-lang";?>]">
                                    <?php foreach($social_bookmark['lang'] as $key => $value): 
                                            $rs = selected($key,dt_theme_option('integration',"page-".$social_bookmark['id']."-lang"),false);?>
                                        <option value="<?php echo $key?>" <?php echo $rs;?>><?php echo $value?></option>
                                    <?php endforeach;?>
                                    </select>
                            <?php endif;?>
    
                            <?php if(array_key_exists("text",$social_bookmark)):?>
                                <div class="clear"></div>
                                <?php _e("Default Text",'iamd_text_domain');?>
                                <div class="clear"></div>
                                <input type="text" class="medium" name="mytheme[integration][<?php echo "page-".$social_bookmark['id']."-text";?>]"
                                     value="<?php echo dt_theme_option('integration',"page-".$social_bookmark['id']."-text");?>" />
                                <br/><br/>
                            <?php endif;?>
                            
                            <div class="hr"> </div>
                            
                         </div><!-- bpanel-option-set-->
                    </div><!-- .one-half-content-->
                  <?php $count++;
                      endforeach;?>
                </div><!--.box-content end-->
            </div><!-- .bpanel-box end -->    
            <!-- Socialshare Module -->
    
            <!-- Social Bookmark module -->
            <!-- .bpanel-box-->
            <div class="bpanel-box">
               <div class="box-title"><h3><?php _e("Social Bookmark",'iamd_text_domain'); ?></h3></div>
               <div class="box-content">
               	<p class="note no-margin"><?php _e("Manage social media bookmark options and its layout to show in the page.",'iamd_text_domain')?></p>
               <?php global $dt_theme_social_bookmarks;
			   		  unset($dt_theme_social_bookmarks[2], $dt_theme_social_bookmarks[3], $dt_theme_social_bookmarks[6]);
                      $count = 1;
                      foreach($dt_theme_social_bookmarks as $social_bookmark):?>
                        <div class="one-half-content <?php echo ($count%2 == 0)?"last":''; ?>">
                            <div class="bpanel-option-set">
                                <label><?php echo $social_bookmark["label"];?></label>
                                <?php $switchclass = (dt_theme_option('integration',"sb-page-".$social_bookmark['id'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
                                 <div data-for="<?php echo "sb-page-".$social_bookmark['id'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
                                 <input id="<?php echo "sb-page-".$social_bookmark['id'];?>" type="checkbox"  value="<?php echo $social_bookmark['id'];?>" 
                                    name="mytheme[integration][<?php echo "sb-page-".$social_bookmark['id'];?>]" 
                                    <?php checked($social_bookmark['id'],dt_theme_option('integration',"sb-page-".$social_bookmark['id']));?>
                                    class="hidden"/>
                                </div>
                            </div>
                    <?php  $count++;
                             endforeach;?>  
                </div>
            </div><!-- Social Bookmark module end-->
        </div><!-- #integration-page end-->
        
        <div id="integration-gallery">
            <!-- Social Bookmark module -->
            <!-- .bpanel-box-->
            <div class="bpanel-box">
               <div class="box-title">
                   <h3><?php _e("Social Bookmark",'iamd_text_domain'); ?></h3>
               </div>
               <div class="box-content">
               <p class="note no-margin"><?php _e("Manage social media bookmark options and its layout to show in the gallery.",'iamd_text_domain');?></p>
               <?php global $dt_theme_social_bookmarks;
			   		  unset($dt_theme_social_bookmarks[2], $dt_theme_social_bookmarks[3], $dt_theme_social_bookmarks[6]);
                      $count = 1;
                      foreach($dt_theme_social_bookmarks as $social_bookmark):?>
                        <div class="one-half-content <?php echo ($count%2 == 0)?"last":''; ?>">
                            <div class="bpanel-option-set">
                                <label><?php echo $social_bookmark["label"];?></label>
                                <?php $switchclass = (dt_theme_option('integration',"sb-gallery-".$social_bookmark['id'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
                                 <div data-for="<?php echo "sb-gallery-".$social_bookmark['id'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
                                 <input id="<?php echo "sb-gallery-".$social_bookmark['id'];?>" type="checkbox"  value="<?php echo $social_bookmark['id'];?>" 
                                    name="mytheme[integration][<?php echo "sb-gallery-".$social_bookmark['id'];?>]" 
                                    <?php checked($social_bookmark['id'],dt_theme_option('integration',"sb-gallery-".$social_bookmark['id']));?>
                                    class="hidden"/>
                                </div>
                            </div>
                    <?php  $count++;
                             endforeach;?>  
                </div>
            </div><!-- Social Bookmark module end-->
        </div>        
        
   </div><!-- .bpanel-main-content end-->
</div><!-- #integration end-->