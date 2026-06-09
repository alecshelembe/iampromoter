<?php $__env->startSection('content'); ?>

<div class="max-w-5xl mx-auto p-6 bg-white rounded-lg"> 
    <h1 class="text-xl font-medium mb-4">Active </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

        <?php if($influencers->isEmpty()): ?>
            <p class="text-gray-600 col-span-4 text-center">No influencers found.</p>
        <?php else: ?>
            <?php $__currentLoopData = $influencers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $influencer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center pb-6">
                
                    <img 
                        loading="lazy"
                        style="width: 150px; height: 150px; border-radius: 50%;" 
                        class="mx-auto object-cover shadow-md m-2"  
                        src="<?php echo e($influencer->profile_image_url ? Storage::url($influencer->profile_image_url) : asset('images/default-avatar.png')); ?>" 
                        alt="<?php echo e($influencer->first_name); ?>'s image"
                    />

                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
                        <?php echo e($influencer->first_name); ?> <?php echo e($influencer->last_name); ?>

                    </h5>
                    
                    <h5 class="text-gray-600 text-center dark:text-gray-400 mt-2 text-sm">
                        <?php echo e($influencer->email); ?>

                    </h5>

                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        <?php echo e($influencer->position ?? 'Influencer'); ?>

                    </span>

                    <p class="text-gray-600 text-center dark:text-gray-400 mt-2 text-sm">
                        <?php echo e($influencer->google_location ?? 'No location available'); ?>

                    </p>

                    <div class="flex flex-wrap justify-center mt-4 space-x-2">
                        <?php if(!empty($influencer->instagram_handle)): ?>
                            <a href="<?php echo e($influencer->instagram_handle); ?>" target="_blank" rel="noopener noreferrer"
                            class="py-2 px-3 text-sm font-medium bg-white hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <i class="fa-brands fa-instagram"></i> Instagram
                            </a>
                        <?php endif; ?>

                        <?php if(!empty($influencer->linkedin_handle)): ?>
                            <a href="<?php echo e($influencer->linkedin_handle); ?>" target="_blank" rel="noopener noreferrer"
                            class="py-2 px-3 text-sm font-medium bg-white hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <i class="fa-brands fa-linkedin"></i> LinkedIn
                            </a>
                        <?php endif; ?>

                        <?php if(!empty($influencer->tiktok_handle)): ?>
                            <a href="<?php echo e($influencer->tiktok_handle); ?>" target="_blank" rel="noopener noreferrer"
                            class="py-2 px-3 text-sm font-medium bg-white hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <i class="fa-brands fa-tiktok"></i> TikTok
                            </a>
                        <?php endif; ?>

                        <?php if(!empty($influencer->youtube_handle)): ?>
                            <a href="<?php echo e($influencer->youtube_handle); ?>" target="_blank" rel="noopener noreferrer"
                            class="py-2 px-3 text-sm font-medium bg-white hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <i class="fa-brands fa-youtube"></i> YouTube
                            </a>
                        <?php endif; ?>

                        <?php if(!empty($influencer->x_handle)): ?>
                            <a href="<?php echo e($influencer->x_handle); ?>" target="_blank" rel="noopener noreferrer"
                            class="py-2 px-3 text-sm font-medium bg-white hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <i class="fa-brands fa-x-twitter"></i> X
                            </a>
                        <?php endif; ?>

                        <?php if(!empty($influencer->other_handle)): ?>
                            <a href="<?php echo e($influencer->other_handle); ?>" target="_blank" rel="noopener noreferrer"
                            class="py-2 px-3 text-sm font-medium bg-white hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                Other
                            </a>
                        <?php endif; ?>
                    </div>


                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/layouts/influencers.blade.php ENDPATH**/ ?>