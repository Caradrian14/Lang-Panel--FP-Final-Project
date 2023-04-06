
$(document).ready(function() {;
    $('.delete').click(function(event) {
      event.preventDefault(); // previene la acción predeterminada del enlace
  
      if (confirm('¿Está seguro de que desea realizar el borrado?')) {
        // si se confirma, sigue el enlace
        window.location.href = this.href;
      } else {
        // si se cancela, no sigue el enlace
        return false;
      }
    });
    $('.animation-expanded').mouseenter(function(){
      $(this).stop().animate({
        width: '85 rem', height: '8 rem'
      }, 'fast');
    });
    $('.animation-expanded').mouseleave(function(){
      $(this).stop().animate({
        width: '85 rem', height: '8 rem'
      }, 'fast');
    })

    $("#showLangTextSaveAndExit").click(function() {
      $("#methodLang_Text").val("updateAllLang_TextByTagAndRedirect");
    });
  });