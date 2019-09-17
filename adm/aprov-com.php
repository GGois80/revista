<?php
    include_once ('../conexao.php');
  //print_r($_POST);
   $id_com = $_POST['idcom'];
  $escolha = $_POST['escolha'];

  switch ($escolha) {
    case 'aprovado':
          $sql = "UPDATE comentarios SET moderado =2 WHERE id_com = $id_com";
        $query = mysqli_query($conexao,$sql);
        if($query == 1){ ?>
            <script>
                  alert('Comentario Aprovado!');
                    location.href="ger-coment.php";
            </script>
<?php  }else{ ?>
                  <script>
                        alert('Eroo ao Aprovar!');
                          location.href= "ger-coment.php";
                  </script>
<?php          };
      break;

    case 'excluir':
            $sql = "DELETE FROM comentarios WHERE id_com = $id_com";
          $query = mysqli_query($conexao,$sql);
          if($query == 1){ ?>
              <script>
                  alert('Comentario Excluido com Sucesso!');
                    location.href="ger-coment.php";
              </script>
  <?php }else{ ?>
                    <script>
                          alert('Eroo ao execluir!');
                            location.href= "ger-coment.php";
                    </script>
  <?php       };

      break;
  }

?>
