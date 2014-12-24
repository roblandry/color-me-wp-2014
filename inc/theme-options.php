<?php
/**
 * Color Me WP 2014 Theme Options Class.
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

class Color_Me_WP_2014_Options {
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
	 * Holds our options.
	 *
	 * @access public
	 * @var array
	 */
	public $options = array();

	/**
	 * Constructor.
	 *
	 * @access public
	 *
	 * @return Color_Me_WP_Options
	 */
	public function __construct() {
echo " ".microtime(true)." ";
		//require( get_stylesheet_directory() . '/inc/chat.php' 			);
echo " ".microtime(true)." ";
		require( get_stylesheet_directory() . '/inc/colors.php'			);
echo " ".microtime(true)." ";
		//require( get_stylesheet_directory() . '/inc/custom-controls.php');
echo " ".microtime(true)." ";
		require( get_stylesheet_directory() . '/inc/feedback.php'		);
echo " ".microtime(true)." ";
		//require( get_stylesheet_directory() . '/inc/infinite-scroll.php');
echo " ".microtime(true)." ";
		require( get_stylesheet_directory() . '/inc/subscribe2.php'		);
echo " ".microtime(true)." ";
		//require( get_stylesheet_directory() . '/inc/web-fonts.php'		);

	}

} # End Class
