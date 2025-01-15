$(document).ready(function () {
  
    ocultaTodos();



    $("#selectAtividades").change(function(){
        ocultaTodos();

        if($("#selectAtividades").val()==1){
            liberaHistoria();
        }
        if($("#selectAtividades").val()==2){
            liberaLivro();
        }
        if($("#selectAtividades").val()==3){
            liberaMusica();
        }
        if($("#selectAtividades").val()==4){
            liberaVideo();
        }
        if($("#selectAtividades").val()==5){
            $("#descricaoCaderno").show();
        }
        if($("#selectAtividades").val()==6){
            liberaArquivo();
        }
      
    });

    function liberaHistoria(){
        $("#descricaoHistoria").show();
        $("#nomeHistoria").show();
    }

    function liberaMusica(){
        $("#nomeMusica").show();
        $("#linkMusica").show();
        $("#descricaoMusica").show();
    }

    function liberaVideo(){
        $("#nomeVideo").show();
        $("#linkVideo").show();
        $("#descricaoVideo").show();
    }

    function liberaLivro(){
        $("#nomeLivro").show();
        $("#paginaLivro").show();
        $("#descricaoLivro").show();
    }


    function liberaArquivo(){
        $("#descricaoArquivo").show();
        $("#anexoArquivo").show();
    }


    function ocultaTodos(){
        $("#nomeMusica").hide();
        $("#linkMusica").hide();
        $("#descricaoMusica").hide();
    
    
        $("#nomeVideo").hide();
        $("#linkVideo").hide();
        $("#descricaoVideo").hide();
    
        $("#nomeLivro").hide();
        $("#paginaLivro").hide();
        $("#descricaoLivro").hide();
    
        $("#descricaoHistoria").hide();
        $("#nomeHistoria").hide();

        $("#descricaoCaderno").hide();

        $("#descricaoArquivo").hide();
        $("#anexoArquivo").hide();
        
    }
});


function liberaEdicao(){
    atualiza();
    $(".form-control").prop("disabled", false);
    $(".editar").hide();
}

function verificaIdade(){

    var anoNasc = new Date($("#dataNascimento").val());
    var idadeAtual = idade(anoNasc.getFullYear(),anoNasc.getMonth()+1, anoNasc.getDay() );
    $("#idade").val(idadeAtual);
}

function atualiza(){

    var escola = $("#cbEscola").val();
    ocultaTurmas();
    $(".turmas").prop('disabled', false);

    if(escola == "APAE - Escola Neli Arantes dos Santos"){
        $(".apae").show();
    }
    if(escola == "Centro de Convivência José Hilário de Oliveira"){
        
    }
    if(escola == "CMEI Irmã Irene"){
        $(".cmei").show();
    }
    if(escola == "Escola Estadual Coronel Lourenço Belo"){
        $(".eeclb").show();
    }
    if(escola == "Escola Estadual Modesto Antônio de Oliveira"){
        $(".eemao").show();
    }
    if(escola == "Creche Municipal Florentina Maria de Jesus"){
        $(".cmfmj").show();
    }
    if(escola == "Creche Municipal Florentina Maria de Jesus"){
        $(".cmfmj").show();
    }
    if(escola == "Creche Municipal Professora Maria Catarina de Araújo"){
        $(".cmpmca").show();
    }
    if(escola == "Escola Municipal Antônio Modesto de Oliveira"){
        $(".emmao").show();
    }
    if(escola == "Escola Municipal Elias Teodoro"){
        $(".emet").show();
    }
    if(escola == "Escola Municipal João Batista Trindade"){
        $(".emjbt").show();
    }
    if(escola == "Escola Municipal Nossa Senhora do Perpétuo Socorro"){
        $(".emnsps").show();
    }
    if(escola == "Escola Municipal Professor Nogueira de Sá"){
        $(".empns").show();
    }

    
}

function ocultaTurmas(){
    $(".emet").hide();
    $(".cmei").hide();
    $(".emmao").hide();
    $(".emjbt").hide();
    $(".emnsps").hide();
    $(".empns").hide();
    $(".cmpmca").hide();
    $(".cmfmj").hide();
    $(".cmjho").hide();
    $(".eeclb").hide();
    $(".eemao").hide();
    $(".apae").hide();
}

function verificaStatus(){
    
    if($("#contato").prop("checked") ==true || $("#confirmado").prop("checked")==true || $("#suspeito").prop("checked")==true){
    
    }
    else{
        alert("Você deve definir o tipo de monitoramento.");
        $("#contato").focus();
    }
}

function atualizaDatas(){
    var dias;
    if($("#contato").prop("checked") ==true){
        dias = 15;
    }
    if($("#suspeito").prop("checked") ==true){
        dias = 11;
    }
    if($("#confirmado").prop("checked") ==true){
        dias = 11;
    }
    
    var dataInicio = new Date($("#inicioMonitoramento").val());

    dataInicio.setDate(dataInicio.getDate()+dias);
    $("#fimMonitoramento").val(dataInicio.getFullYear() + "-" + ((dataInicio.getMonth()+1).toString().padStart(2,0))+ "-" + dataInicio.getDate().toString().padStart(2,0) );

}



function idade(ano_aniversario, mes_aniversario, dia_aniversario) {
    var d = new Date,
        ano_atual = d.getFullYear(),
        mes_atual = d.getMonth() + 1,
        dia_atual = d.getDate(),

        ano_aniversario = +ano_aniversario,
        mes_aniversario = +mes_aniversario,
        dia_aniversario = +dia_aniversario,

        quantos_anos = ano_atual - ano_aniversario;

    if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
        quantos_anos--;
    }

    return quantos_anos < 0 ? 0 : quantos_anos;
}
