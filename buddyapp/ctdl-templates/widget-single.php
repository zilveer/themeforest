<li class="<?php echo esc_attr( ctdl_priority_class() ); ?> todo-list">
    <div class="todo-text">
        <?php echo strip_tags(wp_kses_post( ctdl_todo_text() )); ?>
    </div>
    <?php if ( ctdl_check_field( 'widget-progress' ) || ctdl_check_field( 'widget-deadline' ) || ctdl_check_field( 'widget-assigned' ) ) : ?>
    <div class="todo-content">
        <?php if ( ctdl_check_field( 'widget-progress' ) ) : ?>
            <div class="todo-progress" data-progress="<?php echo esc_html( ctdl_progress() ); ?>"><span><?php echo apply_filters( 'ctdl_progress', esc_html__( 'Progress', 'cleverness-to-do-list' ) ); ?>: </span><em><?php echo esc_html( ctdl_progress() ); ?>%</em></div>
        <?php endif; ?>
        <?php if ( ctdl_check_field( 'widget-deadline' ) ) : ?>
            <div class="todo-deadline"><span><?php echo apply_filters( 'ctdl_deadline', esc_html__( 'Deadline', 'cleverness-to-do-list' ) ); ?>: </span><em><?php echo esc_html( ctdl_deadline() ); ?></em></div>
        <?php endif; ?>
        <?php if ( ctdl_check_field( 'widget-assigned' ) ) : ?>
            <div class="todo-assigned"><span><?php echo apply_filters( 'ctdl_assigned', esc_html__( 'Assigned to', 'cleverness-to-do-list' ) ); ?>: </span><em><?php echo esc_html( ctdl_assigned() ); ?></em></div>
        <?php endif; ?>
        <?php do_action( 'ctdl_widget_list_items' ); ?>
    </div>
    <?php endif; ?>
</li>