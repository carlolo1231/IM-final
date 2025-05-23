<?php 
include 'helpers/functions.php'; 
template('header.php'); 
?>

<style>
  body {
    background-color: #e6f0ff;
    color: black;
  }
  .container {
    max-width: 480px;
    background-color: #ffffff;
    padding: 30px 25px;
    border-radius: 10px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.1);
    margin-top: 60px;
    color: black;
  }
  h1, h3 {
    color: black !important;
  }
  .form-text {
    font-size: 0.875rem;
    color: #6c757d;
  }
  a {
    color: #0d6efd;
  }
</style>
<?php
use Aries\MiniFrameworkStore\Models\User;
use Carbon\Carbon;

$user = new User();

if(isset($_POST['submit'])) {
    $registered = $user->register([
        'name' => $_POST['full-name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'created_at' => Carbon::now('Asia/Manila'),
        'updated_at' => Carbon::now('Asia/Manila')
    ]);
}

if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<div class="container">
    <h1 class="text-center">Register</h1>
    <h3 class="text-center text-success">
        <?php 
        if (isset($registered) && $registered) {
            echo 'You have successfully registered! You may now <a href="login.php">login</a>';
        } 
        ?>
    </h3>
    <form action="register.php" method="POST" novalidate>
        <div class="mb-3">
            <label for="full-name" class="form-label">Name</label>
            <input name="full-name" type="text" class="form-control" id="full-name" required>
            <div class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" required>
            <div class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Register</button>
    </form>
</div>

<?php template('footer.php'); ?>
