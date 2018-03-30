<?php global $options_data; ?>
<div class="hr dotted" style="margin:0px 0px 20px!important;"></div>
<div id="author-info" class="wrapper">
    <div class="author-image">
    	<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '100', '' ); ?></a>
    </div>   
    <div class="author-bio">
    	<h4><?php echo  __('About the author','richer');?></h4>
        <?php echo the_author_meta('description'); ?>
    </div>
</div>
<div class="hr dotted" style="margin:20px 0px 35px!important;"></div>