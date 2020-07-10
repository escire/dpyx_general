<?php 
/**
 * Respuesta Page Controller
 * @category  Controller
 */
class RespuestaController extends SecureController{
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'respuesta';
		$fields = array('respuesta_id', 
			'pregunta_id', 
			'max_num', 
			'real_num', 
			'usuario_id', 
			'fecha_creacion');
		$getdata = $this->getdata; //array of sanitized values passed via $_GET;
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('respuesta.respuesta_id' , $rec_id);
		}
		$record = $db->getOne($tablename, $fields );
		if(!empty($record)){
			$this->view->page_title ="Ver";
			$this->view->render('respuesta/view.php' , $record ,'main_layout.php');
		}
		else{
			$page_error = null;
			if($db->getLastError()){
				$page_error = $db->getLastError();
			}
			else{
				$page_error = "Registro no encontrado";
			}
			$this->view->page_error = $page_error;
			$this->view->render('respuesta/view.php' , $record , 'main_layout.php');
		}
	}
	/**
     * Add New Record Action 
     * If Not $_POST Request, Display Add Record Form View
     * @return View
	 */


        function group_by_cat_sub($key, $data) {
            $result = array();
            $db = $this->GetModel();
            foreach($data as $val) {
                if(array_key_exists($key, $val)){
                    $result[$val[$key]][] = $val;
                }else{
                    $result[""][] = $val;
                }
            }
            return $result;
        }


	function median($array) {
		$iCount = count($array);
		if ($iCount == 0) {
    			throw new DomainException('Median of an empty array is undefined');
  		}
		$middle_index = floor($iCount / 2);
  		sort($array, SORT_NUMERIC);
  		$median = $array[$middle_index]; // assume an odd # of items
  		if ($iCount % 2 == 0) {
    			$median = ($median + $array[$middle_index - 1]) / 2;
  		}
	 	return $median;
	}


	function index(){

	$db = $this->GetModel();
	$db->where('respuesta.usuario_id', USER_ID);
	$db->join("pregunta", "respuesta.pregunta_id = pregunta.pregunta_id","INNER");
	$db->join("categoria", "categoria.categoria_id = pregunta.categoria_id","INNER");
	$db->join("subcategoria", "subcategoria.subcategoria_id = pregunta.subcategoria_id","INNER");
	$db->orderBy("subcategoria.subcategoria_id" , "DESC");
	$respuestas = $db->get('respuesta', null, array('respuesta.respuesta_id', 'respuesta.usuario_id', 'respuesta.pregunta_id', 'categoria.categoria_id','categoria.nombre as categoria', 'pregunta.descripcion','respuesta.real_num', 'subcategoria.nombre as subcategoria'));
	//$respuestas = $db->get('respuesta', array());
	$respuestas = $this->group_by_cat_sub("categoria", $respuestas);
	$all = array();
	foreach($respuestas as $k => $r){
		$all[$k] = $this->group_by_cat_sub("subcategoria", $r);
	}



	$colArr = array();
	foreach($all as $k => $v){
		$allArr = array();
		$medianArray = array();
		foreach($v as $kk => $vv){
			$realArr = array();
			foreach($vv as $kk1 => $vv1){
				$realArr[] = $vv1["real_num"];
			}
			$allArr[] = array_sum($realArr);
			$medianArray[] = array_sum($realArr);
		}
		$allArr["mediana"] = $this->median($medianArray);
		$colArr[$k] = $allArr; 
	}

	$data = array();
	$data["all"] = $colArr;
	


/*


		if(is_post_request()){
			Csrf :: cross_check();
			$db = $this->GetModel();
			$tablename = $this->tablename = 'respuesta';
			$fields = $this->fields = array('max_num','real_num','usuario_id'); //insert fields
			$allpostdata = $this->transform_multi_request_data($_POST);
			if(!empty($allpostdata)){
				$allmodeldata = array();
				foreach($allpostdata as &$postdata){
			$this->rules_array = array(
				'max_num' => 'required|numeric',
				'real_num' => 'required|numeric',
				'usuario_id' => 'required',
			);
			$this->sanitize_array = array(
				'max_num' => 'sanitize_string',
				'real_num' => 'sanitize_string',
				'usuario_id' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this -> modeldata = $this->validate_form($postdata);
					$allmodeldata[] = $modeldata;
				}
				if( empty($this->view->page_error) ){
					$rec_id = $this->rec_id = $db->insertMulti($tablename, $allmodeldata);
					if(!empty($rec_id)){
						if(is_ajax()){
							render_json("Grabar agregado exitosamente");
						}
						else{
							set_flash_msg("Agregado exitosamente",'success');
							if(!empty($this->redirect)){ 
								redirect_to_page($this->redirect); //if redirect url is passed via $_GET
							}
							else{
								redirect_to_page("respuesta");
							}
						}
						return;
					}
					else{
						$page_error = null;
						if($db->getLastError()){
							$page_error = $db->getLastError();
						}
						else{
							$page_error = "Error al insertar el registro";
						}
						if(is_ajax()){
							render_error($page_error); 
							return;
						}
						else{
							$this->view->page_error[] = $page_error;
						}
					}
				}
			}
			else{
				$this->view->page_error[] = "Ningún registro insertado";
			}
		}
 */
		$this->view->render('respuesta/add.php' , $data, 'main_layout.php');
	}
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */

	function isJSON($string){
		return is_string($string) && is_array(json_decode($string, true)) ? true : false;
	}

	function edit($rec_id = null, $next = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'respuesta';
		$fields = $this->fields = array('respuesta_id','pregunta_id','max_num','real_num','usuario_id'); //editable fields
		if(is_post_request()){
			Csrf :: cross_check();
			$postdata = $this->transform_request_data($_POST);

			if(empty($this->view->page_error)){

			$respuestas = $postdata["respuestas"];

			if($this->isJSON($respuestas)){
				$respuestas = json_decode($respuestas);
				foreach ($respuestas as $res) {
					if(empty($res->respuesta_id)){
						$bool = $db->insert($tablename, (array)$res);
						$numRows = $db->getRowCount();
					}else{
						$db->where('respuesta.respuesta_id' , $res->respuesta_id);
						$db->where('respuesta.usuario_id' , $res->usuario_id);
						$bool = $db->update($tablename, (array)$res);
						$numRows = $db->getRowCount();
					}
				}


			}				

				exit(0);
/*
				$db->where('respuesta.respuesta_id' , $rec_id);
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					if(is_ajax()){
						render_json("Registro actualizado con éxito");
					}
					else{
						set_flash_msg("Registro actualizado con éxito",'success');
						if(!empty($this->redirect)){ 
							redirect_to_page($this->redirect); //if redirect url is passed via $_GET
						}
						else{
							redirect_to_page("respuesta");
						}
					}
					return;
				}else{
					$page_error = null;
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No hay registro actualizado";
						if(is_ajax()){
							render_error($page_error); //return http status error
						}
						else{
							//no changes made to the table record
							set_flash_msg($page_error, 'warning');
							if(!empty($this->redirect)){ 
								redirect_to_page($this->redirect); //if redirect url is passed via $_GET
							}
							else{
								redirect_to_page("respuesta");
							}
						}
						return;
					}
					else{
						$page_error = "Registro no encontrado";
					}
					if(is_ajax()){
						render_error($page_error); //return http status error
						return;
					}
					//continue to display edit page with errors
					$this->view->page_error[] = $page_error;
				}
*/
			}

		}

		$db->where('categoria.categoria_id', $rec_id);
		$categoria = $db->getOne('categoria', array());
		$categoria_nombre = $categoria["nombre"];

		$db->where('pregunta.categoria_id', $rec_id);
		$db->join("subcategoria", "pregunta.subcategoria_id = subcategoria.subcategoria_id","INNER");
		$preguntas = $db->get('pregunta', array());
		$preguntas = $this->group_by("nombre", $preguntas);
		$data["categoria_nombre"] = $categoria_nombre;
		$data["preguntas"] = $preguntas;
		$data["cat_id"] = $rec_id;

		if(!empty($data)){
			$this->view->render('respuesta/edit.php' , $data, 'main_layout.php');
		}
		else{
			if($db->getLastError()){
				//$this->view->page_error[] = $db->getLastError();
			}
			else{
				//$this->view->page_error[] = "Registro no encontrado";
			}
			$this->view->render('respuesta/edit.php' , $data , 'main_layout.php');
		}
	}


	function group_by($key, $data) {
	    $result = array();
	    $db = $this->GetModel();
	    foreach($data as $val) {
	        if(array_key_exists($key, $val)){
	        	$db->where('usuario_id', USER_ID);
	        	$db->where('pregunta_id', $val["pregunta_id"]);
	        	$respuesta = $db->getOne('respuesta', array());
	        	$val["respuesta_id"] = $respuesta["respuesta_id"];
	        	$val["pregunta_id"] = $val["pregunta_id"];
	        	$val["usuario_id"] = USER_ID;
	        	$val["descripcion"] = array("desc" => $val["descripcion"], "real_num" => $respuesta["real_num"]);
	            $result[$val[$key]][] = $val;
	        }else{
	            $result[""][] = $val;
	        }
	    }
	    return $result;
	}

	/**
     * Edit single field Action 
     * Return record id
     * @return View
     */
	function editfield($rec_id = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'respuesta';
		$fields = $this->fields = array('respuesta_id','pregunta_id','max_num','real_num','usuario_id'); //editable fields
		if(is_post_request()){
			Csrf :: cross_check();
			$postdata = array();
			if(isset($_POST['name']) && isset($_POST['value'])){
				$fieldname = $_POST['name'];
				$fieldvalue = $_POST['value'];
				$postdata[$fieldname] = $fieldvalue;
				$postdata = $this->transform_request_data($postdata);
			}
			else{
				$this->view->page_error = "invalid post data";
			}
			$this->rules_array = array(
				'pregunta_id' => 'required',
				'max_num' => 'required|numeric',
				'real_num' => 'required|numeric',
				'usuario_id' => 'required',
			);
			$this->sanitize_array = array(
				'pregunta_id' => 'sanitize_string',
				'max_num' => 'sanitize_string',
				'real_num' => 'sanitize_string',
				'usuario_id' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the POST Data
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if(empty($this->view->page_error)){
				$db->where('respuesta.respuesta_id' , $rec_id);
				try{
					$bool = $db->update($tablename, $modeldata);
					$numRows = $db->getRowCount();
					if($bool && $numRows){
						render_json(
							array(
								'num_rows' =>$numRows,
								'rec_id' =>$rec_id,
							)
						);
					}
					else{
						$page_error = null;
						if($db->getLastError()){
							$page_error = $db->getLastError();
						}
						elseif(!$numRows){
							$page_error = "No hay registro actualizado";
						}
						else{
							$page_error = "Registro no encontrado";
						}
						render_error($page_error);
					}
				}
				catch(Exception $e){
					render_error($e->getMessage());
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		else{
			render_error("Request type not accepted");
		}
	}
}
