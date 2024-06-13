<?php if(empty(!Dashboard::getSearch()->all())): ?>
    <div class="p-3">
        <div class="dropdown position-relative" data-controller="search">
            <div class="input-icon">
                <input
                    data-action="keyup->search#query blur->search#blur focus->search#focus"
                    data-search-target="query"
                    type="text"
                    value="<?php echo $__env->yieldContent('search'); ?>"
                       class="form-control input-sm padder bg-dark text-white"
                       placeholder="<?php echo e(__('What to search...')); ?>"
                >
                <div class="input-icon-addon">
                    <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.search'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow bg-white w-100"
                 x-placement="start-left" id="search-result">
            </div>
        </div>
    </div>

<?php else: ?>
    <div class="divider my-2"></div>
<?php endif; ?>
<?php /**PATH D:\wamp64\www\laravel\admin\resources\views/vendor/platform/partials/search.blade.php ENDPATH**/ ?>