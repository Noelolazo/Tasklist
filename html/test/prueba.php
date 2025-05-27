<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// require_once("com/taskmanager/task/clsTask.php");
// require_once("com/taskmanager/list/clsList.php");
// require_once("com/taskmanager/tasklist/clsTaskList.php");

// $tasklist = new clsTasklist();
// $task = new clsTask(1, "COMER", "14PM");
// $list = new clsList(1, "Lista basica", "basico test", [$task]);

// $tasklist->add($list);

// $listas = $tasklist->get();

// var_dump($listas);

$passwd = password_hash("Buenas", PASSWORD_BCRYPT);
echo $passwd;
echo "<br>";
if (password_verify("Buenas", $passwd)) {
    echo "SI QUE FUNCIONA";
}
?>