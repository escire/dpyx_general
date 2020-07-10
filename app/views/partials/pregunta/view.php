
<?php 
//check if current user role is allowed access to the pages
$can_add = PageAccessManager::is_allowed('pregunta/add');
$can_edit = PageAccessManager::is_allowed('pregunta/edit');
$can_view = PageAccessManager::is_allowed('pregunta/view');
$can_delete = PageAccessManager::is_allowed('pregunta/delete');
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
                        $rec_id = (!empty($data['pregunta_id']) ? urlencode($data['pregunta_id']) : null);
                        
                        
                        
                        $counter++;
                        ?>
                        <div class="page-records ">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody>
                                    
                                    <tr>
                                        <th class="title"> Id :</th>
                                        <td class="value"> <?php echo $data['pregunta_id']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> Descripción :</th>
                                        <td class="value"> <?php echo $data['descripcion']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> Orden :</th>
                                        <td class="value"> <?php echo $data['orden']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> Categoria :</th>
                                        <td class="value"> <?php echo $data['categoria_nombre']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> Subcategoria :</th>
                                        <td class="value"> <?php echo $data['subcategoria_nombre']; ?> </td>
                                    </tr>

                                    
                                    <tr>
                                        <th class="title"> M&aacute;ximo :</th>
                                        <td class="value"> <?php echo $data['max_num']; ?> </td>
                                    </tr>

                                    <tr>
                                        <th class="title"> Ayuda :</th>
                                        <td class="value"> <?php echo $data['ayuda']; ?> </td>
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
                            
                            <a class="btn btn-sm btn-info"  href="<?php print_link("pregunta/edit/$rec_id"); ?>">
                                <i class="fa fa-edit"></i> Editar
                            </a>
                            
                            <?php } ?>
                            
                            
                            <?php if($can_delete){ ?>
                            
                            <a class="btn btn-sm btn-danger record-delete-btn"  href="<?php print_link("pregunta/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
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
