<?php
/*
 *   Copyright (c) 2023 BitsHost
 *   All rights reserved.

 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *   of this software and associated documentation files (the "Software"), to deal
 *   in the Software without restriction, including without limitation the rights
 *   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *   copies of the Software, and to permit persons to whom the Software is
 *   furnished to do so, subject to the following conditions:

 *   The above copyright notice and this permission notice shall be included in all
 *   copies or substantial portions of the Software.

 *   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *   IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *   AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *   LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *   OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *   SOFTWARE.
 */

namespace MyApp\Controllers;

use MyApp\Models\UserModel;
use MyApp\Views\UserView;
use MyApp\Config\Conf;

class UserController extends BaseController
{
    private $model;

    public function __construct(UserModel $model, UserView $view)
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
