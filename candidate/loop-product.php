
<?php 

$id_current_category = get_meta_option('page_meta_box');

	$pp = get_option('posts_per_page');

	if ($pp == '') { $pp = 10;};

		if ( !is_archive() && !is_search() ) :

			$query = array(

				'posts_per_page' => $pp,

				'order'    => 'DESC',

				'paged' => ( get_query_var('paged') ? get_query_var('paged') : true ),

				'post_status'     => 'publish',

				'cat' =>		$id_current_category

			  );

			 query_posts($query);

			 

		 endif;

?>



<?php

 	$mm = 0;

	

	while ( have_posts() ) : the_post(); ?>

	<?php

	$category = get_the_category();

	

     if($mm == 0)

    {?>

   

    	<section class="about">

                                        

							<?php 

                            $num_comments = get_comments_number();

                            ?>                     

                                <article>

                                

                                    <?php 

                                       $type_image = 'gallery-big';
									   $width_text = 'details';
									   $num_words_text = 32;
                                       if(has_post_thumbnail()){ 

                                             ?><div class="photo">
                                             	<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail($type_image); ?></a>
                                             </div><?php

                                        } else{

                                            $width_text = 'details2';
											$num_words_text = 65;

                                    }?>

                                

                                <div class="<?php echo esc_attr($width_text); ?>">

                                    <h4 class="title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>

                                    <p class="date">

                                        <time datetime="2013-01-24">

                                            <?php the_time('M '); the_time('d, '); the_time('Y'); ?>

                                        </time>

                                        <span class="comments_count"><a href="#"><?php echo $num_comments; ?></a></span>

                                    </p>

                                    <p>

                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="view_all"><span><span><?php echo get_option('sense_read_more'); ?></span></span></a>

                                    </p>

                                </div>

                            </article>    

                        </section>

                        <?php }

						else

							{ ?>

                        <section>

                            <ul class="blog_list">

                                <?php
                                $num_comments = get_comments_number();
                                ?>   

                                    <li>

                                    <article>

                                        

                                            <?php 

                                               $type_image = 'editor';
												$width_text = 'details';
                                               if(has_post_thumbnail()){ 
														?><div class="photo">
                                                    		 <a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail($type_image); ?></a>
														 </div><?php
                                                } else{

                                                    $width_text = 'details2';

                                            }?>

                                       

                                        <div class="<?php echo esc_attr($width_text); ?>">

                                            <h4 class="title titleBlog"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>

                                            <p class="date">

                                                <time datetime="2013-01-24">

                                                    <?php the_time('M '); the_time('d, '); the_time('Y'); ?>

                                                </time>

                                                <span class="comments_count"><a href="#"><?php echo $num_comments; ?></a></span>

                                            </p>

                                           
                                        </div>

                                    </article>

                                </li>

                                <?php  ?>

                            </ul>

                        </section>



	<?php 

		}$mm++;

	

endwhile; // End the loop.

?>
