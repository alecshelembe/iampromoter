<?php $__env->startSection('content'); ?>

<?php if(Auth::guard('google_users')->check()): ?>
    <?php echo $__env->make('google.layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>



    <div class="flex justify-end">
        <button id="toggleView" class="px-4 py-2 text-white bg-blue-500 rounded-lg"><i class="fa-regular fa-eye"></i> View</button>
    </div>
    
    <div id="postContainer" class="grid grid-cols-2 gap-4 mt-4 lg:grid-cols-4">
        <?php $__currentLoopData = $socialPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="p-2  bg-white">
                <div class="grid grid-cols-2 gap-4">
                    
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
                        <!-- <p>No images found.</p> -->
                    <?php endif; ?>
                </div>
     
                
                <div class="mt-4">
                    <p class="text-sm text-gray-700"><?php echo e($post->title); ?></p>
                    <!-- <p class="text-sm text-gray-700"><?php echo e($post->description); ?></p> -->
                    <p class="text-xs text-gray-500">Posted by: <?php echo e($post->author); ?></p>
                    
                    <p class="text-xs text-gray-500"><?php echo e($post->formatted_time); ?></p>
                    <div class="">
                        <a href="<?php echo e(route('social.view.post', ['id' => $post->id])); ?>" 
                        class=" p-2 text-sm rounded-full shadow-lg">
                            View
                        </a>
                    </div>

                    <?php if(auth()->user()->email === $post->email): ?>
                        <?php if($post->status === 'show'): ?>
                            <form action="<?php echo e(route('posts.hide', $post->id)); ?>" class=" rounded-full shadow-lg text-sm" method="POST">
                                <?php echo csrf_field(); ?>
                                <button class="px-2 text-xs py-2"><i class="fa-regular fa-eye-slash"></i> Hide my post</button>
                            </form>
                        <?php else: ?>
                            <form action="<?php echo e(route('posts.show', $post->id)); ?>" class="rounded-full shadow-lg text-sm" method="POST">
                                <?php echo csrf_field(); ?>
                                <button class="px-2 text-xs py-2"><i class="fa-regular fa-eye"></i> Show my post</button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
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
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/mobile/home.blade.php ENDPATH**/ ?>