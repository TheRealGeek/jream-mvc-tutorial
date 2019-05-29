<?php echo md5("Michael");
        echo "</br>The password should be 'Michael'";?>
<h1>Login</h1>
<script type="text/javascript">console.log("login file is loading")</script>
<form action="login/run" method="post"> <!-- This calls a function called run() in the login model -->

    <label for="login">Login</label>
    <input type="text" name="login"> <br>
    <label for="password">Password</label>
    <input type="password" name="password" id=""><br>
    <label for="submit"></label> <input type="submit" value="Submit">

</form>