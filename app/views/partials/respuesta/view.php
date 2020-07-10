
<?php 
//check if current user role is allowed access to the pages
$can_add = PageAccessManager::is_allowed('respuesta/add');
$can_edit = PageAccessManager::is_allowed('respuesta/edit');
$can_view = PageAccessManager::is_allowed('respuesta/view');
$can_delete = PageAccessManager::is_allowed('respuesta/delete');
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
                        $rec_id = (!empty($data['respuesta_id']) ? urlencode($data['respuesta_id']) : null);
                        
                        
                        
                        $counter++;
                        ?>
                        <div class="page-records ">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody>
                                    
                                    <tr>
                                        <th class="title"> Respuesta Id :</th>
                                        <td class="value"> <?php echo $data['respuesta_id']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> Pregunta Id :</th>
                                        <td class="value"> <?php echo $data['pregunta_id']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> Max Num :</th>
                                        <td class="value"> <?php echo $data['max_num']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> Real Num :</th>
                                        <td class="value"> <?php echo $data['real_num']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> Usuario Id :</th>
                                        <td class="value"> <?php echo $data['usuario_id']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> Fecha Creacion :</th>
                                        <td class="value"> <?php echo $data['fecha_creacion']; ?> </td>
                                    </tr>
                                    
                                    
                                </tbody>
                                <!-- Table Body End -->
                                <tfoot>
                                    <tr>
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="p-3">
                            
                            
                            <?php if($can_edit){ ?>
                            
                            <a class="btn btn-sm btn-info"  href="<?php print_link("respuesta/edit/$rec_id"); ?>">
                                <i class="fa fa-edit"></i> Editar
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
