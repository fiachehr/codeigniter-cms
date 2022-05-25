$(function(){
//
$.fn.addNewTags = function () {
    var addNewTagsParent = $(this);

    $(this).addClass("new-tags");
    $(this).children("div").children("span").css({
        "background-color": "#eee",
        "border": "1px solid black",
        "border-radius": "2px",
        "display": "inline-block",
        "margin": "3px 5px",
        "padding": "5px 10px",
        "cursor": "pointer"
    });

    // for new tags
    // var editValue1 = [];
    // var editValue2 = [];
    // $(this).children("span").filter(function(){
    //     editValue1.push('newTag-'+$(this).html());
    //     editValue2.push($(this).html());
    // });

    // $(".new-tags").children("input[type='hidden'].hidden1").val(JSON.stringify(editValue1));
    // $(".new-tags").children("input[type='hidden'].hidden2").val(JSON.stringify(editValue2));
    $(this).children("button").css({
        backgroundColor: "#333",
        color: "white",
        fontSize: "20px",
        padding: "3px 10px"
    });
    $(this).children("button").html("+");

    // select box size and suggestion for any type
    $(".new-tags").children("select").attr("multiple" , true);
    $(this).children("input").keyup(function () {
        var thisInputType = $(this);
        var selectOptionLength;
        var inputTypedNowValue = $(this).val();
        if ($(this).val() == "") {
            $(this).siblings("select").hide();
        } else {
            $(this).siblings("select").show();
        }


        $("body").click(function () {
            $(".new-tags > select").hide();
        });
        $(this).children("input").click(function (e) {
            e.stopPropagation();
        });
        $(this).siblings("select").children("option").filter(function () {
            if ($(this).html().includes(inputTypedNowValue)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        setTimeout(function () {
            selectOptionLength = thisInputType.siblings("select").children("option").length;

            if (selectOptionLength == 0) {
                thisInputType.siblings("select").addClass("when-select-empty");
                thisInputType.siblings("button").show();
            } else {
                thisInputType.siblings("select").removeClass("when-select-empty");
                thisInputType.siblings("button").hide();
            }
            $(this).children("select").attr("multiple", true);
            if (selectOptionLength > 5) {
                addNewTagsParent.children("select").attr("size", 5);
            } else {
                addNewTagsParent.children("select").attr("size", selectOptionLength);
            }

        }, 100);
        
        $(this).children("div").children("span").filter(function(){
            if($(this).html() == thisInputType.val()){
                thisInputType.siblings("button").hide();
            }
        });



    });


    var optionSelectedDataId = [];
    var optionSelectedDataTitle = [];
    $(this).children("div").children("span").filter(function(){
        optionSelectedDataId.push($(this).data("focus"));
        optionSelectedDataTitle.push($(this).data("focus-title"));

    });
    $(this).children("input[type='hidden'].hidden1").val(JSON.stringify(optionSelectedDataId))
    $(this).children("input[type='hidden'].hidden2").val(JSON.stringify(optionSelectedDataTitle))
    
    $(this).on("click", " >select", function (e) {

        e.stopPropagation();
        optionDataValue = $(this).children('option:selected').attr('data-value');
        optionDataTitleCheck = $(this).children('option:selected').attr('data-title');

        optionSelectedText = $(this).children("option:selected").html();
        $(this).siblings("div").children("span").filter(function () {
            if ($(this).html() == optionDataTitleCheck) {
                alert("cant bro");
                $(this).remove();
            }
        });
        if (optionSelectedDataId.indexOf($(this).children("option:selected").attr("data-value")) == "-1") {
            optionSelectedDataId.push($(this).children("option:selected").attr("data-value"));

        }
        if (optionSelectedDataTitle.indexOf($(this).children("option:selected").attr("data-title")) == "-1") {
            optionSelectedDataTitle.push($(this).children("option:selected").attr("data-title"));

        }

        var allSpanInWrapper = $(this).siblings("div").children("span:not(.option)");
        $(this).parent("div").children("div").prepend("<span class='option' data-focus='" + optionDataValue + "' data-focus-title='" + optionDataTitleCheck + "'>" + optionSelectedText + "</span>");
        $(this).parent(".new-tags").children("div").children("span").css({
            "background-color": "#eee",
            "border": "1px solid black",
            "border-radius": "2px",
            "display": "inline-block",
            "margin": "3px 5px",
            "padding": "5px 10px",
            "cursor": "pointer"
        });
        // make arrays every time 

        addedSpansHtml = [];
        addedSpansHtml2 = [];
        allSpanInWrapper.filter(function () {
            addedSpansHtml.push("newTag-" + $(this).html());
            addedSpansHtml2.push($(this).html());
        });
        addedSpansHtml = addedSpansHtml.concat(optionSelectedDataId);
        addedSpansHtml2 = addedSpansHtml2.concat(optionSelectedDataTitle);
        jsonAllSpansText = JSON.stringify(addedSpansHtml);
        jsonAllSpansText2 = JSON.stringify(addedSpansHtml2);
        $(this).siblings("input[type='hidden'].hidden1").val(jsonAllSpansText);
        $(this).siblings("input[type='hidden'].hidden2").val(jsonAllSpansText2);
        $(this).hide();
        $(this).siblings("input[type='text']").val("");

    });


    $(this).on("click", ">button", function () {
        if ($(this).siblings("input[type='text']").val() != "") {
            var tagWrapperInputText = $(this).siblings("input[type='text']").val();
            $(this).siblings("div").children("span").filter(function () {
                if ($(this).html() == tagWrapperInputText) {
                    alert("cant bro");
                    $(this).remove();
                }
            });

            $(this).siblings("input[type='text']").val("");
            $(this).parent("div").children("div").prepend("<span>" + tagWrapperInputText + "</span>");
            $(this).parent(".new-tags").children("div").children("span").css({
                "background-color": "#eee",
                "border": "1px solid black",
                "border-radius": "2px",
                "display": "inline-block",
                "margin": "3px 5px",
                "padding": "5px 10px",
                "cursor": "pointer"
            });
            var allSpanInWrapper = $(this).siblings("div").children("span:not(.option)");
            // make arrays every time 
            addedSpansHtml = [];
            addedSpansHtml2 = [];
            allSpanInWrapper.filter(function () {
                addedSpansHtml.push("newTag-" + $(this).html());
                addedSpansHtml2.push($(this).html());
            });

            addedSpansHtml = addedSpansHtml.concat(optionSelectedDataId);
            addedSpansHtml2 = addedSpansHtml2.concat(optionSelectedDataTitle);
            jsonAllSpansText = JSON.stringify(addedSpansHtml);
            jsonAllSpansText2 = JSON.stringify(addedSpansHtml2);
            $(this).siblings("input[type='hidden'].hidden1").val(jsonAllSpansText);
            $(this).siblings("input[type='hidden'].hidden2").val(jsonAllSpansText2);
        }
    });






    // delete spans and delete this spans value from input type hidden
    $(this).children("div").on("click", ">span", function () {
        var allSpanInWrapper = $(this).siblings("span:not(.option)");
        addedSpansHtml = [];
        addedSpansHtml2 = [];

        allSpanInWrapper.filter(function () {
            addedSpansHtml.push("newTag-" + $(this).html());
            addedSpansHtml2.push($(this).html());
        });
        // make arrays every time 
        var thisSpanDataValue = $(this).attr("data-focus");
        var thisSpanDataTitle = $(this).attr("data-focus-title");
//        console.log(thisSpanDataValue); 
//        console.log(thisSpanDataTitle);


        if (optionSelectedDataId.indexOf(thisSpanDataValue) != 1 || optionSelectedDataTitle.indexOf(thisSpanDataTitle) != 1) {
            optionSelectedDataId.splice(optionSelectedDataId.indexOf(thisSpanDataValue), 1);
            optionSelectedDataTitle.splice(optionSelectedDataTitle.indexOf(thisSpanDataTitle), 1);
        }


        addedSpansHtml = addedSpansHtml.concat(optionSelectedDataId);
        addedSpansHtml2 = addedSpansHtml2.concat(optionSelectedDataTitle);
        jsonAllSpansText = JSON.stringify(addedSpansHtml);
        jsonAllSpansText2 = JSON.stringify(addedSpansHtml2);
        $(this).parent("div").siblings("input[type='hidden'].hidden1").val(jsonAllSpansText);
        $(this).parent("div").siblings("input[type='hidden'].hidden2").val(jsonAllSpansText2);
        $(this).remove();
    });

};
$(".tags").addNewTags();

});