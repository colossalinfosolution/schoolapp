
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error!</strong> {{ $message }}
                </div>
            @endif
            {!! Session::forget('error') !!}
            @if($message = Session::get('success'))
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> {{ $message }}
                </div>
            @endif
            {!! Session::forget('success') !!}
            <div class="panel panel-default">
                <div class="panel-heading">Pay With Razorpay</div>
                <?php $total = $result[0]->price * 100; ?>
                <div class="panel-body text-center">
                    <form action="{!!route('payment')!!}" method="POST" >
                        <input type="hidden" name="student_id" value="@if(!empty($result[0]->student_id)){{$result[0]->student_id}}@endif">
                        <input type="hidden" name="item_name" value="@if(!empty($result[0]->item_name)) {{$result[0]->item_name}}@endif">
                        <input type="hidden" name="size" value="@if(!empty($result[0]->size)){{$result[0]->size}}@endif">
                        <input type="hidden" name="color" value="@if(!empty($result[0]->color)){{$result[0]->color}}@endif">
                        <input type="hidden" name="quantity" value="@if(!empty($result[0]->quantity)){{$result[0]->quantity}}@endif">
                         <input type="hidden" name="price" value="@if(!empty($result[0]->price)){{$result[0]->price}}@endif">
                        <input type="hidden" name="bookbyclass" value="@if(!empty($result[0]->bookbyclass)){{$result[0]->bookbyclass}}@endif">
                        <input type="hidden" name="publisher" value="@if(!empty($result[0]->publisher)){{$result[0]->publisher}}@endif">
                        <input type="hidden" name="setofbooks" value="@if(!empty($result[0]->setofbooks)){{$result[0]->setofbooks}}@endif">
                        <input type="hidden" name="item_id" value="@if(!empty($result[0]->item_id)){{$result[0]->item_id}}@endif">
                        
                        <!-- Note that the amount is in paise = 50 INR -->
                        <!--amount need to be in paisa-->
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ Config::get('custom.razor_key') }}"
                                data-amount="{{$total}}"
                                data-buttontext="proceed to checkout"
                                data-name="Testing"
                                data-description="Order Value"
                                data-image=""
                                data-prefill.name="test"
                                data-prefill.email="test"
                                data-theme.color="#ff7529">
                        </script>
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>