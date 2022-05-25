<?php

class Shop_class extends MY_Model {

/*
--------------------------------------------------------------------
--- class constuctor method ----------------------------------------
--------------------------------------------------------------------
*/

    function __construct() 
    {
        parent::__construct();
    }

/*
--------------------------------------------------------------------
--- Add To Cart ----------------------------------------------------
--------------------------------------------------------------------
*/

    public function addToCart($values) 
    {
        if(!isset($values['qty'])){
            $values['qty'] = 1;
        }
        $this->load->library('cart');
        $data = array(
            'id' => $values['productID'],
            'qty' => $values['qty'],
            'price' => $values['productAmount'],
            'name' => $values['productTitle'],
            'code' => $values['productCode'],
            'weight' => $values['productWeight'],
        );
        $this->cart->insert($data);
    }

/*
--------------------------------------------------------------------
--- Remove Item From Cart ------------------------------------------
--------------------------------------------------------------------
*/
    public function removeItemFromCart($values) 
    {
        $this->load->library('cart');
        foreach($this->cart->contents() as $key => $value){
            if($value['id'] == $values['id']){
                $rowid = $key;
                break;
            }
        }
        $data = array('rowid' =>$rowid, 'qty' => 0);
        $this->cart->update($data);
    }

/*
--------------------------------------------------------------------
--- Gift Card List -------------------------------------------------
--------------------------------------------------------------------
*/

    public function updateCart($values) 
    {
        $this->load->library('cart');
        $data = array('rowid' => $values['rowID'], 'qty' => $values['qty']);
        $this->cart->update($data);
        $result = array($this->cart->contents()[$values['rowID']]['subtotal'], $this->cart->contents());
    }


/*
--------------------------------------------------------------------
--- Gift Card List -------------------------------------------------
--------------------------------------------------------------------
*/

    function getGiftCardList($limit, $segments, $page, $url) 
    {
        $query = "SELECT * FROM tbl_shop_giftcard ORDER BY created_at DESC";
        return $this->paginate($limit,$segments,$page,$query,$url,"panel");
    }

/*
--------------------------------------------------------------------
--- Add Gift Card --------------------------------------------------
--------------------------------------------------------------------
*/

    function addGiftCard($values) 
    {
        $data = array();
        $singleData = array();
        $this->load->helper("pdate");
        $this->load->helper("str");
        for ($i = 1; $i <= $values['giftCardCount']; $i++) {
            $singleData['giftCardID'] = randomString(10);
            $singleData['giftCardExpireDate'] = jalToGre($values['giftCardExpireDate']);
            $singleData['giftCardAmount'] = $values['giftCardAmount'];
            $singleData['giftCardStatus'] = "e";
            $singleData['created_at'] = date("Y-m-d H:i:s");
            array_push($data, $singleData);
        }
        $this->createdAt = false;
        $this->table = "tbl_shop_giftcard";
        $this->insert($data);
    }

/*
--------------------------------------------------------------------
--- Delete Gift Card -----------------------------------------------
--------------------------------------------------------------------
*/

    function deleteGiftCard($id,$cardID) 
    {
        $this->table = "tbl_shop_giftcard";
        $this->primeryKey = "giftID";
        $this->delete($id,$cardID);	
    }
/*
--------------------------------------------------------------------
--- Get Factor Description -----------------------------------------
--------------------------------------------------------------------
*/

    function getFactorDesc() 
    {
        $this->table = "tbl_shop_factor_desc";
        $this->selectConditions['select'] = "description";
        $this->selectConditions['where'] = "id = '1'";
        $this->selectConditions['resultType'] = "1"; 
        return $this->getData();
    }

/*
--------------------------------------------------------------------
--- Edit Factor Description -----------------------------------------
--------------------------------------------------------------------
*/

    function editFactorDesc($description) 
    {
        $data["description"] = $description['description'];
        $this->table = "tbl_shop_factor_desc";
        $this->updatedAt = false;
        $this->primeryKey = "id";
        $this->update($data,"1","ویرایش توضیحات فاکتور");
    }

/*
--------------------------------------------------------------------
--- Factor Financial Actions ---------------------------------------
--------------------------------------------------------------------
*/

