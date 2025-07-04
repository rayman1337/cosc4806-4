<?php

class Notes extends Controller {
    private $noteModel;

    public function __construct() {
        $this->noteModel = $this->model('Note');
    }

    public function index() {
        session_start();
        if (!isset($_SESSION['user_id'])) header('Location: /login');
        $notes = $this->noteModel->getAllByUser($_SESSION['user_id']);
        $this->view('notes/index', ['notes' => $notes]);
    }



    public function create() {
        session_start();
        if (!isset($_SESSION['user_id'])) header('Location: /login');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->noteModel->createNote($_SESSION['user_id'], $_POST['subject']);
            header('Location: /notes/index');
        } else {
            $this->view('notes/create');
        }
    }

    public function edit($id) {
        session_start();
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
        session_start();
        if (!isset($_SESSION['user_id'])) header('Location: /login');

        $this->noteModel->deleteNote($id);
        header('Location: /notes/index');
    }
}
