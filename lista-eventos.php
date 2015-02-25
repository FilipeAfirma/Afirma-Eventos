<?php

/*

Template Name: Site Map [lista-eventos.]

*/

#lista-eventos.php

/*

<link rel="stylesheet" type="text/css" href="wp-content/plugins/eventos-afirma/style.css">

<link rel="stylesheet" type="text/css" href="wp-content/plugins/eventos-afirma/css/custom.css">

*/

?>


<div id="container_eventos">


<!--
<h1>Proximas turmas</h1>
-->


<?php



$args = array(

	'post_type' => 'Eventos em lista',

	'orderby' => '_mes',

	'order'   => 'ASC',

);

$query = new WP_Query( $args );



$meses = array('Janeiro' , 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outrubro', 'Novembro', 'Dezembro');



while ( $query->have_posts() ) : $query->the_post();



$mykey_values = get_post_custom_values( '_mes' );



echo '<div>';

foreach ( $mykey_values as $key => $value ) {

	$mes_atual == $value ? $mes_atual = ' ' : $mes_atual=$value;

	$mes_atual == ' ' ? $mes_title = ' ' : $mes_title = '<h2>'.$meses[$value].'</h2>';

	echo $mes_title;

	echo '<ul>';


		echo '<div class="esq col_1 colum">';

		echo '<li class="esq title_event col_1">';
			echo '<span>';
			the_title();
			echo '</span>';
		echo '</li>';
			$key_1_value_1 = get_post_meta( get_the_ID(), '_dia_start', true );

		if( ! empty( $key_1_value_1 ) ) {

			echo '<li class="esq col_1">'.$key_1_value_1.' a ';

		}

		$key_1_value_2 = get_post_meta( get_the_ID(), '_dia_end', true );

		if( ! empty( $key_1_value_2 ) ) {

			echo $key_1_value_2.' de ';

		}

		$key_1_value_3 = get_post_meta( get_the_ID(), '_mes', true );

		if( ! empty( $key_1_value_3 ) ) {

			echo $key_1_value_3.' de ';

		}

		$key_1_value_4 = get_post_meta( get_the_ID(), '_time_start', true );

		if( ! empty( $key_1_value_4 ) ) {

			echo $key_1_value_4.' a ';

		}

		$key_1_value_5 = get_post_meta( get_the_ID(), '_time_end', true );

		if( ! empty( $key_1_value_5 ) ) {

			echo $key_1_value_5.'</li>';

		}

		echo '</div>';

		echo '<div class="esq col_2 colum">';
		$key_2_value = get_post_meta( get_the_ID(), '_carga_horaria', true );

		if( ! empty( $key_2_value ) ) {

			echo '<li class="esq col_2">Carga Horária: '.$key_2_value.'</li>';

		}
		$key_3_value = get_post_meta( get_the_ID(), '_investimento', true );

		if( ! empty( $key_3_value ) ) {

			echo '<li class="esq col_2">Investimento: '.$key_3_value.'</li>';

		}
		echo '</div>';


		echo '<div class="esq col_3 colum">';


		echo '<a href="';

			the_permalink();

		//echo MO_THEME_URL.the_title();

		echo '">';

		echo '<input type="button" class="dir btns col_3" name="btn_info" value="Mais Informações" />';

		echo '</a>';



		echo '<a href="';

			the_permalink();

		echo '?#form_subscribe">';

		echo '<input type="button" class="dir col_3 btns azul" name="btn_subs" value="Inscrever" />'; 

		echo '</a>';

		echo '</div>';

		//echo '<br />';



	echo '</ul>';

	}

echo '</div>';


endwhile;





?>

<!-- end container -->

</div>