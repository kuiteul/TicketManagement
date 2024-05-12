
<?php $__env->startSection('title'); ?>
    Création d'un ticket
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Créer un ticket</h2>
        <hr>
        <!-- 
            |
            | Formulaire de création de ticket 
            |
        -->
        <form action="/ticket" class="col-12" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?> <!-- Clé de contrôle du formulaire -->
            <?php if(isset($error)): ?>
                <div class="col-12 alert alert-danger text-center"><?php echo e($message); ?></div>
            <?php endif; ?>
            <!-- id of user that create the ticket -->
            <input type="text" name="user_id" value="<?php echo e(Auth::user()->user_id); ?>" hidden>
            <div class="col-6 offset-3">
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-3 text-white text-center input-login" id="">Intitulé </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer l'intitulé du ticket" name="ticket_label">
                    </div>
                    <?php $__errorArgs = ['ticket_label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="input-group col-12 mb-3 alert alert-danger"> <?php echo e($message); ?> </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      
                    <div class="input-group mb-3 col-12">
                        <span class="input-group-text text-white col-3 input-login" id="">Service </span>
                        <select name="service_id" id="" class="form-control input-login">  
                            <option value="" selected disabled>Selectionner le service</option>
                            <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item->service_id == Auth::user()->service_id): ?>
                                    <option value="" disabled> <?php echo e($item->service_name); ?> </option>
                                    <?php continue; ?> 
                                <?php endif; ?>
                                <option value="<?php echo e($item->service_id); ?>"><?php echo e($item->service_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php $__errorArgs = ['service_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="input-group col-12 mb-3 alert alert-danger"> <?php echo e($message); ?> </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="input-group mb-3 col-12 ">
                        <label for="comments" class="col-12 text-white label input-login">Commentaires</label>
                        <textarea name="comments" id="comments" cols="30" rows="10" class="form-control text-area input-login"
                            placeholder="Rédiger un commentaire max 250 mots"></textarea>
                    </div>
                    <?php $__errorArgs = ['comments'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="input-group col-12 mb-3 alert alert-danger"> <?php echo e($message); ?> </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="input-group mb-3 col-12 ">
                        <input type="file" name="images_file" id="" class="form-control input-login">
                    </div>
                    <?php $__errorArgs = ['images_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="input-group col-12 mb-3 alert alert-danger"> <?php echo e($message); ?> </div>
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
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Ticket\resources\views/ticket/create.blade.php ENDPATH**/ ?>