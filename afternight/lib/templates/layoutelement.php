<div class="<?php echo LBRenderable::$words[ $this -> element_columns ];?> columns resizable" data-id="<?php echo $this -> id;?>">
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[id]" value="<?php echo $this -> id;?>" class="element-id">
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[element_columns]" value="<?php echo $this -> element_columns;?>" class="element-columns">
    <div class="fl">
        <div class="tools">
            <a class="edit-element has-popup" data-element-id="<?php echo $this -> id;?>" href="javascript:void(0);">
                <div class="popup">
                    <?php echo __( 'Edit content', 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>
            <?php if( !$this -> row -> is_additional ){ ?>

                <a class="delete-column has-popup" href="javascript:void(0);">
                    <div class="popup">
                        <?php echo __( 'Delete these columns', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
                <a class="add-element has-popup" href="javascript:void(0);">
                    <div class="popup">
                        <?php echo __( 'Add content', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <?php if( $this -> row -> is_additional ){ ?>
            <div class="default-row-hint">
                <h4><?php echo __( 'Default', 'cosmotheme' );?></h4>
                <?php echo __( <<<endhtml
This row loads the default WordPress content for each page. You cannot delete it or split it into several columns.<br />
If assigned for such pages as Author archives or Category it will represent the author's posts or posts belonging to a given category. Feel free to edit it and choose content layout.<br />
If assigned for Pages or Posts - it will represent the page content. Editing it will have no effect.
endhtml
                );?>
            </div>
        <?php } ?>
    </div>
    <div class="relative-wrapper">
        <a class="handle has-popup">
            <div class="popup">
                <?php echo __( 'Drag left and right to resize the neighbours', 'cosmotheme' );?>
                <div class="maybe-pointer"></div>
            </div>
        </a>
    </div>

    <div class="display_hint" id="<?php echo $this -> id;?>"><?php echo __( 'Click the <b>edit elements</b> icon to add content', 'cosmotheme' );?></div>

    <div class="element-container">
        <?php
            $this -> print_taxonomy_inputs( 'categories', $this -> categories );
            $this -> print_taxonomy_inputs( 'eventcategories', $this -> eventcategories );
            $this -> print_taxonomy_inputs( 'tags', $this -> tags );
            $this -> print_taxonomy_inputs( 'portfolios', $this -> portfolios );
            $this -> print_taxonomy_inputs( 'boxes', $this -> boxes );
            $this -> print_taxonomy_inputs( 'teams', $this -> teams );
            $this -> print_taxonomy_inputs( 'banners', $this -> banners );
            $this -> print_taxonomy_inputs( 'testimonials', $this -> testimonials );
        ?>
        <div class="select-box posts hidden">
            <input type="radio" name="<?php echo $this -> get_prefix();?>[postID]" value="<?php echo $this -> postID;?>" checked="checked">
        </div>
        <div class="select-box events hidden">
            <input type="radio" name="<?php echo $this -> get_prefix();?>[eventID]" value="<?php echo $this -> eventID;?>" checked="checked">
        </div>
        <div class="select-box pages hidden">
            <input type="radio" name="<?php echo $this -> get_prefix();?>[pageID]" value="<?php echo $this -> pageID;?>" checked="checked">
        </div>
        <div class="select-box sidebars hidden">
            <input type="radio" name="<?php echo $this -> get_prefix();?>[sidebar]" value="<?php echo $this -> sidebar;?>" checked="checked">
        </div>
        <div class="on-overview">
            <div class="element-description"></div>
        </div>
        <div class="on-edit">
        <header>
			<span class="title fpb add_fpb">
				<a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
				<a href="javascript:void(0);" class="fpb_label">
                    <?php echo $this -> name; ?>
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
    <div class="standard-generic-field generic-field-front_page">
        <div class="generic-label">
            <label>
                <?php echo __( 'Element label' , 'cosmotheme' );?>
            </label>
        </div>
        <div class="generic-field generic-field-input">
            <input name="<?php echo $this -> get_prefix();?>[name]" class="element-title" value="<?php echo $this -> name;?>">
        </div>
        <div class="clear"></div>
    </div>

    <div class="standard-generic-field generic-field-header">
        <div class="generic-label">
            <label>
                <?php echo __( 'Display this label in front-end', 'cosmotheme' );?>
            </label>
        </div>
        <div class="generic-field generic-field-image-select">
            <label>
                <?php echo __( 'Yes' , 'cosmotheme' );?>
                <input type="radio" value="yes" name="<?php echo $this -> get_prefix();?>[show_title]" <?php checked( $this -> show_title, 'yes' );?>>
            </label>
            <label>
                <?php echo __( 'No' , 'cosmotheme' );?>
                <input type="radio" value="no" name="<?php echo $this -> get_prefix();?>[show_title]" <?php checked( $this -> show_title, 'no' );?>>
            </label>
        </div>
    </div>

    <div class="standard-generic-field generic-field-header">
        <div class="generic-label">
            <label>
                <?php echo __( 'Choose element type', 'cosmotheme' );?>
            </label>
        </div>
        <div class="generic-field generic-field-image-select element-type">
            <label>
                <?php echo __( 'Categories' , 'cosmotheme' );?>
                <input type="radio" value="category" name="<?php echo $this -> get_prefix();?>[type]" class="category-type" <?php checked( $this -> type, 'category' );?>>
            </label>
            <label>
                <?php echo __( 'Tags' , 'cosmotheme' );?>
                <input type="radio" value="tag" name="<?php echo $this -> get_prefix();?>[type]" class="tag-type" <?php checked( $this -> type, 'tag' );?>>
            </label>
            <label>
                <?php echo __( 'Event Categories' , 'cosmotheme' );?>
                <input type="radio" value="eventcategory" name="<?php echo $this -> get_prefix();?>[type]" class="event-category-type" <?php checked( $this -> type, 'eventcategory' );?>>
            </label>
            <label>
                <?php echo __( 'Portfolios' , 'cosmotheme' );?>
                <input type="radio" value="portfolio" name="<?php echo $this -> get_prefix();?>[type]" class="portfolio-type" <?php checked( $this -> type, 'portfolio' );?>>
            </label>
            <label>
                <?php echo __( 'Box sets' , 'cosmotheme' );?>
                <input type="radio" value="boxes" name="<?php echo $this -> get_prefix();?>[type]" class="box-set" <?php checked( $this -> type, 'boxes' );?>>
            </label>
            <label>
                <?php echo __( 'Team groups' , 'cosmotheme' );?>
                <input type="radio" value="teams" name="<?php echo $this -> get_prefix();?>[type]" class="team-group" <?php checked( $this -> type, 'teams' );?>>
            </label>
            <label>
                <?php echo __( 'Banners', 'cosmotheme' );?>
                <input type="radio" value="banners" name="<?php echo $this -> get_prefix();?>[type]" class="banner-type" <?php checked( $this -> type, 'banners' );?>>
            </label>
            <label>
                <?php echo __( 'Testimonials', 'cosmotheme' );?>
                <input type="radio" value="testimonials" name="<?php echo $this -> get_prefix();?>[type]" class="testimonial-type" <?php checked( $this -> type, 'testimonials' );?>>
            </label>
            <?php
            if( options::logic( 'likes', 'enb_likes' ) ){
                $disabled = '';
            }else{
                $disabled = 'disabled';
            }
            ?>
            <a href="javascript:void(0)" class="has-popup <?php echo $disabled;?>">
                <label>
                    <?php echo __( 'Featured posts' , 'cosmotheme' );?>
                    <input type="radio" value="featured" name="<?php echo $this -> get_prefix();?>[type]" <?php checked( $this -> type, 'featured' );?>>
                </label>
                <div class="popup">
                    <div class="maybe-pointer"></div>
                    <?php echo __( 'You need to enable loves to use this option', 'cosmotheme' );?>
                </div>
            </a>

            <label>
                <?php echo __( 'Latest posts' , 'cosmotheme' );?>
                <input type="radio" value="latest" name="<?php echo $this -> get_prefix();?>[type]" <?php checked( $this -> type, 'latest' );?>>
            </label>
            <label>
                <?php echo __( 'Latest events' , 'cosmotheme' );?>
                <input type="radio" value="latest_events" name="<?php echo $this -> get_prefix();?>[type]" <?php checked( $this -> type, 'latest_events' );?>>
            </label>
            <label>
                <?php echo __( 'Page' , 'cosmotheme' );?>
                <input  class="page-type" type="radio" value="page" name="<?php echo $this -> get_prefix();?>[type]" class="page-type" <?php checked( $this -> type, 'page' );?>>
            </label>
            <label>
                <?php echo __( 'Post' , 'cosmotheme' );?>
                <input class="post-type" type="radio" value="post" name="<?php echo $this -> get_prefix();?>[type]" class="post-type" <?php checked( $this -> type, 'post' );?>>
            </label>

            <label>
                <?php echo __( 'Event' , 'cosmotheme' );?>
                <input class="event-type" type="radio" value="event" name="<?php echo $this -> get_prefix();?>[type]" class="event-type" <?php checked( $this -> type, 'event' );?>>
            </label>

            <label>
                <?php echo __( 'Widgets' , 'cosmotheme' );?>
                <input type="radio" value="widget_zone" name="<?php echo $this -> get_prefix();?>[type]" class="widget-type" <?php checked( $this -> type, 'widget_zone' );?>>
            </label>
            <label>
                <?php echo __( 'Text / Shortcodes' , 'cosmotheme' );?>
                <input type="radio" value="textelement" name="<?php echo $this -> get_prefix();?>[type]" class="textelement-type" <?php checked( $this -> type, 'textelement' );?>>
            </label>      
            <label>
                <?php echo __( 'Delimiter' , 'cosmotheme' );?>
                <input type="radio" value="delimiter" name="<?php echo $this -> get_prefix();?>[type]" class="delimiter-type" <?php checked( $this -> type, 'delimiter' );?>>
            </label>
            <label>
                <?php echo __( 'Empty' , 'cosmotheme' );?>
                <input type="radio" value="empty" name="<?php echo $this -> get_prefix();?>[type]" class="empty-type" <?php checked( $this -> type, 'empty' );?>>
            </label>            
        </div>
    </div>

    <div class="standard-generic-field generic-field-header element_type_list"></div>

    <div class="standard-generic-field generic-field-header option-delimiter_hint">
        <div class="generic-label">
            <label>
                <?php 
                    echo  sprintf(__( 'We recommend to use this element only between rows' , 'cosmotheme' ))  ;
                ?>
            </label>
        </div>
        <div class="generic-field generic-field-image-select delimiter-type">
            <label class="columns-2">
                <?php echo __( 'White space' , 'cosmotheme' );?>
                <input type="radio" value="white_space" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'white_space' );?>>
            </label>
            <label class="columns-3">
                <?php echo __( 'Pointed delimiter' , 'cosmotheme' );?>
                <input type="radio" value="pointed" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'pointed' );?>>
            </label>
            <label class="columns-3">
                <?php echo __( 'Doublepointed delimiter' , 'cosmotheme' );?>
                <input type="radio" value="doublepointed" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'doublepointed' );?>>
            </label>
            <label class="columns-3">
                <?php echo __( 'Line delimiter' , 'cosmotheme' );?>
                <input type="radio" value="line" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'line' );?>>
            </label>
            <label class="columns-3">
                <?php echo __( 'Doubleline delimiter' , 'cosmotheme' );?>
                <input type="radio" value="doubleline" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'doubleline' );?>>
            </label>
        </div>
        <div class="generic-label">
            <label>
                <?php 
                    echo  sprintf(__( 'Select margin distance for this delimiter' , 'cosmotheme' ))  ;
                ?>
            </label>
        </div>        
        <div class="generic-field generic-field-image-select">
            <label class="columns-2">
                <?php echo __( '15px' , 'cosmotheme' );?>
                <input type="radio" value="margin_15px" name="<?php echo $this -> get_prefix();?>[delimiter_margin]" <?php checked( $this -> delimiter_margin, 'margin_15px' );?>>
            </label>
            <label class="columns-3">
                <?php echo __( '30px' , 'cosmotheme' );?>
                <input type="radio" value="margin_30px" name="<?php echo $this -> get_prefix();?>[delimiter_margin]" <?php checked( $this -> delimiter_margin, 'margin_30px' );?>>
            </label>
            <label class="columns-3">
                <?php echo __( '60px' , 'cosmotheme' );?>
                <input type="radio" value="margin_60px" name="<?php echo $this -> get_prefix();?>[delimiter_margin]" <?php checked( $this -> delimiter_margin, 'margin_60px' );?>>
            </label>
        </div>  
        <div class="clear"></div>
        <div class="delimiter_color">
            <div class="generic-label">
                <label>
                    <?php 
                        echo  sprintf(__( 'Select color for this delimiter' , 'cosmotheme' ))  ;
                    ?>
                </label>
            </div>                      
            <div class="generic-field delimiter_color_picker">
                <input type="text" name="<?php echo $this->get_prefix();?>[delimiter_text_color]" value="<?php echo $this->delimiter_text_color;?>" class="my-color-field" />
            </div>      
        </div>        
    </div>
    <div class="standard-generic-field generic-field-header option-empty_hint">
        <div class="generic-label">
            <label>
                <?php 
                    echo  sprintf(__( 'Use this element if you need to have empty columns' , 'cosmotheme' )) ;
                ?>
            </label>
        </div>
    </div> 
    <div class="standard-generic-field generic-field-header option-text">
        <div class="generic-label">
            <label>
                <?php echo __( 'Enter text you wish to display.', 'cosmotheme' );?>
            </label>
        </div>
        <div class="generic-field">
            <textarea name="<?php echo $this->get_prefix();?>[text]"><?php echo $this->text;?></textarea>
        </div>
    </div>

    <!-- BOF text align OPTIONS -->
    <div class="standard-generic-field generic-field-header  text_align_options">
        <div class="generic-label">
            <label>
                <?php echo __( 'Text align', 'cosmotheme' );?>
            </label>
        </div>
        
        <div class="generic-field generic-field-image-select">
            <label>
                <?php echo __( 'Left' , 'cosmotheme' );?>
                <input class="align_left" type="radio" value="left" name="<?php echo $this -> get_prefix();?>[text_align]" <?php checked( $this -> text_align, 'left' );?>>
            </label>
            <label>
                <?php echo __( 'Center' , 'cosmotheme' );?>
                <input class="align_center" type="radio" value="center" name="<?php echo $this -> get_prefix();?>[text_align]" <?php checked( $this -> text_align, 'center' );?>>
            </label>
            <label>
                <?php echo __( 'Right' , 'cosmotheme' );?>
                <input class="align_right" type="radio" value="right" name="<?php echo $this -> get_prefix();?>[text_align]" <?php checked( $this -> text_align, 'right' );?>>
            </label>
        </div>
    </div>
    <!-- EOF text align OPTIONS -->
        
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
<!--             <label>
                <?php echo __( 'News view', 'cosmotheme' );?>
                <input class="news_view" type="radio" value="news_view" name="<?php echo $this -> get_prefix();?>[view]" <?php checked( $this -> view, 'news_view' );?>>
            </label>  -->           
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

    <div class="standard-generic-field generic-field-header gutter-options">
        <div class="generic-label">
            <label>
                <?php echo __( 'Remove gutter', 'cosmotheme' );?>
            </label>
        </div>
        <div class="generic-field generic-field-image-select">
            <label>
                <?php echo __( 'Yes' , 'cosmotheme' );?>
                <input type="radio" value="yes" name="<?php echo $this -> get_prefix();?>[remove_gutter]" <?php checked( $this -> remove_gutter, 'yes' );?>>
            </label>
            <label>
                <?php echo __( 'No' , 'cosmotheme' );?>
                <input type="radio" value="no" name="<?php echo $this -> get_prefix();?>[remove_gutter]" <?php checked( $this -> remove_gutter, 'no' );?>>
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

    <div class="standard-generic-field generic-field-header option-list-thumb-size">
        <div class="generic-label">
            <label>
                <?php echo __( 'Thumbnail size', 'cosmotheme' );?>
            </label>
        </div>
        <div class="generic-field generic-field-image-select">
            <label>
                <?php echo __( 'No thumb' , 'cosmotheme' );?>
                <input type="radio" value="no_thumb" name="<?php echo $this -> get_prefix();?>[list_view_thumb_size]" <?php checked( $this -> list_view_thumb_size, 'no_thumb' );?>>
            </label>
            <a href="javascript:void(0);" class="has-popup small_thumbnail">
                <label>
                    <?php echo __( 'Small thumb' , 'cosmotheme' );?>
                    <input type="radio" value="small_thumb" name="<?php echo $this -> get_prefix();?>[list_view_thumb_size]" <?php checked( $this -> list_view_thumb_size, 'small_thumb' );?>>
                </label>
            </a>
            <label>
                <?php echo __( 'Medium thumb' , 'cosmotheme' );?>
                <input type="radio" value="large_thumb" name="<?php echo $this -> get_prefix();?>[list_view_thumb_size]" <?php checked( $this -> list_view_thumb_size, 'large_thumb' );?>>
            </label>
            <label>
                <?php echo __( 'Large thumb' , 'cosmotheme' );?>
                <input type="radio" value="full_width_thumb" name="<?php echo $this -> get_prefix();?>[list_view_thumb_size]" <?php checked( $this -> list_view_thumb_size, 'full_width_thumb' );?>>
            </label>
