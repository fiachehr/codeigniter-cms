        //------------ wrapper
        // set id for wrapper ==> id : "demo",
        
        //----------- inputs
        // input type hidden name ==>  example   inputHiddenName1 : "test"
        // input type hidden name ==>  example   inputHiddenName2 : "test"
        // input type text placeholder ==>  example   inputPlaceholder : "lotfan vared konin"
        
        //-------------------------- button add more style 
        // background-color ==>  buttonBg : "#333333" 
        // button color ==>   buttonColor : "white"
        // button font-size ==>   buttonFontSize : "16px"
        // button padding ==>   buttonPadding : "10px" or "10px 50px" or "50px 10px 20px" or "10px 10px 20px 20px" any padding 
        // button text inside ==>   buttonText : "add more" or any text
        
        
        //------------------------- span added style
        // span background-color ==> spanBg : "blue",
        // span color ==> spanColor : "red",
        // span font-size ==> spanFontSize : "20px",
        // span padding ==> spanPadding : "10px" or "10px 50px" or "50px 10px 20px" or "10px 10px 20px 20px" any padding,
        // span margin ==> spanMargin : "10px" or "10px 50px" or "50px 10px 20px" or "10px 10px 20px 20px" any margin,
        // span border-radius ==> spanBorderRadius : "10px" or "10px 20px" or any border radius,
        
        
        // used in this demo
        $(function(){
            $(".tags").addTagWithSuggestion({inputHiddenName1 : "tagsList" , inputHiddenName2 : "tagsListTitle", inputPlaceholder : " برچسبها" , id : "tags" , defaultValue1 : '[]' , defaultValue2 : '[]'} );
        //    $(".tags1").addTagWithSuggestion({inputHiddenName1 : "tagsList1" , inputHiddenName2 : "tagsList2", inputPlaceholder : " برچسبها" , id : "tags1" , defaultValue1 : '[]' , defaultValue2 : '[]'} );
        });
        
        
        // our plugin code
        
        $.fn.addTagWithSuggestion = function(options){
            if(options.id != "undefined"){
            $(this).attr("id" , options.id);
            }
            $(this).addClass("tag-wrapper");
            // for edit and take all spans value in value input type hidden
            var editValue1 = [];
            var editValue2 = [];
            $(this).children("span").filter(function(){
                editValue1.push('newTag-'+$(this).html());
                editValue2.push($(this).html());
            });

            // add default tags in tag wrapper      
            $(this).append("<input type='hidden' class='hidden1' value='"+options.defaultValue1+"' name='"+options.inputHiddenName1+"'><input type='hidden' class='hidden2' value='"+options.defaultValue2+"' name='"+options.inputHiddenName2+"'><input type='text' placeholder='"+options.inputPlaceholder+"'><button type='button' class='add-btn'></button>");
            $(this).children("input[type='hidden'].hidden1").val(JSON.stringify(editValue1));
            $(this).children("input[type='hidden'].hidden2").val(JSON.stringify(editValue2));


            // make button click for add tags
            var defaultsStyleAddButton = {
                buttonText : " اضافه کردن ",
                buttonBg : "#333",
                buttonColor : "white",
                buttonFontSize : "14px",
                buttonPadding : "3px 10px",
            }
            if(typeof options === "undefined"){
                options = false;
            }
            // set personal style on add button or defaul style
            var buttonBg = options.buttonBg || defaultsStyleAddButton.buttonBg;
            var buttonColor = options.buttonColor || defaultsStyleAddButton.buttonColor;
            var buttonFontSize = options.buttonFontSize || defaultsStyleAddButton.buttonFontSize;
            var buttonPadding = options.buttonPadding || defaultsStyleAddButton.buttonPadding;
            var buttonText = options.buttonText || defaultsStyleAddButton.buttonText;
            // add style to button add more
            $(this).children("button").css({backgroundColor : buttonBg , color : buttonColor , fontSize : buttonFontSize , padding : buttonPadding});
            $(this).children("button").html(buttonText);
            

            
            // make added button in wrapper
            var defaultStyleAddedSpan = {
                spanBg : "#427dc0",
                spanColor : "white",
                spanFontSize : "14px",
                spanPadding : "3px 10px",
                spanBorderRadius : "10px",
                spanMargin : "0"
            }
            
            var spanBg = options.spanBg || defaultStyleAddedSpan.spanBg;
            var spanColor = options.spanColor || defaultStyleAddedSpan.spanColor;
            var spanFontSize = options.spanFontSize || defaultStyleAddedSpan.spanFontSize;
            var spanPadding = options.spanPadding || defaultStyleAddedSpan.spanPadding;
            var spanBorderRadius = options.spanBorderRadius || defaultStyleAddedSpan.spanBorderRadius;
            var spanMargin = options.margin || defaultStyleAddedSpan.spanMargin;
            // add style to span added
            $(this).children("span").css({backgroundColor : spanBg , color : spanColor , fontSize : spanFontSize , padding : spanPadding , borderRadius : spanBorderRadius , margin : spanMargin});
            
            // click on addmore button and add span with input value and make jason in input type hidden
            var addedSpansHtml;
            var addedSpansHtml2;
            var jsonAllSpansText;
            var jsonAllSpansText2;

            // select box size and suggestion for any type
            $(this).children("select").attr("multiple" , true);
            $(this).children("input").keyup(function(){
                var thisInputType = $(this);
                var selectOptionLength;
                var inputTypedNowValue = $(this).val();
                if($(this).val() == ""){
                    $(this).siblings("select").hide();
                }else{
                    $(this).siblings("select").show();
                }


                $("body").click(function(){
                    $(".tag-wrapper > select").hide();
                });
                $(this).children("input").click(function(e){
                    e.stopPropagation();
                });
                $(this).siblings("select").children("option").filter(function(){
                    if($(this).html().includes(inputTypedNowValue)){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
                setTimeout(function(){
                    selectOptionLength = thisInputType.siblings("select").children("option").length;
                    if(selectOptionLength == 0){
                        thisInputType.siblings("select").addClass("when-select-empty");
                        thisInputType.siblings(".add-btn").show();
                    }else{
                        thisInputType.siblings("select").removeClass("when-select-empty");
                        thisInputType.siblings(".add-btn").hide();
                    }
                }, 100);
                
            });


            
            var optionSelectedDataId = [];
            var optionSelectedDataId2 = [];
            $(this).children("select").click(function(e){
                e.stopPropagation();
                optionDataValue = $(this).children('option:selected').attr('data-value');
                optionSelectedDataId.push($(this).children("option:selected").attr("data-value"));
                optionSelectedDataId2.push($(this).children("option:selected").attr("data-title"));
                optionSelectedText = $(this).children("option:selected").html();
                
                var allSpanInWrapper = $(this).siblings("span:not(.option)");
                $(this).parent(".tag-wrapper").prepend("<span class='option' data-focus='"+optionDataValue+"'>"+optionSelectedText+"</span>");
                $(this).parent(".tag-wrapper").children("span").css({ "background-color": "#eee",
                "border": "1px solid black",
                "border-radius": "2px",
                "display": "inline-block",
                "margin": "3px 5px",
                "padding": "5px 10px",
                "cursor": "pointer"});
                // make arrays every time 
                addedSpansHtml = [];
                addedSpansHtml2 = [];
                allSpanInWrapper.filter(function(){
                    addedSpansHtml.push($(this).html());
                    addedSpansHtml2.push($(this).html());
                });
                addedSpansHtml = addedSpansHtml.concat(optionSelectedDataId);
                addedSpansHtml2 = addedSpansHtml2.concat(optionSelectedDataId2);
                jsonAllSpansText = JSON.stringify(addedSpansHtml);
                jsonAllSpansText2 = JSON.stringify(addedSpansHtml2);
                $(this).siblings("input[type='hidden'].hidden1").val(jsonAllSpansText);
                $(this).siblings("input[type='hidden'].hidden2").val(jsonAllSpansText2);
                $(this).hide();
                $(this).siblings("input[type='text']").val("");
            });
            
            $(this).on("click" , ">button" , function(){
                if($(this).siblings("input[type='text']").val() != ""){
                var tagWrapperInputText = $(this).siblings("input[type='text']").val();
                $(this).siblings("span:not(.option)").filter(function(){
                    if($(this).html() == tagWrapperInputText){
                        alert("cant bro");
                        $(this).remove();
                    }
                });

                $(this).siblings("input[type='text']").val("");
                $(this).parent().prepend("<span>"+tagWrapperInputText+"</span>");
                $(this).parent(".tag-wrapper").children("span").css({ "background-color": "#eee",
                    "border": "1px solid black",
                    "border-radius": "2px",
                    "display": "inline-block",
                    "margin": "3px 5px",
                    "padding": "5px 10px",
                    "cursor": "pointer"});
                var allSpanInWrapper = $(this).siblings("span:not(.option)");
                // make arrays every time 
                addedSpansHtml = [];
                addedSpansHtml2 = [];
                allSpanInWrapper.filter(function(){
                    addedSpansHtml.push("newTag-"+$(this).html());
                    addedSpansHtml2.push($(this).html());
                });

                addedSpansHtml = addedSpansHtml.concat(optionSelectedDataId);
                addedSpansHtml2 = addedSpansHtml2.concat(optionSelectedDataId);
                jsonAllSpansText = JSON.stringify(addedSpansHtml);
                jsonAllSpansText2 = JSON.stringify(addedSpansHtml2);
                $(this).siblings("input[type='hidden'].hidden1").val(jsonAllSpansText);
                $(this).siblings("input[type='hidden'].hidden2").val(jsonAllSpansText2);
                }
            });
            // delete spans and delete this spans value from input type hidden
            $(this).on("click" , ">span" , function(){
                var allSpanInWrapper = $(this).siblings("span:not(.option)");
                addedSpansHtml = [];
                addedSpansHtml2 = [];
                
                allSpanInWrapper.filter(function(){
                    addedSpansHtml.push("newTag-"+$(this).html());
                    addedSpansHtml2.push($(this).html());
                });
                // make arrays every time 
                var thisSpanDataValue = $(this).attr("data-focus");
                if(optionSelectedDataId.indexOf(thisSpanDataValue) != -1){
                    optionSelectedDataId.splice(optionSelectedDataId.indexOf(thisSpanDataValue) , 1);
                }
                addedSpansHtml = addedSpansHtml.concat(optionSelectedDataId);
                addedSpansHtml2 = addedSpansHtml2.concat(optionSelectedDataId);
                jsonAllSpansText = JSON.stringify(addedSpansHtml);
                jsonAllSpansText2 = JSON.stringify(addedSpansHtml2);
                $(this).siblings("input[type='hidden'].hidden1").val(jsonAllSpansText);
                $(this).siblings("input[type='hidden'].hidden2").val(jsonAllSpansText2);
                $(this).remove();
            });
        };
        
        

        
