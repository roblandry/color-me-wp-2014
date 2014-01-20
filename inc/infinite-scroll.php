<?php
/**
 * Color Me WP 2014 ChildTheme Infinite Scroll Class.
 *
 * @category   Wordpress Plugin
 * @package    Color Me WP 2014
 * @author     Rob Landry <rob@landry.me>
 * @copyright  2013 Rob Landry
 * @license    http://www.gnu.org/licenses/gpl-3.0.html  GPLv3
 * @version    Release: 1.0
 * @link       http://www.landry.me/extend/plugins/color-me-wp-2014/
 * @see        http://redmine.landry.me/projects/color-me-wp-2014/
 * @since      Class available since Release 1.0
 *  
 */

class CMW_IScroll {

	/**
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $theme_slug = 'cmw_2014';

	/**
	 * The option value in the database will be based on get_stylesheet()
	 * so child themes don't share the parent theme's option value.
	 *
	 * @access public
	 * @var string
	 */
	public $option_key = 'cmw_2014_options';

	/**
	 * Constructor.
	 *
	 * @access public
	 *
	 * @return Color_Me_WP_Options
	 */
	public function __construct() {

        add_action( 'admin_init',           array( $this, '_admin_init'			) );
		add_action( 'customize_register',	array( $this, '_customize_register'	) );
		$opt	= get_option( $this->option_key );
		if (!empty($opt['enable_iscroll']) && $opt['enable_iscroll'] == true) {
	        add_action( 'wp_enqueue_scripts',   array( $this, '_enqueue_scripts'	) );
		}
	}

	/**
	 * Registers the form setting for our options array.
	 *
	 * This function is attached to the admin_init action hook.
	 *
	 * This call to register_setting() registers a validation callback, validate(),
	 * which is used when the option is saved, to ensure that our option values are properly
	 * formatted, and safe.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function _admin_init() {

		$_arr = array(
			'enable_iscroll' => 'Enable Infinite Scroll',
			'iscroll_text' => 'Infinite Scroll Loading Text',
			'iscroll_finish' => 'Infinite Scroll Finished Loading Text',
			'iscroll_Functions' => 'Infinite Scroll Functions to Load when Finished',
		);

		foreach ($_arr as $_value => $_text) {

			// Register our individual settings fields.
			add_settings_field(
				$_value,
				sprintf( __( '%s' , 'cmw_2014' ) , $_text ) ,
				array( $this, 'settings_field_'.$_value ),
				'theme_options',
				'general'
			);
		}

	}


	/**
	 * Implements Color Me WP theme options into Theme Customizer.
	 *
	 * @since Color Me WP 1.0
	 * @access public
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return void
	 */
	public function _customize_register( $wp_customize ) {

		// Create Infinite Scroll Section
		$wp_customize->add_section( $this->option_key . '_enable_iscroll', array(
			'title'    => __( 'Infinite Scroll', 'color-me-wp' ),
			'priority' => 35,
		) );

		$iscroll = array();

		// Enable Infinite Scroll
		$iscroll[] = array(
			'slug'=>'enable_iscroll', 
			'default' => 'false',
			'label' => __('Enable Infinite Scroll', 'cmw_2014'),
			'type' => 'checkbox',
			'transport' => 'refresh',
		);

		// Infinite Scroll Loading Text
		$iscroll[] = array(
			'slug'=>'iscroll_text', 
			'default' => '<em>Loading the next set of posts...</em>',
			'label' => __('Loading Message', 'cmw_2014'),
			'type' => 'text',
			'transport' => 'refresh',
		);

		// Infinite Scroll Finished Loading Text
		$iscroll[] = array(
			'slug'=>'iscroll_finish', 
			'default' => '<em>All posts loaded.</em>',
			'label' => __('Finished Message', 'cmw_2014'),
			'type' => 'text',
			'transport' => 'refresh',
		);

		// Infinite Scroll Functions to load
		$iscroll[] = array(
			'slug'=>'iscroll_functions', 
			'default' => '',
			'label' => __('Functions', 'cmw_2014'),
			'type' => 'text',
			'transport' => 'refresh',
		);

		foreach( $iscroll as $scroll ) {

			$wp_customize->add_setting(
				$this->option_key . '['. $scroll['slug'] .']', array(
					'default' => $scroll['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'transport' => $scroll['transport']
				)
			);

			$wp_customize->add_control( 
				$this->option_key . '_' . $scroll['slug'], array(
					'label'    => $scroll['label'],
					'section'  => $this->option_key . '_enable_iscroll',
					'settings' => $this->option_key . '['. $scroll['slug'] .']',
					'type'     => $scroll['type']
				)
			);
		}
	}

	/**
	 * Enqueue the infinite scroll js.
	 *
	 * @since Color Me WP 1.0
	 * @access public
	 *
	 * @return void
	 */
	function _enqueue_scripts(){
		if( ! is_singular() ) {

			// Infinite Scroll Options JS
        	$opt = get_option( $this->option_key );
			$img		= get_stylesheet_directory_uri().'/images/ajax-loader.gif';
			$text		= $opt['iscroll_text'];
			$finished	= $opt['iscroll_finish'];
			$functions	= $opt['iscroll_functions'];
			$next		= ".pagination a.next.page-numbers";
			$nav		= ".navigation.paging-navigation";
			$content	= "#content";
			$item		= ".post";

			wp_enqueue_script(
				$this->theme_slug.'_iscroll_options',
				get_stylesheet_directory_uri() . '/js/jquery.infinitescroll.cust.js',
				array('jquery', $this->theme_slug.'_iscroll'),
				'20140110',
				true
			);
			wp_localize_script(
				$this->theme_slug.'_iscroll_options',
				$this->theme_slug.'_iscroll_vars',
				array(
					'image'		=> "$img",
					'text'		=> sprintf(__('%s', 'cmw_2014'), $text),
					'finished'	=> sprintf(__('%s', 'cmw_2014'), $finished),
					'functions'	=> "$functions",
					'next'		=> "$next",
					'nav'		=> "$nav",
					'content'	=> "$content",
					'item'		=> "$item"
				)
			);

			// Main Infinite Scroll JS
			wp_register_script( 
				$this->theme_slug.'_iscroll', 
				get_stylesheet_directory_uri() . '/js/jquery.infinitescroll.min.js', 
				array('jquery'),
				20140110,
				true
			);
			wp_enqueue_script($this->theme_slug.'_iscroll');
		}
	}

}
$_iscroll = new CMW_IScroll();
