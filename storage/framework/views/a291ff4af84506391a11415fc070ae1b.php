<?php $__env->startSection('content'); ?>

<script defer src="<?php echo e(asset('js/app.js')); ?>"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(config('services.google_maps.api_key')); ?>&loading=async&libraries=places" defer></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // For first name
        var firstNameInput = document.getElementById('floating_first_name');
        var firstNameOutput = document.getElementById('output-card-person-firstname');

        if (firstNameInput && firstNameOutput) {
            firstNameInput.addEventListener('input', function() {
                firstNameOutput.textContent = this.value;
            });
        }

        // For last name
        var lastNameInput = document.getElementById('floating_last_name');
        var lastNameOutput = document.getElementById('output-card-person-lastname');

        if (lastNameInput && lastNameOutput) {
            lastNameInput.addEventListener('input', function() {
                lastNameOutput.textContent = ' ' + this.value;
            });
        }
    });
</script>


<div class='max-w-3xl mx-auto p-3 bg-white'>
<form class="space-y-6 animate-fadeIn" action="<?php echo e(route('users.store')); ?>" enctype="multipart/form-data" method="post">
    <?php echo csrf_field(); ?>
    <?php if($decoded_email): ?>
        <p class="text-gray-500 text-sm">Reference: <?php echo e($decoded_email); ?></p>
        <?php $__errorArgs = ['ref'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-600  mt-1"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <input type="text" name="ref" value="<?php echo e($fullemail); ?>" class="hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
    <?php else: ?>
        
    <?php endif; ?>
    
    <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="floating_first_name" value="<?php echo e(old('floating_first_name')); ?>" id="floating_first_name" class="block py-2.5 px-0 w-full  text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required placeholder=""  />
            <label for="floating_first_name" class="peer-focus:font-medium absolute  text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Enter your first name</label>
            <?php $__errorArgs = ['floating_first_name'];
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
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="floating_last_name" value="<?php echo e(old('floating_last_name')); ?>" id="floating_last_name" class="block py-2.5 px-0 w-full  text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required placeholder=""  />
            <label for="floating_last_name" class="peer-focus:font-medium absolute  text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Enter your last name</label>
            <?php $__errorArgs = ['floating_last_name'];
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
    
<!-- </div> -->
<div class="grid md:grid-cols-2 md:gap-6">
    <div class="relative z-0 w-full mb-5 group">
        <input type="email" name="floating_email" value="<?php echo e(old('floating_email')); ?>" id="floating_email" class="block py-2.5 px-0 w-full  text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required placeholder=""  />
        <label for="floating_email" class=" md:text-sm lg:text-sm truncate truncate peer-focus:font-medium absolute  text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"><i class="fa-regular fa-envelope"></i> : Enter e-mail address</label>
        <?php $__errorArgs = ['floating_email'];
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
        <div class="relative z-0 w-full mb-5 group">
            <input type="tel" pattern="^0\d{9}" placeholder="" maxlength="10" name="floating_phone" value="<?php echo e(old('floating_phone')); ?>" id="floating_phone" class="block py-2.5 px-0 w-full  text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
            <label for="floating_phone" class=" md:text-sm truncate peer-focus:font-medium absolute  text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"><i class="fa-solid fa-phone"></i> : Enter phone number</label>
            <?php $__errorArgs = ['floating_phone'];
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
    <div class="grid w-full">
        <span class=" text-gray-500"> <i class="fa-solid fa-location-dot"> </i> : Enter Address <i class="fa-solid fa-circle-check"></i> address search (optional)</span>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="floating_address" value="<?php echo e(old('floating_address')); ?>" id="floating_address" class="block py-2.5 px-0 w-full  text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <!-- <label for="floating_address" class="peer-focus:font-medium absolute  text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Enter Street name...</label> -->
            <?php $__errorArgs = ['floating_address'];
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
    
    <div class="grid w-full">
        <div class="relative z-0 w-full mb-5 group">
            <!-- Image Input Container -->
            <label for="floating_prfile_image" class="mb-5 peer-focus:font-medium absolute  text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Upload a profile photo (optional)</label>
            <input type="file" name="image" id="image-upload" class="mt-4 block w-full  text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/*" onchange="previewImage(event)" />
        </div>
        <?php $__errorArgs = ['image'];
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
    <div class="hidden">
        <input type="text" name="google_location" id="google_location" value="<?php echo e(old('google_location')); ?>" class=" text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
        <input type="text" name="google_latitude" id="google_latitude" value="<?php echo e(old('google_latitude')); ?>" class=" text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
        <input type="text" name="google_longitude" id="google_longitude" value="<?php echo e(old('google_longitude')); ?>" class=" text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
        <input type="text" name="google_location_type" id="google_location_type" value="<?php echo e(old('google_location_type')); ?>" class=" text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
        <input type="text" name="google_postal_code" id="google_postal_code" value="<?php echo e(old('google_postal_code')); ?>" class=" text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
        <input type="text" name="google_city" id="google_city" value="<?php echo e(old('google_city')); ?>" class=" text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
        <input type="text" name="package_selected" id="package_selected" value="<?php echo e(old('package_selected')); ?>" class=" text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
        <input type="text" name="web_source" id="web_source" value="<?php echo e(old('web_source')); ?>" class=" text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
        <input type="text" name="location_id" id="location_id" value="<?php echo e(old('location_id')); ?>" class=" text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
    </div>

          <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <input type="password" autocomplete="new-password" name="password" id="floating_password" class="block py-2.5 px-0 w-full  text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                <label for="floating_password" class="peer-focus:font-medium absolute  text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Enter a password</label>
                <?php $__errorArgs = ['password'];
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
            <div class="relative z-0 w-full mb-5 group">
                <input type="password" name="password_confirmation" autocomplete="new-password" id="floating_repeat_password" class="block py-2.5 px-0 w-full  text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                <label for="floating_repeat_password" class="peer-focus:font-medium absolute  text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Re-enter password</label>
                <?php $__errorArgs = ['password_confirmation'];
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
        <div class="grid w-full">
            <div class="relative z-0 w-full mb-5 group">
            <label for="options" class="block text-gray-700 mb-2">select an option:</label>
                <select id="options" name="position" class=" focus:ring-blue-300 font-medium rounded-lg  w-full px-5 py-2.5 text-left dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 block border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:">
                    <option value="Visitor" <?php echo e(old('position') == 'Visitor' ? 'selected' : ''); ?>>Visitor</option>
                    <option value="Student" <?php echo e(old('position') == 'Student' ? 'selected' : ''); ?>>Student</option>
                    <option value="Promoter" <?php echo e(old('position') == 'Promoter' ? 'selected' : ''); ?>>Promoter</option>
                    <!-- <option value="content-moderator" <?php echo e(old('position') == 'content-moderator' ? 'selected' : ''); ?>>Content moderator</option> -->
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

        <div class="w-full">
            <div class=" ">
                <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions" class="mr-2 leading-tight" required/>
                <label for="terms_and_conditions" class=" text-gray-900 dark:text-white">
                    I agree to the <a  href="<?php echo e(route('termsandconditions')); ?>" class="text-blue-600 dark:text-blue-500 hover:underline">Terms and Conditions</a>
                </label>
            </div>
        </div>
    
        <!-- ///////////////////// -->
         
        <div class="max-w-sm rounded overflow-hidden">
            <!-- Image Preview -->
                <div>
                <!-- <img id="image-preview" src="" name="image" alt="Image Preview"  style="width: 50%; height: 50%;" class="mx-auto hidden rounded-full object-cover rounded-md shadow-md" /> -->
                <img id="image-preview" 
                    src="" 
                    name="image" 
                    alt="Image Preview"  
                    style="width: 150px; height: 150px; border-radius: 50%;" 
                    class="mx-auto hidden object-cover shadow-md" />
                </div>
                <p class="mx-auto text-center"><span id="output-card-person-firstname" class="font-bold text-xl mb-2"></span><span id="output-card-person-lastname" class="font-bold text-xl mb-2"></span></p>
            
            </div>
                <!-- <div class="px-6 pt-4 pb-2"> -->
                    <!-- <span class="inline-block bg-gray-200 rounded-full px-3 py-1  font-semibold text-gray-700 mr-2 mb-2">#photography</span> -->
                    <!-- <span class="inline-block bg-gray-200 rounded-full px-3 py-1  font-semibold text-gray-700 mr-2 mb-2">#travel</span> -->
                    <!-- <span class="inline-block bg-gray-200 rounded-full px-3 py-1  font-semibold text-gray-700 mr-2 mb-2">#winter</span> -->
                <!-- </div> -->
        <!-- ///////////////////////////// -->
         
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  w-full  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create account</button>
        <div class=" font-medium text-gray-500 dark:text-gray-300">
            Already registered? <a href="<?php echo e(route('login')); ?>" class="text-blue-700 hover:underline dark:text-blue-500">Login</a>
        </div>
    </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/create.blade.php ENDPATH**/ ?>