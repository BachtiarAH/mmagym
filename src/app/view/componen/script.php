<?php

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

?>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE-3.2.0/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="AdminLTE-3.2.0/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="AdminLTE-3.2.0/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="AdminLTE-3.2.0/plugins/raphael/raphael.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/jquery-mapael/maps/usa_states.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- jsGrid -->
<script src="<?= Url::BaseUrl() ?>AdminLTE-3.2.0/plugins/jsgrid/demos/db.js"></script>
<script src="<?= Url::BaseUrl() ?>AdminLTE-3.2.0/plugins/jsgrid/jsgrid.min.js"></script>


<!-- ChartJS -->
<script src="AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>

<!-- iconify -->
<script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
<!-- font awsome -->
<script src="https://kit.fontawesome.com/5c43977293.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $("#table-alat").DataTable({
            "fixedHeader": true,
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
                }
            ]
        }).buttons().container().appendTo(' .col-md-6:eq(0)');
        $("#table-menu").DataTable({
            "fixedHeader": true,
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
                    "targets": 3
                },
            ]
        }).buttons().container().appendTo(' .col-md-6:eq(0)');
    });

    xhttp = new XMLHttpRequest();
    baseUrl = "http://localhost/mmagym/src/public/";

    alatId = document.getElementById('alatId');

    //alat
    alatIsEdit = false;

    function tbClicked() {
        alatIsEdit = true
        var formNama = document.getElementById('form-name');
        var formId = document.getElementById('form-id');
        var labelGamabr = document.getElementById('form-gambar');
        var formGamabr = document.getElementById('upload-file-alat');

        var tr = event.target.parentNode;
        var id = tr.childNodes[1];
        var name = tr.childNodes[3];
        var gamabr = tr.childNodes[5];
        var target = event.target;

        alatId.style.visibility = "visible";

        formNama.value = name.innerHTML;
        formId.value = id.innerHTML;
        labelGamabr.innerHTML = gamabr.innerHTML;
        console.log(gamabr.innerHTML);

        target.addEventListener('blur', function() {
            // console.log(target.innerHTML);
            var json = JSON.stringify({
                "id": id.innerHTML,
                "nama": name.innerHTML
            })
            console.log(json);
        });

        target.addEventListener('input', function() {
            elemenId = target.className;
            console.log(elemenId);

            switch (elemenId) {
                case "data-nama":
                    formNama.value = target.innerHTML.replace(/\&nbsp;/g, '');
                    break;
                case "data-gambar":
                    labelGamabr.value = target.innerHTML.replace(/\&nbsp;/g, '');
                    break;
                default:
                    break;
                    console.log("salah");
            }
        })
    }


    function changeLabelGambarALat() {
        var labelGamabr = document.getElementById('form-gambar');
        labelGamabr.innerHTML = event.target.value.split("\\").pop();
    }

    function alatClear() {
        var formId = document.getElementById('form-id');
        formId.style.visibility = 'hidden';
    }




    // function searchAlat(searchBar) {
    //     tabel = document.getElementById('tableAlat');
    //     console.log(searchBar.value);
    //     var json = JSON.stringify({
    //         "name": searchBar.value
    //     });
    //     xhttp.open("POST", baseUrl + "/api/alat/findByName", true);
    //     xhttp.setRequestHeader('Conten-Type', 'aplication/json');
    //     xhttp.send(json);
    //     console.log(xhttp.responseText);
    //     // console.log(id.innerHTML);
    //     xhttp.onload = function() {
    //         request = this.responseText;
    //         data = JSON.parse(request);
    //         tableHTML = "";
    //         console.log(data.body);
    //         for (let index = 0; index < data.body.length; index++) {
    //             // const element = data.body[index];
    //             // console.table([data.body[index].id,data.body[index].nama,data.body[index].gambar]);
    //             tableHTML += "<tr >'<td class='id' onclick='tbClicked()'> " + data.body[index].id + " </td><td class='data-nama' onchange='tes()' contenteditable='false' onclick='tbClicked()'> " + data.body[index].nama + "</td><td class='data-gambar' onchange='tes()' contenteditable='true' onclick='tbClicked()'> " + data.body[index].gambar + "</td><td><i class='fa-solid fa-trash' onclick='deleteAlat()'></i></td></tr>";
    //         }
    //         // console.table([data.body.id,data.body.name]);
    //         tabel.innerHTML = tableHTML;
    //     }
    // }
</script>

<script src="<?= Url::BaseUrl() ?>js/user.js"></script>
<script src="<?= Url::BaseUrl() ?>js/menulatihan.js"></script>
<script src="<?= Url::BaseUrl() ?>js/gerakan.js"></script>
<script src="<?= Url::BaseUrl() ?>js/gerakan2.js"></script>
<script src="<?= Url::BaseUrl() ?>js/alat.js"></script>