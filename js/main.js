$(document).ready(function() {
  var form = $('#form-fale-conosco');
  $(form).submit(function(event) {
    event.preventDefault();
    swal({
      title: "Amigue sua loca, você tem certeza de escreveu tude no email?",
      text: "Você não vai poder recuperar esse bafo depois!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#FFC0CB",
      confirmButtonText: "Sim, pode mandar!",
      showLoaderOnConfirm: true,
      closeOnConfirm: false,
      cancelButtonText: "Não, faltou uma coisinha",
      closeOnCancel: true
    },
    function(){
      setTimeout(function(){
        mandaAjaxFormContato();
        swal({
          title: "Bafão enviade com sucesso!",
          confirmButtonColor: "#87CEFA",
          closeOnConfirm: true
        });
      }, 4000);
    });
  });
});

var mandaAjaxFormContato = function() {
  var form = $('#form-fale-conosco');
  var formData = $(form).serialize();
  console.log(formData);
  $.ajax({
    type: 'POST',
    url: $(form).attr('action'),
    data: formData
  })
  .done(function() {
    $("input[name*='fale-conosco-nome']").val('');
    $("input[name*='fale-conosco-email']").val('');
    $("input[name*='fale-conosco-telefone']").val('');
    $("input[name*='fale-conosco-mensagem']").val('');
  })
  .fail(function() {
  });
}
