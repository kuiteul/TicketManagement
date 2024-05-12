
<?php $__env->startSection('title'); ?>
    Gestion des utilisateurs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main class="col-8" style="margin-left: 1.3%">
            <div class="col-12 main-bar">
                <p class="fw-bold fs-5">Connecting the world</p>
            </div>
            <p class="col-2 offset-10">
                <a href="/ticket/create" class="col-12 text-primary">Créer un ticket</a>
            </p>
            <h2 class="text-center text-uppercase fw-bold fs-1 title col-12">Mes tickets créés en traitement</h2>
            <?php if(isset($success)): ?>
                <div class="alert alert-success col-12 text-center"><?php echo e($success); ?></div>
            <?php endif; ?>
            <table class="border table">
                <thead>
                    <tr>
                        <th>Ticket label</th>
                        <th>Résolution</th>
                        <th>Statut du ticket</th>
                        <th>Date d'ouverture</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($result) && $result == false): ?>
                        <div class="btn btn-danger col-12">L'utilisateur existe déjà</div>
                    <?php endif; ?>

                    <?php if(isset($result) && $result == true): ?>
                        <div class="btn btn-success">L'utilisateur a été créé avec success</div>
                   <?php endif; ?>
                    <?php $__currentLoopData = $intreatment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr onclick="document.location.href='/ticket/<?php echo e($item->ticket_id); ?>'" class="cursor" title="Click to open the ticket">
                            <td><?php echo e($item->ticket_name); ?></td>
                            <td><?php echo e($item->resolution); ?> </td>
                            <td><?php echo e($item->ticket_status); ?></td>
                            <td><?php echo e($item->opened_at); ?></td>
                        </tr>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

           
        
    </main>
    
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Version Controller Ticket\Ticket\resources\views/ticket/intreatment.blade.php ENDPATH**/ ?>