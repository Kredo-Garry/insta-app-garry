<div class="modal fade" id="delete-post-<?php echo e($post->id); ?>">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> Delete Post
                </h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this post?</p>
                <div class="mt-3">
                    <img src="<?php echo e($post->image); ?>" alt="post id" <?php echo e($post->id); ?> class="image-lg">
                    <div class="mt-1 text-muted"><?php echo e($post->description); ?></div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="<?php echo e(route('post.destroy', $post->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\insta_app_latest_nov\resources\views/users/posts/contents/modals/delete.blade.php ENDPATH**/ ?>