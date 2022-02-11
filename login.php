<?php session_start(); require_once('header.php'); ?>  
 
<h3>Credentials Email/Password</h3>
 <h4>Admin: admin@technowand.com/123456</h4>
 <h4>User: qzi.umar@gmail.com/123456</h4>

 <form action="login_action.php" method="POST">
 	<input type="hidden" name="login" value="yes">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Save my Access</label>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form> 
<?php require_once('footer.php'); ?>

