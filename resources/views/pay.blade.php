<form action="{{ route('payment.process') }}" method="POST">
    @csrf
    <div id="card-element"></div>
    <button type="submit">Pay Now</button>
</form>
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Initialize Stripe Elements and create card element
    // ...
</script>