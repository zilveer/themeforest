<div class="<?php echo LBRenderable::$words[ $this -> element_columns ];?> columns resizable" data-id="<?php echo $this -> id;?>">
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[id]" value="<?php echo $this -> id;?>" class="element-id">
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[element_columns]" value="<?php echo $this -> element_columns;?>" class="element-columns">
    <div class="fl">
        <div class="tools">
            <a class="edit-element has-popup" href="javascript:void(0);">
                <div class="popup">
                    <?php echo __( 'Edit content', 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>
        </div>
        <div class="default-row-hint">
            <h4><?php echo __( 'Default', 'cosmotheme' );?></h4>
            <?php echo __( <<<endhtml
This row loads the default WordPress content for each page. You cannot delete it or split it into several columns.<br />
If assigned for such pages as Author archives or Category it will represent the author's posts or posts belonging to a given category. Feel free to edit it and choose content layout.<br />
If assigned for Pages or Posts - it will represent the page content. Editing it will have no effect.
endhtml
            );?>
        </div>
    </div>
    <div class="relative-wrapper">
        <a class="handle has-popup">
            <div class="popup">
                <?php echo __( 'Drag left and right to resize the neighbours', 'cosmotheme' );?>
                <div class="maybe-pointer"></div>
            </div>
        </a>
    </div>

    <div class="element-container">
        <div class="on-overview">
        </div>
        <div class="on-edit">
            <header>
                <span class="title fpb add_fpb">
                    <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                    <a href="javascript:void(0);" class="fpb_label">
                        <?php echo __( 'Default content', 'cosmotheme' );?>
                    </a>
                </span>
                <span class="fr">
                    <span class="fpb discard button">
                        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                        <a href="javascript:void(0);" class="fpb_label">
                            <?php echo __( 'Discard' , 'cosmotheme' );?>
                        </a>
                    </span>
                    <span class="fpb apply button">
                        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                        <a href="javascript:void(0);" class="fpb_label">
                            <?php echo __( 'Save' , 'cosmotheme' );?>
                        </a>
                    </span>
                </span>
            </header>
            <div class="panel the-settings">
                <h3 class="default-settings"><?php echo __( 'The settings below are only applicable for default content on archive pages (categories, tags, search results, etc.)', 'cosmotheme' );?></h3>
                <div class="standard-generic-field generic-field-header options-view-type">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Select view type', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select element-view-type">
                        <label>
                            <?php echo __( 'List view' , 'cosmotheme' );?>
                            <input class="list_view" type="radio" value="list_view" name="<?php echo $this -> get_prefix();?>[view]" <?php checked( $this -> view, 'list_view' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Grid view' , 'cosmotheme' );?>
                            <input class="grid_view" type="radio" value="grid_view" name="<?php echo $this -> get_prefix();?>[view]" <?php checked( $this -> view, 'grid_view' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Thumbnail view' , 'cosmotheme' );?>
                            <input class="thumbnail_view" type="radio" value="grid_view_thumbnails" name="<?php echo $this -> get_prefix();?>[view]" <?php checked( $this -> view, 'grid_view_thumbnails' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Timeline', 'cosmotheme' );?>
                            <input class="timeline_view" type="radio" value="timeline_view" name="<?php echo $this -> get_prefix();?>[view]" <?php checked( $this -> view, 'timeline_view' );?>>
                        </label>
<!--                         <label>
                            <?php echo __( 'News view', 'cosmotheme' );?>
                            <input class="news_view" type="radio" value="news_view" name="<?php echo $this -> get_prefix();?>[view]" <?php checked( $this -> view, 'news_view' );?>>
                        </label>   -->                         
                    </div>
                </div>

                <div class="standard-generic-field generic-field-header masonry-options">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Enable masonry', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select">
                        <label>
                            <?php echo __( 'Yes' , 'cosmotheme' );?>
                            <input type="radio" value="yes" name="<?php echo $this -> get_prefix();?>[enb_masonry]" <?php checked( $this -> enb_masonry, 'yes' );?>>
                        </label>
                        <label>
                            <?php echo __( 'No' , 'cosmotheme' );?>
                            <input type="radio" value="no" name="<?php echo $this -> get_prefix();?>[enb_masonry]" <?php checked( $this -> enb_masonry, 'no' );?>>
                        </label>
                    </div>
                </div>

                <div class="standard-generic-field generic-field-header options-list-view-excerpt">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'List view excerpt', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="hint"><?php echo __( 'You can set the excerpt lenght in <a href="?page=cosmothemes__settings&tab=blog_post">' . __( 'Post settings', 'cosmotheme' ) . '</a> ', 'cosmotheme' );?>.</div>
                    <div class="generic-field generic-field-image-select">
                        <label>
                            <?php echo __( 'Display excerpt' , 'cosmotheme' );?>
                            <input type="radio" value="excerpt" name="<?php echo $this -> get_prefix();?>[list_view_excerpt]" <?php checked( $this -> list_view_excerpt, 'excerpt' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Display full content' , 'cosmotheme' );?>
                            <input type="radio" value="full" name="<?php echo $this -> get_prefix();?>[list_view_excerpt]" <?php checked( $this -> list_view_excerpt, 'full' );?>>
                        </label>
                    </div>
                </div>

                <div class="standard-generic-field generic-field-header option-list-thumb-size">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Thumbnail size', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select">
                        <label>
                            <?php echo __( 'No thumb' , 'cosmotheme' );?>
                            <input type="radio" value="no_thumb" id="<?php echo $this -> id;?>_no_thumb" name="<?php echo $this -> get_prefix();?>[list_view_thumb_size]" <?php checked( $this -> list_view_thumb_size, 'no_thumb' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Small thumb' , 'cosmotheme' );?>
                            <input type="radio" value="small_thumb" id="<?php echo $this -> id;?>_small_thumb" name="<?php echo $this -> get_prefix();?>[list_view_thumb_size]" <?php checked( $this -> list_view_thumb_size, 'small_thumb' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Medium thumb' , 'cosmotheme' );?>
                            <input type="radio" value="large_thumb" id="<?php echo $this -> id;?>_large_thumb" name="<?php echo $this -> get_prefix();?>[list_view_thumb_size]" <?php checked( $this -> list_view_thumb_size, 'large_thumb' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Large thumb' , 'cosmotheme' );?>
                            <input type="radio" value="full_width_thumb" id="<?php echo $this -> id;?>_full_width_thumb" name="<?php echo $this -> get_prefix();?>[list_view_thumb_size]" <?php checked( $this -> list_view_thumb_size, 'full_width_thumb' );?>>
                        </label>
                    </div>
                </div>

                <div class="standard-generic-field generic-field-header hide_excerpt-options">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Hide Excerpt', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select">
                        <label>
                            <?php echo __( 'Yes' , 'cosmotheme' );?>
                            <input type="radio" value="yes" name="<?php echo $this -> get_prefix();?>[enb_hide_excerpt]" <?php checked( $this -> enb_hide_excerpt, 'yes' );?>>
                        </label>
                        <label>
                            <?php echo __( 'No' , 'cosmotheme' );?>
                            <input type="radio" value="no" name="<?php echo $this -> get_prefix();?>[enb_hide_excerpt]" <?php checked( $this -> enb_hide_excerpt, 'no' );?>>
                        </label>
                    </div>
                </div>

                <div class="standard-generic-field generic-field-header options-columns">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Number of columns', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select">
                        <label class="columns-2">
                            <?php echo __( 'One' , 'cosmotheme' );?>
                            <input type="radio" value="1" name="<?php echo $this -> get_prefix();?>[columns]" <?php checked( $this -> columns, 1 );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( 'Two' , 'cosmotheme' );?>
                            <input type="radio" value="2" name="<?php echo $this -> get_prefix();?>[columns]" <?php checked( $this -> columns, 2 );?>>
                        </label>
                        <label class="columns-4">
                            <?php echo __( 'Three' , 'cosmotheme' );?>
                            <input type="radio" value="3" name="<?php echo $this -> get_prefix();?>[columns]" <?php checked( $this -> columns, 3 );?>>
                        </label>
                        <label class="columns-6">
                            <?php echo __( 'Four' , 'cosmotheme' );?>
                            <input type="radio" value="4" name="<?php echo $this -> get_prefix();?>[columns]" <?php checked( $this -> columns, 4 );?>>
                        </label>
                        <label class="columns-9">
                            <?php echo __( 'Six' , 'cosmotheme' );?>
                            <input type="radio" value="6" name="<?php echo $this -> get_prefix();?>[columns]" <?php checked( $this -> columns, 6 );?>>
                        </label>
                    </div>
                </div>

                <!-- the following div is hidded. We need it to have pagination working -->
                <div class="" style="display:none !important">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Element behaviour', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select">
                        <a href="javascript:void(0);" class="has-popup enb_carousel">
                            <label>
                                <?php echo __( 'Carousel slider' , 'cosmotheme' );?>
                                <input type="radio" value="carousel" id="<?php echo $this -> id;?>_enb_carousel_yes" name="<?php echo $this -> get_prefix();?>[behaviour]" >
                            </label>
                            <div class="popup">
                                <?php echo __( "You need 'Thumbnail view' or 'Grid view' to use this option", 'cosmotheme' );?>
                                <div class="maybe-pointer"></div>
                            </div>
                        </a>

                        <a href="javascript:void(0);" class="has-popup enb_pagination">
                            <label>
                                <?php echo __( 'Pagination' , 'cosmotheme' );?>
                                <input type="radio" value="pagination" id="<?php echo $this -> id;?>_enb_pagination_yes" name="<?php echo $this -> get_prefix();?>[behaviour]" checked >
                            </label>
                            <div class="popup">
                                <?php echo __( "Disable 'Gallery view type' to use this option", 'cosmotheme' );?>
                                <div class="maybe-pointer"></div>
                            </div>
                        </a>

                        <a href="javascript:void(0);" class="has-popup enb_load_more">
                            <label>
                                <?php echo __( 'Load more( AJAX )' , 'cosmotheme' );?>
                                <input type="radio" value="load_more" id="<?php echo $this -> id;?>_enb_load_more_yes" name="<?php echo $this -> get_prefix();?>[behaviour]" >
                            </label>
                            <div class="popup">
                                <?php echo __( "Disable 'Gallery view type' to use this option", 'cosmotheme' );?>
                                <div class="maybe-pointer"></div>
                            </div>
                        </a>

                        <a href="javascript:void(0);" class="has-popup enb_tabber">
                            <label>
                                <?php echo __( 'Load more( AJAX )' , 'cosmotheme' );?>
                                <input type="radio" value="tabber" id="<?php echo $this -> id;?>enb_tabber_yes" name="<?php echo $this -> get_prefix();?>[behaviour]" >
                            </label>
                            <div class="popup">
                                <?php echo __( "Disable 'Gallery view type' to use this option", 'cosmotheme' );?>
                                <div class="maybe-pointer"></div>
                            </div>
                        </a>

                        <a class="has-popup enb_filters" href="javascript:void(0);">
                            <label>
                                <?php echo __( 'Filter( by categories, tags etc. )' , 'cosmotheme' );?>
                                <input type="radio" value="filters" id="<?php echo $this -> id;?>_enb_filters" name="<?php echo $this -> get_prefix();?>[behaviour]" >
                            </label>
                            <div class="popup">
                                <?php echo __( "You need 'Thumbnail view' to use this option", 'cosmotheme' );?>
                                <div class="maybe-pointer"></div>
                            </div>
                        </a>
                        <label>
                            <?php echo __( 'None of those' , 'cosmotheme' );?>
                            <input type="radio" value="none" id="<?php echo $this -> id;?>_no_behaviour_yes" name="<?php echo $this -> get_prefix();?>[behaviour]" >
                        </label>
                    </div>
                </div>

                <div class="standard-generic-field generic-field-header option-numberposts">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Number of posts', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field">
                        <input name="<?php echo $this -> get_prefix();?>[numberposts]" value="<?php echo $this -> numberposts;?>">
                    </div>
                    <div class="hint"><?php echo __( 'Please select a number that is divisible by the number of columns', 'cosmotheme' );?>.</div>
                </div>

                <div class="standard-generic-field generic-field-header options-hint">
                    <?php
                        $msg = sprintf(__('Leave blank to use the default values set in %s Settings - Reading %s','cosmotheme'), '<a target="_blank" href="'.home_url().'/wp-admin/options-reading.php">' ,'</a>' );
                        echo $msg;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>