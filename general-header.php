<?php
/*
Plugin Name: General Headers & Footers
Plugin URI: http://www.geekyramblings.net/plugins/general-headers/
Description: Includes standard headers in your posts
Version: 0.5
Author: David Gibbs
Author URI: http://www.geekyramblings.net
*/

$version="0.5";

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

set_magic_quotes_runtime(0);

function genhdr_header() {

	global $version;

	$header = get_option('genhdr_header');

	echo "\n<!-- start general-header header $version -->\n";
	echo $header;
	echo "\n<!-- end general-header header -->\n";
	
}

function genhdr_footer() {

	global $version;

	$footer = get_option('genhdr_footer');

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

<table class="form-table">
 <tr>
        <th scope="row" valign="top">Header:</th>
        <td><textarea name="genhdr_header" cols="80" rows="5"><?php echo get_option('genhdr_header'); ?></textarea></td>
</tr>
<tr>
	<th scope="row" valign="top">Footer:</th>
	<td><textarea name="genhdr_footer" cols="80" rows="5"><?php echo get_option('genhdr_footer'); ?></textarea></td>
</tr>
</table>
        <p class="submit">
        <input type="submit" name="Submit" value="Save Changes" />
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
	// Nothing 

}

function genhdr_deactivate()
{
        // Clean up the options
	delete_option('genhdr_header');
	delete_option('genhdr_footer');
}

add_option('genhdr_header', '<!-- this markup will go between the <head> and </head> tags on every page -->');
add_option('genhdr_footer', '<!-- this markup will go just before the </body> tag on every page -->');
add_filter('wp_head', 'genhdr_header');
add_action('wp_footer', 'genhdr_footer',99);
add_action('admin_menu', 'genhdr_menu');

?>
