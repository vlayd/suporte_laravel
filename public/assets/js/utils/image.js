function changePhoto(idFoto, file) {
    let ext = file.files[0].type;
    if($.inArray(ext, ['image/webp','image/gif','image/png','image/jpg','image/jpeg']) == -1) {
        toastr["error"]("Formato não aceito!", "Erro");
    } else {
        document.getElementById(idFoto).src = window.URL.createObjectURL(file.files[0]);
    }
}