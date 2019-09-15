<?php
$root_path = "../";
require_once($root_path."classes/Usuario.class.php");
require_once($root_path."classes/UsuarioDao.class.php");

if (isset($_POST['acao'])) $acao = $_POST['acao'];
else if (isset($_GET['acao'])) $acao = $_GET['acao'];
else $acao = '';

if ($acao == 'Login') {
  $usuario = new Usuario;
  $usuario->setCodigo($_POST['matricula']);
  $usuario->setSenha(sha1($_POST['senha']));;
  $login_info = UsuarioDao::Login($usuario);

  if($login_info['acao'] == 'fazer_login') {
    session_start();
    $_SESSION['matricula'] = $login_info['matricula'];
    $_SESSION['nome'] = $login_info['nome'];
    $_SESSION['tipo'] = $login_info['tipo'];
    header("location:".$root_path."aluno/cardapio");
  } else {
    header("location:".$root_path."entrar/?erro=".$login_info['acao']);
  }
}
?>