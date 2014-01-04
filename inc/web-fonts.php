<?php
/**
 * Color Me WP 2014 ChildTheme WebFonts Class.
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

class CMW_WebFonts {

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
        add_action( 'wp_enqueue_scripts',   array( $this, '_enqueue_style'		) );
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

		$_arr = array( 'gwf_font_body' => 'Open Sans' );

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
	 * Enqueues the Admin Scripts.
	 *
	 * @access public
	 *
	 * @return void
	 */
    public function _wp_head() {

        $opt = get_option( $this->option_key ); ?>

		<!--Customizer CSS-->
		<style>
			<?php if ($opt['gwf_font_body'] != 'none') { 
				$font = str_replace('+', ' ', $opt['gwf_font_body']);
				?>
				body {font-family: <?php echo $font; ?>; }
			<?php } ?>
		</style> 
		<!--/Customizer CSS--> <?php
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

		$font_list = get_transient( 'gwf4wp_list_' );

		if ( ! is_array( $font_list ) )
		 	$font_list = $this->_get_fonts();

		if ( $font_list ) {

            $wp_customize->add_section( $this->option_key . '_gw_font', array(
                'title' => __( 'Google Web Fonts', 'cmw_2014' ),
                'priority' => 35,
            ) );

			$wp_customize->add_setting( $this->option_key . '[gwf_font_body]', array(
				'default' => 'Open+Sans',
                'type'       => 'option',
				'capability' => 'edit_theme_options'
			) );

			$wp_customize->add_control( $this->option_key . '_gw_font', array(
				'label' => __( 'Body Font ', 'cmw_2014' ),
				'section' => $this->option_key . '_gw_font',
				'type' => 'select',
				'choices' => $font_list,
				'settings' => $this->option_key . '[gwf_font_body]',
				'priority' => 1
			) );

		}
	}

	/**
	 * Get fonts and save transient
	 *
	 * @since 	qwf4wp 3.0
	 * @access	private
	 * @param 	mixed, array or null
	 */
	private function _get_fonts() {

		$font_list = get_transient( 'gwf4wp_list_' );

		if ( $font_list ) return $font_list;

		$raw = @wp_remote_get( 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCP1Zewk9Ba3XboLIjPWdzh6yXcxxxoNRE&sort=alpha' );

		if ( ! isset( $raw ) ) return;

		$clean = @json_decode( $raw[ 'body' ] );

		$font_list[ 'none' ] = 'none';

		if ( is_object( $clean ) )
			foreach ( $clean->items as $item )
				$font_list[ str_replace( ' ',  '+', $item->family ) ] = $item->family;

		set_transient( 'gwf4wp_list_', $font_list, 60 * 60 * 24 );

		return $font_list;
	
	}

	/**
	 * Enqueue fonts stylesheet
	 *
	 * @since 	qwf4wp 3.0
	 * @access	public
	 */
	function _enqueue_style() {
        $opt = get_option( $this->option_key );
        $font = (isset($opt['gwf_font_body'])) ? $opt['gwf_font_body'] : 'none' ;
        if ($font != 'none') {
            wp_enqueue_style( 'gwf_'.$font, 'http://fonts.googleapis.com/css?family='.$font, '', '3.0' );
        }
	}

}
$_webfont = new CMW_WebFonts();
