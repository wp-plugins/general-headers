<?php
/*
Plugin Name: General Header
Plugin URI: http://www.geekyramblings.org/plugins/wp-tags-to-technorati/
Description: Includes standard headers in your posts
Version: 0.2
Author: David Gibbs
Author URI: http://www.geekyramblings.org
*/

/*

    Copyright 2007-2008 by David Gibbs <david@midrange.com>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/*

Date		Rev	Modification
12/23/07	0.1	Initital version	
 1/31/08	0.2	Added footer functionality

*/

set_magic_quotes_runtime(0);

function genhdr_header() {

	$header = get_option('genhdr_header');
	$version = get_option('genhdr_version');

	echo "\n<!-- start general-header header $version -->\n";
	echo $header;
	echo "\n<!-- end general-header header -->\n";
	
}

function genhdr_footer() {

	$footer = get_option('genhdr_footer');
	$version = get_option('genhdr_version');

	echo "\n<!-- start general-header footer $version -->\n";
	echo $footer;
	echo "\n<!-- end general-header footer -->\n";
	
}

function genhdr_options_menu() {

	?>
	<div class="wrap">
	<h2>General Header & Footers</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>

	<h3>Header:</h3><p/>
 <textarea name="genhdr_header" cols="80" rows="5"><?php echo get_option('genhdr_header'); ?></textarea></ <p/>

	<p/>
	<h3>Footer:</h3><p/>
 <textarea name="genhdr_footer" cols="80" rows="5"><?php echo get_option('genhdr_footer'); ?></textarea></ <p/>

        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options &raquo;') ?>" />
        </p>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="genhdr_header,genhdr_footer"/>
	</form>
	</div>
	<?php 

}

function genhdr_menu(){
    add_options_page('General Header', 'General Header', 8, __FILE__, 'genhdr_options_menu');
}

function genhdr_activate()
{
        // Let's add some options
	// add_option('genhdr_label', 'Technorati Tags');

}

function genhdr_deactivate()
{
        // Clean up the options
	delete_option('genhdr_header');
	delete_option('genhdr_footer');
}

add_option('genhdr_header', '<!-- this markup will go between the <head> and </head> tags on every page -->');
add_option('genhdr_footer', '<!-- this markup will go just before the </body> tag on every page -->');
add_option('genhdr_version', '0.1');
add_filter('wp_head', 'genhdr_header');
add_action('wp_footer', 'genhdr_footer',99);
add_action('admin_menu', 'genhdr_menu');

// add_action('activate_wp-tags-to-technorati/wp-tags-to-technorati.php',
// 	'genhdr_activate');
// add_action('deactivate_wp-tags-to-technorati/wp-tags-to-technorati.php',
// 	'genhdr_deactivate');

?>
