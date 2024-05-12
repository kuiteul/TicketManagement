
<?php $__env->startSection('title'); ?>
    Gestion des utilisateurs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>

        <div class="border d-flex flex-end col-8 offset-4">
            <p class="col-4 offset-8">
                <a href="/ticketService" class="text-primary">Ticket de services</a>
            </p>
        </div>
        
        <table class="table border">    
            <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>Ticket title</td>
                    <td><?php echo e($item->ticket_name); ?> </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td><?php echo e($item->comments); ?></td>
                </tr>

                <tr>
                    <td>Ticket Status</td>
                    <td><?php echo e($item->ticket_status); ?> </td>
                </tr>

                <?php if($item->resolution == "Appointment"): ?>
                    <tr>
                        <td>Ticket Resolution</td>
                        <td>Ticket Planifié</td>
                    </tr>
                    <!-- Retrieving scheduling data
                    -->
                    <?php $__currentLoopData = $scheduling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_scheduled): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>Date de début</td>
                            <td><?php echo e($item_schedule->date_starte); ?></td>
                        </tr>
                        <tr>
                            <td>Date de fin</td>
                            <td><?php echo e($item_scheduled->date_ended); ?></td>
                        </tr>
                        <tr>
                            <td>Raison de la planification</td>
                            <td><?php echo e($item_scheduled->scheduled_reason); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?> 
                    <?php if($item->resolution == 'Resolved'): ?>
                    <tr>
                        <td>Ticket Resolution</td>
                        <td><?php echo e($item->resolution); ?> </td>
                    </tr>
                        <tr>
                            <td>Closed by</td>
                            <?php if(Auth::user()->user_id == $item->user_id): ?>
                                <td>Moi même</td>
                            <?php else: ?> 
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->user_id == $item_user->user_id): ?>
                                        <td> <?php echo e($item_user->first_name); ?> <?php echo e($item_user->last_name); ?> </td>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php endif; ?>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td>Opened by</td>
                            <?php if(Auth::user()->user_id == $item->user_id): ?>
                                <td>Moi même</td>
                            <?php else: ?> 
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->user_id == $item_user->user_id): ?>
                                        <td> <?php echo e($item_user->first_name); ?> <?php echo e($item_user->last_name); ?> </td>
                                    <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                            <?php endif; ?>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>  
                   
                <?php if(empty($item->closed_at)): ?>
                    <tr>
                        <td>Opened at</td>
                        <td><?php echo e($item->opened_at); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td>Opened at</td>
                        <td><?php echo e($item->opened_at); ?></td>
                    </tr>
                    <tr>
                        <td>Closed at</td>
                        <td><?php echo e($item->closed_at); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item->resolution == 'Resolved'): ?>
                <div class="col-8 offset-2">
                    <button class="col-12 btn ticket btn-ticket" disabled>Ticket Résolu et Fermé</button>
                </div>
                <?php break; ?> 
            <?php endif; ?>
            <!-- We retrieve all tickets who belongs to the service of user that are not opened yet 
              -- whether the tickets belong to him or not
            -->
            <?php if($item->service_id == Auth::user()->service_id && $item->ticket_status == "Not opened"): ?>
                <form action="/ticket_opened" method="POST" class="col-12" id="ticket_view">
                    <?php echo csrf_field(); ?>
                    <div class="col-12 row">                       
                        <?php if($item->ticket_status == "Not opened"): ?>
                            <input type="text" value="<?php echo e($item->ticket_id); ?>" name="ticket_id" hidden>
                            <?php $__errorArgs = ['ticket_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-8 offset-2 alert alert-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <input type="text" value="<?php echo e(Auth::user()->user_id); ?>" name="user_id" hidden>
                            <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-8 offset-2 alert alert-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="col-4 offset-2">
                                <button class="col-12 btn btn-ticket ticket" type="submit">Ouvrir le ticket</button>
                            </div>
                            <div class="col-4">
                                <button class="col-12 btn btn-ticket ticket" id="transfert_ticket">Transférer le ticket</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </form> 
            <?php else: ?>        
                <!-- We retrieve all tickets who belongs to the service of user that are opened 
                -- and belong to him.
                -->    
                <?php if($item->user_id == Auth::user()->user_id && Auth::user()->service_id == $item->service_id ): ?>
                    <form action="/validating_result" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="text" value="<?php echo e($item->ticket_id); ?>" name="ticket_id" hidden>
                        <?php $__errorArgs = ['ticket_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-8 offset-2 alert alert-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <input type="text" value=" <?php echo e(Auth::user()->user_id); ?>" name="user_id" hidden>
                        <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-8 offset-2 alert alert-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="col-6 offset-3">
                            <select name="result" id="result" class="form-control col-12">
                                <option value="" selected disabled>Sélectionner une action</option>
                                <option value="resolved_with_confirm">Resolu avec confirmation</option>
                                <option value="resolved_waiting_confirm">En attente de confirmation</option>
                                <option value="not_resolved">Non Résolu</option>
                                <option value="scheduled">Planifier</option>
                            </select>
                        </div>
                        <?php $__errorArgs = ['result'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="col-8 offset-2 alert alert-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <br>
                        <!-- 
                            Not Resolved Block...
                            -- This block will be displayed when the option value "not_resolved" will be selected
                            -- and will be hidden if not 
                        -->
                        <div class="col-8 offset-2" id="not_resolved_reason">
                            <textarea name="not_resolved" class="form-control col-12" placeholder="Entrer la raison de la non résolution"></textarea>
                        </div><br>
                        <!-- Not Resolved Block ended... -->

                        <!-- 
                            Resolved Block
                            -- This block will be displayed when the option value "resolved_with_confirm" will be selected
                            -- and will be hidden if not
                        -->
                        <div class="col-8 offset-2 " id="resolved_bloc">
                            <div class="col-4" id="validate">
                                <button class="btn ticket btn-ticket col-12">Valider</button>
                            </div>
                            <div class="col-4 offset-3" id="create_archive">
                                <button class="btn ticket btn-ticket col-12 ">Créer une archive</button>
                            </div>
                        </div>
                        <!-- Resolved Block ended... -->
                    </form>
                <?php else: ?> 
                    <!-- We retrieve all tickets who belongs to the service of user that are opened 
                        -- and not belong to him. He will be able to asign himself if he judges necessary
                    -->   
                    <?php if($item->user_id != Auth::user()->user_id && Auth::user()->service_id == $item->service_id ): ?>
                        <form action="/asign-to-me" method="POST" class="row">
                            <?php echo csrf_field(); ?>
                            <div class="col-4 offset-2">
                                <button class="col-12 btn btn-ticket ticket" disabled>Déjà ouvert</button>
                            </div>
                            <div class="col-4">
                                <input type="text" value="<?php echo e($item->ticket_id); ?>" name="ticket_id" hidden>
                                <?php $__errorArgs = ['ticket_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="col-8 offset-2 alert alert-danger">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="text" value="<?php echo e(Auth::user()->user_id); ?>" name="user_id" hidden>
                                <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="col-8 offset-2 alert alert-danger">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <button class="col-12 btn btn-ticket ticket" id="transfert_ticket">M'assigner le ticket</button>
                            </div>
                        </form>

                    <?php else: ?> 
                        <?php if($item->user_id != Auth::user()->user_id && $item->resolution == 'Appointment'): ?>
                            <form action="">
                                <div class="col-6 offset-3">
                                    <button class="col-12 btn btn-ticket ticket" disabled>Ticket planifié pour résolution</button>
                                </div>
                            </form>
                        
                        <?php else: ?> 
                            <!-- 
                            -- otherwise, We can conclude that the ticked has been created by the Authenticated user and wait the resolution.
                            -- Because of this he will be able to make a recall if the ticket take too long to be
                            -- resolved by
                            -->   
                            <form action="/recall" method="POST" class="row">
                                <?php echo csrf_field(); ?>
                                <input type="text" value="<?php echo e(Auth::user()->user_id); ?>" name="user_id" id="user_id" hidden>
                                <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="col-8 offset-2 alert alert-danger">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="text" value="<?php echo e($item->ticket_id); ?>" name="ticket_id" id="ticket_id" hidden>
                                <?php $__errorArgs = ['ticket_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="col-8 offset-2 alert alert-danger">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="col-8 offset-2">
                                    <?php if(isset($recall) && $recall == "Yes"): ?>
                                        <button class="col-12 btn btn-ticket ticket" id="transfert_ticket" disabled>Relance effectuée</button>
                                    <?php else: ?> 
                                        <button class="col-12 btn btn-ticket ticket" id="transfert_ticket">Faire une relance</button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?> 
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <br><br>
        <!-- This form will be shown when clicking on transfert button
        | -- The user will be able to select another service if he saw that 
        | -- The problem doesn't concern their service
        -->
        <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form action="/transfert_ticket" method="POST" class="col-12" id="transfert_ticket_form">
                <?php echo csrf_field(); ?>
                <input type="text" name="user_id" value="<?php echo e(Auth::user()->user_id); ?>" id="user_id" hidden>
                <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="col-8 offset-2 alert alert-danger">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <input type="text" name="ticket_id" id="ticket_id" value="<?php echo e($item->ticket_id); ?>" hidden>
                <?php $__errorArgs = ['ticket_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="col-8 offset-2 alert alert-danger">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="col-8 offset-2">
                    <select name="service_id" id="" class="col-12 form-control">
                        <option value="" selected disabled>Sélectionner le service</option>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Whe deactive the service of user because he cannot transfert a ticket to a service that he belongs to -->
                            <?php if($item->service_id == Auth::user()->service_id): ?>
                                <option disabled value=""><?php echo e($item->service_name); ?></option>
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
                    <div class="col-8 offset-2 alert alert-danger">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <br><br>
                <div class="col-8 offset-2">
                    <textarea name="reason" id="reason" class="col-12 form-control" placeholder="Raison du transfert"></textarea>
                </div>
                <div class="col-3 offset-7">
                    <button class="col-12 btn btn-ticket ticket" id="back">Retour</button>
                </div>
                <br><br>
                <div class="col-6 offset-3">
                    <button class="col-12 btn btn-ticket ticket" id="transfert_ticket">Transférer</button>
                </div>
            </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <!-- This form will be shown when clicking on transfert button
        | -- The user will be able to 
        | -- The problem doesn't concern their service
        -->

        <form action="/scheduled" method="POST" class="col-12" id="scheduled_form">
            <?php echo csrf_field(); ?>
            <div class="text-center fs-3">Plannifier la résolution</div>
            <hr class="col-8 offset-2"><br>
            <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="text" name="ticket_id" id="ticket_id" value=<?php echo e($item->ticket_id); ?> hidden>
                <input type="text" value="<?php echo e($item->ticket_manager_id); ?>" name="ticket_manager_id" hidden>
                
                <?php $__errorArgs = ['ticket_manager_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger col-12"> <?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-3 offset-3 input-login">
                        <label for="date_started" class="text-center">Date de début</label>
                    </div>
                    <div class="col-4 ">
                        <input type="date" class="form-control input-login" id="date_started" name="date_started">
                    </div>
                    <?php $__errorArgs = ['date_started'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger col-8 offset-2"> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <br>
                <div class="row">
                    <div class="col-3 offset-3 input-login">
                        <label for="date_ended" class="text-center">Date de fin</label>
                    </div>
                    <div class="col-4 ">
                        <input type="date" class="form-control input-login" id="date_ended" name="date_ended">
                    </div>
                    <?php $__errorArgs = ['date_ended'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger col-8 offset-2"> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <br>
                <div class="col-7 offset-3">
                    <textarea name="scheduling_reason" id="scheduling_reason" class="col-12 form-control" placeholder="Raison de la planification"></textarea>
                </div>
                <?php $__errorArgs = ['scheduling_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger col-8 offset-2"> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <br>
                <div class="col-4 offset-4" id="validate">
                    <button class="btn ticket btn-ticket col-12">Planifier</button>
                </div>
        </form>
    </main>
<script src="<?php echo e(asset('js/tickets/show.js')); ?>"></script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Ticket\resources\views/ticket/show.blade.php ENDPATH**/ ?>