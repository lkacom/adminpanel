<div class="form-group row row-cols-sm-2 align-items-baseline">
    <?php if(isset($title)): ?>
        <label for="<?php echo e($id); ?>" class="col-sm-3 text-wrap form-label">
            <?php echo e($title); ?>


            <?php if (isset($component)) { $__componentOriginal1d1976506f33d5d23fa37b3ec2628c63 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1d1976506f33d5d23fa37b3ec2628c63 = $attributes; } ?>
<?php $component = Orchid\Screen\Components\Popover::resolve(['content' => $popover ?? ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('orchid-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Orchid\Screen\Components\Popover::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1d1976506f33d5d23fa37b3ec2628c63)): ?>
<?php $attributes = $__attributesOriginal1d1976506f33d5d23fa37b3ec2628c63; ?>
<?php unset($__attributesOriginal1d1976506f33d5d23fa37b3ec2628c63); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1d1976506f33d5d23fa37b3ec2628c63)): ?>
<?php $component = $__componentOriginal1d1976506f33d5d23fa37b3ec2628c63; ?>
<?php unset($__componentOriginal1d1976506f33d5d23fa37b3ec2628c63); ?>
<?php endif; ?>

            <?php if(isset($attributes['required']) && $attributes['required']): ?>
                <sup class="text-danger">*</sup>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <div class="col col-md-8">
        <?php echo e($slot); ?>


        <?php if($errors->has($oldName)): ?>
            <div class="invalid-feedback d-block">
                <small><?php echo e($errors->first($oldName)); ?></small>
            </div>
        <?php elseif(isset($help)): ?>
            <small class="form-text text-muted"><?php echo $help; ?></small>
        <?php endif; ?>
    </div>
</div>

<?php if(isset($hr)): ?>
    <div class="line line-dashed border-bottom my-3"></div>
<?php endif; ?>
<?php /**PATH D:\wamp64\www\laravel\admin\resources\views/vendor/platform/partials/fields/horizontal.blade.php ENDPATH**/ ?>