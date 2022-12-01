function setModalData(even) {
    id = even.getAttribute('data-id');
    nama = even.getAttribute('data-nama');
    note = even.getAttribute('data-note');
    repetisi = even.getAttribute('data-repetisi');
    set = even.getAttribute('data-set');
    idGerakan = even.getAttribute('data-id-gerakan');

    formGerakan = document.getElementById('form-data-gerakan');
    formNote = document.getElementById('form-modal-note');
    formRepetisi = document.getElementById('form-modal-repetisi');
    formSet = document.getElementById('form-modal-set');
    formIdRincian = document.getElementById('form-model-id_rincian');

    formGerakan.value = idGerakan;
    formNote.value = note;
    formRepetisi.value = repetisi;
    formSet.value = set;
    formIdRincian.value = id;
}