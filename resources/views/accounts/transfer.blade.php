<x-app-layout>
    <div class="py-7">
        <div class="container mx-auto max-w-7xl rounded-lg bg-white px-5 py-5">
            <form method="POST" action="/transactions">
                @csrf

                <div class="sm:col-span-3 mb-5">
                    <label for="sender"
                           class="block text-sm font-medium leading-6 text-gray-900">Sender Account</label>
                    <div class="mt-2">
                        <select id="sender" name="sender" autocomplete="sender"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @foreach($accounts as $account)
                                <option value="{{$account->id}}">{{$account->account_number}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('sender')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3 mb-5">
                    <label for="amount"
                           class="block text-sm font-medium leading-6 text-gray-900">Amount</label>
                    <div class="mt-2">
                        <input id="amount" name="amount" autocomplete="amount" required type="number" min="0.01" step="0.01"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"/>
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3 mb-5">
                    <label for="account"
                           class="block text-sm font-medium leading-6 text-gray-900">Enter Receiver Account</label>
                    <div class="mt-2">
                        <input id="receiver" name="receiver" autocomplete="receiver" required
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"/>
                        <x-input-error :messages="$errors->get('receiver')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
