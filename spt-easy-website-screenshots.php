<?php 
/**
 * Plugin Name: SpyThemes Easy Website Screenshots.
 * Plugin URI: http://spythemes.com/blog/easy-website-screenshots/
 * Description: Easily generate screenshot of any website. Included shortcode and customizable cache for speed.
 * Version: 1.0
 * Author: Adam Czajczyk
 * Author URI: http://spythemes.com/blog
 * License: GPLv2 or later
 */
 
 /*  Copyright 2015 Adam Czajczyk  (email : adamczajczyk@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined('ABSPATH') or die("No script kiddies please!");

function spt_ews_scripts() {
	wp_enqueue_script('spt-ews-js',plugins_url( '/spt-ews.js' , __FILE__ ),array( 'jquery' ));
	wp_enqueue_style('spt-ews-css',plugins_url('/spt-ews-style.css' , __FILE__));	
}
add_action( 'wp_enqueue_scripts', 'spt_ews_scripts' );


/*** PLUGIN SETTINGS AND OPTIONS PANEL ***/

function spt_sanitize_cache($input) {
	$input_def = 604800;
	if ((intval($input)) AND ($input)>=0) return $input;
	else return $input_def;
}

function spt_sanitize_quality($input) {
	$input_def = 80;
	if ((intval($input)) AND ($input>=0) AND ($input<101)) return $input;
	else return $input_def;
}

add_action( 'admin_init', 'register_spt_ews_settings' );
function register_spt_ews_settings() { 
  register_setting( 'spt_ews-group', 'spt_ews_cache','spt_sanitize_cache' );
  register_setting( 'spt_ews-group', 'spt_ews_quality','spt_sanitize_quality' );
  register_setting( 'spt_ews-group', 'spt_ews_loader' );
}

add_action( 'admin_menu', 'spt_ews_menu' );
function spt_ews_menu() {
	add_options_page( 'SpyThemes Easy Website Screenshot Options', 'Easy Website Screenshots', 'manage_options', 'spt_ews_config', 'spt_ews_options' );
}

function spt_ews_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div style="width:98%;margin:0 auto;">';
	echo '<h1>SpyThemes Easy Website Screenshots</h1>';
	echo '<p>This plugin generates website screenshots.<br /><br />Built-in cache engine preserves bandwidth and speeds up the process.<br/>Customize cache with settings below.</p>';
	echo '<div style="width:100%;display:block;margin:3em auto;overflow:hidden;">';
	echo '<div style="background:#fff;padding:1em;margin:0;border:1px solid gray;width:62%;float:left;clear:none;">
		<div>
			<h2>Settings:</h2>
			<hr />			
			<p>
			<form method="post" action="options.php">';
			settings_fields( 'spt_ews-group' );
			do_settings_sections( 'spt_ews-group' );
	echo '
			<table>
			<tr>
				<td>Max cache time: </td>
				<td><input type="text" name="spt_ews_cache" value="'.esc_attr( get_option('spt_ews_cache') ).'"> seconds</td>
				<td><small>For how long should the screenshots be cached locally? Default: 7 days = 604800 seconds</small><br /><br /></td>
			</tr>
			<tr>
				<td>Image quality: </td>
				<td><input type="text" name="spt_ews_quality" value="'.esc_attr( get_option('spt_ews_quality') ).'"></td>
				<td><small>JPEG quality: 0 - worst, 100 - best; Default: 80</small><br /><br /></td>
			</tr>
			<tr>
				<td>Use loader? </td>
				<td><select name="spt_ews_loader">';
				$spt_ews_loader_set = esc_attr( get_option('spt_ews_loader'));
	echo '
					<option value="N"'; if ($spt_ews_loader_set == 'N') echo 'selected'; echo '>NO</option>
					<option value="Y"'; if ($spt_ews_loader_set == 'Y') echo 'selected'; echo '>YES</option>
					</select>
				</td>
				<td><small>Turn the ajax loader image on/off<br /><br /></small></td>
			</tr>
			</table>			
		';
			submit_button(); 
	echo '</form>
			</p>
		</div>
		';
	
	echo '<hr>';
	echo '<div style="margin:1em 0;">';
	echo '<table><tr><td><strong>Do you like this plugin?<br />Consider buying me a beer :) <br />All donations greatly appreciated!</strong><br /></td><td>';
	?>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="5CSCTL2L6L8YS">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
