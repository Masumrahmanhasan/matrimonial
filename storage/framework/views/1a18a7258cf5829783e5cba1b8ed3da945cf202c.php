<?php $__env->startSection('title',trans('Story')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make($theme.'sections.story', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/masumrahmanhasan/Herd/project/resources/views/themes/deepblue/story.blade.php ENDPATH**/ ?>