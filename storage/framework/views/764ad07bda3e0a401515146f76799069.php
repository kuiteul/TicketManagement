
<?php $__env->startSection('title'); ?>
    Création d'un ticket
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>   

    <main class="col-10 col-sm-7 offset-1">
            <div class="col-12 main-bar">
                <p class="fw-bold fs-5">Connecting the world</p>
            </div>
            <p class="col-3 offset-9">
                <a href="/department/create" class="col-12 text-primary">Créer un département</a>
            </p>
            <?php if(isset($result)): ?>
                <div class="col-12 alert alert-success text-center">Le département a été créé avec success</div>
            <?php endif; ?>
            <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Tous les départements</h2>
            <table class="border table">
                <thead>
                    <tr>
                        <th>Department ID</th>
                        <th>Department name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>#<?php echo e($item->department_id); ?></td>
                        <td><?php echo e($item->department_name); ?></td>
                        <td><a href="/department/<?php echo e($item->department_id); ?>/edit" class="text-primary" rel="noopener noreferrer">Modifier</a></td>
                        <td>
                            <form action="/department/<?php echo e($item->department_id); ?>" method="POST">
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
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Ticket\resources\views/department/index.blade.php ENDPATH**/ ?>