</form>
	<?php
	echo '</td>
		<td>';?>
		<strong>Share: </strong>
		<ul style="float:right;clear:none;list-style:none">
		<li style="clear:none;float:right;text-align:center;padding:10px;">
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://spythemes.com/blog/easy-website-screenshots/" data-text="Easy way to make website screenshots in WordPress. Check it out." data-via="AdamCzajczyk" data-size="small" data-count="none">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> 
		</li>
		<li style="clear:none;float:right;text-align:center;padding:10px;">
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<div class="g-plusone" data-size="medium" data-annotation="none" data-href="http://spythemes.com/blog/easy-website-screenshots/"></div>
		</li>	
		</ul>
		</div>		
		<?php 
	echo '
		</td>
	</tr></table>';
	echo '</div>
		<br /><br />
		For more information, FAQ and other help please visit: <a href="http://spythemes.com/blog/easy-website-screenshots/" target="_blank">SpyThemes Easy Website Screenshots Home</a><br /><br />
		</div>';
		
		
	echo '<div style="background:#fff;padding:1em;margin:0;border:1px solid gray;width:30%;float:right;clear:none;">
		<p><strong>USAGE: </strong><br /><br />
		place following shortcode anywhere in post/page:<br /><br />
		[spt-shot u="http://google.com" c="3600" q="90" s="myclass"]<br /><br />
		parameters:<br /><br />
		
		u (required) - full website URL<br />
		c (optional) - cache expiration period (in seconds)<br />
		q (optional) - JPEG quality (value from 0 to 100 where 100 is the best)<br />
		s (optional) - custom class for individual screenshot style<br />
		
		c and q parameters may be safely omitted. If not specified plugin will use configuration set on this page and if no configuration is set here the default values will be: 7 days cache expiration date and JPEG quality level 80.<br /><br />
		
		s parameter may be also omitted safely, the plugin will simply apply default style to the screenshot.<br /><br />
		
		<strong>Tips:</strong><br /><br />
		- shortcode parameters override plugin settings<br />
		- using shortcode parameters it is possible to change cache expiration for selected screenshot or disable it completely (just use c="0")<br />
		- to regenerate particular screenshot temporarly set its cache expiration time (c attribute) to something like "0" or "1", update page/post, refresh page with that screenshot (frontend) and change c attribute back to its previous value;
		- you may also set different quality for various screenshots by setting "q" parameter in shortcode<br />
		- if you do not provide proper url the plugin will do literally nothing ;)<br />
	';
	echo '</div>
		</div>
		</div>';
		?>
		@copyright 2015 Adam Czajczyk and <a href="http://spythemes.com/blog/easy-website-screenshots/" target="_blank">SpyThemes</a>
		<?php 
}


/*** MAIN PLUGIN ENGINE ***/

//get website thumbnail from Google Page Insights	
function spt_get_insights($site) {
	if ((!stristr($site,'http://')) AND (!stristr($site,'https://'))) $site = 'http://'.$site;
	$url = 'https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=' . $site. '&screenshot=true';	
	$agent= 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch,CURLOPT_AUTOREFERER, true);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_URL,$url);
	if ($ch):
		$info = json_decode(curl_exec($ch),true);
		$thumb = str_replace('_','/',str_replace('-','+',$info['screenshot']['data']));
		return $thumb;
	else:
		return false;
	endif;
}

//download, cache and serve screenshot
function spt_generate_screenshot($site,$cache_age,$img_quality) {
	
	if (!empty($site)):
	
	$upload_dir = wp_upload_dir();
	$cache_dir = $upload_dir['basedir']."/spt-easy-website-screenshots-cache/"; // set cache directory for screenshots
	$cache_url = $upload_dir['baseurl']."/spt-easy-website-screenshots-cache/"; // set cache directory URL for showing screenshots
		
	if (!is_dir($cache_dir)) mkdir($cache_dir);
	
	$cache_name=$cache_dir.md5($site).'.jpg';
	$done=false;

	if (!file_exists($cache_name)):
		$thumb = spt_get_insights($site);
		if ($thumb):
			$thumb = 'data:image/jpeg;base64,'.$thumb;
			$thumb = @imagecreatefromjpeg($thumb);
			@imagejpeg($thumb,$cache_name,$img_quality);	
			$done = true;
		endif;
	else:
		$done = true;
		$last_cache = filemtime($cache_name);
		$current_time = time();
		if (($last_cache + $cache_age) < $current_time):
			$thumb = spt_get_insights($site);
			if ($thumb):
				$thumb = 'data:image/jpeg;base64,'.$thumb;
				$thumb = @imagecreatefromjpeg($thumb);
				@imagejpeg($thumb,$cache_name,$img_quality);				
			endif;
		endif;
	endif;
		if ($done):
			$site_thumb = $cache_url.md5($site).'.jpg';
			return $site_thumb;
		endif;
	endif;
}

