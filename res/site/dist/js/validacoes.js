

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




function formatCNPJ(){

  if(formEmpresa.campoCNPJ.value.length == 12){

    formEmpresa.campoCNPJ.value = formEmpresa.campoCNPJ.value+"-";
  }


}

function formatRazaoSocial(){

 if(formEmpresa.razaoSocial.value.length == 1){

    formEmpresa.razaoSocial.value = formEmpresa.razaoSocial.value.toUpperCase();
 }

}


function formatNomeFantasia(){

   if(formEmpresa.nomeFantasia.value.length == 1){

    formEmpresa.nomeFantasia.value = formEmpresa.nomeFantasia.value.toUpperCase();
 }
}

function formatBairro(){

   if(formEmpresa.campoBairro.value.length == 1){

    formEmpresa.campoBairro.value = formEmpresa.campoBairro.value.toUpperCase();
 }
}


function formatEndereco(){

   if(formEmpresa.campoEndereco.value.length == 1){

    formEmpresa.campoEndereco.value = formEmpresa.campoEndereco.value.toUpperCase();
 }
}

$(document).ready(function() {

    $("#campoCNPJ").bind('paste', function(e) {
        e.preventDefault();
    });

});


$(document).ready(function() {

    $("#campoRG").bind('paste', function(e) {
        e.preventDefault();
    });

});


function verificaAssoc(){

 if(formEmpresa.sitAssoc.value !== "Não Associada"){

    document.getElementById("Assoc").removeAttribute("disabled");

 }


 if(formEmpresa.sitAssoc.value == "Não Associada"){
    //document.getElementById("Assoc").setAttribute("disabled","disabled");
    document.getElementById("Assoc").value = "Não Associada";
    document.getElementById("Assoc").setAttribute("disabled","disabled");
 }

}

function verificaPoss(){

  if(formEmpresa.sitAssoc.value == "Não Associada"){

    document.getElementById("posAssoc").removeAttribute("disabled");

 }


 if(formEmpresa.sitAssoc.value == "Associada"){
    //document.getElementById("Assoc").setAttribute("disabled","disabled");
    //document.getElementById("posAssoc").value = "Não Associada";
    document.getElementById("posAssoc").setAttribute("disabled","disabled");
 }
}

