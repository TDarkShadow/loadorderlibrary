@extends('layouts.app')

@section('title', 'Support Me')

@section('content')
<div class="container">
	<div class="row justify-content-center pb-5">
		<div class="col-md-12 card-group">
			<div class="card text-white bg-dark">
				<div class="card-header text-center">
					Support Me
				</div>

				<div class="card-body">
					<p>
						If you like the site and want to support me, feel free to pledge on Patreon or send me some Cryptocurrency. Please don't feel obligated.
					</p>

					<p>For the sake of transparency of expenses, please see <a href="https://github.com/phinocio/loadorderlibrary/blob/master/EXPENSES.md">EXPENSES.md</a> on Github for a breakdown of the expenses of the site.</p>

					<p>If I do receive any support, I will update this page with the amount of any received Crypto, again for the sake of transparency. (Patreon would just be visible on the Patreon site itself).</p>
				</div>
			</div>
		</div>


	</div>

	<div class="row justify-content-center">
		<div class="col-md-12 card-group">
			<div class="card text-white bg-dark">
				<div class="card-header text-center">
					Methods
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-dark">
							<tbody>
								<tr>
									<td></td>
									<th scope="row">Patreon</th>
									<td><a href="https://patreon.com/phinocio" target="_blank" rel="noopener noreferrer">https://patreon.com/phinocio</a></td>
								</tr>
								<tr>
									<td><button type="button" class="btn btn-primary btn-sm" onclick="copyAddress('btc-address')">Copy</button></td>
									<th scope="row">Bitcoin (BTC)</th>
									<td id="btc-address">3JtbHZS4d69SMKsETWZQJf9VpryQNcdDCh</td>
								</tr>
								<tr>
									<td><button type="button" class="btn btn-primary btn-sm" onclick="copyAddress('eth-address')">Copy</button></td>
									<th scope="row">Ethereum (ETH)</th>
									<td id="eth-address">0x4753F54b6D00d859160cF4760A8d741B8b393F35</td>
								</tr>
								<tr>
									<td><button type="button" class="btn btn-primary btn-sm" onclick="copyAddress('ada-address')">Copy</button></td>
									<th scope="row">Cardano (ADA)</th>
									<td id="ada-address">addr1v8clljrnl9z0cxwehmufcy2529e663c62dk3m5qv2qyf6kc4huk0y</td>
								</tr>
								<tr>
									<td><button type="button" class="btn btn-primary btn-sm" onclick="copyAddress('ban-address')">Copy</button></td>
									<th scope="row">Banano (BAN)</th>
									<td id="ban-address">ban_3x8rr9mawggjgcqw4pqafuexbzijq1bbnzxrzusqsq6s8gox7jx4zannx8zu</td>
								</tr>
								<tr>
									<td><button type="button" class="btn btn-primary btn-sm" onclick="copyAddress('algo-address')">Copy</button></td>
									<th scope="row">Algorand (ALGO)</th>
									<td id="algo-address">WLAESA7TDGWTRXQLUXPAHA4LKOUHZ5JAZCDOKVSTR7ZGPGADMY2WQE4OWU</td>
								</tr>
								<tr>
									<td><button type="button" class="btn btn-primary btn-sm" onclick="copyAddress('xlm-address')">Copy</button></td>
									<th scope="row">Stellar Lumens (XLM)</th>
									<td id="xlm-address">GDQP2KPQGKIHYJGXNUIYOMHARUARCA7DJT5FO2FFOOKY3B2WSQHG4W37:::ucl:::2291154021</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<script>
	function copyAddress(target) {
		const address = document.getElementById(target).innerText;
		navigator.clipboard.writeText(address);
	}
</script>