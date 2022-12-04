
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>storage</h2>
            </div>
            <div class="pull-right">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('storage-create')): ?>
                <a class="btn btn-success" href="<?php echo e(route('storages.create')); ?>"> Create New storage</a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('storage-delete')): ?>
                <a class="btn btn-info" href="storages/trash"> Deleted storage</a>
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
            <th>ID storage</th>
            <th>Nama storage</th>
            <th>Detail</th>
        
            <th width="280px">Action</th>
        </tr>
        <?php $__currentLoopData = $storages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $storage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($storage->id_storage); ?></td>
            <td><?php echo e($storage->nama_storage); ?></td>
            <td><?php echo e($storage->detail); ?></td>
            <td>
                <form action="<?php echo e(route('storages.destroy',$storage->id_storage)); ?>" method="POST">
                    <a class="btn btn-info" href="<?php echo e(route('storages.show',$storage->id_storage)); ?>">Show</a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('storage-edit')): ?>
                    <a class="btn btn-primary" href="<?php echo e(route('storages.edit',$storage->id_storage)); ?>">Edit</a>
                    <?php endif; ?>
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('storage-delete')): ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <?php endif; ?>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <?php echo $storages->links(); ?>

   
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\62822\tubes-sbd\resources\views/storages/index.blade.php ENDPATH**/ ?>