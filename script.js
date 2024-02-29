const mobileNav = document.querySelector(".hamburger");
const navbar = document.querySelector(".menubar");

mobileNav.addEventListener("click", () => {
  navbar.classList.toggle("active");
  mobileNav.classList.toggle("menu-active");
  console.log("esta activo")
});

$(document).ready(function () {
  $('#tablaContenedores').DataTable({
      language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
          }
      },
      "paging": true,
      "ordering": true,
      "info": true,
      "searching": true,
      "pageLength": 10
  });
});




