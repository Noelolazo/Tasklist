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
require_once("com/utils/user/clsUser.php");
require_once("com/utils/user/clsParticipant.php");

$connection = new connConnection("localhost", "TASKMANAGER", "taskm8", "taskm8");
$connObject = $connection->getConn();
$dbCommand = new DBCommand($connObject);
$userManager = new UserManager($dbCommand);

$user = $userManager->login("noel@loquesea.com", 12345);
$connection = new clsConnection($user);

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
$tasklist = new clsTaskList();
var_dump($tasklist);

// $dbCommand->execute($sql);

// phpinfo();
?>