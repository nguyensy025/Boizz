

<?php $__env->startSection('title'); ?>
<title>Trang chu</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admins/product/index/list.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('vendors\sweetAlert2\sweetAlert2.js')); ?>"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="<?php echo e(asset('admins/slider/index/list.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <?php echo $__env->make('partials.content-header', ['name' => 'slider', 'key' => 'List'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo e(route('slider.create')); ?>" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($slider['id']); ?></th>
                                <td><?php echo e($slider['name']); ?></td>
                                <td><?php echo e($slider['description']); ?></td>
                                <td>
                                    <img class="product_image_150_100" src="<?php echo e($slider['image_path']); ?>" alt="">
                                </td>
                                <td>
                                    <a href="<?php echo e(route('slider.edit', ['id' => $slider->id])); ?>" class="btn btn-secondary mr-2">Edit</a>
                                    <a href="" 
                                    data-url="<?php echo e(route('slider.delete', ['id' => $slider->id])); ?>"
                                    class="btn btn-primary action-delete">Remove</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <?php echo e($sliders->links('pagination::bootstrap-5')); ?>

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shop\resources\views/admin/slider/index.blade.php ENDPATH**/ ?>