
<?php $__env->startSection('title'); ?>
    Gestion des utilisateurs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <div class="border d-flex flex-end col-8 offset-4">
            <p class="col-4">
                <a href="/users" class="col-12 text-primary">Liste des utilisateurs</a>
            </p>
            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form action="/users/<?php echo e($item->user_id); ?>" class="col-4" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <div class="col-8">
                    <button class="btn input-login col-12 cursor">Supprimer</button>
                </div>
           
            </form>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">
            Informations complètes sur  
            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($item->first_name); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </h2>
        <hr>
        <!-- 
            |
            | Formulaire de création de ticket 
            |
        -->
        
        <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <form action="/users/<?php echo e($item->user_id); ?>" class="col-12" method="POST">
            <?php echo csrf_field(); ?> <!-- Clé de contrôle du formulaire -->
            <?php echo method_field("PUT"); ?>
            <?php if(isset($error)): ?>
                <div class="col-12 alert alert-danger text-center"><?php echo e($error); ?></div>
            <?php endif; ?>
            <div class="col-6 offset-3">
                    
                    <!-- Zone de texte du prénom -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Prénom </span>
                        <input type="text" id="first_name" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                           disabled placeholder="Entrer le prénom" name="first_name" value="<?php echo e($item->first_name); ?>">
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
                        <input type="text" id="last_name" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        disabled placeholder="Entrer le nom" name="last_name" value="<?php echo e($item->last_name); ?>">
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
                        <input type="email" id="email" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        disabled placeholder="Entrer une adresse email" name="email" value="<?php echo e($item->email); ?>">
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
                        <input type="text" id="title" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        disabled name="title" value="<?php echo e($item->title); ?>">
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
                    <div class="input-group mb-3 col-12"  id="service_name">
                        <span class="input-group-text col-4 text-white text-center input-login">Service</span>
                        <?php $__currentLoopData = $user_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="text" value="<?php echo e($item_service->service_id); ?> " hidden >
                            <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            disabled name="service_name" value="<?php echo e($item_service->service_name); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <!-- This div will be display after clicking on the button modifier -->
                    <div class="input-group mb-3 col-12" id="service">
                        <select class="form-control col-12 input-login" name="service_id">
                            <option value="" selected disabled>Sélectionner le service</option>
                            <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item_service->service_id); ?>"><?php echo e($item_service->service_name); ?> </option>
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
                        <span class="input-group-text text-white col-4 input-login">Rôle</span>
                        <input type="text" id="role" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        disabled  name="role" value="<?php echo e($item->role); ?>">
                            
                    </div>
                    <div class="col-12">
                        <div class="col-8 offset-2" id="modify">
                           <button class="btn input-login col-12 cursor">Modifier</button>
                        </div>
                        <div class="col-8 offset-2" id="update">
                            <button class="btn input-login col-12 cursor" type="submit">Mettre à jour</button>
                         </div>
                    </div>
            </div>  
        </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </main>
<script src="<?php echo e(asset('js/users/show.js')); ?>"></script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Ticket\resources\views/user/show.blade.php ENDPATH**/ ?>