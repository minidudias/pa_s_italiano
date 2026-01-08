function changeView(){
    var signUpBox = document.getElementById("signUpBox"); 
    var signInBox = document.getElementById("signInBox"); 
    signUpBox.classList.toggle("d-none"); 
    signInBox.classList.toggle("d-none"); 
}

function signUp() {
    var f = document.getElementById("f");
    var l = document.getElementById("l");
    var e = document.getElementById("e");
    var p = document.getElementById("p");
    var m = document.getElementById("m");
    var g = document.getElementById("g");

    var form = new FormData;
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);
    form.append("g", g.value);


    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Account was created successfully!") {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msg_1").className = "bi bi-emoji-laughing-fill fs-6";
                document.getElementById("alertdiv").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
                setTimeout(function(){
                    window.location = "index.php";
                }, 3000);
            } else {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msg_1").className = "bi bi-x-octagon-fill fs-6";
                document.getElementById("alertdiv").className = "alert alert-danger";
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    };
    request.open("POST", "signup.php", true);
    request.send(form);
}

function signIn() {
    var email = document.getElementById("signineml");
    var password = document.getElementById("signinpwd");
    var rememberme = document.getElementById("signinremme");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
                document.getElementById("msgdiv2").className = "d-block";
            }
        }
    };

    r.open("POST", "signin.php", true);
    r.send(f);
}

var bm;
function forgottenPw() {
    var email = document.getElementById("signineml");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Verification code was sent to your email inbox.") {
                document.getElementById("msg3_1").className = "bi bi-envelope-paper-fill fs-6";
                document.getElementById("alertdiv3").className = "alert alert-warning";
                document.getElementById("msg3").innerHTML = t;
                document.getElementById("msgdiv2").className = "d-none";
                document.getElementById("msgdiv3").className = "d-block";
                var m = document.getElementById("forgottenPwModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                document.getElementById("msg2").innerHTML = t;
                document.getElementById("msgdiv2").className = "d-block";
                
            }

        }
    }

    r.open("GET", "pwrecover.php?e=" + email.value, true);
    r.send();
}

function showPw() {
    var npinput = document.getElementById("npinput");
    var eye1 = document.getElementById("eye1");

    if (npinput.type == "password") {
        npinput.type = "text";
        eye1.className = "bi bi-eye-slash-fill";
    } else {
        npinput.type = "password";
        eye1.className = "bi bi-eye-fill";
    }
}

function showRtPw() {
    var rtpwinput = document.getElementById("rtpwinput");
    var eye2 = document.getElementById("eye2");

    if (rtpwinput.type == "password") {
        rtpwinput.type = "text";
        eye2.className = "bi bi-eye-slash-fill";
    } else {
        rtpwinput.type = "password";
        eye2.className = "bi bi-eye-fill";
    }
}

function showSignInPw(){
    var sipwinput=document.getElementById("signinpwd");
    var eye3=document.getElementById("eye3");

    if(sipwinput.type=="password"){
        sipwinput.type="text";
        eye3.className="bi bi-eye-slash-fill";
    }else{
        sipwinput.type="password";
        eye3.className="bi bi-eye-fill";
    }
}

function showSignUpPw(){
    var supwinput=document.getElementById("p");
    var eye4=document.getElementById("eye4");

    if(supwinput.type=="password"){
        supwinput.type="text";
        eye4.className="bi bi-eye-slash-fill";
    }else{
        supwinput.type="password";
        eye4.className="bi bi-eye-fill";
    }
}

function reStPass() {
    var usereml = document.getElementById("signineml");
    var npinput = document.getElementById("npinput");
    var rtpwinput = document.getElementById("rtpwinput");
    var vericd = document.getElementById("vericd");

    var f = new FormData();
    f.append("e", usereml.value);
    f.append("n", npinput.value);
    f.append("r", rtpwinput.value);
    f.append("v", vericd.value);

    var xMLHTTPRequest = new XMLHttpRequest();

    xMLHTTPRequest.onreadystatechange = function () {
        if (xMLHTTPRequest.readyState == 4) {
            var respTxt = xMLHTTPRequest.responseText;
            if (respTxt == "Successfully updated the password.") {
                setTimeout(function(){
                    bm.hide();
                    document.getElementById("npinput").value = "";
                    document.getElementById("rtpwinput").value = "";
                    document.getElementById("vericd").value = "";
                }, 3000);
                
                document.getElementById("msg3_1").className = "bi bi-emoji-laughing-fill fs-6";
                document.getElementById("msg3").innerHTML = respTxt;
                document.getElementById("alertdiv3").className = "alert alert-success";
                document.getElementById("msgdiv2").className = "d-none";
                document.getElementById("msgdiv3").className = "d-block";
            } else {
                document.getElementById("msg3_1").className = "bi bi-x-octagon-fill fs-6";
                document.getElementById("msg3").innerHTML = respTxt;
                document.getElementById("alertdiv3").className = "alert alert-danger";
                ocument.getElementById("msgdiv3").className = "d-block";
            }
        }
    };

    xMLHTTPRequest.open("POST", "pwsavereset.php", true);
    xMLHTTPRequest.send(f);
}

