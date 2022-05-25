$(function(){



    var base_url = $("#base_url").val();

    $(".users-opinion").click(function(){

        $(this).siblings(".details").removeClass("selected");

        $(this).addClass("selected");

        $(".users-opinion-box").show();

        $(".product-info").hide();

    });

    $(".full-story-information .details").click(function(){

        $(this).siblings(".users-opinion").removeClass("selected");

        $(this).addClass("selected");

        $(".users-opinion-box").hide();

        $(".product-info").show();

    });



    $(".cart-button").click(function(){

        $(".cart-items-main").slideToggle(150);

    });

    // delete from cart

    $(".cart-item-wrapper").on("click" ,".delete-items" ,function(){

        $(this).parent(".cart-items").remove();

        var id = $(this).data("id");

        $.ajax({

            url: base_url + 'Shop/removeItemCart',

            type: 'POST',

            dataType: 'json',

            data: {'id': id}   

        });

        $(".shop-box-counter > span").html(0);

        $(".cart-items-counter > span").filter(function(){   

            $(".shop-box-counter > span").html(Number($(".shop-box-counter > span").html()) + Number($(this).html()));

        });

        $(".cart-items-result-price > span").html(0);

        $(".shop-box-price > span").html(0)

        $(".cart-item-informations .cart-item-price > span").filter(function(){ 

            $(".cart-items-result-price > span").html(Number($(".cart-items-result-price > span").html().replace("," , "")) +Number($(this).html().replace("," , "")));

            $(".shop-box-price > span").html(Number($(".shop-box-price > span").html().replace("," , "")) +Number($(this).html().replace("," , "")));

        });



    });

    // add to cart

    $(".add-to-cart > a").click(function(e){

        var cantAdd = false;

        var thisAddToCart = $(this);

        e.preventDefault();

        $.ajax({

            url: base_url + 'Shop/addToCart',

            type: 'POST',

            dataType: 'json',

            data: {

                'productID': thisAddToCart.data("id"),

                'productTitle': thisAddToCart.data("title"),

                'productAmount': thisAddToCart.data("fee"),

                'productCode': thisAddToCart.data("code"),

                'productWeight': thisAddToCart.data("weight"),

            }       

        });

        $(".success-add-cart").css("display" , "flex");

        $(".success-add-cart p span").html($(this).parent(".add-to-cart").siblings("h3").children("a").text());

        $(".cart-item-wrapper .cart-items").filter(function(){

            if($(this).data("id") === thisAddToCart.data("id")){

                cantAdd = true;

            }

        });

        if(cantAdd){

            $(".cart-item-wrapper .cart-items").filter(function(){

                if($(this).data("id") === thisAddToCart.data("id")){

                    $(this).children(".cart-items-counter").children("span").text(Number($(this).children(".cart-items-counter").children("span").text())+1);

                    $(this).children(".cart-item-informations").children(".cart-item-price").children("span").text(Number($(this).children(".cart-item-informations").children(".cart-item-price").children("span").text().replace("," , ""))* 2);

                }

            });

        }else{

            var targetPrice;

            if($(this).parent(".add-to-cart").siblings("p").children(".new-price").is(".new-price")){

                targetPrice = $(this).parent(".add-to-cart").siblings("p").children(".new-price").text();

            }else{

                targetPrice = $(this).parent(".add-to-cart").siblings("p").children(".orginal-price").text();

            }

            $(".cart-item-wrapper").append('<li data-id="'+$(this).data("id")+'" class="cart-items"><div class="cart-items-img"><img src="'+$(this).parent(".add-to-cart").siblings("figure").children("a").children("img").attr("src")+'"></div><div class="cart-item-informations"><div class="cart-item-title"><a href="">'+$(this).parent(".add-to-cart").siblings("h3").children("a").text()+'</a></div><div class="cart-item-price"><span>'+targetPrice+'</span> نومان</div></div><div class="cart-items-counter"><span>1</span></div><div class="delete-items" data-id="'+thisAddToCart.data("id")+'"><i class="fa fa-times"></i></div></li>');

            }

            $(".shop-box-counter > span").html(0);

            $(".cart-items-counter > span").filter(function(){   

                $(".shop-box-counter > span").html(Number($(".shop-box-counter > span").html()) + Number($(this).html()));

            });



            $(".cart-items-result-price > span").html(0);

            $(".shop-box-price > span").html(0);

            $(".cart-item-informations .cart-item-price > span").filter(function(){ 

                $(".cart-items-result-price > span").html(Number($(".cart-items-result-price > span").html().replace("," , "")) +Number($(this).html().replace("," , "")));

                $(".shop-box-price > span").html(Number($(".shop-box-price > span").html().replace("," , "")) + Number($(this).html().replace("," , "")));

            });

    });



    $(".success-add-cart button").click(function(){

        $(this).parents(".success-add-cart").css("display" , "none");

    });



    $(".shop-box-counter > span").html(0);

    $(".cart-items-counter > span").filter(function(){   

        $(".shop-box-counter > span").html(Number($(".shop-box-counter > span").html()) + Number($(this).html()));

    });



    $("body").click(function(){

        $(".cart-items-main").slideUp();

    });

    $(".cart-section").click(function(e){

        e.stopPropagation();

    });



    // full story buy link



    $(".stuff-buy-link > a").click(function(e){

        var cantAdd = false;

        var thisAddToCart = $(this);

        var qty = $(".stuff-cart-number").text();

        e.preventDefault();

        $.ajax({

            url: base_url + 'Shop/addToCart',

            type: 'POST',

            dataType: 'json',

            data: {

                'productID': thisAddToCart.data("id"),

                'productTitle': thisAddToCart.data("title"),

                'productAmount': thisAddToCart.data("fee"),

                'productCode': thisAddToCart.data("code"),

                'productWeight': thisAddToCart.data("weight"),

                'qty' : qty,

            }       

        });

        $(".success-add-cart").css("display" , "flex");

        $(".success-add-cart p span").html($(this).parent(".add-to-cart").siblings("h3").children("a").text());

        $(".cart-item-wrapper .cart-items").filter(function(){

            if($(this).data("id") === thisAddToCart.data("id")){

                cantAdd = true;

            }

        });

        if(cantAdd){

            $(".cart-item-wrapper .cart-items").filter(function(){

                if($(this).data("id") === thisAddToCart.data("id")){

                    $(this).children(".cart-items-counter").children("span").text(Number($(".stuff-buy-link > a").parent(".stuff-buy-link").siblings(".stuff-counter").children(".stuff-cart-number").text()));



                    $(this).children(".cart-item-informations").children(".cart-item-price").children("span").text(Number($(this).children(".cart-item-informations").children(".cart-item-price").children("span").text().replace("," , "ok")));

                }

            });

        }else{

            var targetPrice;

            if($(this).parent(".add-to-cart").siblings("p").children(".new-price").is(".new-price")){

                targetPrice = $(this).parent(".add-to-cart").siblings("p").children(".new-price").text();

            }else{

                targetPrice = $(this).parents(".stuff-cart").siblings(".full-story-stuff-top").children(".stuff-top-right").children(".stuff-price").children("span:first-child").text().replace("," , "") * $(this).parent(".stuff-buy-link").siblings(".stuff-counter").children(".stuff-cart-number").text();

            }

            $(".cart-item-wrapper").append('<li data-id="'+$(this).data("id")+'" class="cart-items"><div class="cart-items-img"><img src="'+$(".full-story-big-image > img").attr("src")+'"></div><div class="cart-item-informations"><div class="cart-item-title"><a href="">'+$(this).parents(".stuff-cart").siblings(".full-story-stuff-top").children(".stuff-top-right").children(".stuff-titles").children("h2").text()+'</a></div><div class="cart-item-price"><span>'+targetPrice+'</span> نومان</div></div><div class="cart-items-counter"><span>'+$(this).parent(".stuff-buy-link").siblings(".stuff-counter").children(".stuff-cart-number").text()+'</span></div><div class="delete-items"><i class="fa fa-times"></i></div></li>');

            }

            $(".shop-box-counter > span").html(0);

            $(".cart-items-counter > span").filter(function(){   

                $(".shop-box-counter > span").html(Number($(".shop-box-counter > span").html()) + Number($(this).html()));

            });



            $(".cart-items-result-price > span").html(0);

            $(".shop-box-price > span").html(0);

            $(".cart-item-informations .cart-item-price > span").filter(function(){ 

                $(".cart-items-result-price > span").html(Number($(".cart-items-result-price > span").html().replace("," , "")) +Number($(this).html().replace("," , "")));

                $(".shop-box-price > span").html(Number($(".shop-box-price > span").html().replace("," , "")) + Number($(this).html().replace("," , "")));

            });



    });



    // cart page

    $(".delete-any-cart .delete-cart").click(function(){

        var id = $(this).data("id");

        $.ajax({

            url: base_url + 'Shop/removeItemCart',

            type: 'POST',

            dataType: 'json',

            data: {'id': id},

            success: function(){

                location.reload(); 

            }  

        });

    });



    $(".delete-any-cart #update").click(function(){

        var id = $(this).data("id");

        var qty = $("#form-"+id).val();

        $.ajax({

            url: base_url + 'Shop/updateCart',

            type: 'POST',

            dataType: 'json',

            data: {'rowID': id,'qty':qty},

            success: function(){

                location.reload(); 

            }  

        });

    });



    //  discount box

    $(".discount-box button").click(function(){

        var thisButton = $(this);

        if($(this).siblings("input").val() != ""){

            var code = $(this).siblings("input").val();

            $.ajax({

                url: base_url + 'Shop/checkGiftCard',

                type: 'POST',

                dataType: 'json',

                data: {'code': code},

                success: function(result){
                    if(result === 1){
                        thisButton.parent(".discount-box").siblings(".discount-alert").children(".red-alert").hide();
                        thisButton.parent(".discount-box").siblings(".discount-alert").children(".green-alert").fadeIn(500 , function(){
                            setTimeout(function(){
                                thisButton.parent(".discount-box").siblings(".discount-alert").children(".green-alert").fadeOut(500);
                            } , 1000);
                        });
                    }else{
                        thisButton.parent(".discount-box").siblings(".discount-alert").children(".green-alert").hide();
                        thisButton.parent(".discount-box").siblings(".discount-alert").children(".red-alert").fadeIn(500 , function(){
                            setTimeout(function(){
                                thisButton.parent(".discount-box").siblings(".discount-alert").children(".red-alert").fadeOut(500);
                            } , 1000);

                        });

                    }

                }  

            });

        }else{

            $(this).parent(".discount-box").siblings(".discount-alert").children(".green-alert").hide();

            $(this).parent(".discount-box").siblings(".discount-alert").children(".red-alert").fadeIn(500 , function(){

                var thisAlert = $(this);

                setTimeout(function(){

                    thisAlert.fadeOut(500);

                } , 1000);

            });

        }

    });



    // in cart box counter



    $(".plus-counter").click(function(){

        var thisBoxConter = Number($(this).parent(".any-cart-counter-control").siblings("input").val());

        $(this).parent(".any-cart-counter-control").siblings("input").val(thisBoxConter + 1);

    });

    $(".minus-counter").click(function(){

        var thisBoxConter = Number($(this).parent(".any-cart-counter-control").siblings("input").val());

        $(this).parent(".any-cart-counter-control").siblings("input").val(thisBoxConter - 1);

        if(thisBoxConter == 1){

            $(this).parent(".any-cart-counter-control").siblings("input").val(1);

        }

    });



})