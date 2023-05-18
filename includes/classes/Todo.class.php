<?php

//klass Todo
class Todo {
    // Properties
    private $tasks = array();

    // Metod för att lägga till en task till array
    public function addTask($task) {
        if (!empty($task)) {
            $this->tasks[] = $task;
            return true;
        }
        return false;
    }

    // getter metod
    public function getTasks() {
        return $this->tasks;
    }


    // Metod för att ta bort en task
    public function deleteTask($index) {
        if (isset($this->tasks[$index])) {
            unset($this->tasks[$index]);
            return true;
        }
        return false;
    }
}


?>
