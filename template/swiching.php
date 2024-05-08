<?php
/**
 * Swiching & Create HTML Output for new style
 * 
 * @package silohon-fast
 */

global $get_meta, $post, $data;
if(isset($get_meta['sls_data'][0])){
    $dataStyle = false;
    if( !empty( $get_meta['sls_data'][0] )){
        $dataStyle = $get_meta['sls_data'][0];
        if( is_serialized( $dataStyle )){
            $dataStyle = unserialize( $dataStyle );
        }
    }
}

if(!empty( $dataStyle ) && is_array( $dataStyle )){
    foreach( $dataStyle as $data ){
        switch( $data['style'] ){

            case 's1':
                FAST_PART('template/style/part1');
            break;

            case 's2':
                FAST_PART('template/style/part2');
            break;

            case 's3':
                FAST_PART('template/style/part3');
            break;

        }
    }
}