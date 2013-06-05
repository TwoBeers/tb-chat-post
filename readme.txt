=== TB Chat Post ===
Contributors: tbcrew
Tags: chat
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 1.3
License: GNU General Public License, version 2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Styles the content of chat-format posts.

== Description ==

The plugin will take any content inside a chat-format post, automatically format it and apply a specific style and animation. It will work automatically as long as your chat transcripts are formatted in a <strong>Name: Message</strong> structure.

== Installation ==

1. Upload the directory 'tb-chat' to the '/wp-content/plugins/' directory or install the plugin directly with the 'Install' function in the 'Plugins' menu in WordPress
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Does it have an admin page where to set some options? =

Nop! If you want to change something, you have to edit the files (usually code.php).

== Changelog ==

= 1.3 =
* added support for "whatsapp" chat transcript (format `hh:mm d m - %name%: %text%`).

= 1.2 =
* renamed/added some classes

= 1.1 =
* add post-format 'chat' support (for themes that don't support). source http://wordpress.stackexchange.com/questions/23839/using-add-theme-support-inside-a-plugin

= 1.0 =
* first release.
