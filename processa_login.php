<?php
require_once 'config/conexao.php';
session_start();
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM usuarios WHERE email=? AND senha=?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['tipo'] = $user['tipo'];

        switch ($user['tipo']) {
            case 'admin':
                $response['redirect'] = 'admin/dashboard_admin.php';
                break;
            case 'medico':
                // Retrieve additional information from the 'medicos' table
                $medicoQuery = "SELECT * FROM medicos WHERE usuario_id = ?";
                $medicoStmt = $conexao->prepare($medicoQuery);
                $medicoStmt->bind_param("i", $user['id']);
                $medicoStmt->execute();
                $medicoResult = $medicoStmt->get_result();

                if ($medicoResult->num_rows == 1) {
                    $medico = $medicoResult->fetch_assoc();
                    $_SESSION['medico_id'] = $medico['id'];
                }

                $response['redirect'] = 'medico/dashboard_medico.php';
                break;
            case 'paciente':
                // Retrieve additional information from the 'pacientes' table
                $pacienteQuery = "SELECT * FROM pacientes WHERE usuario_id = ?";
                $pacienteStmt = $conexao->prepare($pacienteQuery);
                $pacienteStmt->bind_param("i", $user['id']);
                $pacienteStmt->execute();
                $pacienteResult = $pacienteStmt->get_result();

                if ($pacienteResult->num_rows == 1) {
                    $paciente = $pacienteResult->fetch_assoc();
                    $_SESSION['paciente_id'] = $paciente['id'];
                }

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
?>
