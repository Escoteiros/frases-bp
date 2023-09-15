<?php
/**
 * @package Frases_Bp
 * @version 1.0
 */
/*
Plugin Name: Frases BP
Plugin URI: http://wordpress.org/plugins/frases-bp/
Description: Este não é só um plugin, simboliza a esperança e o entusiasmo de uma geração inteira resumidos em frases do fundador do Movimento Escoteiro. Sempre Alerta para Servir e Viver Melhor Possível!. Quando ativado, você verá aleatoriamente frases de Baden-Powell, BP no canto superior direito da tela de administração em cada página. Obrigado aos voluntários pela arte.
Author: Itaymberê Guimarães
Version: 1.0.0
Author URI: http://abelha.io/itaymbere
*/

function hello_dolly_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = "1º Art. O Escoteiro é honrado e digno de confiança.
2º Art. O Escoteiro é leal.
3º Art. O Escoteiro está sempre alerta para ajudar o próximo em toda e qualquer ocasião.
4º Art. O Escoteiro é amigo de todos e irmão dos demais escoteiros.
5º Art. O Escoteiro é cortês.
6º Art. O Escoteiro é bom para os animais e as plantas.
7º Art. O Escoteiro é obediente e disciplinado.
8º Art. O Escoteiro é feliz e sorri diante das dificuldades.
9º Art. O Escoteiro é econômico e respeita o bem alheio.
10º Art. O Escoteiro é limpo de corpo e alma.";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hello_dolly() {
	$chosen = hello_dolly_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Hello Dolly song, by Jerry Herman:', 'hello-dolly' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hello_dolly' );

// We need some CSS to position the paragraph.
function dolly_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );
