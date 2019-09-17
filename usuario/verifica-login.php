<?php
    session_start();
  if(!$_SESSION['flag'] || $_SESSION['flag'] != 1){ ?>
  <script>
      alert('Crie uma Conta!');
      location.href='../login.php';
  </script>
<?php };

?>
