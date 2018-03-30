<?php if(! defined('ABSPATH')){ return; }
/**
 * Template layout for documentation category entries
 * @package  Kallyas
 * @author   Team Hogash
 */

wp_enqueue_style( 'documentation-css', THEME_BASE_URI . '/css/pages/documentation.css', array('kallyas-styles'), ZN_FW_VERSION );

get_header();

    //** Put the header with title and breadcrumb
    get_template_part( 'components/theme-subheader/subheader', 'documentation' );
?>

<section id="content" class="site-content" >
	<div class="container">
		<div id="mainbody">
			<div class="row">
                <div class="zn_doc_breadcrumb fixclear">
                    <?php _e( "YOU ARE HERE:", 'zn_framework' ); ?>
                    <span><a href="<?php echo get_site_url(); ?>"><?php _e( "HOME", 'zn_framework' ); ?></a></span>
                    <?php
                        if ( is_tax( 'documentation_category' ) ) {

                            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                            $parents = array ();
                            $parent  = $term->parent;
                            while ( $parent ) {
                                $parents[]  = $parent;
                                $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
                                $parent     = $new_parent->parent;
                            }

                            if ( ! empty( $parents ) ) {
                                $parents = array_reverse( $parents );
                                foreach ( $parents as $parent ) {
                                    $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
                                    echo '<span><a href="' . get_term_link( $item->slug, 'documentation_category' ) . '">' . $item->name . '</a></span>';
                                }
                            }

                            $queried_object = $wp_query->get_queried_object();
                            echo '<span>' . $queried_object->name . '</span>';
                        }
                        elseif ( is_search() ) {
                            echo '<span>' . __( "Search results for ", 'zn_framework' ) . '"' . get_search_query() . '"</span>';
                        }
                        elseif ( is_single() ) {

                            // Show category name
                            $cats = get_the_term_list( $post->ID, 'documentation_category', ' ', '|zn_preg|', '|zn_preg|' );
                            $cats = explode( '|zn_preg|', $cats );

                            if ( ! empty ( $cats[0] ) ) {

                                echo '<span>' . $cats[0] . '</span>';
                            }

                            // Show post name
                            echo '<span>' . get_the_title() . '</span>';
                        }
                    ?>
                </div>
                <div class="clearfix"></div>
                <div class="itemListView clearfix eBlog kl-blog kl-blog-list-wrapper kl-blog--style-<?php echo zget_option( 'zn_main_style', 'color_options', false, 'light' ); ?>">
                    <div class="itemList kl-blog-list kl-blog--default">
                        <?php
                            if ( have_posts() ) :
                                while ( have_posts() ) {
                                    the_post();
                                    ?>
                                    <div class="itemContainer kl-blog-item-container post-<?php the_ID(); ?>">

                                        <div class="itemHeader kl-blog-item-header">
                                            <h3 class="itemTitle kl-blog-item-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>>
                                                <a href="<?php the_permalink(); ?>" class="kl-blog-item-title-link"><?php the_title();?></a>
                                            </h3>
                                        </div>
                                        <!-- end itemHeader -->

                                        <div class="itemBody kl-blog-item-body">
                                            <div class="itemIntroText kl-blog-item-content">
                                                <?php
                                                    the_excerpt();
                                                ?>
                                            </div>
                                            <!-- end Item Intro Text -->
                                            <div class="clearfix"></div>
                                            <div class="itemReadMore kl-blog-item-more">
                                                <a class="readMore kl-blog-item-more-btn btn btn-fullcolor text-uppercase"
                                                   href="<?php the_permalink(); ?>"><?php echo __( 'Read more...', 'zn_framework' );?></a>
                                            </div>
                                            <!-- end read more -->
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- end Item BODY -->

                                        <div class="clearfix"></div>

                                    </div><!-- end Blog Item -->
                                    <div class="clearfix"></div>
                                <?php
                                }
                            else: ?>
                                <div class="itemContainer noPosts kl-blog-item-container kl-blog-item--noposts">
                                    <p><?php echo __( 'Sorry, no posts matched your criteria.', 'zn_framework' ); ?></p>
                                </div><!-- end Blog Item -->
                                <div class="clearfix"></div>
                            <?php endif; ?>
                    </div>
                    <!-- end .itemList -->

                    <!-- Pagination -->
                    <?php
                        echo '<div class="pagination--'.zget_option( 'zn_main_style', 'color_options', false, 'light' ).'">';
                        zn_pagination();
                        echo '</div>';
                    ?>
                </div>
                <!-- end blog items list (.itemListView) -->
			</div>
		</div>
		<!-- end mainbody -->
	</div>
	<!-- end container -->
</section><!-- end content -->

<?php get_footer(); ?>
