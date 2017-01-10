<?php get_header(); ?>
 <?php $featured_tag = get_option('woo_featured_tag');  ?>      

    <!-- Content Starts -->
    <div id="content" class="wrap">
            
            <div id="featured_photo" class="threecol_one">
            	<?php
                $image_height =  get_option('woo_featured_image_dimentions_height');  
                $new_posts = get_posts("tag=$featured_tag&numberposts=1"); 
                foreach($new_posts as $post){
                setup_postdata($post);
                ?>
                    <?php woo_get_image('image','293', $image_height); ?>
                    <div><?php echo get_post_meta(get_the_id(),'image_desc',true); ?></div>
            	<?php 
                } ?>  
            </div>
            
            <div class="threecol_two">
            
                <div id="featured_post">
                    <?php  
                    $new_posts = get_posts("tag=$featured_tag&numberposts=1"); 
                    foreach($new_posts as $post){
                    setup_postdata($post);
                     ?>
                       <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                    <?php 
                    } 
                    ?>  
                </div>
            
                <!-- TABS STARTS -->  
                         
                <?php if (get_option('woo_tabs') == 'true' ) { ?>
                
                <div id="tabs" class="block">
                
                    <ul class="idTabs wrap tabs">
                       
                        <li><a href="#commented"><?php _e('Most Commented', 'woothemes'); ?></a></li>
                         <li><a href="#recentcomments"><?php _e('Recent Comments', 'woothemes'); ?></a></li> 
                         <li><a href="#tag_cloud"><?php _e('Tags', 'woothemes'); ?></a></li>
                        
                    </ul>
                    <div class="inside">
                                
                     
                        
                        <ul id="commented">
                            <?php 
                                    global $wpdb, $post; 
                                    $getposts = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY comment_count DESC LIMIT 0,6" );
                                    
                                        foreach($getposts as $thepost) :
                                            $category = get_the_category( $thepost->ID );    
                                    ?>
                                        <li>
                                            <a href="<?php echo get_permalink( $thepost->ID ); ?>"><?php echo get_the_title($thepost->ID); ?></a>
                                        </li>
                                <?php endforeach; ?>                         
                        </ul>
                        
                           <ul id="tag_cloud">
                           <li>
                           <?php wp_tag_cloud('number=15'); ?>
                           </li>            
                        </ul>	
                        
                        
                        <?php 
                        global $wpdb;
                        $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' ORDER BY comment_date_gmt DESC LIMIT 5");
                        ?>
                        <ul id="recentcomments"><?php
                            if ( $comments ) : foreach ( (array) $comments as $comment) :
                            echo  '<li class="recentcomments">' . sprintf(__('%1$s on %2$s'), get_comment_author_link(), '<a href="' . clean_url( get_comment_link($comment->comment_ID) ) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
                            endforeach; endif;?>
                        </ul>

          

                    </div>
                    
                </div>
                <?php } ?>
                
                <!-- TABS ENDS -->
            
            </div><!-- THREECOL_TWO ENDS -->
            
            <div class="threecol_three">
            
                <!-- CATEGORIES MODULE STARTS --> 
                
                <div id="categories-module">
                
               	<?php
                $counter = 1;
                $image_height = get_option('woo_featured_sidebar_image_dimentions_height');
                $featured_limit = 3;
                $featured_limit = get_option('woo_featured_tag_amount');
                $new_posts = get_posts("tag=$featured_tag&showposts=$featured_limit&offset=1&post_type=testimonial"); 
                foreach($new_posts as $post){
                setup_postdata($post);
                $counter++; ?>
               
                        <div class="category-box">
                        
                        	<p class="the-category"><?php the_category(', ') ?></p>
                            
						 	<div class="category-image-block"><?php woo_get_image('image','134',$image_height); ?></div>
                            <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                            <div class="fix"></div>
                         
                 		 </div>
                         
			 	<?php 
                }
                 ?>
                   <?php  if(!empty($featured_tag)){ 
                    global $wpdb;
                    $result = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE slug = '$featured_tag'");
                    $term_id = (int)$result;
                   ?>
                    <p><?php _e('Go to the', 'woothemes'); ?> <a href="<?php echo get_tag_link($term_id); ?>"><?php _e('Archives', 'woothemes'); ?></a> <?php _e('to see more entries', 'woothemes'); ?></p>	
                    <?php } ?>
                        
                </div> <!-- CATEGORIES MODULE ENDS --> 
            
            </div><!-- THREECOL_THREE ENDS -->
             
             <?php if(get_option('woo_also_slider_enable') == 'true'){ ?>   
            
          
            <div class="hr"></div>
            
            <div id="also">
            	
               <div id="also-header">
               		<h3><?php echo get_option('woo_slider_heading'); ?></h3>
                    <div class="carousel-nav">
                    	<img class="back" src="<?php bloginfo('template_directory'); ?>/images/carousel_back_button.gif" alt="<?php _e('Previous Posts', 'woothemes'); ?>" />
                        <img class="next" src="<?php bloginfo('template_directory'); ?>/images/carousel_next_button.gif" alt="<?php _e('Next Posts', 'woothemes'); ?>" />
                    </div>
                    <div class="fix"></div>
                </div>
                <div id="categories-crop">  
                <div id="categories-slider">
                <?php
                $counter = 0;
                $image_height = get_option('woo_also_slider_image_dimentions_height');  
                 

                 $featured_tag = get_option('woo_featured_tag'); 
                 $highlights_tag = get_option('woo_highlights_tag');
                 
                 $featured_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name = '$featured_tag'"); 
                 $highlights_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name = '$highlights_tag'"); 
                 
                 
                 
                 $offset = 3;
                 $ad_yes =     get_option('woo_ad_header');
                 if($ad_yes == 'true') {$offset = 0;}
                 
                   
                 $new_posts = get_posts(array(
                     'tag__not_in' => array($featured_id,$highlights_id),
                      'showposts' => 25,
                      'offset' => $offset,
                      'order' => 'DESC'
                      )
                  );
                
                //$new_posts = get_posts("tag=$featured_tag&numberposts=25&offset=$counter");  // Continue with Featured Posts
                
                foreach($new_posts as $post){
                //setup_postdata($post);
                $counter++; 

               ?>
               
                        <div class="panel">
                        
                        	<p class="the-category"><?php the_category(', ') ?></p>
                            
						 	<div class="panel-image"><?php woo_get_image('image','147',$image_height); ?></div>
                            <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                            <div class="fix"></div>
                         
                         </div>
                         
                         <?php 
                         
                         }
                           ?>
                        
                </div> <!-- CATEGORIES MODULE ENDS -->
                </div>
                
            </div><!-- also ends -->
            
            <?php } ?> 
            
			<div class="hr"></div>
            

            <?php  include (TEMPLATEPATH . '/ad-leaderboard-footer.php'); ?>
          
            <div id="bottom">
                <div id="col_one">
                	<div class="featured_article">
                	    <!-- Add you sidebar manual code here to show above the widgets -->

                        <?php if (function_exists('woo_sidebar') && woo_sidebar('home-1') )  ?>                   

                        <!-- Add you sidebar manual code here to show below the widgets -->
                    </div>
                </div>
                
                <div id="col_two">
                <!-- Add you sidebar manual code here to show above the widgets -->

                    <?php if (function_exists('woo_sidebar') && woo_sidebar('home-2') )  ?>                   

                    <!-- Add you sidebar manual code here to show below the widgets -->
                </div>
                
                <div id="col_three">
                	
                    <!-- Add you sidebar manual code here to show above the widgets -->

            		<?php if (function_exists('woo_sidebar') && woo_sidebar('home-3') )  ?>		           

					<!-- Add you sidebar manual code here to show below the widgets -->
                    
                </div>
                
                <div id="col_four">
                
                	<!-- Add you sidebar manual code here to show above the widgets -->

            		<?php if (function_exists('woo_sidebar') && woo_sidebar('home-4') )  ?>		           

					<!-- Add you sidebar manual code here to show below the widgets -->
                
                </div>
                
            </div>

    </div><!-- Content Ends -->
		
<?php get_footer(); ?>