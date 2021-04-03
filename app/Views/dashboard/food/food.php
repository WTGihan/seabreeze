
<?php
if (!isset($_SESSION['id'])) {
  session_start();
}
?>
<!DOCTYPE html >
<html >

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- END FOXYCART FILES -->

    
	<script type='text/javascript' src='../assets/js/order.js'></script>
</head>
<style>
td{
  font-size: 15px;
}

* {
  margin: 0;
  padding: 0;
}
body {
  font: 12px "Lucida Grande", Helvetica, Sans-Serif;
}
table {
  border-collapse: collapse;
}
#page-wrap {
  padding: 50px;
}

h1 {
  font: bold 40px Helvetica;
  letter-spacing: -2px;
  margin: 0 0 10px 0;
}

.clear {
  clear: both;
}

#order-table {
  width: 100%;
}
#order-table td {
  padding: 5px;
}
#order-table th {
  padding: 5px;
  background: black;
  color: white;
  text-align: left;
}
#order-table td.row-total {
  text-align: right;
}
#order-table td input {
  width: 75%;
  text-align: center;
  border: 1px solid black;
}
#order-table tr.even td {
  background: #eee;
}
.num-pallets input {
  background: white;
}
.num-pallets input.warning {
  background: #ffdcdc;
}

#order-table td .total-box,
.total-box {
  border: 3px solid rgb(0, 102, 0);
  width: 75%;
  padding: 3px;
  margin: 5px 0 5px 0;
  text-align: center;
  font-size: 14px;
}

#shipping-subtotal {
  margin: 0;
}

#shipping-table {
  width: 350px;
  float: right;
}
#shipping-table td {
  padding: 5px;
}

#shipping-table th {
  padding: 5px;
  background: black;
  color: white;
  text-align: left;
}
#shipping-table td input {
  width: 69px;
  text-align: center;
}

#order-total {
  font-weight: bold;
  font-size: 21px;
  width: 110px;
}

.invoice-box {
  max-width: 800px;
  margin: auto;
  padding: 30px;
  border: 1px solid #eee;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
  font-size: 16px;
  line-height: 24px;
  font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
  color: #555;
}

.invoice-box table {
  width: 100%;
  line-height: inherit;
  text-align: left;
}

.invoice-box table td {
  padding: 5px;
  vertical-align: top;
}

.invoice-box table tr td:nth-child(n + 2) {
  text-align: right;
}

.invoice-box table tr.top table td {
  padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
  font-size: 45px;
  line-height: 45px;
  color: #333;
}

.invoice-box table tr.information table td {
  padding-bottom: 40px;
}

.invoice-box table tr.heading td {
  background: #eee;
  border-bottom: 1px solid #ddd;
  font-weight: bold;
}

.invoice-box table tr.details td {
  padding-bottom: 20px;
}

.invoice-box table tr.item td {
  border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
  border-bottom: none;
}

.invoice-box table tr.item input {
  padding-left: 5px;
}

.invoice-box table tr.item td:first-child input {
  margin-left: -5px;
  width: 100%;
}

.invoice-box table tr.total td:nth-child(2) {
  border-top: 2px solid #eee;
  font-weight: bold;
}

.invoice-box input[type="number"] {
  width: 60px;
}

@media only screen and (max-width: 600px) {
  .invoice-box table tr.top table td {
    width: 100%;
    display: block;
    text-align: center;
  }

  .invoice-box table tr.information table td {
    width: 100%;
    display: block;
    text-align: center;
  }
}

/** RTL **/
.rtl {
  direction: rtl;
  font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial,
    sans-serif;
}

.rtl table {
  text-align: right;
}

.rtl table tr td:nth-child(2) {
  text-align: left;
}

</style>

<body>


<script>
// UTILITY FUNCTIONS 

function IsNumeric(n) {
    return !isNaN(n);
} 

function CleanNumber(value) {

    // Assumes string input, removes all commas, dollar signs, and spaces      
    newValue = value.replace(",","");
    newValue = newValue.replace("$","");
    newValue = newValue.replace(/ /g,'');
    return newValue;
    
}

function CommaFormatted(amount) {
    
	var delimiter = ","; 
	var i = parseInt(amount);
	
	if(isNaN(i)) { return ''; }
	
	i = Math.abs(i);
	
	var minus = '';
	if (i < 0) { minus = '-'; }
	
	var n = new String(i);
	var a = [];
	
	while(n.length > 3)
	{
		var nn = n.substr(n.length-3);
		a.unshift(nn);
		n = n.substr(0,n.length-3);
	}
	
	if (n.length > 0) { a.unshift(n); }
	
	n = a.join(delimiter);
	
	amount =  minus + n;
	
	return amount;
	
}


// ORDER FORM UTILITY FUNCTIONS

function applyName(klass, numPallets) {

    var toAdd = $("td." + klass).text();
    
    var actualClass = $("td." + klass).attr("rel");
    
    $("input." + actualClass).attr("value", numPallets + " pallets");
    
}

