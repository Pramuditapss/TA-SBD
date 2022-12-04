
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted tokos</h2>
            </div>
        </div>
    </div>
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <table class="table table-bordered">
        <tr>
            <th>ID toko</th>
            <th>Nama toko</th>
    
            <th width="280px">Action</th>
        </tr>
        <?php $__currentLoopData = $tokos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toko): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($toko->id_toko); ?></td>
            <td><?php echo e($toko->nama_toko); ?></td>
          
            <td>
                    <a class="btn btn-info" href="trash/<?php echo e($toko->id_toko); ?>/restore">Restore</a>
                    <a class="btn btn-danger" href="trash/<?php echo e($toko->id_toko); ?>/forcedelete">Delete</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <?php echo $tokos->links(); ?>

    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\62822\tubes-sbd\resources\views//tokos/trash.blade.php ENDPATH**/ ?>