<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$prefix = Haze_Meta_Boxes::get_instance()->prefix; ?>

<div class="col-sm-4">
    <div class="container-row">
        <div class="row">
            <div class="col-sm-12">
                <div class="widget album-widget">
                    <figure class="clearfix">

                        <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                            <figcaption>
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('song_single'); ?></a>
                            </figcaption>
                        <?php endif; ?>
                        
                        <div class="row">
						
							<?php $colspan = 6; ?>
							
							<?php if( rwmb_meta( "{$prefix}album_field_1_name", array(), get_the_id() ) != '' ) : ?>
		                        <div class="col-sm-5">
		                            <?php clx_download_button(get_the_ID()); ?>
		                        </div>
		                        
		                        <?php $colspan = 3; ?>
	                        <?php endif; ?>
	
	                        <div class="col-sm-<?php echo ( 3 == $colspan ? $colspan + 1 : $colspan ); ?>">
	                            <p>
	                                <?php
	                                $release_date = rwmb_meta("{$prefix}album_release_date");
	                                if($release_date != '') :
	                                    ?>
	                                    <?php _e('Release date', LANGUAGE_ZONE) ?>
	                                    <span>
	                                                            <?php echo $release_date; ?>
	                                                        </span>
	                                <?php endif; ?>
	                            </p>
	                        </div>
	                        <div class="col-sm-<?php echo $colspan; ?>">
	                            <p>
	                                <?php clx_album_genres(2); ?>
	                            </p>
	                        </div>
                        
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <div class="container-row">
        <div class="row">
            <div class="col-sm-12">
                <div class="widget">
                    <div class="minimal-player">
                        <?php
                        $ids = rwmb_meta("{$prefix}album_songs", array('type' => 'checkbox_list'));
                        ?>
                        <?php echo clx_simple_song_player($ids); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-8">
    <div class="container-row">
        <div class="row">
            <div class="col-sm-12">
                <article class="post-article single-post clearfix">
                    <div class="content-article clearfix">
                        <h1>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h1>
                        <div class="entry-meta">

                        </div>
                        <hr>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>

                        <hr/>
                        <div class="entry-tags">
                            <?php clx_tags(); ?>
                        </div>

                    </div>
                </article>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <!-- ============== COMMENTS CONTAINER ============= -->
                <div class="comment-container">
                    <div class="col-sm-12">
                        <!-- ============== COMMENTS CONTAINER ============= -->
                        <?php comments_template('', true); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>