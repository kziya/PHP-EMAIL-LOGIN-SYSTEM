<?php require view('static/header'); ?>  


  <div class="container mt-5" style="max-width:400px;">

      <form method="post" action="">
        <h1 class="text-center">Change Password</h1>
        <?php if(isset($error)): ?>
        <div class="alert alert-danger"> <?=$error?> </div>
        <?php endif; ?>
        <div class="form-group">
          <label for="email-input">Email address</label>
          <input type="email" class="form-control" id="email-input"  placeholder="email" name="email" value="<?=isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
        </div>
        <input type="hidden" name="_token" value="<?=$_SESSION['_token']?>">
        <button type="submit" class="btn btn-primary mt-3">Change password</button>
    </form>
        
  </div>  

<?php require view('static/footer'); ?>  