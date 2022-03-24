<?php
    include_once("_BD/conecta_login.php");
?>
<!doctype html>
<html lang="pt" class="bodyLogin">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>Liga Classe A</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/padrao.css">
    </head>
    <body class="bodyLogin">
        <div class="container-fluid linhaLogin">
            <div class="row linhaLogin">
                <div class="col-lg-8 col-md-6 col-sm-5 d-none d-sm-block">
                    <center class="alinhaCentro"><img src="img/logoGrandeTransparente.png" class="img-fluid" width="75%"></center>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-7 col-12 cardLogin">
                    <form class="alinhaCentro" action="_BD/conecta_login.php" method="POST" >
                        <center><img src="img/logo.png" class="img-fluid" width="40%"></center>
                        <input type="hidden" id="operacao" name="operacao" value="logar">
                        <div class="form-group">
                            <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome Completo" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="cidade" name="cidade" placeholder="Cidade">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="estado" name="estado" placeholder="Estado">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="etapa" name="etapa" placeholder="Etapa">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="vitoria" name="vitoria" placeholder="Vitória">
                        </div>
                        <div class="form-group pb-4">
                            <input type="file" class="form-control" id="fotoPessoa" name="fotoPessoa" onchange="carregaImg()">
                        </div>
                        <center class="pb-3">
                            <button type="button" class="btn btnRed" onclick="gerarImagem()">GERAR IMAGEM</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <div class="divImg" id="htmlImgGerado">
        <div class="divImgPadrao">
            <img src="img/imgPdrao.png">
        </div>
        <div class="divImgPessoa">
            <span class="fotoPessoaImg">
                <img src="" id="fotoPessoaImg" width="750px">
            </span>
        </div>
        <div class="">
            <span class="nomeImg" >
                <div class="divNome">
                    <center>
                        <span id="nomeImg"></span>
                    </center>
                </div>
            </span>
            <span class="enderecoImg">
                <div class="divEndereco">
                    <center>
                        <span id="enderecoImg"></span>
                    </center>
                </div>
            </span>
            <span class="etapaImg">
                <div class="divEtapa">
                    <center>
                        <span style="font-size: 15px;">ETAPA:</span>
                        <br>
                        <span id="etapaImg"></span>
                    </center>
                </div>
            </span>
            <span class="vitoriaImg">
                <div class="divVitoria">
                    <center>
                        <span style="font-size: 15px;">VITÓRIA:</span>
                        <br>
                        <span id="vitoriaImg"></span>
                    </center>
                </div>
            </span>
        </div>
    </div>

    <!-- main js -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="js/html2canvas.min.js"></script>
    <script src="js/padrao.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
</html>