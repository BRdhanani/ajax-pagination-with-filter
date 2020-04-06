<?php
/*template name: All in one */
?>
<?php get_header(); ?>
<?php
	
			// Load posts loop.
			while ( have_posts() ) {
                the_post();
                ?>
				<h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
                 <p><?php the_content();?></p>
                 <?php
			}


?>
<?php get_footer()?>
