<h1>User</h1>

<form action="<?php echo URL; ?>user/create" method="post">
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
        <?php
        foreach ($this->userList as $key => $value) {
             echo '<tr>'; //table row
            echo '<td>' . $value['id'] . '</td>';
            echo '<td>' . $value['login'] . '</td>';
            echo '<td>' . $value['role'] . '</td>';
            echo '<td>
                    <a href="' . URL . 'user/edit/' . $value['id'] . '">Edit</a>&nbsp;
                    <a href="' . URL . 'user/delete/' . $value['id'] . '">Delete</a>' .  '</td>';
            echo '</tr>';
        }
        // print_r($this->userList);
        ?>
    </tr>
</table>