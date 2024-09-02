<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (count($cryptocurrencies) === 0)
                <p class="text-center text-gray-500">Can't display cryptocurrencies</p>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Cryptocurrencies</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Symbol
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Change (24h)
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($cryptocurrencies as $cryptocurrency)
                                @php
                                    $price = $cryptocurrency->price;
                                    if($price >= 1) {
                                        $formattedPrice = sprintf('%.2f', $price);
                                    } elseif($price >= 0.1) {
                                        $formattedPrice = sprintf('%.6f', $price);
                                    } else {
                                        $formattedPrice = sprintf('%.10f', $price);
                                    }
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"> {{$cryptocurrency->name}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$cryptocurrency->symbol}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        $ {{$formattedPrice}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{number_format($cryptocurrency->percent_change_24h, 2)}}
                                        %
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><a
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                            href="{{route('cryptocurrencies.show', $cryptocurrency->id) }}">Buy</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
