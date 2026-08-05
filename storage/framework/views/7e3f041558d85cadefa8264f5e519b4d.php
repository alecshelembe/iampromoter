<?php $__env->startSection('content'); ?>

<?php if(Auth::check()): ?>
    <!-- Content for authenticated users -->
        <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="max-w-4xl mx-auto bg-white rounded-lg">

                            <form id="send-push-notification" action="#" method="POST">
                                <div class="my-4">
                                    <?php echo csrf_field(); ?>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Android Push notification Service</label>
                                    <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Write your promotion."></textarea>
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

				<div class="grid w-full">
				 <div class="relative z-0 w-full mb-5 group">
	           			 <label for="options" class="block text-gray-700 mb-2">Select Device</label>
	               			   <select id="options" name="position" class=" focus:ring-blue-300 font-medium rounded-lg  w-full px-5 py-2.5 text-left dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 block border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:">
					    <option value="All">All Devices</option>
    
						    <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						        <option value="<?php echo e($device->device_id); ?>">
						            <?php echo e($device->device_name); ?> (<?php echo e($device->platform); ?>)
						        </option>
						    @endclass
					  </select>

        			        <?php $__errorArgs = ['position'];
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
				</div>
                                    <button class="text-right rounded-full text-right shadow-lg px-2 text-sm py-2"> Send </button>
                                </div>
                            </form>
</div>
<?php else: ?>
    <!-- If not authenticated, redirect to login -->
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/mobile/notify-old.blade.php ENDPATH**/ ?>