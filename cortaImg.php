<?php
    //
    unlink("uploads/imgSemCorte.jpg");
    unlink("uploads/imgSemCorte.png");
    unlink("uploads/imgSemCorte.jpeg");
    unlink("uploads/imgCorte.jpg");
    //
    $arquivo = $_FILES['fotoPessoa'];
    //
    //Define os tipos de arquivos válidos (No nosso caso, só imagens)
    $tipos = array('jpg', 'png', 'jpeg');
    //
    // Chama a função para enviar o arquivo 
    $retornoEnvio = uploadFile($arquivo, 'uploads/', $tipos, "imgSemCorte");
    //
    //Corta a imagem
    $targ_w = $_POST['w_o'];
    $targ_h = $_POST['w_o'];
    $jpeg_quality = 90;
    //
    $src = $retornoEnvio['caminho'];
    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
 
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
 
    imagejpeg($dst_r,"uploads/imgCorte.jpg",$jpeg_quality);

    function uploadFile($arquivo, $pasta, $tipos, $nome = null){
		if(isset($arquivo)){
			$infos = explode(".", $arquivo["name"]);
	 
			if(!$nome){
				for($i = 0; $i < count($infos) - 1; $i++){
					$novoNome = $arquivo["name"] . $infos[$i];
				}
			}
			else{
				$novoNome = $nome;
			}
	 
			$tipoArquivo = $infos[count($infos) - 1];
	 
			$tipoPermitido = false;
			foreach($tipos as $tipo){
				if(strtolower($tipoArquivo) == strtolower($tipo)){
					$tipoPermitido = true;
				}
			}
			if(!$tipoPermitido){
				$retorno["erro"] = "Tipo não permitido";
			}
			else{
				if(!is_dir($pasta)){
					mkdir($pasta, 0777, true);
				}
				if(move_uploaded_file($arquivo['tmp_name'], $pasta . $novoNome . "." . $tipoArquivo)){
					$retorno["caminho"] = $pasta . $novoNome . "." . $tipoArquivo;
					$retorno["nomeArquivo"] = $novoNome . "." . $tipoArquivo;
				}
				else{
					$retorno["erro"] = "Erro ao fazer upload";
				}
			}
		}
		else{
			$retorno["erro"] = "Arquivo nao setado";
		}
		return $retorno;
	}
?>