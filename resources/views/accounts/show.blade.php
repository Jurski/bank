<x-app-layout>
    <div class="py-7">
        <div class="container mx-auto max-w-7xl rounded-lg bg-white px-5 py-5">
            <ul>

                <li>{{ $account->account_number }} - {{$account->type}} - {{$account->currency}} - {{$account->amount}}</li>

            </ul>
        </div>
    </div>
</x-app-layout>
