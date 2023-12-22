

<?php $__env->startSection('title'); ?>
<title>Trang chu</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('admins\roles\add.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('admins\roles\add.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-wrapper">

    <?php echo $__env->make('partials.content-header', ['name' => 'role', 'key' => 'Add'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="<?php echo e(route('roles.store')); ?>" method="post" enctype="multipart/form-data" class="col-md-12">
                    <div class="col-md-12">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control " placeholder="Enter name">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Display name</label>
                            <textarea name="display_name" class="form-control" id="" cols="30" rows="4"><?php echo e(old('display_name')); ?></textarea>
                            <?php $__errorArgs = ['display_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <input type="checkbox" class="checkall">
                                    Check all
                                </label>
                            </div>
                            <?php $__currentLoopData = $permissionsParent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permissionsParentItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card bg-light mb-3 col-md-12">
                                <div class="card-header">
                                    <label>
                                        <input type="checkbox" class="box-15px checkbox_wrapper" name="" id="" value="">
                                        <?php echo e($permissionsParentItem->name); ?>

                                    </label>
                                </div>
                                <div class="row">
                                    <?php $__currentLoopData = $permissionsParentItem->permissionsChildrent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permissionsChildrentItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <div class="card-body col-md-3>
                                                    <label class="font-weight-normal text-primary">
                                            <input type="checkbox" class="box-15px checkbox_childrent" name="permission_id[]" id="" value="<?php echo e($permissionsChildrentItem->id); ?>">
                                                <?php echo e($permissionsChildrentItem->name); ?>

                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shop\resources\views/admin/role/add.blade.php ENDPATH**/ ?>