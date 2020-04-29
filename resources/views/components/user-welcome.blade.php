<div class="card">
    <div class="card-header">
        Your Lists
    </div>
    <ul class="list-group list-group-flush">
        @forelse($loadOrders as $loadOrder)
            <li class="list-group-item">{{ $loadOrder->name }} uploaded: {{ $loadOrder->created_at }}</li>
        @empty
            <li class="list-group-item">You do not have any lists yet.</li>
        @endforelse
    </ul>
</div>