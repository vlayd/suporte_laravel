if (document.getElementById('descricao-1')) {
    var quill = new Quill('#descricao-1', {
      theme: 'snow'
    });
    let hidInputDes = document.getElementById('hid_descricao-1');
    quill.on('text-change', function() {
      hidInputDes.value = document.getElementsByClassName('ql-editor')[0].innerHTML;
    });
};

if (document.getElementById('descricao_hid-1')) {
  document.getElementsByClassName('ql-editor')[0].innerHTML = document.getElementById('descricao_hid-1').innerHTML;
}

if (document.getElementById('descricao-2')) {
    var quill = new Quill('#descricao-2', {
      theme: 'snow'
    });
    let hidInputDes = document.getElementById('hid_descricao-2');
    quill.on('text-change', function() {
      hidInputDes.value = document.getElementsByClassName('ql-editor')[0].innerHTML;
    });
};

if (document.getElementById('descricao_hid-2')) {
  document.getElementsByClassName('ql-editor')[0].innerHTML = document.getElementById('descricao_hid-2').innerHTML;
}
