<?php
/**
 * Alter the assignees
 *
 * @param Gravity_Flow_Assignee[] $assignees The array of Assignees.
 * @param Gravity_Flow_Step $step The current step.
 *
 * @return Gravity_Flow_Assignee[] $assignees
 */
/*function cfany_gravityflow_step_assignees( $assignees, $step ) {
	//Update your Step ID
    if ( ( 110 === $step->get_id()) ) {

        $users = get_users(
            array(
                'role'   => 'programming_committee',
                'number' => -1,
            )
        );

		//Builds a list of the IDs for comparison - like what maybe_add_assignee was doing in your previous code.
		$assignee_ids = array_column(
			function( $element ) {
				return $element->get_id();
			},
			$assignees
		);


		    //Loop through your potential users
		    foreach ( $users as $user ) {
			    //Check if they already have an assignee based on email field
			    if ( ! in_array( $user->user_email, $assignee_ids ) ) {
				    //Convert the user to an assignee type and add it to the $assignees array
				    $new_assignee = array(
					    'id'   => $user->user_email,
					    'type' => 'email',
				    );
				    $assignees[]    = Gravity_Flow_Assignees::create( $new_assignee, $step );
				    $assignee_ids[] = $user->user_email;
			    }
		    }
	}
	//Return the updated $assignees objects
	return $assignees;
}
add_filter( 'gravityflow_step_assignees', 'cfany_gravityflow_step_assignees', 10, 2 );
*/

/**
 * Voting.
 *
 * @param string $step_status The status of the step
 * @param Gravity_Flow_Assignee[] $approvers The array of Gravity_Flow_Assignee objects
 * @param Gravity_Flow_Step $step The current step
 *
 * @return string
 */
