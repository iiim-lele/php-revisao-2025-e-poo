<!-- Este arquivo será o responsável por: (Arquivo principal de controle) -->

<?php
session_start();

// Carrega os arquivos necessários
require_once 'config/database.php';
require_once 'services/Auth.php';
require_once 'controllers/AuthController.php';

// Instancia o controlador de autenticação
$authController = new AuthController();

// Define a ação padrão
$pagina = $_GET['pagina'] ?? '';

// Roteamento básico para testar autentificação
switch ($pagina) {
    case 'login':
        $authController->login();
        break;
    case 'autentificar':
        $authController->autenticar();
        break;
    case 'logout':
        $authController->logout();
        break;
    default:
        if (Auth::estaLogado()) {
            echo "Login bem-sucedido! Bem-vindo, ". Auth::obterUsuario()['nome'];
            echo "<br><a href='index.php?pagina=logout'>Sair</a>";
        } else {
            header('Location: index.php?pagina=login');
            exit;
        }
        break;
}