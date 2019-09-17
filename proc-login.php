<head><meta charset='utf-8'/></head>

<?php
session_start();
include 'conexao.php';

if(empty($_POST['login']) || empty($_POST['senha'])) { ?>
<script>
  alert('Por favor preencha os campos usuario ou senha');
    location.href='login.php';
</script>
<?php };

$email=mysqli_real_escape_string($conexao,$_POST['login']);
$senha=mysqli_real_escape_string($conexao,$_POST['senha']);

$verif = sha1($senha);

  $sql = "SELECT id_usuario,nome,email,flag,moderuser,senha FROM usuario WHERE email='{$email}' and senha = sha1('{$senha}')";
$query = mysqli_query($conexao,$sql);
  $row = mysqli_num_rows($query);
 $user = mysqli_fetch_assoc($query);
 //print_r($user);exit();
      $
            if ($user['moderuser'] == 1){

                 switch ($user['flag']) {
                   case  1:
                         $beta ='usuario/index.php';
                     break;
                   case  2:
                         $beta ='jornalista/index.php';
                     break;
                   case  3:
                         $beta ='adm/index.php';
                     break;
                 };
                   if($row == 1){
                       $usuario_bd = $user;
                         $_SESSION['nome'] = $usuario_bd['nome'];
                         $_SESSION['flag'] = $usuario_bd['flag'];
                      $_SESSION['id_user'] = $usuario_bd['id_usuario'];
                       header("Location:$beta");
                       exit();
                     }else if($row == 0) {
                          $_SESSION['nao_autenticado'] = true;
                          header('Location:login.php');
                          exit();
                      }
              } if ($user['moderuser'] == 2) { ?>
                  <script>
                      alert('Desculpe mais você esta Bloqueado!');
                        location.href='login.php';
                  </script>
<?php  exit(); };
/*
 if
  }else {  ?>
        <script>
            alert('Desculpe mais Você esta Bloqueado.');
                location.href ='login.php';
        </script>
<?php exit(); } */
?>
