<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

<div class="flex justify-end my-2">
    <button id="toggleView" class="px-4 py-2 text-white bg-blue-500 rounded-lg">
        <i class="fa-regular fa-eye"></i> 
    </button>
</div>

<?php if(count($results) > 0): ?>
    <div class="flex justify-center">
        <div class="bg-gradient-to-r from-purple-600 to-pink-500 hover:from-pink-500 hover:to-purple-600 text-white py-2 px-4 rounded-full shadow-lg transform transition-all duration-300 hover:scale-105 flex items-center gap-2">    
            <form action="<?php echo e(route('payfast.book-now.checkout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="amount" value="<?php echo e(number_format($totalFee, 2)); ?>">
                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="results[]" value="<?php echo e($result->id); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <button type="submit" class="p-2">R <span id="totalFee"><?php echo e(number_format($totalFee, 2)); ?></span> <i class="fa-solid fa-fire-flame-curved"></i> Proceed to Checkout! </button>
                </form>
            </div>
        </div>
    <?php endif; ?>


    <div id="postContainer" class="grid grid-cols-2 gap-4 mt-4 lg:grid-cols-4">
        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="p-2 bg-white" data-fee="<?php echo e($post->fee); ?>">
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

                    <p class="text-sm text-gray-700 "><?php echo e($post->place_name); ?></p>
                    <p class="text-sm text-grey-500">R <?php echo e($post->fee); ?></p>
                    <!-- <p class="text-sm text-gray-700"><?php echo e($post->address); ?></p> -->

                    <div>
                        <button type="button"
                                class="remove-from-cart-btn p-2 text-sm rounded-full shadow-lg"
                                data-post-id="<?php echo e($post->id); ?>">
                            Remove
                        </button>
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
            postContainer.classList.remove('grid', 'grid-cols-2', 'lg:grid-cols-4');
            postContainer.classList.add('flex', 'flex-col');
        } else {
            postContainer.classList.remove('flex', 'flex-col');
            postContainer.classList.add('grid', 'grid-cols-2', 'lg:grid-cols-4');
        }
        isGrid = !isGrid;
    });

    document.addEventListener('DOMContentLoaded', function() {
        const removeButtons = document.querySelectorAll('.remove-from-cart-btn');
        const totalFeeSpan = document.getElementById('totalFee');

        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;
                const postCard = this.closest('.p-2.bg-white');
                const url = `/remove-from-cart/${postId}`;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        if (postCard) {
                            const fee = parseFloat(postCard.dataset.fee) || 0;
                            const currentTotal = parseFloat(totalFeeSpan.textContent.replace(/,/g, '')) || 0;
                            const newTotal = Math.max(currentTotal - fee, 0).toFixed(2);

                            totalFeeSpan.textContent = newTotal;

                            postCard.remove();
                        }
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing the item.');
                });
            });
        });
    });
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/layouts/checkout.blade.php ENDPATH**/ ?>