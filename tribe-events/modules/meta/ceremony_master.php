<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/organizer.php
 *
 * @package TribeEventsCalendar
 * @version 4.4
 */

$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
$posts = get_field('ceremony_master');
$count = (count($posts));
$has_speaker = count( $organizer_ids ) > 0;


?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<dt class="tribe-events-speakerorg-label"> 
	<?php if ( $count == 1 ) : ?>
	<?php esc_html_e( 'Master of Ceremony', 'the-events-calendar' ); ?>
	<?php endif; ?>
	<?php if ( $count > 1 ) : ?>
	<?php esc_html_e( 'Masters of Ceremony', 'the-events-calendar' ); ?> 
	<?php endif; ?>
	</dt>
	<dl>
			<?php
		do_action( 'tribe_events_single_meta_organizer_section_start' );?>
	<?php foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
	    <dt style="display:none;"><?php // This element is just to make sure we have a valid HTML ?></dt>
			<dd class="tribe-organizer">
	    	<a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
	    	<?php the_field('author', $p->ID); ?>
	    </dd>
	<?php endforeach; ?>
	
	<?php do_action( 'tribe_events_single_meta_organizer_section_end' ); 
		?>
	</dl>
</div>