function signOut() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location="index.php";
            } else {
                alert(t);
            }
        }
    };


    r.open("GET","signoff.php",true);
    r.send();
}


function basicSearch(x) {
    var sbrtext = document.getElementById("basic_search_txt");
    var cat_sel = document.getElementById("basic_search_select");

    var f = new FormData();

    f.append("sbrtext", sbrtext.value);
    f.append("cat_sel", cat_sel.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResults").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}


function clearSorting() {
    window.location.reload();
}
function clearSorting1() {
    window.location = "pizza.php";
}
function clearSorting2() {
    window.location = "pasta.php";
}
function clearSorting3() {
    window.location = "lasagne.php";
}
function clearSorting4() {
    window.location = "appetizer.php";
}
function clearSorting5() {
    window.location = "dessert.php";
}
function clearSorting6() {
    window.location = "beverage.php";
}
function clearSorting7() {
    window.location = "manageproducts.php?page=1";
}
function clearSorting8() {
    window.location = "historyofsellings.php?page=1";
}

function advancedSearchStart(x) {
    var t = document.getElementById("t");
    var cat = document.getElementById("cat");
    var pf = document.getElementById("pf");
    var pt = document.getElementById("pt");
    var sortby = document.getElementById("sortby");

    var f = new FormData();
    f.append("t", t.value);
    f.append("cat", cat.value);
    f.append("pf", pf.value);
    f.append("pt", pt.value);
    f.append("sortby", sortby.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("searchResultViewer").innerHTML = t;
        }
    }

    r.open("POST", "searchpizza.php", true);
    r.send(f);
}
function advancedSearchStart1(x) {
    var t = document.getElementById("t");
    var cat = document.getElementById("cat");
    var pf = document.getElementById("pf");
    var pt = document.getElementById("pt");
    var sortby = document.getElementById("sortby");

    var f = new FormData();
    f.append("t", t.value);
    f.append("cat", cat.value);
    f.append("pf", pf.value);
    f.append("pt", pt.value);
    f.append("sortby", sortby.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("searchResultViewer1").innerHTML = t;
        }
    }

    r.open("POST", "searchpasta.php", true);
    r.send(f);
}
function advancedSearchStart2(x) {
    var t = document.getElementById("t");
    var cat = document.getElementById("cat");
    var pf = document.getElementById("pf");
    var pt = document.getElementById("pt");
    var sortby = document.getElementById("sortby");

    var f = new FormData();
    f.append("t", t.value);
    f.append("cat", cat.value);
    f.append("pf", pf.value);
    f.append("pt", pt.value);
    f.append("sortby", sortby.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("searchResultViewer2").innerHTML = t;
        }
    }

    r.open("POST", "searchinglasagne.php", true);
    r.send(f);
}
function advancedSearchStart4(x) {
    var t = document.getElementById("t");
    var cat = document.getElementById("cat");
    var pf = document.getElementById("pf");
    var pt = document.getElementById("pt");
    var sortby = document.getElementById("sortby");

    var f = new FormData();
    f.append("t", t.value);
    f.append("cat", cat.value);
    f.append("pf", pf.value);
    f.append("pt", pt.value);
    f.append("sortby", sortby.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("searchResultViewer4").innerHTML = t;
        }
    }

    r.open("POST", "searchappetizer.php", true);
    r.send(f);
}
function advancedSearchStart5(x) {
    var t = document.getElementById("t");
    var cat = document.getElementById("cat");
    var pf = document.getElementById("pf");
    var pt = document.getElementById("pt");
    var sortby = document.getElementById("sortby");

    var f = new FormData();
    f.append("t", t.value);
    f.append("cat", cat.value);
    f.append("pf", pf.value);
    f.append("pt", pt.value);
    f.append("sortby", sortby.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("searchResultViewer5").innerHTML = t;
        }
    }

    r.open("POST", "searchdessertstuff.php", true);
    r.send(f);
}
function advancedSearchStart6(x) {
    var t = document.getElementById("t");
    var cat = document.getElementById("cat");
    var pf = document.getElementById("pf");
    var pt = document.getElementById("pt");
    var sortby = document.getElementById("sortby");

    var f = new FormData();
    f.append("t", t.value);
    f.append("cat", cat.value);
    f.append("pf", pf.value);
    f.append("pt", pt.value);
    f.append("sortby", sortby.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("searchResultViewer6").innerHTML = t;
        }
    }

    r.open("POST", "searchbeverage.php", true);
    r.send(f);
}

