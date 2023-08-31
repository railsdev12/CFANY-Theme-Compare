<?php
/**
 * Titlebar template.
 *
 * @author     ThemeFusion
 * @copyright  (c) Copyright by ThemeFusion
 * @link       http://theme-fusion.com
 * @package    Avada
 * @subpackage Core
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
  exit( 'Direct script access denied.' );
}

$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );
$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
$time_formatted = null;
if ( $start_time == $end_time ) {
  $time_formatted = esc_html( $start_time );
} else {
  $time_formatted = esc_html( $start_time . $time_range_separator . $end_time );
}

$time_formatted = apply_filters( 'tribe_events_single_event_time_formatted', $time_formatted, $post_id  );
$time_title = apply_filters( 'tribe_events_single_event_time_title', __( 'Time:', 'the-events-calendar' ), $post_id  );
$aos_event = has_term( 'Asset Owner Series', 'tribe_events_cat');
$policy_event = has_term( 'Global Policymakers Series', 'tribe_events_cat');
?>

<div class="fusion-page-title-bar fusion-page-title-bar-<?php echo esc_attr( $content_type ); ?> fusion-page-title-bar-<?php echo esc_attr( $alignment ); ?>">
  <div class="fusion-page-title-row">
    <div class="fusion-page-title-wrapper <?php if( $aos_event && tribe_is_event() && is_single() ) { echo 'aos-event'; } ?>">
      <?php if ( !$aos_event || is_single( array( '51136', '70614') ) || tribe_is_past() || tribe_is_upcoming() && !is_tax() ) : ?>
      <div class="fusion-page-title-captions">
      <?php endif; ?>
        <?php if ( $title ) : ?>
          <?php // Add entry-title for rich snippets. ?>
          <?php $entry_title_class = ( Avada()->settings->get( 'disable_date_rich_snippet_pages' ) && Avada()->settings->get( 'disable_rich_snippet_title' ) ) ? 'entry-title' : ''; ?>
           <?php if( tribe_is_event() && is_single() && !$aos_event  || is_single('70614') ): ?>
           <div class="title-tribe-cat"><?php echo tribe_get_text_categories (); ?></div>
           <?php endif; ?>

           <?php if( !$aos_event || is_single( array( '51136', '70614') ) || tribe_is_past() || tribe_is_upcoming() && !is_tax() ): ?>
          <h1 class="<?php echo esc_attr( $entry_title_class ); ?>"><?php echo $title; // WPCS: XSS ok. ?></h1>
          <?php endif; ?>

          <?php if( tribe_is_event() && is_single() && !$aos_event || is_single('70614') ): ?>

            <?php if( tribe_event_is_multiday() ): ?>

              <h3 class=title-event-date><?php esc_html_e( $start_date ) ?> <?php esc_html_e( ' - ', 'the-events-calendar' ) ?> <?php echo $end_date; // WPCS: XSS ok. ?> </h3>

            <?php else : ?>

              <h3 class=title-event-date><?php esc_html_e( $start_date ) ?> <?php esc_html_e( ' | ', 'the-events-calendar' ) ?> <?php echo $time_formatted; // WPCS: XSS ok. ?> </h3>

            <?php endif; ?>

        <?php endif; ?>

        <?php if( ( $aos_event && ! $policy_event && ! is_single( array( '51136', '70614') ) ) && ( tribe_is_event() && is_single() ) ): ?>
        
        
        
          <div class="aos-titlebar">
              <img class="titlebar-logo"
              src="/wp-content/uploads/2019/07/vectorAOS_white_lockup_text.svg" />
          </div>
        <?php endif; ?>
        
         <?php if( ( $policy_event && ! is_single( array( '51136', '70614') ) ) && ( tribe_is_event() && is_single() ) ): ?>
          <div class="aos-titlebar policymakers-series">
              <img class="titlebar-logo"
              src="/wp-content/uploads/2020/05/PolicyPresent_Whi.svg" />
          </div>
        <?php endif; ?>

          <?php if ( $subtitle ) : ?>
            <h3><?php echo $subtitle; // WPCS: XSS ok. ?></h3>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ( 'center' === $alignment ) : // Render secondary content on center layout. ?>
          <?php if ( 'none' !== fusion_get_option( 'page_title_bar_bs', 'page_title_breadcrumbs_search_bar', $post_id ) ) : ?>
            <div class="fusion-page-title-secondary">
              <?php echo $secondary_content; // WPCS: XSS ok. ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>

      </div>

      <?php if ( 'center' !== $alignment ) : // Render secondary content on left/right layout. ?>
        <?php if ( 'none' !== fusion_get_option( 'page_title_bar_bs', 'page_title_breadcrumbs_search_bar', $post_id ) ) : ?>
          <div class="fusion-page-title-secondary">
            <?php echo $secondary_content; // WPCS: XSS ok. ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>

    </div>
  </div>
</div>