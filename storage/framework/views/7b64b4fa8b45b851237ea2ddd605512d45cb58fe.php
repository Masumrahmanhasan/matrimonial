<?php $__env->startSection('title', trans($title)); ?>

<?php $__env->startSection('content'); ?>
    <!-- BLOG -->
    <?php if(count($allBlogs) > 0): ?>
    <section class="blog-details">
        <div class="container">
           <div class="row gy-5 g-lg-5">
              <div class="col-lg-8">
                <?php $__empty_1 = true; $__currentLoopData = $allBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                 <div class="blog-box mb-5">
                    <div class="img-box">
                       <img
                          class="img-fluid"
                          src="<?php echo e(getFile(config('location.blog.path').$blog->image)); ?>"
                          alt="<?php echo app('translator')->get('blog img'); ?>"
                       />
                    </div>
                    <div class="text-box">
                       <div class="date-author d-flex justify-content-between">
                          <span><?php echo app('translator')->get('Posted by'); ?> <?php echo app('translator')->get(optional($blog->details)->author); ?> <?php echo app('translator')->get('on'); ?> <?php echo e(dateTime($blog->created_at,'d M, Y')); ?> </span>
                          <span class="badge bg-info"><?php echo app('translator')->get(optional(optional($blog->category)->details)->name); ?></span>
                       </div>
                       <h4><?php echo app('translator')->get(\Illuminate\Support\Str::limit(optional($blog->details)->title,58)); ?></h4>
                       <p><?php echo app('translator')->get(\Illuminate\Support\Str::limit(optional($blog->details)->details,200)); ?></p>
                        <a href="<?php echo e(route('blogDetails',[slug(@$blog->details->title), $blog->id])); ?>">
                            <button class="btn-flower">
                                <?php echo app('translator')->get('Read more...'); ?>
                            </button>
                        </a>
                    </div>
                 </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <?php endif; ?>

                <div class="row py-5 mt-5">
                    <?php echo e($allBlogs->links()); ?>

                </div>
              </div>


              <div class="col-lg-4">
                 <div class="side-box">
                    <form action="<?php echo e(route('blogSearch')); ?>" method="get">
                        <?php echo csrf_field(); ?>
                       <h4><?php echo app('translator')->get('Search'); ?></h4>
                       <div class="input-group">
                          <input type="text" class="form-control" name="search" id="search" placeholder="<?php echo app('translator')->get('search'); ?>"
                          />
                          <button type="submit"><i class="fal fa-search"></i></button>
                       </div>
                    </form>
                 </div>

                 <div class="side-box">
                    <h4><?php echo app('translator')->get('categories'); ?></h4>
                    <ul class="links">
                        <?php $__currentLoopData = $blogCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('CategoryWiseBlog', [slug(optional(@$category->details)->name), $category->id])); ?>"><?php echo app('translator')->get(optional(@$category->details)->name); ?> (<?php echo e($category->blog_count); ?>)</a>
                        </li>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                 </div>

              </div>
           </div>
        </div>
    </section>
    <?php else: ?>
        <div class="d-flex flex-column justify-content-center py-5">
            <h3 class="text-center mt-5 mb-5"><?php echo app('translator')->get('No Post Available.'); ?></h3>
            <a href="<?php echo e(route('blog')); ?>" class="text-center">
                <button class="btn-flower">
                    <?php echo app('translator')->get('Back'); ?>
                </button>
            </a>
        </div>
    <?php endif; ?>

    <!-- /BLOG -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/masumrahmanhasan/Herd/project/resources/views/themes/deepblue/blog.blade.php ENDPATH**/ ?>