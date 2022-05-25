<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?=$pageTitle;?></h3>
                    </div>
                    <?php
                    if(compare2Date($lotteryStatus['lotteryExpireDate'],date("Y-m-d H:i:s"))){ 
                        if($lotteryStatus['lotteryStatus'] == "e"){
                            echo "<form role=\"form\" action=\"".base_url()."Shop/runLottery/".$id."\" method=\"post\" enctype=\"multipart/form-data\">
                                    <div class=\"box-body\">
                                        <div class=\"form-group\">
                                            <button type=\"submit\" name=\"submit\" value=\"submit\" class=\"btn btn-primary\">برگذاری قرعه کشی</button>    
                                        </div>
                                    </div>
                                 </form>";      
                        }else{
                            echo " <div class=\"box-body\">
                                        <div class=\"form-group\">
                                            قرعه کشی انجام شده است
                                        </div>
                                    </div>";
                        }
                    } else{
                        echo " <div class=\"box-body\">
                                        <div class=\"form-group\">
                                            زمان قرعه کشی هنوز فرا نرسیده است
                                    </div>
                                </div>";
                    }
                    ?>
                              
                </div>
            </div>
        </section>
    </div>
</div>


