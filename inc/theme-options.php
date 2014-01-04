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

		require( get_stylesheet_directory() . '/inc/infinite-scroll.php' );
		require( get_stylesheet_directory() . '/inc/web-fonts.php' );
		require( get_stylesheet_directory() . '/inc/colors.php' );
		require( get_stylesheet_directory() . '/inc/feedback.php' );

		add_action( 'customize_register',	array( $this, 'customize_register'  ) );

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

	public function customize_register( $wp_customize ) {

		/**
		 * Donate Button
		 */
		$wp_customize->add_section( $this->option_key . '_donate', array(
			'title'    => __( 'Donate', 'color-me-wp' ),
			'priority' => 200,
		) );

		$wp_customize->add_setting( $this->option_key . '[donate]', array(
			'default'    => '',
			'type'       => 'donate',
		) );

		$wp_customize->add_control( new CMW_Donate_Control(
			$wp_customize, $this->option_key . '_donate', array(
			'label'    => __( 'Donate', 'color-me-wp' ),
			'section'  => $this->option_key . '_donate',
			'settings' => $this->option_key . '[donate]',
			)));

		/**
		 * RSS
		 */
		$wp_customize->add_section( $this->option_key . '_rss', array(
			'title'    => __( 'Theme News', 'color-me-wp' ),
			'priority' => 1,
		) );

		$wp_customize->add_setting( $this->option_key . '[rss]', array(
			'default'    => '',
			'type'       => 'rss',
		) );

		$wp_customize->add_control( new CMW_RSS_Control(
			$wp_customize, $this->option_key . '_rss', array(
			'label'    => __( 'News', 'color-me-wp' ),
			'section'  => $this->option_key . '_rss',
			'settings' => $this->option_key . '[rss]',
			)));

	}

} # End Class


require_once(ABSPATH.'/wp-includes/class-wp-customize-control.php');

class CMW_Select_Control extends WP_Customize_Control {
	
	/**
	 * @access public
	 * @var string
	 */
	public $type = 'cmw_select';

	public function render_content() {
		if ( empty( $this->choices ) )
			return;

		?>
		<label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <select <?php $this->link(); ?>>
                <?php
                foreach ( $this->choices as $value => $label )
                    echo '<option style="font-family: ' . $label . ' " class="'.esc_attr( $value ).'" value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
                ?>
            </select>
        </label><?php
    }
}

class CMW_Donate_Control extends WP_Customize_Control {
	public $type = 'donate';
	public function render_content() { ?>
		<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DNWX23LBQJ5KE" target='_blank'><img src='<?php echo get_stylesheet_directory_uri().'/images/donate.gif'; ?>'></a>
		<?php
	}
}


class CMW_RSS_Control extends WP_Customize_Control {
	public $type = 'donate';
	public function render_content() { ?>
		<table class=widefat cellspacing=5 >
			<thead><tr><th valign=top ><?php _e( 'News', 'color-me-wp' ); ?></th></tr></thead>
			<?php 
			$rss = fetch_feed('http://redmine.landry.me/projects/color-me-wp/news.atom');
			$out = '';
			if (!is_wp_error( $rss ) ) {
				$maxitems = $rss->get_item_quantity(50);     
				$rss_items = $rss->get_items(0, $maxitems);  

				if ($maxitems == 0) {
					$out = "<tr><td>Nothing to see here.</td></tr>";     
				} else {     

					foreach ( $rss_items as $item ) {

						$title = $item->get_title();
						$content = $item->get_content();
						$description = $item->get_description();
						$author = $item->get_author();
						$author = $author->get_name();

						$out .= "<tr><td>";
						$out .= "<a target='_BLANK' href='". $item->get_permalink() ."'  title='Posted ". $item->get_date('j F Y | g:i a') ."'>";
				       		$out .= "$title</a> $description";
						$out .= "</td></tr>";
					} 
				}
			} else {$out = "<tr><td>Nothing to see here.</td></tr>";}
			echo $out; ?>
			<tfoot><tr><th></th></tr></tfoot>
		</table> <?php
	}  
}
