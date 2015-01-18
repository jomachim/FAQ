<?php get_header(); //template name: Page FAQ ?>
<?php get_sidebar(); ?>
     
     
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <!--Content-->
    <div class="table-titles">
    	<div class="table-title"><h2 style="font-weight:normal; font-size:13pt; margin:0px 0px 0px;"><?php the_title(); ?></h2></div>
    	<div class="table-tit"></div>
    </div>
    <div class="clear"></div>
    <div class="table-content" style="margin-top:10px; padding-bottom:0;">
    	
        <!--Post-->
        <!-- div class="infopadding">
            <span class="thedate"><?php the_time(get_option('inf_date_format')); ?></span>
            <span class="author"><?php _e( 'Posted by', 'monroe' ); ?> <?php echo get_the_author(); ?></span>
        </div -->
        <div class="clear"></div>
        <div class="post_entry" style="line-height:25px; font-size:10pt;">
           <?php the_content(); ?>
        </div>
        <!--Post-->
		
	<?php endwhile; endif; ?>
	
	<?php query_posts(array( 'post_type' => 'faq_an', 'orderby' => 'title', 'order' => 'ASC' )); ?>
	<?php while (have_posts()) : the_post(); ?>
		<h3><?php the_title(); ?></h3>
		<div><?php the_content(); ?></div>
		<center>***</center>
	<?php endwhile; ?>

 	<div class="clear"></div>
 	</div>
 	<!--Content-->

	
    
    <!--Comments-->
	<?php if(comments_open()): ?> 
    <a name="comments"></a>
    <?php comments_template(); ?>
	<?php endif; ?>
    <!--Comments-->
    
<?php get_footer(); ?>