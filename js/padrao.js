function gerarImagem(){
    //
    //Preenche dados no html escondido
    var nome = $("#nome").val();
    var cidade = $("#cidade").val();
    var estado = $("#estado").val();
    var etapa = $("#etapa").val();
    var vitoria = $("#vitoria").val();
    
    //
    $("#nomeImg").html(nome);
    $("#enderecoImg").html(cidade + ' - ' + estado);
    $("#etapaImg").html(etapa);
    $("#vitoriaImg").html(vitoria);
    //
    $("#htmlImgGerado").show();
    //
    // Gera img e baixa
    html2canvas(document.getElementById("htmlImgGerado")).then(function(canvas){
        var anchorTag = document.createElement("a");
        document.body.appendChild(anchorTag);
        // document.getElementById("previewImg").appendChild(canvas);
        //
        nome = nome.replace(" ", "_");
        //
        anchorTag.download =  nome + "_" + cidade + "_" + estado + ".jpg";
        anchorTag.href = canvas.toDataURL();
        anchorTag.target = '_blank';
        anchorTag.click();
        //
        $("#htmlImgGerado").hide();
    });
    //
    //limpa os campos
    $("#nome").val('');
    $("#cidade").val('');
    $("#estado").val('');
    $("#etapa").val('');
    $("#vitoria").val('');
    $("#fotoPessoa").val('')
}

function carregaImg(){
    var foto = $("#fotoPessoa")[0].files[0];
    //
    //
    var file = new FileReader();
    file.onload = function(e) {
        document.getElementById("fotoPessoaImg").src = e.target.result;
    };      
    file.readAsDataURL(foto);
    //
}
