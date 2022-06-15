$(document).ready(function(){

$('#slsfamilia').on("change", function(e) {
    $.post( "servlets/get_subfamilias.php", {"slsfamilia": $("#slsfamilia").val() }, function( data ) {
        $('#slssubfamilia').empty();
            var $option = $("<option/>", {
                value: "",
                text: "*"
        });
        $('#slssubfamilia').append($option);
        $.each(data, function(key, value) {
            var $option = $("<option/>", {
                value: value.id,
                text: value.subfamilia
            });
            $('#slssubfamilia').append($option);
        });
    });
});


$('#slssubfamilia').on("change", function(e) {
    $.post( "servlets/get_codigosubfamilias.php",{"slssubfamilia":$("#slssubfamilia").val()}, function( data ) {
                    console.log(data);
                    $("#clave_producto").val(data['codigo']);

                });
});


$('#txtcp').on("input", function(e) {
    $.post( "servlets/get_catdirecciones.php",{"txtcp":$("#txtcp").val()}, function( data ) {
        console.log(data);
        $("#txtciudad").val(data['municipio']);
        $("#txtedo").val(data['estado']);
        $('#slscolonia').empty();
        
        $.each(data['colonias'], function(key, value) {
            var $option = $("<option/>", {
                value: value,
                text: value
            });
            $('#slscolonia').append($option);
        });
    });
});

$('#frmcompra').validate(
    {
        rules: {
        txtfolio_factura: {required:true},
        txtfecha_compra: {required:true},
        slsproveedor: {required: true},
        iva_compra:{required: true}
        },
        
        messages: {
        txtfolio_factura: {required:"Ingrese folio de factura"},
        txtfecha_compra: {required:"Seleccione fecha de compra"},
        slsproveedor: {required: "Seleccione el proveedor"},
        iva_compra: {required: "Seleccione el IVA ha aplicar"}
        },submitHandler: function(form) {
            swal({
              title: "",
              text: "Los datos capturados son correctos?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "SI",
              closeOnConfirm: false
            }, function () {
                $.post( "servlets/guardar_compra.php",$("#frmcompra").serialize(), function( data ) {
                    console.log(data);
                      if(data==1){
                        swal({
                            title: "Guardada!",
                            text: "La compra se registro correctamente.",
                            type: "success"
                        });
                        location.replace("compras.php");
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
});

$('#frmregistrocotizaciones').validate({
        rules: {
            radioInline:{required:true},
            slsclientecot:{required:true},
            txtvigenciacot: {required:true},
            txtentregacot:{required:true},
            txtconsideracionescot:{required:true},
            rbtnpago:{required:true},
            iva_cotiza:{required:true}
            },
        messages: {
            radioInline:{required:"Indique la operación a realizar"},
            slsclientecot: {required: "Seleccione Cliente a Cotizar"},
            txtvigenciacot:{required:"Ingrese la vigencia de la Cotización"},
            txtentregacot:{ required: "Ingrese tiempo estimado de entrega"},
            txtconsideracionescot:{required:"Ingrese consideraciones de cotización"},
            rbtnpago:{required:"Seleccione el método de pago"},
            iva_cotiza:{required:"Seleccione el IVA correspondiente de la cotización"}
        },submitHandler: function(form) {

            let guardarOperacion = true;
            $("#tbcotiza tbody > tr ").each(function(id) {
                if(isNaN(Number($(this).find('.cantidades').val()))){
                    guardarOperacion = false;
                }
                var cantidad    = Number($(this).find('.cantidades').val());
                var precio      = Number($(this).find('.precios').val());
                var descuento   = Number($(this).find('.descuentos').val());
                var preciocompra = Number($(this).find('.precio_compra').val());

                var total_unitario  = cantidad * precio;//SubTotal
                var total_descuento =  (descuento / 100) * total_unitario; //Obtenemos el descuento
                var precio_con_descuento =  total_unitario - total_descuento;//Al Subtotal le quitamos el monto descuento
                var precio_total_compra  = preciocompra * cantidad;//Precio que nos costo adquirir el producto

                if(precio_con_descuento <= precio_total_compra){
                    swal({
                        title: "",
                        text: "El precio final del producto no puede ser menor al precio de compra.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "SI",
                        closeOnConfirm: false
                    });
                    guardarOperacion = false;
                }
            });
            if(!guardarOperacion){
                return;
            }

            swal({
                title: "",
                text: "Los datos capturados son correctos?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "SI",
                closeOnConfirm: false
            }, function () {
                $.post( "servlets/guardar_operacion.php",$("#frmregistrocotizaciones").serialize(), function( data ) {
                console.log("Respuesta Save: ", data);
                if(data==1){
                    mensaje="";
                    url="";
                    console.log($('input[name="radioInline"]:checked').val());
                    if($('input[name="radioInline"]:checked').val()=="Cotizacion"){
                        url="cotizaciones.php";
                        mensaje="La cotización se registro correctamente.";
                    }else if($('input[name="radioInline"]:checked').val()=="Pedido"){ 
                        url="pedidos.php";
                        mensaje="El pedido se registro correctamente.";
                    }else if($('input[name="radioInline"]:checked').val()=="Venta"){
                        url="ventas.php";
                        mensaje="La venta se registro correctamente.";
                    }
                    swal({
                        title: "Guardada!",
                        text: mensaje,
                        type: "success"
                    });
                    location.replace(url);
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
});

///Editar cotizacion
$('#frmregistrocotizaciones_edicion').validate(
    {
        rules: {
            slsclientecot:{required:true},
            txtvigenciacot: {required:true},
            txtentregacot:{required:true},
            txtconsideracionescot:{required:true},
            iva_cotiza_edicion:{required:true}
            },
        messages: {
            slsclientecot: {required: "Seleccione Cliente a Cotizar"},
            txtvigenciacot:{required:"Ingrese la vigencia de la Cotización"},
            txtentregacot:{ required: "Ingrese tiempo estimado de entrega"},
            txtconsideracionescot:{required:"Ingrese consideraciones de cotización"},
            iva_cotiza_edicion:{required:"Seleccione el IVA correspondiente de la cotización"}
            },submitHandler: function(form) {
                swal({
                    title: "",
                    text: "Los datos capturados son correctos?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "SI",
                    closeOnConfirm: false
                }, function () {
                    console.log($("#frmregistrocotizaciones_edicion").serialize());
                    $.post( "servlets/guardar_cotizacion_edicion.php",$("#frmregistrocotizaciones_edicion").serialize(), function( data ) {
                        console.log(data);
                            if(data==1){
                                swal({
                                    title: "Guardada!",
                                    text: "La cotización se registro correctamente.",
                                    type: "success"
                            });
                            location.replace("cotizaciones.php");
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
});

///Registro usuarios
$('#frmregistrousuario').validate(
    {
        rules: {
            txtnombre: {required:true},
            slspuesto: {required:true},
            txttelefono: {required: true, number:true , maxlength: 10,minlength:10},
            txtemail: {required: true, email: true},
            slsstatus: {required:true},
            txtsalario: {required:true, number:true},
            txtcomision: {required:true, number:true},
            txtusuario: {required: {depends: function(element) {
                        return !!$("#cbxacceso:checked").length;
                        }}
                        },
            txtpassword: {required: {depends: function(element) {
                        return !!$("#cbxacceso:checked").length;
                        }}
                        }
        },
        messages: {
            txtnombre: {required:"Ingrese el nombre completo"},
            slspuesto: {required:"Seleccione el puesto"},
            txttelefono: {required: "Ingrese un número telefónico", number:"Ingrese solo números", maxlength: "Teléfono invalido",minlength:"Telefono invalido"},
            txtemail: {required: "Ingrese el email", email: "Email inválido"},
            slsstatus:{required:"Seleccione el status"},
            txtsalario:{required:"Ingrese el salario", number:"Ingrese solo números"},
            txtcomision:{required:"Ingrese la comisión", number:"Ingrese solo números"},
            txtusuario:{required:"Ingrese un usuario"},
            txtpassword: {required:"Ingrese un password"}
        },
        submitHandler: function(form) {
            $.post( "servlets/registrarusuario.php",$("#frmregistrousuario").serialize(), function( data ) {
                console.log(data);
                if(data ==1 ){
                    swal({
                    title: "",
                    text: "Registro generado exitosamente",
                    type: "success"
                    });
                }else{
                    swal({
                    title: "",
                    text: data,
                    type: "warning"
                    });
                }
            });
        }
    }
);

///Registro Productos
$('#frmregistroproductos').validate(
    {
      rules: {
        txtproducto: {required:true, remote:{type:'POST', url:"servlets/checkproducto.php"} },
        slsfamilia: {required:true},
        txtstock: {required: true, number:true},
        txtSKU:{required:true},
        txtmarca:{required:true},
        txtmodelo:{required:true},
        txtprecompra:{required:true, number:true},
        txtpreventa:{required:true, number:true},
        slsstatus:{required:true},
        textadescripcion:{required:true},
        file:{required:true},
        slsumedida:{required:true}
    },
      messages: {
        txtproducto: {required:"Ingrese el nombre del producto",remote:"Prodcuto ya registrado"},
        slsfamilia: {required:"Seleccione la familia del producto"},
        txtstock: {required: "Ingrese la cantidad de producto", number:"Ingrese solo números"},
        txtSKU:{required:"Ingrese código SKU producto"},
        txtmarca:{required:"Ingrese la marca del producto"},
        txtmodelo:{required:"Ingrese el modelo del producto"},
        txtprecompra: {required:"Ingrese precio compra"},
        txtpreventa: {required:"Ingrese precio venta"},
        slsstatus:{required:"Seleccione el estatus del producto"},
        textadescripcion:{required:"Ingrese descripción del producto"},
        file:{required:"Seleccione una imagen del producto a registrar"},
        slsumedida:{required:"Seleccione la unidad de medida del producto a registrar"}
      }
    }
);
$("#frmregistroproductos").on('submit',(function(e) {
    e.preventDefault();
    $.ajax({
    url: "servlets/registrarproductos.php",
    type: "POST",
    dataType: "json",
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    beforeSend : function() {
            //$("#preview").fadeOut();
            $("#err").fadeOut();

        },success: function(data){
            if(data.code) {
                // view uploaded file.
                //$("#preview").html(data).fadeIn();
                swal({
                    title: "",
                    text: "Registro generado exitosamente. SKU: " + data.SKU,
                    type: "success"
                });
                $("#frmregistroproductos")[0].reset();
            }else {
                // invalid file format.
                //$("#err").html("Invalid File !").fadeIn();
                swal({
                    title: "",
                    text: data.message,
                    type: "error"
                });
            }
        },error: function(e){
            //$("#err").html(e).fadeIn();
            swal({
                title: "",
                text: e,
                type: "warning"
            });
        }
    });
}));


//Registro Clientes
$('#formregistroclientes').validate(
    {
        rules: {
            radioTipoCliente: {required:true},
            txtnomcliente: {required:true},
            txtRFC: {required: true},
            txttel:{required:true, number:true, maxlength: 10,minlength:10},
            txtnomcontacto:{required:true},
            txtemail:{required: true, email: true},
            txtcalleavenida:{required:true},
            txtnoext:{required:true},
            txtnoint:{required:true},
            txtcp:{required:true},
            slscolonia:{required:true},
            txtciudad:{required:true},
            txtedo:{required:true},
            txtpais:{required: true},
            slsvendedor: {required:true},
            txtdescuento:{required:true},
            slsstatus: {required:true},
            slscfdi: {required:true},
            txtmontocredito: {required:true},
            txtdiascredito: {required:true}
        },
        messages: {
            radioTipoCliente: {required:"Ingrese tipo de cliente"},
            txtnomcliente: {required:"Ingrese Nombre del cliente"},
            txtRFC: {required:"Ingrese RFC"},
            txttel: {required: "Ingrese un número teléfonico", number:"Ingrese solo números", maxlength: "Teléfono invalido",minlength:"Teléfono invalido"},
            txtnomcontacto:{required:"Ingrese Nombre del contacto"},
            txtemail:{required: "Ingrese el email", email: "Email inválido"},
            txtcalleavenida:{required:"Ingrese calle y/o avenida del cliente"},
            txtnoext:{required:"Ingrese No. exterior del cliente"},
            txtnoint:{required:"Ingrese No. interior del cliente"},
            txtcp:{required:"Ingrese el Código Postal del cliente"},
            slscolonia:{required:"Seleccione Colonia del cliente"},
            txtciudad:{required:"Ingrese Ciudad del cliente"},
            txtedo:{required:"Ingrese Estado de residencia del cliente"},
            txtpais:{required:"Ingrese País del cliente"},
            slsvendedor: {required:"Seleccione el vendedor asignado al cliente"},
            txtdescuento: {required:"Ingrese el descuento correspondiente al cliente"},
            slsstatus: {required:"Seleccione el estatus del cliente"},
            slscfdi: {required:"Seleccione el uso de CFDI"},
            txtmontocredito: {required:"Ingrese el monto del crédito"},
            txtdiascredito: {required:"Ingrese días del crédito"}
        },
        submitHandler: function(form) {
            console.log($("#formregistroclientes").serialize());
            $.post( "servlets/registrarclientes.php",$("#formregistroclientes").serialize(), function( data ) {
                console.log(data);
                if(data ==1 ){
                    swal({
                    title: "",
                    text: "Registro Cliente generado exitosamente",
                    type: "success"
                    });
                }else{
                    swal({
                        title: "",
                        text: data,
                        type: "warning"
                    });
                }
            }
            );
        }
    }
);

$('input[type=radio][name=radioTipoCliente]').change(function() {
    console.log(this.value);
    $.post( "servlets/get_catusoscfdi.php",{"tipoCliente":this.value}, function( data ) {
        $('#slscfdi').empty();
        var $option = $("<option/>", {
            value: "",
            text: "*"
        });
        $('#slscfdi').append($option);
        $.each(data, function(key, value) {
            var $option = $("<option/>", {
                value: value.id,
                text: value.descripcion
            });
            $('#slscfdi').append($option);
        });
    });
    if (this.value == 'allot') {
        alert("Allot Thai Gayo Bhai");
    }
    else if (this.value == 'transfer') {
        alert("Transfer Thai Gayo");
    }
});

//Registro Proveedores
$('#frmregistroproveedores').validate(
    {
        rules: {
            txtnomproveedor: {required:true},
            txttel:{required:true, number:true, maxlength: 10,minlength:10},
            txtnomcontacto:{required:true},
            txtcuentabancaria:{required:true, maxlength: 18,minlength:16},
            slsstatus:{required:true},
            txtcalleavenida:{required:true},
            txtnoext:{required:true},
            txtnoint:{required:true},
            txtcp:{required:true},
            slscolonia:{required:true},
            txtciudad:{required:true},
            txtedo:{required:true},
            txtpais:{required: true},
            txtemail:{required: true, email: true},
            //txtcfdi:{required: true},
            //txtmontocredito:{required: true},
            //txtdiascredito:{required: true},
        },
        messages: {
            txtnomproveedor: {required:"Ingrese Nombre del proveedor"},
            txttel: {required: "Ingrese un número teléfonico", number:"Ingrese solo números", maxlength: "Teléfono invalido",minlength:"Teléfono invalido"},
            txtnomcontacto:{required:"Ingrese Nombre del contacto"},
            txtcuentabancaria: {required: "Ingrese número cuenta bancaria", maxlength: "Cuenta invalida",minlength:"Cuenta invalida"},
            slsstatus: {required:"Seleccione el estatus del proveedor"},
            txtcalleavenida:{required:"Ingrese calle y/o avenida del proveedor"},
            txtnoext:{required:"Ingrese No. exterior del proveedor"},
            txtnoint:{required:"Ingrese No. interior del proveedor"},
            txtcp:{required:"Ingrese el Código Postal del proveedor"},
            slscolonia:{required:"Seleccione Colonia del proveedor"},
            txtciudad:{required:"Ingrese Ciudad del proveedor"},
            txtedo:{required:"Ingrese Estado de residencia del proveedor"},
            txtpais:{required:"Ingrese País del proveedor"},
            txtemail:{required: "Ingrese el email", email: "Email invalido"},
            //txtcfdi:{rrequired: "Ingrese el CFDI"},
            //txtmontocredito:{required: "Ingrese monto crédito"},
            //txtdiascredito:{required: "Ingrese número de días crédito"},
        },
        submitHandler: function(form) {
            $.post( "servlets/registrarproveedores.php",$("#frmregistroproveedores").serialize(), function( data ) {
                console.log(data);
                if(data ==1 ){
                    swal({
                        title: "",
                        text: "Registro Proveedor generado exitosamente",
                        type: "success"
                    }, function(){
                        location.replace("proveedores.php");
                    });
                }else{
                    swal({
                        title: "",
                        text: data,
                        type: "warning"
                    });
                }
            });
        }
    }
);

//Registro Familia Productos
$('#frmregistrofamiliaproductos').validate(
    {
        rules: {
            txtfamproducto: { required:true },
            slsfamstatus: { required:true },
            textafamdescripcion: { required: true }
        },
        messages: {
            txtfamproducto: {required:"Ingrese el nombre de la familia del producto"},
            slsfamstatus: {required:"Seleccione el estatus de la familia del producto"},
            textafamdescripcion: {required: "Ingrese descripción de la familia del producto"}
        },
        submitHandler: function(form) {
            $.post(
                "servlets/registrarfamiliaproducto.php", $("#frmregistrofamiliaproductos").serialize(),
                function (data) {
                    console.log(data);
                  if (data.code) {
                    swal({
                      title: "",
                      text: "Registro Familia generado exitosamente",
                      type: "success",
                    },function(a){
                        if(a)
                            location.replace("familias.php");
                    });
                  } else {
                    swal({
                      title: "",
                      text: data.message,
                      type: "warning",
                    });
                  }
                },"json",
            )
        },
    }
);

//Registro Subfamilia Productos
$('#frmregistrosubfamilia').validate(
    {
        rules: {
            txtsubfamproducto: {required:true},
            slssubfamstatus: {required:true},
            txtcodsubfamprod: {required: true},
            slsfamilias: {required: true},
            textasubfamdescripcion:{required : true}
        },
        messages: {
            txtsubfamproducto: {required:"Ingrese el nombre de la subfamilia"},
            slssubfamstatus: {required:"Seleccione el estatus"},
            txtcodsubfamprod: {required: "Ingrese el codigo de subfamilia"},
            slsfamilias: {required: "Seleccione la familia"},
            textasubfamdescripcion: {required: "Ingrese una descripción"}
        },
        submitHandler: function(form) {
        $.post( 
            "servlets/registrarsubfamiliaproducto.php",$("#frmregistrosubfamilia").serialize(), 
            function( data ) {
                console.log(data);
                if(data.code){
                    swal({
                        title: "",
                        text: "Registro SubFamilia generado exitosamente",
                        type: "success"
                    },function(a){
                        if(a)
                            location.replace("subfamilias.php");
                    });
                }else{
                    swal({
                        title: "",
                        text: data.message,
                        type: "warning"
                    });
                }
            },
            "json",
            );
        }
    }
);


//Editar Proveedores
$('#frmeditarproveedores').validate(
    {
        rules: {
            txtnomproveedor: {required:true},
            txttel:{required:true, number:true, maxlength: 10,minlength:10},
            txtnomcontacto:{required:true},
            txtcuentabancaria:{required:true, maxlength: 18,minlength:16},
            slsstatus: {required:true},
            txtcalleavenida:{required:true},
            txtnoext:{required:true},
            txtnoint:{required:true},
            txtcp:{required:true},
            slscolonia:{required:true},
            txtciudad:{required:true},
            txtedo:{required:true},
            txtpais:{required: true},
            txtemail:{required: true, email: true},
            textaprodvendprov:{required: true},    
        },
        messages: {
            txtnomproveedor: {required:"Ingrese Nombre del proveedor"},
            txttel: {required: "Ingrese un número teléfonico", number:"Ingrese solo números", maxlength: "Teléfono invalido",minlength:"Teléfono invalido"},
            txtnomcontacto:{required:"Ingrese Nombre del contacto"},
            txtcuentabancaria: {required: "Ingrese número cuenta bancaria", maxlength: "Cuenta invalida",minlength:"Cuenta invalida"},
            slsstatus: {required:"Seleccione el estatus del proveedor"},
            txtcalleavenida:{required:"Ingrese calle y/o avenida del proveedor"},
            txtnoext:{required:"Ingrese No. exterior del proveedor"},
            txtnoint:{required:"Ingrese No. interior del proveedor"},
            txtcp:{required:"Ingrese el Código Postal del proveedor"},
            slscolonia:{required:"Seleccione Colonia del proveedor"},
            txtciudad:{required:"Ingrese Ciudad del proveedor"},
            txtedo:{required:"Ingrese Estado de residencia del proveedor"},
            txtpais:{required:"Ingrese País del proveedor"},
            txtemail:{required: "Ingrese el email", email: "Email invalido"},
            textaprodvendprov: {required:"Ingrese los productos vendidos del proveedor"}
        },
        submitHandler: function(form) {
        $.post( "servlets/editarproveedores.php",$("#frmeditarproveedores").serialize(), function( data ) {
        console.log(data);
            if(data ==1 ){
                swal({
                    title: "",
                    text: "Actualización Proveedor exitosamente",
                    type: "success"
                },function(){
                    location.replace("proveedores.php");
                });
            }else{
                swal({
                    title: "",
                    text: data,
                    type: "warning"
                });
            }
        });
        }
    }
);

//Editar Familia Productos
$('#frmeditarfamiliaproductos').validate(
    {
        rules: {
            txtfamproducto: {required:true},
            slsfamstatus: {required:true},
            textafamdescripcion: {required: true}
        },
        messages: {
            txtfamproducto: {required:"Ingrese el nombre de la familia del producto"},
            slsfamstatus: {required:"Seleccione el estatus de la familia del producto"},
            textafamdescripcion: {required: "Ingrese descripción de la familia del producto"}
        },
        submitHandler: function(form) {
        $.post( "servlets/editarfamiliaproducto.php",$("#frmeditarfamiliaproductos").serialize(), function( data ) {
        console.log(data);
            if(data ==1 ){
                swal({
                    title: "",
                    text: "Actualización Familia Producto exitosamente",
                    type: "success"
                });
            }else{
                swal({
                    title: "",
                    text: data,
                    type: "warning"
                });
            }
        });
        }
    }
);

//Editar SubFamilia Productos
$('#frmeditarsubfamiliaproductos').validate(
    {
        rules: {
            txtsubfamproducto: {required:true},
            slssubfamstatus: {required:true},
            txtcodsubfamprod: {required:true},
            slsfamilia: {required:true},
            textasubfamdescripcion: {required: true}
        },
        messages: {
            txtsubfamproducto: {required:"Ingrese el nombre de la subfamilia del producto"},
            slssubfamstatus: {required:"Seleccione el estatus de la subfamilia del producto"},
            txtcodsubfamprod: {required:"Ingrese el Código de la subfamilia"},
            slsfamilia:{required: "Seleccione la familia a la que pertenece la subfamilia a editar"},
            textasubfamdescripcion: {required: "Ingrese descripción de la subfamilia del producto"}
        },
        submitHandler: function(form) {
        $.post( "servlets/editarsubfamiliaproductos.php",$("#frmeditarsubfamiliaproductos").serialize(), function( data ) {
        console.log(data);
            if(data ==1 ){
                swal({
                    title: "",
                    text: "Actualización SubFamilia Producto exitosamente",
                    type: "success"
                },function(a){
                    if(a)
                        location.replace("subfamilias.php");                    
                });
            }else{
                swal({
                    title: "",
                    text: data,
                    type: "warning"
                });
            }
        });
        }
    }
);
//Editar Clientes
$('#frmeditarclientes').validate(
    {
        rules: {
            radioTipoCliente : {required:true},
            txtnomcliente: {required:true},
            txtRFC: {required: true},
            txttel:{required:true, number:true, maxlength: 10,minlength:10},
            txtnomcontacto:{required:true},
            txtemail:{required: true, email: true},
            txtcalleavenida:{required:true},
            txtnoext:{required:true},
            txtnoint:{required:true},
            txtcp:{required:true},
            slscolonia:{required:true},
            txtciudad:{required:true},
            txtedo:{required:true},
            txtpais:{required: true},
            slsvendedor: {required:true},
            txtdescuento:{required:true},
            slsstatus: {required:true},
            slscfdi: {required:true},
            txtmontocredito: {required:true},
            txtdiascredito: {required:true}
        },
        messages: {
            radioTipoCliente: {required:"Ingrese tipo de cliente"},
            txtnomcliente: {required:"Ingrese Nombre del cliente"},
            txtRFC: {required:"Ingrese RFC"},
            txttel: {required: "Ingrese un número teléfonico", number:"Ingrese solo números", maxlength: "Teléfono invalido",minlength:"Teléfono invalido"},
            txtnomcontacto:{required:"Ingrese Nombre del contacto"},
            txtemail:{required: "Ingrese el email", email: "Email invalido"},
            txtcalleavenida:{required:"Ingrese calle y/o avenida del cliente"},
            txtnoext:{required:"Ingrese No. exterior del cliente"},
            txtnoint:{required:"Ingrese No. interior del cliente"},
            txtcp:{required:"Ingrese el Código Postal del cliente"},
            slscolonia:{required:"Seleccione Colonia del cliente"},
            txtciudad:{required:"Ingrese Ciudad del cliente"},
            txtedo:{required:"Ingrese Estado de residencia del cliente"},
            txtpais:{required:"Ingrese País del cliente"},
            slsvendedor: {required:"Seleccione el vendedor asignado al cliente"},
            txtdescuento: {required:"Ingrese el descuento correspondiente al cliente"},
            slsstatus: {required:"Seleccione el estatus del cliente"},
            slscfdi: {required:"Seleccione el uso de CFDI"},
            txtmontocredito: {required:"Ingrese el monto del crédito"},
            txtdiascredito: {required:"Ingrese días del crédito"}
        },
        submitHandler: function(form) {
        $.post( "servlets/editarclientes.php",$("#frmeditarclientes").serialize(), function( data ) {
        console.log(data);
            if(data ==1 ){
                swal({
                    title: "",
                    text: "Actualización Cliente exitosamente",
                    type: "success"
                },function(r){
                    if(r){
                        location.replace("clientes.php")
                    }
                });
            }else{
                swal({
                    title: "",
                    text: data,
                    type: "warning"
                });
            }
        });
        }
    }
);

//Editar empleados
$('#frmeditarempleado').validate(
    {
        rules: {
            txtnombre: {required:true},
            slspuesto: {required:true},
            txttelefono: {required: true, number:true , maxlength: 10,minlength:10},
            txtemail: {required: true, email: true},
            slsstatus:{required:true},
            txtsalario:{required:true, number:true},
            txtcomision:{required:true, number:true},
            txtusuario:{ required: {depends: function(element) {
                        return !!$("#cbxacceso:checked").length;
                        }}
                        },
            txtpassword:{ required: {depends: function(element) {
                        return !!$("#cbxacceso:checked").length;
                        }}
                    }
        },
        messages: {
            txtnombre: {required:"Ingrese el nombre completo"},
            slspuesto: {required:"Seleccione el puesto"},
            txttelefono: {required: "Ingrese un numero telefonico", number:"Ingrese solo numeros", maxlength: "Telefono invalid",minlength:"Telefono invalido"},
            txtemail: { required: "Ingrese el email", email: "Email invalido"},
            slsstatus:{required:"Seleccione el status"},
            txtsalario:{required:"Ingrese el salario", number:"Ingrese solo numeros"},
            txtcomision:{required:"Ingrese la comisión", number:"Ingrese solo numeros"},
            txtusuario:{required:"Ingrese un usuario"},
            txtpassword: {required:"Ingrese un password"}
        },
        submitHandler: function(form) {
        $.post( "servlets/editarempleados.php",$("#frmeditarempleado").serialize(), function( data ) {
        console.log(data);
        if(data ==1 ){
            swal({
                title: "",
                text: "Actualización Empleado exitosamente",
                type: "success"
            });
        }else{
            swal({
                title: "",
                text: data,
                type: "warning"
            });
        }
        });
        }
    }
);

//Editar Productos
$('#frmeditarproductos').validate(
    {
        rules: {
            txtproducto: {required:true},
            slsfamilia: {required:true},
            txtstock: {required: true, number:true},
            txtSKU:{required:true},
            txtmarca:{required:true},
            txtmodelo:{required:true},
            txtprecompra:{required:true, number:true},
            txtpreventa:{required:true, number:true},
            slsstatus:{required:true},
            textadescripcion:{required:true},
            file:{required: {depends: function(element) {
                            return !!$("#cbxacceso:checked").length;
                            }}},
            slsumedida:{required:true}    
        },
        messages: {
            txtproducto: {required:"Ingrese el nombre del producto"},
            slsfamilia: {required:"Seleccione la familia del producto"},
            txtstock: {required: "Ingrese la cantidad de producto", number:"Ingrese solo números"},
            txtSKU:{required:"Ingrese codigo SKU producto"},
            txtmarca:{required:"Ingrese la marca del producto"},
            txtmodelo:{required:"Ingrese el modelo del producto"},
            txtprecompra: {required:"Ingrese precio compra"},
            txtpreventa: {required:"Ingrese precio venta"},
            slsstatus:{required:"Seleccione el estatus del producto"},
            textadescripcion:{required:"Ingrese descripción del producto"},
            file:{required:"Seleccione una imagen del producto a editar"},
            slsumedida:{required:"Seleccione la unidad de medida del producto a editar"}
        }
    }
);
  
    $("#frmeditarproductos").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: "servlets/editarproductos.php",
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
                if(data!='1')
                {
                    // invalid file format.
                    //$("#err").html("Invalid File !").fadeIn();
                    swal({
                        title: "",
                        text: data,
                        type: "error"
                    });
                }else{
                    // view uploaded file.
                    //$("#preview").html(data).fadeIn();
                    //$("#form")[0].reset();
                    swal({
                        title: "",
                        text: "Registro actualizado exitosamente",
                        type: "success"
                    },function(r){
                        if(r){
                            location.replace("Productos.php")
                        }
                    });
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

//Editar cotizaciones
$('#frmeditarcotizaciones').validate(
   {
        rules: {
           slsclientecot:{required:true},
           rbtnpago:{required:true},
           txtvigenciacot: {required:true},
           txtentregacot:{required:true},
           slsstatuscot:{required:true}
        },
        messages: {
           slsclientecot: {required: "Seleccion Cliente a Cotizar"},
           rbtnpago:{required:"Seleccione el tipo de pago"},
           txtvigenciacot:{ required: "Ingrese la vigencia de la Cotización"},
           txtentregacot:{required:"Ingrese el tiempo para la entrega"},
           slsstatuscot:{required:"Seleccion el estatus de la cotización"}
        },
    submitHandler: function(form) {
        $.post( "servlets/editarcotizaciones.php",$("#frmeditarcotizaciones").serialize(), function( data ) {
        console.log(data);
            if(data ==1 ){
                swal({
                    title: "",
                    text: "Actualización Cotización exitosamente",
                    type: "success"
                });
            }else{
                swal({
                   title: "",
                   text: data,
                   type: "warning"
                });
           }
        });
    }
    }
);

/*$('#frmabonosventa').validate(
    {
        rules: {
            textabonoventa: {required:true},
            rbtnpago: {required:true}
        },
        messages: {
            textabonoventa: {required:"Ingrese el monto a abonar"},
            rbtnpago: {required:"Seleccione el método de pago"}
        }
    }
);*/

});