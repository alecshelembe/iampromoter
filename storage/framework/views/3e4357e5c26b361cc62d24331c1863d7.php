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

<div class="max-w-4xl mx-auto bg-white rounded-lg">

    
    <div class="flex justify-center my-4">
        <a 
            href="https://www.google.com/maps/search/?api=1&query=<?php echo e(urlencode($socialPost->address)); ?>" 
            target="_blank" 
            class="w-4/5 text-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
            <i class="fa-solid fa-location-dot"></i> <?php echo e($socialPost->address); ?>

        </a>
    </div>

    <div class="flex justify-center my-2">
        <p class="text-gray-700 rounded-full text-xs shadow-lg px-3 py-3 flex flex-wrap items-center gap-2">
            <?php $__currentLoopData = $socialPost->extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="flex items-center space-x-1">
                    <i class="fa-solid <?php echo e(getSectorIcon($extra)); ?> text-gray-700 text-xs"></i>
                    <span><?php echo e(ucwords(str_replace('-', ' ', $extra))); ?></span><?php if(!$loop->last): ?>, <?php endif; ?>
                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </p>
    </div>
    
    
    <div class="p-2 bg-white">
        <div>
            
            <?php
                $images = json_decode($socialPost->images, true); // Decode JSON for a single post
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
        <?php if($socialPost->status === 'show' && $socialPost->fee > 0): ?>
	<div class="flex justify-center">
                <p class="rounded-full shadow-lg px-2 text-2xl font-semibold my-2 py-2">R <?php echo e($socialPost->fee); ?></p>
        </div>
        <div class="flex justify-center my-4">
            <form action="<?php echo e(route('payfast.book-now', $socialPost->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button id="dynamicButton" class="bg-gradient-to-r from-purple-600 to-pink-500 hover:from-pink-500 hover:to-purple-600 text-white font-bold py-2 px-4 rounded-full shadow-lg transform transition-all duration-300 hover:scale-105 flex items-center gap-2">
                    <i class="fa-solid fa-fire-flame-curved"></i> Unlock the Magic!
                </button>
            </form>
            <button id="add-to-cart" value="<?php echo e(($socialPost->id)); ?>" class="py-2 mx-4 px-4 rounded-full bg-blue-100 shadow-lg hover:scale-105 flex items-center gap-2">
                <i class="fa-solid fa-cart-plus"></i>
            </button>

             <!-- Message box for displaying success or error messages -->
             
            </div>

            <div class="flex justify-center">
                <div id="message-box" class="rounded-full shadow-lg px-2 text-sm py-2 message-box"></div>
            </div>

        <?php endif; ?>

        <div class="mt-4">
        <?php if(!empty($socialPost->note)): ?>
            <div class="flex flex-col leading-1.5 p-2 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                <p class="text-sm font-normal text-gray-900 dark:text-white"> <?php echo e($socialPost->note); ?></p>
            </div>
        <?php endif; ?>

            <p class="text-lg font-medium my-2"><?php echo e($socialPost->place_name); ?></p>
            <p class="text-gray-700 my-2"><?php echo e($socialPost->description); ?></p>
            <p class="text-xs text-gray-500">Posted by <?php echo e($socialPost->author); ?> <?php echo e($socialPost->formatted_time); ?></p>
        </div>

        <div class="flex justify-center my-2 items-center space-x-2">
            <p class="text-gray-700 rounded shadow-lg px-2 text-sm py-2"><?php echo e($socialPost->floating_sectors_value); ?></p>
        </div>

        <div class="text-right my-4">
            <a href="https://wa.me/?text=<?php echo e(urlencode(route('social.view.post', ['id' => $socialPost->id]))); ?>" 
                target="_blank" 
                class="p-2 text-sm rounded-full shadow-lg">
                <i class="fa-brands fa-whatsapp"></i> Share
            </a>
        </div>

        <div class="flex justify-center p-2">
        <?php if(!empty($socialPost->video_link)): ?>
            <iframe class="video-stream html5-main-video border-4 border-gray-300 rounded-lg" 
                src="<?php echo e($socialPost->video_link); ?>" 
                frameborder="0" 
                style="width: 100%; height: 500px;" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        <?php else: ?>
            <!-- <p>No video available</p> -->
        <?php endif; ?>
    </div>
        
        <div class="mt-4">
                <?php if($influencer && $influencer->influencer && $socialPost->status == 'show'): ?>
                    <div class="p-2 bg-white border border-gray-200 rounded-lg shadow mb-6 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex flex-col items-center pb-10">
                            
                            <img style="width: 150px; height: 150px; border-radius: 50%;" 
                                class="mx-auto object-cover shadow-md m-2"  
                                src="<?php echo e(optional($influencer)->profile_image_url ? Storage::url($influencer->profile_image_url) : asset('images/default-avatar.png')); ?>" 
                                alt="<?php echo e($influencer->first_name); ?>'s image"/>

                            <p class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
                                <?php echo e($influencer->first_name); ?> 
                            </p>
			    
                            <p class="text-gray-600 text-center dark:text-gray-400 mt-2 text-sm">
                                <?php echo e($influencer->email); ?>

                            </p>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                <?php echo e($influencer->position ?? 'Influencer'); ?>

                            </span>
                            <p class="text-gray-600 text-center dark:text-gray-400 mt-2 text-sm">
                                <?php echo e($influencer->google_location ?? 'No location available'); ?>

                            </p>

                            <?php
                                $socialLinks = [
                                    'instagram' => ['url' => $influencer->instagram_handle, 'icon' => 'fa-instagram', 'name' => 'Instagram'],
                                    'linkedin' => ['url' => $influencer->linkedin_handle, 'icon' => 'fa-linkedin', 'name' => 'LinkedIn'],
                                    'tiktok' => ['url' => $influencer->tiktok_handle, 'icon' => 'fa-tiktok', 'name' => 'TikTok'],
                                    'youtube' => ['url' => $influencer->youtube_handle, 'icon' => 'fa-youtube', 'name' => 'YouTube'],
                                    'x' => ['url' => $influencer->x_handle, 'icon' => 'fa-x-twitter', 'name' => 'X'],
                                    'other' => ['url' => $influencer->other_handle, 'icon' => '', 'name' => 'Other']
                                ];
                            ?>

                            <div class="flex flex-wrap justify-center mt-4 space-x-2">
                                <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($link['url'])): ?>
                                        <a href="<?php echo e($link['url']); ?>" target="_blank" rel="noopener noreferrer" 
                                            class="py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            <i class="fa-brands <?php echo e($link['icon']); ?>"></i> <?php echo e($link['name']); ?>

                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                        </div>
                    </div>
                <?php endif; ?>

                <div>
                    <?php if(Auth::check()): ?>

                        
                        <?php if(auth()->user()->email === $socialPost->email): ?>
                            <?php if($socialPost->status === 'show'): ?>
                                <form action="<?php echo e(route('posts.hide', $socialPost->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button class=" rounded-full shadow-lg px-2 text-sm py-2"><i class="fa-regular fa-eye-slash"></i> Hide my post</button>
                                </form>
                            <?php else: ?>
                                <form action="<?php echo e(route('posts.show', $socialPost->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button class="rounded-full shadow-lg px-2 text-sm py-2"><i class="fa-regular fa-eye"></i> Show my post</button>
                                </form>
                            <?php endif; ?>

                            <form id="update-post-name" action="<?php echo e(route('social.save.post.name', $socialPost->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <!-- Name -->
                                <div class="my-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Post Name</label>
                                    <input type="text" name="place_name" value="<?php echo e($socialPost->place_name); ?>" id="place_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Name of your venture" />
                                    <?php $__errorArgs = ['place_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-600 mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <button class="text-right rounded-full text-right shadow-lg px-2 text-sm py-2"> Update</button>
                                </div>
                            </form>

                            <form id="upload-post-fee" action="<?php echo e(route('social.save.post.fee', $socialPost->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                               <!-- Price -->
                                <div class="my-4">
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (R)</label>
                                    <input 
                                        type="number" 
                                        name="fee" 
                                        value="50.00" 
                                        step="5.00" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter price e.g. 99.99" 
                                    />
                                <?php $__errorArgs = ['fee'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-600 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <button class="text-right rounded-full text-right shadow-lg px-2 text-sm py-2"> Update</button>
                                </div>
                            </form>

                            <form id="update-post-description" action="<?php echo e(route('social.save.post.description', $socialPost->id)); ?>" method="POST">
                                <div class="my-4">
                                    <?php echo csrf_field(); ?>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <p class="my-3">Here you can update your post description how you make the experiance memorable. </p>
                                    <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Write your promotion."> <?php echo e($socialPost->description); ?></textarea>
                                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-600 mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <button class="text-right rounded-full text-right shadow-lg px-2 text-sm py-2"> Update</button>
                                </div>
                            </form>

                            <form id="upload-post-note" action="<?php echo e(route('social.save.post.note', $socialPost->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <!-- Name -->
                                <div class="my-4">
                                    <label for="Note" class="block text-sm font-medium text-gray-700 mb-2">Add a note (250)</label>
                                    <input type="text" maxlength="250" name="note" value="<?php echo e($socialPost->note); ?>" id="note" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Add an update here" />
                                    <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-600 mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <button class="text-right rounded-full text-right shadow-lg px-2 text-sm py-2"> Update</button>
                                </div>

                            </form>

                            <form id="upload-post-video-link" action="<?php echo e(route('social.save.post.link', $socialPost->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <!-- Name -->
                                <div class="my-4">
                                    <label for="Video" class="block text-sm font-medium text-gray-700 mb-2">Link extranal video (Convert to Embeded (Youtube) link before upload)</label>
                                    <input type="text" maxlength="250" name="video-link" value="<?php echo e($socialPost->video_link); ?>" id="video-link" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Click Share on Youtube video for the embeded link" />
                                    <?php $__errorArgs = ['video-link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-600 mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <button class="text-right rounded-full text-right shadow-lg px-2 text-sm py-2"> Upload link</button>
                                </div>

                            </form>

			<form id="upload-post-social_p" action="<?php echo e(route('social.save.post.socialp', $socialPost->id)); ?>" method="POST">
				<?php echo csrf_field(); ?>
				<label class="inline-flex items-center cursor-pointer">
            				Make this show on the Landing page + Promotion App 
					<input type="radio" name="social_p" value="1" class="p-2 m-4"
                                         <?php echo e($socialPost->social_p === 1 ? 'checked' : ''); ?>> Web Only

                                        <input type="radio" name="social_p" value="2" class="p-2 m-4"
                                        <?php echo e($socialPost->social_p === 2 ? 'checked' : ''); ?>> App + Landing page
				</label>

	                        <button class="text-right rounded-full text-right shadow-lg px-2 text-sm py-2"> Update</button>

				<?php $__errorArgs = ['social_p'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                		    <p class="text-red-600  mt-1"><?php echo e($message); ?></p>
                		<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

			</form>

                        <?php endif; ?>
                    <?php endif; ?>
                    </div>
                        <h3 class=" text-sm ">Comments:</h3>

                            
                            <?php if($socialPost->comments && count($socialPost->comments) > 0): ?>
                                <?php $__currentLoopData = $socialPost->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div>
                                    
                                    <?php
                                        $emailParts = explode('@', $comment['author']);
                                        $author = $emailParts[0];  // Get the part before the '@'
                                    ?>

                                    <p><strong><?php echo e($author); ?></strong> <?php echo e($comment['content']); ?></p>
                                    <p class="text-xs text-gray-500">
                                        Posted <?php echo e(\Carbon\Carbon::parse($comment['updated_at'])->diffForHumans()); ?>

                                    </p>
                                <?php if(Auth::check()): ?>

                                    <?php if(auth()->user()->email === $socialPost->email): ?>
                                        <form class="text-right mt-4" action="<?php echo e(route('comments.clear', [$socialPost->id])); ?>" method="POST">
                                            <input type="text" class="hidden" name="comment_id" value="<?php echo e(($comment['id'])); ?>"/>
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="p-2 text-sm rounded-full shadow-lg">  <i class="fa-solid fa-xmark"></i> Clear </button>
                                        </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p>Be the first to leave a comment.</p>
                            <?php endif; ?>

                            
                            <span  class="text-sm my-2 text-red-500 font-bold">*Note only the author of this post can manage the comment section</span>

                            <form action="<?php echo e(route('comments.store', $socialPost->id)); ?>" method="POST" class="mt-4">
                                <?php echo csrf_field(); ?>
                                <div class="mb-2">
                                    <textarea name="content" placeholder="Your comment" class="w-full p-2 border rounded" required></textarea>
                                </div>
                                <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-600  mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <button type="submit" class="p-2 text-sm rounded-full shadow-lg">  <i class="fa-regular fa-comment"></i> Post my comment</button>
                            </form>
                        </div> 
                    </div>
                </div>


                <script>
                    const phrases = [
                        "Buy Now!",
                         "Shop Now!",
                         "Get Yours!",
                         "Grab It!",
                         "Claim Yours!",
                         "Limited Time Offer!",
                         "Act Fast!",
                    ];

                    // Function to update the button text randomly
                    function updateButtonText() {
                        const randomPhrase = phrases[Math.floor(Math.random() * phrases.length)];
                        document.getElementById("dynamicButton").innerHTML = `<i class="fa-solid fa-fire-flame-curved"></i> ${randomPhrase}`;
                    }
                    
                    // Call the function to set a random phrase on load
                    window.onload = updateButtonText;
                </script>
                <script>
                    $(document).ready(function() {
                            // Get a reference to the message box element
                            const messageBox = $('#message-box');

                            // Function to display messages
                            function showMessage(message, type) {
                                messageBox.text(message);
                                messageBox.removeClass('success error').addClass(type);
                                messageBox.fadeIn(400).delay(2000).fadeOut(400); // Fade in, show for 2s, then fade out
                            }

                            // Attach a click event listener to the button with the ID 'add-to-cart'
                            $('#add-to-cart').on('click', function() {
                                // Get the 'value' attribute of the clicked button
                                const postId = $(this).val();

                                // Retrieve the CSRF token from the meta tag
                                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                                // Log the value to the console to verify it's captured correctly
                                console.log('Button clicked! Post ID:', postId);

                                // Perform an AJAX POST request
                                $.ajax({
                                    // The URL where you want to send the data.
                                    // Replace 'your-backend-endpoint.php' with the actual path to your server-side script.
                                    url: '<?php echo e(route('add_to_cart', ['id' => ':postId'])); ?>'.replace(':postId', postId),

                                    // The HTTP method to use (POST is common for sending data)
                                    method: 'POST',
                                    // The data to be sent to the server, now including the CSRF token.
                                    data: {
                                        postId: postId,
                                        _token: csrfToken // Include the CSRF token here
                                    },
                                    // Set dataType to 'json' if your backend is expected to return JSON.
                                    // If your backend returns plain text or HTML, adjust this accordingly or omit it.
                                    dataType: 'json',
                                    // Function to be called if the AJAX request is successful
                                    success: function(response) {
                                        console.log('AJAX request successful:', response);
                                        // You can handle the response from the server here.
                                        // For example, display a success message to the user.
                                        if (response.status === 'success') {
                                            showMessage('Item added to cart successfully!', 'success');
                                            // Optionally, update UI here, like disabling the button or changing its text
                                            setTimeout(function() {window.history.back();}, 5000);

                                        } else {
                                            showMessage('' + (response.message || 'Unknown error'), 'error');
                                        }
                                    },
                                    // Function to be called if the AJAX request fails (e.g., network error, server error)
                                    error: function(xhr, status, error) {
                                        console.error('AJAX request failed:', status, error);
                                        console.error('Response Text:', xhr.responseText);
                                        // Display an error message to the user
                                        showMessage('Error adding item to cart. Please try again.', 'error');
                                    }
                                });
                            });
                        });
                </script>
                <?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/mobile/social-post.blade.php ENDPATH**/ ?>