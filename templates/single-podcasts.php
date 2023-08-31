<?php
/*
Template Name: Single Podcast
Template Post Type: podcasts
*/

get_header(); 


$pod_audio = get_field('episode_audio_embed_code');
$pod_speakers = get_field('episode_speakers');



$convo_speakers = get_field('episode_speakers');
$convo_string = 'A conversation with ';
$convo_arr = array();

if( $convo_speakers ) {
	
	
		foreach( $convo_speakers as $convo_speaker ) {
		
		$one_speaker_name = $convo_speaker['speaker_name'];
		$one_speaker_firm = $convo_speaker['speaker_firm'];
		$one_speaker_bio = $convo_speaker['speaker_bio_url'];
		
		array_push($convo_arr, $one_speaker_name);
	
	
	}
	
	$convo_string .= implode(' and ', $convo_arr);
	$convo_string .= ".";
  
}




?>



<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php if ( fusion_get_option( 'blog_pn_nav' ) ) : ?>
		<div class="single-navigation clearfix">
			<?php previous_post_link( '%link', esc_attr__( 'Previous', 'Avada' ) ); ?>
			<?php next_post_link( '%link', esc_attr__( 'Next', 'Avada' ) ); ?>
		</div>
	<?php endif; ?>

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
			<?php $full_image = ''; ?>
			<?php if ( 'above' === Avada()->settings->get( 'blog_post_title' ) ) : ?>
				<?php if ( 'below_title' === Avada()->settings->get( 'blog_post_meta_position' ) ) : ?>
					<div class="fusion-post-title-meta-wrap">
				<?php endif; ?>
				<?php $title_size = ( false === avada_is_page_title_bar_enabled( $post->ID ) ? '1' : '2' ); ?>
				<?php echo avada_render_post_title( $post->ID, false, '', $title_size ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<?php if ( 'below_title' === Avada()->settings->get( 'blog_post_meta_position' ) ) : ?>
					<?php echo avada_render_post_metadata( 'single' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div>
				<?php endif; ?>
			<?php elseif ( 'disabled' === Avada()->settings->get( 'blog_post_title' ) && Avada()->settings->get( 'disable_date_rich_snippet_pages' ) && Avada()->settings->get( 'disable_rich_snippet_title' ) ) : ?>
				<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
			<?php endif; ?>

			<?php avada_singular_featured_image(); ?>

			<?php if ( 'below' === Avada()->settings->get( 'blog_post_title' ) ) : ?>
				<?php if ( 'below_title' === Avada()->settings->get( 'blog_post_meta_position' ) ) : ?>
					<div class="fusion-post-title-meta-wrap">
				<?php endif; ?>
				<?php $title_size = ( false === avada_is_page_title_bar_enabled( $post->ID ) ? '1' : '2' ); ?>
				<?php echo avada_render_post_title( $post->ID, false, '', $title_size ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<?php if ( 'below_title' === Avada()->settings->get( 'blog_post_meta_position' ) ) : ?>
					<?php echo avada_render_post_metadata( 'single' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<div class="post-content testing-123">



				<?php 
				



the_title('<h2>', '</h2>');

echo $convo_string;

the_content();


?>

<div class="accordian fusion-accordian">

<details>
    <summary>Episode Assets</summary>
    
    
  <p><strong>Guest Bios</strong></p>

<?php

$rows = get_field('episode_speakers');
if( $rows ) {
    echo '<ul class="speaker-bio-links">';
    foreach( $rows as $row ) {
        $one_speaker_name = $row['speaker_name'];
		$one_speaker_firm = $row['speaker_firm'];
		$one_speaker_bio = $row['speaker_bio_url'];
        echo '<li>';
            echo "<a href='{$one_speaker_bio}'>{$one_speaker_name}</a>, {$one_speaker_firm}";
        echo '</li>';
    }
    echo '</ul>';
}

?>

<p><strong>Related Links</strong></p>

<?php

$rows = get_field('episode_assets');
if( $rows ) {
    echo '<ul class="asset-links">';
    foreach( $rows as $row ) {
        $one_asset_text = $row['asset_link_text'];
		$one_asset_url = $row['asset_link_url'];
        echo '<li>';
            echo "<a href='{$one_asset_url}' target='_blank'>{$one_asset_text}</a>";
        echo '</li>';
    }
    echo '</ul>';
}

?>
    
</details>

<div>


<?php if( get_field('episode_audio_embed_code') ): ?>
    <h2><?php the_field('episode_audio_embed_code'); ?></h2>
<?php endif; ?>




				<?php fusion_link_pages(); ?>
			</div>

			<?php if ( ! post_password_required( $post->ID ) ) : ?>
				<?php if ( '' === Avada()->settings->get( 'blog_post_meta_position' ) || 'below_article' === Avada()->settings->get( 'blog_post_meta_position' ) || 'disabled' === Avada()->settings->get( 'blog_post_title' ) ) : ?>
					<?php echo avada_render_post_metadata( 'single' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<?php endif; ?>
				<?php do_action( 'avada_before_additional_post_content' ); ?>
				<?php avada_render_social_sharing(); ?>
				<?php $author_info = fusion_get_page_option( 'author_info', $post->ID ); ?>
				<?php if ( ( Avada()->settings->get( 'author_info' ) && 'no' !== $author_info ) || ( ! Avada()->settings->get( 'author_info' ) && 'yes' === $author_info ) ) : ?>
					<section class="about-author">
						<?php ob_start(); ?>
						<?php the_author_posts_link(); ?>
						<?php /* translators: The link. */ ?>
						<?php $title = sprintf( __( 'About the Author: %s', 'Avada' ), ob_get_clean() ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride ?>
						<?php $title_size = ( false === avada_is_page_title_bar_enabled( $post->ID ) ? '2' : '3' ); ?>
						<?php Avada()->template->title_template( $title, $title_size ); ?>
						<div class="about-author-container">
							<div class="avatar">
								<?php echo get_avatar( get_the_author_meta( 'email' ), '72' ); ?>
							</div>
							<div class="description">
								<?php the_author_meta( 'description' ); ?>
							</div>
						</div>
					</section>
				<?php endif; ?>
				<?php avada_render_related_posts( get_post_type() ); // Render Related Posts. ?>

				<?php $post_comments = fusion_get_page_option( 'blog_comments', $post->ID ); ?>
				<?php if ( ( Avada()->settings->get( 'blog_comments' ) && 'no' !== $post_comments ) || ( ! Avada()->settings->get( 'blog_comments' ) && 'yes' === $post_comments ) ) : ?>
					<?php comments_template(); ?>
				<?php endif; ?>
				<?php do_action( 'avada_after_additional_post_content' ); ?>
			<?php endif; ?>
		</article>
	<?php endwhile; ?>
</section>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>