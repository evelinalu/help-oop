<?php
session_start();

include("includes/header.php");
include("includes/config.php");
include("includes/classes/Todo.class.php");

// Initialize the Todo object
$todo = new Todo();

// Check if the JSON file exists
if (file_exists('todo.json')) {
    // Read the JSON file and decode it into an array
    $jsonTasks = file_get_contents('todo.json');
    $tasks = json_decode($jsonTasks, true);
} else {
    $tasks = array();
}

if (!empty($_POST['task'])) {
    $task = $_POST['task'];
    $todo->addTask($task); // Use the addTask method of Todo object
    $tasks = $todo->getTasks(); // Get updated tasks array from Todo object
    $jsonTasks = json_encode($tasks);
    file_put_contents('todo.json', $jsonTasks);

    // Clear the input field after submitting the form
    $_POST['task'] = '';
}

if (isset($_POST['deleteTask'])) {
    $index = $_POST['deleteTask'];

    $todo->deleteTask($index); // Use the deleteTask method of Todo object
    $tasks = $todo->getTasks(); // Get updated tasks array from Todo object
    $jsonTasks = json_encode($tasks);
    file_put_contents('todo.json', $jsonTasks);
}
?>

<main>
    <h2>To-do</h2>

    <form action="index.php" method="post">
        <label for="task">Att göra:</label>
        <br>
        <input type="text" name="task" id="task">
        <br>
        <input class="btn" type="submit" name="addTask" value="Lägg till">
        <br>
    </form>

    <h3>Lista:</h3>
    <div id="todolist">
        <ul>
            <?php 
            foreach ($tasks as $index => $task) {
                ?>
                <form method="post" action="index.php">
                    <input type="hidden" name="deleteTask" value="<?php echo $index; ?>">
                    <button type="submit" class="deleteTask" onclick="return confirm('Are you sure you want to delete this task?')">x</button>
                    <?php echo $task; ?>
                    <br>
                </form>
                <?php
            }
            ?>
        </ul>
    </div>
</main>

<?php include("includes/footer.php"); ?>
