<?php
/*
Plugin Name: General Header
Plugin URI: http://www.geekyramblings.org/plugins/general-headers/
Description: Includes arbitary static headers in all pages
Version: 0.1
Author: David Gibbs
Author URI: http://www.geekyramblings.org
*/

/*

    Copyright 2007 by David Gibbs <david@midrange.com>

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

*/

set_magic_quotes_runtime(0);

function genhdr_header() {

	genhdr_checkupgrade();

	$header = get_option('genhdr_header');
	$version = get_option('genhdr_version');

	echo "\n<!-- start general-header $version -->\n";
	echo $header;
	echo "\n<!-- end general-header -->\n";
	
}

function genhdr_options_menu() {

	?>
	<div class="wrap">
	<h2>General Header</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>

	Headers:<p/>
 <textarea name="genhdr_header" cols="80" rows="5"><?php echo get_option('genhdr_header'); ?></textarea></ <p/>

        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options &raquo;') ?>" />
        </p>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="genhdr_header"/>
	</form>
	</div>
	<?php 

}

function genhdr_menu(){
    add_options_page('General Header', 'General Header', 8, __FILE__, 'genhdr_options_menu');
}

function genhdr_activate() {
        // Let's add some options
	// add_option('genhdr_label', 'Technorati Tags');

}

function genhdr_deactivate() {
        // Clean up the options
	delete_option('genhdr_header');
}

function genhdr_checkupgrade() {

        $last_version = get_option('tags2tech_version');
        $current_version = $tags2tech_version;
        echo "<!-- last_version = $last_version, current_version = $current_version -->\n";
        if ($current_version > $last_version) {
                echo "<!-- upgrading to $tags2tech_version -->\n";
                update_option('genhdr_version',$genhdr_version);
        }

}

add_option('genhdr_header', '<!-- add your custom headers here -->');
add_option('genhdr_version', '0.1');
add_filter('wp_head', 'genhdr_header');
add_action('admin_menu', 'genhdr_menu');

add_action('activate_general-headers/general-headers.php',
	'genhdr_activate');
add_action('deactivate_general-headers/general-headers.php',
	'genhdr_deactivate');

?>
