<?php
  include_once ('../conexao.php');

  $escolha = $_POST['escolha'];

  switch ($escolha) {
    case 'editar':

    $titulo = $_POST["titulo"];
       $img = $_FILES["img"];
   $noticia = mysqli_real_escape_string($conexao, trim($_POST['noticia']));
    $iduser = $_POST['id'];
     $idnot = $_POST['idnot'];

     if( empty($titulo) || empty($noticia)){ ?>
       <script>
          alert('preencha todos os campos!');
            location.href = 'edit-not.php?idnot=<?php echo $idnot;?>';
              exit();
       </script>
<?php }

     //print_r($_FILES); exit();
     //abaixo faço uma checagem para ver se o usuário não está enviando o campo file em branco, a chave "error" serve para sabermos os niveis de erros
    if ($img["error"]==4){?>
      <script>
        alert('Não envie em branco');
        location.href = 'edit-not.php?idnot=<?php echo $idnot;?>';
      </script>
    <?php }if ($img["error"]==1){?>
      <script>
        alert('O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini');//Ai teremos que alterar lá no php.ini meus camaradas, pesquisem e deem seus pulos
        location.href = 'edit-not.php?idnot=<?php echo $idnot;?>';
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
              location.href = 'edit-not.php?idnot=<?php echo $idnot;?>';
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

         //$sql = "UPDATE noticia(texto, foto, data_noticia, titulo, id_usunot) VALUES ('$noticia', '$nomeimg', now(), '$titulo',$id)";
         $sql = "UPDATE noticia SET texto = '$noticia', foto='$nomeimg', titulo = '$titulo' WHERE id_not = $idnot";
         //echo  $query; exit();
         $up = mysqli_query($conexao,$sql);

         // Se os dados forem inseridos com sucesso, retorna essa mensagem
         if ($up){?>
             <script>
                 alert('Noticia Editada com Sucesso!!');
                 location.href='criar-not.php';//e redireciono o usuario para a pagina inicial, se quiserem mandar pra listagem fiquem a vontade
             </script>
         <?php
         }else{?>
             <script>
                 alert('pfv preencha os campos corretamente!');
                  location.href = 'edit-not.php?idnot=<?php echo $idnot;?>';
             </script>
             <?php
         }
     }
    }

      break;

    case 'excluir':
        $idnot = $_POST['idnot'];


        $sql = "DELETE FROM noticia WHERE id_not = $idnot";
        // print_r ($sql); exit;
        $query = mysqli_query($conexao,$sql);
        if($query == 1){ ?>
            <script>
                alert('Noticia Excluida com Sucesso!');
                  location.href = 'criar-not.php';
            </script>
<?php  } else { ?>
          <script>
              alert('Erro ao excluir Noticia!!!');
                location.href = 'criar-not.php';
          </script>
<?php }

      break;
  }
?>                                                                                                                                                                                                                                                                                            
