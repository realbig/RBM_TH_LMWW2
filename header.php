<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

    <title><?php woo_title(); ?></title>
	<?php woo_meta(); ?>
    
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
       
    <!--[if IE 6]>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/pngfix.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/menu.js"></script>
    <![endif]-->
       
    <?php if ( is_single() ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>

</head>

<body <?php body_class('custom'); ?>>
<div id="wrap">
    <div id="top">
    
    	<div id="top-meta">
        
        	<div class="date"><?php echo date( get_option( 'date_format' ) ); ?></div>

             <?php if(get_option('woo_contact_page_id') != "") { ?>
            <div class="contact-link">
            	<a href="<?php echo get_page_link(get_option('woo_contact_page_id')) ?>"><?php _e('Contact us', 'woothemes'); ?></a>
            </div>
            <?php } ?>
        
            <div class="rss">
                <a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><?php _e('Subscribe RSS Feed', 'woothemes'); ?></a>
            </div>
             
             <div class="search">
            
            <form id="topSearch" method="get" action="<?php bloginfo('url'); ?>">
                    
                <p class="fields">
                    <input type="text" value="<?php _e('Search', 'woothemes'); ?>" name="s" id="s" onfocus="if (this.value == '<?php _e('Search', 'woothemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search', 'woothemes'); ?>';}" />
                    <button class="replace" type="submit" name="submit"></button>
                </p>

            </form>
            
            </div>
        </div> 
         
         <!-- Highlights starts -->
         <?php $highlights_tag = get_option('woo_highlights_tag');  ?>      
         <?php if (get_option('woo_highlights_show') == 'true' && !empty($highlights_tag)){ ?>
        <div id="highlights">	  
             
        	<h3><?php _e('Upcoming events', 'woothemes'); ?> &gt;</h3>
            <?php 
            global $wpdb;
            $resulting = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name = '$highlights_tag'");
            $term_id = (int)$resulting;
            ?>
            
            <?php if ($term_id) { ?><span class="more"><a href="<?php echo get_tag_link($term_id); ?>"><?php _e('More Events', 'woothemes'); ?></a></span><?php } ?>            
            <div class="fix"></div>
            
         	<?php 
            $image_height = get_option('woo_hightlights_image_dimentions_height');
            $highlights_limit = 6;
            $highlights_limit = get_option('woo_highlights_tag_amount');   
            $new_posts = get_posts("numberposts=$highlights_limit&post_type=event");
            foreach($new_posts as $post){
		$counter = 0;
             $counter++;
	    $ktitle = get_the_title();
	    $klink = get_permalink();
				?>
            <div class="post <?php if ( $counter == 3 ) { echo 'last'; } ?>">
            	<div class="image">
                	<a title="<?php echo $ktitle; ?>" href="<?php echo $klink; ?>" rel="bookmark"><?php woo_get_image('image','125',$image_height,'thumbnail',90,null,'img'); ?></a>
                </div>
                <div class="content">
                	<p><a title="<?php echo $ktitle; ?>" href="<?php echo $klink; ?>" rel="bookmark"><?php the_title(); ?></a></p>
                	<?php echo eo_get_schedule_start('jS M Y'); ?>
                	
                    <p class="read_more"><a title="<?php echo $ktitle; ?>" href="<?php echo $klink; ?>" rel="bookmark"><?php _e('MORE +', 'woothemes'); ?></a></p>
                </div>
            </div>
            <?php if ( $counter == 3 ) { $counter = 0; echo '<div class="fix"></div>'; } ?> 
            
            <?php } ?>
            
            <div class="fix"></div>
             
        </div>
        <!-- Highlights ends --> 
        
        <?php } ?>  
        	       
        <div id="header">
            
            <div class="logo">
            	<a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php if ( get_option('woo_logo') <> "" ) {  echo get_option('woo_logo'); } else { ?><?php bloginfo('template_directory'); ?>/<?php woo_style_path(); ?>/logo.png<?php } ?>" alt="" /></a>
            </div>
                       
             <?php 
             $ad_yes =     get_option('woo_ad_header');
             $ad_code =      get_option('woo_ad_header_code');
             $ad_image =     get_option('woo_ad_header_image');
             $ad_url =      get_option('woo_ad_header_url');
             
             if($ad_yes == 'true'){
             ?>
            <div id="header-banner-ad">
            <?php 
            if($ad_code != ''){ echo stripcslashes($ad_code); }
            else { 
            ?>
            <a href="<?php echo $ad_url;  ?>" title="<?php _e('Advert', 'woothemes'); ?>"><img class="title" src="<?php echo $ad_image; ?>" alt="" /></a>
            <?php
             } 
             ?>
            </div>
            <?php }
            
            else {
              include (TEMPLATEPATH . '/insert-recent-entries.php');        
            
            } ?>
            
          
            
        </div>
        
        <!-- Page Nav Starts -->
        <div id="top-nav" class="wrap">
            <div class="fl">
				<?php
				if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
					wp_nav_menu( array( 'depth' => 5, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'nav', 'theme_location' => 'primary-menu' ) );
				} else {
				?>
                <ul id="nav">
                <?php 
        		if ( get_option('woo_custom_nav_menu') == 'true' ) {
        			if ( function_exists('woo_custom_navigation_output') )
						woo_custom_navigation_output('depth=3');

					} else { ?>
                
                    <?php if (is_home()) $highlight = "current_page_item";  ?>
                    <li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'woothemes'); ?></a></li>
                    <?php 
					if (get_option('woo_cat_menu') == 'true') 
						wp_list_categories('sort_column=menu_order&depth=3&title_li=&exclude='.get_option('woo_nav_exclude')); 
                    else
						wp_list_pages('sort_column=menu_order&depth=3&title_li=&exclude='.get_option('woo_nav_exclude')); 
					?>
					<?php } ?>
                </ul>
				<?php } ?>
            </div>
        </div>
        <!-- Page Nav Ends -->
        
    </div>

    