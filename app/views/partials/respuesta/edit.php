
<?php
$comp_model = new SharedController;
$current_page = get_current_url();
$csrf_token = Csrf :: $token;

$data = $this->view_data;

//$rec_id = $data['__tableprimarykey'];
$page_id = Router :: $page_id;

$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;

?>

<section class="page">
    
    <?php
    if( $show_header == true ){
        ?>
        
        <div  class="bg-light p-3 mb-3">
            <div class="container">
                
                <div class="row ">
                    
                    <div class="col-10 ">
                        <h4 class="record-title"><?php echo $data["categoria_nombre"]; ?></h4>
                        
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
                        <div class="table-responsive">
                            <?php
                            $preguntas = $data["preguntas"];
                            $cnt = 1;
                            foreach($preguntas as $k => $pregunta){
                                ?>
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <?php
                                        if($cnt <= 1){
                                            ?>
                                            <tr>
                                                <th class="bg-light" width="76%"><label>PONDERACI&Oacute;N</label></th>
                                                <th class="bg-light" width="12%"><label >Max</label></th>
                                                <th class="bg-light" width="12%"><label >Real</label></th>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <th class="bg-light"><label ><?php echo $k; ?></label></th>
                                            <th class="bg-light" width="12%"><label class="lmax">
                                                <?php
                                                $arrayMax = array();
                                                $arrayReal = array();
                                                foreach($pregunta as $p){
                                                    $arrayReal[] = $p["descripcion"]["real_num"];
                                                    $arrayMax[] = $p["max_num"];
                                                }
                                                echo array_sum($arrayMax);
                                                ?>
                                                %
                                            </label></th>
                                            <th class="bg-light" width="12%"><label class="lreal"><?php echo array_sum($arrayReal) ?>%</label></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //$preguntas = $data["preguntas"];
                                        $c = 1;
                                        foreach($pregunta as $p){
                                            $descripcion = $p["descripcion"];
                                            $rand = rand();
                                            $ayuda = str_replace(array("\n", "\t", "\r"), '', $p["ayuda"]);
                                            ?>
                                            <tr class="input-row">
                                                <td>
                                                    <label><?php echo  $descripcion["desc"]; ?></label>
                                                    <?php if(!empty($ayuda)){ ?>
                                                        <img id="imgAyuda<?php echo $rand; ?>" src="<?php echo SITE_ADDR; ?>/assets/images/key_question.png">
                                                        <script type="text/javascript">
                                                            tippy('#imgAyuda<?php echo $rand; ?>', {
                                                            theme: 'light',
                                                            trigger: 'click',
                                                            interactive: true,
                                                            maxWidth: 800,
                                                            placement: 'top',
                                                             content: '<?php echo str_replace("'","&#039;", $ayuda); ?>',
                                                            });
                                                        </script>
                                                    <?php } ?>
                                                </td>

                                                
                                                <td>



                                                    <div id="ctrl-real_num-holder" class="">
                                                        <label><?php echo $p["max_num"]; ?></label>                                                        
                                                    </div>
                                                    



                                                </td>
                                                
                                                <td>


                                                    <div class="row">
                                                        <div class="col-sm-11">
                                                            <div class="">

                                                                <?php
                                                                $vals = array();
                                                                $max = $p["max_num"];
                                                                for($i = -$max; $i <= $max; $i++){

                                                                    if($max <= 30){
                                                                        if($i % 5 == 0)
                                                                            $vals[] = $i;

                                                                    }else if($max >= 30 && $max <=50){
                                                                        if($i % 10 == 0)
                                                                            $vals[] = $i;

                                                                        if($i % $max == 0){
                                                                            if($i < 0){
                                                                                if(!in_array(-$max, $vals))
                                                                                    $vals[] = -$max;
                                                                            }
                                                                            else if($i == $max){
                                                                                if(!in_array($max, $vals))
                                                                                    $vals[] = $max;
                                                                            }
                                                                        }

                                                                    }else if($max >= 50 && $max <=100){
                                                                        if($i % 20 == 0)
                                                                            $vals[] = $i;

                                                                        if($i % $max == 0){
                                                                            if($i < 0){
                                                                                if(!in_array(-$max, $vals))
                                                                                    $vals[] = -$max;
                                                                            }
                                                                            else if($i == $max){
                                                                                if(!in_array($max, $vals))
                                                                                    $vals[] = $max;
                                                                            }
                                                                        }
                                                                    }

                                                                }
                                                                $vals = array_reverse($vals);

                                                                ?>
                                                                
                                                                <select required="" class="custom-select ctrl-real_num"  id="ctrl-real_num" name="real_num"  placeholder="Seleccione un valor">
                                                                    
                                                                    
                                                                    <?php
                                                                    $pregunta_id = $p["pregunta_id"];
                                                                    $real_num = $descripcion["real_num"];

                                                                    foreach($vals as $val){
                                                                        $selected = ( $real_num == $val ? 'selected' : null );
                                                                        ?>
                                                                        <option 
                                                                        <?php echo $selected; ?> value="<?php echo $val; ?>"><?php echo $val; ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                
                                                            </select>
                                                            
                                                            
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                                <input type="hidden" name="respuesta_id" value="<?php echo $p["respuesta_id"]  ?>">
                                                <input type="hidden" name="pregunta_id" value="<?php echo $p["pregunta_id"]  ?>">
                                                <input value="<?php  echo  $p["usuario_id"]; ?>" type="hidden" name="usuario_id"  class="form-control " />
                                            </td>

                                            

                                        </tr>
                                        <?php
                                        $c++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            $cnt++; 
                        }
                        ?>
                        <br />
                        <div class="text-center p-3">
                            <input  class="btn btn-success <?php echo $data["cat_id"] < 17 ? "sw-btn-next":"" ?> <?php echo $data["cat_id"] < 17 ? "siguiente":"finalizar" ?>" type="button" name="siguiente" value=" <?php echo $data["cat_id"] < 17 ? "Siguiente":"Finalizar" ?>" />
                        </div>
                    </div>
                    <div class="form-ajax-status"></div>
                </div>
                
            </div>
            
        </div>
    </div>
</div>

</section>
