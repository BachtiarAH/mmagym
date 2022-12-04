function setModalUserEdit(even) {
    nama = even.getAttribute('data-nama');
    email = even.getAttribute('data-email');
    id = even.getAttribute('data-id');
    alamat = even.getAttribute('data-alamat');
    akses = even.getAttribute('data-akses');
    password = even.getAttribute('data-password');

    formId = document.getElementById('modal-form-id');
    formnama = document.getElementById('modal-form-nama');
    formEmail = document.getElementById('modal-form-email');
    formPassword = document.getElementById('modal-form-password');
    formalamat = document.getElementById('modal-form-alamat');
    formAkses = document.getElementById('modal-form-akses');

    formnama.value = nama;
    formId.value = id;
    formAkses.value = akses;
    formEmail.value = email;
    formPassword.value = password;
    formalamat.value = alamat;
}