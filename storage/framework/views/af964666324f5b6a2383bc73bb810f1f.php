<?php $__env->startSection('content'); ?>
<script defer src="<?php echo e(asset('js/search.js')); ?>"></script>

    <div class="">
    <?php if(Auth::check()): ?> 
        <div class="text-center my-2">
            <a href="<?php echo e(route('home')); ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-blue-100 dark:text-white">
                <i class="fa-solid fa-check"></i> Return to homepage
            </a>
        </div>
    <?php elseif(Auth::guard('google_users')->check()): ?>
        <div class="text-center my-1">
            <a href="<?php echo e(route('users.logout')); ?>" class="inline-flex items-center bg-white hover:bg-gray-100 border border-gray-300 rounded-md py-2 px-4 font-medium text-sm text-gray-700 shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <i class="fab fa-google mr-2"></i> Log out (Google)
            </a>
        </div>
    <?php else: ?>
        <div class="text-center my-1">
            <a href="<?php echo e(route('login')); ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-blue-100 dark:text-white">
                <i class="fa-solid fa-door-open"></i> Click here to see more content
            </a>
        </div>
    <?php endif; ?>

    <div class='flex justify-center text-center'>
        <div class='max-w-3xl mx-auto p-3 bg-white'>
            <h2 class='text-xl font-bold mb-1 text-gray-800'>Welcome to Collaborations</h2>
            <h1 class="text-gray-600">
                <!-- Welcome <br>
                <a href="mailto:promotions@visitmyjoburg.co.za" class="text-gray-600">
                    <i class="fa-solid fa-envelope"></i> promotions@visitmyjoburg.co.za
                </a> --> 
                <a href="https://github.com/alecshelembe/iampromoter-collaboration-platform/releases/APK"class="inline-flex items-center mt-4 text-green-600 hover:text-green-800" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-android text-2xl mr-2"></i>
                   Download App </a>
                </a> 
            </h1>

            <div class="text-center my-4">
                <a href="<?php echo e(route('show-map')); ?>" class="bg-blue-500 text-white btn-sm py-2 px-2 rounded-full hover:bg-blue-600">
                <!-- Plus icon -->
                <i class="fa-solid fa-map-location-dot"></i>
                Open map 
                </a>
            </div>
            
            <form id="searchForm">
                <label for="searchQuery" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="searchQuery" class="block w-full my-1 p-2 ps-10 text-gray-900 border rounded-lg" placeholder="Search for a social post" required />
                </div>
            </form>
        </div>
    </div>

    <div id="searchResults"></div>

    <?php if($socialPosts->isEmpty()): ?>
        <div class="p-4 text-center">
            <h5>No posts available.</h5>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php $__currentLoopData = $socialPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $images = json_decode($post->images, true);
                ?>
                <div class="p-4 bg-white shadow-md rounded-lg">

                    <?php if(is_array($images) && count($images) > 0): ?>
                        <div class="grid grid-cols-2 gap-2">
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <figure class="relative">
                                    <img class="h-auto max-w-full rounded-lg" src="<?php echo e(asset($image)); ?>" alt="Post image" loading="lazy">
                                </figure>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?> 
                    <div class="mt-4 flex items-center space-x-3">
                        <img src="<?php echo e($post->profile_image_url ? Storage::url($post->profile_image_url) : asset('default-profile.png')); ?>" 
                             alt="Profile Image" class="object-cover shadow-md"                                 style="width: 50px; height: 50px; border-radius: 50%;"/>
                         <div class="flex-1">
                                <p class=""><?php echo e($post->place_name); ?></p>
				<?php if($post->status === 'show' && $post->fee > 0): ?>
                                	<p class=" text-grey-500">R <?php echo e($post->fee); ?></p>
				<?php endif; ?>
                                <!-- <p class="text-sm font-bold">R <?php echo e($post->fee); ?></p> -->
                                <p class="text-sm text-gray-700 my-2">  <?php echo e(Str::limit($post->description, 100)); ?></p>
                                <p class="text-sm text-gray-600"><?php echo e($post->address); ?></p>
                                <p class="text-xs text-gray-500">Posted by <?php echo e($post->author); ?></p>
                                <?php if(!empty($post->note)): ?>
                                <div class="flex flex-col leading-1.5 p-2 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                    <p class="text-sm font-normal text-gray-900 dark:text-white "  title="<?php echo e($post->note); ?>">  <?php echo e(Str::limit($post->note, 25)); ?></p>
                                </div>
                                <?php endif; ?>
                                <p class="text-xs text-gray-400"><?php echo e($post->formatted_time); ?></p>
                            </div>
                        <div>
                        <?php if(Auth::check()): ?>
                            <a href="<?php echo e(route('social.view.post', ['id' => $post->id])); ?>" class="p-2 text-sm bg-green-500 text-white rounded-full shadow-lg hover:bg-blue-600">
                                Open
                            </a>
                        <?php elseif(Auth::guard('google_users')->check()): ?>
                            <a href="<?php echo e(route('google.social.view.post', ['id' => $post->id])); ?>" class="p-2 text-sm bg-green-500 text-white rounded-full shadow-lg hover:bg-blue-600">
                                Open
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('social.view.post', ['id' => $post->id])); ?>" class="p-2 text-sm bg-blue-500 text-white rounded-full shadow-lg hover:bg-green-600">
                                Login
                            </a>
                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/layouts/landing.blade.php ENDPATH**/ ?>