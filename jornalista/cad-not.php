<?php
  include_once ('../conexao.php');

     $titulo = $_POST["titulo"];
        $img = $_FILES["img"];
    $noticia = mysqli_real_escape_string($conexao, trim($_POST['noticia']));
         $id = $_POST ["id"];
  //print_r($_FILES); exit();
  //abaixo faço uma checagem para ver se o usuário não está enviando o campo file em branco, a chave "error" serve para sabermos os niveis de erros
	if ($img["error"]==4){?>
		<script>
			alert('Não envie em branco');
			location.href='criar-not.php';
		</script>
	<?php }if ($img["error"]==1){?>
		<script>
			alert('O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini');//Ai teremos que alterar lá no php.ini meus camaradas, pesquisem e deem seus pulos
			location.href='criar-not.php';
		</script>
	<?php }
	//print_r($foto);exit;
	// Se a imagem estiver sido selecionada
	if ($img["name"]) {

		// Largura máxima em pixels
		$largura = 2000;
		// Altura máxima em pixels
		$altura = 3000;
		// Tamanho máximo do arquivo em bytes
		$tamanho = 1000000; // coloquei 1 megabyte
    	// Verifica se o arquivo é uma imagem através de uma função nativa do PHP preg_match, através de expressões regulares

		if(!preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $img["name"], $ext)){
			?>
            	<script>
					alert('Ops! Isso não é uma imagem.');
					location.href='criar-not.php';
				</script>
            <?php
			}


		// Pega as dimensões da imagem, criando um novo vetor através da função nativa getimagesize
		$dimensoes = getimagesize($img["tmp_name"]);

		// Verifica se a largura da imagem é maior que a largura permitida
		if($dimensoes[0] > $largura) {
			echo "<script> alert ('A largura da imagem não deve ultrapassar'); location.href='criar-not.php' </scripr> ".$largura." pixels";
		}

		// Verifica se a altura da imagem é maior que a altura permitida
		if($dimensoes[1] > $altura) {
			echo "<script> alert ('Altura da imagem não deve ultrapassar'); location.href='criar-not.php' ".$altura." pixels";
		}

		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($img["size"] > $tamanho) {
   		 	echo "<script> alert ('A imagem deve ter no máximo'); location.href='criar-not.php' ".$tamanho." bytes";
		}else {

			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $img["name"], $ext);

        	// Gera um nome único para a imagem, esse nome será criptografado em md5 (assim como poderia ser em sha1, preferi md5 porque não requer tanta segurança e o número de caracteres é menor que sha1), juntamente com o milesegundos que estou upando a imagem
        	$nomeimg = md5(uniqid(time())) . "." . $ext[1];
			//echo $nomefoto;
			//print_r($foto);exit;
        	// Caminho de onde ficará a imagem
        	$caminho = "../imgnot/" . $nomeimg;
			//echo $foto["tmp_name"];exit;
			// Faz o upload da imagem para seu respectivo caminho
      move_uploaded_file($img["tmp_name"], $caminho);

      $sql = "INSERT INTO noticia(texto, foto, data_noticia, titulo, id_usunot) VALUES ('$noticia', '$nomeimg', now(), '$titulo',$id)";
      //echo  $query; exit();
      $upa = mysqli_query($conexao,$sql);

      // Se os dados forem inseridos com sucesso, retorna essa mensagem
      if ($upa){?>
          <script>
              alert('Noticia Publicada!!');
              location.href='criar-not.php';//e redireciono o usuario para a pagina inicial, se quiserem mandar pra listagem fiquem a vontade
          </script>
      <?php
      }else{?>
          <script>
              alert('pfv preencha os campos corretamente!');
              location.href='criar-not.php';
          </script>
          <?php
      }
  }
 }
?>
