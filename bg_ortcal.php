<?php
/* 
    Plugin Name: Bg Orthodox Calendar 
    Plugin URI: http://bogaiskov.ru/script-orthodox-calendar/
    Description: Плагин выводит на экран православный календарь на год: дата по старому стилю, праздники по типикону (от двунадесятых до вседневных), памятные даты, дни поминовения усопших, дни почитания икон, посты и сплошные седмицы. 
    Author: Vadim Bogaiskov
    Version: 0.1
    Author URI: http://bogaiskov.ru 
*/

/*  Copyright 2013  Vadim Bogaiskov  (email: vadim.bogaiskov@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*****************************************************************************************
	Блок загрузки плагина
	
******************************************************************************************/

// Запрет прямого запуска скрипта
if ( !defined('ABSPATH') ) {
	die( 'Sorry, you are not allowed to access this page directly.' ); 
}

define('BG_ORTCAL_VERSION', '0.1');

// JS скрипты 
function bg_ortcal_frontend_scripts () {
   	wp_enqueue_script( 'bg_ortcal_days', plugins_url( 'js/bg_ortcal_days.js' , __FILE__ ), false, BG_ORTCAL_VERSION, true );
	wp_enqueue_script( 'bg_ortcal_names', plugins_url( 'js/bg_ortcal_names.js' , __FILE__ ), false, BG_ORTCAL_VERSION, true );
	wp_enqueue_script( 'bg_ortcal_year', plugins_url( 'js/bg_ortcal_year.js' , __FILE__ ), false, BG_ORTCAL_VERSION, true );
	wp_enqueue_script( 'bg_ortcal_init', plugins_url( 'js/bg_ortcal_init.js' , __FILE__ ), false, BG_ORTCAL_VERSION, true );
}
if ( !is_admin() ) {
	add_action( 'wp_enqueue_scripts' , 'bg_ortcal_frontend_scripts' ); 
	add_action( 'wp_head' , 'bg_ortcal_js_options' ); 
}
function bg_ortcal_js_options () { ?>
	<script>
		var baseUrl =  "<?php echo plugins_url( '/' , __FILE__ );?>";
	</script>
<?php
}
// Регистрируем шорт-код ortcal_button
	add_shortcode( 'ortcal_button', 'bg_ortcal_button' );

// Функция обработки шорт-кода ortcal_button
function bg_ortcal_button($atts) {
	extract( shortcode_atts( array(
		'val' => ' *Календарь на год '
	), $atts ) );

	$quote = "<button  onClick='bscal.show();'>".$val."</button>";
	return "{$quote}";
}
