
<?php $__env->startSection('title'); ?>
    Gestion des utilisateurs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main class="col-10 col-sm-7 offset-1">
            <div class="col-12 main-bar">
                <p class="fw-bold fs-5">Connecting the world</p>
            </div>
    <?php if(Auth::user()->role == "Auditor" || Auth::user()->role == "Admin"): ?>
  
            <h2 class="text-center text-uppercase fw-bold fs-1 title col-12">Liste de vos feedback</h2>
            <?php if(isset($success)): ?>
                <div class="alert alert-success col-12 text-center"><?php echo e($success); ?></div>
            <?php endif; ?>
            <table class="border table">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Fonction</th>
                        <th>Service rattaché</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($result) && $result == false): ?>
                        <div class="btn btn-danger col-12">L'utilisateur existe déjà</div>
                    <?php endif; ?>

                    <?php if(isset($result) && $result == true): ?>
                        <div class="btn btn-success">Liste des feedback</div>
                   <?php endif; ?>
                    <?php $__currentLoopData = $feedback; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr onclick="document.location.href='/feedback/<?php echo e($item->feedback_id); ?>'" class="cursor">
                            <td><?php echo e($item->first_name); ?></td>
                            <td><?php echo e($item->last_name); ?></td>
                            <td><?php echo e($item->email); ?></td>
                            <td><?php echo e($item->title); ?></td>
                            <td><?php echo e($item->service_names); ?></td>
                        </tr></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
    <?php else: ?> 
            <div class="alert alert-danger text-center ">Vous n'êtes pas authorisé à afficher cette option</div>
          
    <?php endif; ?>
        
    </main>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Ticket\resources\views/feedback/index.blade.php ENDPATH**/ ?>