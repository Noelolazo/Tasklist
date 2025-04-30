<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("com/security/clsUserManager.php");
require_once("com/security/clsConnection.php");
require_once("com/taskmanager/task/clsTask.php");
require_once("com/taskmanager/list/clsList.php");
require_once("com/taskmanager/tasklist/clsTaskList.php");
require_once("com/utils/dbo/daoCommand.php");
require_once("com/utils/dbo/daoConnection.php");
require_once("com/taskmanager/user/clsUser.php");

session_start();
                                                                                                
// Connection SQL
$connection = new connConnection("localhost", "TASKMANAGER", "taskm8", "taskm8");
$connObject = $connection->getConn();

// Create an dbCommand instance with the connection
$dbCommand = new DBCommand($connObject);

// Crear instancias de los gestores de usuario y base de datos
$userManager = new UserManager($dbCommand);
// $dbManager = new DBManager($dbCommand);

$action = isset($_GET['action']) ? $_GET['action'] : '';

if (empty($action)) {
    echo "Action not specified.";
} else {
    switch ($action) {
        case "register" :
            if (!isset($_GET['phone_number'])) {
                $_GET['phone_number'] = NULL;
            }
            $user = $userManager->register($_GET['name'], $_GET['email'], $_GET['passwd'], $_GET['phone_number']);
            // var_dump($user);
            // unset($_COOKIE['user']);
            if (!is_null($user)) {
                setcookie('user', serialize($user));
                var_dump(unserialize($_COOKIE['user']));
            }
            break;
        case "login":
            if (!isset($_COOKIE['user'])) {
                $user = $userManager->login($_GET['email'], $_GET['passwd']);
                if (!isset($_COOKIE['user'])) {
                    setcookie('user', serialize($user));
                }
            } else {
                echo "An user is already connected.";
            }

            // echo "<br>";
            // var_dump(unserialize($_COOKIE['user']));
            break;
        case "logout":
            // unset($_COOKIE['user']);
            setcookie('user', '',time() - 3600);
            if (isset($_COOKIE['user'])) {
                // var_dump($_COOKIE['user']);
                echo "Logout succesfull";
            } else {
                echo "Logout failed.";
            }
            break;
        case "changepass":
            $userManager->changePassword($_GET['email'], $_GET['passwd'], $_GET['newpasswd']);
            break;
        case "newtask":
            if (!isset($_GET['description'])) {
                $_GET['description'] = NULL;
            }
            $tasklist = new clsTaskList();
            $task = new clsTask ($_GET['ttitle'], $_GET['date'], $_GET['tdescription'], $_GET['location']);
            $list = new clsList($_GET['ltitle'], $_GET['ldescription'], [$task], $_GET['participants']);
            $tasklist->add($list);
            $tasklist->save();
            var_dump($tasklist);
            break;
        default:
            echo "Invalid action.";
            break;
    }
}

?>