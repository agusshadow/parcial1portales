@if (session('success') || session('error'))
    <div class="fixed top-4 right-4 z-50 flex items-start justify-between w-full max-w-sm px-4 py-3 rounded shadow-lg
        {{ session('success') ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">

        <div class="flex-1 pr-4">
            {{ session('success') ?? session('error') }}
        </div>

        <button onclick="this.parentElement.style.display='none';" class="text-white font-bold text-xl leading-none focus:outline-none">
            &times;
        </button>
    </div>
@endif
