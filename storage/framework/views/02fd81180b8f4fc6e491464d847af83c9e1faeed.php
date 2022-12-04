
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted consoles</h2>
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
            <th>ID Console</th>
            <th>Nama Console</th>
            <th>ID Storage</th>
            <th>ID Toko</th>
            <th width="280px">Action</th>
        </tr>
        <?php $__currentLoopData = $consoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($console->id_console); ?></td>
            <td><?php echo e($console->nama_console); ?></td>
            <td><?php echo e($console->id_storage); ?></td>
            <td><?php echo e($console->id_toko); ?></td>
            <td>
                    <a class="btn btn-info" href="trash/<?php echo e($console->id_console); ?>/restore">Restore</a>
                    <a class="btn btn-danger" href="trash/<?php echo e($console->id_console); ?>/forcedelete">Delete</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <?php echo $consoles->links(); ?>

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\62822\tubes-sbd\resources\views//consoles/trash.blade.php ENDPATH**/ ?>