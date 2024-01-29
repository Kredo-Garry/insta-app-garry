<div class="mt-3">
    
    <?php if($post->comments->isNotEmpty()): ?>
        <hr>
        <ul class="list-group">
            <?php $__currentLoopData = $post->comments->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item border-0 p-0 mb-2">
                    <a href="<?php echo e(route('profile.show', $comment->user->id)); ?>" class="text-decoration-none text-dark fw-bold">
                        <?php echo e($comment->user->name); ?>

                    </a>
                    &nbsp; 
                    <p class="d-inline fw-light">
                        <?php echo e($comment->body); ?>

                    </p>

                    
                    <form action="<?php echo e(route('comment.destroy', $comment->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <span class="text-uppercase text-muted xsmall">
                            <?php echo e(date('M d, Y',strtotime($comment->created_at))); ?>

                        </span>

                        <?php if(Auth::user()->id === $comment->user->id): ?>
                        
                            &middot; 
                                <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">
                                    Delete
                                </button>
                        <?php endif; ?>
                    </form>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($post->comments->count() > 3): ?>
                <li class="list-group-item border-0 px-0 pt-0">
                    <a href="<?php echo e(route('post.show', $post->id)); ?>" class="text-decoration-none small">
                        View all <?php echo e($post->comments->count()); ?> comment
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>

    <form action="<?php echo e(route('comment.store', $post->id)); ?>" method="post">
        <?php echo csrf_field(); ?>

        <div class="input-group">
            <textarea name="comment_body<?php echo e($post->id); ?>" id="" rows="1" class="form-control form-control-sm" placeholder="Add a comment..."><?php echo e(old('comment_body'.$post->id)); ?></textarea>

            <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
        </div>
        
        <?php $__errorArgs = ['comment_body'.$post->id];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger small"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </form>
</div><?php /**PATH C:\xampp\htdocs\insta_app_latest_nov\resources\views/users/posts/contents/comments.blade.php ENDPATH**/ ?>