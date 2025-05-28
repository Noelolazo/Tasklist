<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(SECURITY_PATH . "clsUserManager.php");
require_once(SECURITY_PATH . "clsConnection.php");
require_once(TASKMANAGER_PATH . "task/clsTask.php");
require_once(TASKMANAGER_PATH . "list/clsList.php");
require_once(TASKMANAGER_PATH . "tasklist/clsTaskList.php");
require_once(DBO_PATH . "daoCommand.php");
require_once(DBO_PATH . "daoConnection.php");
require_once(USER_PATH . "clsUser.php");
require_once(USER_PATH . "clsParticipant.php");
require_once(EMAIL_PATH . "mail_sender.php");

session_start();

// Connection SQL
$connServer = new connConnection("localhost", "TASKMANAGER", "taskm8", "taskm8");
$connObject = $connServer->getConn();

// Create an dbCommand instance with the connection
$dbCommand = new DBCommand($connObject);

// Crear instancias de los gestores de usuario y base de datos
$userManager = new clsUserManager($dbCommand);
// $dbManager = new DBManager($dbCommand);

$action = isset($_GET['action']) ? $_GET['action'] : '';

if (empty($action)) {
    echo "Action not specified.";
} else {
    switch ($action) {
        case "signUp":
            if (!isset($_GET['phone_number'])) {
                $_GET['phone_number'] = NULL;
            }
            $user = $userManager->register($_GET['name'], $_GET['email'], $_GET['passwd'], $_GET['phone_number']);
            if (!is_null($user)) {
                $connection = new clsConnection($user);
                if ($connection->isConnected()) {
                    setcookie('connection', serialize($connection), time() + 604800, '/');
                    echo "Sign Up successful.";
                }
                // echo $connection->getAll();
                // var_dump(unserialize($_COOKIE['connection']));
            }
            // else {
            // echo "Something went wrong, please try again.";
            // }
            break;
        case "login":
            if (!isset($_COOKIE['connection'])) {
                $user = $userManager->login($_GET['email'], $_GET['passwd']);
                if (!is_null($user)) {
                    $connection = new clsConnection($user);
                    setcookie('connection', serialize($connection), time() + 604800, '/');
                    // echo "Login successful.";
                }
            } else {
                echo "An user is already connected.";
            }

            // echo "<br>";
            // var_dump(unserialize($_COOKIE['connection']));
            break;
        case "logout":
            // unset($_COOKIE['connection']);
            if (isset($_COOKIE['connection'])) {
                $connection = unserialize($_COOKIE['connection']);
                if ($connection->isConnected()) {
                    $result = $connection->discConnection();
                    if ($result) {
                        setcookie('connection', '', time() - 3600, '/');
                        echo "Logout successful.";
                    }
                } else {
                    echo "User already disconnected";
                }
            } else {
                echo "No user connected.";
            }
            break;
        case "recoverypassEmail":
            $userManager->recoverPassword($_GET['email']);
            break;
        case "recoverypassPIN":
            $userManager->recoverPasswordPin($_GET['email'], $_GET['pin'], $_GET['passwd']);
            break;
        case "changepass":
            $userManager->changePassword($_GET['email'], $_GET['passwd'], $_GET['newpasswd']);
            break;
        case "newlist":
            $connection = unserialize($_COOKIE['connection']);
            $tasklist = new clsTaskList();
            $task = new clsTask($_GET['ttitle'], $_GET['tdeadline'], $_GET['tdescription'], $_GET['tlocation']);
            $list = new clsList($_GET['ltitle'], $_GET['ldescription'], [$task], $_GET['lparticipants']);
            $tasklist->add($list);
            $tasklist->save();
            // var_dump($tasklist);

            break;
        // case "newtask":
        //     if (!isset($_GET['description'])) {
        //         $_GET['description'] = NULL;
        //     }
        //     if (isset($_COOKIE['connection'])) {
        //         $connection = unserialize($_COOKIE['connection']);
        //         $tasklist = new clsTaskList();
        //         $task = new clsTask($_GET['ttitle'], $_GET['date'], $_GET['tdescription'], $_GET['location']);
        //         $list = new clsList($_GET['ltitle'], $_GET['ldescription'], [$task], $_GET['participants']);
        //         $tasklist->add($list);
        //         $tasklist->save();
        //         var_dump($tasklist);
        //     } else {
        //         echo 'You need to sign in first.';
        //     }
        //     break;
        case "invite_user":
            if (isset($_COOKIE['connection'])) {
                $connection = unserialize($_COOKIE['connection']);
                $tasklist = new clsTaskList();
                $task = new clsTask($_GET['ttitle'], $_GET['date'], $_GET['tdescription'], $_GET['location']);
                $list = new clsList($_GET['ltitle'], $_GET['ldescription'], [$task], $_GET['participants']);
                $tasklist->add($list);
                $tasklist->save();
                // var_dump($tasklist);
            } else {
                echo 'You need to sign in first.';
            }
            break;
        case "printTaskList":
            if (isset($_COOKIE['connection'])) {
                $connection = unserialize($_COOKIE['connection']);
                $tasklist = new clsTaskList(true);
                $tasklist->to_XML();
            }
            break;
        case "myProfile":
            if (isset($_COOKIE["connection"])) {
                $connection = unserialize($_COOKIE["connection"]);
                $connection->getUserData();
            }
            break;
        default:
            echo "Invalid action.";
            break;
    }
}

?>