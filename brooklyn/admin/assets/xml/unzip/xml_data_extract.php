<style>
.ut-print {
    display:block;
    padding: 10px;
    margin: 10px;    
    font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;
    border: 1px solid #FDA527;
    background: #04070B;
    color: #FDA527;
}
</style>

<?php

function format_php_export($arrayRep) {
    $arrayRep = preg_replace('/[ ]{2}/', "\t", $arrayRep);
    $arrayRep = preg_replace("/\=\>[ \n\t]+array[ ]+\(/", '=> array(', $arrayRep);
    return $arrayRep = preg_replace("/\n/", "\n\t", $arrayRep);
}


/* id to fetch */
$id = '1777';

/* file to load */
$xml = simplexml_load_file( 'demo_one.xml', 'SimpleXMLElement', LIBXML_NOCDATA );

/* item data */
$item = array();

/* loop through channel items */
foreach ( $xml->channel->item as $entry ){
    
    /* activate namespacing */
    $namespaces = $entry->getNameSpaces( true );
    $wp         = $entry->children( $namespaces['wp'] );
    $content    = $entry->children( $namespaces['content'] );
    
    /* get content */
    $content    = json_decode( json_encode( $content) );
    $content    = $content->encoded;
    
    if( $wp->post_type == 'page' && $wp->post_id == $id ) {
        
        /* title */
        $item['title']     = (string)$entry->title;
        $item['post_name'] = (string)$wp->post_name;
        $item['section']   = '#section-' . (string)$wp->post_name;
        
        /* content */
        if( !is_object( $content ) ) {
        
            $item['content'] = htmlspecialchars( $content );
            
        }
            
        /* postmeta */
        $postmeta = json_decode( json_encode( $wp ) , 1);
        $postmeta_array = array();               
        
        foreach( $postmeta['postmeta'] as $meta ) {
            
            if( !empty( $meta['meta_value'] ) ) {
                
                $postmeta_array[] = $meta;
             
            }
        
        };        
        
        $item['postmeta'] = $postmeta_array;
        
    }
    
}

echo '<pre class="ut-print">';
    echo format_php_export( var_export( $item, true ) );
echo '</pre>';

?>