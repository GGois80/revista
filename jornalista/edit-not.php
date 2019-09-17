<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
    <title>Editar Noticia</title>
  <?php include_once ('icon.php');?>
    <link rel="stylesheet" type='text/css' href="css/estilo.css"/>
    <script src="https://cdn.tiny.cloud/1/0cyyd9chleyesdrd8ykoku69kactuksxhquf2xql0z2jahi3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
</head>
<body>
    <?php
      include_once ('../conexao.php');
      include_once ('verifica-login.php');
      include_once ('menus/menu-index.php');
      /*Pegando os dados da oticia para editar*/
      $idnot = $_GET['idnot'];

        $sql = "SELECT * FROM noticia WHERE id_not = $idnot";
      $query = mysqli_query($conexao,$sql);
   $dadosnot = mysqli_fetch_assoc($query);
    $img = $dadosnot['foto'];
    ?>
<!-- formulario com os dados da noticia para editar-->
    <div class="imgnot">
     <img src="../imgnot/<?php echo $img;?>"/>
   </div>
      <h2>Editar Noticia</h2>
    <fieldset>
        <form action="edit-notfim.php" method="post" enctype="multipart/form-data"/>
            <p>Titulo:</p>
                <p><input type="text" name="titulo" value="<?php echo $dadosnot['titulo'];?>"/></p>
                <P>Escolha a Foto:</p>
                    <p><input type="file" name="img"/></p>
            <textarea name="noticia"><?php echo $dadosnot['texto'];?></textarea>
                <input type="hidden" name="id" value="<?php echo $_SESSION['id_user'];?>"/> <!-- esse valor sera enserido dentro do case editar,se vc por fora, ira aparecer null quando for excluir-->
                <input type="hidden" name="escolha" value= "editar"/>
                <input type="hidden" name="idnot" value= "<?php echo $idnot?>"/>
             <div class="centro padding">
                 <button>Enviar</button>
             </div>
        </form>
    </fieldset>
