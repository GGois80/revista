<!DOCTYPE html>
<html lang="pt" dir="ltr">
    <head>
        <meta charset="utf-8">
            <title>Gerenciamento de Usuarios e Jornalistas</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <?php include_once ('icon.php');?>
    </head>
    <body>
        <?php include 'menus/menu-index.php';?>
        <h2>Listagem dos Usuarios e Jornalistas</h2>
        <?php
        include_once ('../conexao.php');
        include_once ('verifica-login.php'); ?>

            <table>
                <tr>
                    <td>Nome</td>
                    <td>Nivel</td>
                    <td>Editar</td>
                    <td>Estatus</td>
                </tr>

    <?php     $sql="SELECT id_usuario,nome,flag,moderuser FROM usuario WHERE flag !=3 ORDER BY nome ASC";
            $query=mysqli_query($conexao,$sql);
            while ($dados=mysqli_fetch_assoc($query)){
                echo "
                    <tr>
                        <td>$dados[nome]</td>
                        <td>";
                        if($dados['flag'] == 1){
                          $normal = 'Usuario Comun';
                            echo "$normal</td>";
                        }else{
                            $jorn = 'Jornalista';
                            echo "$jorn</td>";
                        }
                         echo "<form action='up-jorn.php' method='POST'>
                            <td><input type='submit' name='escolha' value='editar'/></td>
                            <input type='hidden' name='id' value='$dados[id_usuario]'/>
                        </form>
                          <td>";
                          if($dados['moderuser'] == 1 ){
                                echo "<form action='up-jornfim.php' method='POST'>
                                          <input type='submit' name='escolha' value='bloquear'/></td>
                                          <input type='hidden' name='id' value='$dados[id_usuario]'/>
                                      </form>";
                          }else{
                            echo "<form action='up-jornfim.php' method='POST'>
                                      <input type='submit' name='escolha' value='ativar'/></td>
                                      <input type='hidden' name='id' value='$dados[id_usuario]'/>
                                  </form>";
                          };
                        /*<form action='up-jornfim.php' method='POST'>
                            <td><input type='submit' name='escolha' value='bloquear'/></td>
                            <input type='hidden' name='id' value='$dados[id_usuario]'/>
                        </form>
                    </tr>*/
            };
            echo '</table>';
        ?>
        <!-- <table>
            <tr>
                <td>Nome</td>
                <td>nivel</td>
                <td>Desbloquear</td>
            </tr>
<?php    /* $sql2="SELECT id_usuario,nome,flag FROM usuario WHERE flag !=3 AND moderuser = 2 ORDER BY nome ASC";
        $query2=mysqli_query($conexao,$sql2);
        while ($dados2=mysqli_fetch_assoc($query2)){
            echo "
                <tr>
                    <td>$dados2[nome]</td>
                    <td>$dados2[flag]</td>
                    <form action='up-jornfim.php' method='POST'>
                        <td><input type='submit' name='escolha' value='ativar'/></td>
                        <input type='hidden' name='id' value='$dados2[id_usuario]'/>
                    </form>
                </tr>";
        };
        echo "</table>"; */
?> -->
    </body>
</html>
