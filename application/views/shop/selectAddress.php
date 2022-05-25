<div class="address-wrapper">
   <form method="post" action="<?=base_url()."Shop/createFactor";?>">
      <div class="address-wrapper-title">
         <h2>  انتخاب آدرس</h2>
      </div>
        <?php
        $counter = 1;
        $checked = "checked";
        foreach ($userAddress as $rows ) {
            if($counter > 1){
                $checked = null;
            }
            echo "<div class=\"address-box\">
                    <label for=\"adress-".$counter."\" class=\"choose-adress\">
                    <input id=\"adress-".$counter."\" type=\"radio\" value=\"".$rows['address']."\" name=\"address\"  ".$checked.">
                    <span> آدرس ".$counter." : </span>
                    </label>
                    <div class=\"address-descrption\">
                    <p>".$rows['address']." </p>
                    </div>
                </div>";
            $counter++;
        }
        ?>
      <div class="form-group">
         <input type="submit" name="factor" value=" ادامه خرید " class="btn btn-success">
      </div>
   </form>
   <form method="post" action="<?=base_url()."Shop/selectAddress";?>">
      <div class="form-group add-adress">
         <textarea class="form-control" id="" cols="30" rows="10" name="newAddress" placeholder="افزودن آدرس جدید"></textarea>
      </div>
      <div class="form-group">
         <input type="submit" value="افزودن آدرس " name="regAddress" class="btn btn-primary">
      </div>
   </form>
</div>

