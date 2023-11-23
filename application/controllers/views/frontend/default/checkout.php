<section class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title"><?php echo $page_title; ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="my-courses-area">
    <div class="container">
        <div class="row">
            <div class="col-md-10 order-md-2 mb-4">
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                <h6 class="my-0"><?php echo $subcategory['name']; ?></h6>
                </div>          
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed" style="padding: 0px;">
                <ul class="list-group col-md-12" style="padding: 0px;">

                    <?php if($subcategory['price'] != 0):?>
                        <div>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <span>
                                    <input id="radio_price" type="radio" name="amount" class="radio" value="<?php echo $subcategory['price']; ?>">
                                    <label for="radio_price"><?php echo get_phrase('price'); ?></label>
                                </span>
                                <label for="radio_price"><?php echo currency($subcategory['price']); ?></label>
                                
                            </li>
                        </div>
                    <?php endif; ?>

                    <?php if($subcategory['half_price'] != 0):?>
                        <div>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <span>
                                    <input type="radio" id="radio_half_yearly_price" name="amount" class="radio" value="<?php echo $subcategory['half_price']; ?>">
                                    <label for="radio_half_yearly_price"><?php echo get_phrase('half_yearly_price'); ?></label>
                                    
                                </span>
                                <label for="radio_half_yearly_price" ><?php echo currency($subcategory['half_price']); ?></label>
                            </li>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($subcategory['quart_price'] != 0):?>
                        <div>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <span>
                                    <input type="radio" id="radio_quarterly_price" name="amount" class="radio" value="<?php echo $subcategory['quart_price']; ?>">
                                    <label for="radio_quarterly_price"><?php echo get_phrase('quarterly_price'); ?></label>
                                </span>
                                <label for="radio_quarterly_price" ><?php echo currency($subcategory['quart_price']); ?></label>
                            </li>
                        </div>
                    <?php endif; ?>
                </ul>
            </li>
            
            <li class="list-group-item d-flex justify-content-between">
              <span>Sub Total</span>
              <span> ₹<span id="sub_total">0</span></span>
              <input type="hidden" name="sub_total_amount" id="sub_total_amount">
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <div class="text-success">
                    <h6 class="my-0 ">Promo code</h6>
                    <small id="coupon_code_text"></small>
                </div>
                <span>- ₹<span id="coupon_code_amount">0</span></span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <strong><span>Total</span></strong>
              <strong>₹<span id="total_amount">0</span></strong>
              <input type="hidden" name="total_amount" id="total_amount">
            </li>
          </ul>
          Have Coupon Code ? <a href="javascript:void(0)" id="has_coupon_link"> Click To Apply </a>
            <div class="input-group" id="coupon_code_area" style="display:none">
            <div class="row col-md-12">
                <a href="javascript:void(0)" id="cancel_coupon_link">Hide</a><br/>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Promo code" id="code">
                </div>
                <div class="col-md-3">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-success coupon">Apply</button>
                    </div>
                </div>
            </div>
              
              </div>
              
            
        </div>
        </div>
        <div class="row">
            <div class="col-md-10 order-md-2 mb-4">
                <button style="float:right" id="checkout_confirmed" class="btn btn-primary">Checkout</button>
            </div>
        </div>    
    </div>
</section>


<script type="text/javascript">
$(document).ready(function() {
    
    // cart initialize
    let cart = {
        payment_method : 'COD',
        coupon_code : '',
        coupon_amount : 0,
        total_amount : 0,
        sub_total_amount : 0,
        item_price : 0,
        coupon_type : 0, // 0 => amount, 1 => percent
        coupon_value : 0,
    }

    // my cart Object
    let myCart = {
        
        buildCart : function() {
            $('#sub_total').html(this.sub_total_amount);
            $('#coupon_code_amount').html(this.coupon_amount);
            $('#total_amount').html(this.total_amount);
            $('#coupon_code_text').html(this.coupon_code);
        }
    }

    // toggle coupon code
    $('#has_coupon_link').click(function(){
        $("#coupon_code_area").show(800);
    });

    $('#cancel_coupon_link').click(function(){
        $("#coupon_code_area").hide(800);
    });

    
    $('.radio').click(function() {
        cart.item_price = this.value;


        if(cart.coupon_type > 0) {
            cart.coupon_amount = (cart.item_price * cart.coupon_value) / 100;
            cart.sub_total_amount = cart.item_price;
            cart.total_amount = cart.item_price - cart.coupon_amount;
            myCart.buildCart.call(cart);

            
        }else  {

            cart.coupon_amount = cart.coupon_value;
            cart.sub_total_amount = cart.item_price;
            cart.total_amount = cart.item_price  - cart.coupon_amount;
            myCart.buildCart.call(cart);
        }


    });

    

    $('.coupon').click(function(){
        var code = $('#code').val();
        var total_amount = cart.item_price;
        cart.coupon_code = code;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('home/discount');?>",
            data: { code: code, total_amount : total_amount} ,
            success: function (r) {
                if(r== 'null' || r == undefined || !r) {
                    // cart.coupon_amount = (total_amount * res.discount_percent) / 100;
                    // cart.total_amount = total_amount - cart.coupon_amount;
                    // console.log(cart);
                    toastr.error('Invalid Coupon');                    
                }else {
                    let res = JSON.parse(r);
                    
                    if(res.discount_percent > 0) {
                        cart.coupon_amount = (total_amount * res.discount_percent) / 100;
                        cart.coupon_value = res.discount_percent;
                        cart.total_amount = total_amount - cart.coupon_amount;
                        cart.coupon_type = 1;
                        myCart.buildCart.call(cart); 
                    }else if(res.discount_amount > 0) {
                        cart.coupon_type = 0;
                        cart.coupon_amount = res.discount_amount;
                        cart.coupon_value = res.discount_amount;
                        cart.total_amount = total_amount - cart.coupon_amount;
                        myCart.buildCart.call(cart);
                    }
                }
            }
        });

    });




        $('#checkout_confirmed').click(function(){
            if(cart.item_price == 0){
                toastr.error('Error : Can not submit');
            }else {

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('home/payment_success/cod');?>",
                    data: cart ,
                    success: function (r) {
                        toastr.success('Payment Successfully Done!');
                        window.location.href = '<?php echo base_url(); ?>';
                    }
                });
            }
    });

});
</script>