<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen py-8 px-4">

<?php
include("../../function/fetchPayment.php");
// Note: Ensure connection.php is included within fetchPayment.php or here


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cus_id  = $_POST['cus_id'] ?? null;
    $or_date = $_POST['or_date'] ?? null;

    if ($cus_id && $or_date) {
        // We pass $con here as well since functions need the connection variable
        $payment = fetchSpecificPayment( $cus_id, $or_date);

        if ($payment) {
            ?>
            <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
                <div class="bg-blue-600 p-8 text-white flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold uppercase tracking-wider">Payment Receipt</h1>
                        <p class="text-blue-100 text-sm mt-1">Transaction Verified</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs uppercase opacity-70">Date of Order</p>
                        <p class="font-mono font-bold"><?php echo htmlspecialchars($payment->or_date); ?></p>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Customer ID</p>
                            <p class="text-slate-800 font-semibold">#<?php echo htmlspecialchars($payment->cus_id); ?></p>
                        </div> -->
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Transaction ID</p>
                            <p class="text-blue-600 font-mono font-bold"><?php echo htmlspecialchars($payment->transaction_id); ?></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Payment Method</p>
                            <span class="inline-block bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                <?php echo htmlspecialchars($payment->payment_method); ?>
                            </span>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Amount Paid</p>
                            <p class="text-2xl font-black text-slate-800"><?php echo number_format($payment->Total); ?> <span class="text-sm font-normal text-slate-500">Ks</span></p>
                        </div>
                    </div>

                    <hr class="border-slate-100 mb-8">

                    <?php if (!empty($payment->pay_ss)): ?>
                        <div class="space-y-3">
                            <p class="text-sm font-bold text-slate-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Proof of Payment
                            </p>
                            <div class="bg-slate-50 p-2 rounded-2xl border border-slate-200 inline-block">
                                <img src="data:image/png;base64,<?php echo base64_encode($payment->pay_ss); ?>" 
                                     class="max-w-full h-auto rounded-xl shadow-sm hover:scale-[1.02] transition-transform duration-300" 
                                     style="max-height: 400px;">
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mt-10 flex flex-wrap gap-4 pt-6 border-t border-slate-50">
                        <button onclick="window.print()" class="bg-slate-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-900 transition-all flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Print Receipt
                        </button>
                       <!-- <a href="../../admin/components/vieworder.php?or_date=<?php echo urlencode($payment->or_date); ?>&cus_id=<?php echo urlencode($payment->cus_id); ?>" 
   class="bg-white border border-slate-200 text-slate-600 px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-50 transition-all">
    Back to Orders
</a> -->              <label for="submit" style="text-align:center;"   class="bg-blue-600  border border-slate-200 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-700 transition-all">
           
                     Deliver
                    
               
                </label>
                 <form action="../../function/validate.php" method="get" style="display:none;">
    <input type="text" style="display:none" value="<?php echo $cus_id ?>" name="cus_id"><br>
                <input type="text" style="display:none" value="<?php echo $or_date ?>" name="or_date"><br>
                 <input type="submit" id="submit">
            </form>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo "<div class='text-center p-10'><p class='text-slate-500 font-bold'>No payment record found.</p><a href='javascript:history.back()' class='text-blue-600 underline'>Go back</a></div>";
        }
    }
} else {
    header("Location: ../pages/Orders.php");
    exit();
}
?>

</body>
</html>