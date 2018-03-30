<?php get_header(); ?>
<?php
                $cats = get_categories();
                
                $category = '';
                $year = '';
                $monthnum = '';
                $filter = '';
                $sortby = '';
                if (isset($_GET['category'])) {
                           $category = $_GET['category'];     
                }
                if (isset($_GET['year'])) {
                                $year = (int)$_GET['year'];
                }
                if (isset($_GET['month'])) {
                                $monthnum = (int)$_GET['month'];
                }
                
                if (isset($_GET['format'])) {
                                $filter = $_GET['format'];
                }

                if (isset($_GET['sortby'])) {
                                $sortby = $_GET['sortby'];
                }
                
                //$months = range(1,12);
                $months = array (
                                '01' => __('January', 'theme'),
                                '02' => __('February', 'theme'),
                                '03' => __('March', 'theme'),
                                '04' => __('April', 'theme'),
                                '05' => __('May', 'theme'),
                                '06' => __('June', 'theme'),
                                '07' => __('July', 'theme'),
                                '08' => __('August', 'theme'),
                                '09' => __('September', 'theme'),
                                '10' => __('October', 'theme'),
                                '11' => __('November', 'theme'),
                                '12' => __('December', 'theme')
                );
                $formats = get_theme_support( 'post-formats' );
            $filterq = '';
            if ($filter != '') {
		$filterq = array(
				array(
				    'taxonomy' => 'post_format',
				    'field' => 'slug',
				    'terms' => $filter,
				)
			);
	}
?>
        <div class="inner">
            <div class="base-box">
                <div class="not-found-wrap">
                    <div class="nfw-in">
                    <span class="ops"><?php _e('Oops!', 'theme'); ?></span>
                    <span class="big404">404</span>
                    <h1><?php _e('page not found', 'theme'); ?></h1>
                    </div>
                    <?php if (mom_option('search_advanced') == 1) { ?>
                    <div class="advanced-search-form base-box">
                        <form action="<?php echo home_url('/'); ?>">
                            <div class="asf-el keyword">
                            <label for=""><?php _e('keyword:', 'theme'); ?></label>
                            <input type="text" placeholder="<?php _e('Enter keywords', 'theme'); ?>" value="<?php echo $s; ?>" name="s" data-nokeyword="<?php _e('Keyword is required.', 'theme'); ?>">
                            </div> <!-- form element -->
                            <div class="asf-el cat">
                            <label for=""><?php _e('Category:', 'theme'); ?></label>
                            <div class="mom-select">
                                   <select name="category">
                                        <?php
                                        echo '<option value="">'.__('All', 'theme').'</option>';
                                        foreach ( $cats as $cat ) {
                                        echo '<option value="'.$cat->term_id.'"'.selected( $category, $cat->term_id ).'>' . $cat->name . '</option>';
                                        }
                                        ?>
                            </select>
                            </div> <!-- mom select -->
                            </div> <!-- form element -->
                            <div class="asf-el date">
                            <label for=""><?php _e('Date:', 'theme'); ?></label>
                            <div class="mom-select year">
                                <select name="year">
                                    <?php
                                      echo '<option value="">'.__('Year', 'theme').'</option>';
                                    echo mom_get_years('year');
                                    ?>
                                </select>
                            </div> <!-- mom select -->
                            <div class="mom-select month">
                                <select name="month">
                                            <?php
                                            echo '<option value="">'.__('...', 'theme').'</option>';
                                            foreach ($months as $val => $name) { ?>
                                                            <option value="<?php echo $val; ?>" <?php selected( $monthnum, $val ); ?>><?php echo $val; ?></option>
                                            <?php } ?>
                                </select>
                            </div> <!-- mom select -->
                            </div> <!-- form element -->
                            <div class="asf-el filter">
                            <label for=""><?php _e('Filter By:', 'theme'); ?></label>
                            <div class="mom-select">
                                <select class="filter" name="format">
                                               <?php
                                                echo '<option value="">'.__('All', 'theme').'</option>';
                                                foreach ($formats[0] as $format) { ?>
                                                                <option value="<?php echo $format; ?>" <?php selected( $filter, $format ); ?>><?php echo $format; ?></option>
                                                <?php } ?>

                            </select>
                            </div> <!-- mom select -->
                            </div> <!-- form element -->
                            <button class="search button" type="submit"><?php _e('Search', 'theme'); ?></button>
                        </form>
                    </div> <!-- advanced-search-form -->
                    <?php } ?>                    
                </div>
            </div>
        </div> <!--main inner-->
<?php get_footer(); ?>