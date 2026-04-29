<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Payment Details</title>
    <style>
        /* Hidden Radio Styling */
        .payment-radio:checked + div {
            border-color: #3b82f6;
            background-color: #eff6ff;
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.2);
        }
        /* Image hover effect */
        .payment-box:hover img {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-slate-50 flex justify-center items-center min-h-screen p-4">

    <div class="bg-white rounded-[2rem] shadow-2xl p-8 w-full max-w-3xl border border-gray-100">
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-slate-800">Payment Details</h2>
            <p class="text-sm text-slate-500 font-medium">Step 2 of 2 • Complete your purchase</p>
            <div class="w-full bg-gray-100 h-1.5 mt-4 rounded-full overflow-hidden">
                <div class="bg-blue-600 h-full w-full rounded-full"></div>
            </div>
        </div>

        <form action="../function/process_payment.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'] ?? '123'; ?>">
            <input type="hidden" name="total_amount" value="<?php echo $_POST['Total'] ?? '206000'; ?>">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <div>
                    <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-5">Choose Payment</h3>
                    
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <label class="cursor-pointer">
                            <input type="radio" name="method" value="Wave Pay" class="payment-radio hidden" checked 
                                   onclick="updatePayment('09793384482', 'Wave Pay', '../../public/payment/wave.png')">
                            <div class="payment-box border-2 border-gray-100 rounded-2xl overflow-hidden transition-all hover:border-blue-200">
                                <div class="h-24 w-full bg-white flex items-center justify-center p-2">
                                    <img src="../../public/payment/wave.png" class="w-full h-full object-contain transition-transform duration-300">
                                </div>
                                <div class="bg-gray-50 py-2 text-center border-t border-gray-100">
                                    <span class="text-[11px] font-bold text-slate-600">Wave Pay</span>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="method" value="KBZ Pay" class="payment-radio hidden"
                                   onclick="updatePayment('09403205925', 'KBZ Pay', '../../public/payment/kbz.png')">
                            <div class="payment-box border-2 border-gray-100 rounded-2xl overflow-hidden transition-all hover:border-blue-200">
                                <div class="h-24 w-full bg-white flex items-center justify-center p-2">
                                    <img src="../../public/payment/kbz.png" class="w-full h-full object-contain transition-transform duration-300">
                                </div>
                                <div class="bg-gray-50 py-2 text-center border-t border-gray-100">
                                    <span class="text-[11px] font-bold text-slate-600">KBZ Pay</span>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="method" value="AYA Pay" class="payment-radio hidden"
                                   onclick="updatePayment('09123456789', 'AYA Pay', '../../public/payment/aya.png')">
                            <div class="payment-box border-2 border-gray-100 rounded-2xl overflow-hidden transition-all hover:border-blue-200">
                                <div class="h-24 w-full bg-white flex items-center justify-center p-2">
                                    <img src="../../public/payment/aya.png" class="w-full h-full object-contain transition-transform duration-300">
                                </div>
                                <div class="bg-gray-50 py-2 text-center border-t border-gray-100">
                                    <span class="text-[11px] font-bold text-slate-600">AYA Pay</span>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="method" value="UAB Pay" class="payment-radio hidden"
                                   onclick="updatePayment('09987654321', 'UAB Pay', '../../public/payment/uab.png')">
                            <div class="payment-box border-2 border-gray-100 rounded-2xl overflow-hidden transition-all hover:border-blue-200">
                                <div class="h-24 w-full bg-white flex items-center justify-center p-2">
                                    <img src="../../public/payment/uab.png" class="w-full h-full object-contain transition-transform duration-300">
                                </div>
                                <div class="bg-gray-50 py-2 text-center border-t border-gray-100">
                                    <span class="text-[11px] font-bold text-slate-600">UAB Pay</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div id="bankCard" class="bg-[#111827] rounded-[1.5rem] p-7 text-white shadow-xl relative overflow-hidden transition-all duration-500">
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 mb-1 font-semibold">Bank Transfer To</p>
                                    <h4 id="displayPhone" class="text-2xl font-mono font-bold tracking-widest">09793384482</h4>
                                </div>
                                <button type="button" onclick="copyNumber()" class="bg-white/10 p-2.5 rounded-xl hover:bg-white/20 transition-all active:scale-90 group relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    <span id="copyTooltip" class="absolute -top-10 left-1/2 -translate-x-1/2 bg-blue-600 text-[10px] px-2 py-1 rounded-md opacity-0 transition-opacity whitespace-nowrap">Copied!</span>
                                </button>
                            </div>
                            
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] uppercase text-slate-400 font-semibold">Account Name</p>
                                    <p class="text-sm font-bold tracking-wide">Zay Yar Lin Tun</p>
                                </div>
                                <div class="flex flex-col items-end">
                                    <img id="cardLogo" src="../../public/payment/wave.png" class="w-10 h-10 object-contain rounded-md mb-2 bg-white p-1">
                                    <span id="displayMethodLabel" class="bg-white/10 px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-tighter">Wave Pay</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full"></div>
                    </div>
                </div>

                <div class="flex flex-col h-full">
                    <div class="bg-blue-50/40 rounded-3xl p-6 border border-blue-100 mb-6">
                        <h3 class="text-sm font-bold text-slate-700 mb-4">Order Summary</h3>
                        <div class="flex justify-between text-sm text-slate-500 mb-2">
                            <span>Subtotal</span>
                            <span class="font-semibold text-slate-700"><?php echo number_format($_POST['Total'] ?? 206000); ?> Ks</span>
                        </div>
                        <div class="pt-4 mt-4 border-t border-blue-100 flex justify-between items-center">
                            <span class="font-bold text-slate-800">Total</span>
                            <span class="text-2xl font-black text-blue-600"><?php echo number_format($_POST['Total'] ?? 206000); ?> Ks</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">Transaction ID (Last 6 Digits)</label>
                            <input type="text" name="tid" required placeholder="e.g. 123456"  pattern="[0-9]{6,}" required title="Minimum 6 digits"
                                   class="w-full mt-1 bg-white border-gray-200 border-2 rounded-2xl p-4 text-sm focus:border-blue-500 focus:ring-0 outline-none transition-all">
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">Payment Screenshot</label>
                            <label class="group w-full mt-1 border-2 border-dashed border-gray-200 rounded-2xl p-6 flex flex-col items-center justify-center cursor-pointer hover:bg-blue-50/30 hover:border-blue-300 transition-all">
                                <div class="bg-blue-100 p-2 rounded-full mb-2 group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                </div>
                                <span id="fileName" class="text-xs font-bold text-slate-500">Upload Screenshot</span>
                                <!-- <input type="file" name="screenshot" class="hidden" required 
       onchange="document.getElementById('fileName').innerText = this.files.name"> -->
         <input  name="screenshot" type="file" id="file-2" accept="image/*"
                            </label>
                        </div>
                    </div>

                    <div class="mt-auto pt-8 flex justify-between items-center">
                        <button type="button" onclick="history.back()" class="text-sm font-bold text-slate-400 hover:text-slate-700 transition-colors">← Back</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-10 py-4 rounded-2xl shadow-xl shadow-blue-100 transition-all active:scale-95">
                            Confirm & Register
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function updatePayment(phone, method, logoUrl) {
            // Update Number and Method Label
            document.getElementById('displayPhone').innerText = phone;
            document.getElementById('displayMethodLabel').innerText = method;
            document.getElementById('cardLogo').src = logoUrl;
            
            // Animation effect for the card
            const card = document.getElementById('bankCard');
            card.classList.add('scale-[0.98]', 'opacity-90');
            setTimeout(() => card.classList.remove('scale-[0.98]', 'opacity-90'), 200);
        }

        function copyNumber() {
            const phoneNumber = document.getElementById('displayPhone').innerText;
            navigator.clipboard.writeText(phoneNumber).then(() => {
                const tooltip = document.getElementById('copyTooltip');
                tooltip.classList.replace('opacity-0', 'opacity-100');
                setTimeout(() => tooltip.classList.replace('opacity-100', 'opacity-0'), 2000);
            });
        }
    </script>
</body>
</html>