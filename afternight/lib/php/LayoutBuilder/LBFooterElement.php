<?php
class LBFooterElement extends LBElement{
    private $words_full_width = array( 0 => 'twelve', 1 => 'twelve', 2 => 'six', 3 => 'four', 4 => 'three', 5 => 'three', 6 => 'two', 7 => 'two', 8 => 'one', 9 => 'one', 10 => 'one', 11 => 'one', 12 => 'one' );
    function columns_arabic_to_word( $arabic ){
        return $this -> words_full_width[ $arabic ];
    }

    function __construct( $data ){
        parent::__construct( $data );
        $this -> element_columns = 12;
        $this -> id = '_id_';
        $this -> name = __( 'New element' , 'cosmotheme' );
        $this -> type = 'empty';
        $this -> show_title = 'no';
        $this -> text_align = 'left';
        foreach( $data as $identifier => $value ){
            $this ->{ $identifier } = $value;
        }
    }

    function get_prefix(){
        return $this -> row -> get_prefix() . "[_elements][$this->id]";
    }

    function render_backend(){
        include get_template_directory() . '/lib/templates/footerelement.php';
    }

    function render_frontend(){
        //$this -> is_fullwidth = ( 12 == $this -> element_columns ) && !( $this -> row -> template -> layout_has_sidebars );
        if ($this -> type == 'textelement' || $this -> type == 'menu' || $this -> type == 'socialicons' || $this -> type == 'copyright' ) {
            if ($this -> text_align == 'left') {
                $text_align_class = 'align-left';
            }elseif ($this -> text_align == 'center'){
                $text_align_class = 'align-center';
            }elseif ($this -> text_align == 'right'){
                $text_align_class = 'align-right';
            }
        }else { $text_align_class = ''; }          
        $type = $this -> type;
        echo '<div class="' . $this -> type . ' ' . $text_align_class . ' ' . LBRenderable::$words[ $this -> element_columns ] . ' columns">';
            call_user_func( array ( $this, "render_frontend_$type" ) );
        echo '</div>';
    }

    function render_frontend_menu(){ 
        echo menu( 'footer_menu' , array(
            'container'       => 'nav',
            'container_class' => 'footer-menu',  
            'number-items' => $this -> numberposts,
            'current-class' => 'active',
            'type' => 'category',
            'class' => 'footer-menu',
            'menu_id' => 'nav-menu-footer'
        ));
    }

    function render_frontend_copyright(){
        ?>
            <p class="copyright"><?php echo str_replace('%year%',date('Y') , options::get_value('general' , 'copy_right') ); ?></p>
        <?php
    }

    function render_frontend_socialicons(){
        $social = new LBHeaderElement($this);
        $social->get_social_icons();
    }
    function render_frontend_textelement(){
        echo do_shortcode($this -> text); 
    }

}
?>