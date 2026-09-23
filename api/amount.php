<?php
    require_once("../core/db.php");
    require_once("../core/helpers.php");
    
    $id = $LOCNGUYEN_SIEUTHICODE->site('partner_id_card');
    $url = curl_get("https://gachthefast.com/chargingws/v2/getfee?partner_id=$id");
    $result = json_decode($url);
    $data = "<option value=''>Chọn mệnh giá</option>";
    $type_card = xss($_POST['type_card']);
    if(isset($type_card) && empty($type_card))
    {
        return die($data);
    }
    foreach($result as $key => $value)
    {
        if($value->telco == $type_card)
        {
            $data .= "<option value=".$value->value.">".format_cash($value->value)." đ (".$value->fees."%) thực nhận (".format_cash($value->value-($value->value/100*$value->fees))." đ)</option>";
        }
    }
    return die($data);
?>