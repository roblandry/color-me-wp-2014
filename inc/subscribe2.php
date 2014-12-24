<?php
/**
 * Color Me WP 2014 ChildTheme Subscribe2 Class.
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

class CMW_Subscribe2 {

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
		$plugin = 'subscribe2/subscribe2.php';
		$active_plugins = get_option( 'active_plugins' );
		if (in_array($plugin,$active_plugins)) {
        	add_action( 'wp_head' ,             array( $this, '_wp_head'			) );
	        add_action( 'wp_enqueue_scripts',   array( $this, '_enqueue_scripts'	) );
	        add_action( 'wp_enqueue_scripts',   array( $this, '_enqueue_styles'		) );
		}
	}

	/**
	 * Adds the Subscribe2 links.
	 *
	 * @access public
	 *
	 * @return void
	 */
    public function _wp_head() {
        global $wpdb;
        $sub_to_opts = get_option("subscribe2_options");
        $s2page = get_site_url().'?page_id='.$sub_to_opts['s2page'];
        $get_var = $wpdb->get_var("SELECT COUNT(id) FROM wp_subscribe2 WHERE active='1'");

        echo "    
            <div id=\"bit\" class=\"\">
                <a class=\"bsub\" href=\"javascript:void(0)\"><span id='bsub-text'>Follow</span></a>
                <div id=\"bitsubscribe\">
                    <h3><label for=\"loggedout-follow-field\">Follow &ldquo;".get_bloginfo('name')."&rdquo;</label></h3>
                    <form action=". $s2page ." method=\"post\" accept-charset=\"utf-8\" id=\"loggedout-follow\">
                        <p>Get every new post on this blog delivered to your Inbox.</p>
                        <p class='bit-follow-count'>Join $get_var other followers:</p>
                        <p>
                            <input type=\"text\" name=\"email\" id=\"s2email\" 
                                style=\"width: 95%; padding: 1px 2px\" value=\"Enter email address\" 
                                onfocus='this.value=(this.value==\"Enter email address\") ? \"\" : this.value;' onblur='this.value=(this.value==\"\") ? \"Enter email address\" : this.value;'  id=\"loggedout-follow-field\"/>
                        </p>
                        <input type=\"hidden\" name=\"ip\" value=".$_SERVER['REMOTE_ADDR'].">
                        <p id='bsub-subscribe-button'>
                            <input type=\"submit\" name=\"subscribe\"  value=\"Sign me up!\" />
                        </p>
                    </form>
                </div>
            </div>";
    }

	/**
	 * Enqueue the subscribe2 js.
	 *
	 * @since Color Me WP 1.0
	 * @access public
	 *
	 * @return void
	 */
	function _enqueue_scripts(){
		wp_register_script( 'cmw_2014-s2-script', 
			get_stylesheet_directory_uri() . '/js/subscribe2.js', 
			array('jquery'), 
			'20130225',
			true );
		wp_enqueue_script( 'cmw_2014-s2-script' );
	}

	/**
	 * Enqueue the subscribe2 css.
	 *
	 * @since Color Me WP 1.0
	 * @access public
	 *
	 * @return void
	 */
	function _enqueue_styles()  { 
		wp_register_style( 'cmw_2014-s2-style', 
			get_stylesheet_directory_uri() . '/css/subscribe2.css', 
			array(), 
			'20130225', 
			'all' );
		wp_enqueue_style( 'cmw_2014-s2-style' );
	}
}
$_Subscribe2 = new CMW_Subscribe2();
