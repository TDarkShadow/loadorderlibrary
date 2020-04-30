<div class="card text-white bg-dark">
    <div class="card-header">
        Your Lists
    </div>
    <ul class="list-group list-group-flush">
        @forelse($loadOrders as $loadOrder)
        <li class="list-group-item list-group-item-dark">{{ $loadOrder->name }} uploaded: {{ $loadOrder->created_at }}</li>
        @empty
        <li class="list-group-item list-group-item-dark">You do not have any lists yet.</li>
        @endforelse
    </ul>
</div>