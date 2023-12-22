

<?php $__env->startSection('title'); ?>
<title>Trang chu</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <?php echo $__env->make('partials.content-header', ['name' => 'menus', 'key' => 'Edit'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                <form action="<?php echo e(route('menus.update', ['id' => $menuFollowIdEdit->id])); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <input type="text" name="name" value="<?php echo e($menuFollowIdEdit->name); ?>" class="form-control" placeholder="Nhập tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục cha</label>
                        <select class="form-control" name="parent_id">
                            <option value="0">None</option>
                            {<?php echo $optionSelect; ?>}
                        </select>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shop\resources\views/menus/edit.blade.php ENDPATH**/ ?>