<!--             <a href="javascript:void(0);" class="has-popup full_width_thumb_news">
                <label > <!-- with related posts on the right side of content -->
<!--                    <?php echo __( 'Large thumb 2' , 'cosmotheme' );?>
                    <input type="radio" value="full_width_thumb_news" name="<?php echo $this -> get_prefix();?>[list_view_thumb_size]" <?php checked( $this -> list_view_thumb_size, 'full_width_thumb_news' );?>>
                </label>
            </a> -->
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

    <div class="standard-generic-field generic-field-header options-behavior">
        <div class="generic-label">
            <label>
                <?php echo __( 'Element behaviour', 'cosmotheme' );?>
            </label>
        </div>
        <div class="generic-field generic-field-image-select">
            <a href="javascript:void(0);" class="has-popup enb_carousel">
                <label>
                    <?php echo __( 'Carousel slider' , 'cosmotheme' );?>
                    <input type="radio" value="carousel" name="<?php echo $this -> get_prefix();?>[behaviour]" <?php checked( $this -> behaviour, 'carousel' );?>>
                </label>
                <div class="popup">
                    <?php echo __( "You need 'Thumbnail view' or 'Grid view' to use this option", 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>

            <a href="javascript:void(0);" class="has-popup enb_pagination">
                <label>
                    <?php echo __( 'Pagination' , 'cosmotheme' );?>
                    <input type="radio" value="pagination" name="<?php echo $this -> get_prefix();?>[behaviour]" <?php checked( $this -> behaviour, 'pagination' );?>>
                </label>
                <div class="popup">
                    <?php echo __( "Disable 'Gallery view type' to use this option", 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>

            <a href="javascript:void(0);" class="has-popup enb_load_more">
                <label>
                    <?php echo __( 'Load more( AJAX )' , 'cosmotheme' );?>
                    <input type="radio" value="load_more" name="<?php echo $this -> get_prefix();?>[behaviour]" <?php checked( $this -> behaviour, 'load_more' );?>>
                </label>
                <div class="popup">
                    <?php echo __( "Disable 'Gallery view type' to use this option", 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>

            <a href="javascript:void(0);" class="has-popup enb_tabber">
                <label>
                    <?php echo __( 'Tabber' , 'cosmotheme' );?>
                    <input type="radio" value="tabber" name="<?php echo $this -> get_prefix();?>[behaviour]" <?php checked( $this -> behaviour, 'tabber' );?>>
                </label>
                <div class="popup">
                    <?php echo __( "Disable 'Gallery view type' to use this option", 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>

            <a class="has-popup enb_filters" href="javascript:void(0);">
                <label>
                    <?php echo __( 'Filter( by categories, tags etc. )' , 'cosmotheme' );?>
                    <input type="radio" value="filters" name="<?php echo $this -> get_prefix();?>[behaviour]" <?php checked( $this -> behaviour, 'filters' );?>>
                </label>
                <div class="popup">
                    <?php echo __( "You need 'Thumbnail view' to use this option", 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>
            <label>
                <?php echo __( 'None of those' , 'cosmotheme' );?>
                <input type="radio" value="none" name="<?php echo $this -> get_prefix();?>[behaviour]" <?php checked( $this -> behaviour, 'none' );?>>
            </label>
        </div>
    </div>

    <div class="standard-generic-field generic-field-header options-orderby">
        <div class="generic-label">
            <label>
                <?php echo __( 'Order by', 'cosmotheme' );?>
            </label>
        </div>
        <div class="generic-field generic-field-image-select">
            <label>
                <?php echo __( 'Date' , 'cosmotheme' );?>
                <input type="radio" value="date" name="<?php echo $this -> get_prefix();?>[orderby]" <?php checked( $this -> orderby, 'date' );?>>
            </label>
            <?php
            if ( function_exists( 'stats_get_csv' ) ){
                $disabled = '';
            }else{
                $disabled = 'disabled';
            }
            ?>
            <a href="javascript:void(0);" class="has-popup <?php echo $disabled;?>">
                <label>
                    <?php echo __( 'Views' , 'cosmotheme' );?>
                    <input type="radio" value="views" name="<?php echo $this -> get_prefix();?>[orderby]" <?php checked( $this -> orderby, 'views' );?>>
                </label>
                <div class="popup">
                    <?php echo __( 'You need JetPack to use this option', 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>
            <label>
                <?php echo __( 'Number of comments' , 'cosmotheme' );?>
                <input type="radio" value="comment_count" name="<?php echo $this -> get_prefix();?>[orderby]" <?php checked( $this -> orderby, 'comment_count' );?>>
            </label>
            <label>
                <?php echo __( 'Random' , 'cosmotheme' );?>
                <input type="radio" value="rand" name="<?php echo $this -> get_prefix();?>[orderby]" <?php checked( $this -> orderby, 'rand' );?>>
            </label>
            <label class="has-popup order-events-start-date" title="<?php echo __( 'This option must be used only for Events posts.', 'cosmotheme' );?>">
                <?php echo __( 'Event start date' , 'cosmotheme' );?>
                <input type="radio" value="start_date" name="<?php echo $this -> get_prefix();?>[orderby]" <?php checked( $this -> orderby, 'start_date' );?>>
            </label>
            <?php
            if( options::logic( 'likes', 'enb_likes' ) ){
                $disabled = '';
            }else{
                $disabled = 'disabled';
            }
            ?>
            <a href="javascript:void(0);" class="has-popup <?php echo $disabled;?>">
                <label>
                    <?php echo __( 'Number of loves' , 'cosmotheme' );?>
                    <input type="radio" value="likes" name="<?php echo $this -> get_prefix();?>[orderby]" <?php checked( $this -> orderby, 'likes' );?>>
                </label>
                <div class="popup">
                    <?php echo __( 'You to enable Loves to use this option', 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>
            <a href="javascript:void(0);" class="has-popup orderby-hot-date">
                <label>
                    <?php echo __( 'Hot date' , 'cosmotheme' );?>
                    <input type="radio" value="hot_date" name="<?php echo $this -> get_prefix();?>[orderby]" <?php checked( $this -> orderby, 'hot_date' );?>>
                </label>
                <div class="popup">
                    <?php echo __( 'This option is available only for featured posts', 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="standard-generic-field generic-field-header options-order">
        <div class="generic-label">
            <label>
                <?php echo __( 'Order', 'cosmotheme' );?>
            </label>
        </div>
        <div class="generic-field generic-field-image-select">
            <label>
                <?php echo __( 'DESC' , 'cosmotheme' );?>
                <input type="radio" value="desc" name="<?php echo $this -> get_prefix();?>[order]" <?php checked( $this -> order, 'desc' );?>>
            </label>
            <label>
                <?php echo __( 'ASC' , 'cosmotheme' );?>
                <input type="radio" value="asc" name="<?php echo $this -> get_prefix();?>[order]" <?php checked( $this -> order, 'asc' );?>>
            </label>
        </div>
    </div>
    </div>
    </div>
    </div>
</div>