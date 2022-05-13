$(document).ready(function(){


  $('#compras').DataTable({

    "language": {
                            "sProcessing": "Procesandos...",
                            "sLengthMenu": "Mostrar _MENU_ registros ",
                            "sZeroRecords": "Ningún resultado encontrado",
                            "sEmptyTable": "Datos no disponibles",
                            "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty": "No se muestra ninguna línea",
                            "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                            }
                        },

    order: [2,'desc'],
    pageLength: 10,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [
        {extend: 'csv',title: 'Compras'},
        {extend: 'excel', title: 'Compras'},
        {extend: 'print',
            customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

          },orientation: 'landscape'
          }
      ]

  });

  $('#proveedores').DataTable({
    "language": {
                            "sProcessing": "Procesandos...",
                            "sLengthMenu": "Mostrar _MENU_ registros ",
                            "sZeroRecords": "Ningún resultado encontrado",
                            "sEmptyTable": "Datos no disponibles",
                            "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty": "No se muestra ninguna línea",
                            "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                            }
                        },

    "columnDefs": [
    {
        "targets": [ 4 ],
        "visible": false,
        "searchable": false
    },
    {
        "targets": [ 5 ],
        "visible": false
    },
    {
        "targets": [ 6 ],
        "visible": false
    },
    {
        "targets": [ 7 ],
        "visible": false
    },
    {
        "targets": [ 9],
        "visible": false
    }
],
      pageLength: 10,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [

          {extend: 'csv',title: 'Proveedores'},
          {extend: 'excel', title: 'Proveedores'},
          {extend: 'print',
           customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

          },orientation: 'landscape'
          }
      ]

  });

 $('#cotizaciones').DataTable({
    "language": {
                            "sProcessing": "Procesandos...",
                            "sLengthMenu": "Mostrar _MENU_ registros ",
                            "sZeroRecords": "Ningún resultado encontrado",
                            "sEmptyTable": "Datos no disponibles",
                            "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty": "No se muestra ninguna línea",
                            "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                            }
                        },
    "columnDefs": [
    {
        "targets": [ 2 ],
        "visible": false
    },
    {
        "targets": [ 4 ],
        "visible": false
    },
    {
        "targets": [ 6 ],
        "visible": false
    },
    {
        "targets": [ 7 ],
        "visible": false
    }
],
    order: [1,'desc'],
    pageLength: 10,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [

          {extend: 'csv',title: 'Cotizaciones'},
          {extend: 'excel', title: 'Cotizaciones'},
          {extend: 'print',
           customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

          },orientation: 'landscape'
          }
      ]

  });

 $('#pedidos').DataTable({
    "language": {
                            "sProcessing": "Procesandos...",
                            "sLengthMenu": "Mostrar _MENU_ registros ",
                            "sZeroRecords": "Ningún resultado encontrado",
                            "sEmptyTable": "Datos no disponibles",
                            "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty": "No se muestra ninguna línea",
                            "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                            }
                        },
    "columnDefs": [
    {
        "targets": [ 2 ],
        "visible": false
    },
    {
        "targets": [ 4 ],
        "visible": false
    },
    {
        "targets": [ 6 ],
        "visible": false
    },
    {
        "targets": [ 7 ],
        "visible": false
    }
],
    order: [1,'desc'],
      pageLength: 10,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [

          {extend: 'csv',title: 'Pedidos'},
          {extend: 'excel', title: 'Pedidos'},
          {extend: 'print',
           customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

          },orientation: 'landscape'
          }
      ]

  });

 $('#ventas').DataTable({
    "language": {
                            "sProcessing": "Procesandos...",
                            "sLengthMenu": "Mostrar _MENU_ registros ",
                            "sZeroRecords": "Ningún resultado encontrado",
                            "sEmptyTable": "Datos no disponibles",
                            "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty": "No se muestra ninguna línea",
                            "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                            }
                        },
    "columnDefs": [
    {
        "targets": [ 2 ],
        "visible": false
    },
    {
        "targets": [ 4 ],
        "visible": false
    },
    {
        "targets": [ 6 ],
        "visible": false
    },
    {
        "targets": [ 7 ],
        "visible": false
    }
],
    order: [1,'desc'],
    pageLength: 10,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [
        {extend: 'csv',title: 'Ventas'},
        {extend: 'excel', title: 'Ventas'},
        {extend: 'print',
            customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

          },orientation: 'landscape'
          }
      ]

  });


  $('#productos').DataTable({

    "language": {
                            "sProcessing": "Procesandos...",
                            "sLengthMenu": "Mostrar _MENU_ registros ",
                            "sZeroRecords": "Ningún resultado encontrado",
                            "sEmptyTable": "Datos no disponibles",
                            "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty": "No se muestra ninguna línea",
                            "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                            }
                        },

    "columnDefs": [
    {
        "targets": [ 3 ],
        "visible": false,
        "searchable": false
    },
    {
        "targets": [ 7 ],
        "visible": false
    },
    {
        "targets": [ 8 ],
        "visible": false
    },
    {
        "targets": [ 12 ],
        "visible": false
    },
    {
        "targets": [ 13 ],
        "visible": false
    }

],
      pageLength: 10,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [

          {extend: 'csv',title: 'Productos'},
          {extend: 'excel', title: 'Productos'},
          {extend: 'print',
           customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

          },orientation: 'landscape'
          }
      ]

  });

