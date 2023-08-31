<?php
/**
 * @var array  $nested_fields    An array of GF_Field objects.
 * @var array  $nested_form      The form object of the nested form.
 * @var array  $nested_field_ids An array of nested field IDs.
 * @var string $actions          Generated HTML for displaying related entries link.
 */
?>
<div class="gpnf-nested-entries-container gpnf-entry-view ginput_container">
	<?php
	$nested_details = array();
	foreach ( $nested_form['fields'] as $field ) {
		$nested_details[ $field->id ] = $field->label ;
	}
	?>
	<?php foreach( $entries as $entry ): ?>
		<table class="gpnf-nested-entries">
			<tbody>
			<?php
			/**
			 * @var \GF_Field $field
			 */
			$current_sec = '';
				    foreach( $nested_form['fields'] as $field ):
					    $value = GFFormsModel::get_lead_field_value( $entry, $field );
					    $value = $field->get_value_entry_detail( $value );
					    $section = GFFormsModel::get_section($nested_form, $field->id);
				if($value != null){
				    if ($current_sec != $section){
				    $current_sec = $section;
				?>
				<tr>
				<td colspan="2" class="entry-view-section-break jms" >
				    <?php echo $section['label']; ?>
				</td>
			    </tr>
			<?php } ?>
				<tr>
					<td colspan="2" class="entry-view-field-name jms" >
						<?php echo $field->get_field_label( false, $value ); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="entry-view-field-value jms" >
						<?php echo $value; ?>
					</td>
				</tr>
			<?php  } endforeach; ?>
			</tbody>
		</table>
		<br/>
	<?php endforeach; ?>
</div>