    function financialActionData($values, $id = NULL,$title = NULL) 
    {
        $this->load->helper("pdate");
        $values['financialStartDate'] = jalToGre($values['financialStartDate']);
        $values['financialExpireDate'] = jalToGre($values['financialExpireDate']);
        unset($values['submit']);
        $this->table = "tbl_shop_factor_financial";
        if ($id == NULL) {
            $this->insert($values,$values['financialTitle']);
        } else {
            $this->primeryKey = "financialID";
            $this->update($values,$id,$title);
        }
    }

/*
--------------------------------------------------------------------
--- Get Financial List ---------------------------------------------
--------------------------------------------------------------------
*/

    function getfactorFinancialList($limit, $segments, $page, $url) 
    {
        $query = "SELECT * FROM tbl_shop_factor_financial ORDER BY created_at DESC";
        return $this->paginate($limit,$segments,$page,$query,$url,"panel");
    }

/*
--------------------------------------------------------------------
--- Get Financial Setting ------------------------------------------
--------------------------------------------------------------------
*/

    function getFinancial($id) 
    {
        $this->table = "tbl_shop_factor_financial";
        $this->selectConditions['where'] = "financialID = '".$id."'";
        $this->selectConditions['resultType'] = "1"; 
        return $this->getData();
    }

/*
--------------------------------------------------------------------
--- Check Gift Card ------------------------------------------------
--------------------------------------------------------------------
*/

    public function checkGiftCard($values) 
    {
        $this->table = "tbl_shop_giftcard";
        $this->selectConditions['where'] = "giftCardID = '".$values['code']."' AND giftcardStatus = 'e'";
        $this->selectConditions['resultType'] = "1"; 
        $result = $this->getData();
        if (count($result) > 0) {
            if (strtotime($result['giftCardExpireDate']) < strtotime(date("Y-m-d"))) {
                return 0;
            } else {
                $userData['giftCard'] = $values['code'];
                $this->session->set_userdata($userData);
                return 1;
            }
        } else {
            return 0;
        }
    }

/*
--------------------------------------------------------------------
--- Create Factor --------------------------------------------------
--------------------------------------------------------------------
*/

    public function createFactor() 
    {
        $this->load->helper("str");
        $factorID = $factorData['factorID'] = date("ymdhis") . randomNumber(4);
        $factorItems = array();
        $factorItem = array();
        $factorActions = array();
        $factorAction = array();
        $actions = 0;
        $weight = 0;

        // Create Items Query
        foreach ($this->cart->contents() as $cartRow) {
            $factorItem['itemGUID'] = guid();
            $factorItem['itemFactorID'] = $factorID;
            $factorItem['itemProductGUID'] = $cartRow['id'];
            $factorItem['itemAmount'] = $cartRow['price'] * 10;
            $factorItem['itemQuantity'] = $cartRow['qty'];
            $factorItem['itemProductTitle'] = $cartRow['name'];
            array_push($factorItems, $factorItem);
            $weight = $weight + ($cartRow['qty'] * $cartRow['weight']);
        }

        // Process Financial 
        $factorData['factorFinancialAction'] = '';
        $this->table = "tbl_shop_factor_financial";
        $this->selectConditions['select'] = "financialTitle,financialPercent,financialType,financialStartDate,financialExpireDate";
        $this->selectConditions['where'] = "financialStatus = '1'";
        $result = $this->getData();

        if (count($result) > 0) {
            foreach ($result as $financialRow) {
                if (strtotime($financialRow['financialStartDate']) < strtotime(date("Y-m-d")) && strtotime($financialRow['financialExpireDate']) >= strtotime(date("Y-m-d"))) {
                    $factorAction['actionTitle'] = $financialRow['financialTitle'];
                    $factorAction['actionType'] = $financialRow['financialType'];
                    $factorAction['actionPercent'] = $financialRow['financialPercent'];                    
                    array_push($factorActions, $factorAction);
                    if($financialRow['financialType'] == "-"){
                        $actions += (-1) * $financialRow['financialPercent'];
                    }else{
                        $actions += $financialRow['financialPercent'];
                    }
                }
            }
            $factorData['factorFinancialAction'] = json_encode($factorActions,JSON_UNESCAPED_UNICODE);
        }

        // Check Gift Card
        $factorData['factorGiftCard'] = 0;
        if(isset($this->session->userdata['giftCard'])){
            $this->table = "tbl_shop_giftcard";
            $this->selectConditions['select'] = "giftCardAmount"; 
            $this->selectConditions['where'] = "giftCardID = '".$this->session->userdata['giftCard']."' AND giftcardStatus = 'e'";
            $this->selectConditions['resultType'] = "1"; 
            $result = $this->getData();
            $factorData['factorGiftCard'] = $result['giftCardAmount'];
        }

        //Proccess Delivery Amount
        if ($this->session->userdata("userLocation") == "89") {
            $factorData['factorDeliveryFee'] = "150000";
        }else{
            $factorData['factorDeliveryFee'] = $this->session->userdata("userLocationDel") * ($weight / 1000);
        }

        //Process Factor Amount And Payment
        $factorData['factorAmount'] = $this->cart->total() * 10;
        $factorData['factorPayment'] = ($factorData['factorAmount'] + ($factorData['factorAmount'] * ($actions / 100))) + $factorData['factorDeliveryFee'] - $factorData['factorGiftCard'] - $this->session->userdata("userAccount");
        $factorData['factorPaymentStatus'] = "d";
        $factorData['factorRefID'] = null;
        if($factorData['factorPayment'] < 0){
            $factorData['factorPaymentStatus'] = "e";
            $factorData['factorRefID'] = $this->session->userdata("userGUID");
        }
        $factorData['factorUserID'] = $this->session->userdata("userGUID");
        $factorData['factorStatus'] = "s";
        $factorData['factorUserAccount'] = $this->session->userdata("userAccount");
        $factorData['factorSendAddress'] = $this->session->userdata("userAddress");
        // Insert Factor Data
        $this->db->trans_start();
        $this->table = "tbl_shop_factor";
        $this->insert($factorData);
        $this->createdAt = false;	
        $this->table = "tbl_shop_factor_item";
        $this->insert($factorItems);	
        $this->db->trans_complete();
        return $factorID;
    }

/*
--------------------------------------------------------------------
--- Create Factor --------------------------------------------------
--------------------------------------------------------------------
*/

