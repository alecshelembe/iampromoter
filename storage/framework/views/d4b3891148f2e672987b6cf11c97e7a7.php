<?php $__env->startSection('content'); ?>

<?php if(Auth::check() || Auth::guard('google_users')->check()): ?>
    <!-- Content for authenticated users -->
    <?php if(Auth::guard('google_users')->check()): ?>
        <?php echo $__env->make('google.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php else: ?>
    <!-- If not authenticated, redirect to login -->
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
<?php endif; ?>

    <div class="flex justify-end">
        <button id="toggleView" class="px-4 py-2 text-white bg-blue-500 rounded-lg">
            <i class="fa-regular fa-eye"></i> 
        </button>
    </div>

    <div id="postContainer" class="grid grid-cols-2 gap-4 mt-4 lg:grid-cols-4">
        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="p-2 bg-white">
                <div class="grid grid-cols-2 gap-2">
                    
                    <?php
                        $images = json_decode($post->images, true); // Decode JSON
                    ?>

                    <?php if(is_array($images) && count($images) > 0): ?>
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <figure class="max-w-lg relative">
                                <img class="h-auto max-w-full rounded-lg cursor-pointer"
                                    src="<?php echo e(asset($image)); ?>"
                                    alt="Post image"
                                    loading="lazy">
                            </figure>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p>No images found.</p>
                    <?php endif; ?>
                </div>

                
                <div class="mt-4">
                    <img src="<?php echo e(Storage::url($post->profile_image_url)); ?>"
                        name="image"
                        loading="lazy"
                        alt="Image Preview"
                        style="width: 50px; height: 50px; border-radius: 50%;"
                        class="object-cover shadow-md" />

                    <p class="text-sm text-gray-700 font-bold"><?php echo e($post->place_name); ?></p>
		    <?php if($post->status === 'show' && $post->fee > 0): ?>
	                    <p class="text-sm font-semibold text-grey-500">R <?php echo e($post->fee); ?></p>
		    <?php endif; ?>
                    <p class="text-sm text-gray-700"><?php echo e($post->address); ?></p>

                    <div>
                    <?php if(Auth::check()): ?>

                        <a href="<?php echo e(route('social.view.post', ['id' => $post->id])); ?>"
                            class="p-2 text-sm rounded-full shadow-lg">
                            View
                        </a>
                    <?php elseif(Auth::guard('google_users')->check()): ?>

                        <a href="<?php echo e(route('google.social.view.post', ['id' => $post->id])); ?>"
                            class="p-2 text-sm rounded-full shadow-lg">
                            View
                        </a>
                    <?php endif; ?>
                    </div>
                </div>
            </div> 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div> 

    <script>
        const toggleButton = document.getElementById('toggleView');
        const postContainer = document.getElementById('postContainer');

        let isGrid = true;

        toggleButton.addEventListener('click', function() {
            if (isGrid) {
                postContainer.classList.remove('grid', 'grid-cols-2');
                postContainer.classList.add('flex', 'flex-col');
            } else {
                postContainer.classList.remove('flex', 'flex-col');
                postContainer.classList.add('grid', 'grid-cols-2');
            }
            isGrid = !isGrid;
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/mobile/social-results.blade.php ENDPATH**/ ?>