$('#clientes').DataTable({

    "language": {
                            "sProcessing": "Procesandos...",
                            "sLengthMenu": "Mostrar _MENU_ registros ",
                            "sZeroRecords": "Ningún resultado encontrado",
                            "sEmptyTable": "Datos no disponibles",
                            "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty": "No se muestra ninguna línea",
                            "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                            }
                        },

    "columnDefs": [
    {
        "targets": [ 2 ],
        "visible": false
    },
    {
        "targets": [ 4 ],
        "visible": false
    },
    {
        "targets": [ 7 ],
        "visible": false
    },
    {
        "targets": [ 8 ],
        "visible": false
    },
    {
        "targets": [ 9 ],
        "visible": false,
        "searchable": false
    },
    {
        "targets": [ 10 ],
        "visible": false
    }
],
      pageLength: 10,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [

          {extend: 'csv',title: 'Clientes'},
          {extend: 'excel', title: 'Clientes'},
          {extend: 'print',
           customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

          },orientation: 'landscape'
          }
      ]

  });



$('#profile_empleado').DataTable({

    "language": {
                            "sProcessing": "Procesandos...",
                            "sLengthMenu": "Mostrar _MENU_ registros ",
                            "sZeroRecords": "Ningún resultado encontrado",
                            "sEmptyTable": "Datos no disponibles",
                            "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty": "No se muestra ninguna línea",
                            "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                            }
                        },

      pageLength: 10,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [

          {extend: 'csv',title: 'Empleados'},
          {extend: 'excel', title: 'Empleados'},
          {extend: 'print',
           customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

          },orientation: 'landscape'
          }
      ]

  });

$('#familias').DataTable({
    "language": {
                            "sProcessing": "Procesandos...",
                            "sLengthMenu": "Mostrar _MENU_ registros ",
                            "sZeroRecords": "Ningún resultado encontrado",
                            "sEmptyTable": "Datos no disponibles",
                            "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty": "No se muestra ninguna línea",
                            "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                            }
                        },
    "columnDefs": [
    /*{
        "targets": [ 3 ],
        "visible": false
    },*/
    {
        "targets": [ 4 ],
        "visible": false
    }
    ],

      pageLength: 10,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [

          {extend: 'csv',title: 'FamiliaProductos'},
          {extend: 'excel', title: 'FamiliaProductos'},
          {extend: 'print',
           customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

          },orientation: 'landscape'
          }
      ]

  });

$('#subfamilias').DataTable({
    "language": {
                            "sProcessing": "Procesandos...",
                            "sLengthMenu": "Mostrar _MENU_ registros ",
                            "sZeroRecords": "Ningún resultado encontrado",
                            "sEmptyTable": "Datos no disponibles",
                            "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                            "sInfoEmpty": "No se muestra ninguna línea",
                            "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                            "sInfoPostFix": "",
                            "sSearch": "Buscar:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                            }
                        },
    "columnDefs": [
    /*{
        "targets": [ 3 ],
        "visible": false
    },*/
    {
        "targets": [ 5 ],
        "visible": false
    }
    ],

      pageLength: 10,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons: [

          {extend: 'csv',title: 'SubFamiliaProductos'},
          {extend: 'excel', title: 'SubFamiliaProductos'},
          {extend: 'print',
           customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

          },orientation: 'landscape'
          }
      ]

  });

  $('#productoscompra').DataTable({
      "language": {
                              "sProcessing": "Procesandos...",
                              "sLengthMenu": "Mostrar _MENU_ registros ",
                              "sZeroRecords": "Ningún resultado encontrado",
                              "sEmptyTable": "Datos no disponibles",
                              "sInfo": "Registros _START_ a _END_ de _TOTAL_",
                              "sInfoEmpty": "No se muestra ninguna línea",
                              "sInfoFiltered": "(Filtrar un máximo de_MAX_)",
                              "sInfoPostFix": "",
                              "sSearch": "Buscar:",
                              "sUrl": "",
                              "sInfoThousands": ",",
                              "sLoadingRecords": "Cargando...",
                              "oPaginate": {
                                  "sFirst": "Primero", "sLast": "Último", "sNext": "Próximo", "sPrevious": "Anterior"
                              },
                              "oAria": {
                                  "sSortAscending": ": Ordenar en orden ascendente", "sSortDescending": ": Ordenar en orden descendente"
                              }
                          },

        pageLength: 10,
        responsive: true,
        orientation: 'landscape',
        dom:'<lf<t><ip>>'
    });

});
