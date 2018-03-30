<div class="commententries">

	<?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.','dt_themes'); ?></p>
    <?php  return;
        endif;?>
        
    <h4><?php comments_number(__('No Comments','dt_themes'), __('Comment ( 1 )','dt_themes'), __('Comments ( % )','dt_themes') );?></h4>    
    
    <?php if ( have_comments() ) : ?>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                    <div class="navigation">
                        <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments','dt_themes'  ) ); ?></div>
                        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments','dt_themes') ); ?></div>
                    </div> <!-- .navigation -->
        <?php endif; // check for comment navigation ?>
        <ul class="commentlist">
            <?php wp_list_comments( array( 'callback' => 'dttheme_custom_comments' ) ); ?>
        </ul>
    <?php else: ?>
        <?php if ( ! comments_open() ) : ?>
            <p class="nocomments"><?php _e( 'Comments are closed.','dt_themes'); ?></p>
        <?php endif;?>    
    <?php endif; ?>
        
    <!-- Comment Form -->
    <?php 
	if ('open' == $post->comment_status) : 
		$comments_args = array(
				'title_reply' => __( 'Give A Reply ','dt_themes' ),
				'comment_field'=> '<div class="dt-sc-one-half column">
										<textarea required placeholder="'.__('Message (required)','dt_themes').'" rows="3" cols="5" name="comment" id="comment"></textarea>
									</div>',
				'comment_notes_before'=>'',
				'comment_notes_after'=>'',
				'label_submit'=>__('Comment','dt_themes'),
					'fields' => apply_filters( 
						'comment_form_default_fields', 
						'<div class="dt-sc-one-half column first">
							<input type="text" required="" placeholder="'.__('Name (required)','dt_themes').'" name="author" id="author">
							<input type="text" required="" placeholder="'.__('Email (required)','dt_themes').'" name="email" id="email">
							<input type="text" required="" placeholder="'.__('Website (required)','dt_themes').'" name="website" id="website">
						</div>'
					)
				);		
		comment_form($comments_args);
    endif; 
	?>
    
</div>