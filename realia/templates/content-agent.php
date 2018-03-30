<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('agent-detail'); ?>>
	<div class="entry-content">
        <div class="agent-detail-content">
            <h1 class="page-header"><?php the_title(); ?></h1>
            
    		<div class="row">
    			<div class="col-md-4">
    				<div class="agent-header">
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-12">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="agent-thumbnail">
                                        <?php the_post_thumbnail( 'agent-detail-thumbnail' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-xs-6 col-sm-7 col-md-12">
                                <div class="agent-overview">
                                    <dl>

                                        <?php $properties_count = Realia_Query::get_agent_properties()->post_count; ?>
                                        <?php if ( $properties_count > 0 && ! empty( $properties_count ) ) : ?>
                                            <dt class="properties-count"><i class="pp pp-normal-star"></i></dt>
                                            <dd>
                                                <?php echo esc_attr( $properties_count ); ?> <?php echo __( 'properties', 'realia' ); ?>
                                            </dd><!-- /.properties-count -->
                                        <?php endif; ?>

                                        <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
                                        <?php if ( ! empty ( $email ) ) : ?>
                                            <dt class="email"><i class="pp pp-normal-mail"></i></dt>
                                            <dd>
                                                <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a>
                                            </dd>
                                        <?php endif; ?>

                                        <?php $web = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'web', true ); ?>
                                        <?php if ( ! empty ( $email ) ) : ?>
                                            <dt class="web"><i class="pp pp-normal-globe"></i></dt>
                                            <dd>
                                                <a href="<?php echo esc_attr( $web ); ?>" target="_blank"><?php echo esc_attr( $web ); ?></a>
                                            </dd>
                                        <?php endif; ?>

                                        <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
                                        <?php if ( ! empty ( $email ) ) : ?>
                                            <dt class="phone"><i class="pp pp-normal-mobile-phone"></i></dt><dd><?php echo esc_attr( $phone ); ?></dd>
                                        <?php endif; ?>
                                    </dl>
                                </div><!-- /.agent-overview -->
                            </div><!-- /.col-** -->
                        </div><!-- /.row -->
    				</div><!-- /.agent-header -->
    			</div>

    			<div class="col-md-8">
    				<?php the_content(); ?>
    			</div>
    		</div>
        </div><!-- /.agent-detail-content -->

        <?php if ( is_single() ) : ?>
            <?php Realia_Query::loop_agent_properties(); ?>

            <?php if ( have_posts() ) : ?>
                <h2 class="page-header"><?php echo __( 'Agent Properties', 'realia' ); ?></h2>

                <div class="agent-properties type-box item-per-row-3">
	                <div class="properties-row">
		                <?php $index = 0; ?>
	                    <?php while ( have_posts() ) : the_post(); ?>
	                        <div class="property-container">
                                <?php $property = get_post( get_the_ID() ); ?>
                                <?php echo Realia_Template_Loader::load( 'properties/box', array( 'property' => $property ) ); ?>
	                        </div><!-- /.property-container -->

					        <?php if ( 0 == ( ( $index + 1 ) % 3 ) && Realia_Query::loop_has_next() ) : ?>
						        </div><div class="properties-row">
					        <?php endif; ?>

					        <?php $index++; ?>
	                    <?php endwhile; ?>
	                </div><!-- /.properties-row -->
                </div><!-- /.agent-properties -->
            <?php endif;?>

            <?php wp_reset_query(); ?>
        <?php endif; ?>

        <?php include Realia_Template_Loader::locate( 'agents/contact-form' ); ?>

	</div><!-- .entry-content -->
</article><!-- #post-## -->
