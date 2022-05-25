
var postURL = $("#base_url").val();
$(document).ready(function () {
    $("input[data-action='allSelected']").click(function(){
        var dataModule = $(this).attr("data-module");
        var dataSource = $(this).attr("data-source");
        var checked = $(this).prop("checked");
        if(checked == true){
            $("input[type='checkbox']").prop("checked",true);
            $(".panel-menu").append('<i class="fa fa-trash"></i><span data-action="delete-selected" data-source="'+dataSource+'" data-module="'+dataModule+'" class="link-title">حذف موارد انتخابی </span> </a>');   
        }else{
            $("input[type='checkbox']").prop("checked",false);
            $(".panel-menu").html('<a href="'+postURL+'Job/insertJob"><i class="fa fa-plus-square"></i><span class="link-title">درج آگهی جدید </span> </a>');      
        }      
    });
    $("td input[type='checkbox']").change(function(){
         if($("td input[type='checkbox']").length == $("td input[type='checkbox']:checked").length){
            $("th input[type='checkbox']").prop("checked" , true);
         }else{
             $("th input[type='checkbox']").prop("checked" , false);
         }
    }); 
    $("td input[type='checkbox']").change(function(){
        var dataModule = $(this).attr("data-module");
        var dataSource = $(this).attr("data-source");
        if($("td input[type='checkbox']:checked").length > 0){
            $(".panel-menu").html('<a href="'+postURL+'Job/insertJob"><i class="fa fa-plus-square"></i><span class="link-title">درج آگهی جدید </span> </a><i class="fa fa-trash"></i><span data-module="'+dataModule+'" data-source="'+dataSource+'" data-action="delete-selected" class="link-title">حذف موارد انتخابی </span> </a>');  
        }else{
            $(".panel-menu").html('<a href="'+postURL+'Job/insertJob"><i class="fa fa-plus-square"></i><span class="link-title">درج آگهی جدید </span> </a>');      
        }
   }); 

    $(document).on("click","span[data-action='delete-selected']",function(){
        var moduleName = $(this).attr("data-module");
        var sourceName = $(this).attr("data-source");
        var checked = [];
        var checkedName = [];
        $("input[name='selectedItem[]']:checked").each(function () {
            checked.push($(this).val());
            checkedName.push($(this).attr("data-name"));
        });
        var wantDeleteItem = confirm("آیا از حذف این موارد اطمینان دارید؟");
        if(wantDeleteItem === true){
            for(var i = 0 ; i < checked.length ; i++){
                $.ajax({
                    url: postURL+moduleName+'/delete'+sourceName+'Ajax',
                    type:'GET',
                    dataType: 'text',
                    data: {'id' : checked[i],'title' : checkedName[i]},
                    success: function(output_string){
                        if(output_string === "1"){
                           if(i == (checked.length)){
                                alertify.alert('حذف موارد انتخابی','موارد انتخابی با موفقیت حذف گردید ').set('onok', function(){ 
                                    location.reload();                              
                                }); 
                           }
                        }else{
                            alertify.alert('عدم دسترسی','شما مجوز دسترسی به این بخش را ندارید').set('onok', function(){ 
                                location.reload();                              
                            }); 
                        }
                    } 
                });	
            }     
        }else{
            return false;
        }

    }); 

    
    $("span[data-action='deleteItem']").click(function(){
        var wantDeleteItem = confirm("آیا از حذف این مورد اطمینان دارید؟");
        if(wantDeleteItem === true){
            window.location.href = $(this).data('link');
        }else{
            return false;
        }
      });
  

});
