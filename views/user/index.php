<h1>User Owner Page</h1>
<br>
<form action="<?php echo URL; ?>user/create" method="post">
    <div><b>Create New User:</b></div><br>
    <label for="login">Login</label><input type="text" name="login" id=""><br>
    <label for="password">Password</label><input type="text" name="password" id=""><br>
    <label for="role">Role</label>
    <select name="role" id="role">
        <option value="default">Default</option>
        <option value="admin">Admin</option>
        <option value="owner">Owner</option>
    </select><br>
    <label for="submit"></label>
    <input type="submit" name="submit" />
</form>
<hr>
<table>
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>Role</th>
        <th>|</th>
        <th>Edit</th>
        <th>Delete</th>
        <?php
        foreach ($this->userList as $key => $value) {
            echo '<tr>'; //table row
            echo '<td>' . $value['id'] . '</td>';
            echo '<td>' . $value['login'] . '</td>';
            echo '<td>' . $value['role'] . '</td>';
            echo '<td> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</td>';
            if ($value['role'] === 'owner') { //custom code, it hides the delete button for owners. This is more for aesthetics than anything; the delete function is set to ignore owners
                echo '<td>
                    <a href="' . URL . 'user/edit/' . $value['id'] . '">Edit</a></td>';
            } else {
                echo '<td>
                    <a href="' . URL . 'user/edit/' . $value['id'] . '">Edit</a>&nbsp;</td>
                    <td><a href="' . URL . 'user/delete/' . $value['id'] . '">Delete</a>' .  '</td>';
            }
            echo '</tr>';
        }
        // print_r($this->userList);
        ?>
    </tr>
</table>