<?php require admin_view('static/header'); ?>

<main class="alert alert-<?=$message? 'info' : 'danger' ?> container" style="max-width:400px;margin-top:300px;height:100px;">
    <?=$message?>    
</main>

<div class="container" style="max-width:300px;">
    <form action="<?=admin_url('log-out')?>" method="post" class="mt-5" >
        <button class="btn btn-danger">Log out</button>
    </form>
</div>


<?php require admin_view('static/footer'); ?>