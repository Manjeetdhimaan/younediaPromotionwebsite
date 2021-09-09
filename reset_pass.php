<?php
if ($_GET['key'] && $_GET['reset'])
{
    $email = $_GET['key'];
    $pass = $_GET['reset'];

    $conn = new mysqli('localhost', 'webdes57_prom', 'Prom99!!', 'webdes57_prom');
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT username, password FROM users WHERE username='" . $email . "' and password='" . $pass . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
?>
    <form method="post" action="submit_new.php">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <p>Enter New password</p>
    <input type="password" name='password'>
    <input type="submit" name="submit_password">
    </form>
    <?php
    }
}
?>