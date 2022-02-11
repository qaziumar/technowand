<?php  session_start();
require_once('connection.php');

if(isset($_POST['login']) && $_POST['login'] == 'yes')
{
    $email = $_POST['email'];
    $password = MD5($_POST['password']);

    $sql = "SELECT user_id, is_admin, full_name FROM users WHERE email = '$email' AND password = '$password'";
    if ($res = mysqli_query($link, $sql)) 
    {
        if (mysqli_num_rows($res) > 0) 
        { 
            $row = mysqli_fetch_array($res);
            $_SESSION['login'] = 'yes';
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['is_admin'] = $row['is_admin'];
            $_SESSION['full_name'] = $row['full_name'];

            #echo '<pre>'; print_r($_SESSION); die();
             
            //mysqli_free_res($res);

            $_SESSION['success'] = 'Login Success';
            header('Location: index.php');
        }
        else 
        {
            $_SESSION['error'] = 'Email or password does not match';
            header('Location: login.php');
        }
    }
    else 
    {
        echo "ERROR: Could not able to execute $sql. " .mysqli_error($link);
    }
    mysqli_close($link);
}
else
{
    die('Direct Access is not allowed!');
}

?>