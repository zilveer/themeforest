<!--link pagination-->
<div class="nicdark_focus">
    <?php $args = array(
		'before'           => '<p>' . __('Pages:', 'weddingindustry'),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'nextpagelink'     => __('Next page', 'weddingindustry'),
		'previouspagelink' => __('Previous page', 'weddingindustry'),
		'pagelink'         => '%',
		'echo'             => 1
	); ?>
    <div class="singlelinkpages">
		<?php wp_link_pages( $args ); ?>
    </div>
</div>
<!--end link pagination-->




<!--tag-->
<?php if ($redux_demo['metabox_posts_tags'] == 1) { ?> 
            
    <!--tag-->
    <div class="nicdark_space10"></div>
    <div class="nicdark_textevidence nicdark_bg_grey nicdark_border_grey nicdark_sizing ">
        <div class="nicdark_margin20">
            <p style="color:#a4a4a4;"><?php the_tags(); ?></p>
       </div>
       <!--<i class="icon-tags-1 nicdark_iconbg right big grey"></i>-->
    </div>
    <div class="nicdark_space10"></div>
    <!--end tag-->  

<?php } ?>
<!--tag-->




<!--category-->         
<?php if ($redux_demo['metabox_posts_categories'] == 1) { ?> 

    <!--category-->
    <div class="nicdark_space10"></div>
    <div class="nicdark_textevidence nicdark_bg_grey nicdark_border_grey nicdark_sizing ">
        <div class="nicdark_margin20">
            <p style="color:#a4a4a4;"><?php _e('Category','weddingindustry'); ?>: <?php the_category(", ");?></p>
       </div>
       <!--<i class="icon-tags-1 nicdark_iconbg right big grey"></i>-->
    </div>
    <div class="nicdark_space10"></div>
    <!--end category-->

<?php } ?>
<!--category--> 





<!--start author-->
<?php if ($redux_demo['metabox_posts_author'] == 1) { ?> 

	<div class="nicdark_space50"></div>
	<div class="nicdark_archive1 nicdark_bg_<?php echo esc_attr($redux_demo['metabox_posts_color']); ?>  ">
        <div class="nicdark_margin20 nicdark_relative">
            
            <div class="nicdark_img_avatar nicdark_displaynone_ipadpotr nicdark_displaynone_iphonepotr">   
            	<?php echo get_avatar( get_the_author_meta( 'ID' ), 240 ); ?>
        	</div>

            <div class="nicdark_activity nicdark_marginleft120 nicdark_disable_marginleft_ipadpotr nicdark_disable_marginleft_iphonepotr">
                <h4 class="white"><?php the_author(); ?></h4>                        
                <div class="nicdark_space20"></div>
                    <div class="nicdark_divider left small"><span class="nicdark_bg_white "></span></div>
                <div class="nicdark_space20"></div>
                <p class="white"><?php the_author_meta('description'); ?></p>
            </div>

        </div>
    </div>
    <div class="nicdark_space50"></div>

<?php } ?>
<!--end author-->






<!--start comments-->
<?php if ($redux_demo['metabox_posts_comments'] == 1) { ?> 
	<?php comments_template(); ?>
<?php } ?>
<!--end comments-->	