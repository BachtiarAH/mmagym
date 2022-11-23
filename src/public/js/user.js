$(function () {
    $("#table-user").DataTable({
        fixedHeader: true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "columnDefs": [{
            "searchable": false,
            "targets": 0
        },
        {
            "searchable": true,
            "targets": 1
        },
        {
            "searchable": false,
            "targets": 2
        },
        {
            "searchable": false,
            "targets": 3
        },
        {
            "searchable": false,
            "targets": 4
        },
        {
            "searchable": false,
            "targets": 5
        },
        ],
        
    }).buttons().container().appendTo(' .col-md-6:eq(0)');

    
});