

<?php $__env->startSection('title'); ?>
<title>Edit product</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('vendors\select2\select2.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('admins\product\add\add.css')); ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo e(asset('admins/product/index/list.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <?php echo $__env->make('partials.content-header', ['name' => 'product', 'key' => 'Edit'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="<?php echo e(route('product.update', ['id' => $product->id])); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" value="<?php echo e($product->name); ?>" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Giá sản phẩm</label>
                            <input type="text" name="price" class="form-control" value="<?php echo e($product->price); ?>" placeholder="Nhập giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input type="file" name="feature_image_path" class="form-control-file" placeholder="Nhập tên sản phẩm">
                            <div class="col-md-12">
                                <div class="row"><img class="product_image_150_100" src="<?php echo e($product->feature_image_path); ?>" alt=""></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh chi tiết</label>
                            <input type="file" multiple name="image_path[]" class="form-control-file" placeholder="Nhập tên sản phẩm">
                            <div class="col-md-12">
                                <div class="row mt-2">
                                    <?php $__currentLoopData = $product->productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productImageItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3 overflow-hidden p-0"><img class="product_image_150_100" src="<?php echo e($productImageItem->img_path); ?>" alt=""></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Mô tả</label>
                            <textarea name="contents" class="form-control" id="" rows="6"><?php echo e($product->content); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Nhập tags cho sản phẩm</label>
                            <select name='tags[]' class="form-control tags_select_choose" multiple="multiple">
                                <?php $__currentLoopData = $product->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tagItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tagItem->name); ?>" selected><?php echo e($tagItem->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn danh mục</label>
                            <select class="form-control select2_init" name="category_id">
                                <option value="0">None</option>
                                {<?php echo $htmlOption; ?>}
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </div>

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

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('vendors\select2\select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('admins\product\add\add.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shop\resources\views/admin/product/edit.blade.php ENDPATH**/ ?>