<?php
$root_path = "../../../";
require_once($root_path."classes/SemanaCardapio.class.php");
require_once($root_path."classes/SemanaCardapioDao.class.php");

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

if ($acao == 'CriarCardapio') {
  $data = $_POST['data_inicio'];

  if (date("w", strtotime($data)) != 1) { // se a data não é segunda
    header("location:index.php?erro=inicio_deve_ser_segunda");

  } else if (SemanaCardapioDao::SemanaExiste($data)) {
    header("location:index.php?erro=semana_ja_existe");

  } else {
    $cardapio = new SemanaCardapio;
    $cardapio->setData_inicio($data);

    SemanaCardapioDao::Inserir($cardapio);
    $cod = SemanaCardapioDao::SelectUltimoCod();
    header("location:" . $root_path . "funcionario/cardapio/gerenciar/?cod=" . $cod);
  }
}
?>