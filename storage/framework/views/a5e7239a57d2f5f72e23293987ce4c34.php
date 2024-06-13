<?php if(isset($title)): ?>
    <li class="nav-item mt-3 mb-1">
        <small class="text-muted ms-4 w-100 user-select-none"><?php echo e(__($title)); ?></small>
    </li>
<?php endif; ?>

<?php if(!empty($name)): ?>
<li class="nav-item <?php echo e(active($active)); ?>">
    <a data-turbo="<?php echo e(var_export($turbo)); ?>"
        <?php echo e($attributes); ?>

    >
        <?php if(isset($icon)): ?>
            <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => $icon,'class' => ''.e(empty($name) ?: 'me-2 overflow-visible').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('orchid-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Orchid\Icons\IconComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal385240e1db507cd70f0facab99c4d015)): ?>
<?php $attributes = $__attributesOriginal385240e1db507cd70f0facab99c4d015; ?>
<?php unset($__attributesOriginal385240e1db507cd70f0facab99c4d015); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal385240e1db507cd70f0facab99c4d015)): ?>
<?php $component = $__componentOriginal385240e1db507cd70f0facab99c4d015; ?>
<?php unset($__componentOriginal385240e1db507cd70f0facab99c4d015); ?>
<?php endif; ?>
        <?php endif; ?>

        <span class="me-2"><?php echo e($name ?? ''); ?></span>

        <?php if(isset($badge)): ?>
            <b class="badge rounded-pill bg-<?php echo e($badge['class']); ?> col-auto ms-auto"><?php echo e($badge['data']()); ?></b>
        <?php endif; ?>
    </a>
</li>
<?php endif; ?>

<?php if(!empty($list)): ?>
    <div class="nav collapse sub-menu ps-3 <?php echo e(active($active, 'show')); ?>"
         id="menu-<?php echo e($slug); ?>"
         <?php if(isset($parent)): ?>
            data-bs-parent="#menu-<?php echo e($parent); ?>">
         <?php else: ?>
            data-bs-parent="#headerMenuCollapse">
         <?php endif; ?>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $item->build($source); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<?php if($divider): ?>
    <li class="divider my-2"></li>
<?php endif; ?>

<?php /**PATH D:\wamp64\www\laravel\admin\resources\views/vendor/platform/actions/menu.blade.php ENDPATH**/ ?>