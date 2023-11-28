<?php
require_once 'config/conexao.php';
session_start();
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";

    $result = $conexao->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['tipo'] = $user['tipo'];

        if ($user['tipo'] == 'admin') {
            // QUERY PARA SELECIONAR na tabele admin guardar na sessao o id
        } else if ($user['tipo'] == 'medico') {
            // QUERY PARA SELECIONAR na tabele medico guardar na sessao o id
        } else {
            // QUERY PARA SELECIONAR na tabele paciente guardar na sessao o id
        }

        switch ($user['tipo']) {

            case 'admin':

                $response['redirect'] = 'admin/dashboard_admin.php';
                break;
            case 'medico':
                $response['redirect'] = 'medico/dashboard_medico.php';
                break;
            case 'paciente':
                $response['redirect'] = 'paciente/dashboard_paciente.php';
                break;
            default:
                $response['error'] = "Tipo de usuário desconhecido";
                break;
        }
    } else {
        $response['error'] = "Email ou senha incorretos";
    }
} else {
    $response['error'] = "Método de requisição inválido";
}

header('Content-Type: application/json');
echo json_encode($response);
exit;
