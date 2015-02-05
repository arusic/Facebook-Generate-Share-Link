<?php

// GENERATE SHARE LINK

function generate_share_link($post_id = '', $ref = ""){
	$link_data['user'] = get_current_user_id( );
	$link_data['post'] = $post_id;
	$link_data['ref'] = $ref;
	$ups = serialize($link_data);
	$out = get_permalink($post_id). "?rf=" .encode_something($ups);
	return $out;
}

function encode_something($string) {
	$encrypted = base64_encode ($string);
	return $encrypted;
}

function decode_something($encrypted){
	$decrypted = base64_decode($encrypted);
	return $decrypted;
}

remove_action('wp_head', 'rel_canonical');

function social_share_icons() { ?>
	
	<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=naslov&amp;p[summary]=opis&amp;p[url]=http://reklamnim.dev/&amp;p[images][0]=http://www.reklamnim.dev/wp-content/uploads/2014/09/37.110.10.jpg','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">
	   	<img src="<?php echo get_template_directory_uri() ?>/images/dev_images/facebook_icon.jpg"></a>

	    <a href="http://pinterest.com/pin/create/button/?url={URI-encoded URL of the page to pin}&media={URI-encoded URL of the image to pin}&description={optional URI-encoded description}" class="pin-it-button" count-layout="horizontal" target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes');return false;">
	    <img src="<?php echo get_template_directory_uri() ?>/images/dev_images/pinterest_icon.jpg"></a>
		
		<a class="social_share twitter_share" href="http://twitter.com/share" target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo get_template_directory_uri() ?>/images/dev_images/twitter_icon.jpg"></a>
		
		<a href="https://plus.google.com/share?url={URL}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo get_template_directory_uri() ?>/images/dev_images/googleplus_icon.jpg"></a>
	<?php 	
}

// FACEBOOL POPULARITY


function facebook_popularity($url = ''){

	$pageURL = 'yoursitepage.com';

 	$url = ($url == '' ) ? $pageURL : $url; // setting a value in $url variable
 	$params = 'select comment_count, share_count, like_count, total_count, comments_fbid, commentsbox_count, click_count from link_stat where url = "'.$url.'"';
 	
 	$component = urlencode( $params );
 	$url = 'http://graph.facebook.com/fql?q='.$component;
 	$fbLIkeAndSahre = json_decode( file_get_contents_curl($url) ); 

 ?>