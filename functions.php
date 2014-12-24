<?php
/*
	Color Me Wp 2014 - functions.php
	Copyright (c) 2012 by Rob Landry

	GNU General Public License version 3

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class CMW2014 {
	/**
	 * Theme version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

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
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the theme by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load up our theme options.
		require( get_stylesheet_directory() . '/inc/chat.php' 			);
		require( get_stylesheet_directory() . '/inc/colors.php'			);
		require( get_stylesheet_directory() . '/inc/custom-controls.php');
		require( get_stylesheet_directory() . '/inc/feedback.php'		);
		require( get_stylesheet_directory() . '/inc/infinite-scroll.php');
		require( get_stylesheet_directory() . '/inc/subscribe2.php'		);
		require( get_stylesheet_directory() . '/inc/web-fonts.php'		);

		// Load plugin text domain
		add_action( 'init',						array( $this, 'load_theme_textdomain'	) );
		add_action( 'admin_init',				array( $this, '_admin_init' 			) );
		//#add_action( 'admin_menu',				array( $this, '_admin_menu' 			) ); 
		add_action( 'twentyfourteen_credits',	array( $this, '_credits'				) );
		//#add_action( 'after_setup_theme',		array( $this, '_after_setup_theme' 		) );
		add_action( 'wp_head',					array( $this, '_wp_head' 				) );
		//#add_action( 'wp_enqueue_scripts',		array( $this, '_dequeue_fonts' 			), 11 );
		add_action( 'wp_enqueue_scripts',		array( $this, '_enqueue_scripts' 		) );
		add_action( 'wp_enqueue_scripts',		array( $this, '_enqueue_styles' 		) );
		add_filter( 'dynamic_sidebar_params',	array( $this, 'widget_before_after'		) );
		add_filter( 'the_content',				array( $this, '_the_content' 			), 20 );
		add_filter( 'get_avatar',				array( $this, '_get_avatar'				) );

	}

	/**
	 * Return the theme slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Theme slug variable.
	 */
	public function get_theme_slug() {
		return $this->theme_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_theme_textdomain() {

		$domain = $this->theme_slug;
		$locale = apply_filters( 'theme_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );

	}

	/**
	 * Options Init
	 *
	 * Since: 0.1.0
	 *
	 * A function to add support for all post formats.
	 */
	function _admin_init(){
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	} 

	/**
	 * Twenty Twelve Credits
	 *
	 * Since: 0.1.0
	 *
	 * A function to add the copyright to the footer
	 */
	function _credits() {
		$year = date("Y");
		$previousyear = $year -1;
		$bloginfo = get_bloginfo( 'name', 'display' );
		echo "<div class=copyright>Copyright &copy; <a href='".site_url()."'>$bloginfo</a> $previousyear - $year</div>";
	}

	/*
	 * @since Twenty Twelve 1.0
	 */
	//function _after_setup_theme() {
		//global $color_me_wp_options;

	 	/*
     	 * Makes Twenty Twelve available for translation.
     	 *
    	 */
     	//load_theme_textdomain( 'color-me-wp', get_template_directory() . '/languages' );
     
	 	// This theme styles the visual editor with editor-style.css to match the theme style.
     	//add_editor_style();
	//}


	/**
	 * Wp Head
	 *
	 * Since: 0.1.0
	 *
	 * A function to add the styles to the wp_head
	 */
	function _wp_head() {
		echo '<!DOCTYPE html>';
        $hashedEmail = md5(strtolower(trim(get_option('admin_email'))));
        $icon = 'http://www.gravatar.com/avatar/' . $hashedEmail . '?s=16';
        echo "<link rel='shortcut icon' href='$icon' />";
	}

	/**
	 * Dequeue Fonts
	 *
	 * Since: 0.1.0
	 *
	 * A function to remove the TwentyTwelve Font
	 */

	function _dequeue_fonts() {
		wp_dequeue_style( 'twentytwelve-fonts' );
	}

	/**
	 * Enqueue Google Map JS
	 *
	 * @since 	1.0
	 *
	 * @access	public
	 */
	function _enqueue_scripts() {
		wp_register_script( 'cmw_2014-maps-script', 
			get_stylesheet_directory_uri() . '/js/maps.js', 
			array('jquery'), 
			'20140120',
			true );
		wp_enqueue_script( 'cmw_2014-maps_script' );
	}

	/**
	 * Enqueue fonts stylesheet
	 *
	 * @since 	qwf4wp 3.0
	 *
	 * @access	public
	 */
	function _enqueue_styles() {
		$options = get_option( $this->theme_slug . '_options' );
		$font = (isset($options['gwf_font_body'])) ? $options['gwf_font_body'] : 'none' ;
		$g_font = 'http://fonts.googleapis.com/css?family='.$font;
		if ($font != 'none')
			wp_enqueue_style( 'gwf_'.$font, $g_font, '', '3.0' );
	}


	function widget_before_after($params){

		$before = $params[0]['before_widget'];
		$params[0]['before_widget'] = $before . '<div class=\'widget-wrapper\'>';
		$after = $params[0]['after_widget'];
		$params[0]['after_widget'] = '</div>' . $after;

		return $params;
	}


	/**
	 * Add a icon to the beginning of every post page.
	 *
	 * @uses is_single()
	 */
	function _the_content( $content ) {

		$content = str_replace('Proudly powered by WordPress', '', $content);

	    // Returns the content.
	    return $content;
	}

	function _get_avatar($class) {
		$class = str_replace("class='avatar", "class='author_gravatar alignleft", $class) ;
		return $class;
	}

}

$content_width = 900;
add_action( 'init', array( 'CMW2014', 'get_instance' ) );

	/**
	 * TwentyTwelve Entry Meta
	 *
	 * Since: 0.1.0
	 *
	 * A function to style the Entry Meta
	 *
	 * Overrides the Default TwentyTwelve Style
	 *
	 * @TODO Find TwentyFourteen entry meta
	 */
	function _entry_meta() {
		echo "<hr class=style-one>";
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

		$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
			get_the_author()
		);

		// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
		$utility_text = '';
		if ( $tag_list ) {
			$utility_text .= __('<div><span class="categories-links">%1$s</span></div>', 'twentytwelve' );
			$utility_text .= __('<div><span class="tags-links">%2$s</span></div>', 'twentytwelve' );
		} elseif ( $categories_list ) {
			$utility_text .= __('<div><span class="categories-links">%1$s</span></div>', 'twentytwelve' );
		}

		$utility_text .= __('<div><span class="date">%3$s</span></div>', 'twentytwelve' );
		$utility_text .= __('<div>%4$s</div>', 'twentytwelve' );

		printf(
			$utility_text,
			$categories_list,
			$tag_list,
			$date,
			$author
		);
	}
