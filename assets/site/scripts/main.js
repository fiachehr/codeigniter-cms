$(function(){


    var base_url = $("#base_url").val();

    // popular choose

    $(".choose-popular-title > li").click(function(){

        var thisLiSelected = $(this);

        $(this).parents(".choose-popular-title").siblings(".most-popular-title").children("span:last-child").text("("+$(this).children("span").text()+")");

        $(this).addClass("choosed-popular");

        $(this).siblings("li").removeClass("choosed-popular");

        $(this).parents(".most-popular-header").siblings(".most-popular-main").children(".most-popular-main-in").filter(function(){

            if($(this).data("popular-choose") === thisLiSelected.data("popular-choose")){

                $(this).addClass("most-popular-main-in-selected")

            }else{

                $(this).removeClass("most-popular-main-in-selected")

            }

        });



    });

    $("#search").keyup(function(){

        var searchInput = $(this);

        var output = '';

        $.ajax({

            url: base_url+'Product/suggest',

            type:'POST',

            dataType: 'json',

            data: {'keyword' : searchInput.val()},

            success: function(output_string){

              if(output_string != null){

                for(var i = 0 ; i < output_string.length ; i++){	

                  output = output + "<li><a href=\""+base_url+"Product/productView/"+output_string[i]['productCode']+"/"+output_string[i]['productTitle'].replace(" ","-")+"/\">"+output_string[i]['productTitle']+"</a></li>";

                }

                $(".search-section .search-suggest").html(output);

              }else{

                $(".search-section .search-suggest").html('');

              }       

            } 

        });

        if($(this).val() !== ""){

            $(this).siblings("ul").show();

        }else{

            $(this).siblings("ul").hide();

        }

        $(this).siblings("ul").children("li").filter(function(){

            if($(this).html().trim().startsWith(searchInput.val())){

                $(this).show();

            }else{

                $(this).hide();

            }

        });

    });

    // $(".search-section").on("click",".search-suggest > li",function(){

    //     $("#search").val($(this).html().trim());

    //     $(this).parent("ul").hide();

    // });

    var menuFlag = true;

    $(".menu-toggler > i").click(function(){

        if(menuFlag){

            $(this).parent(".menu-toggler").siblings("ul").slideDown(function(){

            $(this).css("display" , "flex");

            });

            menuFlag = false;



        }else{

            $(this).parent(".menu-toggler").siblings("ul").slideUp();

            menuFlag = true;

        }

    });



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



    // full story image box

    $(".full-story-small-image > li > img").click(function(){

        $(".full-story-big-image > img").attr("src" , $(this).attr("src"));



    });



    $(".stuff-top-right > .stuff-stars > ul > li").click(function(){

        $(this).nextAll("li").css("color" , "gold");

        $(this).prevAll("li").css("color" , "#333");

        $(this).css("color" , "gold");



    });



    $(".stuff-counter > .stuff-plus").click(function(){

        var stuffCounter = $(this).siblings("span").text();

        stuffCounter++;

        $(this).siblings("span").text(stuffCounter);

    });

    $(".stuff-counter > .stuff-minus").click(function(){

        var stuffCounter = $(this).siblings("span").text();

        stuffCounter--;

        if(stuffCounter <= 0){

            stuffCounter = 0;

        }

        $(this).siblings("span").text(stuffCounter);

    });



    $(".glass-modal").click(function(){

        $(this).css("display" , "none");

    });

    $(".glass-modal > .glass-modal-image").click(function(e){

        e.stopPropagation();

    });



    $("#state").change(function(){

		var locID = $("#state").val();

		var location = "";

	    $.ajax({

        url: base_url+'userSM/getCity',

        type:'GET',

        dataType: 'json',

		data: {'locID' : locID},

	        success: function(output_string){

	        	$.each(output_string, function(idx, obj) {

					  location += '<option value="'+obj.id+'">'+obj.title+'</option>';			                    

				});	        

				$("#city").html(location);

	        } 

        });            

    });
    // product backgrounds from data background
    // $(".any-product-background").filter(function(){
    //     $(this).css("background-image" , "url("+$(this).data("background")+")");
    // });

    // user comment on textarea
    $(".any-user-opnion-replay").click(function(){
        $("body , html").animate({scrollTop : $(".user-opinion-form").offset().top - 30} , 500);
    });

    // rate for stars index number
    $(".stuff-top-right>.stuff-stars>ul>li>i").click(function(){
        console.log($(this).parent("li").data("index"));
    });

    // favorite icon color

    $(".stuff-favorite").click(function(){
        $(this).toggleClass("color");
    });



})