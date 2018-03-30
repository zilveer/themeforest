<?php  

	get_header();  
	
	// Intro
	get_template_part('article', 'menu'); 
	
	$pageTitle = get_the_title();

	/*   Item attributes   */
	$terms    = get_the_terms( get_the_ID(), 'Portfolio-type' );
	$item = array(

        'href' => 	get_post_meta(get_the_ID(), 'content_url', true),
        'is_quote' => ( get_post_format() == 'quote' ? true : false ),
        'is_gallery' => ( get_post_format() == 'gallery' ? true : false ),
        'is_video' => ( get_post_format() == 'video' ? true : false ),
        'is_audio' => ( get_post_format() == 'audio' ? true : false )
		
	);

?>

<div class="portfolio-content zoom-anim-dialog white-popup" id="pContent">

		<div class="clearfix">
            <!--post 1-->
            <div class="post potfolio-detail-post">

                <?php
                if ( have_posts() ) { while ( have_posts() ) { the_post();  ?>

                    <div class="content_margin">
                        <div <?php post_class(); ?> id="post_<?php the_ID(); ?>">

                            <br /><br />
                            <?php if( $item['is_gallery'] ){
                            ?>
                            <div class="flexslider">
                                <ul class="slides">

                                    <?php

                                    for($i=1; $i <= 10; $i++)
                                        px_portfolio_slide('portfolio_image_'.$i);
                                    ?>

                                </ul>
                            </div>
                            <?php } ?>
                            <br/><br/>

                                <div class="portfolio-detail-title">
                                    <h3><?php echo ( single_post_title( '', false ) ); ?></h3>
                                </div>

                            <br /><br />
                            <?php the_content(); ?>

                            <br /><br />
                            <?php if ( $item['is_audio'] ) { ?>

                                <!-- Audio player -->
                                <div class="ajs-redsky">

                                    <audio src="<?php echo $item['href']; ?>" preload="none" controls></audio>

                                </div>
                                <!-- end: Audio player -->

                            <?php }
                            elseif ($item['is_quote']) { ?>
                            <!-- Text item -->
                            <div id="<?php echo get_the_ID(); ?>" class="mfp-hide zoom-anim-dialog white-popup">
                                <h3><?php the_title(); ?></h3>
                                <?php the_content(); ?>
                            </div>

                           <?php
                            }
                            elseif ( $item['is_video'] ) {

                                $vType = get_post_meta(get_the_ID(), 'video_server', true);
                                $vID = get_post_meta(get_the_ID(), 'video_id', true);

                                ?>

                                <div class="post_video">

                                    <?php if($vType == '' || $vType == '1') { ?>

                                        <iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $vID; ?>" ></iframe>

                                    <?php } else { ?>

                                        <iframe src="http://player.vimeo.com/video/<?php echo $vID; ?>?color=f0e400" width="500" height="281"></iframe>

                                    <?php } ?>

                                </div>

                            <?php }
                            elseif( px_get_url_type( $item['href'] ) == 'image' ){
                                ?>
                                <!-- item image path -->
                                <div class="item-image">
                                    <?php if ( has_post_thumbnail() ){ ?>
                                        <?php the_post_thumbnail('full'); ?>
                                    <?php } else {?>
                                        <img alt="portfolio image" src="<?php echo get_template_directory_uri(); ?>/assets/img/image_place_holder.jpg">
                                    <?php } ?>
                                </div>
                            <?php }?>

                        </div>
                    </div>

                <?php } } ?>

                </div>

		</div>
	</div>

<?php get_footer();