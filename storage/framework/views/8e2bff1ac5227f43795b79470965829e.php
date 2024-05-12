
<?php $__env->startSection('title'); ?>
    Création d'un ticket
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>   

    <main class="col-10 col-sm-7 offset-1">
            <div class="col-12 main-bar">
                <p class="fw-bold fs-5">Connecting the world</p>
            </div>
            <p class="col-2 offset-10">
                <a href="/service/create" class="col-12 text-primary">Créer un service</a>
            </p>
            <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Tous les services</h2>
            <?php if(isset($success)): ?>
                <div class="col-12 alert alert-success text-center">Le service a été créé avec success</div>
            <?php endif; ?>
            <table class="border table">
                <thead>
                    <tr>
                        <th>Service ID</th>
                        <th>Service name</th>
                        <th>Location</th>
                        <th>Chef Service</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>##<?php echo e($item->service_id); ?></td>
                        <td><?php echo e($item->service_name); ?></td>
                        <td><?php echo e($item->service_location); ?></td>
                        <td><?php echo e($item->telephone); ?> </td>
                        <td><a href="/service/<?php echo e($item->service_id); ?>/edit" class="text-primary">Modifier</a></td>
                        <td>
                            <form action="/service/<?php echo e($item->service_id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </tbody>
            </table>
        
    </main>
    
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Ticket\resources\views/service/index.blade.php ENDPATH**/ ?>