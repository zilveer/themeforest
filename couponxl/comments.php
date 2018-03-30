<?php
	/**********************************************************************
	***********************************************************************
	PROPERSHOP COMMENTS
	**********************************************************************/
	
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ( 'Please do not load this page directly. Thanks!' );
	if ( post_password_required() ) {
		return;
	}
?>
<?php if ( comments_open() ) :?>


    <!-- row -->
    <div class="comments">
    	<?php if( have_comments() ): ?>	    
	    	<div class="white-block">
	    		<div class="white-block-title">
	    			<i class="fa fa-ticket"></i>
	    			<h2><?php echo comments_number( __( '0 Comments', 'couponxl'), __( '1 Comment', 'couponxl' ), __( '% Comments', 'couponxl' ) ); ?></h2>
	    		</div>

		        <div class="white-block-content">
					
						
						<?php 
						wp_list_comments( array(
							'type' => 'comment',
							'callback' => 'couponxl_comments',
							'end-callback' => 'couponxl_end_comments',
							'style' => 'div'
						)); 
						?>

		                <!-- pagination -->
						<?php
							$comment_links = paginate_comments_links( 
								array(
									'echo' => false,
									'type' => 'array',
									'prev_text' => '<i class="fa fa-arrow-left"></i>',
									'next_text' => '<i class="fa fa-arrow-right"></i>'
								) 
							);
							if( !empty( $comment_links ) ):
						?>					
			                <div class="custom-pagination">
			                    <ul class="pagination">
									<?php echo  couponxl_format_pagination( $comment_links ); ?>
								</ul>
							</div>
						<?php endif; ?>
		                <!-- .pagination -->

		        </div>    		
	    	</div>
    	<?php endif; ?>
    
    	<div class="white-block">
    		<div class="white-block-title">
    			<i class="fa fa-comment"></i>
    			<h2><?php _e( 'Leave Comment', 'couponxl' ) ?></h2>
    		</div>

    		<div class="white-block-content">
				<?php
					$comments_args = array(
						'label_submit'	=>	__( 'Send Comment', 'couponxl' ),
						'title_reply'	=>	'',
						'fields'		=>	apply_filters( 'comment_form_default_fields', array(
												'author' => '<div class="input-group">
                          										<input type="text" class="form-control" placeholder="'.esc_attr__( 'NAME', 'couponxl' ).'" name="author">
                        									</div>',
												'email'	 => '<div class="input-group">
                          										<input type="text" class="form-control" placeholder="'.esc_attr__( 'EMAIL', 'couponxl' ).'" name="email">
                        									</div>'
											)),
						'comment_field'	=>	'<div class="input-group">
												<textarea class="form-control" placeholder="'.esc_attr__( 'MESSAGE', 'couponxl' ).'" name="comment"></textarea>
        									</div>',
						'cancel_reply_link' => __( 'or cancel reply', 'couponxl' ),
						'comment_notes_after' => '',
						'comment_notes_before' => '',
						'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), couponxl_get_permalink_by_tpl( 'page-tpl_login' ) ) . '</p>'
					);
					comment_form( $comments_args );	
				?>    			
    		</div>
    	</div>

    </div>
    <!-- .row -->

<?php endif; ?>