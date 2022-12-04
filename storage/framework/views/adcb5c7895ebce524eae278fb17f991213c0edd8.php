
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show toko</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?php echo e(route('tokos.index')); ?>"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID toko:</strong>
                <?php echo e($toko->id_toko); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama toko:</strong>
                <?php echo e($toko->nama_toko); ?>

            </div>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>
<p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\62822\tubes-sbd\resources\views/tokos/show.blade.php ENDPATH**/ ?>