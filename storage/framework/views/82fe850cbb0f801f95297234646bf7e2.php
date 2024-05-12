<?php $__env->startSection('menu'); ?>

    <!-- Début de la page html-->
        <!-- Block renfermant tous les autres blocks réduit à une largeur col-sm-6 -->
    <div class="col-sm-2 offset-sm-1 menu-column">
        <!-- Deuxième étage de la page login -->
        <div class="col-12 flex-column">
            <div class="col-12 text-white panel-bar">
                <span id="enterprise-name">Panel</span>
            </div>
            <nav class="col-12 menu nav-link">
                <ul class="fw-bold col-12">
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/ticket/create">Créer un ticket</a></li>
                    <li><a href="/ticket">Mes tickets créés</a></li>
                    <li><a href="/asigntome">Tickets à traiter</a></li>
                    <?php if(Auth::user()->role == "Admin" || Auth::user()->role == "Auditor"): ?>
                        <li><a href="/admin">Administration</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
    
<?php $__env->stopSection(); ?><?php /**PATH D:\Projects\AMT Projects\Ticket Project\Version Controller Ticket\Ticket\resources\views/layout/menu.blade.php ENDPATH**/ ?>