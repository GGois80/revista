<html>
  <head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type='text/css' href="css/estilo.css"/>
    <?php include_once ('icon.php');
          include_once ('../horario.php'); ?>
  </head>
  <body>
    <?php
      include_once ('../conexao.php');
      include_once ('verifica-login.php');
      include_once ('menus/menu-index.php');
    ?>
      <h2>Bem vindo! <?php echo $_SESSION['nome'];?> Jornalista</h2><br/>
        <div class="conteiner noticias">
          <div class="content">
          <?php
              $sql="SELECT u.id_usuario AS idusuario, u.nome,u.moderuser,
              n.id_not AS idnoticia, n.texto, n.foto, n.data_noticia,n.titulo FROM usuario u INNER JOIN noticia n ON u.id_usuario = n.id_usunot ORDER BY idnoticia DESC";
              $query=mysqli_query($conexao,$sql);
              while($not=mysqli_fetch_assoc($query)){?>
                <div class="box">
                    <a href="noticia.php?id=<?php echo $not['idnoticia'];?>"><img src="../imgnot/<?php echo $not['foto']; ?>" title="Tecnologia | <?php echo $not['titulo'];?>"/></a>
                    <a href="noticia.php?id=<?php echo $not['idnoticia'];?>"><p><?php echo $not['titulo'];?></p></a>
                    <p class="jorn">Escrito Por:<?php echo $not['nome'].' <br/>Data: '. date('d/m/Y ',strtotime($not['data_noticia'])). 'ás '.date('H:i a',strtotime($not['data_noticia'])); ?></p>
                </div>
          <?php }; ?>
        </div>
        </div>
  </body>
</html>
