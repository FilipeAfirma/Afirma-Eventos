<?php

/**
 * Plugin Name: Eventos Afirma
 * Plugin URI: http://afirmacomunicacao.com.br/
 * Description: Cria e gerencia eventos no site. Shortcodes: Lista os eventos - [todos_eventos]
 * Version: 1.1
 * Author: Filipe Lopes
 * Author URI: http://afirmacomunicacao.com.br/
 * License: GPL2
 * Text Domain: eventos-afirma
 * Domain Path: languages/
 */



// Previne acesso direto

if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// Carrega arquivos de traduções

function ev_a_load_textdomain() {

	load_plugin_textdomain( 'eventos-afirma', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

}



add_action( 'plugins_loaded', 'ev_a_load_textdomain' );



// Example usando o label

// [example_shortcode_label link="" label=""]

function ex_p_example_shortcode_label( $attrs ) {



	extract( shortcode_atts( array(

		'link' => '',

		'label' => __( 'Button!', 'example-plugin' )

	), $attrs ) );



	return '<a class="button" href="' . $link . '">' . $label . '</a>';

}



add_shortcode( 'example_shortcode_label', 'ex_p_example_shortcode_label' );



// Example usando o conteúdo

// [example_shortcode_content link=""]Conteúdo aqui[/example_shortcode_content]

function ex_p_example_shortcode_content( $attrs, $content = null ) {



	extract( shortcode_atts( array(

		'link' => '',

		'label' => __( 'Button!', 'example-plugin' )

	), $attrs ) );



	return '<a class="button" href="' . $link . '">' . $content . '</a>';

}



add_shortcode( 'example_shortcode_content', 'ex_p_example_shortcode_content' );



//----------------------------------------------------------------//



add_action( 'init', 'create_post_type' );

function create_post_type() {

  register_post_type( 'Eventos em lista',

    array(

      'labels' => array(

        'name' => __( 'A. Eventos' ),

        'singular_name' => __( 'Evento' )

      ),

      'menu_icon' => 'dashicons-calendar-alt',

      'public' => true,

      'has_archive' => true,

      'rewrite' => array('slug' => 'evento'),

    )

  );

}



function lista_eventos( $attrs ){

	if(include('lista-eventos.php'))

		return " ";

}

add_shortcode( 'todos_eventos', 'lista_eventos' );



function insere_campos( $attrs ){

	if(include('insere-campos.php'))

		return " ";

}

add_action( 'init', 'insere_campos' );





function ev_a_register_script(){

	wp_enqueue_style( 'ev-a-style', plugins_url('ev-a-style.css', __FILE__));

}

add_action('wp_enqueue_scripts','ev_a_register_script');








