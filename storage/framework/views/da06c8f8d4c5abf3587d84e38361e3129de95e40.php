
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Consoles</h2>
            </div>
            <div class="pull-right">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('console-create')): ?>
                <a class="btn btn-success" href="<?php echo e(route('consoles.create')); ?>"> Create New Console</a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('console-delete')): ?>
                <a class="btn btn-info" href="consoles/trash"> Deleted Console</a>
                <?php endif; ?>
            </div>
            <div class="my-3 col-12 col-sm-8 col-md-5">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Keyword" name = "keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                        <button class="input-group-text btn btn-primary" id="basic-addon1">Search</button>
                    </div>
                </form>
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
                <form action="<?php echo e(route('consoles.destroy',$console->id_console)); ?>" method="POST">
                    <a class="btn btn-info" href="<?php echo e(route('consoles.show',$console->id_console)); ?>">Show</a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('console-edit')): ?>
                    <a class="btn btn-primary" href="<?php echo e(route('consoles.edit',$console->id_console)); ?>">Edit</a>
                    <?php endif; ?>
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('console-delete')): ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <?php endif; ?>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <?php echo $consoles->links(); ?>

    
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\62822\tubes-sbd\resources\views/consoles/index.blade.php ENDPATH**/ ?>