<x-app-layout>
    <div class="py-7">
        <div class="container mx-auto max-w-7xl rounded-lg bg-white px-5 py-5">
            <p class="mb-8"><span class="text-red-700 font-bold">NOTICE:</span> Investment accounts only allowed in USD
            </p>
            <form method="POST" action="/accounts">
                @csrf

                <div class="sm:col-span-3 mb-5">
                    <label for="currency"
                           class="block text-sm font-medium leading-6 text-gray-900">Currency</label>
                    <div class="mt-2">
                        <select id="currency" name="currency" autocomplete="currency-symbol"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @foreach ($currencies as $currency)
                                <option
                                    value="{{$currency['code']}}">{{$currency['name'] . ' - ' . $currency['symbol']}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('currency')" class="mt-2"/>
                    </div>
                </div>

                <div class="sm:col-span-3 mb-5">
                    <label for="type"
                           class="block text-sm font-medium leading-6 text-gray-900">Account Type</label>
                    <div class="mt-2">
                        <select id="type" name="type" autocomplete="account-type"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="private">Private</option>
                            <option value="investment">Investment</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