$('.test-popup-link').magnificPopup({
    type: 'image'
    // other options
});

function addToWatchList(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Removed") {
                document.getElementById("heart" + id).classList = "bi bi-suit-heart-fill text-secondary fs-1 heart text-center";
            } else if (t == "Added") {
                document.getElementById("heart" + id).classList = "bi bi-suit-heart-fill text-danger fs-1 heart text-center";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "favadd.php?id=" + id, true);
    r.send();
}

function removeFromWatchList(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Removed") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "delfav.php?id=" + id, true);
    r.send();
}

function removeFrom(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Removed") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "delrec.php?id=" + id, true);
    r.send();
}

function ShowPwFieldOFUserProfilePage() {
    var pwinpfield = document.getElementById("pwi");
    var eye3 = document.getElementById("eye7");

    if (pwinpfield.type == "password") {
        pwinpfield.type = "text";
        eye3.className = "bi bi-eye-slash-fill text-black";
    } else {
        pwinpfield.type = "password";
        eye3.className = "bi bi-eye-fill text-black";
    }
}

function updatePfp() {
    var view = document.getElementById("pfpview"); //pfp viewer section grabber
    var file = document.getElementById("profileimg"); //file chooser part grabber

    file.onchange = function () {
        var file1 = this.files[0];
        var pfpUrl = window.URL.createObjectURL(file1);
        view.src = pfpUrl;
    }
}






function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var city = document.getElementById("selecity");
    var district = document.getElementById("saul");
    var province = document.getElementById("pwi");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimg");

    var formDat = new FormData();
    formDat.append("f", fname.value);
    formDat.append("l", lname.value);
    formDat.append("m", mobile.value);
    formDat.append("lone", line1.value);
    formDat.append("ltwo", line2.value);
    formDat.append("c", city.value);
    formDat.append("d", district.value);
    formDat.append("p", province.value);
    formDat.append("pcd", pcode.value);

    if (image.files.length == 0) {
        
    } else {
        formDat.append("image", image.files[0]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };

    r.open("POST", "manageprofile.php", true);
    r.send(formDat);
}

var adminverif;
function adminVerification(){
    var email=document.getElementById("admineml");

    var f=new FormData();
    f.append("admineml",email.value);

    var r=new XMLHttpRequest();

    r.onreadystatechange=function(){
        if(r.readyState==4){
            var text = r.responseText;
            if (text == "Verification code was sent. Please check your email inbox.") {
                document.getElementById("msgu").innerHTML = text;
                document.getElementById("msg_u").className = "bi bi-envelope-paper-fill fs-6";
                document.getElementById("alertdivu").className = "alert alert-warning rounded-0";
                document.getElementById("msgdivu").className = "d-block";
                
            } else {
                document.getElementById("msgu").innerHTML = text;
                document.getElementById("msg_u").className = "bi bi-x-octagon-fill fs-6";
                document.getElementById("alertdivu").className = "alert alert-danger rounded-0";
                document.getElementById("msgdivu").className = "d-block";
            }
        }
    }

    r.open("POST","sendadmincode.php",true);
    r.send(f);
}


function adminVerify(){
    var adminverify=document.getElementById("vericd");

    var req=new XMLHttpRequest();

    req.onreadystatechange=function(){
        if(req.readyState==4){
            var t=req.responseText;
            if (t == "okay") {
                window.location="adminpanel.php";
                document.getElementById("admineml").value = "";
                document.getElementById("vericd").value = "";
                
            } else {
                document.getElementById("msgu").innerHTML = t;
                document.getElementById("msg_u").className = "bi bi-x-octagon-fill fs-6";
                document.getElementById("alertdivu").className = "alert alert-danger rounded-0";
                document.getElementById("msgdivu").className = "d-block";
            }
            
        }
    }

    req.open("GET","processadminverify.php?v="+adminverify.value,true);
    req.send();
}