function removeName(klass) {
    
    var actualClass = $("td." + klass).attr("rel");
    
    $("input." + actualClass).attr("value", "");
    
}

function calcTotalPallets() {

    var totalPallets = 0;

    $(".num-pallets-input").each(function() {
    
        var thisValue = parseInt($(this).val());
    
        if ( (IsNumeric(thisValue)) &&  (thisValue != '') ) {
            totalPallets += parseInt(thisValue);
        };
    
    });
    
    $("#total-pallets-input").val(totalPallets);

}

function calcProdSubTotal() {
    
    var prodSubTotal = 0;

    $(".row-total-input").each(function() {
    
        var valString = $(this).val() || 0;
        
        prodSubTotal += parseInt(valString);
                    
    });
        
    $("#product-subtotal").val(CommaFormatted(prodSubTotal));

}

function calcShippingTotal() {

    var totalPallets = $("#total-pallets-input").val() || 0;
    var shippingRate = $("#shipping-rate").text() || 0;
    var shippingTotal = totalPallets * shippingRate;
    
    $("#shipping-subtotal").val(CommaFormatted(shippingTotal));

}

function calcOrderTotal() {

    var orderTotal = 0;

    var productSubtotal = $("#product-subtotal").val() || 0;
    var shippingSubtotal = $("#shipping-subtotal").val() || 0;
    var underTotal = $("#under-box").val() || 0;
        
    var orderTotal = parseInt(CleanNumber(productSubtotal)) + parseInt(CleanNumber(shippingSubtotal));    
        
    $("#order-total").val(CommaFormatted(orderTotal));
    
    $("#fc-price").attr("value", orderTotal);
    
}

// DOM READY
$(function() {

    var inc = 1;

    $(".product-title").each(function() {
        
        $(this).addClass("prod-" + inc).attr("rel", "prod-" + inc);
    
        var prodTitle = $(this).text();
                
        $("#foxycart-order-form").append("<input type='hidden' name='" + prodTitle + "' value='' class='prod-" + inc + "' />");
        
        inc++;
    
    });
    
    // Reset form on page load, optional
    $("#order-table input[type=text]:not('#product-subtotal')").val("");
    $("#product-subtotal").val("LKR 0");
    $("#shipping-subtotal").val("$0");
    $("#fc-price").val("$0");
    $("#order-total").val("$0");
    $("#total-pallets-input").val("0");
    
    // "The Math" is performed pretty much whenever anything happens in the quanity inputs
    $('.num-pallets-input').bind("focus blur change keyup", function(){
    
        // Caching the selector for efficiency 
        var $el = $(this);
    
        // Grab the new quantity the user entered
        var numPallets = CleanNumber($el.val());
                
        // Find the pricing
        var multiplier = $el
            .parent().parent()
            .find("td.price-per-pallet span")
            .text();
        
        // If the quantity is empty, reset everything back to empty
        if ( (numPallets == '') || (numPallets == 0) ) {
        
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
        
        // If the quantity is valid, calculate the row total
        } else if ( (IsNumeric(numPallets)) && (numPallets != '') ) {
            
            var rowTotal = numPallets * multiplier;
            
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val(rowTotal);
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
                    
            applyName(titleClass, numPallets);
        
        // If the quantity is invalid, let the user know with UI change                                    
        } else {
        
            $el
                .addClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
            
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
                                          
        };
        
        // Calcuate the overal totals
        calcProdSubTotal();
        calcTotalPallets();
        calcShippingTotal();
        calcOrderTotal();
    
    });

});
$(document).ready(function(){
  $("#hideAccessories").click(function(){
    $(".Accessories").hide();
  });
  $("#showAccessories").click(function(){
    $(".Accessories").show();
  });
});

$(document).ready(function(){
  $("#hideGangSwitches").click(function(){
    $(".GangSwitches").hide();
  });
  $("#showGangSwitches").click(function(){
    $(".GangSwitches").show();
  });
});

$(document).ready(function(){
  $("#hideOtherswitches").click(function(){
    $(".Otherswitches").hide();
  });
  $("#showOtherswitches").click(function(){
    $(".Otherswitches").show();
  });
});

$(document).ready(function(){
  $("#hideSockets").click(function(){
    $(".Sockets").hide();
  });
  $("#showSockets").click(function(){
    $(".Sockets").show();
  });
});