function validaCidade(){
 
  var geral = [{"id":"1","cidade":"Abaíra","regiao":"Paraguaçu\/Centro"},{"id":"2","cidade":"Abaré","regiao":"Norte"},{"id":"3","cidade":"Acajutiba","regiao":"Salvador\/Litoral Norte"},{"id":"4","cidade":"Adustina","regiao":"Salvador\/Litoral Norte"},{"id":"5","cidade":"Água Fria","regiao":"Paraguaçu\/Centro"},{"id":"6","cidade":"Aiquara","regiao":"Sudoeste"},{"id":"7","cidade":"Alagoinhas","regiao":"Salvador\/Litoral Norte"},{"id":"8","cidade":"Almadina","regiao":"Litoral Sul"},{"id":"9","cidade":"Alcobaça","regiao":"Extremo Sul"},{"id":"10","cidade":"Amargosa","regiao":"Paraguaçu\/Centro"},{"id":"11","cidade":"Amélia Rodrigues","regiao":"Paraguaçu\/Centro"},{"id":"12","cidade":"America Dourada","regiao":"Paraguaçu\/Centro"},{"id":"13","cidade":"Anagé","regiao":"Sudoeste"},{"id":"14","cidade":"Andaraí","regiao":"Paraguaçu\/Centro"},{"id":"15","cidade":"Andorinha","regiao":"Paraguaçu\/Centro"},{"id":"16","cidade":"Angical","regiao":"Oeste"},{"id":"17","cidade":"Anguera","regiao":"Paraguaçu\/Centro"},{"id":"18","cidade":"Antas","regiao":"Salvador\/Litoral Norte"},{"id":"19","cidade":"Antônio Cardoso","regiao":"Paraguaçu\/Centro"},{"id":"20","cidade":"Antônio Gonçalves","regiao":"Paraguaçu\/Centro"},{"id":"21","cidade":"Aporá","regiao":"Salvador\/Litoral Norte"},{"id":"22","cidade":"Apuarema","regiao":"Sudoeste"},{"id":"23","cidade":"Araçás","regiao":"Salvador\/Litoral Norte"},{"id":"24","cidade":"Aracatu","regiao":"Sudoeste"},{"id":"25","cidade":"Araci","regiao":"Paraguaçu\/Centro"},{"id":"26","cidade":"Aramari","regiao":"Salvador\/Litoral Norte"},{"id":"27","cidade":"Arataca","regiao":"Litoral Sul"},{"id":"28","cidade":"Aratuípe","regiao":"Litoral Sul"},{"id":"29","cidade":"Aurelino Leal","regiao":"Litoral Sul"},{"id":"30","cidade":"Baianópolis","regiao":"Oeste"},{"id":"31","cidade":"Baixa Grande","regiao":"Paraguaçu\/Centro"},{"id":"32","cidade":"Banzae","regiao":"Salvador\/Litoral Norte"},{"id":"33","cidade":"Barra","regiao":"Paraguaçu\/Centro"},{"id":"34","cidade":"Barra da Estiva","regiao":"Paraguaçu\/Centro"},{"id":"35","cidade":"Barra do Choça","regiao":"Sudoeste"},{"id":"36","cidade":"Barra do Mendes","regiao":"Paraguaçu\/Centro"},{"id":"37","cidade":"Barra do Rocha","regiao":"Sudoeste"},{"id":"38","cidade":"Barreiras","regiao":"Oeste"},{"id":"39","cidade":"Barro Alto","regiao":"Paraguaçu\/Centro"},{"id":"40","cidade":"Barro Preto","regiao":"Litoral Sul"},{"id":"41","cidade":"Barrocas","regiao":"Paraguaçu\/Centro"},{"id":"42","cidade":"Belmonte","regiao":"Extremo Sul"},{"id":"43","cidade":"Belo Campo","regiao":"Sudoeste"},{"id":"44","cidade":"Biritinga","regiao":"Paraguaçu\/Centro"},{"id":"45","cidade":"Boa Nova","regiao":"Sudoeste"},{"id":"46","cidade":"Boa Vista do Tupim","regiao":"Paraguaçu\/Centro"},{"id":"47","cidade":"Bom Jesus da Lapa","regiao":"Oeste"},{"id":"48","cidade":"Bom Jesus da Serra","regiao":"Sudoeste"},{"id":"49","cidade":"Boninal","regiao":"Paraguaçu\/Centro"},{"id":"50","cidade":"Bonito","regiao":"Paraguaçu\/Centro"},{"id":"51","cidade":"Boquira","regiao":"Sudoeste"},{"id":"52","cidade":"Botuporã","regiao":"Sudoeste"},{"id":"53","cidade":"Brejões","regiao":"Paraguaçu\/Centro"},{"id":"54","cidade":"Brejolândia","regiao":"Oeste"},{"id":"55","cidade":"Brotas de Macaúbas","regiao":"Oeste"},{"id":"56","cidade":"Brumado","regiao":"Sudoeste"},{"id":"57","cidade":"Buerarema","regiao":"Litoral Sul"},{"id":"58","cidade":"Buritirama","regiao":"Oeste"},{"id":"59","cidade":"Caatiba","regiao":"Sudoeste"},{"id":"60","cidade":"Cabaçeiras do Paraguaçú","regiao":"Paraguaçu\/Centro"},{"id":"61","cidade":"Caldeirão Grande","regiao":"Paraguaçu\/Centro"},{"id":"62","cidade":"Cachoeira","regiao":"Paraguaçu\/Centro"},{"id":"63","cidade":"Caculé","regiao":"Sudoeste"},{"id":"64","cidade":"Caem","regiao":"Paraguaçu\/Centro"},{"id":"65","cidade":"Caetanos","regiao":"Sudoeste"},{"id":"66","cidade":"Caetité","regiao":"Sudoeste"},{"id":"67","cidade":"Cafarnaum","regiao":"Paraguaçu\/Centro"},{"id":"68","cidade":"Cairu","regiao":"Litoral Sul"},{"id":"69","cidade":"Camacan","regiao":"Litoral Sul"},{"id":"70","cidade":"Camaçari","regiao":"Salvador\/Litoral Norte"},{"id":"71","cidade":"Camamu","regiao":"Litoral Sul"},{"id":"72","cidade":"Campo Alegre de Lourdes","regiao":"Norte"},{"id":"73","cidade":"Campo Formoso","regiao":"Paraguaçu\/Centro"},{"id":"74","cidade":"Canapolis","regiao":"Oeste"},{"id":"75","cidade":"Canarana","regiao":"Paraguaçu\/Centro"},{"id":"76","cidade":"Canavieiras","regiao":"Litoral Sul"},{"id":"77","cidade":"Candeal","regiao":"Paraguaçu\/Centro"},{"id":"78","cidade":"Candeias","regiao":"Salvador\/Litoral Norte"},{"id":"79","cidade":"Candiba","regiao":"Sudoeste"},{"id":"80","cidade":"Cândido Sales","regiao":"Sudoeste"},{"id":"81","cidade":"Cansanção","regiao":"Paraguaçu\/Centro"},{"id":"82","cidade":"Canudos","regiao":"Norte"},{"id":"83","cidade":"Capela do Alto Alegre","regiao":"Paraguaçu\/Centro"},{"id":"84","cidade":"Capim Grosso","regiao":"Paraguaçu\/Centro"},{"id":"85","cidade":"Caraíbas","regiao":"Sudoeste"},{"id":"86","cidade":"Caravelas","regiao":"Extremo Sul"},{"id":"87","cidade":"Cardeal da Silva","regiao":"Salvador\/Litoral Norte"},{"id":"88","cidade":"Carinhanha","regiao":"Oeste"},{"id":"89","cidade":"Casa Nova","regiao":"Norte"},{"id":"90","cidade":"Castro Alves","regiao":"Paraguaçu\/Centro"},{"id":"91","cidade":"Catolândia","regiao":"Oeste"},{"id":"92","cidade":"Catu","regiao":"Salvador\/Litoral Norte"},{"id":"93","cidade":"Caturama","regiao":"Sudoeste"},{"id":"94","cidade":"Central","regiao":"Paraguaçu\/Centro"},{"id":"95","cidade":"Chorrochó","regiao":"Norte"},{"id":"96","cidade":"Cícero Dantas","regiao":"Salvador\/Litoral Norte"},{"id":"97","cidade":"Cipó","regiao":"Salvador\/Litoral Norte"},{"id":"98","cidade":"Coaraci","regiao":"Litoral Sul"},{"id":"99","cidade":"Cocos","regiao":"Oeste"},{"id":"100","cidade":"Conceição da Feira","regiao":"Paraguaçu\/Centro"},{"id":"101","cidade":"Conceição do Almeida","regiao":"Paraguaçu\/Centro"},{"id":"102","cidade":"Conceição do Coité","regiao":"Paraguaçu\/Centro"},{"id":"103","cidade":"Conceição do Jacuípe","regiao":"Paraguaçu\/Centro"},{"id":"104","cidade":"Condeúba","regiao":"Sudoeste"},{"id":"105","cidade":"Contendas do Sincora","regiao":"Sudoeste"},{"id":"106","cidade":"Coração de Maria","regiao":"Paraguaçu\/Centro"},{"id":"107","cidade":"Cordeiros","regiao":"Sudoeste"},{"id":"108","cidade":"Coribe","regiao":"Oeste"},{"id":"109","cidade":"Coronel João Sá","regiao":"Salvador\/Litoral Norte"},{"id":"110","cidade":"Correntina","regiao":"Oeste"},{"id":"111","cidade":"Cotegipe","regiao":"Oeste"},{"id":"112","cidade":"Conde","regiao":"Salvador\/Litoral Norte"},{"id":"113","cidade":"Cravolândia","regiao":"Paraguaçu\/Centro"},{"id":"114","cidade":"Crisópolis","regiao":"Salvador\/Litoral Norte"},{"id":"115","cidade":"Cristópolis","regiao":"Oeste"},{"id":"116","cidade":"Cruz das Almas","regiao":"Paraguaçu\/Centro"},{"id":"117","cidade":"Curaçá","regiao":"Norte"},{"id":"118","cidade":"Dario Meira","regiao":"Sudoeste"},{"id":"119","cidade":"Dias D'Ávila","regiao":"Salvador\/Litoral Norte"},{"id":"120","cidade":"Dom Basílio","regiao":"Sudoeste"},{"id":"121","cidade":"Dom Macedo Costa","regiao":"Paraguaçu\/Centro"},{"id":"122","cidade":"Elísio Medrado","regiao":"Paraguaçu\/Centro"},{"id":"123","cidade":"Encruzilhada","regiao":"Sudoeste"},{"id":"124","cidade":"Entre Rios","regiao":"Salvador\/Litoral Norte"},{"id":"125","cidade":"Érico Cardoso","regiao":"Sudoeste"},{"id":"126","cidade":"Esplanada","regiao":"Salvador\/Litoral Norte"},{"id":"127","cidade":"Euclides da Cunha","regiao":"Salvador\/Litoral Norte"},{"id":"128","cidade":"Eunápolis","regiao":"Extremo Sul"},{"id":"129","cidade":"Fátima","regiao":"Salvador\/Litoral Norte"},{"id":"130","cidade":"Feira da Mata","regiao":"Oeste"},{"id":"131","cidade":"Feira de Santana","regiao":"Paraguaçu\/Centro"},{"id":"132","cidade":"Filadélfia","regiao":"Paraguaçu\/Centro"},{"id":"133","cidade":"Firmino Alves","regiao":"Sudoeste"},{"id":"134","cidade":"Floresta Azul","regiao":"Litoral Sul"},{"id":"135","cidade":"Formosa do Rio Preto","regiao":"Oeste"},{"id":"136","cidade":"Gandu","regiao":"Litoral Sul"},{"id":"137","cidade":"Gavião","regiao":"Paraguaçu\/Centro"},{"id":"138","cidade":"Gentio do Ouro","regiao":"Paraguaçu\/Centro"},{"id":"139","cidade":"Gloria","regiao":"Norte"},{"id":"140","cidade":"Gongogi","regiao":"Sudoeste"},{"id":"141","cidade":"Governador Mangabeira","regiao":"Paraguaçu\/Centro"},{"id":"142","cidade":"Guanambi","regiao":"Sudoeste"},{"id":"143","cidade":"Guaratinga","regiao":"Extremo Sul"},{"id":"144","cidade":"Guajeru","regiao":"Sudoeste"},{"id":"145","cidade":"Heliópolis","regiao":"Salvador\/Litoral Norte"},{"id":"146","cidade":"Iaçu","regiao":"Paraguaçu\/Centro"},{"id":"147","cidade":"Ibiassucê","regiao":"Sudoeste"},{"id":"148","cidade":"Ibicaraí","regiao":"Litoral Sul"},{"id":"149","cidade":"Ibicoara","regiao":"Paraguaçu\/Centro"},{"id":"150","cidade":"Ibicuí","regiao":"Sudoeste"},{"id":"151","cidade":"Ibipeba","regiao":"Paraguaçu\/Centro"},{"id":"152","cidade":"Ibipitanga","regiao":"Sudoeste"},{"id":"153","cidade":"Ibiquera","regiao":"Paraguaçu\/Centro"},{"id":"154","cidade":"Ibirapitanga","regiao":"Litoral Sul"},{"id":"155","cidade":"Ibirapuã","regiao":"Extremo Sul"},{"id":"156","cidade":"Ibirataia","regiao":"Sudoeste"},{"id":"157","cidade":"Ibitiara","regiao":"Paraguaçu\/Centro"},{"id":"158","cidade":"Ibititá","regiao":"Paraguaçu\/Centro"},{"id":"159","cidade":"Ibotirama","regiao":"Oeste"},{"id":"160","cidade":"Ichu","regiao":"Paraguaçu\/Centro"},{"id":"161","cidade":"Igaporã","regiao":"Oeste"},{"id":"162","cidade":"Igrapiúna","regiao":"Litoral Sul"},{"id":"163","cidade":"Iguaí","regiao":"Sudoeste"},{"id":"164","cidade":"Ilhéus","regiao":"Litoral Sul"},{"id":"165","cidade":"Inhambupe","regiao":"Salvador\/Litoral Norte"},{"id":"166","cidade":"Ipeceata","regiao":"Paraguaçu\/Centro"},{"id":"167","cidade":"Ipiaú","regiao":"Sudoeste"},{"id":"168","cidade":"Ipirá","regiao":"Paraguaçu\/Centro"},{"id":"169","cidade":"Ipupiara","regiao":"Paraguaçu\/Centro"},{"id":"170","cidade":"Irajuba","regiao":"Paraguaçu\/Centro"},{"id":"171","cidade":"Iramaia","regiao":"Paraguaçu\/Centro"},{"id":"172","cidade":"Iraquara","regiao":"Paraguaçu\/Centro"},{"id":"173","cidade":"Irará","regiao":"Paraguaçu\/Centro"},{"id":"174","cidade":"Irecê","regiao":"Paraguaçu\/Centro"},{"id":"175","cidade":"Itabela","regiao":"Extremo Sul"},{"id":"176","cidade":"Itapebi","regiao":"Extremo Sul"},{"id":"177","cidade":"Itaberaba","regiao":"Paraguaçu\/Centro"},{"id":"178","cidade":"Itabuna","regiao":"Litoral Sul"},{"id":"179","cidade":"Itacaré","regiao":"Litoral Sul"},{"id":"180","cidade":"Itaete","regiao":"Paraguaçu\/Centro"},{"id":"181","cidade":"Itagi","regiao":"Sudoeste"},{"id":"182","cidade":"Itagibá","regiao":"Sudoeste"},{"id":"183","cidade":"Itagimirim","regiao":"Extremo Sul"},{"id":"184","cidade":"Itaguaçu da Bahia","regiao":"Paraguaçu\/Centro"},{"id":"185","cidade":"Itaju do Colônia","regiao":"Litoral Sul"},{"id":"186","cidade":"Itajuípe","regiao":"Litoral Sul"},{"id":"187","cidade":"Itamaraju","regiao":"Extremo Sul"},{"id":"188","cidade":"Itambé","regiao":"Sudoeste"},{"id":"189","cidade":"Itamari","regiao":"Sudoeste"},{"id":"190","cidade":"Itanagra","regiao":"Salvador\/Litoral Norte"},{"id":"191","cidade":"Itanhém","regiao":"Extremo Sul"},{"id":"192","cidade":"Itaparica","regiao":"Salvador\/Litoral Norte"},{"id":"193","cidade":"Itapé","regiao":"Litoral Sul"},{"id":"194","cidade":"Itapetinga","regiao":"Sudoeste"},{"id":"195","cidade":"Itapicuru","regiao":"Salvador\/Litoral Norte"},{"id":"196","cidade":"Itapitanga","regiao":"Litoral Sul"},{"id":"197","cidade":"Itaquara","regiao":"Paraguaçu\/Centro"},{"id":"198","cidade":"Itarantim","regiao":"Sudoeste"},{"id":"199","cidade":"Itatim","regiao":"Paraguaçu\/Centro"},{"id":"200","cidade":"Itiruçu","regiao":"Paraguaçu\/Centro"},{"id":"201","cidade":"Itiúba","regiao":"Paraguaçu\/Centro"},{"id":"202","cidade":"Itororó","regiao":"Sudoeste"},{"id":"203","cidade":"Ituaçu","regiao":"Sudoeste"},{"id":"204","cidade":"Ituberá","regiao":"Litoral Sul"},{"id":"205","cidade":"Iuiú","regiao":"Sudoeste"},{"id":"206","cidade":"Jaborandi","regiao":"Oeste"},{"id":"207","cidade":"Jacaraci","regiao":"Sudoeste"},{"id":"208","cidade":"Jacobina","regiao":"Paraguaçu\/Centro"},{"id":"209","cidade":"Jaguaquara","regiao":"Paraguaçu\/Centro"},{"id":"210","cidade":"Jaguarari","regiao":"Paraguaçu\/Centro"},{"id":"211","cidade":"Jaguaripe","regiao":"Litoral Sul"},{"id":"212","cidade":"Jandaíra","regiao":"Salvador\/Litoral Norte"},{"id":"213","cidade":"Jequié","regiao":"Sudoeste"},{"id":"214","cidade":"Jeremoabo","regiao":"Salvador\/Litoral Norte"},{"id":"215","cidade":"Jiquiriçá","regiao":"Paraguaçu\/Centro"},{"id":"216","cidade":"Jitaúna","regiao":"Sudoeste"},{"id":"217","cidade":"João Dourado","regiao":"Paraguaçu\/Centro"},{"id":"218","cidade":"Juazeiro","regiao":"Norte"},{"id":"219","cidade":"Jucuruçu","regiao":"Extremo Sul"},{"id":"220","cidade":"Jussara","regiao":"Paraguaçu\/Centro"},{"id":"221","cidade":"Jussari","regiao":"Litoral Sul"},{"id":"222","cidade":"Jussiape","regiao":"Paraguaçu\/Centro"},{"id":"223","cidade":"Lafaiete Coutinho","regiao":"Paraguaçu\/Centro"},{"id":"224","cidade":"Lajedo do Tabocal","regiao":"Paraguaçu\/Centro"},{"id":"225","cidade":"Lagoa Real","regiao":"Sudoeste"},{"id":"226","cidade":"Laje","regiao":"Paraguaçu\/Centro"},{"id":"227","cidade":"Lajedão","regiao":"Extremo Sul"},{"id":"228","cidade":"Lajedinho","regiao":"Paraguaçu\/Centro"},{"id":"229","cidade":"Lamarão","regiao":"Paraguaçu\/Centro"},{"id":"230","cidade":"Lapão","regiao":"Paraguaçu\/Centro"},{"id":"231","cidade":"Lauro de Freitas","regiao":"Salvador\/Litoral Norte"},{"id":"232","cidade":"Lençóis","regiao":"Paraguaçu\/Centro"},{"id":"233","cidade":"Licínio de Almeida","regiao":"Sudoeste"},{"id":"234","cidade":"Livramento de Nossa Senhora","regiao":"Sudoeste"},{"id":"235","cidade":"Livramento do Brumado","regiao":"Sudoeste"},{"id":"236","cidade":"Luís Eduardo Magalhães","regiao":"Oeste"},{"id":"237","cidade":"Macajuba","regiao":"Paraguaçu\/Centro"},{"id":"238","cidade":"Macarani","regiao":"Sudoeste"},{"id":"239","cidade":"Macaúbas","regiao":"Sudoeste"},{"id":"240","cidade":"Macurure","regiao":"Norte"},{"id":"241","cidade":"Madre de Deus","regiao":"Salvador\/Litoral Norte"},{"id":"242","cidade":"Maetinga","regiao":"Sudoeste"},{"id":"243","cidade":"Maiquinique","regiao":"Sudoeste"},{"id":"244","cidade":"Mairi","regiao":"Paraguaçu\/Centro"},{"id":"245","cidade":"Malhada","regiao":"Oeste"},{"id":"246","cidade":"Malhada de Pedras","regiao":"Sudoeste"},{"id":"247","cidade":"Manoel Vitorino","regiao":"Sudoeste"},{"id":"248","cidade":"Mansidão","regiao":"Oeste"},{"id":"249","cidade":"Maracás","regiao":"Paraguaçu\/Centro"},{"id":"250","cidade":"Maragogipe","regiao":"Paraguaçu\/Centro"},{"id":"251","cidade":"Maraú","regiao":"Litoral Sul"},{"id":"252","cidade":"Marcionilio Souza","regiao":"Paraguaçu\/Centro"},{"id":"253","cidade":"Mascote","regiao":"Litoral Sul"},{"id":"254","cidade":"Mata de São João","regiao":"Salvador\/Litoral Norte"},{"id":"255","cidade":"Matina","regiao":"Oeste"},{"id":"256","cidade":"Medeiros Neto","regiao":"Extremo Sul"},{"id":"257","cidade":"Miguel Calmon","regiao":"Paraguaçu\/Centro"},{"id":"258","cidade":"Milagres","regiao":"Paraguaçu\/Centro"},{"id":"259","cidade":"Mirangaba","regiao":"Paraguaçu\/Centro"},{"id":"260","cidade":"Mirante","regiao":"Sudoeste"},{"id":"261","cidade":"Monte Santo","regiao":"Paraguaçu\/Centro"},{"id":"262","cidade":"Morpara","regiao":"Oeste"},{"id":"263","cidade":"Morro do Chapéu","regiao":"Paraguaçu\/Centro"},{"id":"264","cidade":"Mortugaba","regiao":"Sudoeste"},{"id":"265","cidade":"Mucugê","regiao":"Paraguaçu\/Centro"},{"id":"266","cidade":"Mucuri","regiao":"Extremo Sul"},{"id":"267","cidade":"Mulungu do Morro","regiao":"Paraguaçu\/Centro"},{"id":"268","cidade":"Mundo Novo","regiao":"Paraguaçu\/Centro"},{"id":"269","cidade":"Muniz Ferreira","regiao":"Paraguaçu\/Centro"},{"id":"270","cidade":"Muquem do São Francisco","regiao":"Oeste"},{"id":"271","cidade":"Muritiba","regiao":"Paraguaçu\/Centro"},{"id":"272","cidade":"Mutuípe","regiao":"Paraguaçu\/Centro"},{"id":"273","cidade":"Nazaré","regiao":"Paraguaçu\/Centro"},{"id":"274","cidade":"Nilo Peçanha","regiao":"Litoral Sul"},{"id":"275","cidade":"Nordestina","regiao":"Paraguaçu\/Centro"},{"id":"276","cidade":"Nova Canaã","regiao":"Sudoeste"},{"id":"277","cidade":"Nova Fátima","regiao":"Paraguaçu\/Centro"},{"id":"278","cidade":"Nova Ibiá","regiao":"Sudoeste"},{"id":"279","cidade":"Nova Itarana","regiao":"Paraguaçu\/Centro"},{"id":"280","cidade":"Nova Redenção","regiao":"Paraguaçu\/Centro"},{"id":"281","cidade":"Nova Soure","regiao":"Salvador\/Litoral Norte"},{"id":"282","cidade":"Nova Viçosa","regiao":"Extremo Sul"},{"id":"283","cidade":"Novo Horizonte","regiao":"Paraguaçu\/Centro"},{"id":"284","cidade":"Novo Triunfo","regiao":"Salvador\/Litoral Norte"},{"id":"285","cidade":"Olindina","regiao":"Salvador\/Litoral Norte"},{"id":"286","cidade":"Oliveira dos Brejinhos","regiao":"Oeste"},{"id":"287","cidade":"Ouriçangas","regiao":"Salvador\/Litoral Norte"},{"id":"288","cidade":"Ourolândia","regiao":"Paraguaçu\/Centro"},{"id":"289","cidade":"Palmas de Monte alto","regiao":"Sudoeste"},{"id":"290","cidade":"Palmeiras","regiao":"Paraguaçu\/Centro"},{"id":"291","cidade":"Paramirim","regiao":"Sudoeste"},{"id":"292","cidade":"Paratinga","regiao":"Oeste"},{"id":"293","cidade":"Paripiranga","regiao":"Salvador\/Litoral Norte"},{"id":"294","cidade":"Pau Brasil","regiao":"Litoral Sul"},{"id":"295","cidade":"Paulo Afonso","regiao":"Norte"},{"id":"296","cidade":"Pé de Serra","regiao":"Paraguaçu\/Centro"},{"id":"297","cidade":"Pedrão","regiao":"Salvador\/Litoral Norte"},{"id":"298","cidade":"Pedro Alexandre","regiao":"Salvador\/Litoral Norte"},{"id":"299","cidade":"Piatã","regiao":"Paraguaçu\/Centro"},{"id":"300","cidade":"Pilão Arcado","regiao":"Norte"},{"id":"301","cidade":"Pindaí","regiao":"Sudoeste"},{"id":"302","cidade":"Pindobaçu","regiao":"Paraguaçu\/Centro"},{"id":"303","cidade":"Pintadas","regiao":"Paraguaçu\/Centro"},{"id":"304","cidade":"Pirai do Norte","regiao":"Litoral Sul"},{"id":"305","cidade":"Piripá","regiao":"Sudoeste"},{"id":"306","cidade":"Piritiba","regiao":"Paraguaçu\/Centro"},{"id":"307","cidade":"Planaltino","regiao":"Paraguaçu\/Centro"},{"id":"308","cidade":"Planalto","regiao":"Sudoeste"},{"id":"309","cidade":"Poções","regiao":"Sudoeste"},{"id":"310","cidade":"Pojuca","regiao":"Salvador\/Litoral Norte"},{"id":"311","cidade":"Ponto Novo","regiao":"Paraguaçu\/Centro"},{"id":"312","cidade":"Porto Seguro","regiao":"Extremo Sul"},{"id":"313","cidade":"Potiraguá","regiao":"Sudoeste"},{"id":"314","cidade":"Prado","regiao":"Extremo Sul"},{"id":"315","cidade":"Presidente Dutra","regiao":"Paraguaçu\/Centro"},{"id":"316","cidade":"Presidente Jânio Quadros","regiao":"Sudoeste"},{"id":"317","cidade":"Presidente Tancredo Neves","regiao":"Litoral Sul"},{"id":"318","cidade":"Queimadas","regiao":"Paraguaçu\/Centro"},{"id":"319","cidade":"Quijingue","regiao":"Paraguaçu\/Centro"},{"id":"320","cidade":"Quixabeira","regiao":"Paraguaçu\/Centro"},{"id":"321","cidade":"Rafael Jambeiro","regiao":"Paraguaçu\/Centro"},{"id":"322","cidade":"Remanso","regiao":"Norte"},{"id":"323","cidade":"Retirolândia","regiao":"Paraguaçu\/Centro"},{"id":"324","cidade":"Riachão das Neves","regiao":"Oeste"},{"id":"325","cidade":"Riachão do Jacuípe","regiao":"Paraguaçu\/Centro"},{"id":"326","cidade":"Riacho de Santana","regiao":"Oeste"},{"id":"327","cidade":"Ribeira do Amparo","regiao":"Salvador\/Litoral Norte"},{"id":"328","cidade":"Ribeira do Pombal","regiao":"Salvador\/Litoral Norte"},{"id":"329","cidade":"Ribeirao do Largo","regiao":"Sudoeste"},{"id":"330","cidade":"Rio de Contas","regiao":"Paraguaçu\/Centro"},{"id":"331","cidade":"Rio do Antônio","regiao":"Sudoeste"},{"id":"332","cidade":"Rio do Pires","regiao":"Sudoeste"},{"id":"333","cidade":"Rio Real","regiao":"Salvador\/Litoral Norte"},{"id":"334","cidade":"Rodelas","regiao":"Norte"},{"id":"335","cidade":"Ruy Barbosa","regiao":"Paraguaçu\/Centro"},{"id":"336","cidade":"Salinas da Margarida","regiao":"Salvador\/Litoral Norte"},{"id":"337","cidade":"Salvador","regiao":"Salvador\/Litoral Norte"},{"id":"338","cidade":"Santa Bárbara","regiao":"Paraguaçu\/Centro"},{"id":"339","cidade":"Santa Brigida","regiao":"Salvador\/Litoral Norte"},{"id":"340","cidade":"Santa Cruz Cabrália","regiao":"Extremo Sul"},{"id":"341","cidade":"Santa Cruz da Vitória","regiao":"Sudoeste"},{"id":"342","cidade":"Santa Inês","regiao":"Paraguaçu\/Centro"},{"id":"343","cidade":"Santa Luzia","regiao":"Litoral Sul"},{"id":"344","cidade":"Santa Maria da Vitória","regiao":"Oeste"},{"id":"345","cidade":"Santa Rita de Cássia","regiao":"Oeste"},{"id":"346","cidade":"Santa Teresinha","regiao":"Paraguaçu\/Centro"},{"id":"347","cidade":"Santaluz","regiao":"Paraguaçu\/Centro"},{"id":"348","cidade":"Santana","regiao":"Oeste"},{"id":"349","cidade":"Santanópolis","regiao":"Paraguaçu\/Centro"},{"id":"350","cidade":"Santo Amaro","regiao":"Paraguaçu\/Centro"},{"id":"351","cidade":"Santo Antônio de Jesus","regiao":"Paraguaçu\/Centro"},{"id":"352","cidade":"Santo Estêvão","regiao":"Paraguaçu\/Centro"},{"id":"353","cidade":"São Desidério","regiao":"Oeste"},{"id":"354","cidade":"São Domingos","regiao":"Paraguaçu\/Centro"},{"id":"355","cidade":"São Felipe","regiao":"Paraguaçu\/Centro"},{"id":"356","cidade":"São Félix","regiao":"Paraguaçu\/Centro"},{"id":"357","cidade":"São Félix do Coribe","regiao":"Oeste"},{"id":"358","cidade":"São Francisco do Conde","regiao":"Paraguaçu\/Centro"},{"id":"359","cidade":"São Gabriel","regiao":"Paraguaçu\/Centro"},{"id":"360","cidade":"São Gonçalo dos Campos","regiao":"Paraguaçu\/Centro"},{"id":"361","cidade":"São José da Vitória","regiao":"Litoral Sul"},{"id":"362","cidade":"São José do Jacuípe","regiao":"Paraguaçu\/Centro"},{"id":"363","cidade":"São Miguel das Matas","regiao":"Paraguaçu\/Centro"},{"id":"364","cidade":"São Sebastião do Passé","regiao":"Paraguaçu\/Centro"},{"id":"365","cidade":"Sapeaçu","regiao":"Paraguaçu\/Centro"},{"id":"366","cidade":"Sátiro Dias","regiao":"Salvador\/Litoral Norte"},{"id":"367","cidade":"Saubara","regiao":"Paraguaçu\/Centro"},{"id":"368","cidade":"Saúde","regiao":"Paraguaçu\/Centro"},{"id":"369","cidade":"Seabra","regiao":"Paraguaçu\/Centro"},{"id":"370","cidade":"Sebastião Laranjeiras","regiao":"Sudoeste"},{"id":"371","cidade":"Senhor do Bonfim","regiao":"Paraguaçu\/Centro"},{"id":"372","cidade":"Sento Sé","regiao":"Norte"},{"id":"373","cidade":"Serra do Ramalho","regiao":"Oeste"},{"id":"374","cidade":"Serra Dourada","regiao":"Oeste"},{"id":"375","cidade":"Serra Preta","regiao":"Paraguaçu\/Centro"},{"id":"376","cidade":"Serrinha","regiao":"Paraguaçu\/Centro"},{"id":"377","cidade":"Serrolândia","regiao":"Paraguaçu\/Centro"},{"id":"378","cidade":"Simões Filho","regiao":"Salvador\/Litoral Norte"},{"id":"379","cidade":"Sítio do Mato","regiao":"Oeste"},{"id":"380","cidade":"Sitio do Quinto","regiao":"Salvador\/Litoral Norte"},{"id":"381","cidade":"Sobradinho","regiao":"Norte"},{"id":"382","cidade":"Souto Soares","regiao":"Paraguaçu\/Centro"},{"id":"383","cidade":"Tabocas do Brejo Velho","regiao":"Oeste"},{"id":"384","cidade":"Tanhaçu","regiao":"Sudoeste"},{"id":"385","cidade":"Tanque Novo","regiao":"Sudoeste"},{"id":"386","cidade":"Tanquinho","regiao":"Paraguaçu\/Centro"},{"id":"387","cidade":"Taperoá","regiao":"Litoral Sul"},{"id":"388","cidade":"Tapiramutá","regiao":"Paraguaçu\/Centro"},{"id":"389","cidade":"Teixeira de Freitas","regiao":"Extremo Sul"},{"id":"390","cidade":"Teodoro Sampaio","regiao":"Paraguaçu\/Centro"},{"id":"391","cidade":"Teofilândia","regiao":"Paraguaçu\/Centro"},{"id":"392","cidade":"Teolândia","regiao":"Litoral Sul"},{"id":"393","cidade":"Terra Nova","regiao":"Paraguaçu\/Centro"},{"id":"394","cidade":"Tremedal","regiao":"Sudoeste"},{"id":"395","cidade":"Tucano","regiao":"Paraguaçu\/Centro"},{"id":"396","cidade":"Uauá","regiao":"Norte"},{"id":"397","cidade":"Ubaíra","regiao":"Paraguaçu\/Centro"},{"id":"398","cidade":"Ubaitaba","regiao":"Litoral Sul"},{"id":"399","cidade":"Ubatã","regiao":"Sudoeste"},{"id":"400","cidade":"Uibai","regiao":"Paraguaçu\/Centro"},{"id":"401","cidade":"Una","regiao":"Litoral Sul"},{"id":"402","cidade":"Umburanas","regiao":"Paraguaçu\/Centro"},{"id":"403","cidade":"Urandi","regiao":"Sudoeste"},{"id":"404","cidade":"Uruçuca","regiao":"Litoral Sul"},{"id":"405","cidade":"Utinga","regiao":"Paraguaçu\/Centro"},{"id":"406","cidade":"Valença","regiao":"Litoral Sul"},{"id":"407","cidade":"Valente","regiao":"Paraguaçu\/Centro"},{"id":"408","cidade":"Várzea do Poço","regiao":"Paraguaçu\/Centro"},{"id":"409","cidade":"Várzea da Roca","regiao":"Paraguaçu\/Centro"},{"id":"410","cidade":"Várzea Nova","regiao":"Paraguaçu\/Centro"},{"id":"411","cidade":"Varzedo","regiao":"Paraguaçu\/Centro"},{"id":"412","cidade":"Vera Cruz","regiao":"Salvador\/Litoral Norte"},{"id":"413","cidade":"Vereda","regiao":"Extremo Sul"},{"id":"414","cidade":"Vitória da Conquista","regiao":"Sudoeste"},{"id":"415","cidade":"Wagner","regiao":"Paraguaçu\/Centro"},{"id":"416","cidade":"Wanderley","regiao":"Oeste"},{"id":"417","cidade":"Wenceslau Guimarães","regiao":"Litoral Sul"},{"id":"418","cidade":"Xique-xique","regiao":"Paraguaçu\/Centro"}];



  var city = formEmpresa.campoCidade.value;



     for(i=0;i<=geral.length;i++){
 
         if(city === geral[i].cidade){

            regiao = geral[i].regiao;
            formEmpresa.campoRegiao.value = regiao;
           

         }



        //document.write(geral[i].regiao+" "+i+"<br>");
     }

}

