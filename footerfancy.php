


 <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

<!--DataTable -->
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>
    <!-- SUMMERNOTE -->
    <script src="js/plugins/summernote/summernote-bs4.js"></script>
    <!-- Bootstrap markdown -->
    <script src="js/plugins/bootstrap-markdown/bootstrap-markdown.js"></script>
    <script src="js/plugins/bootstrap-markdown/markdown.js"></script>

    <!-- jqGrid -->
    <script src="js/plugins/jqGrid/i18n/grid.locale-en.js"></script>
    <script src="js/plugins/jqGrid/jquery.jqGrid.min.js"></script>
    <!-- Ladda -->
    <script src="js/plugins/ladda/spin.min.js"></script>
    <script src="js/plugins/ladda/ladda.min.js"></script>
    <script src="js/plugins/ladda/ladda.jquery.min.js"></script>
    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>
<!-- Validate -->
    <script src="jquery/jquery.validate.js"></script>
    <script src="jquery/additional-methods.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!--FancyBox-->

<!-- <script type="text/javascript" src="jquery/lib/jquery-1.10.2.min.js"></script>-->
<script type="text/javascript" src="jquery/lib/jquery.mousewheel.pack.js"></script>
<script type="text/javascript" src="jquery/source/jquery.fancybox.pack.js?v=2.1.7"></script>
<script type="text/javascript" src="jquery/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="jquery/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="jquery/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script>
    $(document).ready(function(){
            $('#frmregistroproductoscomp').validate(
                        {
                          rules: {
                            txtproducto: {required:true, remote:{type:'POST', url:"servlets/checkproducto.php"} },
                            slsfamiliacomp: {required:true},
                            txtSKUcomp:{required:true},
                            txtmarcacomp:{required:true},
                            txtmodelocomp:{required:true},
                            slsstatuscomp:{required:true},
                            textadescripcioncomp:{required:true},
                            slsumedida:{required:true}
                        },
                          messages: {
                            txtproducto: {required:"Ingrese el nombre del producto",remote:"Prodcuto ya registrado"},
                            slsfamiliacomp: {required:"Seleccione la familia del producto"},
                            txtSKUcomp:{required:"Ingrese codigo SKU producto"},
                            txtmarcacomp:{required:"Ingrese la marca del producto"},
                            txtmodelocomp:{required:"Ingrese el modelo del producto"},
                            slsstatuscomp:{required:"Seleccione el estatus del producto"},
                            textadescripcioncomp:{required:"Ingrese descripción del producto"},
                            slsumedida:{required:"Seleccione la unidad de medida para el nuevo producto"}
                          }

                        }
                    );


                $("#frmregistroproductoscomp").on('submit',(function(e) {
              e.preventDefault();
              $.ajax({
                     url: "servlets/registrarproductoscomp.php",
               type: "POST",
               data:  new FormData(this),
               contentType: false,
                     cache: false,
               processData:false,
               beforeSend : function()
               {
                //$("#preview").fadeOut();
                $("#err").fadeOut();
               },
               success: function(data)
                  {
                    datajson=JSON.parse(data);
                if(datajson.result!='1')
                {
                 // invalid file format.
                 //$("#err").html("Invalid File !").fadeIn();

                        swal({
                            title: "",
                            text: data,
                            type: "error"
                        });
                }
                else
                {
                 // view uploaded file.
                 //$("#preview").html(data).fadeIn();
                 //$("#form")[0].reset();

                    swal({
                        title: "",
                        text: "Registro nuevo producto exitosamente",
                        type: "success"
                    });
                    console.log(datajson);
                    window.parent.$('#tbcompra tbody').html(datajson.tabla);
                    
                }
                  },
                 error: function(e)
                  {
                //$("#err").html(e).fadeIn();

                    swal({
                        title: "",
                        text: e,
                        type: "warning"
                        });
                  }
                });
             }));

            
            //registrar abono venta
            $('#frmabonosventa').validate(
                {
                    rules: {
                        textabonoventa: {required:true},
                        rbtnpago: {required:true}
                    },
                    messages: {
                        textabonoventa: {required:"Ingrese el monto a abonar"},
                        rbtnpago: {required:"Seleccione el método de pago"}
                    },
                    submitHandler: function(form) {
                swal({
                    title: "",
                    text: "Los datos capturados son correctos?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "SI",
                    closeOnConfirm: false
                }, function () {
                    $.post( "servlets/registrar_abono.php",$("#frmabonosventa").serialize(), function( data ) {
                        console.log(data);
                            if(data==1){
                                swal({
                                    title: "Guardado!",
                                    text: "El abono se registro correctamente.",
                                    type: "success"
                                });
                            }else{
                                swal({
                                    title: "ERROR!",
                                    text: data,
                                    type: "error"
                                });
                            }
                    });
                });
            }
                    /*submitHandler: function(form) {
                        $.post( "servlets/registrar_abono.php",$("#frmabonosventa").serialize(), function( data ) {
                            console.log(data);
                            if(data ==1 ){
                                swal({
                                title: "",
                                text: "Registro abono exitosamente",
                                type: "success"
                                });
                            }else{
                                swal({
                                    title: "error",
                                    text: data,
                                    type: "warning"
                                });
                            }
                        }
                        );
                    }*/
                }
            );


            $('#textabonoventa').keyup(function(){

                inicial = $('#textabonoiventa').val();
                abono = $(this).val();

                final = inicial - abono;

                $('#txtsaldodeuventa').val(final);

            });


        }
    );


</script>


</body>

</html>
