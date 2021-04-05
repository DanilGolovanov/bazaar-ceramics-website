$(document).ready(function(){

    //DELETE PRODUCT
    $('.remove-img, .nav-remove-img').click(function(){
        let element = this;
        let correspondingElement;
        let isProductInNavbar = $(this).attr("class") == "nav-remove-img";

        //Get IDs to delete record from db 
        let productID = $(this).data('productid');
        let orderID = $(this).data('orderid');
        let quantity = $('.cart-basket').html() - $(`.nav-remove-img[data-productid='${productID}']`).attr('data-quantity');

        //Find out which delete button was clicked (in the navbar or on the shopping cart page)
        //and find the second instance of the product 
        if (isProductInNavbar) {
            correspondingElement = $(`.remove-img[data-productid='${productID}']`);            
        } 
        else {
            correspondingElement = $(`.nav-remove-img[data-productid='${productID}']`);
        }

        let confirmAlert = confirm("Are you sure you want to delete this item from your shopping cart?\nThe entire orderline will be deleted.");

        if (confirmAlert == true) {
            //AJAX Request
            $.ajax({
                url: '/bazaar_ceramics_ss/public/html/profile/operations/delete_product.php',
                type: 'POST',
                data: { product: productID, order: orderID },
                success: function(response){
    
                    if (response == 1) {
                        if (isProductInNavbar) {
                            //Remove product from the navbar
                            $(element).closest('.nav-product').css('background','tomato');
                            $(element).closest('.nav-product').fadeOut(800,function(){
                                $(this).remove();
                            });
                            //Remove product from the shopping cart page
                            $(correspondingElement).closest('.product').css('background','tomato');
                            $(correspondingElement).closest('.product').fadeOut(800,function(){
                                $(this).remove();
                            });
                        } 
                        else {
                            //Remove product from the shopping cart page
                            $(element).closest('.product').css('background','tomato');
                            $(element).closest('.product').fadeOut(800,function(){
                                $(this).remove();
                            });
                            //Remove product from the navbar
                            $(correspondingElement).closest('.nav-product').css('background','tomato');
                            $(correspondingElement).closest('.nav-product').fadeOut(800,function(){
                                $(this).remove();
                            });
                        }
                        //Update counter in the navbar
                        $('.cart-basket').html(quantity);
                        //Remove "x product was added!" message if present on the page
                        $('.error-message').remove();
                        //Update "Total" of the order value
                        let oldTotal = $('#hidden-total').val();
                        let orderlinePrice = $(`.nav-remove-img[data-productid='${productID}']`).data('total');
                        let newTotal = (oldTotal - orderlinePrice).toFixed(2);
                        $('.nav-cart-total').html('Total: $' + newTotal);
                        $('.cart-total').html('Total: $' + newTotal);
                        $('#hidden-total').val(newTotal);
                        //Remove "Total" and display message if there are no items left
                        if (newTotal == 0) {
                            //remove total
                            $('.nav-cart-total').remove();
                            $('.cart-total').remove();
                            //display message
                            let message = '<div class="no-items">There are no items in your cart yet.<br>It\'s a good time to add some ;)</div>'
                            $('.products-wrapper').html(message);
                            $('#checkout-form').html(message);
                        }
                    }
                    else {
                        alert('Invalid ID.');
                    }
                }
            });
        }
    
    });

    //EDIT QUANTITY
    $('.cart-quantity-input').change(function(){
        let element = this;    

        //Get IDs to edit record in the db 
        let productID = $(this).data('productid');
        let orderID = $(`.nav-remove-img[data-productid='${productID}']`).data('orderid');
        let totalQuantity;

        //If the edit was targeted in the navbar the corresponding element is the input on the shopping cart page
        let correspondingElement = $(`.cart-quantity-input[data-productid='${productID}']`).not(this);
        
        let oldQuantity = $(`.nav-remove-img[data-productid='${productID}']`).attr('data-quantity');
        let newQuantity = $(this).val();

        //Total quantity of items in the shopping cart
        totalQuantity = $('.cart-basket').html() - (oldQuantity-newQuantity);
        
        if (newQuantity <= 0) {
            alert('Quantity must be at least 1.');
            $(this).val(oldQuantity);
        }
        else {
            //AJAX Request
            $.ajax({
                url: '/bazaar_ceramics_ss/public/html/profile/operations/edit_quantity.php',
                type: 'POST',
                data: { product: productID, order: orderID, quantity: newQuantity },
                success: function(response){
    
                    if (response == 1) {
                        //Change counter in the navbar
                        $('.cart-basket').html(totalQuantity);
                        //Calculate Orderline Price
                        let oldOrderlinePrice = $(`.nav-remove-img[data-productid='${productID}']`).attr('data-total');
                        let newOrderlinePrice = $(element).attr('data-price') * newQuantity;    
                        $(`.nav-remove-img[data-productid='${productID}']`).attr('data-total', newOrderlinePrice);
                        //Update "Total" of the order value
                        let oldTotal = $('#hidden-total').val();
                        let newTotal = (oldTotal - (oldOrderlinePrice - newOrderlinePrice)).toFixed(2);                        
                        $('.nav-cart-total').html('Total: $' + newTotal);
                        $('.cart-total').html('Total: $' + newTotal);
                        $('#hidden-total').val(newTotal);
                        //Update data-attributes
                        $(`.nav-remove-img[data-productid='${productID}']`).attr('data-quantity', newQuantity);
                        //Change value of the corresponding element
                        correspondingElement.val(newQuantity);
                        //Update Orderline prices
                        let orderlineElements = $(`.product-total-price[data-productid='${productID}']`);
                        for (let i = 0; i < orderlineElements.length; i++) {        
                            orderlineElements[i].innerHTML = '<span class="blue-heading">Total Price:</span> $' + newOrderlinePrice.toFixed(2);
                        }
                    }
                    else {
                        alert('Invalid ID.');
                    }
                }
            });
        }
    
    });

    //DELETE CART
    $('.btn-danger').click(function(event){
        //prevent <a> default behaviour
        event.preventDefault();

        let element = this;
        let orderID = $('.nav-remove-img').data('orderid');

        let confirmAlert = confirm("Are you sure you want to delete ALL items from your shopping cart?");

        if (confirmAlert == true) {
            //AJAX Request
            $.ajax({
                url: '/bazaar_ceramics_ss/public/html/profile/operations/delete_cart.php',
                type: 'POST',
                data: { order: orderID },
                success: function(response){
    
                    if (response == 1) {
                        //Remove products on the page and in the navbar
                        $('.nav-product, .product').each(function(e) {
                            $(this).css('background','tomato');
                            $(this).fadeOut(800,function(){
                                $(this).remove();
                            });
                        });
    
                        //Update counter in the navbar
                        $('.cart-basket').html(0);
                        //Remove "x product was added!" message if present on the page
                        $('.error-message').remove();       
                        //Remove total
                        $('.nav-cart-total').remove();
                        $('.cart-total').remove();
                        //Display message
                        let message = '<div class="no-items">There are no items in your cart yet.<br>It\'s a good time to add some ;)</div>'
                        $('.products-wrapper').html(message);
                        $('#checkout-form').html(message);

                    }
                    else {
                        alert('Invalid ID.');
                    }
                }
            });
        }
    
    });

    //OPEN NEW TAB AND REDIRECT THE CURRENT ONE
    document.getElementById("confirm-btn").onclick = function() {
        //Open new page
        window.open('/bazaar_ceramics_ss/public/html/profile/receipt.php','_blank');
        //Redirect current one
        window.location = "/bazaar_ceramics_ss/public/html/members/members.php";
    }
   
});