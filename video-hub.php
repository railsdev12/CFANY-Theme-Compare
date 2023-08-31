<?php
/**
 * Template Name: Video Hub
 * This template file is used for contact pages.
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
<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo fusion_render_rich_snippets_for_pages(); // phpcs:ignore WordPress.Security.EscapeOutput ?>

			<?php avada_singular_featured_image(); ?>

			<div class="post-content">
				<?php the_content(); ?>
				<?php fusion_link_pages(); ?>
			</div>
			<?php if ( ! post_password_required( $post->ID ) ) : ?>
				<?php do_action( 'avada_before_additional_page_content' ); ?>
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<?php $woo_thanks_page_id = get_option( 'woocommerce_thanks_page_id' ); ?>
					<?php $is_woo_thanks_page = ( ! get_option( 'woocommerce_thanks_page_id' ) ) ? false : is_page( get_option( 'woocommerce_thanks_page_id' ) ); ?>
					<?php if ( Avada()->settings->get( 'comments_pages' ) && ! is_cart() && ! is_checkout() && ! is_account_page() && ! $is_woo_thanks_page ) : ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				<?php else : ?>
					<?php if ( Avada()->settings->get( 'comments_pages' ) ) : ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php do_action( 'avada_after_additional_page_content' ); ?>
			<?php endif; // Password check. ?>
		</div>
	<?php endwhile; ?>
</section>
<?php //echo do_shortcode('[cfancy-video-posts]'); ?>
<?php 
$terms_array = array();
 $terms = get_terms([
	'taxonomy' => 'video-category',
	'hide_empty' => false,
  ]);

  foreach($terms as $term){
	$terms_array[] = $term->term_id;
  }

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$all_blog_posts = new WP_Query(
	array (
	  'post_type' => 'tribe_events',
	  'orderby'   => 'meta_value',
	  'order' => 'DESC',
	  'post_status' => 'publish',
	  'posts_per_page' => '6',
	  'paged' => $paged,
	  'search_title' => '',
	  'meta_key' => '_EventStartDate',
	  'tax_query' => array(
		  array(
			  'taxonomy'  => 'video-category',
			  'field'     => 'term_id',
			  'terms'     => $terms_array,
		  )
	  ),
  )
);

if ( $all_blog_posts->have_posts() ) {
	echo '<ul>';
	while ( $all_blog_posts->have_posts() ) {
	  $all_blog_posts->the_post(); 
		echo '<li>'.get_the_title().'</li>';
	}  

	echo '</ul>';
	
	$total_pages = $all_blog_posts->max_num_pages;

    if ($total_pages > 1){

        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => __('« prev'),
            'next_text'    => __('next »'),
        ));
    }    
}

wp_reset_postdata();
?>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>