    function getfactorList($limit, $segments, $page, $url, $type) 
    {
        if ($type == "cms") {
            $query = "SELECT *,tbl_shop_factor.created_at as factorRegDate FROM tbl_shop_factor INNER JOIN tbl_user_sm ON tbl_user_sm.userGUID = tbl_shop_factor.factorUserID ORDER BY tbl_shop_factor.created_at DESC";
            $result =  $this->paginate($limit,$segments,$page,$query,$url,"panel");
        } else {
            $query = "SELECT * FROM tbl_shop_factor WHERE factorUserID = '" . $this->session->userdata("userGUID") . "' ORDER BY created_at DESC";
            $result =  $this->paginate($limit,$segments,$page,$query,$url,"panel");
        }
        return $result;
    }

/*
--------------------------------------------------------------------
--- Delete Factor -----------------------------------------------
--------------------------------------------------------------------
*/

    function deleteFactor($id) 
    {
        $this->table = "tbl_shop_factor";
        $this->primeryKey = "factorID";
        $this->delete($id,$id);	
    }


/*
--------------------------------------------------------------------
--- Factor View ----------------------------------------------------
--------------------------------------------------------------------
*/
    public function getFactorItems($factorID, $type) 
    {

        if ($type == "user") {

            $this->db->select("tbl_product.productUnit,tbl_product.productTitle,tbl_factor.*,tbl_factor_item.*");
            $this->db->from('tbl_factor');
            $this->db->join('tbl_factor_item', "tbl_factor.factorID = tbl_factor_item.itemFactorID", "LEFT OUTER");
            $this->db->join('tbl_product', "tbl_product.productGUID = tbl_factor_item.itemProductGUID", "LEFT OUTER");
            $this->db->where("tbl_factor_item.itemFactorID", $factorID);
            $this->db->where("tbl_factor.factorUserID", $this->session->userdata("userGUID"));
            $query = $this->db->get();

            if ($query->num_rows() > 0) {

                return $query->result_array();
            } else {

                redirect(base_url(), "Refresh");
            }
        } else {
            $this->table = "tbl_shop_factor";
            $this->selectConditions = array("where"=>"factorID = '".$factorID."'",
                                            "join"=>array(array("table"=>"tbl_shop_factor_item","joinCondition"=>"tbl_shop_factor_item.itemFactorID = tbl_shop_factor.factorID","joinType"=>"INNER"),
                                                          array("table"=>"tbl_user_sm","joinCondition"=>"tbl_shop_factor.factorUserID = tbl_user_sm.userGUID","joinType"=>"INNER"),
                                                          array("table"=>"tbl_location","joinCondition"=>"tbl_location.id = tbl_user_sm.userLocation","joinType"=>"INNER"),
                                                          )
                                            );			
            
            return $this->getData();           
        }
    }

/*
--------------------------------------------------------------------
--- Get All Locaion  -----------------------------------------------
--------------------------------------------------------------------
*/

