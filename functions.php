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

/**
 * @TODO Rename class
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

		// Load up our theme options page and related code.
		require( get_stylesheet_directory() . '/inc/theme-options.php' );
		$_options = new Color_Me_WP_2014_Options();

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_theme_textdomain' ) );

		add_action( 'admin_init', 			array( $this, '_options_init' ));
		//add_action( 'admin_menu', 		array( $this, '_options_add_page' )); 
		add_action( 'twentyfourteen_credits', array( $this, '_credits' ));
		//add_action( 'after_setup_theme', 	array( $this, '_setup' ));
		add_action( 'wp_head', 				array( $this, '_wp_head' ));
		add_filter( 'the_content', 			array( $this, '_chat_post' ), 9 );

		add_action( 'wp_enqueue_scripts',	array( $this, '_dequeue_fonts' ), 11 );
		add_action( 'wp_enqueue_scripts', 	array( $this, '_enqueue_styles' ));
		//add_action( 'wp_enqueue_scripts', array( $this, '_chat_js' )); // Add js scripts
		add_action( 'wp_enqueue_scripts', 	array( $this, '_chat_css' )); // Add css stylesheet
		add_action( 'wp_enqueue_scripts', 	array( $this, '_enqueue_fonts' ));


		add_filter('dynamic_sidebar_params', array( $this, 'widget_before_after'));
		add_filter( 'the_content', array( $this, 'my_the_content_filter' ), 20 );
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
	 * Options Init
	 *
	 * Since: 0.1.0
	 *
	 * A function to add support for all post formats.
	 */
	function _options_init(){
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	} 

	/**
	 * Theme Options add page
	 *
	 * Since: 0.1.0
	 *
	 * A function to add the theme options page
	 */
	function _options_add_page() {
		$page = add_theme_page( 
			__( 'Theme Options', 'cmw_theme' ), 
			__( 'Theme Options', 'cmw_theme' ), 
			'edit_theme_options', 
			'theme-options', 
			'cmw_options_do_page' );
		add_action( 'admin_print_styles-' . $page, 'cmw_admin_scripts' );
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

	/*
	 * @since Twenty Twelve 1.0
	 */
	//function _setup() {
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

//$(document).ready(function(){
	        echo "<script>
			jQuery(document).ready(function($){
	        
	            $(\"address\").each(function(){                         
	                var embed =\"<iframe width='425' height='350' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='https://maps.google.com/maps?&amp;q=\"+ encodeURIComponent( $(this).text() ) +\"&amp;output=embed'></iframe>\";
	                $(this).html(embed);
	            });
	        });
	        </script>";

	        //include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	        $plugin = 'subscribe2/subscribe2.php';
	        $active_plugins = get_option( 'active_plugins' );
	        if (in_array($plugin,$active_plugins)) {
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
	}

	/**
	 * Chat Posts
	 *
	 * Since: 
	 *
	 * A function to add post formats to class
	 */
	function _chat_post($content) {
		global $post;

		static $instance = 0;
		$instance++;

		if ( has_post_format('chat') ){//&& is_singular() ) {
			remove_filter ('the_content',  'wpautop');
			$chatoutput = '';
			$split = preg_split("/(\r?\n)+|(<br\s*\/?>\s*)+/", $content);
			$speakers = array();
			$row_class_ov = 'odd';
			foreach($split as $haystack) {
				if (strpos($haystack, ':')) {
					$string = explode(':', trim($haystack), 2);
					$who = strip_tags(trim($string[0]));
					if ( !in_array( $who, $speakers ) ) {
						$speakers[] = $who;
						$speaker_key = count( $speakers );
					} else {
						$speaker_key = array_search( $who, $speakers ) + 1;
					}
					$what = strip_tags(trim($string[1]));
					$row_class_ov = ( $row_class_ov == 'even' )? 'odd' : 'even';
					$row_class = $row_class_ov . ' speaker-' . $speaker_key;
					$chatoutput = $chatoutput . "<p class=\"$row_class triangle-obtuse left\"><span class=\"name\">$who:</span><span class=\"text\">$what</span></p>";
				} else {
					// the string didn't contain a needle. Displaying anyway in case theres anything additional you want to add within the transcript
					$chatoutput = $chatoutput . '<li class="aside-text">' . $haystack . '</li>';
				}
			}
			$speakers_select = '';
			foreach ($speakers as $key => $speaker) {
				$key = $key + 1;
				$speakers_select = $speakers_select . "<p class=\"speaker-$key\"><span class=\"name\">$speaker</span><span class=\"hide\">[-]</span><span class=\"show\">[+]</span><span class=\"toleft\">[&lt;]</span><span class=\"toright\">[&gt;]</span></p> ";
			}
			$speakers_select = '';//<ul class="chat-select">' . $speakers_select . '</ul>';
			$chat_before = '<div class="chat-transcript' . ' speakers-' . count( $speakers ) . '">';
			$chat_after = '</div>';
			// print our new formated chat post
			$content = '<div id="chat-' . $instance . '" class="tb-chat">' . $speakers_select . $chat_before . $chatoutput . $chat_after . '</div>';
			return $content;
		} else {
			add_filter ('the_content',  'wpautop');
			return $content;
		}
	}

	/**
	 * add scripts
	 */
	function _chat_js(){
		global $tb_chat_animation, $tb_chat_load_script;
		$theme_dir = dirname( get_bloginfo('stylesheet_url') );
		//if ( !$tb_chat_load_script ) return;

		wp_enqueue_script( 'tb-chat-script', $theme_dir.'/js/chat.js', array('jquery'), '', true );

		$data = array(
			'animation' => in_array( $tb_chat_animation, array('slide','fade','none') ) ? $tb_chat_animation : 'none'
		);
		wp_localize_script( 'tb-chat-script', 'tbChat_l10n', $data );
	}

	/**
	 * add style
	 */
	function _chat_css() {
		global $tb_chat_load_style;
		$theme_dir = dirname( get_bloginfo('stylesheet_url') );
		//if ( !$tb_chat_load_style ) return;

		wp_enqueue_style( 'chat_css', $theme_dir.'/css/bubbles.css', false, '', 'screen' );
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
	 * 
	 */
	function _enqueue_styles()  { 
		// Register the style like this for a theme:  
		// (First the unique name for the style (custom-style) then the src, 
		// then dependencies and ver no. and media type)
		/*wp_register_style( 'color-me-wp-style', 
			get_stylesheet_directory_uri() . '/css/display.css.php', 
			array('twentytwelve-style'), 
			'20120208', 
			'all' );
		wp_enqueue_style( 'color-me-wp-style' );*/

		$plugin = 'subscribe2/subscribe2.php';
		$active_plugins = get_option( 'active_plugins' );
		if (in_array($plugin,$active_plugins)) {
			//if (is_plugin_active('subscribe2/subscribe2.php')) {
			wp_register_style( 'color-me-wp-s2-style', 
				get_stylesheet_directory_uri() . '/css/subscribe2.css', 
				array(), 
				'20130225', 
				'all' );
			wp_enqueue_style( 'color-me-wp-s2-style' );

			wp_register_script( 'color-me-wp-s2-script', 
				get_stylesheet_directory_uri() . '/js/subscribe2.js', 
				array('jquery'), 
				'20130225',
				true );
			wp_enqueue_script( 'color-me-wp-s2-script' );
		}
	}

	/**
	 * Enqueue fonts stylesheet
	 *
	 * @since 	qwf4wp 3.0
	 *
	 * @access	public
	 */
	function _enqueue_fonts() {
		$options = get_option( $this->theme_slug . '_options' );
		$font = (isset($options['gwf_font_body'])) ? $options['gwf_font_body'] : 'none' ;
		if ($font != 'none')
			wp_enqueue_style( 'gwf_'.$font, 'http://fonts.googleapis.com/css?family='.$font, '', '3.0' );
	}


	function widget_before_after($params){

		$before = $params[0]['before_widget'];
		$params[0]['before_widget'] = $before . '<div class=\'widget_wrapper\'>';
		$after = $params[0]['after_widget'];
		$params[0]['after_widget'] = '</div>' . $after;

		return $params;
	}


/**
 * Add a icon to the beginning of every post page.
 *
 * @uses is_single()
 */
function my_the_content_filter( $content ) {

	$content = str_replace('Proudly powered by WordPress', '', $content);

    // Returns the content.
    return $content;
}

}

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

