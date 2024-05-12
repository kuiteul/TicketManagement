
<?php $__env->startSection('title'); ?>
    Création des départements
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <p class="col-3 offset-9">
            <a href="/department" class="col-12 text-primary">Liste des départements</a>
        </p>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Créer un département</h2>
            <hr>
            <form action="/department" class="col-12" method="POST">
                <?php echo csrf_field(); ?>
                <div class="col-6 offset-3">
                        <div class="input-group mb-3 col-12 ">
                            <span class="input-group-text col-3 text-white text-center input-login" id="">Nom</span>
                            <input type="text" name="department_name" class="form-control input-login" aria-label="Sizing example input" 
                                aria-describedby="inputGroup-sizing-default" placeholder="Entrer le nom du département">
                        </div>
                        <?php $__errorArgs = ['department_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="col-12 alert alert-danger text-center"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="input-group mb-3">
                            <input type="submit" class="btn-login col-8 offset-2" value="Enregistrer">
                        </div>

                </div>
            </form>
    </main>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Ticket\resources\views/department/create.blade.php ENDPATH**/ ?>