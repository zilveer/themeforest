<?php
/**
 * Search Course
 */
get_header(); ?>

<div class="courses-list">
    <div class="container">

        <?php learn_breadcrumbs(); ?>
        <div class="row">
            <aside class="col-lg-3 col-md-4 col-sm-4">
                <div class="box_style_1">
                    <?php dynamic_sidebar( 'sidebar-course' ); ?>
                </div>
            </aside>
            <div class="col-lg-9 col-md-8 col-sm-8">

                <div class="panel panel-info filterable add_bottom_45">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php esc_html_e('Recent Courses','learn'); ?></h3>
                        <div class="pull-right">
                            <button class="btn-filter"><span class="icon-th-list"></span><?php esc_html_e(' Filter','learn'); ?></button>
                        </div>
                    </div>
                    <table class="table table-responsive table-striped">
                        <thead>
                            
                            <tr class="filters">
                                <th><input type="text" class="form-control" placeholder="<?php esc_html_e('ID','learn'); ?>" disabled ></th>
                                <th><input type="text" class="form-control" placeholder="<?php esc_html_e('COURSE NAME','learn'); ?>" disabled></th>
                                <th><input type="text" class="form-control" placeholder="<?php esc_html_e('START DATE','learn'); ?>" disabled ></th>
                                <th><input type="text" class="form-control" placeholder="<?php esc_html_e('TEACHER','learn'); ?>" disabled ></th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if(have_posts()) : ?>

                            <?php 
                                $args = new WP_Query( array(

                                  'paged' => $paged,

                                  'post_type' => 'course', 

                                  'posts_per_page' => 10,

                                  'meta_query' => array(
                                          array(
                                                  'key' => '_cmb_sd_course',
                                                  'value' => date('Y-m-d'),
                                                  'compare' => '<=',
                                          ),
                                  ),
                                  's' => $_GET['s'],
                                ) );

                                while ($args->have_posts()) :$args-> the_post();

                                $s_date = get_post_meta(get_the_ID(),'_cmb_sd_course', true);

                                if($s_date){
                                  $date1 = new DateTime($s_date);
                                }else{
                                  $date1 = new DateTime(get_the_date('Y-m-d', get_the_ID()));        
                                }
                                
                                $date2 = new DateTime(date('Y-m-d'));

                                $diff = date_diff($date1,$date2);
                                
                                $terms = get_the_terms( $post->ID, 'course-category' );

                            ?>
                            <tr>
                                <td><?php echo get_the_ID(); ?></td>
                                <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                                <td><?php if($s_date) echo date("d/m/Y", strtotime($s_date)); ?></td>
                                <?php 
                                    $teachers = get_userdata( absint( get_post()->post_author ) );
                                    if( $teachers ) {
                                ?>
                                <td><?php echo esc_html($teachers->display_name); ?></td>
                                <?php } ?>
                            </tr>
                            <?php endwhile; ?>

                            <?php else: ?>

                                <tr><td><?php esc_html_e('Nothing Found!', 'learn'); ?></td></tr>

                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="panel panel-info filterable add_bottom_45 upcoming">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php esc_html_e('Upcoming Courses','learn'); ?></h3>
                        <div class="pull-right">
                            <button class="btn-filter"><span class="icon-th-list"></span><?php esc_html_e(' Filter','learn'); ?></button>
                        </div>
                    </div>
                    <table class="table table-responsive table-striped">
                        <thead>
                            
                            <tr class="filters">
                                <th><input type="text" class="form-control" placeholder="<?php esc_html_e('ID','learn'); ?>" disabled ></th>
                                <th><input type="text" class="form-control" placeholder="<?php esc_html_e('COURSE NAME','learn'); ?>" disabled></th>
                                <th><input type="text" class="form-control" placeholder="<?php esc_html_e('START DATE','learn'); ?>" disabled ></th>
                                <th><input type="text" class="form-control" placeholder="<?php esc_html_e('TEACHER','learn'); ?>" disabled ></th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if(have_posts()) : ?>

                            <?php 
                                $args = new WP_Query( array(

                                  'paged' => $paged,

                                  'post_type' => 'course', 

                                  'posts_per_page' => 10,

                                  'meta_query' => array(
                                          array(
                                                  'key' => '_cmb_sd_course',
                                                  'value' => date('Y-m-d'),
                                                  'compare' => '>',
                                          ),
                                  ),
                                  's' => $_GET['s'],
                                ) );

                                while ($args->have_posts()) : $args-> the_post();

                                $s_date = get_post_meta(get_the_ID(),'_cmb_sd_course', true);

                                if($s_date){
                                  $date1 = new DateTime($s_date);
                                }else{
                                  $date1 = new DateTime(get_the_date('Y-m-d', get_the_ID()));        
                                }
                                
                                $date2 = new DateTime(date('Y-m-d'));

                                $diff = date_diff($date1,$date2);
                                
                                $terms = get_the_terms( $post->ID, 'course-category' );


                            ?>
                            <tr>
                                <td><?php echo get_the_ID(); ?></td>
                                <td><?php the_title(); ?></td>
                                <td><?php if($s_date) echo date("d/m/Y", strtotime($s_date)); ?></td>
                                <?php 
                                    $teachers = get_userdata( absint( get_post()->post_author ) );
                                    if( $teachers ) {
                                ?>
                                <td><?php echo esc_html($teachers->display_name); ?></td>
                                <?php } ?>
                            </tr>
                            <?php endwhile; ?>

                            <?php else: ?>

                                <tr><td><?php esc_html_e('Nothing Found!', 'learn'); ?></td></tr>

                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    <ul class="pagination">
                        <?php echo learn_pagination(); ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- content close -->
<?php get_footer(); ?>