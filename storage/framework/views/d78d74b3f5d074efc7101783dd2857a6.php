<?php $__env->startPush('head'); ?>
    <link
        href="/favicon.ico"
        id="favicon"
        rel="icon"
    >
<?php $__env->stopPush(); ?>

<div class="h2 d-flex align-items-center">
    <?php if(auth()->guard()->check()): ?>
        <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.house','class' => 'd-inline d-xl-none'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

    <p class="my-0 <?php echo e(auth()->check() ? 'd-none d-xl-block' : ''); ?>">
        <?php echo e(config('app.name')); ?>

        <small class="align-top opacity"><?php echo e(config('app.env')); ?></small>
    </p>
</div>
<?php /**PATH D:\wamp64\www\laravel\admin\resources\views/brand/header.blade.php ENDPATH**/ ?>