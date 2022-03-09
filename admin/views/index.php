<?php require  admin_view('static/header'); ?>

    <div class="container mt-5" style="max-width:400px;">
        <h1>Hello Name</h1>


        <form action="<?=admin_url('log-out')?>" method="post" class="mt-5">
            <button class="btn btn-danger">Log out</button>
        </form>
    </div>


<?php require admin_view('static/footer'); ?>
