

<?php $__env->startSection('title'); ?>
<title>Trang chu</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('vendors\select2\select2.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('admins\product\add\add.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('admins\user\add\add.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('vendors\select2\select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('admins\user\add\add.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <?php echo $__env->make('partials.content-header', ['name' => 'user', 'key' => 'Edit'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="<?php echo e(route('user.update', ['id' => $user->id])); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="">Tên user</label>
                            <input type="text" 
                                name="name" 
                                value="<?php echo e($user->name); ?>"
                                class="form-control" 
                                placeholder="Nhập tên người dùng">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" 
                                name="email" 
                                value="<?php echo e($user->email); ?>"
                                class="form-control" 
                                placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" 
                                name="password" 
                                value="<?php echo e(old('password')); ?>"
                                class="form-control" 
                                placeholder="Nhập password">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <select name="role_id[]" class="form-control select2-init" multiple>
                                <option value=""></option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option 
                                        <?php echo e($rolesUser->contains('id', $role->id) ? 'selected' : ''); ?>

                                        value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shop\resources\views/admin/user/edit.blade.php ENDPATH**/ ?>