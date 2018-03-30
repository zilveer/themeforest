<?php
global $smof_data;
define('IS_BLOG', TRUE);

$blog_thumbnails = array(
    'Square Image at Left' => 'blog-list', 'Rounded Image at Left' => 'blog-list','Masonry Grid' => 'blog-grid'
);

$blog_columns = array(
    '1 Column' => 1,
    '2 Columns' => 2,
    '3 Columns' => 3,
);

if ( ! in_array($smof_data['blog_layout'], array(
    'Square Image at Left',
    'Rounded Image at Left',
    'Masonry Grid',
)))
{
    $blog_thumbnail = $blog_thumbnails[$smof_data['blog_layout']];
}
else
{
    $blog_thumbnail = 'blog-grid';
}

if ( ! in_array($smof_data['blog_columns'], array(
    '1 Column',
    '2 Columns',
    '3 Columns',
)))
{
    $blog_columns_class = ' columns_'.$blog_columns[$smof_data['blog_columns']];
}
else
{
    $blog_columns_class = ' columns_3';
}

switch ($smof_data['blog_layout']) {
    case 'Square Image at Left': $layout_classes = ' imgpos_atleft';
        break;
    case 'Rounded Image at Left': $layout_classes = ' imgpos_atleft circle';
        break;
    default: $layout_classes = ' imgpos_attop type_masonry';
        break;
}

get_header();
?>
<section class="l-section">
	<div class="l-section-h g-html i-cf">

		<div class="l-content">
			<div class="w-blog<?php echo $blog_columns_class.$layout_classes; ?>">
				<div class="w-blog-list">
					<?php while (have_posts()) : the_post();
                        $preview = (has_post_thumbnail())?get_the_post_thumbnail(get_the_ID(), $blog_thumbnail):'';

                        if (empty($preview) AND $blog_thumbnail == 'blog-list')
                        {
                            $preview = '<img src="'.get_template_directory_uri().'/img/placeholder/500x500.gif" alt="">';
                        }
                    ?>
                    <div <?php post_class('w-blog-entry') ?>>
                        <div class="w-blog-entry-h">
                            <a class="w-blog-entry-link" href="<?php echo get_permalink(get_the_ID());?>">
                                <?php if ($preview) { ?><span class="w-blog-entry-preview"><?php echo $preview; ?></span><?php } ?>
                                <h2 class="w-blog-entry-title">
                                    <span><?php echo get_the_title();?></span>
                                </h2>
                            </a>
                            <div class="w-blog-entry-body">
                                <div class="w-blog-meta">
                                    <div class="w-blog-meta-date">
                                        <i class="fa fa-clock-o"></i>
                                        <span><?php echo get_the_date();?></span>
                                    </div>
                                    <div class="w-blog-meta-author">
                                        <i class="fa fa-user"></i>
                                        <span><?php echo get_the_author();?></span>
                                    </div>
                                    <div class="w-blog-meta-category">
                                        <i class="fa fa-folder-open"></i>
                                        <span>
                                        <?php
                                        $categories = get_the_category();
                                        $categories_output = '';
                                        $separator = ', ';
                                        if($categories){
                                            foreach($categories as $category) {
                                                $categories_output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
                                            }
                                        }
                                        echo trim($categories_output, $separator);
                                        ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="w-blog-entry-short">
                                    <?php echo apply_filters('the_excerpt', get_the_excerpt());?>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php endwhile; ?>
				</div>
			</div>
            <div class="w-blog-pagination">
                <?php
                the_posts_pagination( array(
                    'prev_text' => '<',
                    'next_text' => '>',
                    'before_page_number' => '<span>',
                    'after_page_number' => '</span>',
                ) );
                ?>
            </div>

		</div>
		
		<div class="l-sidebar">
			<?php if (@$smof_data['blog_sidebar_pos'] != 'No Sidebar') {
				dynamic_sidebar('default_sidebar');
			} ?>
		</div>

	</div>
</section>
<?php
get_footer();