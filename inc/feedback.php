<?php
/**
 * Color Me WP 2014 ChildTheme FeedBack Class.
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

class CMW_Feedback {

	/**
	 * Constructor.
	 *
	 * @access public
	 *
	 * @return Color_Me_WP_Options
	 */
	public function __construct() {
		$script = $_SERVER['SCRIPT_NAME'];
		if (strpos($script, 'customize.php') !== false || strpos($script, 'themes.php') !== false) {
            add_action('admin_print_scripts', array( $this, '_wp_head' ) );
		}
	}

	/**
	 * Enqueues the Admin Scripts.
	 *
	 * @access public
	 *
	 * @return void
	 */
    public function _wp_head() { ?>
        <script type="text/javascript">
            var head  = document.getElementsByTagName("head")[0];
            var link  = document.createElement("link");
                link.rel  = "stylesheet";
                link.type = "text/css";
                link.href = "http://feedback.landry.me/public/themes/default/assets/css/widget.css";
                link.media = "all";head.appendChild(link);
			var mystyle = document.createElement("style");mystyle.type = "text/css";
			var mystyletxt = document.createTextNode(".l-ur-body{z-index:999999;}");mystyle.appendChild(mystyletxt);head.appendChild(mystyle);
        </script>
        <script type="text/javascript">widget = {url:'http://feedback.landry.me/'}</script>
        <script src="http://feedback.landry.me/public/assets/modules/system/js/widget.js" type="text/javascript"></script>
        <a class="widget-tab widget-tab-right w-round w-shadow" 
            style="margin-top:-52px;background-color:#4F2D92;border-color:#FFF830;z-index: 999999;" 
            title="Feedback" href="javascript:popup('widget', 'http://feedback.landry.me/widget', 600, 400);"  >
            <img width="15" alt="" src="http://feedback.landry.me/public/files/logo/widget-text-default.png" />
        </a> <?php

    }

}
$_feedback = new CMW_Feedback();
