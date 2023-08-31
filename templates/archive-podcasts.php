
<?php
/**
 * Template Name: Podcasts Archives
 *
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<section id="content">
<div id="primary">
<?php $loop = new WP_Query( array( 'post_type' => 'podcasts', 'posts_per_page' => -1 ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<section class="col third">
<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('medium'); ?></a>
<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<h3>Hello</h3>
<?php the_content(); ?>
</section>

<!-- End loop -->
<?php endwhile; wp_reset_query(); ?>

<!-- End primary -->
</div>
</section>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>