    public function getAllLocation() 
    {
        $this->table = "tbl_location";
        return $this->getData();           
    }

/*
--------------------------------------------------------------------
--- Change Factor Status  ------------------------------------------
--------------------------------------------------------------------
*/

    function changeFactorStatus($values, $factorID) 
    {
        unset($values["submit"]);
        $this->table = "tbl_shop_factor";
        $this->primeryKey = "factorID";
        $this->update($values,$factorID,$factorID);

        // $this->load->model("Message_class");
        // if (isset($values['factorStatus'])) {
        //     $data = array("factorDelivery" => "0", "factorStatus" => $values['factorStatus'], "factorChStatusDate" => date("Y-m-d H:i:s"), "factorRefID" => $values['refID']);
        //     $this->db->query("UPDATE tbl_user SET userBuy = userBuy+" . $values['amount'] . " , userBuyCount = userBuyCount+1 WHERE userGUID = '" . $values['userGUID'] . "'");
        //     $this->db->from("tbl_shop_statistic");
        //     $this->db->where("shoppingDate", date("Y-m-d"));
        //     $query = $this->db->get();
        //     if ($query->num_rows() == 0) {
        //         $statisticData = array("shoppingDate" => date("Y-m-d"), "shoppingAmount" => $values['amount'], "shoppingCount" => 1);
        //         $this->db->insert("tbl_shop_statistic", $statisticData);
        //     } else {
        //         $statisticData = array("shoppingAmount" => $query->result_array()[0]["shoppingAmount"] + $values['amount'], "shoppingCount" => $query->result_array()[0]["shoppingCount"] + 1);
        //         $this->db->where("shoppingDate", date("Y-m-d"));
        //         $this->db->update("tbl_shop_statistic", $statisticData);
        //     }
        //     $this->Message_class->confirmPayment($values['userName'], $factorID, $values['userEmail'], $values['amount']);
        //     parent::userLog("تایید فاکتور", $factorID);
        // } else {
        //     $data = array("factorDelivery" => $values['factorDelivery'], "factorChStatusDate" => date("Y-m-d H:i:s"));
        //     $this->Message_class->changeFactorStatus($values['userName'], $factorID, $values['userEmail'], $values['factorDelivery']);
        // }

    }

/*
--------------------------------------------------------------------
--- Add Lottery ----------------------------------------------------
--------------------------------------------------------------------
*/

    function addLottery($values) 
    {
        $data = array();
        $singleData = array();
        $this->load->helper("pdate");
        $this->load->helper("str");
        $singleData['chanceLotteryGUID'] = $lotteryData['lotteryGUID'] = guid();
        $lotteryData['lotteryTitle'] = $values['lotteryTitle'];
        $lotteryData['lotteryWinnerCount'] = $values['lotteryWinnerCount'];
        $lotteryData['lotteryExpireDate'] = jalToGre($values['lotteryExpireDate']);
        $lotteryData['lotteryStatus'] = "e";
        for ($i = 1; $i <= $values['onlineCode']; $i++) {
            $singleData['chanceCode'] = randomString(10);
            $singleData['chanceGUID'] = guid();
            $singleData['chanceUserType'] = "on";
            $singleData['chanceStatus'] = "d";
            array_push($data, $singleData);
        }
        for ($i = 1; $i <= $values['offlineCode']; $i++) {
            $singleData['chanceCode'] = randomString(10);
            $singleData['chanceGUID'] = guid();
            $singleData['chanceUserType'] = "off";
            $singleData['chanceStatus'] = "d";
            array_push($data, $singleData);
        }
        $this->db->trans_start();
        $this->table = "tbl_lottery";
        $this->insert($lotteryData,$values['lotteryTitle']);
        $this->createdAt = false;	
        $this->table = "tbl_lottery_chance";
        $this->insert($data);	
        $this->db->trans_complete();
    }

/*
--------------------------------------------------------------------
--- Get Lottery List -----------------------------------------------
--------------------------------------------------------------------
*/

