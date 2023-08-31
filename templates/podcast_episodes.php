<?php
/*
Template Name: Single Podcast Episode
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

$thumb = get_the_post_thumbnail_url();
				
?>

<figure class="ci-pod">

    <div class="ep-img" style="background-image: url('<?php echo $thumb;?>'); 
   background-size: cover; background-position: center 20%;
  width: 100%;
  height: 300px;
  "></div>

    <div class="ep-info">
        <span class="ep">Ep </span><span class="count"><?php the_field('episode_number'); ?></span>
    </div>

    <figcaption>

        <div class="ep-overview">
            <h3><?php the_title(); ?></h3>
            <small>
                <?php
            $convo_speakers = get_field('episode_speakers');
$convo_string = 'A conversation with ';
$convo_arr = array();

if( $convo_speakers ) {
		foreach( $convo_speakers as $convo_speaker ) {
		$one_speaker_name = $convo_speaker['speaker_name'];
		$one_speaker_firm = $convo_speaker['speaker_firm'];
		array_push($convo_arr, $one_speaker_name);
	}
	$convo_string .= implode(' and ', $convo_arr);
	 echo $convo_string;
  
}
?>
            </small>
            <div class="ep-description">
                <?php the_field('episode_description'); ?>
            </div>
        </div>

        <div class="ep-supplemental">


            <div class="jms-accordian">

                <div class="was-details">
                    <div class="was-summary">Episode Assets</div>

                    <div class="details-group guests">
                        <p><strong>Guest Bios</strong></p>

                        <?php

              //Maybe display a custom field
             
             
             
             
             $rows = get_field('episode_speakers');
if( $rows ) {
    echo '<ul class="speaker-bio-links">';
    foreach( $rows as $row ) {
        $one_speaker_name = $row['speaker_name'];
		$one_speaker_firm = $row['speaker_firm'];
		$one_speaker_bio = $row['speaker_bio_url'];
        echo '<li>';
            echo "<a href='{$one_speaker_bio}'>{$one_speaker_name}</a>";
            if ($one_speaker_firm) {
            echo ", {$one_speaker_firm}";
            }
        echo '</li>';
    }
    echo '</ul>';
}
             

           ?>
                    </div>

                    <?php


$speakers = get_field('episode_assets');

$good_links = 0;
foreach ($speakers as $speaker) {
    $one_asset_url = $speaker['asset_link_url'];
    
    if ($one_asset_url != 'https://www.cfany.org/copy-of-compound-insights/') {
    	$good_links++;
    }
    
}

$rows = get_field('episode_assets');

if( $rows && ($good_links >= 1) ) {
	echo '<div class="details-group links">';
	echo '<p><strong>Related Links</strong></p>';
    echo '<ul class="asset-links">';
    foreach( $rows as $row ) {
        $one_asset_text = $row['asset_link_text'];
		$one_asset_url = $row['asset_link_url'];
		
		if ($one_asset_url != 'https://www.cfany.org/copy-of-compound-insights/') {
		
			echo '<li>';
            	echo "<a href='{$one_asset_url}' target='_blank'>{$one_asset_text}</a>";
        	echo '</li>';
        	
		}
       
    }
    
    echo '</ul>';
    echo '</div>';
}

?>
            </div>
        </div>
        </div>

        <?php if( get_field('episode_audio_embed_code') ): ?>

        <div class="pod-embed"><?php the_field('episode_audio_embed_code'); ?></div>

        <?php else: ?>

        <div class="pod-release-date"><span>Release Date: </span><?php the_field('episode_release_date'); ?></div>

        <?php endif; ?>

    </figcaption>
</figure>








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