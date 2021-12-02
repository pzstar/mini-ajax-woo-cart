<?php 
defined('ABSPATH') or die('No Script Found!');

if(!class_exists('MAJC_Library')) {
	
	class MAJC_Library {

	    static function sanitize_array($array = array(), $sanitize_rule = array()) 
	    {
	      if (!is_array($array) || count($array) == 0) 
	      {
	          return array();
	      }

	      foreach ($array as $k => $v) {
	          if (!is_array($v)) {
	              $default_sanitize_rule = (is_numeric($k)) ? 'html' : 'text';
	              $sanitize_type = isset($sanitize_rule[$k]) ? $sanitize_rule[$k] : $default_sanitize_rule;
	              $array[$k] = self:: sanitize_value($v, $sanitize_type);
	          }

	          if (is_array($v)) {
	              $array[$k] = self:: sanitize_array($v, $sanitize_rule);
	          }
	      }

	      return $array;
	    }

	    static function sanitize_value($value = '', $sanitize_type = 'html') 
	    {
	        switch ($sanitize_type) 
	        {
	          case 'text':
	              $allowed_html = wp_kses_allowed_html('post');
	              return wp_kses($value, $allowed_html);
	              break;
	          default:
	              return sanitize_text_field($value);
	              break;
	        }
	    }

	    public function pr($array) {
	        echo "<pre>";
	        print_r($array);
	        echo "</pre>";
	    }

	    public function majc_sanitize_url($url) {
	    	$sanitized_url = strip_tags( stripslashes( filter_var($url, FILTER_VALIDATE_URL) ) );
	    	return $sanitized_url;
	    }

	    public function majc_animations() {
	    	$animations =   
				[
					'show_animation'	=>  array(
												'Fading Entrances'		=> array('fadeIn','fadeInLeft','fadeInRight'),
												'Slide Entrance'		=> array('slideInLeft','slideInRight')
												),
					'hide_animation'	=>  array(
												'Fading Exits'			=> array('fadeOut','fadeOutLeft','fadeOutRight'),
												'Slide Exits'			=> array('slideOutLeft','slideOutRight')
												),
					'hover_animation'	=>  array(
												'2D Transitions'		=> array(
														'Grow'					=> 'hvr-grow',
														'Shrink'				=> 'hvr-shrink',
														'Pulse'					=> 'hvr-pulse'
														)
											),
				];
			return $animations;
	    }
	}

	new MAJC_Library();
}