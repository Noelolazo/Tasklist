<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(SECURITY_PATH."clsUserManager.php");
require_once(SECURITY_PATH."clsConnection.php");
require_once(TASKMANAGER_PATH."task/clsTask.php");
require_once(TASKMANAGER_PATH."list/clsList.php");
require_once(TASKMANAGER_PATH."tasklist/clsTaskList.php");
require_once(DBO_PATH."daoCommand.php");
require_once(DBO_PATH."daoConnection.php");
require_once(USER_PATH."clsUser.php");
require_once(USER_PATH."clsParticipant.php");
require_once(EMAIL_PATH."mail_sender.php");

$connection = new connConnection("localhost", "TASKMANAGER", "taskm8", "taskm8");
$connObject = $connection->getConn();
$dbCommand = new DBCommand($connObject);
$userManager = new clsUserManager($dbCommand);

// $user = $userManager->login("noel@loquesea.com", 12345);
// $connection = new clsConnection($user);
$email = $_GET["email"];
$userManager->emailSend($email);
// $sql = "INSERT INTO usuarios (nombre)
// VALUES ('Tony')";
// $sql = "SELECT l.List_ID, l.Title, l.Description
// FROM List l
// JOIN List_User_Access lua ON l.List_ID = lua.List_ID
// WHERE lua.User_ID = 2 AND lua.Status = 'active'";
// $result = $dbCommand->execute($sql);
// foreach ($result as $row) {
//     var_dump($row);
// }
// $tasklist = new clsTaskList();
// var_dump($tasklist);

// $dbCommand->execute($sql);

// phpinfo();
?>