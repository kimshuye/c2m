<?php

class Salepage_model extends CI_Model {



        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->library('session');


        }




           public function Getproductlist()
        {

$query = $this->db->query('SELECT 
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_score as product_score,
    wl.product_image as product_image,
    wl.product_price as product_price,
    wl.product_price_discount as product_price_discount,
    wl.product_stock_num as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name
    FROM wh_product_list  as wl 
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND wl.product_image != ""
    ORDER BY wl.product_id DESC');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }


          public function Getproductlistcat($data)
        {

$query = $this->db->query('SELECT 
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_score as product_score,
    wl.product_image as product_image,
    wl.product_price as product_price,
    wl.product_price_discount as product_price_discount,
    wl.product_stock_num as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name
    FROM wh_product_list  as wl 
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND wl.product_image != "" AND wc.product_category_id="'.$data['product_category_id'].'" 
    ORDER BY wl.product_id DESC');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }




        public function Findproduct($data)
        {

$query_p_cus = $this->db->query('SELECT *
    FROM product_price_cus  
    WHERE owner_id="'.$_SESSION['owner_id'].'" AND cus_id="'.$data['cus_id'].'" AND product_code="'.$data['product_code'].'"
    ORDER BY product_id DESC');




$query = $this->db->query('SELECT 
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_score as product_score,
    wl.product_price as product_price,
    wl.product_price_discount as product_price_discount,
    wl.product_stock_num as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name
    FROM wh_product_list  as wl 
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND  wl.product_code="'.$data['product_code'].'"
    ORDER BY wl.product_id DESC');



$query_p = $this->db->query('SELECT 
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_score as product_score,
    pc.product_price_cus as product_price,
    wl.product_price_discount as product_price_discount,
    wl.product_stock_num as product_stock_num,
    wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name
    FROM wh_product_list  as wl
    LEFT JOIN product_price_cus as pc on pc.product_id=wl.product_id
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
    WHERE wl.owner_id="'.$_SESSION['owner_id'].'" AND  wl.product_code="'.$data['product_code'].'" AND pc.cus_id="'.$data['cus_id'].'"
    ORDER BY wl.product_id DESC');


$query_p_cus_num_rows = $query_p_cus->num_rows();


if($query_p_cus_num_rows > 0){

  $encode_data = json_encode($query_p->result(),JSON_UNESCAPED_UNICODE );
  
}else{
   $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
 
}



return $encode_data;

        }





  public function Customer($data)
        {

$query = $this->db->query('SELECT  co.cus_id as cus_id,co.cus_name as cus_name, co.cus_tel as cus_tel,co.cus_address as cus_address, tp.province_name as province_name,ta.amphur_name as amphur_name,td.district_name as district_name, co.cus_address_postcode as cus_address_postcode, co.cus_add_time as cus_add_time
    FROM customer_owner as co
    LEFT JOIN owner as ow on ow.owner_id=co.owner_id
    LEFT JOIN thai_province as tp on tp.province_id=co.province_id
    LEFT JOIN thai_amphur as ta on ta.amphur_id=co.amphur_id
    LEFT JOIN thai_district as td on td.district_id=co.district_id
    WHERE ow.owner_id="'.$_SESSION['owner_id'].'" and co.cus_name LIKE "%'.$data['cus_name'].'%" OR ow.owner_id="'.$_SESSION['owner_id'].'" and co.cus_add_time LIKE "%'.$data['cus_name'].'%"  ORDER BY co.cus_id DESC LIMIT 5');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }


        
public function Adddetail($data)
        {

$data['owner_id'] = $_SESSION['owner_id'];
$data['user_id'] = $_SESSION['user_id'];
$data['store_id'] = $_SESSION['store_id'];
if ($this->db->insert("sale_list_datail", $data)){
        return true;
    }

  }


      public function Addheader($data)
        {
$data2['cus_name'] = $data['cus_name'];
    $data2['cus_id'] = $data['cus_id'];
    $data2['cus_address_all'] = $data['cus_address_all'];
    $data2['sumsale_discount'] = $data['sumsale_discount'];
    $data2['sumsale_num '] = $data['sumsale_num'];
    $data2['sumsale_price'] = $data['sumsale_price'];
    $data2['money_from_customer'] =  $data['money_from_customer']; 
    $data2['money_changeto_customer'] = $data['money_changeto_customer'];
    $data2['vat'] = $data['vat'];
    $data2['product_score_all'] = $data['product_score_all'];
    $data2['sale_runno'] = $data['sale_runno'];
    $data2['adddate'] = $data['adddate'];
    
$data2['owner_id'] = $_SESSION['owner_id'];
$data2['user_id'] = $_SESSION['user_id'];
$data2['store_id'] = $_SESSION['store_id'];
if ($this->db->insert("sale_list_header", $data2)){

$this->db->query('UPDATE customer_owner 
    SET product_score_all=product_score_all + '.$data2['product_score_all'].' WHERE cus_id="'.$data2['cus_id'].'" and  owner_id="'.$_SESSION['owner_id'].'"');

    }
}


         public function Updateproductdeletestock($data2)
        {
$price_value = $data2['product_sale_num'] * $data2['product_price'];
$query = $this->db->query('UPDATE wh_product_list 
    SET product_stock_num=product_stock_num - '.$data2['product_sale_num'].'   
    WHERE product_id="'.$data2['product_id'].'" and  owner_id="'.$_SESSION['owner_id'].'"');
return true;

        }




public function Gettoday($data)
        {


 $perpage = $data['perpage'];

            if($data['page'] && $data['page'] != ''){
$page = $data['page'];
            }else{
          $page = '1';      
            }


            $start = ($page - 1) * $perpage;

$today = date('d-m-Y',time());

$querynum = $this->db->query('SELECT *, from_unixtime(adddate,"%d-%m-%Y %H:%i:%s") as adddate
    FROM sale_list_header  
    WHERE owner_id="'.$_SESSION['owner_id'].'"  AND cus_name LIKE "%'.$data['searchtext'].'%" AND ( from_unixtime(adddate,"%d-%m-%Y")="'.$today.'" ) OR owner_id="'.$_SESSION['owner_id'].'" AND sale_runno = "'.$data['searchtext'].'"
    ORDER BY ID DESC');


$query = $this->db->query('SELECT *, from_unixtime(adddate,"%d-%m-%Y %H:%i:%s") as adddate
    FROM sale_list_header  
    WHERE owner_id="'.$_SESSION['owner_id'].'"  AND cus_name LIKE "%'.$data['searchtext'].'%" AND ( from_unixtime(adddate,"%d-%m-%Y")="'.$today.'" ) OR owner_id="'.$_SESSION['owner_id'].'" AND sale_runno = "'.$data['searchtext'].'"
    ORDER BY ID DESC LIMIT '.$start.' , '.$perpage.' ');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );


$num_rows = $querynum->num_rows();

$pageall = ceil($num_rows/$perpage);




$json = '{"list": '.$encode_data.',
"numall": '.$num_rows.',"perpage": '.$perpage.', "pageall": '.$pageall.'}';

return $json;


        }

public function Getmonth($data)
        {


 $perpage = $data['perpage'];

            if($data['page'] && $data['page'] != ''){
$page = $data['page'];
            }else{
          $page = '1';      
            }


            $start = ($page - 1) * $perpage;

$today = date('d-m-Y',time());
$m = date("m", time());
$y = date("Y", time());

$starttday = mktime(0, 0, 0,01, 01, $y);
$lastday = mktime(0, 0, 0, 12, -31, $y);

$starttday = date($starttday); 
$lastday = date($lastday); 

$querynum = $this->db->query('SELECT *, from_unixtime(adddate,"%d-%m-%Y %H:%i:%s") as adddate
    FROM sale_list_header  
    WHERE owner_id="'.$_SESSION['owner_id'].'"  AND cus_name LIKE "%'.$data['searchtext'].'%" AND ( adddate BETWEEN from_unixtime('.$starttday.',"%d-%m-%Y %H:%i:%s") AND from_unixtime('.$lastday .',"%d-%m-%Y %H:%i:%s") ) OR owner_id="'.$_SESSION['owner_id'].'" AND sale_runno = "'.$data['searchtext'].'"
    ORDER BY ID DESC');


$query = $this->db->query('SELECT *, from_unixtime(adddate,"%d-%m-%Y %H:%i:%s") as adddate
    FROM sale_list_header  
    WHERE owner_id="'.$_SESSION['owner_id'].'"  AND cus_name LIKE "%'.$data['searchtext'].'%" AND ( adddate BETWEEN from_unixtime('.$starttday.',"%d-%m-%Y %H:%i:%s") AND from_unixtime('.$lastday .',"%d-%m-%Y %H:%i:%s") ) OR owner_id="'.$_SESSION['owner_id'].'" AND sale_runno = "'.$data['searchtext'].'"
    ORDER BY ID DESC LIMIT '.$start.' , '.$perpage.' ');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );


$num_rows = $querynum->num_rows();

$pageall = ceil($num_rows/$perpage);




$json = '{"list": '.$encode_data.',
"numall": '.$num_rows.',"perpage": '.$perpage.', "pageall": '.$pageall.'}';

return $json;


        }


}

