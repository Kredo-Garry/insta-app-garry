

<?php $__env->startSection('title', "Admin: Post"); ?>

<?php $__env->startSection('content'); ?>
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="table-primary text-secondary small">
            <tr>
                <th></th>
                <th></th>
                <th>CATEGORY</th>
                <th>OWNER</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $all_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-end"><?php echo e($post->id); ?></td>
                    <td>
                        <a href="<?php echo e(route('post.show', $post->id)); ?>">
                            <img src="<?php echo e($post->image); ?>" alt="post id <?php echo e($post->id); ?>" class="d-block mx-auto image-lg">
                        </a>
                    </td>
                    <td>
                        <?php $__currentLoopData = $post->categoryPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge bg-secondary bg-opacity-50"><?php echo e($category_post->category->name); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('profile.show', $post->user->id)); ?>" class="text-dark text-decoration-none"><?php echo e($post->user->name); ?></a>
                    </td>
                    <td><?php echo e($post->created_at); ?></td>
                    <td>
                        <?php if($post->trashed()): ?>
                            <i class="fa-solid fa-circle-minus text-primary"></i>&nbsp; Hidden    
                        <?php else: ?>
                            <i class="fa-solid fa-circle text-primary"></i>&nbsp; Visible
                        <?php endif; ?>
                        
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                            <?php if($post->trashed()): ?>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-primary"data-bs-toggle="modal" data-bs-target="#unhide-post-<?php echo e($post->id); ?>">
                                        <i class="fa-solid fa-eye"></i> Unhide post <?php echo e($post->id); ?>

                                    </button>
                                </div>
                            <?php else: ?>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-danger"data-bs-toggle="modal" data-bs-target="#hide-post-<?php echo e($post->id); ?>">
                                        <i class="fa-solid fa-eye-slash"></i> Hide post <?php echo e($post->id); ?>

                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php echo $__env->make('admin.posts.modal.status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="lead text-muted text-center">No Posts Yet</td>
                </tr>    
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($all_posts->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\roeld\OneDrive\Desktop\insta-app-am\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>