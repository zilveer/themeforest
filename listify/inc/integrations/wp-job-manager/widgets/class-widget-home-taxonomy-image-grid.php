<?php
/**
 * Home: Taxonomy Image Grid
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Taxonomy_Image_Grid extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display a grid of images for a certain taxonomy', 'listify' );
        $this->widget_id          = 'listify_widget_taxonomy_image_grid';
        $this->widget_name        = __( 'Listify - Page: Image Grid', 'listify' );

        $this->settings = array(
            'title' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Title:', 'listify' )
            ),
            'description' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Description:', 'listify' )
            ),
            'style' => array(
                'label' => __( 'Style:', 'listify' ),
                'type' => 'select',
                'std'  => '',
                'options' => array(
                    'tiled' => __( 'Tiled', 'listify' ),
                    'square' => __( 'Square', 'listify' )
                )
            ),
            'taxonomy' => array(
                'label' => __( 'Taxonomy:', 'listify' ),
                'type' => 'select',
                'std'  => '',
                'options' => $this->get_taxonomies_simple()
            ),
            'limit' => array(
                'type'  => 'number',
                'std'   => 5,
                'min'   => 1,
                'max'   => 999,
                'step'  => 1,
                'label' => __( 'Number of terms to show:', 'listify' )
            ),
            'terms' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Term IDs: (optional)', 'listify' )
            )
        );

        parent::__construct();
    }

    /**
     * widget function.
     *
     * @see WP_Widget
     * @access public
     * @param array $args
     * @param array $instance
     * @return void
     */
    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) )
            return;

        $this->instance = $instance;

        extract( $args );

        $title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
        $description = isset( $instance[ 'description' ] ) ? esc_attr( $instance[ 'description' ] ) : false;
        $style = isset( $instance[ 'style' ] ) ? esc_attr( $instance[ 'style' ] ) : 'tiled';

        $after_title = '<h2 class="home-widget-description">' . $description . '</h2>' . $after_title;

        $this->taxonomy = isset( $this->instance[ 'taxonomy' ] ) ? $this->instance[ 'taxonomy' ] : '';
        $this->limit = isset( $this->instance[ 'limit' ] ) ? $this->instance[ 'limit' ] : 5;

        if ( ! $this->taxonomy || is_wp_error( get_taxonomy( $this->taxonomy ) ) ) {
            return false;
        }

        if ( isset( $instance[ 'terms' ] ) && ! empty( $instance[ 'terms' ] ) ) {
            $terms = array_map( 'trim', explode( ',', $instance[ 'terms' ] ) );
        } else {
            $terms = $this->get_terms();
        }

        if ( ! $terms || is_wp_error( $terms ) ) {
            return;
        }

        $col_count = 0;
        $total     = count( $terms );
        $cols      = 'col-xs-12 col-sm-6 col-md-';
        $spans     = array();

        if ( 'square' == $style ) {
            for ( $i = 0; $i < $total; $i++ ) {
                $spans[ $i ] = apply_filters( 'listify_image_grid_square_columns', 4 );
            }
        } else {
            for ( $i = 0; $i < $total; $i++ ) {
                $span = 4;

                if ( $i == 0 ) {
                    $span = 8;
                } elseif( $i == $total - 1 ) {
                    $span = 12 - $col_count;
                } elseif ( $i == rand(1, $total) ) {
                    $span = 6;
                }

                $col_count = $col_count + $span;

                if ( $col_count > 12 ) {
                    $span = 12 - $col_count + $span;
                }

                if ( $span < 4 ) {
                    $spans[ $i - 1 ] = $spans[ $i - 1 ] - 1;
                    $span = 3;
                }

                if ( $col_count >= 12 ) {
                    $col_count = 0;
                }

                $spans[$i] = $span;
            }
        }

        ob_start();

        echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title;
        ?>

        <div class="row">

            <?php
                $count = 0;
                foreach ( $terms as $term ) :
                    $term = get_term( $term, $this->taxonomy );

                    if ( ! $term || is_wp_error( $term ) ) {
                        continue;
                    }

					$thumbnail = get_term_meta( $term->term_id, 'thumbnail_id', true );

					if ( ! $thumbnail ) {
						$cover_objects = get_objects_in_term( $term->term_id, $this->taxonomy );

						$image = apply_filters(	
							'listify_cover', 
							$cols . ' entry-cover image-grid-cover', 
							array(
								'object_ids' => $cover_objects,
								'term' => $term,
								'taxonomy' => $this->taxonomy
							)
						);
					} else {
						$image = apply_filters(	
							'listify_cover', 
							$cols . ' entry-cover image-grid-cover', 
							array(
								'images' => array( $thumbnail ),
							)
						);
					}
            ?>

            <div id="image-grid-term-<?php echo $term->slug; ?>" class="<?php echo $cols . $spans[$count]; ?> image-grid-item">
                <div <?php echo $image ?>>
                    <a href="<?php echo esc_url( get_term_link( $term, $this->taxonomy ) ); ?>" class="image-grid-clickbox"></a>
                    <a href="<?php echo esc_url( get_term_link( $term, $this->taxonomy ) ); ?>" class="cover-wrapper"><?php echo $term->name; ?></a>
                </div>
            </div>

            <?php $count++; endforeach;	?>

        </div>

        <?php
        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );

        $this->cache_widget( $args, $content );
    }

    private function get_terms() {
		$args = array(
			'taxonomy' => $this->taxonomy,
			'parent' => 0,
		);

		if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
			$args[ 'lang' ] = apply_filters( 'wpml_current_language', NULL );
		} elseif ( function_exists( 'pll_current_language' ) ) {
			$args[ 'lang' ] = pll_current_language();
		}

		$terms = listify_get_terms( $args );

        if ( count( $terms ) < $this->limit ) {
            return $terms;
        }

        shuffle( $terms );

        $terms = array_slice( $terms, 0, $this->limit );

        return $terms;
    }

    private function get_taxonomies_simple() {
        $taxonomies = get_taxonomies( array( 'public' => true ), array( 'output' => 'objects' ) );
        $_taxonomies = array();

        foreach ( $taxonomies as $taxonomy ) {
            $_taxonomies[ $taxonomy->name ] = $taxonomy->labels->name;
        }

        return $_taxonomies;
    }

}
