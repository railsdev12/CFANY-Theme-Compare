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
$speakers = (count($organizer_ids));

?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<dt class="tribe-events-speakerorg-label"> 
	<?php if ( $speakers == 1 ) : ?>
	<?php esc_html_e( 'Speaker', 'the-events-calendar' ); ?>
	<?php endif; ?>
	<?php if ( $speakers > 1 ) : ?>
	<?php esc_html_e( 'Speakers', 'the-events-calendar' ); ?> 
	<?php endif; ?>
	</dt>
	<dl>
		<?php
		do_action( 'tribe_events_single_meta_organizer_section_start' );
		

		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}

			?>
			<dt style="display:none;"><?php // This element is just to make sure we have a valid HTML ?></dt>
			<dd class="tribe-organizer">
			
				<?php echo tribe_get_organizer_link( $organizer ) ?>
			</dd>
			<?php
		}

		do_action( 'tribe_events_single_meta_organizer_section_end' );
		?>
	</dl>
</div>