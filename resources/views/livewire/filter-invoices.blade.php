<div>
    {{-- @dump($filters) --}}
    {{-- FILTROS --}}
    <div class="bg-white rounded p-4 shadow-sm mb-2">
        <h2 class="text-lg font-semibold mb-1">Generar reportes</h2>

        <div class="flex items-center justify-between space-x-1">
            <div class="flex gap-2 items-center">
                <span>Serie</span>
                <select wire:model="filters.serie" name="serie" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-32">
                    <option value="">Todas</option>
                    <option value="F001">F001</option>
                    <option value="B001">B001</option>
                </select>
            </div>

            <div class="flex space-x-2">
                <div>
                    Desde el N°
                    <x-jet-input wire:model="filters.fromNumber" type="text" class="w-20" />
                </div>
                <div>
                    hasta el N°
                    <x-jet-input wire:model="filters.toNumber" type="text" class="w-20" />
                </div>
            </div>

            <div class="flex space-x-2">
                <div>
                    Desde fecha
                    <x-jet-input wire:model="filters.fromDate" type="date" class="w-36" />
                </div>
                <div>
                    hasta fecha
                    <x-jet-input wire:model="filters.toDate" type="date" class="w-36" />
                </div>
            </div>

            <x-jet-button class="mt-2">Generar reporte</x-jet-button>

        </div>







    </div>

    {{-- TABLA --}}
    <div class="overflow-x-auto relative">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-center">
                    <th scope="col" class="py-3 px-6">
                        ID
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Serie
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Correlativo
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Base
                    </th>
                    <th scope="col" class="py-3 px-6">
                        IVA
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Total
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Fecha de emisión
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr class="bg-white dark:bg-gray-800 text-center">
                        <th scope="row"
                            class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $invoice->id }}
                        </th>
                        <td class="px-6">
                            {{ $invoice->serie }}
                        </td>
                        <td class="px-6">
                            {{ $invoice->correlative }}
                        </td>
                        <td class="px-6">
                            $ {{ $invoice->base }}
                        </td>
                        <td class="px-6">
                            $ {{ $invoice->iva }}
                        </td>
                        <td class="py-4 px-6">
                            $ {{ $invoice->total }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $invoice->created_at->format('d/m/Y') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- PAGINACIÓN --}}
    @if ($invoices->hasPages())
        <div class="mt-4">
            {{ $invoices->links() }}
        </div>
    @endif

</div>
