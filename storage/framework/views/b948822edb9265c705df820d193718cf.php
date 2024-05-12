
<?php $__env->startSection('title'); ?>
    Gestion des utilisateurs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">
            Mise à jour de 
            <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($item->first_name); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </h2>
        <hr>
        <!-- 
            |
            | Formulaire de création de ticket 
            |
        -->
        
        <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <form action="/users/<?php echo e($item->employee_id); ?>" class="col-12" method="PUT">
            <?php echo csrf_field(); ?> <!-- Clé de contrôle du formulaire -->
            <?php if(isset($error)): ?>
                <div class="col-12 alert alert-danger text-center"><?php echo e($error); ?></div>
            <?php endif; ?>
            <div class="col-6 offset-3">
                    
                    <!-- Zone de texte du prénom -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Prénom </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer le prénom" name="first_name" value="<?php echo e($item->first_name); ?>">
                    </div>
                    <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="input-group col-12 mb-3 alert alert-danger"> <?php echo e($message); ?> </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <!-- Zone de texte du nom -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Nom </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer le nom" name="last_name" value="<?php echo e($item->last_name); ?>">
                    </div>
                    <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="input-group col-12 mb-3 alert alert-danger"> <?php echo e($message); ?> </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <!-- Zone de texte de l'adresse email -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Email </span>
                        <input type="email" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer une adresse email" name="email" value="<?php echo e($item->email); ?>">
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="input-group col-12 mb-3 alert alert-danger"> <?php echo e($message); ?> </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <!-- Zone de texte de la fonction -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Poste </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer le poste occupée" name="title" value="<?php echo e($item->title); ?>">
                    </div>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="input-group col-12 mb-3 alert alert-danger"> <?php echo e($message); ?> </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <!-- Zone du service affecté -->
                    <div class="input-group mb-3 col-12">
                        <span class="input-group-text text-white col-4 input-login" id="">Service</span>
                        <select name="service_id" id="" class="form-control input-login">  
                            <option value="<?php echo e($item->service_id); ?>"selected><?php echo e($item->service_names); ?></option>
                            <!-- 
                                | We make appears items from services table

                            -->
                          <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- 
                                    | We hide the service name that is already |
                                    | displayed by default                     |
                                -->
                                <?php if($itemService->service_names == $item->service_names): ?>
                                    <option value="<?php echo e($itemService->service_id); ?>" hidden><?php echo e($itemService->service_names); ?></option>
                                <?php else: ?> 
                                <!-- 
                                    | We display items that doesn't match      |

                                -->
                                    <option value="<?php echo e($itemService->service_id); ?>"><?php echo e($itemService->service_names); ?></option>
                                <?php endif; ?>
                             
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php $__errorArgs = ['service_names'];
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
                        <span class="input-group-text text-white col-4 input-login">Admin</span>
                        <input type="checkbox" class="col-2" aria-label="Sizing example input" 
                            aria-describedby="inputGroup-sizing-default" name="admin">
                            
                    </div>
                    <div class="col-12 row">
                        <div class="col-5">
                            <a href="/users/<?php echo e($item->employee_id); ?>"><button class="btn input-login col-12 cursor">Enregistrer</button></a>
                        </div>
                        <div class="col-5 offset-2"> 
                            <a href="/users                                                       "><button class="btn input-login col-12 cursor">Retour</button></a>
                        </div>
                    </div>
            </div>  
        </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </main>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Version Controller Ticket\Ticket\resources\views/user/edit.blade.php ENDPATH**/ ?>