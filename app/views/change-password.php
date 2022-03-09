<?php require view('static/header'); ?>  


  <div class="container mt-5" style="max-width:400px;">

      <form method="post" action="">
        <h1 class="text-center">Change Password</h1>
        <?php if(isset($error)): ?>
        <div class="alert alert-danger"> <?=$error?> </div>
        <?php endif; ?>
        
        <div class="form-group">
          <label for="password-input">Password </label>
          <input type="password" class="form-control" id="password-input"  placeholder="Password" name="password"  required>
        </div>
        <div class="form-group">
          <label for="confirm-password-input">Confirm password </label>
          <input type="password" class="form-control" id="confirm-password-input"  placeholder="Password" name="confirm_password"  required>
        </div>
        <input type="hidden" name="_token" value="<?=$_SESSION['_token']?>">
        <button type="submit" class="btn btn-primary mt-3">Change password</button>
    </form>
        
  </div>  

<?php require view('static/footer'); ?>  