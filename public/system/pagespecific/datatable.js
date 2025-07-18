$(function () {
    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    $("#establishment").DataTable({
        "responsive": true, "info": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#establishment_wrapper .col-md-6:eq(0)');

    $("#rapex").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#rapex_wrapper .col-md-6:eq(0)');

    $("#scheme").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#scheme_wrapper .col-md-6:eq(0)');

    $("#jobs").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#jobs_wrapper .col-md-6:eq(0)');


    $("#activeadmin").DataTable({
        "responsive": true, "info": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#establishment_wrapper .col-md-6:eq(0)');
    $("#rejectuser").DataTable({
        "responsive": true, "info": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#establishment_wrapper .col-md-6:eq(0)');
    $("#trasheduser").DataTable({
        "responsive": true, "info": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#establishment_wrapper .col-md-6:eq(0)');
    $("#pendinguser").DataTable({
        "responsive": true, "info": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#establishment_wrapper .col-md-6:eq(0)');

     $("#rejectadmin").DataTable({
        "responsive": true, "info": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#establishment_wrapper .col-md-6:eq(0)');
    $("#trashedadmin").DataTable({
        "responsive": true, "info": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#establishment_wrapper .col-md-6:eq(0)');
    $("#pendingadmin").DataTable({
        "responsive": true, "info": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#establishment_wrapper .col-md-6:eq(0)');

});
