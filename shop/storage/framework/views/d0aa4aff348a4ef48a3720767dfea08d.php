


<?php $__env->startSection('title'); ?>
<title>Product list</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admins/product/index/list.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('vendors\sweetAlert2\sweetAlert2.js')); ?>"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="<?php echo e(asset('admins/product/index/list.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <?php echo $__env->make('partials.content-header', ['name' => 'product', 'key' => 'List'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <a href="<?php echo e(route('product.create')); ?>" class="btn btn-success float-right m-2">Add</a>
        </div>
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên</th>
                <th scope="col">Giá</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($productItem->id); ?></td>
                <td><?php echo e($productItem->name); ?></td>
                <td><?php echo e(number_format($productItem->price)); ?></td>
                <td><img class="product_image_150_100" src="<?php echo e($productItem->feature_image_path); ?>" alt=""></td>
                <td><?php echo e(optional($productItem->category)->name); ?></td>
                <td><a href="<?php echo e(route('product.edit', ['id' => $productItem->id])); ?>" class="btn btn-secondary mr-2">Edit</a><a href="" data-url="<?php echo e(route('product.delete', ['id' => $productItem->id])); ?>" class="btn btn-primary action-delete">Remove</a></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
          </table>
        </div>
        <div class="col-md-12">
          <?php echo e($product->links('pagination::bootstrap-5')); ?>

        </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shop\resources\views/admin/product/index.blade.php ENDPATH**/ ?>