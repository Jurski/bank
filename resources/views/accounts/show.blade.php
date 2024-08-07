<x-app-layout>
    <div class="py-7">
        <div class="container mx-auto max-w-7xl rounded-lg bg-white px-5 py-5">
            <ul>
                <li>{{ $account->account_number }} - {{$account->type}} - {{$account->currency}}
                    - {{$account->balance/100}}</li>
            </ul>
            <h2>Transactions</h2>
            @if($account->transactions->isEmpty())
                <p class="text-center text-gray-500">You have no transactions!</p>
            @else

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Transaction ID:
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Type:
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Base Currency:
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Amount:
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Created At:
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Converted Into:
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Converted amount:
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($account->transactions as $transaction)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $transaction->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $transaction->pivot->type }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->base_currency }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->amount / 100 }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->converted_currency }}
                                </td>
                                <td class="px-6 py-4">
                                    @isset($transaction->converted_amount)
                                        {{$transaction->converted_amount / 100}}
                                    @endisset
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @endif
        </div>
    </div>
</x-app-layout>
