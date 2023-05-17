<?php
include("includes/config.php");
include("includes/classes/Todo.class.php");

// Initialize the Todo object
$todo = new Todo();

// Add a new task to the list
if (!empty($_POST['task'])) {
    $task = $_POST['task'];
    $todo->addTask($task); // Use the addTask method of Todo object
    $tasks = $todo->getTasks(); // Get updated tasks array from Todo object
    $jsonTasks = json_encode($tasks);
    file_put_contents('todo.json', $jsonTasks);
}

// Retrieve the tasks from the JSON file
$jsonArr = file_get_contents('todo.json');
$tasks = json_decode($jsonArr, true);

// Check if the form is submitted for deleting a task
if (isset($_POST['deleteTask'])) {
    $index = $_POST['deleteTask'];

    if (isset($tasks[$index])) {
        unset($tasks[$index]);
        $jsonTasks = jsaon_encode($tasks);
        file_put_contents('todo.json', $jsonTasks);
    }
}

include("index.php");
?>

