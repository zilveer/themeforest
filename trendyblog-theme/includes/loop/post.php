<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	if(is_category()) {
		$blogStyle = df_get_custom_option( get_cat_id( single_cat_title("",false) ), 'blogStyle', false );
	} elseif(is_tax()){
		$blogStyle = df_get_custom_option( get_queried_object()->term_id, 'blogStyle', false );
	} else {
		$blogStyle = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_blogStyle", true ); 	
	}

	$image = get_post_thumb($post->ID,0,0);

	//counter
	$counter = new df_custom_counter;
	$counter = $counter->count(); 

	switch ($blogStyle) {
		case '1':
		case '4':
			$layout = "col_6_of_12";
			$class = "layout_post_1";
			break;
		case '2':
			$layout = "col_12_of_12";
			$class = "layout_post_2 clearfix";
			break;
		case '3':
			$layout = "col_12_of_12";
			$class = "layout_post_1";
			break;
		case '5':
			$layout = "col_12_of_12";
			$class = "layout_post_4";
			break;
		default:
			$layout = "col_6_of_12";
			$class = "layout_post_1";
			break;
	}

	if($image['show']==false) {
		$class .= " no-image";
	}

	//categories
	$categories = get_the_category($post->ID);
    $catCount = count($categories);
    //select a random category id
    $id = rand(0,$catCount-1);
    if(isset($categories[$id]->term_id)) {
		$titleColor = df_title_color($categories[$id]->term_id, "category", false);	
    } else {
    	$titleColor = df_get_option(THEME_NAME."_pageColorScheme");
    }
	

    $audio = get_post_meta( $post->ID, "_".THEME_NAME."_audio", true );

?>
        <div class="col <?php echo esc_attr__($layout);?>">
        	<?php if($blogStyle!="5") { ?>
	            <!-- Layout post 1 -->
	            <div <?php post_class($class); ?> id="post-<?php the_ID(); ?>">
	                <div class="item_thumb">
	                	<?php if(!$audio) { ?>
		                    <?php if(df_option_compare("showTumbIcon","showTumbIcon", $post->ID)==true) { ?>
		                        <div class="thumb_icon">
		                            <a href="<?php the_permalink();?>" style="background-color: <?php echo esc_attr__($titleColor);?>"><?php df_image_icons($post->ID);?></a>
		                        </div>
		                    <?php } ?>
		                    <?php get_template_part(THEME_LOOP."image"); ?>
		                <?php 
		            		} else { 
		            			echo balanceTags($audio);
		                	} 
		                ?>
	                    <div class="thumb_meta">
							<?php 
								if(count(get_the_category($post->ID))>=1 && df_option_compare("postCategory","postCategory", $post->ID)==true) {

							?>
								<span class="category" style="background-color: <?php echo esc_attr__($titleColor);?>">
									<?php echo esc_html__(get_cat_name($categories[$id]->term_id));?>
								</span>
							<?php } ?>
							<?php if(df_option_compare("postComments","postComments", $post->ID)==true && comments_open()) { ?>
								<span class="comments">
									<a href="<?php the_permalink();?>#comment"><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></a>
								</span>
							<?php } ?>
	                    </div>
	                </div>
	                <div class="item_content">
	                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						<?php 
							if($blogStyle!=4) { 
								add_filter('excerpt_length', 'df_new_excerpt_length_30');
								the_excerpt();
								remove_filter('excerpt_length', 'df_new_excerpt_length_30');
							}
						?>
						<?php if($blogStyle==2) { ?>
	                        <div class="item_meta clearfix">
								<?php if(df_option_compare('postDate','postDate',$post->ID)==true) { ?>
									<span class="meta_date">
										<a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>">
											<?php the_time(get_option('date_format'));?>
										</a>
									</span>
								<?php } ?>
								<?php if(df_option_compare('showLikes','showLikes',$post->ID)==true) { ?>
		                        	<span class="meta_likes">
		                        		<a href="<?php the_permalink();?>"><?php echo intval(get_post_meta( $post->ID, "_".THEME_NAME."_total_votes", true ));?></a>
		                        	</span>
		                        <?php } ?>
	                    	</div>
	                    <?php } ?>
	                </div>
	            </div><!-- End Layout post 1 -->
	        <?php } else { ?>
		        <div class="layout_post_4">
	                <div class="item_content">

	                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
	                </div>
	                <div class="item_thumb">
	                    <?php if(df_option_compare("showTumbIcon","showTumbIcon", get_the_ID())==true) { ?>
	                        <div class="thumb_icon">
	                            <a href="<?php the_permalink();?>" style="background-color: <?php echo esc_attr($titleColor);?>">
	                                <?php df_image_icons(get_the_ID());?>
	                            </a>
	                        </div>
	                    <?php } ?>
	                    <?php get_template_part(THEME_LOOP."image"); ?>
	                </div>
	                <?php 
	                    add_filter('excerpt_length', 'df_new_excerpt_length_60');
	                    the_excerpt();
	                    remove_filter('excerpt_length', 'df_new_excerpt_length_60');
	                ?>
	            </div>
	       	<?php } ?>

        </div>
        <?php
        	if($counter%2==0 && (!$blogStyle || $blogStyle==1 || $blogStyle==4)) {
        ?>
        	<div class="clearfix"></div>
        <?php
        	}
        ?>