<?php
get_header(vibe_get_header());
global $wp_query;
$curauth = $wp_query->get_queried_object();

?>
<section id="memberstitle">
    <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
             <div class="col-md-9 col-sm-8">
                <div class="pagetitle">
                    <h1><?php _e('All posts by ','vibe'); echo $curauth->display_name;?> </h1>
                    <h5><?php 
                        if(function_exists('bp_course_get_instructor_description') && function_exists('bp_core_get_user_domain'))
                            echo bp_course_get_instructor_description('instructor_id='.$curauth->ID);
                        else
                            echo $curauth->description;
                        ?></h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
            <?php if(function_exists('bp_core_get_user_domain')){?>
                <a class="button create-group-button full" href="<?php echo bp_core_get_user_domain( get_the_author_meta('ID')); ?>"><?php echo sprintf(__('%s profile','vibe'),bp_core_get_user_displayname(get_the_author_meta('ID'))); ?></a>
                    <?php
                        }
                   ?>
            </div>
        </div>
    </div>
</section>
<section id="content">
	<div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
    		<div class="col-md-9 col-sm-8">
    			<div class="content">
    				<?php
                        if ( have_posts() ) : while ( have_posts() ) : the_post();

                        $categories = get_the_category();
                        $cats='<ul>';
                        if($categories){
                            foreach($categories as $category) {
                                $cats .= '<li><a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s","vibe"  ), $category->name ) ) . '">'.$category->cat_name.'</a></li>';
                            }
                        }
                        $cats .='</ul>';
                            
                           echo ' <div class="blogpost">
                                <div class="meta">
                                   <div class="date">
                                    <p class="day"><span>'.sprintf('%02d', get_the_time('j')).'</span></p>
                                    <p class="month">'.get_the_time('M').'\''.get_the_time('y').'</p>
                                   </div>
                                </div>
                                '.(has_post_thumbnail(get_the_ID())?'
                                <div class="featured">
                                    <a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(),'full').'</a>
                                </div>':'').'
                                <div class="excerpt '.(has_post_thumbnail(get_the_ID())?'thumb':'').'">
                                    <h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
                                    <div class="cats">
                                        '.$cats.'
                                        <p>| 
                                        <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author_meta( 'display_name' ).'</a>
                                        </p>
                                    </div>
                                    <p>'.get_the_excerpt().'</p>
                                    <a href="'.get_permalink().'" class="link">'.__('Read More','vibe').'</a>
                                </div>
                            </div>';
                        endwhile;
                        endif;
                        pagination();
                    ?>
    			</div>
    		</div>
    		<div class="col-md-3 col-sm-4">
    			<div class="sidebar">
                    <?php
                    $sidebar = apply_filters('wplms_sidebar','mainsidebar');
                    if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar($sidebar) ) : ?>
                    <?php endif; ?>
    			</div>
    		</div>
        </div>
	</div>
</section>

<?php
get_footer(vibe_get_footer());
?>