//find all shortcodes, add loader image
function spt_ews_filter($content) {

	// check if to use loader image
	$spt_use_loader = esc_attr( get_option( 'spt_ews_loader' ) );
	if ($spt_use_loader == 'Y') $spt_use_loader = TRUE;
	else $spt_use_loader = FALSE;
	    
    $match_test = preg_match_all('~\[spt-shot.*\]~i', $content, $matches);
	if ($match_test):
		$matches = $matches[0];
		$i=0;
		foreach ($matches as $shortcode) {
			$replacer = ' n='.$i.']';
			$shortcode = str_replace(']',$replacer,$shortcode);
			$shortcode = '<div id="spt-ews-thumb-box-num-'.$i.'" class="spt-ews-thumb-box">' . $shortcode;
			if ($spt_use_loader) $shortcode .= '<img id="spt-ews-thumb-loader-num-'.$i.'" class="spt-ews-thumb-loader" src="'.plugin_dir_url( __FILE__ ).'ajax-loader.gif" alt="Loading website screenshot">';
			$shortcode .= '</div>';
			$shortcodes[] = $shortcode;			
			$i++;
		}
		foreach ($matches as $match) {
			$match=str_replace('[','~\\[',str_replace(']','\\]~i',$match));
			$patterns[]=$match;
		}
		$content = preg_replace($patterns,$shortcodes,$content);
	endif;
	
	return $content;
}
add_filter('the_content','spt_ews_filter',3);


//let's add shortcode
//usage:
//[spt-shot u='' c='' q=''] where u: full website url, c: max cache age (in seconds), q: jpeg quality (0-worst,100-best)
//if any argument ommited default value used
// u MUST be specified; otherwise nothing happens (no value returned)

function spt_ews_shortcode($atts) {
	
	if (!empty($atts['u'])):
	
		$loader = esc_attr($atts['n']);
			
		$site = esc_attr($atts['u']);
		if (!empty($atts['c'])) $cache_age = esc_attr($atts['c']);
		if (!empty($atts['q'])) $img_quality = esc_attr($atts['q']);
		if (!empty($atts['s'])): 
			$custom_class = esc_attr($atts['s']); 
		else:
			$custom_class = '';
		endif;
		if (empty($cache_age)) $cache_age = esc_attr( get_option( 'spt_ews_cache' ) );
		if (empty($img_quality)) $img_quality = esc_attr( get_option( 'spt_ews_quality' ));
		if (empty($cache_age)) $cache_age = 60*60*24*7; // set default max cache age for 7 days
		if (empty($img_quality)) $img_quality = 80; // set default jpeg quality
	
		$nonce = wp_create_nonce( 'spt-ews-plugin' );
	?>
		<script  type='text/javascript'> 
		<!-- 
			jQuery(document).ready(function() {
				sptAjax("<?php echo admin_url( 'admin-ajax.php' );?>", '<?php echo $nonce; ?>', '<?php echo $site;?>', '<?php echo $cache_age;?>', '<?php echo $img_quality;?>', '<?php echo $custom_class;?>', '<?php echo $loader;?>'); 
			});
		--> 
		</script>
	<?php
		
	endif;
}

function register_shortcodes(){
   add_shortcode('spt-shot', 'spt_ews_shortcode');
}
add_action( 'init', 'register_shortcodes');


function get_the_shots_ajax() {
	check_ajax_referer( "spt-ews-plugin" );
	
	$u = $_POST['au'];
	$c = $_POST['ac'];
	$q = $_POST['aq'];
	//$s = $_POST['as'];
	
	$out = spt_generate_screenshot($u,$c,$q);
	$style = "spt-ews-thumb";
	//if (!empty($s)) $style .= " ".$s;
	if (!empty($out)) echo '<img src="'.$out.'" class="'.$style.'">';
	die();
}
add_action( 'wp_ajax_gettheshots', 'get_the_shots_ajax' );
add_action( 'wp_ajax_nopriv_gettheshots', 'get_the_shots_ajax' );
?>