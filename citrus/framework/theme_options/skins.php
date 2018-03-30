<!-- #skin -->
<div id="skin" class="bpanel-content">
    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel">
			<?php $sub_menus = array(array("title"=>__("Skins",'dt_themes'), "link"=>"#appearance-skins"));
						
				  foreach($sub_menus as $menu): ?>
                  	<li><a href="<?php echo $menu['link']?>"><?php echo $menu['title'];?></a></li>
			<?php endforeach?>
        </ul>

        <!--Skins Section -->
        <div id="appearance-skins" class="tab-content">
	        <div class="bpanel-box">
                <div class="box-title"><h3><?php _e('Current Skin','dt_themes');?></h3></div>
                <div class="box-content">
	                <?php $theme = dttheme_option('appearance','skin'); ?>
                	 <ul id="j-current-theme-container" class="skins-list" dummy-content="<?php echo $theme.'-dummy';?>">
                     	 <li data-attachment-theme="<?php echo $theme;?>">
                            <img src="<?php echo IAMD_BASE_URL."skins/{$theme}/screenshot.png";?>" alt='' width='250' height='180' />
                            <input type="hidden" name="mytheme[appearance][skin]" value="<?php echo $theme;?>" />
                            <h4><?php echo $theme;?></h4>
                        </li>
                     </ul>
                </div>
                
                <div class="box-title"><h3><?php _e('Available Skins','dt_themes');?></h3></div>
                <div class="box-content">
                	<ul id="j-available-themes" class="skins-list">
					<?php 
						$skins_folders = getFolders(get_template_directory()."/skins");
						foreach($skins_folders as $skin ):
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
        </div><!--Skins Section  End-->

    </div><!-- .bpanel-main-content end -->
</div><!-- #skin  end-->