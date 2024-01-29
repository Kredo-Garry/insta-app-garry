

<?php $__env->startSection('title', 'Explore People'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-5">
            <p class="h5 text-muted mb-4">
                Search results for "<span class="fw-bold"><?php echo e($search); ?></span>"
            </p>

            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <a href="<?php echo e(route('profile.show', $user->id)); ?>">
                            <?php if($user->avatar): ?>
                                <img src="<?php echo e($user->avatar); ?>" alt="<?php echo e($user->name); ?>" class="rounded-circle avatar-md">
                            <?php else: ?>
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="col ps-0 text-truncate">
                        <a href="<?php echo e(route('profile.show', $user->id)); ?>" class="text-decoration-none text-dark fw-bold">
                            <?php echo e($user->name); ?>

                        </a>
                        <p class="text-muted mb-0">
                            <?php echo e($user->email); ?>

                        </p>
                    </div>
                    <div class="col-auto">
                        <?php if(Auth::user()->id !== $user->id): ?> 
                         
                            <?php if($user->isFollowed()): ?>
                                <form action="<?php echo e(route('follow.destroy', $user->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit" class="btn btn-outline-secondary fw-bold btn-sm">
                                        Following
                                    </button>
                                </form>
                            <?php else: ?>
                                <form action="<?php echo e(route('follow.store', $user->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>

                                    <button type="submit" class="btn btn-primary fw-bold btn-sm">
                                        Follow
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="lead text-muted text-center">
                    No Users Found.
                </p>
            <?php endif; ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\insta_app_latest_nov\resources\views/users/search.blade.php ENDPATH**/ ?>