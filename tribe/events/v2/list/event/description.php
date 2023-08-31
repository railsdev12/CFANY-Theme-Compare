<?php
/**
 * View: List Single Event Description
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event/description.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

if ( empty( (string) $event->excerpt ) ) {
	return;
}
?>
<!-- 
<div class="tribe-events-calendar-list__event-description tribe-common-b2 tribe-common-a11y-hidden">
	<?php echo (string) $event->excerpt; ?>
	
</div>
 -->



<div class="custom-tribe-events-list-event-description tribe-events-content description entry-summary">
      	<div class="custom-tribe-excerpt"><?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?></div>
      	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Find out more', 'the-events-calendar' ) ?> &raquo;</a>
      </div>
      
       <?php if (!empty(tribe_get_text_categories ())): ?>
 <div class="more-details">
    	<div class="custom-tribe-cat"><?php echo tribe_get_text_categories (); ?></div>
    </div>
<?php endif; ?>
