$(document).ready(function() {

    actualizarTabla();
    
    console.log(localStorage.getItem("Operacion"));

    console.log(localStorage.getItem("pagina"));

    if(localStorage.getItem("pagina")=="registro_operacion"){
        //if(localStorage.getItem("Operacion")!= undefined && localStorage.getItem("pagina")==undefined){
        console.log("Entra al selector");
        $("input[name=radioInline][value='"+localStorage.getItem("Operacion")+"']").click();
        // $("input[name=radioInline][value='"+localStorage.getItem("Operacion")+"']").prop('checked', true);
        ShowHideDiv($("input[name=radioInline][value='"+localStorage.getItem("Operacion")+"']"));
        //}
    }

    $('#txtfecha_compra').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        endDate: new Date(new Date().setDate(new Date().getDate() )),
        minDate:  new Date(),
        maxDate: new Date(new Date().setDate(new Date().getDate() ))

    });

    $('#slsproveedor').select2();
    //Bloque Cotizaciones

    function actualizarTablaCotizacion(){
        console.log("Entra Ctoizacion...");
        
        var cantidades=[];
        var precios=[];
        var preciosTotal=[];
        var total = 0;
        var descuentos_total=0;
        var descuentos= [];
        var porcentual=0;

        $("#tbcotiza tbody > tr ").each(function(){
            
            var id = Number($(this).find('.id').text());
            var cantidad=Number($(this).find('.cantidades').val());
            var preciocompra=Number($(this).find('.precio_compra').val());
            
            //console.log(cantidad);
            cantidades.push(cantidad);
            
            var precio=Number($(this).find('.precios').val());
            precios.push(precio);

            var descuento = Number($(this).find('.descuentos').val());
            descuentos.push(descuento);
            porcentual=descuento/100;
            
            //console.log(descuento);
            //console.log(porcentual);

            var total_unitario=cantidad*precio;
            //console.log("----------------Descuento------------------");
            //console.log((total_unitario*(100-descuento))/100);

            //console.log("----------------Descuento------------------");
            if(descuento!=0){
                total_unitario=(total_unitario*(100-descuento))/100;
                descuento=(total_unitario*(descuento))/100;
            }

            preciosTotal.push(total_unitario);

            console.log(descuento, preciocompra);
            if(descuento<=preciocompra){
                console.log("Precio superado");
                swal({
                    title: "",
                    text: "El precio del producto no puede superar el precio de compra",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "SI",
                    closeOnConfirm: false
                }, function () {

                });
            }

            //console.log(total_unitario);
            $(this).find('.subtotal').val('$'+total_unitario);
            total+=total_unitario;
            descuentos_total+=descuento;
            $.post( "servlets/actualizarcantidad_cotiza.php", {'cantidad':cantidad,'posicion':id,'precio':precio,'descuento':Number($(this).find('.descuentos').val()),'subtotal':total_unitario},
                function( data ) {
                    console.log(data);
                }
            );
        });

        $('#subtotal_cotiza').val(total);
        var iva=$("#iva_cotiza").children("option:selected").val();
        //console.log(iva+"IVA");
        var subtotal_cotizacion=$("#subtotal_cotiza").val();
        //console.log(subtotal_cotizacion+"Subtotal");
        var total_iva=(iva/100)*total;
        $("#iva_cotizacion").val(total_iva);
        var totalcotizacion=Number(subtotal_cotizacion)+Number(total_iva);
        $("#total_cotiza").val(totalcotizacion);
        $("#txtdescuentocot").val(descuentos_total);
    };

    actualizarTablaCotizacion();
    $("#tbcotiza").on('change', function(){
        actualizarTablaCotizacion();
    });



        $("#iva_cotiza").change(function(){

              actualizarTablaCotizacion();

          });



        $("#slsclientecot").change(function(){

            //console.log($("#slsclientecot").children("option:selected").val());

            cliente=$("#slsclientecot").children("option:selected").val();

            $.post( "servlets/datos_clientecotizacion.php",{'id_cliente':cliente}, function( data ) {

                    //console.log(data);

                    jsonData=JSON.parse(data);

                    $("#txttelcontclie").val(jsonData.telefono);

                    $("#txtnomcontclie").val(jsonData.nomcontacto);

                });

            });



        $(".select2_demo_3").select2({

                placeholder: "Operación a recuperar",

                allowClear: true

            });





        ////Bloque modificar cotización

        function actualizarTablaCotizacionEdicion(){

              //console.log("Entra");

              var cantidades=[];

              var precios=[];

              var preciosTotal=[];

              var total = 0;

              var descuentos_total=0;

              var descuentos= [];

              var porcentual=0;

              $("#tbcotiza_edicion tbody > tr ").each(function(){

                var id = Number($(this).find('.id').text());

                var cantidad=Number($(this).find('.cantidades').val());

                //console.log(cantidad);

                cantidades.push(cantidad);



                var precio=Number($(this).find('.precios').val());

                precios.push(precio);



                var descuento = Number($(this).find('.descuentos').val());

                descuentos.push(descuento);

                porcentual=descuento/100;

                //console.log(descuento);

                //console.log(porcentual);



                var total_unitario=cantidad*precio;

                //console.log("----------------Descuento------------------");

                //console.log((total_unitario*(100-descuento))/100);

                //console.log("----------------Descuento------------------");

                if(descuento!=0){

                    total_unitario=(total_unitario*(100-descuento))/100;

                    descuento=(total_unitario*(descuento))/100;

                }

                preciosTotal.push(total_unitario);

                //console.log(total_unitario);

                $(this).find('.subtotal').val('$'+total_unitario);

                total+=total_unitario;

                descuentos_total+=descuento;

                $.post( "servlets/actualizarcantidad_cotiza_edicion.php",

                    {'cantidad':cantidad,'posicion':id,'precio':precio,

                    'descuento':Number($(this).find('.descuentos').val()),'subtotal':total_unitario

                }, function( data ) {

                   //console.log(data);

                });

              });

              

              $('#subtotal_cotiza').val(total);

              var iva=$("#iva_cotiza_edicion").children("option:selected").val();

              //console.log(iva+"IVA");

              var subtotal_cotizacion=$("#subtotal_cotiza").val();

              //console.log(subtotal_cotizacion+"Subtotal");

              var total_iva=(iva/100)*total;



              $("#iva_cotizacion").val(total_iva);

              var totalcotizacion=Number(subtotal_cotizacion)+Number(total_iva);

              $("#total_cotiza").val(totalcotizacion);

              $("#txtdescuentocot").val(descuentos_total);

          };



        actualizarTablaCotizacionEdicion();



        $("#tbcotiza_edicion").on('change', function(){

            //console.log("Actualiza tabla edicion");

            actualizarTablaCotizacionEdicion();

          });



        $("#iva_cotiza_edicion").change(function(){

              actualizarTablaCotizacionEdicion();

          });

    ///Bloque Compras
    function actualizarTabla()
    {
        var cantidades=[];
        var precios=[];
        var preciosTotal=[];
        var total = 0;

        var count = $("#tbcompra tbody > tr").children().length;
        if(count > 1){
            $("#tbcompra tbody > tr ").each(function(){
                var id = Number($(this).find('.id').text());
                var cantidad=Number($(this).find('.cantidades').val());
                cantidades.push(cantidad);

                var precio=Number($(this).find('.precios').val());
                precios.push(precio);
                
                var total_unitario=cantidad*precio;
                preciosTotal.push(total_unitario);

                $(this).find('.subtotal').val('$'+total_unitario);
                total += total_unitario;

                $.post( "servlets/actualizarcantidad.php",{'cantidad':cantidad,'posicion':id,'precio':precio}, function( data ) 
                {   
                    console.log("Res: ",data);
                });
            });

            //Aqui seteamos total
            $('#subtotal_compra').val(total);
            var iva=$("#iva_compra").children("option:selected").val();
            //console.log(iva+"IVA");
            var subtotal_compra=$("#subtotal_compra").val();
            //console.log(subtotal_compra+"Subtotal");
            var total_iva=(iva/100)*total;

            $("#iva_monto").val(total_iva);
            var totalcompra=Number(subtotal_compra)+Number(total_iva);  
            $("#total_compra").val(totalcompra);
        }else{
            $('#subtotal_compra').val(0);
            $("#iva_monto").val(0);
            $("#total_compra").val(0);
        }
    };

    $("#tbcompra").on('change', function(){
        actualizarTabla();
    });

    window.CallFunctionActualizarTabla = function CallFunctionActualizarTabla(){
        actualizarTabla();
    }

    window.eliminarProductoCompra =  function eliminarProductoCompra(id){
        $('table#tbcompra tr#'+id).remove();
        $.post( "servlets/eliminarproductocompra.php",{'id':id}, function( data ) 
        {
            window.parent.$('#tbcompra tbody').html(data);
            window.parent.CallFunctionActualizarTabla();
         });
    }

          

          $("#iva_compra").change(function(){

              actualizarTabla();

          });



          

            $("#cbxacceso").click(function(){

                if($("#cbxacceso").is(':checked')){

                    $("#divusuario").show();

                }else{

                    $("#divusuario").hide();

                }

            });



            //mensaje de bienvenida

            



    function ShowHideDiv(radio) {

        //console.log("Entra funcion");

    $("#btnvalidaproductocot").prop("disabled", false);



        var rbtncotizacion = document.getElementById("rbtncotizacion");

        var rbtnpedido = document.getElementById("rbtnpedido");

        var rbtnventa = document.getElementById("rbtnventa");

        

        var dvRecCot = document.getElementById("dvRecCot");

        

        //dvRecCot.style.display = rbtnpedido.checked ? "block" : "none";

        //dvRecPed.style.display = rbtnventa.checked ? "block" : "none";

        

        $("#titulooperacion").text(rbtnpedido.checked ? "Registrar Pedido" : rbtnventa.checked ? "Registrar Venta" : rbtncotizacion.checked ? "Registrar Cotización" : "Registrar Operación");

        $("#detalleoperacion").text(rbtnpedido.checked ? "Registrar Pedido" : rbtnventa.checked ? "Registrar Venta" : rbtncotizacion.checked ? "Registrar Cotización" : "Registrar Operación");

        $("#seccionOperaciones").text(rbtnpedido.checked ? "Registrar Pedido" : rbtnventa.checked ? "Registrar Venta" : rbtncotizacion.checked ? "Registrar Cotización" : "Registrar Operación");

        

    };





