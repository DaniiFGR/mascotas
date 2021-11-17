$(document).ready(function() {
  var table = $('#example').DataTable( {
    buttons: [
      {extend:'excel',text: "Exportar excel",title: "Listado Mascotas",footer:true},
      {extend:'pdf',text: "Exportar PDF",title: "Listado Mascotas",footer:true},
      {extend:'colvis',text: "Mostrar"},
    ],
    // "language": {
    //   "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    // }
  });
  table.buttons().container().appendTo( '#example_wrapper .col-md-7:eq(0)' );
  table.style.backgoundColor = "black";
});