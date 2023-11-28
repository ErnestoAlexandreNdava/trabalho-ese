 <?php
session_start();

switch ($_SESSION['tipo']) {
    case 'admin':
        header('Location: admin/dashboard_admin.php');
        exit;
    case 'chef':
        header('Location: gestor/dashboard_chef.php');
        exit;
    case 'cliente':
        header('Location: cliente/dashboard_cliente.php');
        exit;
    default:
        header('Location: login.php');
        exit;
}
?>





