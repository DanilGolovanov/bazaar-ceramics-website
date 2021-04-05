<div id="register-container" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeRegister()">&times;</a>
    <div class="overlay-content reg-box">
        <div class="reg-col">
            <p id="registerTitle">Are you an existing customer of Bazaar Ceramics?</p>
            <div class="reg-row">
                <div class="wrap-50">
                    <p>If you bought something in our store before then you can register as a member straight away</p>
                </div>
                <div class="wrap-50">
                    <p>If up to this moment you have not bought anything in our store, it is a good time to do it ;)</p>                    
                </div>
            </div>
            <div class="reg-row">
                <div class="wrap-50">
                    <p>Member registration is available ONLY for <span>EXISTING CUSTOMERS</span></p>
                </div>
                <div class="wrap-50">
                    <p>But first we need you to register as our <span>NEW CUSTOMER</span> to process your orders</p>
                </div>
            </div>
            <div class="reg-row">              
                    <a href="javascript:;" target="_blank" 
                    onclick="javascript:newWindow=openRegistrationPage('<?php echo urlFor('html/signIn/verify_customer.php') ?>'); return false" 
                    class="btn ex-cust-btn">
                        I'm EXISTING Customer
                    </a>

                    <a href="javascript:;" target="_blank" 
                    onclick="javascript:newWindow=openRegistrationPage('<?php echo urlFor('html/signIn/customer_registration.php') ?>'); return false" 
                    class="btn new-cust-btn">
                        I'm NEW Customer
                    </a>    
            </div>
        </div>
    </div>
</div>


