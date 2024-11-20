<!-- resources/views/filament/resources/pemesanan/modal/view.blade.php -->
<div class="space-y-4">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <h3 class="text-lg font-medium">Informasi Pemesanan</h3>
            <dl class="mt-2 space-y-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Kode Pemesanan</dt>
                    <dd class="text-sm text-gray-900">{{ $pemesanan->order_code }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal Kunjungan</dt>
                    <dd class="text-sm text-gray-900">{{ $pemesanan->order_date->format('d F Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Jumlah Orang</dt>
                    <dd class="text-sm text-gray-900">{{ $pemesanan->num_people }} orang</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Harga</dt>
                    <dd class="text-sm text-gray-900">Rp {{ number_format($pemesanan->price, 0, ',', '.') }}</dd>
                </div>
            </dl>
        </div>
        <div>
            <h3 class="text-lg font-medium">Informasi Pengunjung</h3>
            <dl class="mt-2 space-y-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="text-sm text-gray-900">{{ $pemesanan->pengunjung->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="text-sm text-gray-900">{{ $pemesanan->pengunjung->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nomor Telepon</dt>
                    <dd class="text-sm text-gray-900">{{ $pemesanan->pengunjung->phone }}</dd>
                </div>
            </dl>
        </div>
    </div>
    
    <div>
        <h3 class="text-lg font-medium">Bukti Pembayaran</h3>
        <div class="mt-2">
            @if($pemesanan->proof_of_payment)
                <img src="{{ Storage::disk('public')->url($pemesanan->proof_of_payment) }}" 
                     alt="Bukti Pembayaran" 
                     class="max-w-full h-auto rounded-lg">
            @else
                <p class="text-sm text-gray-500">Tidak ada bukti pembayaran</p>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <button type="button" 
            onclick="showQRIS()"
            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 
            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Lihat QRIS
        </button>
    </div>

    <!-- QRIS Modal -->
    <div id="qrisModal" 
        class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="flex flex-col items-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Scan QRIS untuk Pembayaran</h3>
                <div class="mb-4">
                    <img src="{{ Storage::disk('public')->url($pemesanan->proof_of_payment) }}" alt="QRIS Code" class="max-w-full h-auto rounded-lg">
                </div>
                <button type="button" 
                    onclick="hideQRIS()"
                    class="mt-3 bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>
</div>


<script>
    function showQRIS() {
        document.getElementById('qrisModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
    }

    function hideQRIS() {
        document.getElementById('qrisModal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Restore scrolling
    }

    // Close modal when clicking outside
    document.getElementById('qrisModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideQRIS();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideQRIS();
        }
    });
</script>