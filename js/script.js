$(document).ready(function(){
    // usefull ajax function for fetching data when ever needed 
    function fetchData(parentDiv, url, data, totalprice = '#total-Price') {
        let parentElement = $(parentDiv);
        $.ajax({
            url: url,
            type: 'POST',
            data : data,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    parentElement.empty(); 
                    parentElement.append(res.body); 
                    console.log(res.message);
                    if(res.total) {
                        $(totalprice).text(res.total);
                    }
                }else {
                    alert(res.message);
                    if(res.noproduct) {
                        window.location.href="shop.php";
                    }
                }
            },
            error: function(err) {
                console.log('AJAX error', err.responseText);
            }
        })
}
// this is for product on the shop page 
if(window.location.href.includes('arts-stationary-shop/shop.php')) {
    let category = $('#category').val();
    let parentElement = '#product-conductor';
    let url = "getdata.php";
    let data = { getProducts: true, datatype: category }
    fetchData(parentElement, url, data);

    $('#category').on('change', function() {
        let category = $('#category').val();
        let parentElement = '#product-conductor';
        let url = "getdata.php";
        let data = { getProducts: true, datatype: category }
        fetchData(parentElement, url, data);
    })

    // Attach an event listener to the search input field
    $("#searchInput").on("keyup", function(){
        // Get the entered search term
        let searchTerm = $(this).val().toLowerCase();
        let parentElement = '#product-conductor';
        let url = "getdata.php";
        let data = { getProducts: true, searchkey: searchTerm }
        fetchData(parentElement, url, data);    

    });
}

$(document).on('click', '.add-to-cart', function() {
    let prodId = $(this).data('prodid');
    $.ajax({
        url: 'insert.php',
        type: 'POST',
        data: { addtocart: true, prodId: prodId },
        dataType: 'json',
        success: function(res) {
            console.log(res);
            if(res.success) {
                alert(res.message);
            }else {
                alert(res.message);
                console.log(res.error);
                if(res.is_login == false) {
                    window.location.href="login.php";
                }
            }
        },
        error: function(err) {
            console.log(err.responseText);
        }

    })
})
// this is to udpate the data through ajax whenever needed 
function updateData(url, data, cbfunction) {
    $.ajax({
        url : url,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(res) {
            if(res.success) {
                cbfunction();
                
            }else {
                alert(res.message);
            }
        }
    }) 
}

if(window.location.href.includes('arts-stationary-shop/cart.php')) {
    function fetchCart() {
        let parentElement = '#cartTablebody';
        let url = "getdata.php";
        let data = { getCartProducts: true }
        fetchData(parentElement, url, data);
    }
    fetchCart();

    $(document).on('click', '.deleteCart', function() {
        let prodId = $(this).data('prodid');
        let data = { deleteCart: true, prodID: prodId }
        updateData("homeupdate.php", data, fetchCart)
    })

    $(document).on('click', '.decrease-quantity', function() {
        let prodId = $(this).data('prodid');
        let data = { updateCart: true, decrease: true, prodID: prodId }
        updateData("homeupdate.php", data, fetchCart)

    })
    
    $(document).on('click', '.increase-quantity', function() {
        let prodId = $(this).data('prodid');
        let data = { updateCart: true, increase: true, prodID: prodId }
        updateData("homeupdate.php", data, fetchCart)

    });
}

if(window.location.href.includes('arts-stationary-shop/checkout.php')) {
    function productForOrder() {
        let parentElement = '#cartTablebody';
        let url = "getdata.php";
        let data = { checkOutProducts: true }
        fetchData(parentElement, url, data, '#finalAmount');
    }
    productForOrder();
    $(document).ready(function() {
        // console.log(value);
        $('input[type="radio"]').change(function() {
        let selectedValue = $('input[name="Shipping"]:checked').val();

            // Perform action on radio button change
            console.log('Selected Shipping Option:', selectedValue);
            let value = parseFloat($('#totalAmount').text().replace('$', ''));
            // Perform additional actions based on the selected value
            if (selectedValue === 'standard') {
                $('#finalAmountinp').val(value + 5);
                $('#finalAmount').text('$' + (value + 5));
            } else if (selectedValue === 'premium') {
                $('#finalAmountinp').val(value + 15);
                $('#finalAmount').text('$' + (value + 15));
            }
        });
    });

}

$(document).on('click', '#userlogout', function() {
    console.log('cliked')
    $.ajax({
        url: `logout.php`,
        type: 'POST',
        data: { logoutUser: true },
        dataType: 'json',
        success: function(res) {
            if(res.success) {
                alert(res.message)
                window.location.href="login.php";
            }
        },
        error: function(err) {
            console.log(err);
        }
    })
});


if(window.location.href.includes('arts-stationary-shop/ordered.php')) {
    function OrderedProducts() {
        let parentElement = '#orderedProducts';
        let url = "getdata.php";
        let data = { getOrderedProducts: true }
        fetchData(parentElement, url, data);
    }
    OrderedProducts();

    $(document).on('click', '.docancel', function() {
        let orderId = $(this).data('orderid');
        let orderStatus = $(this).data('orderstatus');
        let data = { cancelOrder: true, OrderId : orderId, orderStatus: orderStatus }
        updateData("homeupdate.php", data, OrderedProducts)
    });

    $(document).on('click', '.doPayment', function() {
        let orderId = $(this).data('orderid');
        let data = { doPayment: true, OrderId : orderId }
        updateData("homeupdate.php", data, OrderedProducts)
    });
}
if(window.location.href.includes('arts-stationary-shop/contact.php')) {
 $('#contactBtn').on('click', function() {
   let fullNameRegex = /^[A-Z][a-z]*( [A-Z][a-z]*)*$/;
   let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
   let messageRegex = /^.+$/;
   let name = $('#personName').val();
   let email = $('#personEmail').val();
   let message = $('#personMessage').val();
   if(fullNameRegex.test(name)) {
    $('#nameLabel').text('Valid ✔');
    $('#nameLabel').css('color', 'green');
    if(emailRegex.test(email)){
        $('#emailLabel').text('Valid ✔');
        $('#emailLabel').css('color', 'green');
        if(messageRegex.test(message)) {
            $('#messageLabel').text('Valid ✔');
            $('#messageLabel').css('color', 'green');
            $.ajax({
                url: 'contactform.php',
                type: 'post',
                data: {contactForm: true, name: name, email: email, message: message},
                dataType: 'json',
                success: function(res) {
                    if(res.success) {
                        alert('Your form has been submited. We\'ll contact you as soon as possible');
                        $('#personName').val('');
                        $('#personEmail').val('');
                        $('#personMessage').val('');
                    }else{
                        alert('failed to submit your form please try again');
                    }
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            })

        }else {
            $('#messageLabel').text('* Message can\'t be empty');
            $('#messageLabel').css('color', 'red');
        }
    }else {
        $('#emailLabel').text('* Write a valid email, example: johndoe@example.com');
        $('#emailLabel').css('color', 'red');
    }
   }else {
    $('#nameLabel').text('* Write a valid name, example: John Doe');
    $('#nameLabel').css('color', 'red');
   }

 })   
}

});

