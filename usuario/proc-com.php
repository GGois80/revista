<?php
    include_once ('../conexao.php');
    //print_r($_POST); exit();

        $com = mysqli_real_escape_string($conexao,trim($_POST['comentario']));
    $id_user = $_POST['iduser'];
      $idnot = $_POST['idnot'];

        $sql = "INSERT INTO comentarios(comentario,moderado,data_coment,id_usucom,id_comentnot) VALUES ('$com',1,now(),'$id_user','$idnot')";
      $query = mysqli_query($conexao,$sql);

      if($query == 1){ ?>
          <script>
              alert('Comentario enviado para o Adiminstrador');
              location.href =" noticia.php?id=<?php echo $idnot;?>";
          </script>
<?php } else{ ?>
          <script>
                alert("Erro ao postar Comentario");
                location.href = "noticia.php?id=<?php echo $idnot;?>";
          </script>
<?php };

?>
