function tes2() {
    console.log('tes');
}

function bukaVideoLink(even) {
    linkVideo = even.getAttribute('data-link-video');
    pemutarVideo = document.getElementById('pemutar-video');
    item = '<iframe src="https://drive.google.com/file/d/' + linkVideo + '/preview" width="100%" height="100%" allow="autoplay"></iframe>';
    pemutarVideo.innerHTML = item;
}

function bersihkanmodel() {
    document.getElementById('pemutar-video').innerHTML = null;
}

function setLabelInput(even) {
    var fullPath = even.value;
    var label = even.parentNode.childNodes[3];
    if (fullPath) {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        label.innerHTML = filename;
    }
}

function setModalFormGerakan(even) {
    id = even.getAttribute('data-id');
    idAlat = even.getAttribute('data-idAlat');
    nama = even.getAttribute('data-nama');

    formId = document.getElementById('modal-form-id');
    formNama = document.getElementById('modal-form-name');
    formIdAlat = document.getElementById('modal-form-idAlat');

    formId.value = id;
    formNama.value = nama;
    formIdAlat.value = idAlat;
}