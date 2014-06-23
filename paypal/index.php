<?php
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='biz_test@vontracts.com'; // Business email ID
?>
<html>
<head>
    <title>Payment</title>
    <script type="text/javascript">
        var price = 0;
        var selectedValue = 0;
        
        function changeFunc() {
            var itemNo = 0;
            var selectBox = document.getElementById("credits");                       

            selectedValue = selectBox.options[selectBox.selectedIndex].value;        

            switch(parseInt(selectedValue)){
                case 1: 
                    price = 1;
                    itemNo = 1;                                        
                    break;
                case 10:
                    price = 8;
                    itemNo = 2;
                    break;
                case 50:
                    price = 35;
                    itemNo = 3;
                    break;
                case 100:
                    price = 60;
                    itemNo = 4;
                    break;
                default:
                    price = 0; 
                    console.log(selectedValue);
            }  

            document.getElementById("price").innerHTML = "$" + price;
            recalculate();
            updateItemNo(itemNo);

           }

           function updateItemNo(itemNo){
                document.getElementsByName("item_number")[0].value = itemNo;
           }

           function calculate(){
                var quantity = document.getElementById("quantity").value;
                var total = quantity * price;
                document.getElementById("total").innerHTML = "$" + total;

                document.getElementsByName("amount")[0].value = total;
           }

           function recalculate(){
                var quantity = document.getElementById("quantity").value;
                if(quantity > 0){
                    calculate();
                }
           }
    </script>
</head>
<body>
    <h4>Welcome, Guest</h4>

<div class="product">
    <div class="name">
        Test Credits Payment
    </div>
    <div class="price">
        <table>
            <thead>
                <tr>
                    <th>Credits</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>            
            </thead>
            <body>
                <tr>
                    <td>
                        <select onchange="changeFunc();" id="credits">
                            <option value=0 selected>Select Credits</option>
                            <option value=1>1 VC</option>
                            <option value=10>10 VC</option>
                            <option value=50>50 VC</option>
                            <option value=100>100 VC</option>
                        </select>
                    </td>
                    <td id="price">$0</td>
                    <td><input type="text" value=0 id="quantity" onblur="calculate(this);"/></td>
                    <td id="total">$0</td>
                </tr>
            </body>
        </table>      
    </div>
    <div class="btn">
    <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="Test Credits Payment">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" value="2">
    <input type="hidden" name="cpp_header_image" value="http://www.phpgang.com/wp-content/uploads/gang.jpg">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="http://127.0.0.1:8080/paypal/cancel.php">
    <input type="hidden" name="return" value="http://127.0.0.1:8080/paypal/success.php">
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form> 
    </div>
</div>
</body>
</html>
