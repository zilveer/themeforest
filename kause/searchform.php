<?php $canon_options_post = get_option('canon_options_post'); ?>

                		<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                			<input type="text" id="s" class="full" name="s" placeholder="<?php echo $canon_options_post['search_box_text']; ?>" />
                			<input name="button" class="btn" type="submit" value="<?php _e('Search', 'loc_canon'); ?>" id="send" />
							<?php if (isset($_GET['lang'])) { printf("<input type='hidden' name='lang' value='%s' />", esc_attr($_GET['lang'])); } ?>
                		</form>
