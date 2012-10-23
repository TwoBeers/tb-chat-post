<?php
/*
Plugin Name: TB Chat Post
Plugin URI: https://github.com/TwoBeers/tb-chat-post
Description: The plugin will take any content inside a chat-format post, automatically format it and apply a specific style and animation
Author: Jimo
Author URI: http://jimo.twbrs.net/
Version: 1.2
License: GNU General Public License, version 2
License URI: http: //www.gnu.org/licenses/gpl-2.0.html
*/

$tb_chat_load_style = true; // options: true, false
$tb_chat_load_script = true; // options: true, false
$tb_chat_animation = 'slide'; // options: 'slide', 'fade', 'none'

add_action( 'after_setup_theme', 'tb_chat_setup', 11 ); // tell WordPress to run tb_chat_setup() when the 'after_setup_theme' hook is run.

function tb_chat_setup(){
	$supportedTypes = get_theme_support( 'post-formats' );

	if( $supportedTypes === false )
		add_theme_support( 'post-formats', 'chat' );
	elseif( is_array( $supportedTypes ) )
		{
			$supportedTypes[0][] = 'chat';
			add_theme_support( 'post-formats', $supportedTypes[0] );
		}
}

function tb_chat_post($content) {
	global $post;

	static $instance = 0;
	$instance++;

	if ( has_post_format('chat') && is_singular() ) {
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
				$chatoutput = $chatoutput . "<li class=\"$row_class\"><span class=\"name\">$who</span><span class=\"text\">$what</span></li>";
			} else {
				// the string didn't contain a needle. Displaying anyway in case theres anything additional you want to add within the transcript
				$chatoutput = $chatoutput . '<li class="aside-text">' . $haystack . '</li>';
			}
		}
		$speakers_select = '';
		foreach ($speakers as $key => $speaker) {
			$key = $key + 1;
			$speakers_select = $speakers_select . "<li class=\"speaker-$key\"><span class=\"name\">$speaker</span><span class=\"hide\">[-]</span><span class=\"show\">[+]</span><span class=\"toleft\">[&lt;]</span><span class=\"toright\">[&gt;]</span></li> ";
		}
		$speakers_select = '<ul class="chat-select">' . $speakers_select . '</ul>';
		$chat_before = '<ul class="chat-transcript' . ' speakers-' . count( $speakers ) . '">';
		$chat_after = '</ul>';
		// print our new formated chat post
		$content = '<div id="chat-' . $instance . '" class="tb-chat">' . $speakers_select . $chat_before . $chatoutput . $chat_after . '</div>';
		return $content;
	} else {
		add_filter ('the_content',  'wpautop');
		return $content;
	}
}
add_filter( "the_content", "tb_chat_post", 9);

// add scripts
function tb_chat_js(){
	global $tb_chat_animation, $tb_chat_load_script;

	if ( !$tb_chat_load_script ) return;

	wp_enqueue_script( 'tb-chat-script', plugins_url('tb-chat-post/script.js'), array('jquery'), '', true );

	$data = array(
		'animation' => in_array( $tb_chat_animation, array('slide','fade','none') ) ? $tb_chat_animation : 'none'
	);
	wp_localize_script( 'tb-chat-script', 'tbChat_l10n', $data );

}
add_action( 'wp_enqueue_scripts', 'tb_chat_js' ); // Add js scripts

// add style
function tb_chat_css(){
	global $tb_chat_load_style;

	if ( !$tb_chat_load_style ) return;

	wp_enqueue_style( 'tb-chat-style', plugins_url('tb-chat-post/style.css'), false, '', 'screen' );

}
add_action( 'wp_enqueue_scripts', 'tb_chat_css' ); // Add css stylesheet

?>