<?php require view('static/header'); ?>  


  <div class="container mt-5" style="max-width:400px;">

      <form method="post" action="">
        <h1 class="text-center">Sign in</h1>
        <?php if(isset($error)): ?>
        <div class="alert alert-danger"> <?=$error?> </div>
        <?php endif; ?>
        <div class="form-group">
          <label for="email-input">Email address</label>
          <input type="email" class="form-control" id="email-input"  placeholder="email" name="email" value="<?=isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
        </div>
        <div class="form-group mt-2">
          <label for="password-input">Password</label>
          <input type="password" class="form-control" id="password-input" placeholder="Password" name="password"   required>
        </div>
        <input type="hidden" name="_token" value="<?=$_SESSION['_token']?>">
        <div class="form-group">
        <a href="<?=site_url('forget-password')?>">Forget Password ?</a> <br>
        <a href="<?=site_url('sign-up')?>">Don't have an account ?</a>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
        
  </div>  

<?php require view('static/footer'); ?>  