<?php
///Rogan's Video Embed Shortcode///
add_shortcode('video_embed', function($atts) {
	$atts = shortcode_atts(
		array(
			'src'    => '',
			'width'  => 600, 
			'height' => 350, 
			'title'  => ''
		), $atts); 

	return ' 
	<div class="interview_video">
		<iframe
			src="' . $atts['src'] . '"
			width="' . $atts['width'] . '" 
			height="' . $atts['height'] . '"  
			frameborder="0"
			allowfullscreen></iframe>
		<h4>' . $atts['title'] . '<h4>
	</div>';
});

?>