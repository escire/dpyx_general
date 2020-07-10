
<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = get_current_url();
$csrf_token = Csrf :: $token;
$data = $this->view_data;
$nombreCorto = array('Pol&iacute;ticas', 'Calidad','Edici&oacute;n digital','&Eacute;tica','Hardware','Accesibilidad','Visibilidad','Interacci&oacute;n');

?>
<div>
    
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            
            <div class="row ">
                
                <div class="col-md-12 comp-grid">
                    <div class="texto_descriptivo"><?php echo $data["configuracion"]["texto_encabezado"]; ?></div>
                    
                </div>
                
                <div class="col-md-11 comp-grid">
                    
                    <div class="text-left">
                        <h4></h4>
                        <p class="text-muted"></p>
                    </div>
                    <div class="smartwizard" data-theme="arrows"  data-form-action="">
                        <ul>
                            <?php
                            $page = 1;
                            foreach ($nombreCorto as $nc) {
                            $str = '<li class="done">
                                        <a href="#FormWizard-1-Page' . $page . '">
                                            ' . $nc . '
                                            <br /><small></small>
                                        </a>
                                    </li>';
                                echo $str . PHP_EOL;
                                $page++;
                            }
                            ?>

                            
                        </ul>
                        <div>
                            
                            <div class="card formtab" id="FormWizard-1-Page1" data-next-page="FormWizard-1-Page2" data-submit-action="MOVE-NEXT">
                                
                                <div class=" reset-grids">
                                    <?php  
                                    $this->redirect_to='#FormWizard-1-Page2';
                                    $this->render_page("respuesta/edit/10/2" , array( 'show_header' => true )); 
                                    ?>
                                </div>
                                
                                
                                <div class="text-center p-3">
                                    
                                </div>
                                
                            </div>
                            
                            <div class="card formtab" id="FormWizard-1-Page2" data-next-page="FormWizard-1-Page3" data-submit-action="SUBMIT-STEP-FORM">
                                
                                <div class=" reset-grids">
                                    <?php  
                                    $this->redirect_to='#FormWizard-1-Page3';
                                    $this->render_page("respuesta/edit/11" , array( 'show_header' => true )); 
                                    ?>
                                </div>
                                
                                
                                <div class="text-center p-3">
                                    
                                </div>
                                
                            </div>
                            
                            <div class="card formtab" id="FormWizard-1-Page3" data-next-page="FormWizard-1-Page4" data-submit-action="SUBMIT-STEP-FORM">
                                
                                <div class=" reset-grids">
                                    <?php  
                                    $this->redirect_to='#FormWizard-1-Page4';
                                    $this->render_page("respuesta/edit/12" , array( 'show_header' => true )); 
                                    ?>
                                </div>
                                
                                
                                <div class="text-center p-3">
                                    
                                </div>
                                
                            </div>
                            
                            <div class="card formtab" id="FormWizard-1-Page4" data-next-page="FormWizard-1-Page5" data-submit-action="SUBMIT-ALL-FORMS">
                                
                                <div class=" ">
                                    <?php  
                                    $this->redirect_to='#FormWizard-1-Page5';
                                    $this->render_page("respuesta/edit/13" , array( 'show_header' => true )); 
                                    ?>
                                </div>
                                
                                
                                <div class="text-center p-3">
                                    
                                </div>
                                
                            </div>
                            
                            <div class="card formtab" id="FormWizard-1-Page5" data-next-page="FormWizard-1-Page6" data-submit-action="">
                                
                                <div class=" ">
                                    <?php  
                                    $this->redirect_to='#FormWizard-1-Page6';
                                    $this->render_page("respuesta/edit/14" , array( 'show_header' => true )); 
                                    ?>
                                </div>
                                
                                
                                <div class="text-center p-3">
                                    
                                </div>
                                
                            </div>
                            
                            <div class="card formtab" id="FormWizard-1-Page6" data-next-page="FormWizard-1-Page7" data-submit-action="SUBMIT-STEP-FORM">
                                
                                <div class=" ">
                                    <?php  
                                    $this->redirect_to='#FormWizard-1-Page7';
                                    $this->render_page("respuesta/edit/15" , array( 'show_header' => true )); 
                                    ?>
                                </div>
                                
                                
                                <div class="text-center p-3">
                                    
                                </div>
                                
                            </div>
                            
                            <div class="card formtab" id="FormWizard-1-Page7" data-next-page="FormWizard-1-Page8" data-submit-action="SUBMIT-STEP-FORM">
                                
                                <div class=" ">
                                    <?php  
                                    $this->redirect_to='#FormWizard-1-Page8';
                                    $this->render_page("respuesta/edit/16" , array( 'show_header' => true )); 
                                    ?>
                                </div>
                                
                                <div class="text-center p-3">
                                    
                                </div>
                                
                            </div>
                            
                            <div class="card formtab" id="FormWizard-1-Page8" data-next-page="FormWizard-1-Page9" data-submit-action="SUBMIT-STEP-FORM">
                                
                                <div class=" ">
                                    <?php  
                                    $this->redirect_to='#FormWizard-1-Page9';
                                    $this->render_page("respuesta/edit/17" , array( 'show_header' => true )); 
                                    ?>
                                </div>
                                
                                
                                <div class="text-center p-3">
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    
</div>


            <script type="text/javascript">
 
                $(".siguiente, .finalizar").on("click", function(e){
                    $(document).ajaxStart($.blockUI({ message: '<h5>Cargando...</h5>', css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff', top: '10px', left: '', right: '10px'  
                    } })).ajaxStop($.unblockUI);

                    var tabla = $(this).parent().parent(); 
                    var tr = $(tabla).find("tbody > tr");
                    var arr = Array();
                    $.each(tr, function(k, v){
                        var real_num = $(v).find("select[name='real_num']").val();
                        var usuario_id = $(v).find("input[name='usuario_id']").val();
                        var respuesta_id = $(v).find("input[name='respuesta_id']").val();
                        var pregunta_id = $(v).find("input[name='pregunta_id']").val();

                        arr.push({"real_num": real_num, "usuario_id": usuario_id, "respuesta_id": respuesta_id, "pregunta_id": pregunta_id});

                    });

                    $.post("<?php print_link("respuesta/edit?csrf_token=$csrf_token") ?>",{
                        respuestas: JSON.stringify(arr)
                    },
                    function(data, status){
                        location.reload();

                        //alert("Data: " + data + "\nStatus: " + status);
                    });


                    $.each(arr, function(k, v){
//                        console.log(v);
                    })
                   //console.log($(this).parent().parent().find( "input[name='max_num[]']" ).val());                   
                })
 
                $(".ctrl-real_num").on("change", function(){
                    var tabla = $(this).closest(".table-sm");
                    real_num = tabla.find(".ctrl-real_num");
                    var total = 0;
                    $.each(real_num, function(k,v){
                        total += parseInt($(v).val());
                    });
                    $(tabla).find(".lreal").html(total + "%");

                });

            </script>

