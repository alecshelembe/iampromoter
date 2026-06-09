<?php $__env->startSection('content'); ?>

<!-- Blade Template Button -->

<div class="max-w-4xl mx-auto p-6 bg-white  rounded-lg mt-10">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Create a raw post</h1>


    <form action="<?php echo e(route('save.raw.post')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter the title" >
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
          <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter a description"><?php echo e(old('description', request()->query('text'))); ?></textarea>
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

         <!-- Image Upload -->
         <p>Upload Images * No edits (later changes)</p>
        <div class="grid grid-cols-2 gap-4 my-4">
            <?php for($i = 1; $i <= 4; $i++): ?>
                <figure class="max-w-lg relative">
                    <img id="img-<?php echo e($i); ?>" class="h-auto max-w-full rounded-lg cursor-pointer" 
                        src="<?php echo e(asset('/storage/images/default-camera.jpg')); ?>" alt="image description">
                    <input type="file" id="file-input-<?php echo e($i); ?>" class="hidden" name="images[]" accept="image/*">
                </figure>
            <?php endfor; ?>
        </div>
        
        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit" class="bg-blue-500 p-4 text-white rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Save
            </button>
        </div>
    </form>

    <script defer src="<?php echo e(asset('js/browser-image-compression.js')); ?>"></script>
    <script>
  // Function to compress and preview image before uploading
  async function handleImageUpload(imgId, inputId) {
    const imgElement = document.getElementById(imgId);
    const fileInput = document.getElementById(inputId);

    imgElement.addEventListener('click', () => {
      fileInput.click();
    });

    fileInput.addEventListener('change', async (event) => {
      const file = event.target.files[0];
      if (file) {
        try {
          // Compress the image
          const compressedBlob = await imageCompression(file, {
            maxSizeMB: 1,   // Max size 1MB
            maxWidthOrHeight: 1920,  // Resize to max width/height 1920px
            useWebWorker: true
          });

          // Convert the Blob back to a File object
          const compressedFile = new File([compressedBlob], file.name, { type: file.type });

          // Preview the compressed image
          const reader = new FileReader();
          reader.onload = (e) => {
            imgElement.src = e.target.result;  // Preview the compressed image
          };
          reader.readAsDataURL(compressedFile);  // Use the compressed file

          // Update the file input with the compressed file
          const dataTransfer = new DataTransfer();
          dataTransfer.items.add(compressedFile);
          fileInput.files = dataTransfer.files;
          console.log("Image compression successful");
          
        } catch (error) {
          console.error("Image compression failed:", error);
        }
      }
    });
  }

  // Apply the function to each image and file input pair
  handleImageUpload('img-1', 'file-input-1');
  handleImageUpload('img-2', 'file-input-2');
  handleImageUpload('img-3', 'file-input-3');
  handleImageUpload('img-4', 'file-input-4');
</script>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/ocr_result.blade.php ENDPATH**/ ?>