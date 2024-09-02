<x-app-layout>
    <div class="py-7">
        <div class="container mx-auto max-w-7xl rounded-lg bg-white px-5 py-5">
            <p>{{$cryptocurrency->name}} - {{$cryptocurrency->price}} $</p>
            @if($investmentAccounts->isEmpty())
                <p class="text-red-500 mt-2">Please create an investment account first!</p>
            @else
                <form method="POST" action="/cryptocurrencies/buy/{{$cryptocurrency->id}}">
                    @csrf
                    <div class="sm:col-span-3 mb-5">
                        <label for="account"
                               class="block text-sm font-medium leading-6 text-gray-900">Investment account
                        </label>
                        <div class="mt-2">
                            <select id="account" name="account" autocomplete="account"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                @foreach($investmentAccounts as $account)
                                    <option value="{{$account->id}}">{{$account->account_number}}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('sender')" class="mt-2"/>
                        </div>
                    </div>

                    <div class="sm:col-span-3 mb-5">
                        <label for="amount"
                               class="block text-sm font-medium leading-6 text-gray-900">Amount In USD</label>
                        <div class="mt-2">
                            <input id="amount" name="amount" autocomplete="amount" required type="number" min="10"
                                   step="0.01"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"/>
                            <x-input-error :messages="$errors->get('amount')" class="mt-2"/>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Buy
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
