<?php 
/**
 * Pregunta Page Controller
 * @category  Controller
 */

require_once('vendor/autoload.php');
use League\Csv\Writer;


class PreguntaController extends SecureController{
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
		$tablename = $this->tablename = 'pregunta';
		$fields = array('pregunta.pregunta_id', 
			'pregunta.descripcion', 
			'pregunta.orden', 
			'categoria.nombre AS categoria_nombre',
			'categoria.categoria_id AS categoria_id',
			'subcategoria.subcategoria_id AS subcategoria_id',
			'subcategoria.nombre AS subcategoria_nombre');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		$getdata = $this->getdata; //array of sanitized values passed via $_GET;
		if(!empty($this->search)){
			$text = trim($this->search);
			$db->where("(pregunta.pregunta_id LIKE ? OR pregunta.descripcion LIKE ? OR pregunta.orden LIKE ? OR pregunta.categoria_id LIKE ? OR pregunta.subcategoria_id LIKE ? OR categoria.nombre LIKE ? OR subcategoria.nombre LIKE ?)", array("%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"));
		}
		$db->join("categoria","pregunta.categoria_id = categoria.categoria_id","LEFT");
		$db->join("subcategoria","pregunta.subcategoria_id = subcategoria.subcategoria_id","LEFT");
		if(!empty($this->orderby)){ // when order by request fields (from $_GET param)
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('pregunta.pregunta_id', ORDER_TYPE);
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
		echo count($records);
		$data->total_records = intval($tc->totalCount);
		if($db->getLastError()){
			$page_error = $db->getLastError();
			$this->view->page_error = $page_error;
		}
		$this->view->page_title ="Pregunta";
		$this->view->render('pregunta/list.php' , $data ,'main_layout.php');
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'pregunta';
		$fields = array('pregunta.pregunta_id', 
			'pregunta.descripcion', 
			'pregunta.orden', 
			'pregunta.categoria_id', 
			'pregunta.subcategoria_id',
			'pregunta.max_num',
			'pregunta.ayuda',
			'categoria.categoria_id AS categoria_categoria_id', 
			'categoria.nombre AS categoria_nombre', 
			'subcategoria.subcategoria_id AS subcategoria_subcategoria_id', 
			'subcategoria.nombre AS subcategoria_nombre');
		$getdata = $this->getdata; //array of sanitized values passed via $_GET;
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('pregunta.pregunta_id' , $rec_id);
		}
		$db->join("categoria","pregunta.categoria_id = categoria.categoria_id","INNER ");
		$db->join("subcategoria","pregunta.subcategoria_id = subcategoria.subcategoria_id","INNER ");  
		$record = $db->getOne($tablename, $fields );
		if(!empty($record)){
			$this->view->page_title ="Ver";
			$this->view->render('pregunta/view.php' , $record ,'main_layout.php');
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
			$this->view->render('pregunta/view.php' , $record , 'main_layout.php');
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
			$tablename = $this->tablename = 'pregunta';
			$fields = $this->fields = array('descripcion','orden','categoria_id','subcategoria_id', 'max_num', 'ayuda'); //insert fields
			$postdata = $this->transform_request_data($_POST);
			$this->rules_array = array(
				'descripcion' => 'required',
				'orden' => 'required',
				'categoria_id' => 'required',
				'subcategoria_id' => 'required',
				'max_num' => 'required'
			);
			$this->sanitize_array = array(
				'descripcion' => 'sanitize_string',
				'orden' => 'sanitize_string',
				'categoria_id' => 'sanitize_string',
				'subcategoria_id' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this -> modeldata = $this->validate_form($postdata);
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
							redirect_to_page("pregunta");
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
		$this->view->render('pregunta/add.php' ,null,'main_layout.php');
	}
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit($rec_id = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename = 'pregunta';
		$fields = $this->fields = array('descripcion','orden','categoria_id','subcategoria_id', 'max_num', 'ayuda'); //editable fields
		if(is_post_request()){
			Csrf :: cross_check();
			$postdata = $this->transform_request_data($_POST);
			$this->rules_array = array(
				'descripcion' => 'required',
				'orden' => 'required',
				'categoria_id' => 'required',
				'subcategoria_id' => 'required',
			);
			$this->sanitize_array = array(
				'descripcion' => 'sanitize_string',
				'orden' => 'sanitize_string',
				'categoria_id' => 'sanitize_string',
				'subcategoria_id' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if(empty($this->view->page_error)){
				$db->where('pregunta.pregunta_id' , $rec_id);
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
							redirect_to_page("pregunta");
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
								redirect_to_page("pregunta");
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
		$db->where('pregunta.pregunta_id' , $rec_id);
		$data = $db->getOne($tablename, $fields);
		$this->view->page_title ="Editar";
		if(!empty($data)){
			$this->view->render('pregunta/edit.php' , $data, 'main_layout.php');
		}
		else{
			if($db->getLastError()){
				$this->view->page_error[] = $db->getLastError();
			}
			else{
				$this->view->page_error[] = "Registro no encontrado";
			}
			$this->view->render('pregunta/edit.php' , $data , 'main_layout.php');
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
		$tablename = $this->tablename = 'pregunta';
		$fields = $this->fields = array('descripcion','orden','categoria_id','subcategoria_id'); //editable fields
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
				'descripcion' => 'required',
				'orden' => 'required',
				'categoria_id' => 'required',
				'subcategoria_id' => 'required',
			);
			$this->sanitize_array = array(
				'descripcion' => 'sanitize_string',
				'orden' => 'sanitize_string',
				'categoria_id' => 'sanitize_string',
				'subcategoria_id' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the POST Data
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if(empty($this->view->page_error)){
				$db->where('pregunta.pregunta_id' , $rec_id);
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
		$tablename = $this->tablename = 'pregunta';
		//split record id separated by comma into array
		$arr_id = explode(',', $rec_ids);
		//set query conditions for all records that will be deleted
		foreach($arr_id as $rec_id){
			$db->where('pregunta.pregunta_id' , $rec_id,"=",'OR');
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
			redirect_to_page("pregunta");
		}
	}

        function exportcsv(){
                $db = $this->GetModel();
                $header = ['ID', 'Pregunta', 'Categoria', 'Subcategoria', 'Ayuda'];
                $fields = array('pregunta_id', 'descripcion', 'categoria.nombre AS categoria_nombre', 'subcategoria.nombre AS subcategoria_nombre', 'ayuda');

                $db->join("categoria","pregunta.categoria_id = categoria.categoria_id","INNER");
                $db->join("subcategoria","pregunta.subcategoria_id = subcategoria.subcategoria_id","INNER");
                $records = $db->get('pregunta', null, $fields);

                $recordsArr = array();
                foreach($records as $record){
                        $record["ayuda"] = html_entity_decode(strip_tags($record["ayuda"]));
                        $recordsArr[] = $record;
                }

                $csv = Writer::createFromString('');
                //$csv->setEnclosure("'");
                $csv->insertOne($header);
                $csv->insertAll($recordsArr);

                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="preguntas.csv"');
                echo $csv->getContent();

        }



}