    function getLotteryList($limit, $segments, $page, $url) 
    {
        $query = "SELECT * FROM tbl_lottery ORDER BY created_at DESC";
        $result =  $this->paginate($limit,$segments,$page,$query,$url,"panel");
        return $result;
    }

/*
--------------------------------------------------------------------
--- Get Chance List -----------------------------------------------
--------------------------------------------------------------------
*/

    function getChanceList($limit, $segments, $page, $url) 
    {
        $query = "SELECT * FROM tbl_lottery_chance ORDER BY chanceStatus DESC";
        $result =  $this->paginate($limit,$segments,$page,$query,$url,"panel");
        return $result;
    }

/*
--------------------------------------------------------------------
--- Get Lottery Status ---------------------------------------------
--------------------------------------------------------------------
*/

    public function getLotteryStatus($id) 
    {
        $this->table = "tbl_lottery";
        $this->selectConditions['where'] = "lotteryGUID = '".$id."'";
        $this->selectConditions['resultType'] = "1"; 
        return $this->getData();
    }

/*
--------------------------------------------------------------------
--- Run Lottery Status ---------------------------------------------
--------------------------------------------------------------------
*/

    public function runLottery($id,$count) 
    {
        $this->table = "tbl_lottery_chance";
        $this->selectConditions['select'] = "chanceGUID";
        $this->selectConditions['where'] = "chanceLotteryGUID = '".$id."' AND chanceUserName IS NOT NULL OR chanceUserName != ''"; 
        $result = $this->getData();
        $winner = array_rand($result,$count);
        $this->table = "tbl_lottery_chance";
        $this->updatedAt = false;
        $this->db->trans_start();
        foreach($result as $key => $value){
            if(in_array($key,$winner)){
                $this->primeryKey = 'chanceGUID';
                $data['chanceStatus'] = 'w';
                $this->update($data,$value['chanceGUID']);
            }else{
                $this->primeryKey = 'chanceGUID';
                $data['chanceStatus'] = 'l';
                $this->update($data,$value['chanceGUID']);
            }
        }
        $this->table = "tbl_lottery";
        $lottery['lotteryStatus'] = 'd';
        $this->primeryKey = 'lotteryGUID';
        $this->update($lottery,$id);
        $this->db->trans_complete();
    } 
    
/*
--------------------------------------------------------------------
--- Delete Factor --------------------------------------------------
--------------------------------------------------------------------
*/

    function deleteLottery($id,$title) 
    {
        $this->table = "tbl_lottery";
        $this->primeryKey = "lotteryGUID";
        $this->delete($id,$title);	
    }

/*
--------------------------------------------------------------------
--- Get Location Fee -----------------------------------------------
--------------------------------------------------------------------
*/

    function getLocationFee($id) 
    {
        $this->table = "tbl_location";
        $this->selectConditions['select'] = "locDelFee";
        $this->selectConditions['where'] = "id = '".$id."'";
        $this->selectConditions['resultType'] = "1"; 
        return $this->getData()['locDelFee'];
    }

/*
--------------------------------------------------------------------
--- Set New Delivery Fee -------------------------------------------
--------------------------------------------------------------------
*/

    function setDeliveryFee($id, $fee) 
    {
        $this->updatedAt = false;
        $data = array("locDelFee" => $fee);
        $this->table = "tbl_location";
        $this->primeryKey = 'id';
        $this->update($data,$id);
    }







    /************************************************************** 
     * 	Get Financial Factor Items
    /************************************************************ */

    public function getFinancialItems($factorID) {

        $giftCard = NULL;
        $financial = array();
        $giftCardResult = NULL;
        $financialResult = NULL;

        $this->db->from('tbl_factor_act');
        $this->db->where("actionFactorID", $factorID);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $rows) {

                if ($rows['actionType'] == "g") {

                    $giftCard = $rows['actionSrcID'];
                } else {

                    array_push($financial, $rows['actionSrcID']);
                }
            }

