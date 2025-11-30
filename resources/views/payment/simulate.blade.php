<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Simulation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-coral': '#FF6B6B',
                        'brand-orange': '#FFA502',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 font-sans">
    <div class="bg-white max-w-md w-full rounded-3xl shadow-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-brand-coral to-brand-orange p-6 text-white text-center">
            <h1 class="text-2xl font-bold">Payment Gateway</h1>
            <p class="text-white/80 text-sm">Simulation Mode</p>
        </div>

        <div class="p-8 space-y-6">
            <div class="text-center space-y-2">
                <p class="text-gray-500 text-sm">Total Amount</p>
                <p class="text-4xl font-black text-gray-800">Rp 10.000</p>
                <p class="text-xs text-gray-400">For Premium Upgrade: {{ $page->title }}</p>
            </div>

            <div class="space-y-3">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Select Method</p>
                
                <button onclick="submitPayment('QRIS')" class="w-full flex items-center justify-between p-4 border rounded-xl hover:border-brand-coral hover:bg-orange-50 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-xl">📱</div>
                        <span class="font-bold text-gray-700 group-hover:text-brand-coral">QRIS (GoPay/OVO)</span>
                    </div>
                    <div class="w-4 h-4 rounded-full border-2 border-gray-300 group-hover:border-brand-coral"></div>
                </button>

                <button onclick="submitPayment('SHOPEEPAY')" class="w-full flex items-center justify-between p-4 border rounded-xl hover:border-brand-coral hover:bg-orange-50 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-xl">🛍️</div>
                        <span class="font-bold text-gray-700 group-hover:text-brand-coral">ShopeePay</span>
                    </div>
                    <div class="w-4 h-4 rounded-full border-2 border-gray-300 group-hover:border-brand-coral"></div>
                </button>
            </div>

            <form id="payment-form" action="{{ route('payment.callback') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="external_ref" value="{{ $transaction->external_ref }}">
                <input type="hidden" name="payment_method" id="payment_method">
            </form>

            <div class="pt-4">
                <p class="text-xs text-center text-gray-400 mb-4">This is a simulation. No real money will be deducted.</p>
                <a href="{{ route('home') }}" class="block text-center text-gray-400 text-sm hover:text-gray-600">Cancel Transaction</a>
            </div>
        </div>
    </div>

    <script>
        function submitPayment(method) {
            document.getElementById('payment_method').value = method;
            
            // Simulate loading
            const btn = event.currentTarget;
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<span class="animate-pulse">Processing...</span>';
            btn.classList.add('bg-brand-coral', 'text-white', 'border-transparent');
            
            setTimeout(() => {
                document.getElementById('payment-form').submit();
            }, 1500);
        }
    </script>
</body>
</html>
