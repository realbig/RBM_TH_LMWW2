<?php
/*
Template Name Posts: Veterans
*/
?>

<?php get_header(); ?>
       
    <!-- Content Starts -->
    <div id="content" class="wrap">
		<div class="col-left">
			<div id="main">
            
            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
                <!-- Post Starts -->
                <div class="post wrap">

                    <h1 class="post-title"><?php the_title(); ?></h1>
                    <p class="post-details"><?php echo(types_render_field("service", array("show_name"=>"true"))); ?><span class="mil-unit"><?php echo(types_render_field("unit", array("show_name"=>"true"))); ?></span></p>
                    <div class="veteran-pic"><?php echo(types_render_field("veteran-photo", array("show_name"=>"false"))); ?></div>
                    <?php 
                     if (get_option('woo_single_image') == "true") {
 						$w = get_option('woo_single_post_image_width'); 
						$h = get_option('woo_single_post_image_height'); 
						woo_get_image('image',$w,$h); 
					 }
					 the_content();
					 ?>
					 <div class="fix"></div>  
					 <?php 
					 the_tags('<p class="tags">Tags: ', ', ', '</p>'); 
					 ?>
					
					

                </div>
                <!-- Post Ends -->
                                                    
			<?php endwhile; else: ?>
                <p><?php _e('Sorry, no posts matched your criteria.', 'woothemes'); ?></p>
            <?php endif; ?>  
        
            </div><!-- main ends -->
        </div><!-- .col-left ends -->

        <?php get_sidebar(); ?>

    </div><!-- Content Ends -->
		
<?php get_footer(); ?>