<?php
namespace MyApp\Controllers;

use MyApp\Models\UserModel;
use MyApp\Views\CrudView;
use MyApp\Config\Conf;

class CrudController extends BaseController
{
    private $model;

    public function __construct(UserModel $model, CrudView $view)
    {
        parent::__construct($view);
        $this->model = $model;
    }

    public function handleRequest()
    {
        $conf   = new Conf();
        $appUrl = $conf->appUrl();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

            switch ($action) {
                case 'create':
                    $this->create($appUrl);
                    break;
                case 'update':
                    $this->update($appUrl);
                    break;
            }
        }
        else {
            $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

            switch ($action) {
                case 'read':
                    $this->read($appUrl);
                    break;
                case 'update':
                    $this->renderUpdateForm($appUrl);
                    break;
                case 'delete':
                    $this->delete($appUrl);
                    break;
                case 'create':
                    $this->create($appUrl);
                    break;
                case 'form':
                    $this->createForm($appUrl);
                    break;
                default:
                    $this->read($appUrl);
                    break;
            }
        }
    }

    private function create($appUrl)
    {
        $name  = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if ($name && $email) {
            $this->model->addUser($name, $email);
            header('Location: ' . $appUrl . '/?action=read');
        }
        else {
            // Handle invalid input
            echo "Invalid input. Please provide a valid name and email.";
        }
    }

    //Without Pagination links
    private function readOld($appUrl)
    {
        $users = $this->model->getUsers();
        $this->view->renderReadTable($users, $appUrl);
        $this->view->renderCreateForm($appUrl);
    }


    private function read($appUrl)
    {
        $page         = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT) ?: 1;
        $itemsPerPage = 5; // Adjust this value based on your preference

        $totalUsers = count($this->model->getUsers());
        $totalPages = ceil($totalUsers / $itemsPerPage);

        $offset = ($page - 1) * $itemsPerPage;
        $users  = $this->model->getUsersWithLimit($offset, $itemsPerPage);

        $this->view->renderReadTable($users, $page, $totalPages, $appUrl);
    }



    private function renderUpdateForm($appUrl)
    {
        $id   = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $user = $this->model->getUserById($id);

        if ($user) {
            $this->view->renderUpdateForm($user, $appUrl);
        }
        else {
            echo "User not found.";
        }
    }

    private function update($appUrl)
    {
        $id    = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $name  = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if ($id && $name && $email) {
            $this->model->updateUser($id, $name, $email);
            header('Location: ' . $appUrl . '/?action=read');
        }
        else {
            // Handle invalid input
            echo "Invalid input. Please provide a valid ID, name, and email.";
        }
    }

    private function delete($appUrl)
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        if ($id) {
            $this->model->deleteUser($id);
            header('Location: ' . $appUrl . '/?action=read');
        }
        else {
            echo "Invalid ID.";
        }
    }

    private function createForm($appUrl)
    {
        $this->view->renderCreateForm($appUrl);
    }
}
