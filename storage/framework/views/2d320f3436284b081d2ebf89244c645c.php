
<?php $__env->startSection('title'); ?>
    Récupération du mot de passe
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <p class="col-3 offset-9">
            <a href="/service" class="col-12 text-primary">Liste des services</a>
        </p>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Editer ce service</h2>
                <hr>
                <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <form action="/service/<?php echo e($item->service_id); ?>" class="col-12" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="col-6 offset-3">
                            <div class="input-group mb-3 col-12 ">
                                <span class="input-group-text col-3 text-white text-center input-login" id="">Nom</span>
                                <input type="text" name="service_name" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    placeholder="Entrer le nom du service" value="<?php echo e($item->service_name); ?>">
                            </div>
                            <?php $__errorArgs = ['service_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-12 alert alert-danger text-center"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="input-group mb-3 col-12  " >
                                <span class="input-group-text text-white col-3 input-login" id="">Localisation </span>
                                <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    placeholder="Entrer la localisation" name="service_location" value="<?php echo e($item->service_location); ?>">
                            </div>
                            <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-12 alert alert-danger text-center"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="input-group mb-3 col-12 ">
                                <span class="input-group-text  input-login text-white col-5">Téléphone de service</span>
                                <input type="tel" name="telephone" id="" class="form-control input-login" value="<?php echo e($item->telephone); ?>">
                            </div>
                            <?php $__errorArgs = ['telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-12 alert alert-danger text-center"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="input-group mb-3 col-12 ">
                                <span class="input-group-text  input-login text-white col-5">Service email</span>
                                <input type="tel" name="email_service" id="" class="form-control input-login" value="<?php echo e($item->email_service); ?>">
                            </div>
                            <?php $__errorArgs = ['email_service'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-12 alert alert-danger text-center"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="input-group mb-3 col-12 ">
                                                          
                                    <select name="department_id" id="department_id" class="form-control input-login">
                                        <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                            <option value="<?php echo e($item_department->department_id); ?>"> <?php echo e($item_department->department_name); ?></option>
                                            <?php if(in_array($item->department_id, $department_id)): ?>
                                                <option value="" disabled><?php echo e($item->department_name); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($item_department->department_id); ?>"> <?php echo e($item_department->department_name); ?> </option>
                                            <?php endif; ?> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                          
                                    </select>
                                
                            </div>
                            <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-12 alert alert-danger text-center"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="text" name="service_id" value="<?php echo e($item->service_id); ?>" hidden >
                            <div class="input-group mb-3">
                                <input type="submit" class="btn-login col-8 offset-2" value="Mettre à jour">
                            </div>

                    </div>
                </form>    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </main>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Ticket\resources\views/service/edit.blade.php ENDPATH**/ ?>