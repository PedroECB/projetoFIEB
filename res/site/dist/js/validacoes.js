

function toUpperSind(){
  
  var nome = formSindicato.nomeSindicato.value;

 formSindicato.nomeSindicato.value = nome.toUpperCase();
  
}


function confirmUpper(){
 formSindicato.nomeSindicato.value = formSindicato.nomeSindicato.value.toUpperCase();
}


function formatDate(){
  
}


function confereSenhas(){
  var senha1 = formSenha.senha1.value;
  var senha2 = formSenha.senha2.value;

  if(senha1 == senha2 && formSenha.senhaAtual.value !== ""){
    document.getElementById("botao").removeAttribute("disabled");
    
  }
  
}


function confere(){

var senha1 = formSenha.senha1.value;
var senha2 = formSenha.senha2.value;


 if(senha1 !== senha2){

      document.getElementById("botao").setAttribute("disabled", "disabled");

 }

 if(formSenha.senhaAtual.value == ""){

      document.getElementById("botao").setAttribute("disabled", "disabled");
 }

}
