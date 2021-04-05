//Clear 
document.getElementById("clearForm").addEventListener("click", function(event){
    event.preventDefault()
    clear();
})

function clear() {
    //save values of submit and clear buttons
    let submitBtn = document.querySelector('input[type="submit"]').value;    
    let clearBtn = document.querySelector("#clearForm").value;    
    //get all inputs
    let inputs = document.getElementsByTagName("input");

    //clear all inputs
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].value = null; 
    }
    
    //assign saved values to submit and clear buttons
    document.querySelector('input[type="submit"]').value = submitBtn;
    document.querySelector("#clearForm").value = clearBtn;
}