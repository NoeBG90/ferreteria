$(document).ready(function() {

    $("#btnvalidaproductocot").click(function() {
        if (typeof $("input[name=radioInline]:checked").val() === "undefined") {
            swal({
                title: "¡Aviso!",
                text: "Es necesario seleccionar el tipo de operacion.",
                type: "warning"
            });
            return;
        }

        $.post("servlets/buscaproducto.php",{
            producto:$("#idproductocot").val(),operacion: $("input[name=radioInline]:checked").val() },function( data ){
            console.log(data);
                         
            $.fancybox({
                'width': '60%',
                'height': '80%',
                'autoScale': true,
                'transitionIn': 'fade',
                'transitionOut': 'fade',
                'href': 'mostrarproducto_cotiza.php?producto='+data,
                'type': 'iframe'
            });
        });
    });

    $("#btnrecuperaoperacion").click(function() {
        if (typeof $("input[name=radioInline]:checked").val() === "undefined") {
            swal({
                title: "¡Aviso!",
                text: "Es necesario seleccionar el tipo de operacion.",
                type: "warning"
            });
            return;
        }
        var operacion;
        if($("#rbtnpedido").is(":checked")){
            operacion = 'Cotizacion';
        }else if($("#rbtnventa").is(":checked")){
            operacion = 'Pedido';
        }else{
            return;
        }

        $.fancybox({
            'width': '60%',
            'height': '80%',
            'autoScale': true,
            'transitionIn': 'fade',
            'transitionOut': 'fade',
            'href': 'mostraroperacion.php?operacion='+operacion,
            'type': 'iframe'
        });
    });

$("#btnvalidaproductocot_edit").click(function(){
                 $.post("servlets/buscaproducto.php",
                     {producto:$("#idproductocot").val()},function( data ){
                         console.log(data);
                         
                             $.fancybox({
                                'width': '60%',
                                 'height': '80%',
                                 'autoScale': true,
                                 'transitionIn': 'fade',
                                 'transitionOut': 'fade',
                                 'href': 'mostrarproducto_cotiza_edicion.php?producto='+data,
                                 'type': 'iframe'
                             });
                         
                     });
             });

$("#btnregpedido").click(function(){
    $.fancybox({
        'width': '60%',
        'height': '80%',
        'autoScale': true,
        'transitionIn': 'fade',
        'transitionOut': 'fade',
        'href': 'registrar-pedidos.php',
        'type': 'iframe'
    });
});

$("#btnregpedidocotizacion").click(function(){
    $.fancybox({
        'width': '60%',
        'height': '80%',
        'autoScale': true,
        'transitionIn': 'fade',
        'transitionOut': 'fade',
        'href': 'mostrarcotiaceptadapedidos.php',
        'type': 'iframe'
    });
});

$(".btnabonar").click(function(){
    console.log($(this).val());
    $.fancybox({
        'width': '60%',
        'height': '80%',
        'autoScale': true,
        'transitionIn': 'fade',
        'transitionOut': 'fade',
        'href': 'abonos_venta.php?venta='+$(this).val(),
        'type': 'iframe'
    });
});

$(".btnmovimiento").click(function(){
    console.log($(this).val());
    $.fancybox({
        'width': '60%',
        'height': '80%',
        'autoScale': true,
        'transitionIn': 'fade',
        'transitionOut': 'fade',
        'href': 'movimientos-venta.php?movimiento='+$(this).val(),
        'type': 'iframe'
    });
});


                $("#btnvalidarproducto").click(function(){
                  $.post( "servlets/buscaproducto.php",
                  {producto:$("#productoid").val()}, function( data ) {
                      console.log(data);
                      if(data=='NA'){
                        $.fancybox({
                            'width': '60%',
                            'height': '80%',
                            'autoScale': true,
                            'transitionIn': 'fade',
                            'transitionOut': 'fade',
                            'href': 'registra-productocomp.php',
                            'type': 'iframe'
                        });
                      }else{
                          $.fancybox({
                              'width': '60%',
                              'height': '80%',
                              'autoScale': true,
                              'transitionIn': 'fade',
                              'transitionOut': 'fade',
                              'href': 'mostrarproducto.php?producto='+data,
                              'type': 'iframe'
                          });
                      }
                  });
                });

                $(".imagenes").fancybox({
                    padding: 0,

                    openEffect : 'elastic',
                    openSpeed : 150,

                    closeEffect : 'elastic',
                    closeSpeed : 150,

                    closeClick : true,

                    helpers : {
                        overlay : null
                        }
                });

                $('.fancybox').fancybox();

                $('.detalleiframe').fancybox({openEffect: 'elastic',
                    closeEffect: 'elastic',
                    autoSize: true,
                    type: 'iframe',
                    iframe: {
                    preload: false // fixes issue with iframe and IE
                    }
                  });

});