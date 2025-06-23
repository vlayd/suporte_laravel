let tipo = $('#tipo').html();
let baseUrl = $('#base_url').html();
let pathFile = $('#path_file').html();
let idCurrent = $('#idCurrent').html();
let url = window.location.href;
let urlSave = '';
let urlDrop = '';
let urlDelDrop = '';
let isDrop = 0;
let btn_refresh = document.getElementById("btnSave");
if(tipo === 'insert'){
  urlSave = url.replace('add', tipo);
  urlDrop = url.replace('add', 'insertdrop');
} else {
   urlSave = url.replace('edit', tipo);
   urlDrop = url.replace('edit', 'updatedrop');
}
Dropzone.autoDiscover = false;
var drop = document.getElementById('dropzone');
var myDropzone = new Dropzone(drop, {
    uploadMultiple: true,
    autoProcessQueue: false,
    paramName: "file",
    parallelUploads: 100,
    dictRemoveFile: "<div>Remove</div>",
    clickable: true,
    url: urlDrop,
    addRemoveLinks: true,
    method: "POST",
    dictDefaultMessage: "Arraste seus arquivos para cá!",
    init: function () {
      let myDrop = this;
      $('#form-save').on("submit", function (e) {
        e.preventDefault();
        $.ajax({
          url: urlSave,
          method: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (result) {
            result = result.split("*");
            if(result[0] === 'success') { 
                myDrop.processQueue();
                console.log(result[0]);
              btn_refresh.disabled = true;
              btn_refresh.innerHTML = `
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Aguarde..`;
              Swal.fire({
                  title: "Sucesso!",
                  text: "Informação salvo!",
                  icon: "success",
                  showConfirmButton: false,
                  timer: 1500
              });  
              btn_refresh.disabled = false;
              btn_refresh.innerHTML = `Salvar`;
              setTimeout(function() {            
              window.location.href = result[1];
              }, 2000);
                    } else if(result[0] === 'erro') {
                        toastr["error"](result[1], "Erro1");
                    }
                },
                error: function (result) {
                    toastr["error"](result, "Erro2");
                }
          });
    });
    this.on("complete", function(file){      
      var newNode = document.createElement('a');
      newNode.className = 'dz-download';
      newNode.href = baseUrl+pathFile+idCurrent+'/'+file.name;
      newNode.target = "_blank";
      newNode.innerHTML = '<i class="fa fa-download"></i>';
      newNode.style.marginLeft = '40px';
      newNode.download = file.name;
      file.previewTemplate.appendChild(newNode);
    });
    this.on("success", function (index, result) {
      // isDrop = 2;
      // result = result.split("*");
      // if(result[0] === 'success') {                
      //   console.log(result[0]);
      //   btn_refresh.disabled = true;
      //   btn_refresh.innerHTML = `
      //   <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      //   Aguarde..`;
      //   Swal.fire({
      //       title: "Sucesso!",
      //       text: "Informação salvo!",
      //       icon: "success",
      //       showConfirmButton: false,
      //       timer: 1500
      //   });  
      //   btn_refresh.disabled = false;
      //   btn_refresh.innerHTML = `Salvar`;
      //   setTimeout(function() {            
      //   window.location.href = result[1];
      //   }, 2000);
      // } else if(result[0] === 'erro') {
      //         toastr["error"](result[1], "Erro1");
      // }
    });
    this.on("removedfile", function (file) {
      console.log(file);
      urlDelDrop = url.replace('edit', 'deletedrop');
      $.ajax({
        url: urlDelDrop+'/'+file['name'],
        method: 'POST',
        success: function (result) {
            console.log(result);
        },
        error: function (result) {
          toastr["error"](result, "Erro2");
        }
      });
    });
    this.on("thumbnail", function(file, dataUrl) {
        $('.dz-image').last().find('img').attr({width: 120, height: 120});
    });

      //Mostrar
    for (let i = 1; i < 100; i++) {
      var classNum = i+1;
      // document.getElementsByClassName('dz-download')[classNum].href = 'blah';
      var thumb = '';
      var thumbnail = {
        pdf: baseUrl+'assets/img/apoio/pdf.jpg',
        xlsx: baseUrl+'assets/img/apoio/excel.png',
        xls: baseUrl+'assets/img/apoio/excel.png',
        docx: baseUrl+'assets/img/apoio/word.jpg',
        doc: baseUrl+'assets/img/apoio/word.jpg',
      };
      var extImages = ['gif', 'jpg', 'jpeg', 'png'];
      if(extImages.includes($('#extensioAnexo'+i).html())){
        thumb = baseUrl+'assets/img/upload/chamado/'+idCurrent+'/'+$('#nomeAnexo'+i).html();
      } else {
        thumb = thumbnail[$('#extensioAnexo'+i).html()];
      }

      if(document.getElementById('nomeAnexo'+i)){
        var mockFile = {
          name: $('#nomeAnexo'+i).html(),
          size: $('#sizeAnexo'+i).html(), 
          accepted: true 
        };
        this.files.push(mockFile);
        this.emit("addedfile", mockFile);
        this.emit("thumbnail", mockFile, thumb);
        this.emit("complete", mockFile);
        continue;
      }
      break;
    }
      // var mockFile = {
      //   name: 'FileName',
      //   size: '100', 
      //   accepted: true            // required if using 'MaxFiles' option
      // };
      // var mockFile2 = {
      //   name: 'FileName',
      //   size: '100', 
      //   accepted: true            // required if using 'MaxFiles' option
      // };
      // this.files.push(mockFile);    // add to files array
      // this.emit("addedfile", mockFile);
      // this.emit("thumbnail", mockFile, 'https://static.vecteezy.com/system/resources/thumbnails/016/761/881/small_2x/the-dog-smiles-because-he-is-happy-png.png');
      // this.emit("complete", mockFile); 

      // this.files.push(mockFile2);    // add to files array
      // this.emit("addedfile", mockFile2);
      // this.emit("thumbnail", mockFile2, 'https://static.vecteezy.com/system/resources/thumbnails/016/761/881/small_2x/the-dog-smiles-because-he-is-happy-png.png');
      // this.emit("complete", mockFile2); 
      $('.dz-remove').html('<i class="fas fa-trash-alt ms-4"></i>');
    }
});

// $('#form-save').on("submit", function (e) {
//   console.log(isDrop);
//   if(isDrop != 0) return;
//   e.preventDefault();
//   $.ajax({
//     url: urlSave,
//     method: 'POST',
//     data: new FormData(this),
//     contentType: false,
//     cache: false,
//     processData: false,
//     success: function (result) {
//         result = result.split("*");
//         if(result[0] === 'success') {                
//           console.log(result[0]);
//           btn_refresh.disabled = true;
//           btn_refresh.innerHTML = `
//           <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
//           Aguarde..`;
//           Swal.fire({
//               title: "Sucesso!",
//               text: "Informação salvo!",
//               icon: "success",
//               showConfirmButton: false,
//               timer: 1500
//           });  
//           btn_refresh.disabled = false;
//           btn_refresh.innerHTML = `Salvar`;
//           setTimeout(function() {            
//           window.location.href = result[1];
//           }, 2000);
//   } else if(result[0] === 'erro') {
//           toastr["error"](result[1], "Erro1");
//   }
//     },
//     error: function (result) {
//         toastr["error"](result, "Erro2");
//     }
//   });
// });