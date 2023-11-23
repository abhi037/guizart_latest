<section class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col"> 
                
                <div class="alert alert-success">
                    <strong> <?php echo ucfirst($page_title); ?></strong> 
                </div> </div>
            
            <!-- <div class="col">
                <h1 class="page-title"><?php echo $page_title; ?>455</h1>
            </div> -->
        </div>
    </div>
</section>


      <?php 
        $attribute = array('id'=>'checkout_form');
        echo form_open('checkout/payment',$attribute);
    ?>
    
    <input type="hidden" name="subcategory_id" value="<?php echo $this->uri->segment(3);?>">
              
    <div class="container mb-3">
        
    <table class="table table-bordered"> 
        <thead class = "bg-light" > <tr> 
            <th class="text-center">#</th> 
        <th width="60%">Quiz</th> 
        <th class="">Price</th> 
    </tr> </thead> 
    <tbody> 
        <tr> 
            <td class="col-sm-1 col-md-1 col-lg-1"> 

    
         <a href="#" class="dropdown-toggle"> 
            <img src="<?php echo base_url().'uploads/subcategory/800x800_l.png'; ?>" class="img-circle" width="80"> </a> 
     
     


   </td> 
            <td class= "align-middle" ><?php echo $subcategory['name']; ?></td>
          <!-- //  with radio button  -->
           <!-- <td class= "align-middle  " ><label> <input class = "mr-2" style = "min-height: 0px;" type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked=""><?php echo get_phrase('price'); ?>
</label>  </td>  -->

   <td class= "align-middle  " > 
     <?php if($subcategory['price'] != 0):?>
                      
                       <input id="radio_price" type="radio" name="amount" value="price" class = "mr-2" style = "min-height: 0px;" data-value=" <?php echo currency($subcategory['price']); ?>" data-subscription="yearly" checked="checked"/>
                       <?php echo currency($subcategory['price']); ?>
                       <input type="hidden" name="subscription_type">
                    <?php endif; ?>
   </td> 
        </tr> 
                 
                            </tbody> 
                        </table>

                        <div class="row"> 
                          <div class="col-sm-6"> <div class="text-left"> <ul class="list-unstyled">
                             <li>Have Coupon Code ? 
                               <a href="javascript:void(0)" id="has_coupon_link">  <strong > Click To Apply</strong></a> </li> 
                               <li id="coupon_code_area" style="display:none">
                                <input type="text" class="form-control" name="cupon_code" id="code" placeholder="Promo Code">
                                 
 
                                <br> 
                            <a href="javascript:void(0)" id="cancel_coupon_link" class="btn btn-secondary">
                                Hide
                                 </a>
                                &nbsp;
                                <button type="button" class="btn btn-warning coupon">
                                Apply
                                     </button>

                            </li>

                            </ul>                             </div> </div> 
      
                            <div class="col-sm-6"> <div class="text-right"> <ul class="list-unstyled">
                             <li>
                                Price:
                                <strong > <?php if($subcategory['price'] != 0):?>
                       <?php echo currency($subcategory['price']); ?>
                    <?php endif; ?></strong> </li> <li>
                                Sub - Total amount:
                               <strong>₹</strong> <strong id="sub_total">0</strong> 
                            <input type="hidden" name="sub_total_amount" id="sub_total_amount">
                            </li> 
                               
                               <li>
                                
                                Promo Code:<strong class = "text-success" id="coupon_code_text"></Strong>:
                                <strong id="coupon_code_amount"></Strong>
                                </li> <li>
                                Grand Total:
                               <strong>₹</strong> 
                               <strong  id="total_amount">0</strong> 
                              <input type="hidden" name="total_amount">
                              </li> 
                            </ul> <br> 
                            <!-- <a href="#" class="btn btn-primary">
                                Print Invoice
                                <i class="entypo-doc-text"></i> </a> -->
                                &nbsp;
                                <button type="button" id="checkout_confirmed"  class="btn btn-success">
                                Checkout
                                </button> </div> </div> </div>
      
                        <!-- <div class="row">
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
                            <input type="hidden" name="subscription_type">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <span>
                                    <input id="radio_price" type="radio" name="amount" class="radio" value="price" data-value="<?php echo $subcategory['price']; ?>" data-subscription="yearly" checked="checked"/>
                                   <input id="radio_price" type="radio" name="amount" class="radio" value="<?php echo $subcategory['price']; ?>"
                                    <label for="radio_price"><?php echo get_phrase('price'); ?></label>
                                </span>
                                <label for="radio_price"><?php echo currency($subcategory['price']); ?></label>
                                
                            </li>
                        </div>
                    <?php endif; ?> 

                    <?php /*if($subcategory['half_price'] != 0):?>
                        <div>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <span>
                                    <input type="radio" id="radio_half_yearly_price" name="amount" class="radio" value="half_price" data-value="<?php echo $subcategory['half_price']; ?>" data-subscription="half_yearly">
                                    <!--<input type="radio" id="radio_half_yearly_price" name="amount" class="radio" value="<?php echo $subcategory['half_price']; ?>">-->
                                    <label for="radio_half_yearly_price"><?php echo get_phrase('half_yearly_price'); ?></label>
                                    
                                </span>
                                <label for="radio_half_yearly_price" ><?php echo currency($subcategory['half_price']); ?></label>
                            </li>
                        </div>
                    <?php endif; */?>
                    
                    <?php /*if($subcategory['quart_price'] != 0):?>
                        <div>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                <span>
                                    <input type="radio" id="radio_quarterly_price" name="amount" class="radio" value="quart_price" data-value="<?php echo $subcategory['quart_price']; ?>" data-subscription="quarterly">
                                    <!--<input type="radio" id="radio_quarterly_price" name="amount" class="radio" value="<?php echo $subcategory['quart_price']; ?>">-->
                                    <label for="radio_quarterly_price"><?php echo get_phrase('quarterly_price'); ?></label>
                                </span>
                                <label for="radio_quarterly_price" ><?php echo currency($subcategory['quart_price']); ?></label>
                            </li>
                        </div>
                    <?php endif; */ ?>
                <!-- </ul>
            </li>
            
            <li class="list-group-item d-flex justify-content-between">
              <span>Sub Total</span>
              <span> ₹<span id="sub_total1">0</span></span>
              <input type="hidden" name="sub_total_amount" id="sub_total_amount1">
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
              <strong>₹<span id="total_amount1">0</span></strong>
              <input type="hidden" name="total_amount1">
            </li>
          </ul>
          Have Coupon Code ? <a href="javascript:void(0)" id="has_coupon_link1"> Click To Apply </a>
            <div class="input-group" id="coupon_code_area1" style="display:block">
            <div class="row col-md-12">
                <a href="javascript:void(0)" id="cancel_coupon_link1">Hide</a><br/>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <input type="text" class="form-control" name="cupon_code" placeholder="Promo code" id="code">
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
              
                <button type="button" style="float:right" id="checkout_confirmed1" class="btn btn-primary">Checkout</button>
                
            </div>
        </div>     -->
    </div>
    </form>


