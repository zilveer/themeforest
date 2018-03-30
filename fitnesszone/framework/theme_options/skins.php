<!-- #skin -->
<div id="skin" class="bpanel-content">
    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel">
			<?php $sub_menus = array(array("title"=>__("Skins",'iamd_text_domain'), "link"=>"#appearance-skins"));
						
				  foreach($sub_menus as $menu): ?>
                  	<li><a href="<?php echo $menu['link']?>"><?php echo $menu['title'];?></a></li>
			<?php endforeach?>
        </ul>

        <!--Skins Section -->
        <div id="appearance-skins" class="tab-content">
	        <div class="bpanel-box">
                <div class="box-title"><h3><?php _e('Current Skin','iamd_text_domain');?></h3></div>
                <div class="box-content">
	                <?php $theme = dt_theme_option('appearance','skin'); ?>
                	 <ul id="j-current-theme-container" class="skins-list" dummy-content="<?php echo $theme.'-dummy';?>">
                     	 <li data-attachment-theme="<?php echo $theme;?>">
                            <img src="<?php echo IAMD_BASE_URL."skins/{$theme}/screenshot.png";?>" alt='' width='250' height='180' />
                            <input type="hidden" name="mytheme[appearance][skin]" value="<?php echo $theme;?>" />
                            <h4><?php echo $theme;?></h4>
                        </li>
                     </ul>
                </div>
                
                <div class="box-title"><h3><?php _e('Available Skins','iamd_text_domain');?></h3></div>
                <div class="box-content">
                	<ul id="j-available-themes" class="skins-list">
					<?php foreach(getFolders(get_template_directory()."/skins") as $skin ):
                            $active = ($theme == $skin) ? 'class="active"' : NULL;
                            $img = IAMD_BASE_URL."skins/{$skin}/screenshot.png";
                            echo "<li data-attachment-theme='{$skin}' {$active}>";
                            echo "<img src='{$img}' alt='' width='250' height='180' />";
                            echo "<h4>{$skin}</h4>";
                            echo "</li>";
                         endforeach;?>
                    </ul>
                </div>
            </div>
            
			<div class="bpanel-box">
                <div class="box-title"><h3><?php _e('Dark Skin','iamd_text_domain');?></h3></div>
                <div class="box-content">
                    <div class="bpanel-option-set">
                    	<h6><?php _e('Enable Dark Skin','iamd_text_domain');?></h6>
                        <?php dt_theme_switch("",'appearance','dark-skin');?>
                        <p class="note"> <?php _e('Enable or Disable the dark skin styles.','iamd_text_domain');?>  </p>
                    </div>
				</div>
            </div>
            
        </div><!--Skins Section  End-->

    </div><!-- .bpanel-main-content end -->
</div><!-- #skin  end-->