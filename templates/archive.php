<?php
/**
 * Archives template.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>


<?php
$loop = new WP_Query(
    array(
        'post_type' => 'podcasts' // This is the name of your post type,
        'posts_per_page' => 50 // This is the amount of posts per page you want to show
    )
);
while ( $loop->have_posts() ) : $loop->the_post(); ?>
 
The stuff you want to loop goes in here for example:
 
<div class="col-sm-4">
My column content
</div>
 
<?php endwhile;
wp_reset_postdata();
?>


<section id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php if ( category_description() ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'fusion-archive-description' ); ?>>
			<div class="post-content">
				<?php echo category_description(); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php get_template_part( 'templates/blog', 'layout' ); ?>
</section>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>
