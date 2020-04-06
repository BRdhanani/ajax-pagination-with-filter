<?php
    $args = array(
        'post_type' => 'competition'
    );

    $the_query = new WP_Query( $args );
?>

<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <div class="grid-4 project">
        <a href="<?php the_permalink() ;?>?iframe=true&width=100%&height=100%" rel="prettyPhoto[project]">
            <img src="<?php the_field('featured_image'); ?>"> 
            <h2><?php the_title(); ?></h2>
            <p><?php the_excerpt(); ?></p>
        </a>
    </div>

<?php endwhile; else: ?>
    <p><?php _e('Sorry, no projects were found.'); ?></p>
<?php endif; ?>