<script src="https://quizart.co.in/assets/frontend/js/vendor/jquery-3.2.1.min.js"></script>
<script src="https://quizart.co.in/assets/backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
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
            $('[name="total_amount"]').val(this.total_amount);
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

    
    $('.radio').click(function(){
      var item_price = $(this).attr('data-value');
      var subscription_type = $(this).attr('data-subscription');
      radioclick(item_price, subscription_type);
    });
    
    radioclick('<?php echo $subcategory['price']; ?>', 'yearly');

    function radioclick(item_price, subscription_type) {
        
        cart.item_price = item_price;
        var subscription_type = subscription_type;
        $('[name="subscription_type"]').val(subscription_type);


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


    }

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
        
            //console.log(cart);
            var x = $('#checkout_form').serialize();
            $('#checkout_form').submit();
            // $.ajax({
            //     url:'<?php echo base_url('checkout/payment')?>',
            //     data:x,
            //     type:'POST',
            //     dataType:'json',
            //     success:function(data)
            //     {
            //         console.log(data);
            //     },
            //     error:function(xhr)
            //     {
            //         console.log(xhr.status+' '+xhr.statusText);
            //     }
            // });

                // $.ajax({
                //     type: "POST",
                //     url: "<?php echo base_url('home/payment_success/cod');?>",
                //     data: cart ,
                //     success: function (r) {
                //         toastr.success('Payment Successfully Done!');
                //         window.location.href = '<?php echo base_url(); ?>';
                //     }
                // });
            }
    });

});
</script>