function validaTelefone(){

var tel = formEmpresa.campoTelefone.value;

if(tel.length == 2){
 
  formEmpresa.campoTelefone.value = "("+tel+") ";

}

if(formEmpresa.campoTelefone.value.length == 9){
 
  formEmpresa.campoTelefone.value = tel+"-";

}

}

function validaCelular(){

var tel = formEmpresa.campoTelefone2.value;

if(tel.length == 2){
 
  formEmpresa.campoTelefone2.value = "("+tel+") 9";

}

if(formEmpresa.campoTelefone2.value.length == 10){
 
  formEmpresa.campoTelefone2.value = tel+"-";

}

}

function toUpperName(){
  if(register.campoNome.value.length == 1){

    register.campoNome.value = register.campoNome.value.toUpperCase();
  }
}


function validaCPF(element){

  let campo = element;
  let cpf = element.value;


  if(cpf.length == 3) {campo.value +=".";}
  if(cpf.length == 7) {campo.value +=".";}
  if(cpf.length == 11) {campo.value +="-";}   


}

function focc(){
  campoRG.focus();
}

function toUpperCargo(){
  if(register.campoCargo.value.length == 1){

    register.campoCargo.value = register.campoCargo.value.toUpperCase();
  }
}



function validaCelular2(elemento){

  let telefone = elemento.value;

  if(telefone.length == 2){

    elemento.value = "("+elemento.value+") 9"; 
  }

  if(telefone.length == 10){

    elemento.value += "-"; 
  }
}

function armazena(campo){

  if(campo.value != "") window.sessionStorage.setItem('emailrec', campo.value);
}


function verificaSession(){

  const campoEmail = document.getElementById('campoEmail');

  if(window.sessionStorage.getItem('emailrec')){
    campoEmail.value = window.sessionStorage.getItem('emailrec');
  }
}

function verificaNegoc(element){


  campoValorProduto = document.getElementById('campoValorProduto');

  if(element.value == 'Negociada'){

    campoValorProduto.removeAttribute('disabled');
  }

  if(element.value != 'Negociada'){

    campoValorProduto.setAttribute('disabled','');
  }
};