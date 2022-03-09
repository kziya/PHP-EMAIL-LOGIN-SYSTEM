<?php require view('static/header'); ?>

<main class="alert alert-<?=isset($message) ? 'info' : 'danger'?> container" style="max-width:400px;margin-top:300px;height:100px;">
    <?=isset($message) ? $message : $errorMessage ?>       
</main>



<?php require view('static/footer'); ?>