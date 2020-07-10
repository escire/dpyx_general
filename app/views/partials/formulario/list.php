
<?php

$comp_model = new SharedController;
$current_page = get_current_url();
$csrf_token = Csrf :: $token;

//Page Data From Controller
$view_data = $this->view_data;

$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;

$field_name = Router :: $field_name;
$field_value = Router :: $field_value;

$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;


?>

<section class="page">
    
    <?php
    if( $show_header == true ){
    ?>
    
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            
            <div class="row ">
                
                <div class="col-sm-4 ">
                    <h3 class="record-title">Formulario</h3>
                    
                </div>
                
                <div class="col-sm-3 ">
                    
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("formulario/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Agregar nuevo 
                    </a>
                    
                </div>
                
                <div class="col-sm-5 ">
                    
                    <form  class="search" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_query_str_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Buscar" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-capitalize" href="<?php print_link('formulario'); ?>">
                                            <i class="fa fa-angle-left"></i> <?php echo make_readable($field_name); ?>
                                        </a>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize"><?php echo make_readable(urldecode($field_value)); ?></li>
                                    <?php 
                                    }   
                                    ?>
                                    
                                    <?php
                                    if(!empty($_GET['search'])){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-capitalize" href="<?php print_link('formulario') ?>">Buscar</a>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize"> <strong><?php echo get_value('search'); ?></strong></li>
                                    <?php
                                    }
                                    ?>
                                    
                                </ul>
                            </nav>  
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <?php
        }
        ?>
        
        <div  class="">
            <div class="container-fluid">
                
                <div class="row ">
                    
                    <div class="col-md-12 comp-grid">
                        
                        <?php $this :: display_page_errors(); ?>
                        
                        <div  class=" animated fadeIn">
                            <div id="formulario-list-records">
                                
                                <?php
                                if(!empty($records)){
                                ?>
                                <div class="page-records table-responsive">
                                    <table class="table  table-striped table-sm">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                
                                                <th class="td-sno td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </th>
                                                
                                                <th class="td-sno">#</th>
                                                <th > Formulario Id</th>
                                                <th > Descripcion</th>
                                                <th > Max Num</th>
                                                <th > Real Num</th>
                                                <th > Orden</th>
                                                
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            $counter = 0;
                                            
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['formulario_id']) ? urlencode($data['formulario_id']) : null);
                                            $counter++;
                                            
                                            
                                            ?>
                                            <tr>
                                                
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['formulario_id'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    
                                                    
                                                    <td><a href="<?php print_link("formulario/$data[formulario_id]") ?>"><?php echo $data['formulario_id']; ?></a></td>
                                                    
                                                    
                                                    
                                                    
                                                    <td>
                                                        <a  data-source='<?php echo json_encode_quote(Menu :: $descripcion); ?>' 
                                                            data-pk="<?php echo $data['formulario_id'] ?>" 
                                                            data-url="<?php print_link("formulario/editfield/" . urlencode($data['formulario_id'])); ?>" 
                                                            data-name="descripcion" 
                                                            data-title="Escribir  Descripcion" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['descripcion']; ?>  
                                                        </a>
                                                    </td>
                                                    
                                                    
                                                    
                                                    
                                                    <td>
                                                        <a  data-step="1" 
                                                            data-source='<?php echo json_encode_quote(Menu :: $descripcion); ?>' 
                                                            data-value="<?php echo $data['max_num']; ?>" 
                                                            data-pk="<?php echo $data['formulario_id'] ?>" 
                                                            data-url="<?php print_link("formulario/editfield/" . urlencode($data['formulario_id'])); ?>" 
                                                            data-name="max_num" 
                                                            data-title="Escribir  Max Num" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['max_num']; ?>  
                                                        </a>
                                                    </td>
                                                    
                                                    
                                                    
                                                    
                                                    <td>
                                                        <a  data-step="1" 
                                                            data-source='<?php echo json_encode_quote(Menu :: $descripcion); ?>' 
                                                            data-value="<?php echo $data['real_num']; ?>" 
                                                            data-pk="<?php echo $data['formulario_id'] ?>" 
                                                            data-url="<?php print_link("formulario/editfield/" . urlencode($data['formulario_id'])); ?>" 
                                                            data-name="real_num" 
                                                            data-title="Escribir  Real Num" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['real_num']; ?>  
                                                        </a>
                                                    </td>
                                                    
                                                    
                                                    
                                                    
                                                    <td>
                                                        <a  data-source='<?php echo json_encode_quote(Menu :: $descripcion); ?>' 
                                                            data-value="<?php echo $data['orden']; ?>" 
                                                            data-pk="<?php echo $data['formulario_id'] ?>" 
                                                            data-url="<?php print_link("formulario/editfield/" . urlencode($data['formulario_id'])); ?>" 
                                                            data-name="orden" 
                                                            data-title="Escribir  Orden" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['orden']; ?>  
                                                        </a>
                                                    </td>
                                                    
                                                    
                                                    
                                                    
                                                    <th class="td-btn">
                                                        
                                                        
                                                        <a class="btn btn-sm btn-success has-tooltip" title="Ver registro" href="<?php print_link("formulario/view/$rec_id"); ?>">
                                                            <i class="fa fa-eye"></i> Ver
                                                        </a>
                                                        
                                                        
                                                        <a class="btn btn-sm btn-info has-tooltip" title="Editar este registro" href="<?php print_link("formulario/edit/$rec_id"); ?>">
                                                            <i class="fa fa-edit"></i> Editar
                                                        </a>
                                                        
                                                        
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Eliminar este registro" href="<?php print_link("formulario/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="¿Seguro que quieres borrar este registro?" data-display-style="modal">
                                                            <i class="fa fa-times"></i>
                                                            Borrar
                                                        </a>
                                                        
                                                        
                                                    </th>
                                                </tr>
                                                <?php 
                                                }
                                                ?>
                                                
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <?php
                                    if( $show_footer == true ){
                                    ?>
                                    <div class="">
                                        <div class="row">   
                                            <div class="col-sm-4">  
                                                <div class="py-2">  
                                                    
                                                    <button data-prompt-msg="¿Está seguro de que desea eliminar estos registros?" data-display-style="modal" data-url="<?php print_link("formulario/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="fa fa-times"></i> Eliminar seleccionado
                                                    </button>
                                                    
                                                    
                                                    
                                                </div>
                                            </div>
                                            <div class="col">   
                                                
                                                <?php
                                                if( $show_pagination == true ){
                                                $pager = new Pagination($total_records,$record_count);
                                                $pager->page_name='formulario';
                                                $pager->show_page_count=true;
                                                $pager->show_record_count=true;
                                                $pager->show_page_limit=true;
                                                $pager->show_page_number_list=true;
                                                $pager->pager_link_range=5;
                                                
                                                $pager->render();
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    }
                                    else{
                                    ?>
                                    <div class="text-muted animated bounce  p-3">
                                        <h4><i class="fa fa-ban"></i> No hay registros</h4>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </section>
        