function cfany_approval_status_evaluation( $step_status, $approvers, $step ) {

	//Ensure you are only adjusting the desired step.
	if ( !( ( 110 === $step->get_id()) || ( 56 === $step->get_id()) || ( 265 === $step->get_id()) ) ) {
		return $step_status;
	}

	// Set $step_status to pending, no rejection will end the step.
	$step_status = 'pending';



	//get Counts.
	$entry           = $step->get_entry();



	if ( 58 === $step->get_form_id() ) {
		$approval_count  = intval( $entry['17'] );
		$rejection_count = intval( $entry['18'] );
	}

	if ( 43 === $step->get_form_id() ) {
		$approval_count  = intval( $entry['129'] );
		$rejection_count = intval( $entry['130'] );
	}
	
	if ( 163 === $step->get_form_id() ) {
		$approval_count  = intval( $entry['129'] );
		$rejection_count = intval( $entry['130'] );
	}

	$total_count     = count( $approvers ) - 1;

	$current_assignee_key = $step->get_current_assignee_key();
	$current_assignee     = $step->get_assignee( $current_assignee_key );


	if ( 58 === $step->get_form_id() ) {
		// Vote recorded, skip.
		if ( strstr( $entry['20'], $current_assignee->get_id() ) ) {
			//Everyone voted.
			if ( $total_count === ( $approval_count + $rejection_count ) ) {
				$step_status = ( $approval_count >= $rejection_count ) ? 'approved' : 'rejected';
			}

			return $step_status;
		}
	}


	if ( 43 === $step->get_form_id() ) {
		// Vote recorded, skip.
		if ( strstr( $entry['131'], $current_assignee->get_id() ) ) {
			//Everyone voted.
			if ( $total_count === ( $approval_count + $rejection_count ) ) {
				$step_status = ( $approval_count >= $rejection_count ) ? 'approved' : 'rejected';
			}

			return $step_status;
		}
	}
	
	if ( 163 === $step->get_form_id() ) {
		// Vote recorded, skip.
		if ( strstr( $entry['131'], $current_assignee->get_id() ) ) {
			//Everyone voted.
			if ( $total_count === ( $approval_count + $rejection_count ) ) {
				$step_status = ( $approval_count >= $rejection_count ) ? 'approved' : 'rejected';
			}

			return $step_status;
		}
	}

	$approval_count = $rejection_count = 0;
	foreach ( $approvers as $approver ) {
		$approver_status = $approver->get_status();

		// don't count Jared's vote.
		if ( 'user_id|19' === $approver->get_key() ) {
			gravity_flow()->log_debug( __METHOD__ . "(): Skip Jared's vote." );
			continue;
		}

		if ( 'approved' === $approver_status ) {
			$approval_count ++;
		} elseif ( 'rejected' == $approver_status ) {
			$rejection_count ++;
		}
	}

	//Everyone voted.
	if ( $total_count === ( $approval_count + $rejection_count ) ) {
		$step_status = ( $approval_count >= $rejection_count ) ? 'approved' : 'rejected';
	}

	//Saving to admin fields.
	$entry_id = $step->get_entry_id();

	if ( 58 === $step->get_form_id() ) {
		GFAPI::update_entry_field( $entry_id, 17, $approval_count );
		GFAPI::update_entry_field( $entry_id, 18, $rejection_count );
	}

	if ( 43 === $step->get_form_id() ) {
		GFAPI::update_entry_field( $entry_id, 129, $approval_count );
		GFAPI::update_entry_field( $entry_id, 130, $rejection_count );
	}
	
	if ( 163 === $step->get_form_id() ) {
		GFAPI::update_entry_field( $entry_id, 129, $approval_count );
		GFAPI::update_entry_field( $entry_id, 130, $rejection_count );
	}


	//Saving notes.
	$note = trim( rgpost( 'gravityflow_note' ) );
	if ( 'user_id|19' !== $current_assignee_key ) {
		$_note  = '<strong>' . $current_assignee->get_id();
		$action = trim( rgpost( 'gravityflow_approval_new_status_step_' . $step->get_id() ) );
		$color  = ( 'approved' === $action ) ? 'green' : 'red';
		$_note  .= ' (<span style="color:' . $color . '">' . $action;
		$_note  .= '</span>): </strong>';


		if ( ( 58 === $step->get_form_id() ) && ( $action ) ) {
			$notes = $_note . "\n" . $note . "\n\n" . $entry['20'];
			GFAPI::update_entry_field( $entry_id, 20, $notes );
		}

		if ( ( 43 === $step->get_form_id() ) && ( $action ) ) {
			$notes = $_note . "\n" . $note . "\n\n" . $entry['131'];
			GFAPI::update_entry_field( $entry_id, 131, $notes );
		}
		
		if ( ( 163 === $step->get_form_id() ) && ( $action ) ) {
			$notes = $_note . "\n" . $note . "\n\n" . $entry['131'];
			GFAPI::update_entry_field( $entry_id, 131, $notes );
		}

	}

//	gravity_flow()->log_debug( __METHOD__ . "(): Votes: $approval_count approved, $rejection_count rejected. Total votes should be: $total_count" );
//	gravity_flow()->log_debug( __METHOD__ . "(): Final step status: $step_status" );

	return $step_status;
}

add_filter( 'gravityflow_step_status_evaluation_approval', 'cfany_approval_status_evaluation', 10, 3 );


// REMOVE STATUS PAGE FILTERS FOR ENDUSER
add_filter( 'gravityflow_field_filters_status_table', 'field_filters_remove_defaults', 10, 1 );
function field_filters_remove_defaults( $field_filters ) {
	if ( is_admin() ) {
		return $field_filters;
	}
	$reserved_filters = array(
		'ip',
		'is_starred',
		'created_by',
		'payment_status',
		'payment_date',
		'source_url',
		'transaction_id',
		'payment_amount',
	);

	foreach ( $field_filters as $form => $fields ) {
		$modify = false;
		foreach ( $fields as $key => $field ) {
			if ( in_array( $field['key'], $reserved_filters ) || strpos( $field['key'], 'workflow_step_status' ) !== false ) {
				unset( $field_filters[ $form ][ $key ] );
				$modify = true;
			}
		}
		if ( $modify ) {
			$field_filters[ $form ] = array_values( $field_filters[ $form ] );
		}
	}
}

