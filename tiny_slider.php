<?php 

	/**

	 * Plugin Name:			Tiny Slider
	 * Plugin URI:			http://journeybyweb.com/
	 * Description:			Creat easy and smooth slider with this shortcode plugin.
	 * Version:				1.0.0
	 * Requires at least:	5.2
	 * Requires PHP:		7.2
	 * Author:				Abdul Hay
	 * Author URI:			http://abdulhay.journeybyweb.com/
	 * License:				GPL v2 or later
	 * License URI:			https://www.gnu.org/licenses/gpl-2.0.html
	 * Text Domain:			TinySlider
	 * Domain Path:			/languages

	*/

	/*function TinySlider_activation_hook(){}
		register_activation_hook( __FILE__, 'TinySlider_activation_hook' );

	function TinySlider_deactivation_hook(){}
		register_deactivation_hook( __FILE__, 'TinySlider_activation_hook' );
	*/


	function TinySlider_load_textdomain(){
		load_plugin_textdomain( 'TinySlider', false, dirname(__FILE__).'/languages' );
	}
	add_action( 'plugin_loaded', 'TinySlider_load_textdomain');

	function TinySlider_scripts() {
		wp_enqueue_style( 'TinySlider_css', "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css", '1.0');
		wp_enqueue_script( 'TinySlider_js', "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js",array(), '1.0', true );
		wp_enqueue_script( 'TinySlider_main_js', plugin_dir_url(__FILE__)."/admin/js/main.js", array( 'jquery' ), '1.0', true );
	}
	add_action( 'wp_enqueue_scripts', 'TinySlider_scripts' );
	

	function TinySlider_shortcode_tinyslider($arguments, $content){
		$default_args = array(
			'width' => 400,
			'height' => 100,
			'id' => ''
		);
		$attributes = shortcode_atts( $default_args, $arguments );
		$content = do_shortcode( $content );

		$shortcode_output = <<<EOD
			<div class="bg-secondary mt-3" id='{$attributes['id']}' style="width:{$attributes['width']}; height:{$attributes['height']}">
				<div class="slider">
					{$content}
				</div>
			</div>
		EOD;
		return $shortcode_output;
	}
	add_shortcode( 'tinyslider', 'TinySlider_shortcode_tinyslider' );

	function TinySlider_shortcode_tinyslide($arguments){
		$default_args = array(
				'id' => '',
				'size' => 'medium',
				'caption' => ''
		);

		$attributes = shortcode_atts( $default_args, $arguments );

		$img_source = wp_get_attachment_image_src( $attributes['id'], $attributes['size']);

		$shortcode_output = <<<EOD
			<div class="slider text-center mt-3">
				<p><img src="{$img_source['0']}" alt="{$attributes['caption']}"></p>
				<p>{$attributes['caption']}</p>
			</div>
		EOD;
		return $shortcode_output;
	}
	add_shortcode( 'tinyslide', 'TinySlider_shortcode_tinyslide' );


?>