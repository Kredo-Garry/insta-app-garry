<div class="row">
    <div class="col-4">
        
        <?php if($user->avatar): ?>
            <img src="<?php echo e($user->avatar); ?>" alt="<?php echo e($user->name); ?>" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
        <?php else: ?>
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        <?php endif; ?>
    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0"><?php echo e($user->name); ?></h2>
            </div>
            <div class="col-auto p-2">
                <?php if(Auth::user()->id === $user->id): ?>
                    <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                <?php else: ?>
                    

                    <?php if($user->isFollowed()): ?>
                        <form action="<?php echo e(route('follow.destroy', $user->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                        </form>    
                    <?php else: ?>
                        <form action="<?php echo e(route('follow.store', $user->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                        </form>
                    <?php endif; ?>

                    
                <?php endif; ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <a href="<?php echo e(route('profile.show', $user->id)); ?>" class="text-decoration-none text-dark">
                    <strong><?php echo e($user->posts->count()); ?></strong> <?php echo e($user->posts->count() == 1 ? 'Post':'Posts'); ?>

                </a>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('profile.followers', $user->id)); ?>" class="text-decoration-none text-dark">
                    <strong><?php echo e($user->followers->count()); ?></strong> <?php echo e($user->followers->count() == 1 ? 'Follower':'Followers'); ?>

                </a>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('profile.following', $user->id)); ?>" class="text-decoration-none text-dark">
                    <strong><?php echo e($user->following()->count()); ?></strong> Following
                </a>
            </div>
        </div>
        <p class="fw-bold"><?php echo e($user->introduction); ?></p>
    </div>
</div><?php /**PATH C:\Users\roeld\OneDrive\Desktop\insta-app-am\resources\views/users/profile/header.blade.php ENDPATH**/ ?>