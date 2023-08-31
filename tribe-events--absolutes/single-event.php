<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.3
 *
 */

if ( ! defined( 'ABSPATH' ) )
{
  die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

// $aos_events = tribe_get_events(array(
//     'meta_query' => array(
//         array(
//             'key' => 'reg_settings', // name of custom field
//             'value' => array('nonmembers', 'all'),
//         )
//     )
// ));

// $yes_request = tribe_get_events(array(
//     'meta_query' => array(
//         array(
//             'key' => 'reg_settings', // name of custom field
//             'value' => array('Nonmembers', 'All')
//         )
//     )
// ));

$aos_category = has_term( 'Asset Owner Series', 'tribe_events_cat');
$start_date = tribe_get_start_date( null, false );
$compare_date_min = strtotime( "2020-09-28" );
$compare_date_current = strtotime($start_date);

?>

	<div id="tribe-events-content" class="tribe-events-single">


		<!-- Notices -->
		<?php tribe_the_notices() ?>


		<!-- #tribe-events-header -->


			<?php while ( have_posts() ) :  the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!-- Event featured image, but exclude link -->
				<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

				<!-- Event content -->
				<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
				<div class="tribe-events-single-event-description tribe-events-content">
				
				<?php if ( $compare_date_current > $compare_date_min ) : ?>
                        <div class="cvent-notice" style="margin-top:0px;">
                            <input type="checkbox" autocomplete="off" id="close-notice" />
                            <div class="fusion-column-wrapper">
                                <div class="fusion-text cfa-bold notice-title">
                                    <p>Wait! A Note on Registration:</p>
                                    <label class="close" title="close" for="close-notice">
                                        <i class="fb-icon-element-1 fb-icon-element fontawesome-icon fa-times fas"></i>
                                    </label>
                                </div>
                                <div class="fusion-text notice-body">
                                    <p class="cfa-medium">We’ve launched Cvent—our new events platform!</p>
                                    <p class="reg-intro">Registration for any event with a start date after Sept. 28 now <span class="under-require">requires a CFA Institute account.</span></p>
                                    <div class="quick-instruct">
                                        <p class="cfa-bold smaller">I don’t have a CFA Institute account</p>
                                        <ul>
                                            <li>No problem! You’ll have the chance to create one prior to registration.</li>
                                        </ul>
                                        <p class="cfa-bold smaller">I already have a CFA Institute account</p>
                                        <ul>
                                            <li>Great! Be sure to use your existing credentials at registration.</li>
                                        </ul>
                                    </div>
                                    <div class="fusion-clearfix"></div>
                                    <a class="guide-link" href="https://www.cfany.org/cvent-first-time-event-registration-guide/" target="_blank" rel="noopener noreferrer">Cvent Transition Guide <span>⭢</span></a>
                                </div>
                            </div>
                        </div>
					<?php endif; ?>
				
				
				<?php if ( $aos_category && !is_single( array( '50897', '52778', '51136', '52292') ) ) :  ?>
				
				<!-- <?php Avada_EventsCalendar::render_single_event_title(); ?> -->
				
				<div class="aos-branding">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<h3 class=title-event-date><?php esc_html_e( $start_date ) ?></h3>
				</div>
				
				<?php endif; ?>
				
				
					<?php the_content(); ?>
				</div>
			<!-- .tribe-events-single-event-description -->

				<!-- Event meta -->

			</div>
			<!-- #post-x -->
			
<?php if( $aos_category ) : ?>
    <?php echo do_shortcode('[fusion_modal name="request" title="Request
Invitation" size="large" background="" border_color="" show_footer="yes"
class="" id=""][gravityform id="47" title="false" description="false"
ajax="true" field_values="eventname='. get_the_title() .'
"][/fusion_modal]');?>
<?php endif ?>
			
			
			<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
		<?php endwhile; ?>

	</div><!-- #tribe-events-content -->


