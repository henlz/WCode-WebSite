<?php
/**
 * Create CSS file in PHP.
 * The colors defined by admin need to be
 * darker or lighter, PHP do that job.
 */

// inject the header
header("Content-type: text/css");
header("Last-Modified: " . gmdate('D, d M Y H:i:s', 1435701600)." GMT"); // 1435701600 = 1 July 2015

// convert an hex color to an darker/lighter hex color
// @ https://gist.github.com/alexkingorg/1191954
function material_design_par_amauri_luminance($hex, $diff) {
	$rgb = str_split(trim($hex, '# '), 2);

	foreach ($rgb as &$hex) {
		$dec = hexdec($hex);
		if ($diff >= 0) {
			$dec += $diff;
		}
		else {
			$dec -= abs($diff);	
		}
		$dec = max(0, min(255, $dec));
		$hex = str_pad(dechex($dec), 2, '0', STR_PAD_LEFT);
	}

	return '#'.implode($rgb);
}

// get type of color
function material_design_par_amauri_color_type($hexcode)
{
    $redhex  = substr($hexcode,0,2);
    $greenhex = substr($hexcode,2,2);
    $bluehex = substr($hexcode,4,2);
	
    $var_r = (hexdec($redhex)) / 255;
    $var_g = (hexdec($greenhex)) / 255;
    $var_b = (hexdec($bluehex)) / 255;
    
    if($var_r > $var_g AND $var_r > $var_b){$col = 'red';}
    if($var_g > $var_r AND $var_g > $var_b){$col = 'green';}
    if($var_b > $var_r AND $var_b > $var_g){$col = 'blue';}
    
    return $col;
}

// get and sanitize colors
$primary	= $_GET['p'];
$secondary	= $_GET['s'];

if (!preg_match('|^([A-Fa-f0-9]{3}){1,2}$|', $primary) || !preg_match('|^([A-Fa-f0-9]{3}){1,2}$|', $secondary)) {
	exit();
}

// generate and output the css
echo 'body.home article.format-status,body.search article.format-status,body.archive article.format-status{background:#'.$primary.'}.navigation .material_design_par_amauri_navigate{background: #'.$secondary.'}.sticky {background:'.material_design_par_amauri_luminance($secondary, 120).'}a.more-link:hover{background:'.material_design_par_amauri_luminance($secondary, 150).'}a.more-link{background:'.material_design_par_amauri_luminance($secondary, 160).'}h1.entry-title, h1.page-title{visibility:hidden}#first {background-color:#' . $primary.' !important}#back {background:'. material_design_par_amauri_luminance($primary, -17).' !important}.header {background:'. material_design_par_amauri_luminance($primary, -17).' !important}#masthead {background-color:#' . $primary.' !important}#loveit {background-color:#' . $secondary.' !important;transition: background 0.2s ease-in 0s;}#shareit b {color:#' . $primary.' !important}#shareit b {border-color:#' . $primary.' !important}#colophon a, #drawer a, #content a {color:#' . $secondary.' !important;transition: color 0.2s ease-in 0s;}#colophon a:hover, #drawer a:hover, #content a:hover {color:' . material_design_par_amauri_luminance($secondary, -60).' !important}.navigation a:hover .material_design_par_amauri_navigate,input[type="submit"]:hover,#loveit:hover{background-color:' . material_design_par_amauri_luminance($secondary, -60).' !important}textarea {border-color:#' . $secondary.' !important}input {border-color:#' . $secondary.' !important}input[type="submit"] {background-color:#' . $secondary.' !important}.entry-header img {background-color:#' . $secondary.' !important}#positionning {background-color:#'.$primary.'}.chat-text {background:#999}.chat-speak-1 .chat-text{background:#'.$primary.'}';if (material_design_par_amauri_color_type($primary) == 'red') {echo '.chat-speak-2 .chat-text{background:#03A9F4}.chat-speak-3 .chat-text{background:#4CAF50}';}if (material_design_par_amauri_color_type($primary) == 'green') {echo '.chat-speak-2 .chat-text{background:#03A9F4}.chat-speak-3 .chat-text{background:#F44336}';}if (material_design_par_amauri_color_type($primary) == 'blue') {echo '.chat-speak-2 .chat-text{background:#4CAF50}.chat-speak-3 .chat-text{background:#F44336}';}echo '.chat-speak-4 .chat-text{background:#'.$secondary.'}';if (material_design_par_amauri_color_type($secondary) == 'red') {echo '.chat-speak-5 .chat-text{background:#4A9DC3}.chat-speak-6 .chat-text{background:#8BC34A}';}if (material_design_par_amauri_color_type($secondary) == 'green') {echo '.chat-speak-5 .chat-text{background:#4A9DC3}.chat-speak-6 .chat-text{background:#FF4081}';}if (material_design_par_amauri_color_type($secondary) == 'blue') {echo '.chat-speak-5 .chat-text{background:#8BC34A}.chat-speak-6 .chat-text{background:#FF4081}';}