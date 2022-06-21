$(document).ready(function() {

    actualizarTabla();
    //actualizarTablaCotizacion();
    
    console.log(localStorage.getItem("pagina"));
    if(localStorage.getItem("pagina") == "registro_operacion")
    {
        $("input[name=radioInline][value='"+localStorage.getItem("Operacion")+"']").click();
        ShowHideDiv($("input[name=radioInline][value='"+localStorage.getItem("Operacion")+"']"));

        //Cada ves que se recargue la pagina los datos se reinician
        $.post( "clearsessionoperacionesinicio.php",{}, function( data ) {
            $('#tbcotiza tbody').html(data);
            actualizarTablaCotizacion();
        });
    }

    if(localStorage.getItem("pagina") == "editar_cotizacion"){
        actualizarTablaCotizacionEdicion();
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

    function actualizarTablaCotizacion()
    {
        console.log("Entra Ctoizacion...");
        var subTotal = 0;
        var descuentoTotal=0;
        $("#tbcotiza tbody > tr ").each(function(id)
        {
            if(isNaN(Number($(this).find('.cantidades').val()))){
                return false;
            }

            var cantidad=Number($(this).find('.cantidades').val());
            var precio=Number($(this).find('.precios').val());
            var descuento = Number($(this).find('.descuentos').val());
            var preciocompra = Number($(this).find('.precio_compra').val());

            var total_unitario = cantidad * precio;//SubTotal
            var total_descuento =  (descuento / 100) * total_unitario; //Obtenemos el descuento
            var precio_con_descuento =  total_unitario - total_descuento;//Al Subtotal le quitamos el monto descuento
            var precio_total_compra  = preciocompra * cantidad;//Precio que nos costo adquirir el producto

            console.log("GJG1. ",id, "Cantidad" ,cantidad, "Precio", precio, "Descuenti",descuento, "Precio Compra",preciocompra);
            console.log("GJG2. ","Can * Precio",total_unitario, "Tot Descuento",total_descuento, "Precio C Des",precio_con_descuento, "Total Com",precio_total_compra);
            console.log("GJG. ","Precio Con Des", precio_con_descuento, "Precio Tot Compra",precio_total_compra);
            if(precio_con_descuento <= precio_total_compra){
                console.log("Precio superado");
                swal({
                    title: "",
                    text: "El precio final del producto no puede ser menor al precio de compra.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "SI",
                    closeOnConfirm: false
                });
            }

            subTotal += total_unitario;
            descuentoTotal += total_descuento;
            $.post( "servlets/calculadora_cotizacion.php", 
                {'posicion':id, 'cantidad':cantidad, 'precio':precio, 'descuento':descuento, 'subtotal':precio_con_descuento, tipo:'actualizar'},
                function( data ) {
                    console.log("respuesta. Cargando. ",data);
                    $('#tbcotiza tbody').html(data);
                }
            );
        });

        var iva=$("#iva_cotiza").children("option:selected").val();
        var total_iva= (iva/100) * subTotal;
        console.log(subTotal, total_iva, descuentoTotal);
        var totalcotizacion = (Number(subTotal) + Number(total_iva)) - descuentoTotal;

        $('#subtotal_cotiza').val(parseFloat(Math.round(subTotal * 100) / 100).toFixed(2));
        $("#iva_cotizacion").val(parseFloat(Math.round(total_iva * 100) / 100).toFixed(2));
        $("#total_cotiza").val(parseFloat(Math.round(totalcotizacion * 100) / 100).toFixed(2));
        $("#txtdescuentocot").val(parseFloat(Math.round(descuentoTotal * 100) / 100).toFixed(2));
    };

    $("#tbcotiza").on('change', function(){
        console.log("onChange...");
        actualizarTablaCotizacion();
    });

    window.CallFunctionActualizarCotiza = function CallFunctionActualizarCotiza(){
        actualizarTablaCotizacion();
    }

    window.eliminarCotizacion =  function eliminarCotizacion(id){
        $('table#tbcotiza tr#'+id).remove();
        $.post( "servlets/calculadora_cotizacion.php",{'id':id,tipo:'eliminar'}, function( data ) 
        {
            window.parent.$('#tbcotiza tbody').html(data);
            window.parent.CallFunctionActualizarCotiza();
         });
    }



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

    //Bloque modificar cotización
    function actualizarTablaCotizacionEdicion(){
        var subTotal = 0;
        var descuentoTotal=0;
        console.log("Entra en consulta Editar");
        $("#tbcotiza_edicion tbody > tr ").each(function(id){
            if(isNaN(Number($(this).find('.cantidades').val()))){
                return false;
            }
    
            var cantidad= Number($(this).find('.cantidades').val());
            var precio= Number($(this).find('.precios').val());
            var descuento = Number($(this).find('.descuentos').val());
            var preciocompra = Number($(this).find('.precio_compra').val());
    
            var total_unitario = cantidad * precio;
            var total_descuento =  (descuento / 100) * total_unitario;
            var precio_con_descuento =  total_unitario - total_descuento;
            var precio_total_compra  = preciocompra * cantidad;
    
            console.log("GJG1. ",id, cantidad, precio, descuento, preciocompra);
            console.log("GJG2. ",total_unitario, total_descuento, precio_con_descuento, precio_total_compra);
            console.log("GJG. ",precio_con_descuento, precio_total_compra);
            if(false /*descuento<=preciocompra*/){
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
    
            subTotal += total_unitario;
            descuentoTotal += total_descuento;

            $.post( "servlets/actualizarcantidad_cotiza_edicion.php",
                {'posicion':id, 'cantidad':cantidad, 'precio':precio, 'descuento':descuento,'subtotal':precio_con_descuento,tipo:'modificar'}, 
                    function( data ) {
                        console.log("respuesta. Cargando Edit. ",data);
                        $('#tbcotiza_edicion tbody').html(data);
                    }
            );

        });

        console.log("Valores a trabajar: " , subTotal , descuentoTotal);
        var iva=$("#iva_cotiza_edit").children("option:selected").val();
        var total_iva= (iva/100) * subTotal;
        console.log(subTotal, total_iva, descuentoTotal);
        var totalcotizacion = (Number(subTotal) + Number(total_iva)) - descuentoTotal;

        $('#subtotal_cotiza_edit').val(parseFloat(Math.round(subTotal * 100) / 100).toFixed(2));
        $("#descuentocot_edit").val(parseFloat(Math.round(descuentoTotal * 100) / 100).toFixed(2));
        $("#iva_cotizacion_edit").val(parseFloat(Math.round(total_iva * 100) / 100).toFixed(2));
        $("#total_cotiza_edit").val(parseFloat(Math.round(totalcotizacion * 100) / 100).toFixed(2));
    };


    $("#tbcotiza_edicion").on('change', function(){
        console.log("Actualiza tabla edicion");
        actualizarTablaCotizacionEdicion();
    });

    $("#iva_cotiza_edicion").change(function(){
        actualizarTablaCotizacionEdicion();
    });

    window.CallFunctionActualizarTablaCotiza = function CallFunctionActualizarTablaCotiza(){
        actualizarTablaCotizacionEdicion();
    }

    window.eliminarCotizacionEdit =  function eliminarCotizacionEdit(id){
        $('table#tbcotiza tr#'+id).remove();
        $.post( "servlets/actualizarcantidad_cotiza_edicion.php",{'id':id,tipo:'eliminar'}, function( data ) 
        {
            window.parent.$('#tbcotiza_edicion tbody').html(data);
            actualizarTablaCotizacionEdicion();
         });
    }

    ///Bloque Compras
    function actualizarTabla()
    {
        var cantidades=[];
        var precios=[];
        var preciosTotal=[];
        var total = 0;


        $("#tbcompra tbody > tr ").each(function(){
            if(isNaN(Number($(this).find('.cantidades').val()))){
                return false;
            }

            var id = Number($(this).find('.id').text());
            var cantidad=Number($(this).find('.cantidades').val());
            //cantidades.push(cantidad);

            var precio=Number($(this).find('.precios').val());
            //precios.push(precio);
                
            var total_unitario=cantidad*precio;
            //preciosTotal.push(total_unitario);

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
        $("#btnvalidaproductocot").prop("disabled", false);
        
        var rbtncotizacion  = document.getElementById("rbtncotizacion");
        var rbtnpedido      = document.getElementById("rbtnpedido");
        var rbtnventa       = document.getElementById("rbtnventa");
        var dvRecCot        = document.getElementById("dvRecCot");

        dvRecCot.style.display = rbtnpedido.checked || rbtnventa.checked ? "block" : "none";
        var text = rbtnpedido.checked ? 'Recuperar Cotización' : rbtnventa.checked ? 'Recuperar Pedido' : '';
        var htmlValue = '<i class="fa fa-search-plus"></i> ' + text;
        $("#btnrecuperaoperacion").html(htmlValue);

        //dvRecPed.style.display = rbtnventa.checked ? "block" : "none";
        
        $("#titulooperacion").text(rbtnpedido.checked ? "Registrar Pedido" : rbtnventa.checked ? "Registrar Venta" : rbtncotizacion.checked ? "Registrar Cotización" : "Registrar Operación");
        $("#detalleoperacion").text(rbtnpedido.checked ? "Registrar Pedido" : rbtnventa.checked ? "Registrar Venta" : rbtncotizacion.checked ? "Registrar Cotización" : "Registrar Operación");
        $("#seccionOperaciones").text(rbtnpedido.checked ? "Registrar Pedido" : rbtnventa.checked ? "Registrar Venta" : rbtncotizacion.checked ? "Registrar Cotización" : "Registrar Operación");

    };

    $('input[name="radioInline"]').change(function()
    {    
        if(localStorage.getItem("Operacion") != null 
            && (localStorage.getItem("Operacion") != $('input[name="radioInline"]:checked').val()))
        {
            swal({
                title: "",
                text: "Desea salir? Los datos capturados se perderan",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "SI",
                closeOnConfirm: false
                }, function (res) {
                    if(res){
                        location.replace("clearsessionoperaciones.php");
                        localStorage.setItem("Operacion",$('input[name="radioInline"]:checked').val());
                    }else{
                        var $radios = $('input:radio[name=radioInline]');
                        var value = localStorage.getItem("Operacion");
                        $radios.filter('[value='+value+']').prop('checked', true);
                    }
                    ShowHideDiv(this);
                });
        }else{
            ShowHideDiv(this);
            localStorage.setItem("Operacion",$('input[name="radioInline"]:checked').val());
        }
    });

    $("#btncancelarcotizacion").click(function(){
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


    function recuperarOperacion(id)
    {
        $("#btnvalidaproductocot").prop("disabled", true);
        $.post("servlets/recuperacotizacion.php", {id_operacion: id },
            function( data ){
                jsoncotizacion=JSON.parse(data);
                $('#tbcotiza tbody').html(data.tabla);

                $('#slsclientecot').empty();
                var $option = $("<option/>", {
                    value: jsoncotizacion.header.idcliente,
                    text: jsoncotizacion.header.cliente
                });
                $('#slsclientecot').append($option);
                /*$("#slsclientecot option").each(function(){
                    if ($(this).val() == jsoncotizacion.header.idcliente ){
                        $("#slsclientecot option[value="+$(this).val()+"]").attr("selected",true);
                        $( "#slsclientecot" ).change();
                    }
                });*/

                $("#txtvigenciacot").val(jsoncotizacion.header.vigencia);
                $("#txtentregacot").val(jsoncotizacion.header.tiempo_entrega);
                $("#txtconsideracionescot").val(jsoncotizacion.header.consideraciones);
                $('#tbcotiza tbody').html(jsoncotizacion.tabla);
                $("input[name=rbtnpago][value='"+jsoncotizacion.header.metodo_pago+"']").prop("checked",true);
                $( "#tbcotiza" ).change();
                $("#recuperado").val("1");
                $("#idrecuperado").val(jsoncotizacion.header.foliocotizacion);
                localStorage.setItem("FlagDatos","1");
                swal({
                    title: "OK!",
                    text: "Operacion recuperada.",
                    type: "success"
                }, function(){
                    $.fancybox.close();
                });
        });
    }

    window.CallFunctionRecuperarOperacion = function CallFunctionRecuperarOperacion(id){
        console.log("Si entro aquii id", id);
        recuperarOperacion(id);

    }

    //recuperar pedido
    $("#btnrecupped").click(function()
    {
        $("#btnvalidaproductocot").prop("disabled", true);
        $.post("servlets/recuperacotizacion.php", {id_operacion:$("#slspedidos option:selected").val() },
            function( data ){
                console.log("RFG:",data);
                jsonpedido=JSON.parse(data);
                $('#tbcotiza tbody').html(data.tabla);
                $("#slsclientecot option").each(function(){
                    if ($(this).val() == jsonpedido.header.idcliente ){
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
                actualizarTablaCotizacion();
                swal({
                    title: "OK!",
                    text: "Operación recuperada.",
                    type: "success"
                });
            });
    });

    window.CallFunctionCloseFancyVentas = function CallFunctionCloseFancyVentas(){
        $.fancybox.close();
        location.replace("ventas.php");
    }
});