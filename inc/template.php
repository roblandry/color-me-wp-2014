<?php
/**
 * Color Me WP 2014 ChildTheme @TODO Class.
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
// @TODO
class CMW_class {

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
        add_action( 'wp_head' ,             array( $this, '_wp_head'			) );
		add_action( 'customize_register',	array( $this, '_customize_register'	) );
        add_action( 'wp_enqueue_scripts',   array( $this, '_enqueue_scripts'	) );
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

	}

	/**
	 * Enqueues the Admin Scripts.
	 *
	 * @access public
	 *
	 * @return void
	 */
    public function _wp_head() {

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

	}
}
