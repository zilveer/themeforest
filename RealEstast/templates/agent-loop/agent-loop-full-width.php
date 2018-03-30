<div class="grid_full_width agent-container">
    <div class="agent-view">
        <div class="container">
            <div class="ouragents">
                <h1><?php _e( 'Our Agents', PGL ); ?></h1>
                <ul class="list_agents">
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            ?>
                            <li>
                                <div class="our-content">
                                    <div class="our-border clearfix">
                                        <div class="our-img">
                                            <?php the_post_thumbnail( 'estate-agent-square-thumbnail' ); ?>
                                        </div>
                                        <div class="our-info">
                                            <h4><?php echo esc_html(get_post_meta($post->ID, 'agent_title', TRUE)); ?></h4>
                                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                            <p><?php the_excerpt(); ?></p>
                                            <ul class="extra-info">
                                                <?php echo get_agent_extra_info($post->ID); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php
                        endwhile;
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>
	<?php get_template_part( 'templates/loop/paginations' ) ?>
</div>