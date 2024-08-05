<x-app-layout>
    <div class="py-7">
        <div class="container mx-auto max-w-7xl rounded-lg bg-white px-5 py-5">
            @if($accounts->isEmpty())
                <p class="text-center text-gray-500">You have no accounts! Please create an account to get started.</p>
            @else
                <ul>
                    @foreach ($accounts as $account)
                        <li class="py-2 border-b">
                            <a href="{{ route('accounts.show', $account->id) }}">
                                {{ $account->account_number }} - {{ $account->type }} - {{ $account->currency }} - {{ $account->amount }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
