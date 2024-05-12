
<?php $__env->startSection('title'); ?>
    Page de connexion
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Début de la page html-->
    <div class="container-fluid login-block col">
        <!-- Block renfermant tous les autres blocks réduit à une largeur col-sm-6 -->
        <div class="main col-11 offset-1 col-sm-6 offset-sm-3">
            <!-- Premier étage de la page login -->
            <div>
                <h1 class="title text-center fw-bold">GESTION DES TICKETS</h1>
            </div>
            <!-- Deuxième étage de la page login -->
            <div class="form-block row">
                <div class="col-12 text-white">
                    <span id="enterprise-name">AMT CAMEROUN SA</span>
                </div>
                
                <form action="/login" class="col-12 login-form " method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="col-12">
                        <div class="form text-center col-12 title title-login ">
                            Page de connexion
                        </div>
                        <div class="form-input-login col-8 offset-2 ">
                            <div class="input-group mb-3">
                                <span class="input-group-text span-login col-3 text-white text-center" id="inputGroup-sizing-default">Login </span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    placeholder="Entrer votre adresse email" name="email">
                            </div>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="input-group mb-3">
                                <span class="input-group-text span-login text-white col-3" id="inputGroup-sizing-default">Mot de passe </span>
                                <input type="password" class="form-control " aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    placeholder="Entrer votre mot de passe" name="password">
                            </div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="text-end forgot-pass col-sm-4 offset-sm-8">
                                <a href="forgot_password">Mot de passe oublié ?</a>
                            </div>
                            <div class="input-group mb-3">
                                <input type="submit" class="btn-login col-8 offset-2" value="Se connecter">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('../layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Ticket\resources\views/auth/login.blade.php ENDPATH**/ ?>