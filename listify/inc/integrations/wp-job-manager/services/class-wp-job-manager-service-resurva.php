<?php

class Listify_WP_Job_Manager_Service_Resurva extends Listify_WP_Job_Manager_Service {

    public function __construct() {
        $this->meta_key = 'resurva_url';
        $this->label    = __( 'Book with Resurva', 'listify' );

        parent::__construct();
    }

    public function get_content() {
        $resurva = untrailingslashit( $this->get_value() );

        ob_start();
?>
    <iframe src="<?php echo esc_url( $resurva ); ?>/book?embedded=true" name="resurva-frame" frameborder="0" width="450" height="450" style="max-width:100%"></iframe>
<?php
        $content = ob_get_clean();

        return $content;
    }

}

new Listify_WP_Job_Manager_Service_Resurva;
