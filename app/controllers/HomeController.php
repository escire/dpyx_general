<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index(){

		$db = $this->GetModel();
		$tablename = $this->tablename = 'configuracion';
		$fields = array('configuracion_id', 
			'texto_encabezado');
		$db->where('configuracion_id', 1);
		$record = $db->getOne($tablename, $fields);
		$data["configuracion"] = $record;

		$this->view->render("home/index.php" , $data , "main_layout.php");

	}
}
