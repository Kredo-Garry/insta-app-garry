
<div class="container p-0">
    <a href="<?php echo e(route('post.show', $post->id)); ?>">
        <img src="<?php echo e($post->image); ?>" alt="post id <?php echo e($post->id); ?>" class="w-100">
    </a>
</div>
<div class="card-body">
    
    <div class="row align-items-center">
        <div class="col-auto">
            <?php if($post->isLiked()): ?>
                <form action="<?php echo e(route('like.destroy', $post->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-solid fa-heart text-danger"></i>
                    </button>
                </form>
            <?php else: ?>
                <form action="<?php echo e(route('like.store', $post->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>
            <?php endif; ?>
            
        </div>
        <div class="col-auto px-0">
            <span><?php echo e($post->likes->count()); ?></span>
        </div>
        <div class="col text-end">
            <?php $__empty_1 = true; $__currentLoopData = $post->categoryPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <span class="badge bg-secondary bg-opacity-50"><?php echo e($category_post->category->name); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="badge bg-dark text-wrap">Uncategorized</div>
            <?php endif; ?>
        </div>
    </div>

    
    <a href="<?php echo e(route('profile.show', $post->user->id)); ?>" class="text-decoration-none text-dark fw-bold"><?php echo e($post->user->name); ?></a>
    &nbsp;
    <p class="d-inline fw-light"><?php echo e($post->description); ?></p>
    <p class="text-uppercase text-muted xsmall"><?php echo e(date('M d, Y', strtotime($post->created_at))); ?></p>

    
    <?php echo $__env->make('users.posts.contents.comments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH C:\xampp\htdocs\insta_app_latest_nov\resources\views/users/posts/contents/body.blade.php ENDPATH**/ ?>