function dynamicTime(){
    setInterval(function(){
        timeViewer();
    },999);
}

function timeViewer(){
    var r =new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            document.getElementById("timethingie").innerHTML=t;
        }
    }
    r.open("GET","timer.php",true);
    r.send();
}

function qtyBadge(){
    setInterval(function(){
        dynamicBadgeQty();
    },1500);
}

function dynamicBadgeQty(){
    var r =new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            document.getElementById("qtybadge").innerHTML=parseInt(t);
        }
    }
    r.open("GET","cartQuantityCalc.php",true);
    r.send();
}

function payNow(id) {
    var qty = document.getElementById("qtyInput").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var email = obj["email"];
            var amount = obj["amount"];
            var hash = obj["hash"];

            if (t == "1") {
                alert("Please log in or sign up");
                window.location = "login_register.php";
                document.getElementById("qtyInput").value = "";
            } else if (t == "2") {
                alert("Please update you address details first");
                window.location = "user.php";
                document.getElementById("qtyInput").value = "";
            } else {
                document.getElementById("qtyInput").value = "";
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId,id,email,amount,qty);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1222064",    // Replace your Merchant ID
                    "return_url": "http://localhost/pa_s_italiano/view.php?meal=id" + id,     // Important
                    "cancel_url": "http://localhost/pa_s_italiano/view.php?meal=id" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": hash,
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": email,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                    payhere.startPayment(payment);
                // };
            }

        }
    }

    r.open("GET", "finallypayforstuff.php?id=" + id + "&qty=" + qty, true)
    r.send();

}

function saveInvoice(orderId,id,email,amount,qty){
    var f=new FormData();
    f.append("o",orderId);
    f.append("i",id);
    f.append("m",email);
    f.append("a",amount);
    f.append("q",qty);

    var r=new XMLHttpRequest();

    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            if(t=="1"){
                window.location = "invoice.php?id=" + orderId;
            }else{
            alert(t);
            }
        }
    } 
    r.open("POST","invoicesaver.php",true);
    r.send(f);
}

var modalbs;
function addFeedback(id){
    var feedbackModal=document.getElementById("feedbackModal"+id);
    modalbs=new bootstrap.Modal(feedbackModal);
    modalbs.show();
}


function saveFeedback(id){
    var type;
    if(document.getElementById("type1").checked){
        type = 1;
    }else if(document.getElementById("type2").checked){
        type = 2;
    }else if(document.getElementById("type3").checked){
        type = 3;
    }
    var feedback = document.getElementById("feed");

    var f = new FormData();
    f.append("pid",id);
    f.append("t",type);
    f.append("feed",feedback.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () { 
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "1"){
                modalbs.hide();
            }else{
                alert (t);
            }
        }}      
    r.open("POST","feedbacksSavingProc.php",true);
    r.send(f);
}



// Instantiate EasyZoom instances
var $easyzoom = $('.easyzoom').easyZoom();

// Get an instance API
var api = $easyzoom.data('easyZoom');

function addToShoppingCart(pid) {  
    var qty = document.getElementById("qtyInput").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            
            if(window.location == "http://localhost/pa_s_italiano/view.php?meal="+pid){
                window.location.reload();
            }
            if (t != "") {
                alert(t);
            }
        }
    }

    r.open("GET", "addToCartProc.php?pid=" + pid + "&qty=" + qty, true);
    r.send();
}

function updtShoppingCart(pid) {  
    var qty = document.getElementById("qtyInput" + pid).value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t != "") {
                alert(t);
                window.location.reload();
            }else{
                window.location.reload();
            } 
        }
    }

    r.open("GET", "updtCartProc.php?pid=" + pid + "&qty=" + qty, true);
    r.send();
}

function favShoppingCart(pid) {  
    var qty = document.getElementById("qtyInput" + pid).value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t != "") {
                alert(t);
            } 
        }
    }

    r.open("GET", "favCartProc.php?pid=" + pid + "&qty=" + qty, true);
    r.send();
}

function printInvoice(){
    var page=document.getElementById("page").innerHTML;
    document.body.innerHTML=page;
    window.print();
}

function deleteFromCart(id){
    var  r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;

            if(t =="Deleted"){
                window.location.reload();
            }else{
                alert (t);
            }
        }
    }

    r.open("GET","delFromCartProcess.php?id="+id,true);
    r.send();
}

