function setModelForm(even) {
    id = even.getAttribute('data-id');
    nama = even.getAttribute('data-nama');
    gambar = even.getAttribute('data-gambar');


    formId = document.getElementById('model-form-id');
    formName = document.getElementById('model-form-name');

    formId.value = id;
    formName.value = nama;
}


