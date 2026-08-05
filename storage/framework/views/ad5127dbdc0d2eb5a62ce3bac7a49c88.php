<div class="card-overlay">
    <?php $images = json_decode($post->images, true); ?>
    <?php if(is_array($images) && count($images) > 0): ?>
        <div class="grid grid-cols-2 gap-2 mb-2">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <figure class="relative">
                    <img class="rounded-lg cursor-pointer" src="<?php echo e(asset($image)); ?>" alt="Post image" loading="lazy">
                </figure>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <div class="flex items-center space-x-3">
        <img 
            src="<?php echo e($post->profile_image_url ? Storage::url($post->profile_image_url) : asset('default-profile.png')); ?>" 
            alt="Profile Image" 
            loading="lazy"
            style="width: 50px; height: 50px; border-radius: 50%;" 
            class="object-cover shadow-md" 
        />
        <div class="flex-1">
            <p class="text-sm font-bold"><?php echo e($post->place_name); ?></p>
	    <?php if($post->status === 'show' && $post->fee > 0): ?>
	            <p class="text-sm font-semibold text-grey-500">R <?php echo e($post->fee); ?></p>
	    <?php endif; ?>
            <p class="text-sm text-gray-700"><?php echo e($post->address); ?></p>
            <p class="text-xs text-gray-400">Posted by <?php echo e($post->author); ?></p>
            <?php if(!empty($post->note)): ?>
                <div class="flex flex-col leading-1.5 p-2 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700 mt-1">
                    <p class="text-sm font-normal text-gray-900 dark:text-white" title="<?php echo e($post->note); ?>"> 
                        <?php echo e(Str::limit($post->note, 25)); ?>

                    </p>
                </div>
            <?php endif; ?>
            <p class="text-xs text-gray-400"><?php echo e($post->formatted_time); ?></p>
        </div>
        <div>
            <?php if(Auth::check()): ?>
                <a href="<?php echo e(route('social.view.post', ['id' => $post->id])); ?>" class="p-2 text-sm rounded-full shadow-lg bg-blue-600 text-white">View</a>
            <?php elseif(Auth::guard('google_users')->check()): ?>
                <a href="<?php echo e(route('google.social.view.post', ['id' => $post->id])); ?>" class="p-2 text-sm rounded-full shadow-lg bg-blue-600 text-white">View</a>
            <?php else: ?>
                <a href="<?php echo e(route('social.view.post', ['id' => $post->id])); ?>" class="p-2 text-sm bg-blue-500 text-white rounded-full shadow-lg hover:bg-green-600">Login</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/package/resources/views/partials/social-overlay.blade.php ENDPATH**/ ?>