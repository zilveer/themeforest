<?php 

class PGL_Integrate
{
	function __construct( $option )
    {
        $this->option = $option;
    }

    function integrate( $obj = NULL)
    {
        if ( ! is_null( $obj ) ) {
            $this->option = $obj;
        }
        $this->add_section();
        $this->add_tab();
        $this->add_arguments();
    }

    function add_section( $section = array() )
    {
        $this->option->add_section( $section);
    }

    function add_tab( $tabs = array() ) {
        $this->option->add_option_tab( $tabs );
    }

    function add_arguments( $args = array() ){
        $this->option->add_option_args( $args );
    }
}
 ?>