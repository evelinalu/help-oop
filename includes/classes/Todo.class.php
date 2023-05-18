<?php

class Todo {
    // Properties
    private $tasks = array();

    public function __construct($initialTasks) {
        $this->tasks = $initialTasks;
    }

    // Method to add a task
    public function addTask($task) {
        if (!empty($task)) {
            $this->tasks[] = $task;
            return true;
        }
        return false;
    }

    // Method to get tasks
    public function getTasks() {
        return $this->tasks;
    }

    // Method to delete a task
    public function deleteTask($index) {
        if (isset($this->tasks[$index])) {
            unset($this->tasks[$index]);
            return true;
        }
        return false;
    }

public function deleteAll() {
    array_splice($this->tasks, 0);
    return true;
}
}


?>
