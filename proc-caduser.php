<head>
  <meta charset="utf-8"/>
</head>
<?php
    session_start();
    include 'conexao.php';

    if(empty($_POST['nome']) || empty($_POST['sexo']) || empty($_POST['email']) || empty($_POST['cel']) || empty($_POST['senha'])){?>
        <script>
            alert('por favor preencha todos os campos!');
            location.href='cadastro.php';
        </script>
<?php };

  $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
  $sexo = mysqli_real_escape_string($conexao, trim($_POST['sexo']));
 $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$imagem = $_FILES['foto'];
   $cel = $_POST['cel'];
 $senha = mysqli_real_escape_string($conexao, trim(sha1($_POST['senha'])));

    $sql = "SELECT COUNT(*) AS total FROM usuario WHERE email = '$email'";
 $result = mysqli_query($conexao,$sql);
 $row = mysqli_fetch_assoc($result);

 if($row['total'] ==1){
    $_SESSION['usuario_existe']=true;
      header('Location:cadastro.php');
      exit();
 }

if ($imagem["error"]==4){?>
    <script>
        alert('não envie foto em branco');
            location.href="cadastro.php";
    </script>
<?php }if ($imagem["error"]==1){?>
    <script>
        alert('O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini');//Ai teremos que alterar lá no php.ini meus camaradas, pesquisem e deem seus pulos
        location.href='cadastro.php';
    </script>
<?php }
//print_r($imagem);exit;
// Se a imagem estiver sido selecionada
if ($imagem["name"]) {
    // Largura máxima em pixels
    $largura = 2000;
    // Altura máxima em pixels
    $altura = 3000;
    // Tamanho máximo do arquivo em bytes
    $tamanho = 1000000; // coloquei 1 megabyte
    // Verifica se o arquivo é uma imagem através de uma função nativa do PHP preg_match, através de expressões regulares
    if(!preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext)){?>
            <script>
                alert('Ops! Isso não é uma imagem.');
                location.href='cadastro.php';
            </script>
        <?php
    }

    // Pega as dimensões da imagem, criando um novo vetor através da função nativa getimagesize
    $dimensoes = getimagesize($imagem["tmp_name"]);
    //print_r($dimensoes);exit;
    //echo $dimensoes[0];exit;
    // Verifica se a largura da imagem é maior que a largura permitida
    if($dimensoes[0] > $largura) {?>
        <script>
            alert("A largura da imagem não deve ultrapassar".<?php$largura?>."pixels");
            location.href='cadastro.php';
        </script>

    <?php}

    // Verifica se a altura da imagem é maior que a altura permitida
    if($dimensoes[1] > $altura) {?>
        <script>
            alert("Altura da imagem não deve ultrapassar ".<?php$altura?>." pixels");
            location.href="cadastro.php";
        </script>
    <?php}

    // Verifica se o tamanho da imagem é maior que o tamanho permitido
    if($imagem["size"] > $tamanho) {?>
        <script>
            alert("A imagem deve ter no máximo ".<?php$tamanho?>." bytes");
        </script>
    <?php }else {

        // Pega extensão da imagem
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);

        // Gera um nome único para a imagem, esse nome será criptografado em md5 (assim como poderia ser em sha1, preferi md5 porque não requer tanta segurança e o número de caracteres é menor que sha1), juntamente com o milesegundos que estou upando a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        // Caminho de onde ficará a imagem
        $caminho = "img_usuarios/" .$nome_imagem;

        // Faz o upload da imagem para seu respectivo caminho
        move_uploaded_file($imagem["tmp_name"], $caminho);

        // Insere os dados no banco de dados
        $query = "INSERT INTO usuario (nome,sexo,email,foto,cel,senha,flag,moderuser) VALUES ('$nome','$sexo','$email','$nome_imagem','$cel','$senha',1,1)";
        $upa = mysqli_query($conexao,$query);

        // Se os dados forem inseridos com sucesso, retorna essa mensagem
        if ($upa){?>
            <script>
                alert('Cadastrado com Sucesso!!');
                location.href='login.php';//e redireciono o usuario para a pagina inicial, se quiserem mandar pra listagem fiquem a vontade
            </script>
        <?php
        }else{?>
            <script>
                alert('pfv preencha os campos corretamente!');
                location.href='cadastro.php';
            </script>
            <?php
        }
    }
}
echo $nome;
?>
