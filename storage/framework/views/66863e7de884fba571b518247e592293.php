
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
                    <td>Comments</td>
                    <td><?php echo e($item->comments); ?></td>
                </tr>
                <tr>
                    <td>Ticket Status</td>
                    <td><?php echo e($item->ticket_status); ?> </td>
                </tr>
                <tr>
                    <td>Ticket Resolution</td>
                    <td><?php echo e($item->resolution); ?> </td>
                </tr>
                <tr>
                    <?php if($item->resolution == 'Resolved'): ?>
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
                    <?php else: ?>
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
                    <?php endif; ?>
                    
                </tr>
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

            <?php if($item->service_id == Auth::user()->service_id && $item->ticket_status == "Not opened"): ?>
                <form action="/ticket_opened" method="POST" class="col-12" id="ticket_view">
                    <?php echo csrf_field(); ?>
                    <div class="col-12 row">                       
                        <?php if($item->ticket_status == "Not opened"): ?>
                            <input type="text" value="<?php echo e($item->ticket_id); ?>" name="ticket_id" hidden>
                            <input type="text" name="opened" hidden>
                            <input type="text" value="<?php echo e(Auth::user()->user_id); ?>" name="user_id" hidden>
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
                <?php if($item->user_id == Auth::user()->user_id && Auth::user()->service_id == $item->service_id ): ?>
                    <form action="/validating_result" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="text" value="<?php echo e($item->ticket_id); ?>" name="ticket_id" hidden>
                        <input type="text" value=" <?php echo e(Auth::user()->user_id); ?>" name="user_id" hidden>
                        <div class="col-6 offset-3">
                            <select name="result" id="result" class="form-control col-12">
                                <option value="" selected disabled>Sélectionner une action</option>
                                <option value="resolved_with_confirm">Resolu avec confirmation</option>
                                <option value="resolved_waiting_confirm">En attente de confirmation</option>
                                <option value="not_resolved">Non Résolu</option>
                                <option value="scheduled">Planifier</option>
                            </select>
                        </div><br>
                        <div class="col-8 offset-2" id="not_resolved_reason">
                            <textarea name="not_resolved" class="form-control col-12" placeholder="Entrer la raison de la non résolution"></textarea>
                        </div><br>
                        <div class="col-8 offset-2 " id="resolved_bloc">
                            <div class="col-4" id="validate">
                                <button class="btn ticket btn-ticket col-12">Valider</button>
                            </div>
                            <div class="col-4 offset-3" id="create_archive">
                                <button class="btn ticket btn-ticket col-12 ">Créer une archive</button>
                            </div>
                        </div>
                    </form>
                <?php else: ?> 
                    <?php if($item->user_id != Auth::user()->user_id && Auth::user()->service_id == $item->service_id ): ?>
                        <form action="/asign_ticket" method="POST" class="row">
                            <div class="col-4 offset-2">
                                <button class="col-12 btn btn-ticket ticket" type="submit" disabled>Déjà ouvert</button>
                            </div>
                            <div class="col-4">
                                <input type="text" value="<?php echo e($item->ticket_id); ?>" name="ticket_id" hidden>
                                <input type="text" value="<?php echo e(Auth::user()->user_id); ?>" name="user_id" hidden>
                                <button class="col-12 btn btn-ticket ticket" id="transfert_ticket">M'assigner le ticket</button>
                            </div>
                        </form>
                    <?php else: ?> 
                        <form action="/relaunch" method="POST" class="row">
                            <div class="col-8 offset-2">
                                <input type="text" value="<?php echo e($item->ticket_id); ?>" name="ticket_id" hidden>
                                <button class="col-12 btn btn-ticket ticket" id="transfert_ticket">Faire une relance</button>
                            </div>
                        </form>  
                    <?php endif; ?> 
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <br><br>
        <!-- This form will be shown when clicking on transfert button
        | -- The user will be able to select another service if he saw that 
        | -- The problem doesn't concern their service
        -->
        <form action="/transfert_ticket" method="POST" class="col-12" id="transfert_ticket_form">
            <?php echo csrf_field(); ?>
            <div class="col-8 offset-2">
                <select name="service_id" id="" class="col-12 form-control">
                    <option value="" selected disabled>Sélectionner le service</option>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->service_id == Auth::user()->service_id): ?>
                            <!-- Whe hide the service of user because he cannot transfert a ticket to a service that he belongs to -->
                            <option disabled value="<?php echo e($item->service_id); ?>"><?php echo e($item->service_name); ?></option>
                            <?php continue; ?>
                        <?php endif; ?>
                        <option value="<?php echo e($item->service_id); ?>"><?php echo e($item->service_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
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
         <!-- This form will be shown when clicking on transfert button
        | -- The user will be able to 
        | -- The problem doesn't concern their service
        -->

        <form action="/scheduled" method="POST" class="col-12" id="scheduled_form">
            <?php echo csrf_field(); ?>
            <div class="text-center fs-3">Plannifier la résolution</div>
            <hr class="col-8 offset-2"><br>
            <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="text" value="<?php echo e($item->ticket_manager_id); ?>" hidden>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-3 offset-3 input-login">
                        <label for="date_scheduled" class="text-center">Date de début</label>
                    </div>
                    <div class="col-4 ">
                        <input type="date" class="form-control input-login" id="date_scheduled">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3 offset-3 input-login">
                        <label for="estimated_duration_day" class="text-center">Nombre de jours estimatif</label>
                    </div>
                    <div class="col-4 ">
                        <input type="number" min="1" max="30" value="2" class="form-control input-login" id="estimated_duration_day">
                    </div>
                    
                </div>
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
<?php echo $__env->make('layout/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Version Controller Ticket\Ticket\resources\views/ticket/show.blade.php ENDPATH**/ ?>