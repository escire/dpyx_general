<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
	public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Inicio', 
			'icon' => ''
		),
		array(
			'path' => 'configuracion', 
			'label' => 'Configuración', 
			'icon' => ''
		),
		array(
			'path' => 'categoria', 
			'label' => 'Categoria', 
			'icon' => ''
		),
		
		array(
			'path' => 'subcategoria', 
			'label' => 'Subcategoria', 
			'icon' => ''
		),
		
		array(
			'path' => 'usuario', 
			'label' => 'Usuario', 
			'icon' => ''
		),
		
		array(
			'path' => 'pregunta', 
			'label' => 'Pregunta', 
			'icon' => ''
		),
		
		array(
			'path' => 'respuesta', 
			'label' => 'Resultados', 
			'icon' => ''
		)
	);

	
	
	public static $nombre = array();
	public static $texto_encabezado = array();

	public static $rol = array(
		array(
			"value" => "administrador", 
			"label" => "Administrador", 
		),
		array(
			"value" => "usuario", 
			"label" => "Usuario", 
		),);

}