<?php $__env->startSection('title','404'); ?>


<?php $__env->startSection('content'); ?>
    <section style="padding: 120px 0"id="add-recipient-form" class="wow fadeInUp" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12 text-center">
                    <span class="display-1 d-block"><?php echo e(trans('Opps!')); ?></span>
                    <div class="mb-4 mt-3 lead"><?php echo e(trans('The page you are looking for was not found.')); ?></div>
                    <a class="btn-flower" href="<?php echo e(url('/')); ?>" ><?php echo app('translator')->get('Back To Home'); ?></a>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/masumrahmanhasan/Herd/project/resources/views/themes/deepblue/errors/404.blade.php ENDPATH**/ ?>