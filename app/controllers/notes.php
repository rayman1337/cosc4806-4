<?php

class Notes extends Controller {
    private $noteModel;

    public function __construct() {
        $this->noteModel = $this->model('Note');
    }

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) header('Location: /login');

        echo "Entered notes index<br>";

        try {
            $notes = $this->noteModel->getAllByUser($_SESSION['user_id']);
            echo "<pre>";
            var_dump($notes);
            echo "</pre>";
        } catch (Throwable $e) {
            echo "<strong>Error:</strong> " . $e->getMessage();
        }

        exit;
    }


    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->noteModel->createNote($_SESSION['user_id'], $_POST['subject']);
            header('Location: /notes/index');
            exit;
        } else {
            $this->view('notes/create');
        }
    }



    public function edit($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) header('Location: /login');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $completed = isset($_POST['completed']) ? 1 : 0;
            $this->noteModel->updateNote($id, $_POST['subject'], $completed);
            header('Location: /notes/index');
        } else {
            $note = $this->noteModel->getById($id);
            $this->view('notes/edit', ['note' => $note]);
        }
    }

    public function delete($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) header('Location: /login');

        $this->noteModel->deleteNote($id);
        header('Location: /notes/index');
    }
}
