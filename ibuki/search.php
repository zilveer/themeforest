<?php get_header(); ?>
<?php 
$options_ibuki = get_option('ibuki');

$search_image = null;
$search_class = null;
$search_container = 'normal-container';
if( !empty($options_ibuki['search-custom-settings']) && $options_ibuki['search-custom-settings'] == 1) {
    if( !empty($options_ibuki['search-custom-image']['url'])) {
        $search_class = 'imagize';
        $search_image = ' style="background-image: url('.$options_ibuki['search-custom-image']['url'].'); background-size: cover; background-repeat: no-repeat; background-position: center center;"';
    } else {
        $search_class = 'titlize';
        $search_image = '';
    }
    if( !empty($options_ibuki['search-full-area']) && $options_ibuki['search-full-area'] == 1) {
        $search_container = 'full-container';
    } else {
        $search_container = 'normal-container';
    }
} else {
    $search_class = 'titlize';
    $search_image = '';
}

$container_class = 'container-fluid';
?>

<div id="content">
<?php 
    $page_title = az_custom_get_page_title();
    $page_caption = az_custom_get_caption();

    if( !empty($page_title) ) { ?>
    <section id="text-header">
        <div class="<?php echo $search_container; ?> responsiveFull <?php echo $search_class; ?>"<?php echo $search_image; ?>>
            <?php if( !empty($options_ibuki['search-custom-settings']) && $options_ibuki['search-custom-settings'] == 1) { echo '<span class="overlay-bg-search"></span>'; } ?>
            <div class="box-overlay <?php echo $search_class; ?>">
                <div class="content-title centerize">
                    <h2 class="title"><?php echo $page_title; ?></h2>
                    <span class="line"></span>
                    <h3 class="caption"><?php echo $page_caption; ?></h3>
                </div>
            </div>
            <?php if( !empty($options_ibuki['search-full-area']) && $options_ibuki['search-full-area'] == 1 && $options_ibuki['search-full-area-arrow'] == 1 ) { ?>
            <a href="#" class="scroll-btn-full-area metabox-header"><i class="scroll-btn-down-icon animated-opacity"></i></a>
            <?php } ?>
        </div>
    </section>
<?php } ?>

<section class="wrap_content">
<section id="blog" class="main-content listed-blog">
<div class="<?php echo $container_class; ?>">
<div class="row">

<?php    
// Counter
$x= 0; 
?>
                
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php 
$classX = ($x%2) ? ' reverse-layout' : '';
$x++;
$img_thumb_listed = wp_get_attachment_image_src( get_post_thumbnail_id(), 'listed-blog-thumb' );
?>

<article <?php post_class('item-blog single-post-listed'.$classX.''); ?> id="post-<?php the_ID(); ?>">  
<div class="post-container">
    <div class="blog-post-thumb-listed">
        <a class="blog-photo" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
            <div class="blog-post-image" style="background-image: url('<?php echo $img_thumb_listed[0]; ?>');">
                <span class="overlay-bg-blog"><i class="read-icon"></i></span>
            </div>
            <div class="blog-post-description">
                <div class="blog-naming">
                    <h2 class="post-title"><?php the_title(); ?></h2>
                    <span class="line"></span>
                    <h3 class="published"><?php the_time( get_option('date_format') ); ?> / <?php comments_number( 'no comments', 'one comment', '% comments' ); ?></h3>
                </div>
            </div>
        </a>
    </div>
</div>
</article>
            
<?php endwhile; ?>

<?php else: ?>
<!-- No results -->
<div class="col-md-12">
    <div class="no-results"> 
        <h2 class="post-title"><?php _e('Your search did not match any entries!', AZ_THEME_NAME) ?></h2>
        <p><?php _e('Sorry, but you are looking for something that isn\'t here.', AZ_THEME_NAME) ?></p>
    </div>
</div>
<!-- End No Results -->
<?php endif; ?>

</div> 
</div>
</section>
</section>

<?php az_pagination(); ?>
    
</div>
    
<?php get_footer(); ?>