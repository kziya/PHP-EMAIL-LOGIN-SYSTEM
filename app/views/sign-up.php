<?php require view('static/header'); ?>  


<div class="container mt-5" style="max-width:400px;">
    <form method="post" action="">
        <h1 class="text-center">Sign up</h1>
        <?php if(isset($error)): ?>
        <div class="alert alert-danger"> <?=$error?> </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="name-input">Name</label>  
            <input type="text" class="form-control" name="name" id="name-input" placeholder="Name" value="<?=isset($_POST['name'])? $_POST['name'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="email-input">Email address</label>
            <input type="email" class="form-control" id="email-input"  name="email" placeholder="email" value="<?=isset($_POST['email'])? $_POST['email'] : '' ?>" required>
        </div>
        <div class="form-group mt-2">
            <label for="password-input">Password</label>
            <input type="password" class="form-control" id="password-input" placeholder="Password" name="password"required>
        </div>
        <div class="form-group mt-2">
            <label for="confirm-password-input">Confirm password</label>
            <input type="password" class="form-control" id="confirm-password-input" placeholder="Confirm password" name="confirm_password"required>
        </div>
        <input type="hidden" name="key" value="<?=$_SESSION['_token']?>">
        <div class="form-group">
            <a href="<?=site_url('sign-in')?>">Already have an account  ?</a>
        </div>
        <button type="submit" class="btn btn-primary" >Sign up</button>
    </form>
</div>  

<?php require view('static/footer'); ?>  