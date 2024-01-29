
<div class="modal fade" id="deactivate-user-<?php echo e($user->id); ?>">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-user-slash"></i> Deactivate User
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to deactivate <span class="fw-bold"><?php echo e($user->name); ?></span>?
            </div>
            <div class="modal-footer border-0">
                <form action="<?php echo e(route('admin.users.deactivate', $user->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="activate-user-<?php echo e($user->id); ?>">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-user-check"></i> Activate User
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to activate <span class="fw-bold"><?php echo e($user->name); ?></span>?
            </div>
            <div class="modal-footer border-0">
                <form action="<?php echo e(route('admin.users.activate', $user->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Activate</button>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\roeld\OneDrive\Desktop\insta-app-am\resources\views/admin/users/modal/status.blade.php ENDPATH**/ ?>