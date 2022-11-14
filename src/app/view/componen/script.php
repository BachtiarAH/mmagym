<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE-3.2.0/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="AdminLTE-3.2.0/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="AdminLTE-3.2.0/plugins/raphael/raphael.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="AdminLTE-3.2.0/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>

<!-- iconify -->
<script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
<!-- font awsome -->
<script src="https://kit.fontawesome.com/5c43977293.js" crossorigin="anonymous"></script>

<script>
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

    function submitAlat() {
        var formNama = document.getElementById('form-name');
        var formId = document.getElementById('form-id');
        var formGamabr = document.getElementById('upload-file-alat');

        var nama = formNama.value;
        var Id = formId.value;
        var Gambar = formGamabr.value.split("\\").pop();

        console.log(formNama.value);
        console.log(formId.value);
        console.log(formGamabr.value.split("\\").pop());


        if (alatIsEdit) {
            if (formGamabr.value) {
                var json = JSON.stringify({
                    "id": formId.value,
                    "nama": formNama.value,
                    "gambar": Gambar
                })
                console.log(json);
                alatIsEdit = false;
                xhttp.open("POST",baseUrl+"api/alat/edit", true);
                xhttp.setRequestHeader('Conten-Type','aplication/json');
                xhttp.send(json);
                console.log(xhttp.responseText);
            } else {
                var json = JSON.stringify({
                    "id": formId.value,
                    "nama": formNama.value
                })
                console.log(json);
                xhttp.open("POST",baseUrl+"api/alat/edit/nama", true);
                xhttp.setRequestHeader('Conten-Type','aplication/json');
                xhttp.send(json);
                console.log(xhttp.responseText);
            }
        } else {
            if (formGamabr.value&& formNama.value) {
                var json = JSON.stringify({
                    "nama": formNama.value,
                    "gambar": Gambar
                })
                console.log(json);
                xhttp.open("POST",baseUrl+"api/alat/add", true);
                xhttp.setRequestHeader('Conten-Type','aplication/json');
                xhttp.send(json);
                console.log(xhttp.responseText);
            } else {
                alert("tolong isi semua form");
            }
        }

    }

    function changeLabelGambarALat() {
        var labelGamabr = document.getElementById('form-gambar');
        labelGamabr.innerHTML = event.target.value.split("\\").pop();
    }

    function alatClear() {
        var formId = document.getElementById('form-id');
        formId.style.visibility = 'hidden';
    }

    function deleteAlat() {
        var tr = event.target.parentNode.parentNode;
        var id = tr.childNodes[1];
        tr.style.visibility = "collapse";

        console.log(id.innerHTML);
    }
</script>