            if ($giftCard != NULL) {

                $this->db->select('giftCardAmount');
                $this->db->from('tbl_giftcard');
                $this->db->where("giftID", $giftCard);
                $query = $this->db->get();
                $giftCardResult = $query->result_array();
            }

            if (count($financial) > 0) {

                $this->db->select('financialTitle,financialPercent,financialType');
                $this->db->from('tbl_factor_financial');
                $this->db->where_in('financialID', $financial);
                $query = $this->db->get();
                $financialResult = $query->result_array();
            }
        }

        $result['giftCard'] = $giftCardResult;
        $result['financial'] = $financialResult;
        return $result;
    }

    /*     * ************************************************************ 
     * 	Factor Payment Method Control
      /************************************************************ */

    public function factorPayment($factorID) {
              
        $config['factorID'] = $factorID;
        $this->db->select("factorPayment");
        $this->db->from("tbl_factor");
        $this->db->where("factorID", $factorID);
        $result = $this->db->get();        
        $config['amount'] = $result->result_array()[0]['factorPayment'];
        $config['callBackURL'] = $this->callBackURL;
        $config['terminalID'] = $this->terminalID;
        $config['merchantID'] = $this->merchantID;       
        $this->load->library("payment",$config);
        $this->payment->mabnaPayment();

    }

    /*     * ************************************************************ 
     * 	Payment Result
      /************************************************************ */

    public function paymentResult($refID) {

        $data = array("factorRefID" => $refID, "factorStatus" => "1", "factorChStatusDate" => date("Y-m-d H:i:s"));
        $this->db->where("factorID", $this->session->userdata("PayOrderId"));
        $this->db->update("tbl_factor", $data);

        $this->db->query("UPDATE tbl_user SET userBuy = userBuy+" . $this->session->userdata("amount") . " , userBuyCount = userBuyCount+1 WHERE userGUID = '" . $this->session->userdata("userGUID") . "'");

        $this->db->from("tbl_shop_statistic");
        $this->db->where("shoppingDate", date("Y-m-d"));
        $query = $this->db->get();

        if ($query->num_rows() == 0) {

            $statisticData = array("shoppingDate" => date("Y-m-d"), "shoppingAmount" => $this->session->userdata("amount"), "shoppingCount" => 1);
            $this->db->insert("tbl_shop_statistic", $statisticData);
        } else {

            $statisticData = array("shoppingAmount" => $query->result_array()[0]["shoppingAmount"] + $this->session->userdata("amount"), "shoppingCount" => $query->result_array()[0]["shoppingCount"] + 1);
            $this->db->where("shoppingDate", date("Y-m-d"));
            $this->db->update("tbl_shop_statistic", $statisticData);
        }

        $this->load->model("Message_class");
        $this->Message_class->confirmOnlinePayment($this->session->userdata("userName"), $this->session->userdata("PayOrderId"), $this->session->userdata("userEmail"), $this->session->userdata("amount"), $refID);

        $array_items = array('PayOrderId', 'terminal','merchantId');
        $this->session->unset_userdata($array_items);
    }



    /*
      |--------------------------------------------------------------------------
      | Factor Offline Payment
      |--------------------------------------------------------------------------
     */

    function offlinePayment($values, $factorID) {

        $this->load->helper("pdate");
        $data = array();
        $table = "tbl_offline_payment";
        $fields = $this->db->list_fields($table);

        foreach ($fields as $field) {

            if ($field != "offlineID" && $field != "offlineFactorID" && $field != "offlineRegDate") {

                $data[$field] = $values[$field];
            } elseif ($field == "offlineFactorID") {

                $data[$field] = $factorID;
            } elseif ($field == "offlineRegDate") {

                $data[$field] = jalToGre($values['offlineRegDate']);
            }
        }

        $this->db->trans_start();

        $this->db->insert($table, $data);
        $factorData = array("factorStatus" => "0");
        $this->db->where("factorID", $factorID);
        $this->db->update("tbl_factor", $factorData);

        $this->db->trans_complete();
    }

    /* End of file Shop_class.php 
      /* Location: ./application/modules/product/product_class.php
     */
}

?>