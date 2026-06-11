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

    
    <?php if($posts->isEmpty() && $socialPosts->isEmpty()): ?>
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5>No Posts here..</h5>
        </div>
    <?php else: ?>
        

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
            
            <?php
                $combinedPosts = collect();

                // Merge $posts and $socialPosts into one collection
                $combinedPosts = $combinedPosts->merge($posts)->merge($socialPosts);

                // Sort the combined posts by created_at in descending order
                $combinedPosts = $combinedPosts->sortByDesc('created_at');
            ?>

            
            <?php $__currentLoopData = $combinedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isSocialPost = isset($post->social_p); // Check if it's a social post
                ?>

                <div class="bg-white p-2 rounded-lg shadow">
                    
                    <?php if(!$isSocialPost): ?>

                        <div>
                            
                            <?php
                                $images = json_decode($post->image_url, true); // Decode JSON for a single post
                            ?>

                            <?php if(is_array($images) && count($images) > 0): ?>
                                <div class="grid grid-cols-2 gap-2">
                                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <figure class="max-w-lg relative">
                                            <img class="h-auto max-w-full rounded-lg cursor-pointer" 
                                                src="<?php echo e(asset($image)); ?>" 
                                                alt="Post image"
                                                loading="lazy"
                                                onclick="toggleImageModal('<?php echo e(asset($image)); ?>')">
                                        </figure>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <!-- <p>No images found.</p> -->
                            <?php endif; ?>
                        </div>
                        
                        <h3 class="mb-2"><?php echo e($post->title); ?></h3>

                        
                        <p class="text-sm mt-2">
                            <?php if($post->verified == 1 || $post->plate == 1 ): ?>
                                <i class="fa-solid fa-clipboard-check"></i> App + Web 
                            <?php else: ?>
                                <i class="fa-solid fa-square-check"></i> Web
                            <?php endif; ?>
                        </p>

                        
                        <?php if($post->description): ?>
                            
                            <div class="mt-2 text-gray-700 overflow-hidden"
                                style="max-height: 4.5em; line-clamp: 3; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;"
                                id="description-<?php echo e($post->id); ?>">
                                <?php echo $post->description; ?>

                            </div>

                            
                            <button class="text-blue-500 text-sm mt-2"
                                    onclick="toggleText('<?php echo e($post->id); ?>', this)">
                                More
                            </button>
                        <?php endif; ?>

                        <script>
                            /**
                             * Toggle truncation for a specific description.
                             * @param {string} id - The ID of the description element to toggle.
                             * @param {HTMLElement} button - The button that toggles the truncation.
                             */
                            function toggleText(id, button) {
                                const description = document.getElementById(`description-${id}`);
                                if (description.style.maxHeight === "4.5em") {
                                    description.style.maxHeight = "none"; // Remove truncation
                                    description.style.webkitLineClamp = "unset"; // Remove line clamp
                                    button.innerText = "Less"; // Change button text
                                } else {
                                    description.style.maxHeight = "4.5em"; // Reapply truncation
                                    description.style.webkitLineClamp = "3"; // Reapply line clamp
                                    button.innerText = "More"; // Change button text
                                }
                            }
                        </script>

                        
                        <?php if($post->plate === 1): ?>
                            <div class="mt-4">
                                <img class="w-full h-auto rounded" src="<?php echo e($post->image_url); ?>" alt="">
                            </div>
                        <?php endif; ?>

                        
                        <div class="mt-2 text-sm text-gray-400">
                            <p><?php echo e($post->formatted_time); ?></p>
                        </div>
                        

                        <div class="text-right">
                            <a href="<?php echo e(route('science.view.post', ['id' => $post->id])); ?>"
                            class="p-2 text-sm rounded-full shadow-lg">
                                View
                            </a>
                        </div>
                    <?php endif; ?>

                    
                    <?php if($isSocialPost): ?>
                        <?php
                            $images = json_decode($post->images, true); // Decode JSON
                        ?>

                        <?php if(is_array($images) && count($images) > 0): ?>
                            <div class="grid grid-cols-2 gap-2">
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <figure class="relative">
                                        <img class="h-auto max-w-full rounded-lg cursor-pointer" src="<?php echo e(asset($image)); ?>" alt="Post image" loading="lazy" onclick="toggleImageModal('<?php echo e(asset($image)); ?>')">
                                    </figure>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        
                        <div class="mt-4 flex items-center space-x-3">
                            <!-- User Avatar -->
                            <img  
                                src="<?php echo e(Storage::url($post->profile_image_url)); ?>"  
                                name="image" 
                                onclick="toggleImageModal('<?php echo e(Storage::url($post->profile_image_url)); ?>')"
                                loading="lazy"
                                alt="Image Preview"  
                                style="width: 50px; height: 50px; border-radius: 50%;" 
                                class="object-cover shadow-md" 
                            />

                            <!-- Post Details -->
                            <div class="flex-1">
                	        <p class=""><?php echo e($post->place_name); ?></p>
				<p class="text-sm font-bold">R <?php echo e($post->fee); ?></p>
				 
 		                 <p class="text-sm mt-2">
	                            <?php if($post->social_p == 2 ): ?>
	                                <i class="fa-solid fa-clipboard-check"></i> App + Web 
	                            <?php else: ?>
	                                <i class="fa-solid fa-square-check"></i> Web
	                            <?php endif; ?>
	                        </p>
                                <p class="text-sm text-gray-700 my-2">  <?php echo e(Str::limit($post->description, 100)); ?></p>
                                <!-- <p class="text-sm text-grey-500">R <?php echo e($post->fee); ?></p> -->
                                <p class="text-sm text-gray-600"><?php echo e($post->address); ?></p>
                                <p class="text-xs text-gray-500">Posted by <?php echo e($post->author); ?></p>
                                <?php if(!empty($post->note)): ?>
                                <div class="flex flex-col leading-1.5 p-2 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                    <p class="text-sm font-normal text-gray-900 dark:text-white "  title="<?php echo e($post->note); ?>">  <?php echo e(Str::limit($post->note, 25)); ?></p>
                                </div>
                                <?php endif; ?>
                                <p class="text-xs text-gray-400"><?php echo e($post->formatted_time); ?></p>
                            </div>

                            <!-- View Button -->
                            <div>
                            <?php if(Auth::check()): ?>
                                <a href="<?php echo e(route('social.view.post', ['id' => $post->id])); ?>" class="p-2 text-sm rounded-full shadow-lg bg-blue-600 text-white">
                                    View
                                </a>
                            <?php elseif(Auth::guard('google_users')->check()): ?>
                                <a href="<?php echo e(route('google.social.view.post', ['id' => $post->id])); ?>" class="p-2 text-sm rounded-full shadow-lg bg-blue-600 text-white">
                                    View
                                </a>
                            <?php else: ?>
                               
                            <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/layouts/viewboth.blade.php ENDPATH**/ ?>