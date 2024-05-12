<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo e(asset('images/favicon.ico')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>"> 
    <title><?php echo $__env->yieldContent('title'); ?></title>
</head>
<body>
    <div class="container-fluid d-flex flex-row">
        <?php echo $__env->yieldContent('header'); ?>
        <?php echo $__env->yieldContent('menu'); ?>
        <?php echo $__env->yieldContent('content'); ?>
          
    </div>
</body>
</html><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Ticket\resources\views////layout/template.blade.php ENDPATH**/ ?>