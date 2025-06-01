<x-app-layout>
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold">Histori Pembuangan sampah</h1>
                    </div>

                    <div class="overflow-x-auto">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>

    @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-app-layout>