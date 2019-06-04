<h1>User: Edit</h1>

<?php
// echo '<pre>';
print_r($this->user);
?>


<form method="post" action="<?php echo URL; ?>user/editSave/<?php echo $this->user['id']; ?>">
    <label for="login">Login</label><input type="text" name="login" value="<?php echo $this->user['login']; ?>"><br>
    <label for="password">Password</label><input type="text" name="password" value="<?php echo $this->user['password']; ?>"><br> <!--  This is a problem. Unless the password is changed every time, the password will be rewritten each time. -->
    <label for="role">Role</label>
    <select name="role">
        <option value="default" <?php if ($this->user['role'] == 'default') {
                                    echo 'selected';
                                } ?>>Default</option>
        <option value="admin" <?php if ($this->user['role'] == 'admin') {
                                    echo 'selected';
                                } ?>>Admin</option>
        <option value="owner" <?php if ($this->user['role'] == 'owner') {
                                    echo 'selected';
                                } ?>>Owner</option>
    </select><br>
    <label for="submit"></label>
    <input type="submit" name="submit" />
</form>