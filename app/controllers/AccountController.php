<?php 
/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID;
		$db->where ("usuario_id", $rec_id);
		$tablename = $this->tablename = 'usuario';
		$user = $db->getOne($tablename , '*');
		if(!empty($user)){
			$this->view->render("account/view.php" ,$user,"main_layout.php");
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
			$this->view->render("account/view.php", null ,"main_layout.php");
		}
	}
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit(){
		$db = $this->GetModel();
		$this->rec_id = USER_ID;
		$tablename = $this->tablename = 'usuario';
		$fields = $this->fields = array('usuario_id','nombre','usuario','telefono','contacto','rol'); //editable fields
		if(is_post_request()){
			Csrf :: cross_check();
			$postdata = $this->transform_request_data($_POST);

                        if(USER_ROLE=="administrador"){
                                $this->rules_array = array(
                                        'nombre' => 'required',
                                        'usuario' => 'required',
                                        'rol' => 'required',
                                );
                        }else{
                                        $this->rules_array = array(
                                        'nombre' => 'required',
                                );

                        }


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
				$db->where('usuario',$modeldata['usuario'])->where('usuario_id',USER_ID,'!=');
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['usuario']." ¡Ya existe!";
				}
			} 
			if(empty($this->view->page_error)){
				$db->where('usuario.usuario_id' , USER_ID);
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$db->where ('usuario_id', USER_ID);
					$user = $db->getOne($tablename , '*');
					set_session('user_data',$user);
					if(is_ajax()){
						render_json("Registro actualizado con éxito");
					}
					else{
						set_flash_msg("Registro actualizado con éxito",'success');
						if(!empty($this->redirect)){ 
							redirect_to_page($this->redirect); //if redirect url is passed via $_GET
						}
						else{
							redirect_to_page("account");
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
								redirect_to_page("account");
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
		$db->where('usuario.usuario_id' , USER_ID);
		$data = $db->getOne($tablename, $fields);
		$this->view->page_title ="Mi cuenta";
		if(!empty($data)){
			$this->view->render('account/edit.php' , $data, 'main_layout.php');
		}
		else{
			if($db->getLastError()){
				$this->view->page_error[] = $db->getLastError();
			}
			else{
				$this->view->page_error[] = "Registro no encontrado";
			}
			$this->view->render('account/edit.php' , $data , 'main_layout.php');
		}
	}
	/**
     * Change Email Action
     * @return View
     */
	function change_email(){
		if(is_post_request()){
			Csrf :: cross_check();
			$form_collection = $_POST;
			$email=trim($form_collection['correo']);
			$db = $this->GetModel();
			$rec_id = $this->rec_id = USER_ID;
			$tablename = $this->tablename = 'usuario';
			$db->where ("usuario_id", $rec_id);
			$result = $db->update($tablename, array('correo' => $email ));
			if($result){
				set_flash_msg("La dirección de correo electrónico cambió con éxito",'success');
				redirect_to_page("account");
			}
			else{
				$page_error =  "Correo electrónico no cambiado";
				$this->view->page_error = $page_error;
				$this->view->render("account/change_email.php" , null , "main_layout.php");
			}
		}
		else{
			$this->view->render("account/change_email.php" ,null,"main_layout.php");
		}
	}
}
