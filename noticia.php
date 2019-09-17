<?php   include_once ('conexao.php');
        include_once ('horario.php');

        $idnot = $_GET['id'];
        //echo $idnot;
             $sql="SELECT u.id_usuario AS idusuario, u.nome,u.moderuser,
                n.id_not AS idnoticia, n.texto, n.foto, n.data_noticia,n.titulo FROM usuario u INNER JOIN noticia n ON u.id_usuario = n.id_usunot WHERE n.id_not = $idnot";
          $query = mysqli_query($conexao,$sql);
            $not = mysqli_fetch_assoc($query);
            $_SESSION['noticia'] = $not['titulo'];?>
<!DOCTYPE html>
<html lang="pt" dir="ltr">
    <head>
        <meta charset="utf-8"/>
        <title><?php echo $_SESSION['noticia'];?></title>
        <?php include_once ('icon.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <link rel="stylesheet" type="text/css" href="jornalista/css/estilo.css"/>
    </head>
    <body>
        <?php
            include_once ('menu/men_index.php');
         ?>
         <div id="noticia" class="not-index">
             <img src="imgnot/<?php echo $not['foto'];?>" title="Revista | <?php echo $not['titulo'];?>"/>
             <h1><?php echo $not['titulo'];?></h1>
             <p><?php echo $not['texto'];?> </p>
             <p class="jorn">Escrito Por:<?php echo $not['nome'].' <br/>Data: '. date('d/m/Y H:i:s',strtotime($not['data_noticia']));?></p>
        </div> <br/><br/>
    <!--**************exibição dos comentarios****************-->
        <?php
                $sql2 = "SELECT u.id_usuario AS idusuario, u.nome, c.id_com AS idcoment, c.comentario, c.moderado, c.data_coment, c.id_usucom, c.id_comentnot FROM usuario u INNER JOIN comentarios c ON u.id_usuario = c.id_usucom WHERE c.id_comentnot = $idnot AND c.moderado = 2 ORDER BY c.comentario DESC ";
              $query2 = mysqli_query($conexao,$sql2);
                 $row = mysqli_num_rows($query2);

        if( $row > 0) { ?>
        <div class="comentarios">
            <?php while($coment = mysqli_fetch_assoc($query2)){ ?>
                <p><?php echo $coment['nome'];?>: <?php echo $coment['comentario'];?></p><br/>
        <?php }; ?>
        </div>
    <?php  } else{ ?>
            <div class="comentarios">
                <h1>Seja o primeiro a comentar ;v</h1>
            </div>
    <?php  }; ?>
    <!--****************************-->
        <div class="upcom">
          <fieldset>
              <h3>Faça um comentario:</h3>
              <form action="cadastro.php" method="post">
                <p>Escrever:</p>
                  <p><textarea name="comentario">Crie uma conta para poder Comentar!</textarea></p>
                    <input type="hidden" name="iduser" value="<?php echo $iduser;?>"/>
                    <input type="hidden" name="idnot" value="<?php echo $idnot;?>"/>
                   <div class="centro padding">
                       <a  href="cadastro.php"><button>Cadastrar-se</button></a>
                   </div>
              </form>
          </fieldset>
        </div>
    </body>
</html>
