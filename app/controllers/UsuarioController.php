<?php 
/**
 * Usuario Page Controller
 * @category  Controller
 */
class UsuarioController extends SecureController{
	/**
     * Load Record Action 
     * $arg1 Field Name
     * $arg2 Field Value 
     * $param $arg1 string
     * $param $arg1 string
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		$db = $this->GetModel();
		$tablename = $this->tablename = 'usuario';
		$fields = array('usuario_id', 
			'nombre', 
			'usuario', 
			'correo');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		$getdata = $this->getdata; //array of sanitized values passed via $_GET;
		if(!empty($this->search)){
			$text = trim($this->search);
			$db->where("(usuario_id LIKE ? OR nombre LIKE ? OR usuario LIKE ? OR contra LIKE ? OR correo LIKE ? OR telefono LIKE ? OR contacto LIKE ? OR rol LIKE ?)", array("%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"));
		}
		if(!empty($this->orderby)){ // when order by request fields (from $_GET param)
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('usuario.usuario_id', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , $fieldvalue);
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $limit, $fields);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		if($db->getLastError()){
			$page_error = $db->getLastError();
			$this->view->page_error = $page_error;
		}
		$this->view->page_title ="Usuario";
		$this->view->render('usuario/list.php' , $data ,'main_layout.php');
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'usuario';
		$fields = array('usuario_id', 
			'nombre', 
			'usuario', 
			'correo', 
			'telefono', 
			'rol');
		$getdata = $this->getdata; //array of sanitized values passed via $_GET;
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('usuario.usuario_id' , $rec_id);
		}
		$record = $db->getOne($tablename, $fields );
		if(!empty($record)){
			$this->view->page_title ="Ver";
			$this->view->render('usuario/view.php' , $record ,'main_layout.php');
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
			$this->view->render('usuario/view.php' , $record , 'main_layout.php');
		}
	}
	/**
     * Add New Record Action 
     * If Not $_POST Request, Display Add Record Form View
     * @return View
     */
	function add(){
		if(is_post_request()){
			Csrf :: cross_check();
			$db = $this->GetModel();
			$tablename = $this->tablename = 'usuario';
			$fields = $this->fields = array('nombre','usuario','contra','correo','telefono','contacto','rol'); //insert fields
			$postdata = $this->transform_request_data($_POST);
			$cpassword = $postdata['confirm_password'];
			$password = $postdata['contra'];
			if($cpassword != $password){
				$this->view->page_error[] = "La confirmación de su contraseña no es consistente";
			}
			$this->rules_array = array(
				'nombre' => 'required',
				'usuario' => 'required',
				'contra' => 'required',
				'correo' => 'required|valid_email',
				'rol' => 'required',
			);
			$this->sanitize_array = array(
				'nombre' => 'sanitize_string',
				'usuario' => 'sanitize_string',
				'correo' => 'sanitize_string',
				'telefono' => 'sanitize_string',
				'contacto' => 'sanitize_string',
				'rol' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this -> modeldata = $this->validate_form($postdata);
			$password_text = $modeldata['contra'];
			$modeldata['contra'] = password_hash($password_text , PASSWORD_DEFAULT);
			//Check if Duplicate Record Already Exit In The Database
			$db->where('usuario',$modeldata['usuario']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['usuario']." ¡Ya existe!";
			}
			//Check if Duplicate Record Already Exit In The Database
			$db->where('correo',$modeldata['correo']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['correo']." ¡Ya existe!";
			} 
			if(empty($this->view->page_error)){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
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
							redirect_to_page("usuario");
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
		$this->view->page_title ="Agregar nuevo";
		$this->view->render('usuario/add.php' ,null,'main_layout.php');
	}
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit($rec_id = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'usuario';
		$fields = $this->fields = array('usuario_id','nombre','usuario','telefono','contacto','rol'); //editable fields
		if(is_post_request()){
			Csrf :: cross_check();
			$postdata = $this->transform_request_data($_POST);
			$this->rules_array = array(
				'nombre' => 'required',
				'usuario' => 'required',
				'rol' => 'required',
			);
			$this->sanitize_array = array(
				'nombre' => 'sanitize_string',
				'usuario' => 'sanitize_string',
				'telefono' => 'sanitize_string',
				'contacto' => 'sanitize_string',
				'rol' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['usuario'])){
				$db->where('usuario',$modeldata['usuario'])->where('usuario_id',$rec_id,'!=');
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['usuario']." ¡Ya existe!";
				}
			} 
			if(empty($this->view->page_error)){
				$db->where('usuario.usuario_id' , $rec_id);
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
							redirect_to_page("usuario");
						}
					}
					return;
				}
				else{
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
								redirect_to_page("usuario");
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
			}
		}
		$db->where('usuario.usuario_id' , $rec_id);
		$data = $db->getOne($tablename, $fields);
		$this->view->page_title ="Editar";
		if(!empty($data)){
			$this->view->render('usuario/edit.php' , $data, 'main_layout.php');
		}
		else{
			if($db->getLastError()){
				$this->view->page_error[] = $db->getLastError();
			}
			else{
				$this->view->page_error[] = "Registro no encontrado";
			}
			$this->view->render('usuario/edit.php' , $data , 'main_layout.php');
		}
	}
	/**
     * Edit single field Action 
     * Return record id
     * @return View
     */
	function editfield($rec_id = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'usuario';
		$fields = $this->fields = array('usuario_id','nombre','usuario','telefono','contacto','rol'); //editable fields
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
				'nombre' => 'required',
				'usuario' => 'required',
				'rol' => 'required',
			);
			$this->sanitize_array = array(
				'nombre' => 'sanitize_string',
				'usuario' => 'sanitize_string',
				'telefono' => 'sanitize_string',
				'contacto' => 'sanitize_string',
				'rol' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the POST Data
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['usuario'])){
				$db->where('usuario',$modeldata['usuario'])->where('usuario_id',$rec_id,'!=');
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['usuario']." ¡Ya existe!";
				}
			} 
			if(empty($this->view->page_error)){
				$db->where('usuario.usuario_id' , $rec_id);
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
	/**
     * Delete Record Action 
     * @return View
     */
	function delete( $rec_ids = null ){
		Csrf :: cross_check();
		$db = $this->GetModel();
		$this->rec_id = $rec_ids;
		$tablename = $this->tablename = 'usuario';
		//split record id separated by comma into array
		$arr_id = explode(',', $rec_ids);
		//set query conditions for all records that will be deleted
		foreach($arr_id as $rec_id){
			$db->where('usuario.usuario_id' , $rec_id,"=",'OR');
		}
		$bool = $db->delete($tablename);
		if($bool){
			set_flash_msg("Eliminado con éxito",'success');
		}
		else{
			$page_error = "";
			if($db->getLastError()){
				$page_error = $db->getLastError();
			}
			else{
				$page_error = "Error al eliminar el registro por favor, asegúrese de que la salida de registro";
			}
			set_flash_msg($page_error,'danger');
		}
		if(!empty($this->redirect)){ 
			redirect_to_page($this->redirect); //if redirect url is passed via $_GET
		}
		else{
			redirect_to_page("usuario");
		}
	}
}
