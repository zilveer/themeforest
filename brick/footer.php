<?php global $qode_options; ?>

<?php extract(qode_get_footer_options()); ?>

<?php get_template_part('content-bottom-area'); ?>

    </div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<?php
if(isset($qode_options['paspartu']) && $qode_options['paspartu'] == 'yes'){?>
        <?php if(isset($qode_options['vertical_area']) && $qode_options['vertical_area'] =='yes' && isset($qode_options['vertical_menu_inside_paspartu']) && $qode_options['vertical_menu_inside_paspartu'] == 'no') { ?>
			</div> <!-- paspartu_middle_inner close div -->
		<?php } ?>
		</div> <!-- paspartu_inner close div -->
    </div> <!-- paspartu_outer close div -->
<?php } ?>

<footer <?php qode_class_attribute($footer_classes); ?>>
	<div class="footer_inner clearfix">
		<?php

		if($display_footer_top) {
			if($footer_top_border_color != ''){ ?>
				<?php if($footer_top_border_in_grid != '') { ?>
					<div class="footer_ingrid_border_holder_outer">
				<?php } ?>
						<div class="footer_top_border_holder <?php echo esc_attr($footer_top_border_in_grid); ?>" <?php qode_inline_style($footer_top_border_color); ?>></div>
				<?php if($footer_top_border_in_grid != '') { ?>
					</div>
				<?php } ?>
			<?php } ?>
			<div class="footer_top_holder">
				<div class="footer_top<?php if(!$footer_in_grid) {echo " footer_top_full";} ?>">
					<?php if($footer_in_grid){ ?>
					<div class="container">
						<div class="container_inner">
							<?php } ?>
							<?php switch ($footer_top_columns) {
								case 6:
									?>
									<div class="two_columns_50_50 clearfix">
										<div class="qode_column column1">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_1' ); ?>
											</div>
										</div>
										<div class="qode_column column2">
											<div class="column_inner">
												<div class="two_columns_50_50 clearfix">
													<div class="qode_column column1">
														<div class="column_inner">
															<?php dynamic_sidebar( 'footer_column_2' ); ?>
														</div>
													</div>
													<div class="qode_column column2">
														<div class="column_inner">
															<?php dynamic_sidebar( 'footer_column_3' ); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php
									break;
								case 5:
									?>
									<div class="two_columns_50_50 clearfix">
										<div class="qode_column column1">
											<div class="column_inner">
												<div class="two_columns_50_50 clearfix">
													<div class="qode_column column1">
														<div class="column_inner">
															<?php dynamic_sidebar( 'footer_column_1' ); ?>
														</div>
													</div>
													<div class="qode_column column2">
														<div class="column_inner">
															<?php dynamic_sidebar( 'footer_column_2' ); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="qode_column column2">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_3' ); ?>
											</div>
										</div>
									</div>
									<?php
									break;
								case 4:
									?>
									<div class="four_columns clearfix">
										<div class="qode_column column1">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_1' ); ?>
											</div>
										</div>
										<div class="qode_column column2">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_2' ); ?>
											</div>
										</div>
										<div class="qode_column column3">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_3' ); ?>
											</div>
										</div>
										<div class="qode_column column4">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_4' ); ?>
											</div>
										</div>
									</div>
									<?php
									break;
								case 3:
									?>
									<div class="three_columns clearfix">
										<div class="qode_column column1">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_1' ); ?>
											</div>
										</div>
										<div class="qode_column column2">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_2' ); ?>
											</div>
										</div>
										<div class="qode_column column3">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_3' ); ?>
											</div>
										</div>
									</div>
									<?php
									break;
								case 2:
									?>
									<div class="two_columns_50_50 clearfix">
										<div class="qode_column column1">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_1' ); ?>
											</div>
										</div>
										<div class="qode_column column2">
											<div class="column_inner">
												<?php dynamic_sidebar( 'footer_column_2' ); ?>
											</div>
										</div>
									</div>
									<?php
									break;
								case 1:
									dynamic_sidebar( 'footer_column_1' );
									break;
							}
							?>
							<?php if($footer_in_grid){ ?>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		<?php } ?>
		<?php

		if($display_footer_text): ?>
            <?php if($footer_bottom_border_color != ''){ ?>
				<?php if($footer_bottom_border_in_grid != '') { ?>
					<div class="footer_ingrid_border_holder_outer">
				<?php } ?>
                		<div class="footer_bottom_border_holder <?php echo esc_attr($footer_bottom_border_in_grid); ?>" <?php qode_inline_style($footer_bottom_border_color); ?>></div>
				<?php if($footer_bottom_border_in_grid != '') { ?>
					</div>
				<?php } ?>
            <?php } ?>
			<div class="footer_bottom_holder">
                <div class="footer_bottom_holder_inner">
                    <?php if($footer_in_grid){ ?>
                    <div class="container">
                        <div class="container_inner">
                            <?php } ?>

                            <?php switch ($footer_bottom_columns) {
                                case 3:
                                    ?>
                                    <div class="three_columns clearfix">
                                        <div class="qode_column column1">
                                            <div class="column_inner">
                                                <?php dynamic_sidebar( 'footer_bottom_left' ); ?>
                                            </div>
                                        </div>
                                        <div class="qode_column column2">
                                            <div class="column_inner">
                                                <?php dynamic_sidebar( 'footer_text' ); ?>
                                            </div>
                                        </div>
                                        <div class="qode_column column3">
                                            <div class="column_inner">
                                                <?php dynamic_sidebar( 'footer_bottom_right' ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    break;
                                case 2:
                                    ?>
                                    <div class="two_columns_50_50 clearfix">
                                        <div class="qode_column column1">
                                            <div class="column_inner">
                                                <?php dynamic_sidebar( 'footer_bottom_left' ); ?>
                                            </div>
                                        </div>
                                        <div class="qode_column column2">
                                            <div class="column_inner">
                                                <?php dynamic_sidebar( 'footer_bottom_right' ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    break;
                                case 1:
                                    ?>
                                    <div class="column_inner">
                                        <?php dynamic_sidebar( 'footer_text' ); ?>
                                    </div>
                                    <?php
                                    break;
                            }
                            ?>
                            <?php if($footer_in_grid){ ?>
                        </div>
                    </div>
                <?php } ?>
                </div>
			</div>
            <?php if($footer_bottom_border_bottom_color != ''){ ?>
				<div class="footer_bottom_border_bottom_holder <?php echo esc_attr($footer_top_border_in_grid); ?>" <?php qode_inline_style($footer_bottom_border_bottom_color); ?>></div>
			<?php } ?>
		<?php endif; ?>

	</div>
</footer>
</div> <!-- close div.wrapper_inner  -->
</div> <!-- close div.wrapper -->
<?php wp_footer(); ?>
</body>
</html>