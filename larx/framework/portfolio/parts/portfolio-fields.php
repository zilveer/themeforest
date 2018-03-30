<?php
$project_description=get_post_meta(get_the_ID(),'_cmb_projects-custom-fields',true);

foreach ( (array) $project_description as $key => $entry ) {

    $title = $desc = '';

    if ( isset( $entry['title'] ) )
    $title = esc_html( $entry['title'] );

    if ( isset( $entry['description'] ) )
    $desc = esc_html( $entry['description'] ); ?>

    <div class="new-project-info">
        <h3><?php echo $title; ?></h3>
        <p><?php echo $desc; ?></p>
    </div>

<?php
}
?>