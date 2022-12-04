
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>toko</h2>
            </div>
            <div class="pull-right">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('toko-create')): ?>
                <a class="btn btn-success" href="<?php echo e(route('tokos.create')); ?>"> Create New toko</a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('toko-delete')): ?>
                <a class="btn btn-info" href="tokos/trash"> Deleted toko</a>
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
            <th>ID toko</th>
            <th>Nama toko</th>
        
            <th width="280px">Action</th>
        </tr>
        <?php $__currentLoopData = $tokos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toko): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($toko->id_toko); ?></td>
            <td><?php echo e($toko->nama_toko); ?></td>
            <td>
                <form action="<?php echo e(route('tokos.destroy',$toko->id_toko)); ?>" method="POST">
                    <a class="btn btn-info" href="<?php echo e(route('tokos.show',$toko->id_toko)); ?>">Show</a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('toko-edit')): ?>
                    <a class="btn btn-primary" href="<?php echo e(route('tokos.edit',$toko->id_toko)); ?>">Edit</a>
                    <?php endif; ?>
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('toko-delete')): ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <?php endif; ?>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <?php echo $tokos->links(); ?>

    
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\62822\tubes-sbd\resources\views/tokos/index.blade.php ENDPATH**/ ?>