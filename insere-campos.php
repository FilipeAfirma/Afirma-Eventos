<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box() {

	$screens = array( 'Eventos em lista' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'myplugin_sectionid',
			__( 'Dados do treinamento', 'myplugin_textdomain' ),
			'myplugin_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	//$value = get_post_meta( $post->ID, '_periodo', true );
	//Para aparecer o mes escolhido:
	$meses = array('Janeiro' , 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outrubro', 'Novembro', 'Dezembro');

	$value_1 = get_post_meta( $post->ID, '_dia_start', true );
	$value_2 = get_post_meta( $post->ID, '_dia_end', true );
	$value_3 = get_post_meta( $post->ID, '_mes', true );
	$value_4 = get_post_meta( $post->ID, '_time_start', true );
	$value_5 = get_post_meta( $post->ID, '_time_end', true );

	echo '<label for="Período">';
	_e( 'Periodo', 'myplugin_textdomain' );
	echo '</label> ';
	//echo '<input type="text" id="periodo" name="periodo" placeholder=" Ex: 16 a 20 de novembro de 18h as 22h" value="' . esc_attr( $value ) . '" size="40" />';
	echo '<br />';
	echo '<input type="number" id="dia_start" name="dia_start" min="1" max="31" value="' . esc_attr( $value_1 ) . '" size="8"> a <input type="number" id="dia_end" name="dia_end" min="1" max="31" value="' . esc_attr( $value_2 ) . '" size="8"> de ';
	echo '<select  id="mes" name="mes" value="'.esc_attr($value_3).'" size="1">
	    <option value="'.esc_attr($value_3).'" selected>'.$meses[esc_attr($value_3)].'</option>
	    <option value="0">Janeiro</option>
	    <option value="1">Fevereiro</option>
	    <option value="2">Março</option>
	    <option value="3">Abril</option>
	    <option value="4">Maio</option>
	    <option value="5">Junho</option>
	    <option value="6">Julho</option>
	    <option value="7">Agosto</option>
	    <option value="8">Setembro</option>
	    <option value="9">Outrubro</option>
	    <option value="10">Novembro</option>
	    <option value="11">Dezembro</option>
	</select> de ';
	echo '<input type="time" id="time_start" name="time_start" value="' . esc_attr( $value_4 ) . '" size="8"> a <input type="time" id="time_end" name="time_end" value="' . esc_attr( $value_5 ) . '" size="8">';
	echo '<br />';

	$value = get_post_meta( $post->ID, '_carga_horaria', true );

	echo '<label for="Carga horária">';
	_e( 'Carga horária', 'myplugin_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="carga_horaria" name="carga_horaria" placeholder=" Ex: 20h" value="' . esc_attr( $value ) . '" size="25" />';

	echo '<br />';

	$value = get_post_meta( $post->ID, '_investimento', true );

	echo '<label for="Investimento">';
	_e( 'Investimento', 'myplugin_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="investimento" name="investimento" placeholder=" Ex: R$ 2.000,00" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['periodo'] ) && ! isset( $_POST['carga_horaria'] ) ) {
		return;
	}

	// Sanitize user input.
	//$my_data_0 = sanitize_text_field( $_POST['dia_start'].' a '.$_POST['dia_end'].' de '.$_POST['mes'].' de '.$_POST['time_start'].' a '.$_POST['time_end'] );
	$my_data_0_1 = sanitize_text_field( $_POST['dia_start']);
	$my_data_0_2 = sanitize_text_field( $_POST['dia_end']);
	$my_data_0_3 = sanitize_text_field( $_POST['mes']);
	$my_data_0_4 = sanitize_text_field( $_POST['time_start']);
	$my_data_0_5 = sanitize_text_field( $_POST['time_end'] );
	$my_data_1 = sanitize_text_field( $_POST['carga_horaria'] );
	$my_data_2 = sanitize_text_field( $_POST['investimento'] );

	// Update the meta field in the database.
	//update_post_meta( $post_id, '_periodo', $my_data_0 );
	update_post_meta( $post_id, '_dia_start', $my_data_0_1 );
	update_post_meta( $post_id, '_dia_end', $my_data_0_2 );
	update_post_meta( $post_id, '_mes', $my_data_0_3 );
	update_post_meta( $post_id, '_time_start', $my_data_0_4 );
	update_post_meta( $post_id, '_time_end', $my_data_0_5 );
	update_post_meta( $post_id, '_carga_horaria', $my_data_1 );
	update_post_meta( $post_id, '_investimento', $my_data_2 );
}
add_action( 'save_post', 'myplugin_save_meta_box_data' );