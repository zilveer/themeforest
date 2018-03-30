<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$prefix = Haze_Meta_Boxes::get_instance()->prefix; ?>

<div class="col-sm-12">
    <div class="container-row">
        <div class="row">
            <div class="col-sm-12">
                <article class="post-article album-02 single-post clearfix">
                    <div class="content-album-article clearfix">
                        <div class="left">
                            <figure>
                                <figcaption>
                                    <div class="controls">
                                        <nav>

                                        </nav>
                                        <div class="rating">
                                            <?php $rating = rwmb_meta("{$prefix}album_rating"); ?>
                                            <div class="full" style="width: <?= $rating; ?>%;">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="empty">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>

                                        <?php the_post_thumbnail('song_single'); ?>

                                    <?php endif; ?>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="right">
                            <div class="minimal-player">

                                <!-- THE PLAYER HERE -->
                                <?php
                                $ids = rwmb_meta("{$prefix}album_songs", array('type' => 'checkbox_list'));
                                ?>
                                <?php echo clx_simple_song_player($ids); ?>

                            </div>
                        </div>
                    </div>
                    <div class="content-article clearfix">
                        <h1>
                        	<?php if( rwmb_meta( "{$prefix}album_field_1_name", array(), get_the_id() ) != '' ) : ?>
	                            <?php clx_download_button(get_the_ID()); ?>
	                        <?php endif; ?>
                            
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
                <div class="row">
                    <!-- ============== COMMENTS CONTAINER ============= -->
                    <div class="comment-container">
                        <div class="col-sm-12">

                            <?php comments_template('', true); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>