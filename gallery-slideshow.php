<?php
/*
Plugin Name: Gallery Slideshow
Description: Turn any WordPress gallery into a slideshow using the "gss" shortcode.
Version: 1.2
Author: Jethin
Author URI: http://s89693915.onlinehome.us/wp/?page_id=4
License: GPL2
*/

class gallery_ss{
    static function init() {
        add_shortcode( 'gss', array(__CLASS__, 'gss_shortcode') );
        add_action( 'wp_enqueue_scripts', array(__CLASS__, 'gss_enqueue_scripts') );
    }

    static function gss_shortcode($atts) {
        extract( shortcode_atts( array( 'ids' => '', 'name' => 'gslideshow', 'style' => '', 'options' => '' ), $atts ) ); 
        $ids = explode( ',', $ids );
		$options = html_entity_decode($options);
		parse_str( $options, $opts );
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
		
		// do options
		$default_opts = array(
			'timeout' => '0',
			'prev' => '#' . $name . '_prev',
			'next' => '#' . $name . '_next',
			'pager' => '#' . $name . '_pager',
			'pager-template' => '<a href=#>&nbsp;</a>',
			'speed' => '750',
			'center-horz' => 'true'
		);
		$has_captions = !empty( $longest_cap['text'] ) ? true : false;
		if( $has_captions ){
			$default_opts['caption'] = '#' . $name . '_captions';
			$default_opts['caption-template'] = '{{alt}}';
			$no_captions_class = '';
		}
		else{
			$no_captions_class = ' no-captions';
		}
		foreach( $default_opts as $k => $v){
			if( !array_key_exists( $k, $opts ) ){
				$opts[$k] = $v;
			}
		}
		$options_string = '';
		foreach( $opts as $k => $v){
			$options_string .= 'data-cycle-' . $k . '="' . $v . '"' . "\n\t\t";
		}
		// begin gss html output
		$html = "\n\n" . '<div id="' . $name . '" class="gss-container' . $no_captions_class . '"' . $style . '>' . "\n\t";
		$html .= 	'<div class="cycle-slideshow" 
		'. $options_string . 
		'>';
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
        wp_register_script( 'cycle2', plugins_url( 'jquery.cycle2.min.js' , __FILE__ ), array('jquery'), '2.0.2' );
		wp_register_script( 'cycle2_center', plugins_url( 'jquery.cycle2.center.min.js' , __FILE__ ), array('cycle2'), 'v20140114' );
		wp_register_script( 'gss_js', plugins_url( 'gss.js', __FILE__ ) );
		wp_register_style( 'gss_css', plugins_url( 'gss.css', __FILE__ ) );
		wp_enqueue_script( 'cycle2' );
		wp_enqueue_script( 'cycle2_center' );
		wp_enqueue_script( 'gss_js' );
		wp_enqueue_style( 'gss_css' );
		$custom_js = plugin_dir_path( __FILE__ ) . 'gss-custom.js';
		if ( file_exists($custom_js) ) {
			wp_register_script( 'gss-custom-js', plugins_url( 'gss-custom.js' , __FILE__ ) );
			wp_enqueue_script( 'gss-custom-js' );
		}
    }
}

gallery_ss::init();

?>