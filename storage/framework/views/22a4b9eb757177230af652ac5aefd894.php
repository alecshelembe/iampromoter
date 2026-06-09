<?php $__env->startSection('content'); ?>
<div class="mx-auto my-6 px-2">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 text-white text-center py-4">
            <h1 class="text-xl sm:text-2xl font-bold">Transaction history (30 days) </h1>
        </div>

        <!-- Content -->
        <div class="p-4 sm:p-6">
            <?php if(!empty($message)): ?>
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4 rounded">
                    <p class="font-semibold text-sm sm:text-base"><?php echo e($message); ?></p>
                </div>
            <?php endif; ?>

            <?php if($transactions && count($transactions) > 0): ?>
                <!-- Mobile-First Design -->
                <div class="space-y-4 sm:hidden">
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">#</span> <?php echo e($transaction->id); ?><?php echo''.rand(100,999); ?>
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Host</span> <?php echo e($transaction->email); ?>

                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Recipient</span> <?php echo e($transaction->email_address); ?>

                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Amount</span> R <?php echo e(number_format($transaction->amount, 2)); ?>

                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Name</span> <?php echo e($transaction->item_name ?? 'N/A'); ?>

                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Address</span> <?php echo e($transaction->item_description ?? 'N/A'); ?>

                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Status</span> 
                                <span class="px-2 py-1 rounded text-sm font-medium 
                                    <?php echo e($transaction->payment_status === 'Completed' ? 'bg-green-100 text-green-600' : 'bg-yellow-100'); ?>">
                                    <?php echo e(ucfirst($transaction->payment_status)); ?>

                                </span>
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Date:</span> <?php echo e($transaction->created_at->format('Y-m-d H:i:s')); ?>

                            </p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Standard Table for Larger Screens -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="w-full text-left table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="px-4 py-2 border text-gray-600 font-medium">#</th>
                                <th class="px-4 py-2 border text-gray-600 font-medium">Email</th>
                                <th class="px-4 py-2 border text-gray-600 font-medium">Amount</th>
                                <th class="px-4 py-2 border text-gray-600 font-medium">Item</th>
                                <th class="px-4 py-2 border text-gray-600 font-medium">Status</th>
                                <th class="px-4 py-2 border text-gray-600 font-medium">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($index % 2 === 0 ? 'bg-white' : 'bg-gray-50'); ?> border-b">
                                    <td class="px-4 py-2 border text-gray-800"><?php echo e($index + 1); ?></td>
                                    <td class="px-4 py-2 border text-gray-800"><?php echo e($transaction->email); ?></td>
                                    <td class="px-4 py-2 border text-gray-800">R<?php echo e(number_format($transaction->amount, 2)); ?></td>
                                    <td class="px-4 py-2 border text-gray-800"><?php echo e($transaction->item_name ?? 'N/A'); ?></td>
                                    <td class="px-4 py-2 border text-gray-800">
                                        <span class="px-2 py-1 rounded text-sm font-medium 
                                            <?php echo e($transaction->payment_status === 'Completed' ? 'bg-green-100 text-green-600' : 'bg-yellow-100'); ?>">
                                            <?php echo e(ucfirst($transaction->payment_status)); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border text-gray-800"><?php echo e($transaction->created_at->format('Y-m-d H:i:s')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/package/resources/views/payfast/history.blade.php ENDPATH**/ ?>