<div class="card-header bg-white py-3">
    <div class="row align-items-center">

        <div class="col-auto">
            
            <a href="<?php echo e(route('profile.show', $post->user->id)); ?>">
                <?php if($post->user->avatar): ?>
                    <img src="<?php echo e($post->user->avatar); ?>" alt="<?php echo e($post->user->name); ?>" class="rounded-circle avatar-sm">
                <?php else: ?>
                    <div class="fa-solid fa-circle-user text-secondary icon-sm"></div>
                <?php endif; ?>
            </a>
        </div>

        
        <div class="col ps-0">
            <a href="<?php echo e(route('profile.show', $post->user->id)); ?>" class="text-decoration-none text-dark"><?php echo e($post->user->name); ?></a>
        </div>

        
        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>

                
                <?php if(Auth::user()->id === $post->user->id): ?>
                    <div class="dropdown-menu">
                        <a href="<?php echo e(route('post.edit', $post->id)); ?>" class="dropdown-item">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-<?php echo e($post->id); ?>">
                            <i class="fa-regular fa-trash-can"></i> Delete
                        </button>
                    </div>
                    
                    <?php echo $__env->make('users.posts.contents.modals.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>
                    
                    <div class="dropdown-menu">
                        <form action="<?php echo e(route('follow.destroy', $post->user->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('Delete'); ?>
                            <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\roeld\OneDrive\Desktop\insta-app-am\resources\views/users/posts/contents/title.blade.php ENDPATH**/ ?>