function dynamicMsg(){
    setInterval(function(){
        msgViewer();
    },999);
}
function msgViewer(){
    var r =new XMLHttpRequest();
    r.onreadystatechange=function(){
        if(r.readyState==4){
            var t=r.responseText;
            document.getElementById("chat_box").innerHTML=t;
        }
    }
    r.open("GET","dynaMsgBox.php",true);
    r.send();
}

function sendMessage() {
    var msg_txt = document.getElementById("msg_txt");
    

    var f = new FormData();
    f.append("mt",msg_txt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "1"){
                document.getElementById("msg_txt").value = "";
            }else{
                alert (t);
            }
        }
    }

    r.open("POST","messageSendingProcess.php",true);
    r.send(f);
}

function adminSignOutFunct(){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location="adminsignin.php";
            } else {
                alert(t);
            }
        }
    };
    r.open("GET","signoffadmin.php",true);
    r.send();
}

var mm;
function viewMsgModal(email){
    var m = document.getElementById("userMsgModal"+email);
    mm =new bootstrap.Modal(m);
    mm.show();
    setInterval(function(){
        viewUserMsg(email);
    },999);
    
}

function blockUser(email){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "blocked"){
                document.getElementById("ub"+email).innerHTML = "Unblock";
                document.getElementById("ub"+email).classList = "btn btn-success";
            }else if(txt == "unblocked"){
                document.getElementById("ub"+email).innerHTML = "Block";
                document.getElementById("ub"+email).classList = "btn btn-danger";
            }else{
                alert (txt);
            }
        }
    }

    request.open("GET","blockingUsers.php?email="+email,true);
    request.send();
}

function sendUserMsg(email) {

    var txt = document.getElementById("adminmsgtxt" + email).value;

    var f = new FormData();
    f.append("t", txt);
    f.append("r", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            if( t != "success1"){
                alert(t);
                document.getElementById("adminmsgtxt" + email).value = "";
            }else if( t == "success1"){
                document.getElementById("adminmsgtxt" + email).value = "";
            }
        }
    };

    r.open("POST", "sendUserMessageProcess.php");
    r.send(f);

}

function viewUserMsg(email2){
    
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){

        if(r.readyState == 4){
            var t = r.responseText;
            document.getElementById("userMsgBox"+email2).innerHTML = t;
        }
    };

    r.open("GET","viewUserMsg.php?e="+email2,true);
    r.send();
}

function seriesLoader() {
    var cat = document.getElementById("category").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("brand").innerHTML = t;
        }
    };

    r.open("GET", "seriesLoader.php?cat=" + cat, true);
    r.send();
}

function attributeLoader() {
    var ca = document.getElementById("category").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("model").innerHTML = t;
        }
    };

    r.open("GET", "atrLoader.php?ca=" + ca, true);
    r.send();
}

function changeProdImg() {
    var image = document.getElementById("imageuploader");

    image.onchange = function () {
        var file_count = image.files.length;

        if (file_count <= 1) {
            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("f" + x).src = url;
            }
        } else {
            alert("Please Select an Image of the Meal.");
        }

    }
}






function addProd() {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title"); 
    var cost = document.getElementById("cost");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();

    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("cost", cost.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product was saved and image was uploaded successfully") {
                alert(t);
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "productAdditionProcess.php", true);
    r.send(f);
}

function sort1(x) {
    var sbr = document.getElementById("sbr");
    var sortby = document.getElementById("sortby");

    var addedTime = "0";
    if (document.getElementById("nto").checked) {
        addedTime = "1";
    } else if (document.getElementById("otn").checked) {
        addedTime = "2";
    }
    

    var avaiQuan = "0";
    if (document.getElementById("h").checked) {
        avaiQuan = "1";
    } else if (document.getElementById("l").checked) {
        avaiQuan = "2";
    }

    

    var f = new FormData();
    f.append("s", sbr.value);
    f.append("c", sortby.value);
    f.append("t", addedTime);
    f.append("q", avaiQuan);
    f.append("page", x);
    
   

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;
        }
    }

    r.open("POST", "sortingProcess1.php", true);
    r.send(f);
}

function sendId(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateproduct.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendProductIDProcess.php?id=" + id, true);
    r.send();
}
function toggleActiveState(id) {
    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "deactivated") {

                alert("Your Product is Now Deactivated!");
                window.location.reload();

            } else if (t == "activated") {

                alert("Your Product is Now Activated!");
                window.location.reload();

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "toggleActiveStateProcess.php?p=" + product_id, true);
    r.send();
}
function delProd(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Removed") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "processOfRemovingFromMyProducts.php?id=" + id, true);
    r.send();
}

