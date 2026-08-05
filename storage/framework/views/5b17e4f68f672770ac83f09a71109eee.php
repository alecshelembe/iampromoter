<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="max-w-4xl mx-auto bg-white rounded-lg">
    
    <div class="p-2 bg-white">

        
        <div class="mt-4">
            <div>
            
            <?php
                $images = json_decode($Post->image_url, true); // Decode JSON for a single post
            ?>

            <?php if(is_array($images) && count($images) > 0): ?>
                <div class="grid grid-cols-2 gap-2">
                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <figure class="max-w-lg relative">
                            <img class="h-auto max-w-full rounded-lg cursor-pointer" 
                                 src="<?php echo e(asset($image)); ?>" 
                                 alt="Post image"
                                 onclick="toggleImageModal('<?php echo e(asset($image)); ?>')"
                                 loading="lazy">
                        </figure>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <!-- <p>No images found.</p> -->
            <?php endif; ?>
        </div>
            <p class="text-2xl font-bold my-2"><?php echo e($Post->title); ?></p>
            <p class="text-gray-700 my-2"><?php echo $Post->description; ?></p>
                <form action=<?php echo e(route('returnSpeech')); ?> target="_blank" method="POST">
                    <?php echo csrf_field(); ?>
                    <textarea name="text" rows="4" style="display: none;" placeholder="Enter text here"><?php echo e($Post->description); ?></textarea>
                    <input type="text" name="audio_id" value="<?php echo(rand());?>" hidden>
                    <button class=" my-4 p-2 text-sm rounded-full shadow-lg" type="submit">Speech (develpment) <i class=" fa-solid fa-volume-high"></i></button>
                </form>
            <p class="text-xs text-gray-500">Posted by <?php echo e($Post->author); ?></p>
            <p class="text-xs text-gray-500"><?php echo e($Post->formatted_time); ?></p>
        </div>
          
        <div class="text-right">
            <a href="https://wa.me/?text=<?php echo e(urlencode(route('science.view.post', ['id' => $Post->id]))); ?>" 
                target="_blank" 
                class="p-2 text-sm rounded-full shadow-lg">
                <i class="fa-brands fa-whatsapp"></i> Share
            </a>
        </div>
       
    </div>
    <?php if(Auth::check()): ?>
    
    <?php if(auth()->user()->email === $Post->email): ?>

    <?php if($Post->status === 'show'): ?>
        <form action="<?php echo e(route('science.posts.hide', $Post->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button class="rounded-full shadow-lg px-2 text-sm py-2 my-2">
                <i class="fa-regular fa-eye-slash"></i> Hide my post
            </button>
        </form>
        <?php else: ?>
        <form action="<?php echo e(route('science.posts.show', $Post->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button class="rounded-full shadow-lg px-2 text-sm py-2 my-2">
                <i class="fa-regular fa-eye"></i> Show my post
            </button>
        </form>
    <?php endif; ?>
    
    <form action="<?php echo e(route('update.raw.post', $Post->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" value="<?php echo e($Post->title); ?>" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter the title" >
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-600  mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    
        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter a description"><?php echo e($Post->description); ?></textarea>
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
        </div>
    
    
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.replace('description');
        });
        </script> 
    
        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit" class="bg-blue-500 p-4 text-white rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Update
            </button>
        </div>
    </form>
    
    <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/mobile/science-post.blade.php ENDPATH**/ ?>