$(document).ready(function(){
  $("#hideSwitchGears").click(function(){
    $(".SwitchGears").hide();
  });
  $("#showSwitchGears").click(function(){
    $(".SwitchGears").show();
  });
});
</script>

  <div class="main-content" id="panel">
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Place Food Order</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Food Order Form</a></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row justify-content-center">
        <div class=" col ">
          <div class="card">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Fill Your Favourite</h3>
            </div>
            <div class="card-body">
            <?php if(isset($_GET['message'])): ?>
              <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4 class="alert-heading">Warning!</h4>
                <p class="mb-0">Please Enter The Correct Quentity Value</a>.</p>
              </div>
					    <?php endif; ?>

            <div id="table-responsive">

              <form action="<?php url("food/placeOrder"); ?>" method="post">
                <table id="order-table">
                    <tr>
                        <th>Product Name</th> 
                        <th>Quantity</th>
                        <th>X</th>
                        <th>Unit Price</th>
                        <th>=</th>
                        <th >Totals</th> 
                    </tr>
                    
                      <tr>
                        <td>
                        <button type="button" class="btn btn-outline-primary btn-sm px-3" id="hideAccessories"><strong>-</strong></button>
                        <button type="button" class="btn btn-outline-primary btn-sm px-3" id="showAccessories"><strong>+</strong></button>
                          <strong>Accessories</strong>  
                            
                        </td>
                      </tr>
                      
                      <?php foreach($food as $key=>$value): //var_dump($value); ?>
                      <?php if($value['category'] == "kottu"): //var_dump($value); ?>
                      <tr class="Accessories">
                      <td class="product-title"><?php echo $value['food_name']; ?><input type="hidden" name="<?php echo $value['food_name']; ?>" value="<?php echo $value['food_id']; ?>"></input></td>
                          <td class="num-pallets"><input type="text" name="<?php echo 'qty-'.$value['food_name']; ?>" class="num-pallets-input form-control form-control-sm" id="sparkle-num-pallets" value="0"></input></td>
                          <td class="times">X</td>
                          <td class="price-per-pallet">LKR<span><?php echo $value['price']; ?> </span></td>
                          <td class="equals">=</td>
                          <td class="row-total"><input type="text" class="row-total-input form-control form-control-sm" id="sparkle-row-total" disabled="disabled"></input></td>
                      </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                      <tr>
                        <td>
                        <button type="button" class="btn btn-outline-primary btn-sm px-3" id="hideGangSwitches"><strong>-</strong></button>
                        <button type="button" class="btn btn-outline-primary btn-sm px-3" id="showGangSwitches"><strong>+</strong></button>
                            <strong>Gang Switches</strong>
                        </td>
                      </tr>
                      
                      <?php foreach($food as $key=>$value): //var_dump($value); ?>
                      <?php if($value['category'] == "rice and curry"): //var_dump($value); ?>
                      <tr class="GangSwitches">
                      <td class="product-title"><?php echo $value['food_name']; ?><input type="hidden" name="<?php echo $value['food_name']; ?>" value="<?php echo $value['food_id']; ?>"></input></td>
                 
                          <td class="num-pallets"><input type="text" name="<?php echo 'qty-'.$value['food_name']; ?>" class="num-pallets-input form-control form-control-sm" id="sparkle-num-pallets" value="0"></input></td>
                          <td class="times">X</td>
                          <td class="price-per-pallet">LKR<span><?php echo  $value['price']; ?> </span></td>
                          <td class="equals">=</td>
                          <td class="row-total"><input type="text" class="row-total-input form-control form-control-sm" id="sparkle-row-total" disabled="disabled"></input></td>
                      </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>

                      <tr>
                      <td>
                      <button type="button" class="btn btn-outline-primary btn-sm px-3" id="hideOtherswitches"><strong>-</strong></button>
                        <button type="button" class="btn btn-outline-primary btn-sm px-3" id="showOtherswitches"><strong>+</strong></button>
                          <strong>Other switches</strong>
                      </td>
                      </tr>
                      <?php foreach($food as $key=>$value): //var_dump($value); ?>
                      <?php if($value['category'] == "noodles" ): //var_dump($value); ?>
                      <tr class="Otherswitches">
                      
                      <td class="product-title"><?php echo $value['food_name']; ?><input type="hidden" name="<?php echo $value['food_name']; ?>" value="<?php echo $value['food_id']; ?>"></input></td>
                    \
                          <td class="num-pallets"><input type="text" name="<?php echo 'qty-'.$value['food_name']; ?>" class="num-pallets-input form-control form-control-sm" id="sparkle-num-pallets" value="0"></input></td>
                          <td class="times">X</td>
                          <td class="price-per-pallet">LKR<span><?php echo  $value['price']; ?> </span></td>
                          <td class="equals">=</td>
                          <td class="row-total"><input type="text" class="row-total-input form-control form-control-sm" id="sparkle-row-total" disabled="disabled"></input></td>
                      </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                      
                    
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td > <strong>Product SUBTOTAL:</strong> </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                          <td >
                             
                              <input type="text" name="subTotal" class="total-box " value="" id="product-subtotal" readonly="readonly"></input>
                          </td>
                      </tr>
                      <tr>
                      <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      <td >
                      <input type="submit" name="placeOrder"  class="btn btn-success"/>
                          </td>
                      
                      </tr>
                </table>
              </form>
    	
        
              
            </div>
          </div>
        </div>
      </div>
      </div>

      <script>
            


            
        </script>

  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/clipboard/dist/clipboard.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>


</body>

</html>