function productUpdate() {
    var title = document.getElementById("t");
    var price = document.getElementById("q");
    var desc = document.getElementById("description");
    var selectedImgs = document.getElementById("imageuploader");

    var formDat = new FormData();
    formDat.append("title", title.value);
    formDat.append("price", price.value);
    formDat.append("desc", desc.value);

    var count_of_imgs = selectedImgs.files.length;

    for (var i = 0; i < count_of_imgs; i++) {
        formDat.append("f" + i, selectedImgs.files[i]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var respTxt = r.responseText;
            alert(respTxt);
        }
    }

    r.open("POST", "productUpdateProcess.php", true);
    r.send(formDat);
}

function findSellings(x) { //Grabbing the passed value when calling this JS function as "x"
    var s = document.getElementById("t"); //Grabbing the inserted search by subject name text, that was passed using the AJAX method.
    var d = document.getElementById("fd"); //Grabbing the inserted search by lesson date value, that was passed using the AJAX method.
    var d1 = document.getElementById("td");
    var f = new FormData();
    f.append("s", s.value); //Appending grabbed, inserted search by subject name text value to the created FormData
    f.append("d", d.value); //Appending grabbed, inserted search by lesson date value to the created FormData
    f.append("d1", d1.value); 
    f.append("page", x); //Appending the passed value to the created FormData as "page".

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("viewArea").innerHTML = t; //Changing inner HTML of the page element with the "viewArea" ID, of the "View Lesson Notes" page.
        }
    }

    r.open("POST", "findSellingsProcess.php", true); 
    r.send(f);
}

function changeInvoiceStatus(id) {

    var req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if (req.readyState == 4) {
            var res = req.responseText;
            if (res == 1) {
                document.getElementById("btnfs" + id).innerHTML = "Packing";
                document.getElementById("btnfs" + id).classList = "btn btn-warning fw-bold mt-1 mb-1 rounded-0";
            } else if (res == 2) {
                document.getElementById("btnfs" + id).innerHTML = "Dispatch";
                document.getElementById("btnfs" + id).classList = "btn btn-info  fw-bold mt-1 mb-1 rounded-0";
            } else if (res == 3) {
                document.getElementById("btnfs" + id).innerHTML = "Shipping";
                document.getElementById("btnfs" + id).classList = "btn btn-primary  fw-bold mt-1 mb-1 rounded-0";
            } else if (res == 4) {
                document.getElementById("btnfs" + id).innerHTML = "Delivered";
                document.getElementById("btnfs" + id).classList = "btn btn-success  fw-bold mt-1 mb-1 rounded-0 disabled";
            } else {
                alert(res);
            }
        }
    };

    req.open("GET", "processOfChangeOrderState.php?id=" + id, true);
    req.send();

}

function sendDate() {
    var d = document.getElementById("dat1").value;
    var d1 = document.getElementById("dat2").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "historyofsellings.php";
                document.getElementById("dat1").value = "";
                document.getElementById("dat2").value = "";
            } else {
                alert(t);
                document.getElementById("dat1").value = "";
                document.getElementById("dat2").value = "";
            }
        }
    }

    r.open("GET", "sendDateProcess.php?d=" + d + "&d1=" + d1, true);
    r.send();[]
}



// checkout

function cartCheckout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];
            var hash = obj["hash"];

            if (t == "1") {
                alert("Please log in or sign up");
                window.location = "login_register.php";
            } else if (t == "2") {
                alert("Please update your profile first");
                window.location = "user.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {

                    console.log("Payment completed. OrderID:" + orderId);

                    saveCheckoutInvoice(orderId, mail, amount);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1222064",    // Replace your Merchant ID
                    "return_url": "http://localhost/pa_s_italiano/shoppingcart.php",     // Important
                    "cancel_url": "http://localhost/pa_s_italiano/shoppingcart.php",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": hash,
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };

            };
        }
    };

    r.open("GET", "cartCheckoutProcess.php", true);
    r.send();

}

// checkout

function saveCheckoutInvoice(orderId, mail, amount) { 

    var f = new FormData();
    f.append("o", orderId);
    f.append("m", mail);
    f.append("a", amount);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "checkoutInvoiceSave.php", true);
    r.send(f);

}







var r= new XMLHttpRequest();
r.onreadystatechange = function(){
    if(this.readyState==4){
        var t = r.responseText;
        
    }
}