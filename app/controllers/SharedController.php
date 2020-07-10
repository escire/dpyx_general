<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * subcategoria_categoria_id_option_list Model Action
     * @return array
     */
	function subcategoria_preguntas_valores_option_list($pregunta_id){
		$db = $this->GetModel();
		$sqltext = "SELECT max_num AS value, max_num AS label FROM pregunta WHERE pregunta_id = ?";
		$queryparams = array($pregunta_id);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}


	function subcategoria_categoria_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT categoria_id AS value,nombre AS label FROM categoria";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}


	/**
     * usuario_usuario_value_exist Model Action
     * @return array
     */
	function usuario_usuario_value_exist($val){
		$db = $this->GetModel();
		$db->where('usuario', $val);
		$exist = $db->has('usuario');
		return $exist;
	}

	/**
     * usuario_correo_value_exist Model Action
     * @return array
     */
	function usuario_correo_value_exist($val){
		$db = $this->GetModel();
		$db->where('correo', $val);
		$exist = $db->has('usuario');
		return $exist;
	}

	/**
     * pregunta_categoria_id_option_list Model Action
     * @return array
     */
	function pregunta_categoria_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT categoria_id AS value,nombre AS label FROM categoria";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pregunta_subcategoria_id_option_list Model Action
     * @return array
     */
	function pregunta_subcategoria_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT subcategoria_id AS value,nombre AS label FROM subcategoria" ;
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

}
