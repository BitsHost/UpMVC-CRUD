<?php
namespace MyApp\Views;

class UserView extends BaseView
{
    public function renderCreateForm($appUrl)
    {
        echo '<div class="container">';
        echo '<h2>Create User</h2>';
        echo '<form method="post" action="' . $appUrl . './">';
        echo '<input type="hidden" name="action" value="create">';
        echo '<label for="name">Name:</label>';
        echo '<input type="text" name="name" required>';
        echo '<br>';
        echo '<label for="email">Email:</label>';
        echo '<input type="email" name="email" required>';
        echo '<br>';
        echo '<input type="submit" value="Create User">';
        echo '</form>';
        echo '</div>';
    }

    //without Pagination links
    public function renderReadTableOld($users, $appUrl)
    {
        echo '<div class="container">';
        echo '<h2>Read Users</h2>';
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Email</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        foreach ($users as $user) {
            echo '<tr>';
            echo '<td>' . $user['id'] . '</td>';
            echo '<td>' . $user['name'] . '</td>';
            echo '<td>' . $user['email'] . '</td>';
            echo '<td>';
            echo '<a href=" ' . $appUrl . '/?action=update&id=' . $user['id'] . '">Update</a> | ';
            echo '<a href="' . $appUrl . '/?action=delete&id=' . $user['id'] . '" class="delete-link" onclick="return confirmDeletion()">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    }


    public function renderReadTable($users, $currentPage, $totalPages, $appUrl)
    {
        echo '<div class="container">';
        echo '<h2>Read Users</h2>';
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Email</th>';
        echo '<th>Action</th>';
        echo '<th>Action</th>';
        echo '<th>Action</th>';
        echo '</tr>';

        foreach ($users as $user) {
            echo '<tr>';
            echo '<td>' . $user['id'] . '</td>';
            echo '<td>' . $user['name'] . '</td>';
            echo '<td>' . $user['email'] . '</td>';
            echo '<td>';
            echo '<a href=" ' . $appUrl . '/?action=update&id=' . $user['id'] . '">Update</a>';
            echo '</td>';
            echo '<td>';
            echo '<a href="' . $appUrl . '/?action=delete&id=' . $user['id'] . '" class="delete-link" onclick="return confirmDeletion()">Delete</a>';
            echo '</td>';
            echo '<td>';
            echo '<a href="' . $appUrl . '/?action=form">Create</a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';

        // Pagination links
        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="' . $appUrl . '/?action=read&page=' . $i . '" ';
            if ($i == $currentPage) {
                echo 'class="active"';
            }
            echo '>' . $i . '</a>';
        }
        echo '</div>';
        echo '</div>';
    }


    public function renderUpdateForm($user, $appUrl)
    {
        echo '<div class="container">';
        echo '<h2>Update User</h2>';
        echo '<form method="post" action="' . $appUrl . '/">';
        echo '<input type="hidden" name="action" value="update">';
        echo '<input type="hidden" name="id" value="' . $user['id'] . '">';
        echo '<label for="name">Name:</label>';
        echo '<input type="text" name="name" value="' . $user['name'] . '" required>';
        echo '<br>';
        echo '<label for="email">Email:</label>';
        echo '<input type="email" name="email" value="' . $user['email'] . '" required>';
        echo '<br>';
        echo '<input type="submit" value="Update User">';
        echo '</form>';
        echo '</div>';
    }
}
