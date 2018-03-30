<div class="grid_full_width agent-container">
	<?php
	 $agent = $post;
    the_post();
	?>
	<div class="agent-view">
		<div class="container">
            <div class="ouragents agprofile">
                <h1><?php _e( 'Agent Profile', PGL ); ?></h1>
                <div class="our-content">
                    <div class="our-border clearfix">
                        <div class="our-img"><?php the_post_thumbnail( 'estate-agent-square-thumbnail' ); ?></div>
                        <div class="our-info">
                            <h4 class="title"><?php echo esc_html( get_post_meta( $agent->ID, 'agent_title', TRUE ) ); ?></h4>
                            <h5><?php the_title(); ?></h5>
                            <p>
                                <?php the_content(); ?>
                            </p>
                            <ul class="extra-info">
                                <?php echo get_agent_extra_info( $agent->ID ); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<div class="container">
	<?php
	echo PGL_Addon_Estate::estate_grid(array(
		'posts_per_page' => 9,
		'paged'          => $paged,
		'post_type'      => 'estate',
		'meta_query'     => array(
			array(
				'key'     => 'agent_id',
				'value'   => $agent->ID
			),
		),
	),FALSE,null,3,12,TRUE);
	?>
	</div>
</div>