$('input[name="radioInline"]').change(function(){

    //console.log("Entra al click del radio ");

    //console.log(this);

    ShowHideDiv(this);



    if(localStorage.getItem("Operacion")!=null && 

        (localStorage.getItem("Operacion")!=$('input[name="radioInline"]:checked').val())){

        //console.log("Enttra validacion");

         swal({

                                  title: "",

                                  text: "Desea salir? Los datos capturados se perderan",

                                  type: "warning",

                                  showCancelButton: true,

                                  confirmButtonColor: "#DD6B55",

                                  confirmButtonText: "SI",

                                  closeOnConfirm: false

                              }, function () {

                                location.replace("clearsessionoperaciones.php");

                              });

    }

    //console.log($('input[name="radioInline"]:checked').val());

    localStorage.setItem("Operacion",$('input[name="radioInline"]:checked').val());







});



        $("#btncancelarcotizacion").click(function(){

            //console.log("entra al clcik");

            swal({

                                  title: "",

                                  text: "Desea salir? Los datos capturados se perderan",

                                  type: "warning",

                                  showCancelButton: true,

                                  confirmButtonColor: "#DD6B55",

                                  confirmButtonText: "SI",

                                  closeOnConfirm: false

                              }, function () {

                                location.replace("clearsession.php");

                              });



        });





    $("#btnrecupcot").click(function(){

            //console.log("Recupera cotizacion");

                $("#btnvalidaproductocot").prop("disabled", true);



            //console.log($("#slscotizaciones  option:selected").val());

            $.post("servlets/recuperacotizacion.php",

                     {id_operacion:$("#slscotizaciones option:selected").val() },function( data ){

                         //console.log(data);

                 jsoncotizacion=JSON.parse(data);

                

                 $("#slsclientecot option").each(function(){

                    

                    if ($(this).val() == jsoncotizacion.header.idempleado ){        

                    

                     $("#slsclientecot option[value="+$(this).val()+"]").attr("selected",true);

                     $( "#slsclientecot" ).change();

                          



                    }

                 });





                $("#txtvigenciacot").val(jsoncotizacion.header.vigencia);

                $("#txtentregacot").val(jsoncotizacion.header.tiempo_entrega);

                $("#txtconsideracionescot").val(jsoncotizacion.header.consideraciones);

                $('#tbcotiza tbody').html(jsoncotizacion.tabla);

                $("input[name=rbtnpago][value='"+jsoncotizacion.header.metodo_pago+"']").prop("checked",true);

                $( "#tbcotiza" ).change();



                $("#recuperado").val("1");



                $("#idrecuperado").val(jsoncotizacion.header.foliocotizacion);

                localStorage.setItem("FlagDatos","1");

                //console.log(localStorage.getItem("FlagDatos"));

                            swal({

                                title: "OK!",

                                text: "Operacion recuperada.",

                                type: "success"

                            });

                             

                         

                     });



        });



