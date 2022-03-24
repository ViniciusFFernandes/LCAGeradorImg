<?php
	class usuarios {

		function __construct(){
		
		}

		public function buscarUsuarioLogin($usuario, $senha){
			//
			$headers = array();
            $headers[] = "Content-Type: application/json";
			//
			$dados = array();
			$dados['identifier'] = $usuario;
			$dados['password'] = $senha;
			//
            $url = API . '/auth/local';
            //
            ob_start();
			//
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_exec($ch);
			//
            // JSON de retorno  
            $data = json_decode(ob_get_contents());
            // $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            // $erro = curl_errno($ch);
            // $info = curl_getinfo($ch);
			//
            ob_end_clean();
            curl_close($ch);
			//
			return $data;
		}
        
    }



?>
