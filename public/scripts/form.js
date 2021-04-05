//Total
// document.getElementById("totalBtn").addEventListener("click", function(event){
//     event.preventDefault() 
// })

//display info from URL in the form (info is from preload.js)
//disabled fields (that are not submitted)
document.querySelector("#itemDescription").value = desc;
document.querySelector("#price").value = parseInt(price);

//hidden fields
document.querySelector(".productID").value = productID;
document.querySelector(".itemDescription").value = desc;
document.querySelector(".price").value = parseInt(price);

function calculateTotal() {
    let input1 = document.querySelector("#price").value;    
    let input2 = document.querySelector("#quantity").value;        

    if (input1 == false) {
        document.querySelector("#price").value = parseInt(price);
        document.querySelector("#totalPrice").value  = parseInt(price) * input2;

        document.querySelector(".price").value = parseInt(price);
        document.querySelector(".totalPrice").value  = parseInt(price) * input2;
    }
    else if (input2 == false) {
        document.querySelector("#quantity").value = 1;
        alert('Quantity must be at least 1');
        calculateTotal();
    }
    else {
        document.querySelector("#totalPrice").value  = input1 * input2;
        document.querySelector(".totalPrice").value  = input1 * input2;
    }
}

//Clear 
document.getElementById("clearBtn").addEventListener("click", function(event){
    event.preventDefault()
    clear();
})

function clear() {
    document.querySelector("#totalPrice").value = null;    
    document.querySelector("#quantity").value = null;
    
    document.querySelector(".totalPrice").value = null;    
}

//Submit
function mySubmitFunction(e) {
    e.preventDefault();
    let form = document.querySelector('form');

    let description = document.querySelector('#itemDescription').value;
    let price = document.querySelector("#price").value;    
    let quantity = document.querySelector("#quantity").value; 
    let total = document.querySelector("#totalPrice").value; 
    let message = '';
    if (price && quantity && total) {
          message = confirm('Product: ' + description +
                            '\nPrice: ' + price +
                            '\nQuantity: ' + quantity +
                            '\nTotal Price: ' + total +
                            '\n\nIs this information correct?');  
    }
    else {
        alert("Fill out all fields.")
    }

    if (message) {
        form.submit();
    }
    else {
        clear();
        return false;
    }
}
