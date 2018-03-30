<!--featured image-->
<?php if ($redux_demo['metabox_posts_featured_image'] == 1) { ?> 
	<?php if ($nicdark_postlayout == 0) { ?><div class="nicdark_space60"></div><?php } ?>
	<?php if (has_post_thumbnail()): ?>
		<div class="nicdark_featured_image"><?php the_post_thumbnail(); ?></div>
	<?php endif ?>
<?php } ?>
<!--end featured image-->



<!--information bar-->
<?php if ($redux_demo['metabox_posts_information_bar'] == 1) { ?> 
	<!--information bar-->
    <div class="nicdark_textevidence nicdark_bg_<?php echo esc_attr($redux_demo['metabox_posts_color']); ?> ">
        <div class="nicdark_size_big">
            <p class="white"><i class="icon-calendar nicdark_marginright10"></i><?php the_time('j') ?> <?php the_time('M') ?> <span class="nicdark_margin010">·</span> <i class="icon-user-1 nicdark_marginright10"></i><?php the_author(); ?> <span class="nicdark_margin010">·</span> <i class="icon-chat nicdark_marginright10"></i><?php comments_number(__('No Comments','weddingindustry'),__('One Comment','weddingindustry'),__( '% Comments','weddingindustry') );?></p>
        </div>
        
    </div>
    <!--end information bar-->
    <div class="nicdark_space50"></div>
<?php } ?>
<!--end information bar-->




<!--end title-->
<?php if ($redux_demo['metabox_posts_title'] == 1) { ?> 
	<!--start title-->
    <h1 class="subtitle greydark"><?php the_title(); ?></h1>
    <div class="nicdark_space20"></div>
    <div class="nicdark_divider left small"><span class="nicdark_bg_grey2 "></span></div>
    <div class="nicdark_space20"></div>
    <!--end title-->
<?php } ?>
<!--start title-->