//recuperar pedido

    $("#btnrecupped").click(function(){

            //console.log("Recupera pedido");

                $("#btnvalidaproductocot").prop("disabled", true);



            //console.log($("#slspedidos  option:selected").val());

            $.post("servlets/recuperacotizacion.php",

                     {id_operacion:$("#slspedidos option:selected").val() },function( data ){

                         //console.log(data);

                 jsonpedido=JSON.parse(data);

                

                 $("#slsclientecot option").each(function(){

                    

                    if ($(this).val() == jsonpedido.header.idempleado ){        

                    

                     $("#slsclientecot option[value="+$(this).val()+"]").attr("selected",true);

                     $( "#slsclientecot" ).change();

                          



                    }

                 });





                 $("#txtvigenciacot").val(jsonpedido.header.vigencia);

                 $("#txtentregacot").val(jsonpedido.header.tiempo_entrega);

                 $("#txtconsideracionescot").val(jsonpedido.header.consideraciones);

                $('#tbcotiza tbody').html(jsonpedido.tabla);

                $("input[name=rbtnpago][value='"+jsonpedido.header.metodo_pago+"']").prop("checked",true);

                  $( "#tbcotiza" ).change();



                  $("#recuperado").val("1");

                  $("#idrecuperado").val(jsonpedido.header.foliocotizacion);



                  localStorage.setItem("FlagDatos","1");

                //console.log(localStorage.getItem("FlagDatos"));





                            swal({

                                title: "OK!",

                                text: "Operación recuperada.",

                                type: "success"

                            });

                             

                         

                     });



        });

    

    



});