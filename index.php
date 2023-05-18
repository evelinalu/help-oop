<?php
include("includes/header.php");
include("includes/config.php");
include("includes/classes/Todo.class.php");

// Check if the JSON file exists
if (file_exists('todolist.json')) {
    // Read the JSON file and decode it into an array
    $jsonTasks = file_get_contents('todolist.json');
    $tasks = json_decode($jsonTasks, true);
} else {
    $tasks = array();
}

$todo = new Todo($tasks);

if (!empty($_POST['task'])) {
    $task = $_POST['task'];
    $todo->addTask($task); // Use the addTask method of Todo object
    $tasks = $todo->getTasks(); // Get updated tasks array from Todo object
    $jsonTasks = json_encode($tasks);
    file_put_contents('todolist.json', $jsonTasks);

    // Clear the input field after submitting the form
    $_POST['task'] = '';
}

if (isset($_POST['deleteTask'])) {
    $index = $_POST['deleteTask'];
    $todo->deleteTask($index); // Use the deleteTask method of Todo object
    $tasks = $todo->getTasks(); // Get updated tasks array from Todo object
    $jsonTasks = json_encode($tasks);
    file_put_contents('todolist.json', $jsonTasks);
}


if (isset($_POST['deleteAll'])) {
    $todo->deleteAll(); // Use the deleteAll method of Todo object
    $tasks = $todo->getTasks(); // Get updated tasks array from Todo object
    
    $jsonTasks = json_encode($tasks);
    file_put_contents('todolist.json', $jsonTasks);
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
    
        <ul>
            <?php 
            foreach ($todo->getTasks() as $index => $task) {
                ?>
                <form method="post" action="index.php">
                    <input type="hidden" name="deleteTask" value="<?php echo $index; ?>">
                    <button type="submit" class="deleteTask" onclick="return confirm('Är du säker på att du vill radera denna aktivitet?')">x</button>
                    <?php echo $task; ?>
                    <br>
                </form>
                <?php
            }
            ?>
        </ul>

        <form method="post" action="index.php">
            <button type="submit" class="deleteAll" name="deleteAll" onclick="return confirm('Är du säker på att du vill rensa hela listan?')">Rensa listan</button>
        </form>
    
</main>

<?php include("includes/footer.php"); 

//?>