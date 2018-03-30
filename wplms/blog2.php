<?php
/**
 * Template Name: Blog 2
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header(vibe_get_header());
$page_id = get_the_ID();
$title=get_post_meta(get_the_ID(),'vibe_title',true);

$title=get_post_meta(get_the_ID(),'vibe_title',true);
if(vibe_validate($title) || empty($title)){
?>
<section id="title">
    <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="pagetitle">
                    <?php
                        $breadcrumbs=get_post_meta(get_the_ID(),'vibe_breadcrumbs',true);
                        if(vibe_validate($breadcrumbs) || empty($breadcrumbs))
                            vibe_breadcrumbs(); 
                    ?>
                    <h1><?php the_title(); ?></h1>
                    <?php the_sub_title(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}
?>
<section id="content">
    <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
        <div class="col-md-9 col-sm-8">
            <div class="content">
                <?php
                    
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                    
                    query_posts(array('post_type'=>'post','paged' => $paged));
                    
                    if ( have_posts() ) : while ( have_posts() ) : the_post();

                    ?>
                    <div class="blogpost_style2 <?php echo get_post_format(); ?>">
                        <?php echo get_the_category_list('',''); ?>
                        <h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <span class="blogpost_style2_date"><?php echo get_the_time('M j,y'); ?></span>
                        <?php if(has_post_thumbnail(get_the_ID())){ ?>
                             <div class="featured">
                                <a href="<?php echo get_permalink() ?>"><?php echo get_the_post_thumbnail(get_the_ID(),'full'); ?></a>
                                <?php
                                $name = get_the_author_meta( 'display_name' );
                                echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" 
                                title="'.$name.'" class="blogpost_author">'.((function_exists('bp_core_fetch_avatar'))?bp_core_fetch_avatar(array(
                                        'item_id' => get_the_author_meta( 'ID' ),
                                        'object'  => 'user'
                                    )):$name).'</a>';
                                ?>
                            </div>
                        <?php } ?>
                           
                            <div class="excerpt">
                                <p><?php echo get_the_excerpt(); ?></p>
                                <a href="<?php echo get_permalink(); ?>" class="link"><?php echo __('Read More','vibe'); ?></a>
                            </div>
                    </div>

                    <?php
                    endwhile;
                    endif;
                    wp_reset_postdata();
                    pagination();
                ?>
            </div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="sidebar">
                <?php
                    $sidebar = apply_filters('wplms_sidebar','mainsidebar',$page_id);
                    if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar($sidebar) ) : ?>
                <?php endif; ?>
            </div>
        </div>
        </div>
    </div>
</section>
<?php
get_footer(vibe_get_footer());