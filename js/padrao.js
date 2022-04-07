$( document ).ready(function(){
    jcrop = Jcrop.attach('imgUpload', {aspectRatio: 1});
    //
    jcrop.listen('crop.change',(widget,e) => {
        $("#x").val(widget.pos.x);
        $("#y").val(widget.pos.y);
        $("#w").val(widget.pos.w);
        $("#h").val(widget.pos.h);
        //
      });
    //
    $('#imgUpload').load(function(){
        //
        $("#w_o").val($(this).prop('width'));
        $("#h_o").val($(this).prop('height'));
        //
        const rect = Jcrop.Rect.create(0,0,$(this).prop('width'),$(this).prop('height'));
        const options = {};
        jcrop.newWidget(rect,options);
    });
})

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
        document.getElementById("imgUpload").src = e.target.result;
    };      
    // const size = getImgSize(document.getElementById("imgUpload"));
    // altura = size['height'];
    // largura = size['width'];
    //
    file.readAsDataURL(foto);
    //
    $("#recortandoFoto").hide();
    $("#recortarFoto").show();
    $("#btnRecortarFoto").show();
    $("#btnModal").click();
    //
}

function uploadCortaFoto(){
    //
    $("#recortandoFoto").show();
    $("#recortarFoto").hide();
    $("#btnRecortarFoto").hide();
    //
    $('#formPrincipal').ajaxSubmit({
        dataType: 'html',
        url: 'cortaImg.php',
        resetForm: false,
        success: function(data) {     
            $("#btnCloseModal").click();
            if($("#w").val() == '' || $("#h").val() == ''){
                $("#fotoPessoaImg").attr("src", 'uploads/imgSemCorte.jpg');
            }else{
                $("#fotoPessoaImg").attr("src", 'uploads/imgCorte.jpg');
            }
            
        },
        error : function(){
          alert('Erro ao recortar foto!');
        }
      });
}