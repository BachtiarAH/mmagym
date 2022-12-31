function setModelForm(even) {
    id = even.getAttribute("data-id");
    nama = even.getAttribute("data-nama");
    gambar = even.getAttribute("data-gambar");

    formId = document.getElementById("model-form-id");
    formName = document.getElementById("model-form-name");

    formId.value = id;
    formName.value = nama;
}

function setLinkALatDelete(even) {
    link = even.getAttribute("data-hapus");
    tombolModal = document.getElementById("link-delete");
    tombolModal.href = link;
    console.log(link);
}

function setData(a) {
    cleaneQr();
    // Mengambil elemen a dengan id download-link
    var downloadLink = document.getElementById("qr-download");
    id = a.getAttribute("data-id");
    nama = a.getAttribute("data-nama");

    //mengsrt atribut mengguakan data
    document.querySelector(".qr-name").innerHTML = nama;
    namaImg = "qr-" + nama +".jpg";



    if (id) {
        generate(id);
    } else {
        document.querySelector(".qr-code").style = "display: none";
        console.log("not valid input");
    }
    
}

function autoClick() {
    $("#qr-download").click();
}

$(document).ready(function () {
    var element = $("#qr");

    $("#qr-download").on('click', function () {
        var alatName =  document.querySelector(".qr-name").innerHTML;
        var imgName = "qr-"+alatName+".jpg";

        html2canvas(element, {
            onrendered: function (canvas) {
                var imageData = canvas.toDataURL("image/jpg");
                var newData = imageData.replace(/^data:image\/jpg/, "data:application/octet-stream");
                $("#qr-download").attr("download", imgName).attr("href", newData);
            }
        });

    });
});

function generate(user_input = "kenapa ini") {
    var qrcode = new QRCode(document.querySelector(".qr-code"), {
        text: `${user_input}`,
        width: 180, //default 128
        height: 180,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H,
    });
}

function cleaneQr(params) {
    qr = document.querySelector(".qr-code");
    qr.innerHTML = "";
    console.log("cleaned");
}

