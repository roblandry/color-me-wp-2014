<?php
/**
 * Color Me WP 2014 ChildTheme Chat Class.
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

class CMW_Chat {

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

		add_filter( 'the_content', 			array( $this, '_the_content' 		), 9 );
		//add_action( 'wp_enqueue_scripts', array( $this, '_enqueue_scripts' 	) );
		add_action( 'wp_enqueue_scripts', 	array( $this, '_enqueue_styles' 	) );
	}

	/**
	 * Chat Posts
	 *
	 * Since: 
	 *
	 * A function to add post formats to class
	 */
	function _the_content($content) {
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
	 * Enqueue the chat js.
	 *
	 * @since Color Me WP 1.0
	 * @access public
	 *
	 * @return void
	 */
	function _enqueue_scripts(){
		global $tb_chat_animation, $tb_chat_load_script;
		$theme_dir = dirname( get_bloginfo('stylesheet_url') );

		wp_enqueue_script( 'tb-chat-script', $theme_dir.'/js/chat.js', array('jquery'), '', true );

		$data = array(
			'animation' => in_array( $tb_chat_animation, array('slide','fade','none') ) ? $tb_chat_animation : 'none'
		);
		wp_localize_script( 'tb-chat-script', 'tbChat_l10n', $data );
	}

	/**
	 * Enqueue the chat css.
	 *
	 * @since Color Me WP 1.0
	 * @access public
	 *
	 * @return void
	 */
	function _enqueue_styles() {
		global $tb_chat_load_style;
		$theme_dir = dirname( get_bloginfo('stylesheet_url') );
		//if ( !$tb_chat_load_style ) return;

		wp_enqueue_style( 'chat_css', $theme_dir.'/css/bubbles.css', false, '', 'screen' );
	}

}
$_chat = new CMW_Chat();
