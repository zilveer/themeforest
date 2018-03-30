<div id="full-entry-content" class="<?php echo $title_content_class; ?> columns">
	<h2><?php the_title(); ?></h2>
	<?php
		$source_meta = meta::get_meta( $post_id , 'source' );
		$the_source = '';
		$the_client = '';
		$the_services = '';
		if(is_array($source_meta) && sizeof($source_meta) ){
			if(isset($source_meta['post_source']) && trim($source_meta['post_source']) != ''){
				$the_source = $source_meta['post_source'];	
			}
			
			if(isset($source_meta['post_client']) && trim($source_meta['post_client']) != ''){
				$the_client = $source_meta['post_client'];
			}

			if(isset($source_meta['post_services']) && trim($source_meta['post_services']) != ''){
				$the_services = $source_meta['post_services'];	
			}
		}
													
		$portfolio_categs = post::get_post_categories($post -> ID,$only_first_cat = false,$taxonomy = 'portfolio-category', $margin_elem_start = '<li>', $margin_elem_end = '</li>'); 
		$portfolio_tags = post::get_post_categories($post -> ID,$only_first_cat = false,$taxonomy = 'portfolio-tag', $margin_elem_start = '<li>', $margin_elem_end = '</li>'); 
			
	?>

	<div class="delimiter"></div>

	<?php if(strlen($portfolio_categs) || strlen($the_source) || strlen($the_client) || strlen($the_services)){ ?>
	
	<ul class="full-entry-meta">
		<?php if(strlen( trim($the_client) )){ ?>
		<li>
			<div class="meta_name"><?php _e('Client','cosmotheme'); ?></div>
			<div class="meta_value"><?php echo $the_client; ?></div>
		</li>
		<?php } ?>
		<?php if(strlen( trim($the_services) )){ ?>
		<li>
			<div class="meta_name"><?php _e('Services','cosmotheme'); ?></div>
			<div class="meta_value"><?php echo $the_services; ?></div>
		</li>
		<?php } ?>
		<?php if(strlen( trim($the_source) )){ ?>
		<li>
			<div class="meta_name"><?php _e('URL','cosmotheme'); ?></div>
			<div class="meta_value"><?php echo link_souce(trim($the_source));   ?></div>
		</li>
		<?php } ?>
		
		<?php if(strlen( trim($portfolio_tags) )){ ?>
		<li class="tags">
			<div class="meta_name">
				<?php _e('Tags','cosmotheme'); ?>
			</div>
			<div class="meta_value">
			<ul>
				<?php echo $portfolio_tags; ?>
			</ul>
			</div>
		</li>

		<?php } ?>

		<?php if(strlen(trim($portfolio_categs) )){  ?>
		<li class="category">
			<div class="meta_name">
				<?php _e('Category','cosmotheme'); ?>
			</div>
			<div class="meta_value">
				<ul>
					<?php echo $portfolio_categs; ?>
				</ul>
			</div>
		</li>

		<?php } ?>
		
		
	</ul>
		<?php if( isset($post_layout['type']) && $post_layout['type'] == 'full'   ){ ?>
		<div class="delimiter"></div>
		<?php } ?>
	<?php } ?>
</div>
<div class="row entry-content-portfolio <?php echo $content_class; ?> columns no-overflow">
	<div class="">
		<div class="entry-text">
            <?php 
                //-------------------------
                if( get_post_format( $post -> ID ) == 'video' ){

                    $video_format = meta::get_meta( $post -> ID , 'format' );
                ?>
                    
                <div class="embedded_videos">    
                                
                    <?php    

                    if(isset($video_format['video_ids']) && !empty($video_format['video_ids'])){
                        foreach($video_format["video_ids"] as $videoid)
                        {
                            if( isset( $video_format[ 'video_urls' ][ $videoid ] ) ){
                                $video_url = $video_format[ 'video_urls' ][ $videoid ];
                                if( post::get_youtube_video_id($video_url) != "0" ){
                                    echo post::get_embeded_video( post::get_youtube_video_id( $video_url ), "youtube" );
                                }else if( post::get_vimeo_video_id( $video_url ) != "0" ){
                                    echo post::get_embeded_video( post::get_vimeo_video_id( $video_url ) , "vimeo" );
                                }
                            }
                            else echo post::get_local_video( urlencode(wp_get_attachment_url($videoid)));
                        }
                    }    
                ?>
                </div>
                <?php                                     
                }

                //---------------------------
                
                if(get_post_format($post->ID)=="image" && !(isset($single_slideshow) && strlen($single_slideshow)) )
                {
                    $image_format = meta::get_meta( $post -> ID , 'format' );
                    echo "<div class=\"attached_imgs_gallery\">";
                    if(isset($image_format['images']) && is_array($image_format['images']))
                    {
                        foreach($image_format['images'] as $index=>$img_id)
                        {
                            $thumbnail= wp_get_attachment_image_src( $img_id, 'thumbnail');
                            $full_image=wp_get_attachment_url($img_id);
                            $url=$thumbnail[0];
                            $width=$thumbnail[1];
                            $height=$thumbnail[2];
                            echo "<div class=\"attached_imgs_gallery-element\">";
                            echo "<a title=\"\" rel=\"prettyPhoto[".get_the_ID()."]\" href=\"".$full_image."\">";

                            if($height<150)
                            {
                                $vertical_align_style="style=\"margin-top:".((150-$height)/2)."px;\"";
                            }
                            else
                            {
                                $vertical_align_style="";
                            }

                            echo "<img alt=\"\" src=\"$url\" width=\"$width\" height=\"$height\" $vertical_align_style>";
                            echo "</a>";
                            echo "</div>";
                        }
                        
                    }
                    echo "</div>";
                }

                if( get_post_format( $post -> ID ) == 'audio' ){
                    echo do_shortcode( post::get_audio_file( $post -> ID ) );
                }
                the_content();
                    
                
            ?>
			<?php
				if( get_post_format( $post -> ID ) == 'link' ){
					echo post::get_attached_file( $post -> ID );
				}

			?>  

            <?php
                if( meta::logic( $post , 'settings' , 'sharing' ) ){
            ?>
            <div class="entry-footer share">
                <?php get_template_part('social-sharing'); ?>
                <div class="clear"></div>
            </div>
            <?php
                }
            ?>
        </div>
	</div>
</div>