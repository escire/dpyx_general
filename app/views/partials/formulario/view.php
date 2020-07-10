
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
                        $rec_id = (!empty($data['formulario_id']) ? urlencode($data['formulario_id']) : null);
                        
                        
                        
                        $counter++;
                        ?>
                        <div class="page-records ">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody>
                                    
                                    <tr>
                                        <th class="title"> Formulario Id :</th>
                                        <td class="value"> <?php echo $data['formulario_id']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> Descripcion :</th>
                                        <td class="value"> <?php echo $data['descripcion']; ?> </td>
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
                                        <th class="title"> Orden :</th>
                                        <td class="value"> <?php echo $data['orden']; ?> </td>
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
                            
                            
                            <a class="btn btn-sm btn-info"  href="<?php print_link("formulario/edit/$rec_id"); ?>">
                                <i class="fa fa-edit"></i> Editar
                            </a>
                            
                            
                            <a class="btn btn-sm btn-danger record-delete-btn"  href="<?php print_link("formulario/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
                                <i class="fa fa-times"></i> Borrar
                            </a>
                            
                            
                            
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
