var baseUrl = 'http://127.0.0.1:8000/';
var products = [];




$(document).ready(function () {


    ls = JSON.parse(localStorage.getItem('cart'));

    ls.forEach(item => {
        $('#cart-table tbody').append("<tr>" +
            "<td><img src='" + item.img + "'/></td>" +
            "<td>" + item.libelle + "</td>" +
            "<td>" + item.prix + "</td>" +
            "<td><input type='number' id='product-" + item.id + "' value='0'/></td>" +
            "</tr>");
    });

    ls.forEach(element => {
        $("#product-" + element.id).change(function (e) {

            var cart = ls.map(item => {
                var key = Object.assign({}, item);
                key.qte = $(this).val()
                return key;
            });
            console.log(cart);
        });
    });


    //add new product to cart
    $("#add-to-cart-btn").click(function (e) {
        e.stopImmediatePropagation();
        $.ajax({
            type: "GET",
            url: "/ajax/panier/ajouter/" + $(this).data('product'),
            dataType: "json"
        }).done(function (response) {
            addToCart(response);

        }).error(function (error) {
            console.log(error)
        });
        e.preventDefault();
    });

    

    $("#cart-nav").append("<span>(" + ls.length + ")</span>")
});



Storage.prototype.setObj = function (key, value) {
    this.setItem(key, JSON.stringify(value));
}

Storage.prototype.getObj = function (key) {
    var value = this.getItem(key);
    return value && JSON.parse(value);
}

function addToCart(product) {
    if (localStorage.getObj('cart') !== null) {
        products = localStorage.getObj('cart');
        products.push(product);
        localStorage.setObj('cart', products);
    }
    else {
        products.push(product);
        localStorage.setObj('cart', products);
    }
}



