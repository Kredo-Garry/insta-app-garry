<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row gx-5">
        <div class="col-8 bg-light">

            <?php $__empty_1 = true; $__currentLoopData = $home_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card mb-4">
                    
                    <?php echo $__env->make('users.posts.contents.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                    <?php echo $__env->make('users.posts.contents.body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-muted">When you share photos, they'll appear on your profile.</p>
                    <a href="<?php echo e(route('post.create')); ?>">Share your first photo</a>
                </div>
            <?php endif; ?>
            
        </div>
        <div class="col-4 bg-light">
            
            <div class="row align-items-center bg-white shadow-sm rounded-3 py-3">
                <div class="col-auto">
                    <a href="<?php echo e(route('profile.show', Auth::user()->id)); ?>">
                        <?php if(Auth::user()->avatar): ?>
                            <img src="<?php echo e(Auth::user()->avatar); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="rounded-circle avatar-md">
                        <?php else: ?>
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="col ps-0">
                    <a href="<?php echo e(route('profile.show', Auth::user()->id)); ?>" class="text-decoration-none text-dark fw-bold"><?php echo e(Auth::user()->name); ?></a>
                    <p class="text-muted mb-0"><?php echo e(Auth::user()->email); ?></p>
                </div>
            </div>

            
            <?php if($suggested_users): ?>
                <div class="row mb-3 mt-3">
                    <div class="col-auto">
                        <p class="fw-bold text-secondary">Suggestions For You</p>
                    </div>
                    <div class="col text-end">
                        <a href="#" class="fw-bold text-decoration-none text-dark">See All</a>
                    </div>
                </div>

                <?php $__currentLoopData = $suggested_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row align-items-center mb-3">
                        <div class="col-auto">
                            <a href="<?php echo e(route('profile.show', $user->id)); ?>">
                                <?php if($user->avatar): ?>
                                    <img src="<?php echo e($user->avatar); ?>" alt="<?php echo e($user->avatar); ?>" class="rounded-circle avatar-sm">
                                <?php else: ?>
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="col ps-0 text-truncate">
                            <a href="<?php echo e(route('profile.show', $user->id)); ?>" class="text-decoration-none text-dark fw-bold"><?php echo e($user->name); ?></a>
                        </div>
                        <div class="col-auto">
                            <form action="<?php echo e(route('follow.store', $user->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\insta_app_latest_nov\resources\views/users/home.blade.php ENDPATH**/ ?>