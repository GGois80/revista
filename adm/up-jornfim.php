<head>
    <meta charset="utf-8"/>
</head>
<?php
    include_once ('../conexao.php');
    session_start();

     $escolha = $_POST['escolha'];
          $id = $_POST['id'];

    switch ($escolha) {
        case 'editar':
                  $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
                  $sexo = mysqli_real_escape_string($conexao, trim($_POST['sexo']));
                 $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
                   $cel = mysqli_real_escape_string($conexao, trim($_POST['cel']));
                $imagem = $_FILES['foto'];
                $vsenha = mysqli_real_escape_string($conexao, trim($_POST['vsenha']));
                 $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
               $escolha = $_POST['escolha'];
                    $id = $_POST['id'];

                    if(empty($nome) || empty($sexo) || empty($email) || empty($vsenha) || empty($senha)) {?>
                        <script>
                            alert('por favor preencha todos os campos!');
                            location.href='gerenciar.php';
                        </script>
                    <?php exit();
                    }; if($vsenha != $senha){ ?>
                        <script>
                            alert("Repita a senha Novamente do jornalista <?php echo $nome;?>!");
                                location.href='gerenciar.php';
                        </script>
                  <?php
                   exit();
                };/*Verificção de email*/

                          $sql = "SELECT COUNT(*) AS email FROM usuario WHERE email = '$email'";
                        $query = mysqli_query($conexao,$sql);
                          $row = mysqli_fetch_assoc($query);

                          if($row['email'] == 1){ ?>
                              <script>
                                  alert("Esse E-mail já existe,ensira outro para o jornalista <?php echo $nome;?>");
                                    location.href="gerenciar.php";
                              </script>
                    <?php       exit();
                            };

                                if ($imagem["error"]==4){?>
                                    <script>
                                        alert('não envie foto em branco, no jornalista <?php echo $nome;?>');
                                            location.href="gerenciar.php";
                                    </script>
                              <?php exit();
                              } if ($imagem["error"]==1){?>
                                      <script>
                                          alert('O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini');//Ai teremos que alterar lá no php.ini meus camaradas, pesquisem e deem seus pulos
                                            location.href='cad-jorn.php';
                                      </script>
                            <?php exit();
                                  }
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
                                            alert('Ops! Isso não é uma imagem no jornalista <?php echo $nome;?>');
                                            location.href='gerenciar.php';
                                        </script>
                                    <?php exit();
                                }

                                // Pega as dimensões da imagem, criando um novo vetor através da função nativa getimagesize
                                $dimensoes = getimagesize($imagem["tmp_name"]);
                                //print_r($dimensoes);exit;
                                //echo $dimensoes[0];exit;
                                // Verifica se a largura da imagem é maior que a largura permitida
                                if($dimensoes[0] > $largura) {?>
                                    <script>
                                        alert("A largura da imagem não deve ultrapassar".<?php$largura?>."pixels no jornalista <?php echo $nome;?>");
                                        location.href='gerenciar.php';
                                    </script>

                                <?php exit();}

                                // Verifica se a altura da imagem é maior que a altura permitida
                                if($dimensoes[1] > $altura) {?>
                                    <script>
                                        alert("Altura da imagem não deve ultrapassar ".<?php$altura?>." pixels no jornalista <?php echo $nome;?>");
                                        location.href="gerenciar.php";
                                    </script>
                                <?php exit();}

                                // Verifica se o tamanho da imagem é maior que o tamanho permitido
                                if($imagem["size"] > $tamanho) {?>
                                    <script>
                                        alert("A imagem deve ter no máximo ".<?php$tamanho?>." bytes no jornalista <?php echo $nome;?>");
                                          location.href="gerenciar.php";
                                    </script>
                                <?php exit();
                                } else {

                                    // Pega extensão da imagem
                                    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);

                                    // Gera um nome único para a imagem, esse nome será criptografado em md5 (assim como poderia ser em sha1, preferi md5 porque não requer tanta segurança e o número de caracteres é menor que sha1), juntamente com o milesegundos que estou upando a imagem
                                    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                                    // Caminho de onde ficará a imagem
                                    $caminho = "../jornalista/img/" .$nome_imagem;

                                    // Faz o upload da imagem para seu respectivo caminho
                                    move_uploaded_file($imagem["tmp_name"], $caminho);

                                    // Insere os dados no banco de dados
                                    $query = "UPDATE  usuario SET nome='$nome',sexo='$sexo',email='$email',foto='$nome_imagem',cel='$cel',senha=sha1('$senha'),flag=1,moderuser=1 WHERE id_usuario = $id";
                                    $upa = mysqli_query($conexao,$query);

                                    // Se os dados forem inseridos com sucesso, retorna essa mensagem
                                    if ($upa){ ?>
                                        <script>
                                            alert('Alterado Com Sucesso!!');
                                            location.href='gerenciar.php';//e redireciono o usuario para a pagina inicial, se quiserem mandar pra listagem fiquem a vontade
                                        </script>
                                    <?php exit();
                                      } else{?>
                                            <script>
                                                alert('Erro ao cadastrar usuario');
                                                location.href='gerenciar.php';
                                            </script>
                                        <?php exit();
                                    }
                                }
                            };
            break;

        case 'bloquear':

                //$sql = "DELETE FROM usuario WHERE id_usuario = $id";
                $sql = "UPDATE usuario SET moderuser = 2 WHERE id_usuario = $id";
              $query = mysqli_query($conexao,$sql);

              if($query = 1){
                echo "<script>
                          alert('Usuario Bloqueado com sucesso!');
                            location.href='gerenciar.php';
                      </script>";
                  exit();
                }else{
                  echo "<script>
                            alert('deu ruim');
                              location.href='gerenciar.php';
                        </script>";
                   exit();
                };
            break;
        case 'ativar':
            $sql = "UPDATE usuario SET moderuser = 1 WHERE id_usuario = $id";
            $query= mysqli_query($conexao,$sql);
            if ($query == 1) { ?>
                <script>
                    alert('Ativado Com sucesso!!');
                    location.href='gerenciar.php';//e redireciono o usuario para a pagina inicial, se quiserem mandar pra listagem fiquem a vontade
                </script>
            <?php exit();
              } else { ?>
                    <script>
                        alert('Erro ao ativar');
                        location.href='gerenciar.php';
                    </script>
                <?php exit();
            }
        break;
    }

    //print_r($_POST);


?>
