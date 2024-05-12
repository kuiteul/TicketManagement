<?php $__env->startSection('header'); ?>
    
    <header class="col-12 col-sm-10 offset-sm-1 ">
        <div class="row col-12">
            <section class="col-sm-2 ">
                <img src="<?php echo e(asset('images/amt-logo.png')); ?>" class="col-9 offset-1" alt="">
            </section>

            <section class="col-sm-4 offset-sm-2 fs-1 fw-bold  title text-center">
                <p class="title-header">GESTION DES TICKETS</p>
            </section>

            <form class="col-sm-2 offset-sm-2" action="<?php echo e(url('logout')); ?> " method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn text-primary" type="submit">Se déconnecter</button>
            </form>
        </div>

        <div class="sub-header row col-12">
            <section class="col-4">
                Connected as <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> <br>
                <small><?php echo e(Auth::user()->title); ?> </small>
            </section>

            <section class="col-2 offset-6">
                Finance, Bonanjo <br />
                
            </section>
        </div>

    </header>

<?php $__env->stopSection(); ?>
<?php /**PATH D:\Projects\AMT Projects\Ticket Project\Version Controller Ticket\Ticket\resources\views/layout/header.blade.php ENDPATH**/ ?>