<?php
/*
Plugin Name: Gallery Slideshow
Description: Turn any WordPress gallery into a slideshow using the "gss" shortcode.
Version: 1.0
Author: Jethin
Author URI: 
License: GPL2
*/

class gallery_ss{
    static function init() {
        add_shortcode( 'gss', array(__CLASS__, 'gss_shortcode') );
        add_action( 'wp_enqueue_scripts', array(__CLASS__, 'gss_enqueue_scripts') );
    }

    static function gss_shortcode($atts) {
        extract( shortcode_atts( array( 'ids' => '', 'name' => 'gslideshow', 'style' => '' ), $atts ) ); 
        $ids = explode( ',', $ids );
		if( $style != '' ){
			$style = ' style="' . $style . '"';
		}
		$longest_cap = array( 'length' => 0, 'text' => '' );
		$slides = '';
		$pager = '<div id="' . $name . '_pager" class="gss-pager"></div>';
        foreach( $ids as $image_id ){
            $attachment = get_post( $image_id, 'ARRAY_A' );
            $slides .= "\t\t" . '<img src="' . $attachment['guid'] . '" alt="' . htmlspecialchars($attachment['post_excerpt']) . '" />' . "\n";
			if( strlen( $attachment['post_excerpt'] ) > $longest_cap['length'] ){
				$longest_cap['length'] = strlen( $attachment['post_excerpt'] );
				$longest_cap['text'] = $attachment['post_excerpt'];
			}
        }
		$has_captions = !empty( $longest_cap['text'] ) ? true : false;
		if( $has_captions ){
			$captions_options = 'data-cycle-caption="#' . $name . '_captions" 
		data-cycle-caption-template="{{alt}}"';
			$no_captions_class = '';
		}
		else{
			$captions_options = '';
			$no_captions_class = ' no-captions';
		}
		$html = "\n\n" . '<div id="' . $name . '" class="gss-container' . $no_captions_class . '"' . $style . '>' . "\n\t";
		$html .= 	'<div class="cycle-slideshow" 
		data-cycle-timeout=0 
		data-cycle-auto-height="calc" 
		data-cycle-prev="#' . $name . '_prev" 
		data-cycle-next="#' . $name . '_next" 
		data-cycle-pager="#' . $name . '_pager" 
		' . $captions_options . ' 
		data-cycle-pager-template="<a href=#>&nbsp;</a>" 
		data-cycle-speed="750"
		>';
		if( $has_captions ){
			$html .= $pager;
		}
		$html .= $slides . "\t</div>\n\t";
		$html .= 	'<div class="gss-info">' . "\n\t\t";
		$html .= 		'<div class="gss-nav"><div id="' . $name . '_prev" class="gss-prev">&lt;</div><div id="' . $name . '_next" class="gss-next">&gt;</div></div>';
		if( !$has_captions ){
			$html .= $pager;
		}
		if( $has_captions ){
			$html .= 		'<div class="gss-long-cap">' . $longest_cap['text'] . "\n\t\t</div>";
			$html .= 		'<div id="' . $name . '_captions" class="gss-captions">' . "\n\t\t</div>";
		}
		$html .= "\n\t</div>\n</div>\n\n";
        return $html;
    }

    static function gss_enqueue_scripts() {
        wp_register_script( 'cycle2', plugins_url( 'jquery.cycle2.min.js' , __FILE__ ), array('jquery'), '2' );
		wp_register_script( 'gss_js', plugins_url( 'gss.js' , __FILE__ ) );
		wp_register_style( 'gss_css', plugins_url( 'gss.css' , __FILE__ ) );
		wp_enqueue_script( 'cycle2' );
		wp_enqueue_script( 'gss_js' );
		wp_enqueue_style( 'gss_css' );
    }
}

gallery_ss::init();

?>