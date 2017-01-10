	<!-- footer Starts -->
           
	<div id="footer" class="wrap">
    
    	<ul id="category-nav">
			<?php wp_list_categories('sort_column=menu_order&depth=1&title_li=&exclude='.get_option('woo_nav_exclude')); ?>
        </ul>
        
        <div class="fix"></div>
        
        <ul id="page-nav">
			<?php wp_list_pages('sort_column=menu_order&depth=1&title_li=&exclude='.get_option('woo_nav_exclude')); ?>
        </ul>
        
        <div class="fix"></div>        
                
		<div class="credits">
			<p>&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?>. <?php _e('All Rights Reserved. Created by', 'woothemes'); ?> <a href="http://realbigmarketing.com">Real Big Marketing</a>.</p>
		</div>
	</div>
	<!-- footer Ends -->
	
</div>
<?php wp_footer(); ?>

</body>
</html>