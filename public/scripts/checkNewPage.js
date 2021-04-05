//global variable that contains the page value (is it opened or not)
var newWindow = null;
var newOrderWindow = null;

//function checks that page is not opened atm and opens it (if other page of the 
//same type is opened then it will be replaced by the current one)
function openOrderPage(winURL)
{
    if ((newOrderWindow == null) || (newOrderWindow.closed))
    {
        newWindow = window.open(winURL,'product_Bazaar_Ceramics','');
    } 
}

function openRegistrationPage(winURL)
{
    if ((newWindow == null) || (newWindow.closed))
    {
        newWindow = window.open(winURL,'registration_Bazaar_Ceramics','');
    } 
}

function openCheckoutPage(winURL)
{
    if ((newWindow == null) || (newWindow.closed))
    {
        newWindow = window.open(winURL,'checkout_Bazaar_Ceramics','');
    } 
}
