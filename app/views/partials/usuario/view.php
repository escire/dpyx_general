
<?php 
//check if current user role is allowed access to the pages
$can_add = PageAccessManager::is_allowed('usuario/add');
$can_edit = PageAccessManager::is_allowed('usuario/edit');
$can_view = PageAccessManager::is_allowed('usuario/view');
$can_delete = PageAccessManager::is_allowed('usuario/delete');
?>

<?php
$comp_model = new SharedController;
$current_page = get_current_url();
$csrf_token = Csrf :: $token;

//Page Data Information from Controller
$data = $this->view_data;

//$rec_id = $data['__tableprimarykey'];
$page_id = Router::$page_id; //Page id from url

$view_title = $this->view_title;

$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;

?>

<section class="page">
    
    <?php
    if( $show_header == true ){
    ?>
    
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            
            <div class="row ">
                
                <div class="col-12 ">
                    <h3 class="record-title">Ver</h3>
                    
                </div>
                
            </div>
        </div>
    </div>
    
    <?php
    }
    ?>
    
    <div  class="">
        <div class="container">
            
            <div class="row ">
                
                <div class="col-md-12 comp-grid">
                    
                    <?php $this :: display_page_errors(); ?>
                    
                    <div  class=" animated fadeIn">
                        <?php
                        
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['usuario_id']) ? urlencode($data['usuario_id']) : null);
                        
                        
                        
                        $counter++;
                        ?>
                        <div class="profile-bg mb-2">
                            <div class="profile">
                                <div class="d-flex flex-row justify-content-center">
                                    <div class="avatar"><img src="<?php print_link("assets/images/avatar.png") ?>" /> </div>
                                        <h2 class="title"><?php echo $data['usuario']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="page-records ">
                                <table class="table table-hover table-borderless table-striped">
                                    <tbody>
                                        
                                        <tr>
                                            <th class="title"> Id :</th>
                                            <td class="value"> <?php echo $data['usuario_id']; ?> </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <th class="title"> Nombre :</th>
                                            <td class="value"> <?php echo $data['nombre']; ?> </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <th class="title"> Usuario :</th>
                                            <td class="value"> <?php echo $data['usuario']; ?> </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <th class="title"> Correo :</th>
                                            <td class="value"> <?php echo $data['correo']; ?> </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <th class="title"> Teléfono :</th>
                                            <td class="value"> <?php echo $data['telefono']; ?> </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <th class="title"> Rol :</th>
                                            <td class="value"> <?php echo $data['rol']; ?> </td>
                                        </tr>
                                        
                                        
                                    </tbody>    
                                </table>    
                            </div>  
                            <div class="mt-2">
                                
                                
                                <?php if($can_edit){ ?>
                                
                                <a class="btn btn-sm btn-info"  href="<?php print_link("usuario/edit/$rec_id"); ?>">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                
                                <?php } ?>
                                
                                
                                <?php if($can_delete){ ?>
                                
                                <a class="btn btn-sm btn-danger record-delete-btn"  href="<?php print_link("usuario/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
                                    <i class="fa fa-times"></i> Borrar
                                </a>
                                
                                <?php } ?>
                                
                                
                                
                            </div>
                            <?php
                            }
                            else{
                            ?>
                            <!-- Empty Record Message -->
                            <div class="text-muted p-3">
                                <i class="fa fa-ban"></i> ningún record fue encontrado
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
    </section>
    