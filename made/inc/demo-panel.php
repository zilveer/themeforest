<?php // DEMO PURPOSES ONLY 
global $oswc_misc;
//set theme options
$oswc_demo = $oswc_misc['demo'];
//variables
if($oswc_demo) { ?>
	
	<div class="demo-wrapper">
    
    	<div class="hide-demo" title="Click to hide demo settings." onclick="hidedemo()">&nbsp;</div>
        
        <div class="show-demo" title="Click to show demo settings." onclick="showdemo()">&nbsp;</div>
			
		<div class="demo">
		
			<div class="content">
            
            	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Demo Panel') ) : else : ?>
            
                    <div class="header"><?php _e( 'Demo Settings','made' ); ?></div>
                    
                    <div id="forecolorSelector"><div style="background-color:#C32C0D"></div></div>
                    
                    <div class="label" style="width:75px;margin-left:5px;margin-top:10px;">Main Color</div>
                    
                    <br class="clearer" />
                    
                    <div class="divider">&nbsp;</div>  
                    
                    <div class="label" style="margin-left:5px;">Skin</div>                 
                   
                    <div class="floatleft">
                        <a id="lightskin" class="bg" onclick="changeskin('light-skin','dark-skin')">&nbsp;</a>
                        <a id="darkskin" class="bg" onclick="changeskin('dark-skin','light-skin')">&nbsp;</a> 
                    </div> 
                    
                    <br class="clearer" /> 
                    
                    <div class="divider">&nbsp;</div> 
                    
                    <div id="colorSelector"><div style="background-color:#E1E1E1"></div></div>
                    
                    <div class="label" style="width:75px;margin-left:5px;">Background<br /><span class="note">combine with textures below</span></div>
                       
                    <div class="label">Textures</div>
                    
                    <br class="clearer" />    
                    
                    <a id="brick1" class="bg" onclick="changebg('brick1','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-brick1.png')">&nbsp;</a>
                    <a id="brick2" class="bg" onclick="changebg('brick2','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-brick2.png')">&nbsp;</a>
                    <a id="brick3" class="bg" onclick="changebg('brick3','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-brick3.png')">&nbsp;</a> 
                    <a id="brick4" class="bg last" onclick="changebg('brick4','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-brick4.png')">&nbsp;</a>             
                    
                    <a id="wood1" class="bg" onclick="changebg('wood1','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-wood1.png')">&nbsp;</a>
                    <a id="wood2" class="bg" onclick="changebg('wood2','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-wood2.png')">&nbsp;</a>
                    <a id="wood3" class="bg" onclick="changebg('wood3','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-wood3.png')">&nbsp;</a>
                    <a id="wood4" class="bg last" onclick="changebg('wood4','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-wood4.png')">&nbsp;</a>
                    
                    <a id="metal1" class="bg" onclick="changebg('metal1','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-metal1.png')">&nbsp;</a>                
                    <a id="metal2" class="bg" onclick="changebg('metal2','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-metal2.png')">&nbsp;</a>                
                    <a id="metal3" class="bg" onclick="changebg('metal3','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-metal3.png')">&nbsp;</a>
                    <a id="leaf1" class="bg last" onclick="changebg('leaf1','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-leaf1.png')">&nbsp;</a>
                    
                    <a id="pave1" class="bg" onclick="changebg('pave1','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-pave1.png')">&nbsp;</a>
                    <a id="pave2" class="bg" onclick="changebg('pave2','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-pave2.png')">&nbsp;</a>
                    <a id="pave3" class="bg" onclick="changebg('pave3','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-pave3.png')">&nbsp;</a>
                    <a id="pave4" class="bg last" onclick="changebg('pave4','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-pave4.png')">&nbsp;</a>
                    
                    <a id="pave5" class="bg" onclick="changebg('pave5','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-pave5.png')">&nbsp;</a>                
                    <a id="rock1" class="bg" onclick="changebg('rock1','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-rock1.png')">&nbsp;</a>                
                    <a id="rock2" class="bg" onclick="changebg('rock2','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-rock2.png')">&nbsp;</a>                
                    <a id="rock3" class="bg last" onclick="changebg('rock3','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-rock3.png')">&nbsp;</a>  
                    
                    <a id="surface1" class="bg" onclick="changebg('surface1','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-surface1.png')">&nbsp;</a>                              
                    <a id="wallpaper1" class="bg" onclick="changebg('wallpaper1','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-wallpaper1.png')">&nbsp;</a>
                    <a id="wallpaper2" class="bg" onclick="changebg('wallpaper2','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-wallpaper2.png')">&nbsp;</a>                
                    <a id="textile1" class="bg last" onclick="changebg('textile1','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-textile1.png')">&nbsp;</a>
                    
                    <a id="textile2" class="bg" onclick="changebg('textile2','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-textile2.png')">&nbsp;</a>
                    <a id="textile3" class="bg" onclick="changebg('textile3','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-textile3.png')">&nbsp;</a>
                    <a id="textile4" class="bg" onclick="changebg('textile4','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-textile4.png')">&nbsp;</a>   
                    <a id="textile5" class="bg last" onclick="changebg('textile5','repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-texture-textile5.png')">&nbsp;</a>                 
                    
                    <br class="clearer" />
                    
                    <div class="divider">&nbsp;</div>
    
                    <div class="label">Backgrounds*<br /><span class="note">(color agnostic)</span></div>
                    
                    <br class="clearer" />
                    
                     <a id="blur17" class="bg" onclick="changebg('blur17','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-17.jpg')">&nbsp;</a>
                    <a id="blur23" class="bg" onclick="changebg('blur23','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-23.jpg')">&nbsp;</a>
                    <a id="blur25" class="bg" onclick="changebg('blur25','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-25.jpg')">&nbsp;</a>
                    <a id="blur26" class="bg last" onclick="changebg('blur26','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-26.jpg')">&nbsp;</a>
                    
                    <a id="blur13" class="bg" onclick="changebg('blur13','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-13.jpg')">&nbsp;</a>
                    <a id="blur14" class="bg" onclick="changebg('blur14','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-14.jpg')">&nbsp;</a>
                    <a id="blur15" class="bg" onclick="changebg('blur15','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-15.jpg')">&nbsp;</a>
                    <a id="blur16" class="bg last" onclick="changebg('blur16','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-16.jpg')">&nbsp;</a>
                    
                    <a id="blur28" class="bg" onclick="changebg('blur28','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-28.jpg')">&nbsp;</a>                    
                    <a id="blur29" class="bg" onclick="changebg('blur29','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-29.jpg')">&nbsp;</a>
                    <a id="blur30" class="bg" onclick="changebg('blur30','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-30.jpg')">&nbsp;</a>
                    <a id="blur31" class="bg last" onclick="changebg('blur31','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-31.jpg')">&nbsp;</a>
                    
                    <a id="blur3" class="bg" onclick="changebg('blur3','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-3.jpg')">&nbsp;</a>
                    <a id="blur7" class="bg" onclick="changebg('blur7','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-7.jpg')">&nbsp;</a>
                    <a id="blur11" class="bg" onclick="changebg('blur11','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-11.jpg')">&nbsp;</a>
                    <a id="blur12" class="bg last" onclick="changebg('blur12','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-blur-12.jpg')">&nbsp;</a>
                    
                    <a id="grunge1" class="bg" onclick="changebg('grunge1','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-grunge-1.jpg')">&nbsp;</a>
                    <a id="grunge2" class="bg" onclick="changebg('grunge2','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-grunge-2.jpg')">&nbsp;</a>
                    <a id="grunge3" class="bg" onclick="changebg('grunge3','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-grunge-3.jpg')">&nbsp;</a>
                    <a id="grunge4" class="bg last" onclick="changebg('grunge4','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-grunge-4.jpg')">&nbsp;</a>   
                    
                    <a id="wave1" class="bg" onclick="changebg('wave1','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-wave-rays-blue.jpg')">&nbsp;</a>                
                    <a id="wave2" class="bg" onclick="changebg('wave2','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-wave-rays-green-yellow.jpg')">&nbsp;</a>
                    <a id="wave3" class="bg" onclick="changebg('wave3','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-wave-rays-orange-green.jpg')">&nbsp;</a>
                    <a id="wave4" class="bg last" onclick="changebg('wave4','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-wave-rays-pink.jpg')">&nbsp;</a>
                    <a id="wave5" class="bg" onclick="changebg('wave5','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-wave-grunge-blue-grey.jpg')">&nbsp;</a>
                    <a id="wave6" class="bg" onclick="changebg('wave6','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-wave-grunge-green.jpg')">&nbsp;</a>
                    <a id="wave7" class="bg" onclick="changebg('wave7','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-wave-grunge-purple-red.jpg')">&nbsp;</a>
                    <a id="wave8" class="bg last" onclick="changebg('wave8','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-wave-grunge-purple.jpg')">&nbsp;</a>
                    
                    <a id="vintage1" class="bg" onclick="changebg('vintage1','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-vintage-wallpaper-black.jpg')">&nbsp;</a>
                    <a id="vintage2" class="bg" onclick="changebg('vintage2','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-vintage-wallpaper-blue.jpg')">&nbsp;</a>                
                    <a id="vintage4" class="bg" onclick="changebg('vintage4','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-vintage-wallpaper-green.jpg')">&nbsp;</a>
                    <a id="vintage5" class="bg last" onclick="changebg('vintage5','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-vintage-wallpaper-red.jpg')">&nbsp;</a>
                    <a id="vintage6" class="bg" onclick="changebg('vintage6','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-vintage-wallpaper-purple.jpg')">&nbsp;</a>
                    <a id="vintage3" class="bg" onclick="changebg('vintage3','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-vintage-wallpaper-light.jpg')">&nbsp;</a>
                    <a id="vintage7" class="bg" onclick="changebg('vintage7','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-vintage-wallpaper-brown.jpg')">&nbsp;</a>
                    <a id="vintage8" class="bg last" onclick="changebg('vintage8','no-repeat','<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg-vintage-wallpaper-gold.jpg')">&nbsp;</a>
                    
                    <br class="clearer" /><br />
                    
                    <span class="note">*There are 25 additional backgrounds not pictured</span>
                    
                    <br class="clearer" />
                    
                    <div class="divider">&nbsp;</div>	
                    
                    <a href="http://demos.brianmcculloh.com/made/features/" class="tons-more-options">&nbsp;</a>
                    
                <?php endif; ?>
				
			</div>
		
		</div>
		
	</div>

<?php } // END DEMO ?>