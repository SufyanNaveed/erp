<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 #------------------------------------    
    # Author: Bdtask Ltd
    # Author link: https://www.bdtask.com/
    # Dynamic style php file
    # Developed by :Isahaq
    #------------------------------------    

class Delivery_note_model extends CI_Model {


 public function customer_list(){
     $query = $this->db->select('*')
                ->from('customer_information')
                ->where('status', '1')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
 }

    public function tax_fileds(){
        return $taxfield = $this->db->select('tax_name,default_value')
                ->from('tax_settings')
                ->get()
                ->result_array();
    }

        public function pos_customer_setup() {
        $query = $this->db->select('*')
                ->from('customer_information')
                ->where('customer_name', 'Walking Customer')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
 
      public function allproduct(){
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->order_by('product_name','asc');
        $this->db->limit(30);
        $query   = $this->db->get();
        $itemlist=$query->result();
        return $itemlist;
        }


   public function todays_delivery_note(){
        $this->db->select('a.*,b.customer_name');
        $this->db->from('delivery_note a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
        $this->db->where('a.date',date('Y-m-d'));
        $this->db->order_by('a.delivery_note', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

        public function customer_dropdown()
    {
        $data = $this->db->select("*")
            ->from('customer_information')
            ->get()
            ->result();

        $list[''] = 'Select Customer';
        if (!empty($data)) {
            foreach($data as $value)
                $list[$value->customer_id] = $value->customer_name;
            return $list;
        } else {
            return false; 
        }
    }

        public function customer_search($customer_id){
        $query = $this->db->select('*')
                          ->from('customer_information')
                          ->group_start()
                          ->like('customer_name', $customer_id)
                          ->or_like('customer_mobile', $customer_id)
                          ->group_end()
                          ->limit(30)
                          ->get();
                          if ($query->num_rows() > 0) {
                              return $query->result_array();  
                          }
                          return false;
    }

      public function count_delivery_note() {
        return $this->db->count_all("delivery_note");
    }

     public function getDeliveryNoteList($postData=null){
        
         $response = array();
         $usertype = $this->session->userdata('user_type');
         $fromdate = $this->input->post('fromdate',TRUE);
         $todate   = $this->input->post('todate',TRUE);
         if(!empty($fromdate)){
            $datbetween = "(a.date BETWEEN '$fromdate' AND '$todate')";
         }else{
            $datbetween = "";
         }
         ## Read value
         $draw         = $postData['draw'];
         $start        = $postData['start'];
         $rowperpage   = $postData['length']; // Rows display per page
         $columnIndex  = $postData['order'][0]['column']; // Column index
         $columnName   = $postData['columns'][$columnIndex]['data']; 
         $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
         $searchValue  = $postData['search']['value']; // Search value

         ## Search 
         $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (b.customer_name like '%".$searchValue."%' or a.delivery_note like '%".$searchValue."%' or a.date like'%".$searchValue."%' or a.delivery_note_id like'%".$searchValue."%' or u.first_name like'%".$searchValue."%'or u.last_name like'%".$searchValue."%')";
         }

         ## Total number of records without filtering
         $this->db->select('count(*) as allcount');
         $this->db->from('delivery_note a');
         $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
         $this->db->join('users u', 'u.user_id = a.sales_by','left');
         if($usertype == 2){
          $this->db->where('a.sales_by',$this->session->userdata('user_id'));
         }
          if(!empty($fromdate) && !empty($todate)){
             $this->db->where($datbetween);
         }
          if($searchValue != '')
          $this->db->where($searchQuery);
          
         $records = $this->db->get()->result();
         $totalRecords = $records[0]->allcount;

         ## Total number of record with filtering
         $this->db->select('count(*) as allcount');
         $this->db->from('delivery_note a');
         $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
         $this->db->join('users u', 'u.user_id = a.sales_by','left');
         if($usertype == 2){
          $this->db->where('a.sales_by',$this->session->userdata('user_id'));
         }
         if(!empty($fromdate) && !empty($todate)){
             $this->db->where($datbetween);
         }
         if($searchValue != '')
            $this->db->where($searchQuery);
          
         $records = $this->db->get()->result();
         $totalRecordwithFilter = $records[0]->allcount;

         ## Fetch records
         $this->db->select("a.*,b.customer_name,u.first_name,u.last_name");
         $this->db->from('delivery_note a');
         $this->db->join('customer_information b', 'b.customer_id = a.customer_id','left');
         $this->db->join('users u', 'u.user_id = a.sales_by','left');
         if($usertype == 2){
          $this->db->where('a.sales_by',$this->session->userdata('user_id'));
         }
          if(!empty($fromdate) && !empty($todate)){
             $this->db->where($datbetween);
         }
         if($searchValue != '')
         $this->db->where($searchQuery);
       
         $this->db->order_by($columnName, $columnSortOrder);
         $this->db->limit($rowperpage, $start);
         $records = $this->db->get()->result();
         
         ////die($this->db->last_query());
         $data = array();
         $sl =1;
  
         foreach($records as $record ){
          $button = '';
          $base_url = base_url();
          $jsaction = "return confirm('Are You Sure ?')";

           $button .='  <a href="'.$base_url.'delivery_note_details/'.$record->delivery_note_id.'" class="btn print_delivery_note btn-sm" data-toggle="tooltip" data-placement="left" title="'.display('delivery_note').'"><i class="fal fa-window-restore" aria-hidden="true"></i></a>';

         $button .='  <a href="'.$base_url.'delivery_note_pad_print/'.$record->delivery_note_id.'" class="btn action_btn btn-sm" data-toggle="tooltip" data-placement="left" title="'.display('pad_print').'"><i class="fal fa-fax" aria-hidden="true"></i></a>';

         if($record->status==1){
            $button .=' <a href="'.$base_url.'add_invoice/'.$record->delivery_note_id.'" class="btn edit_btn" data-toggle="tooltip" data-placement="left" title="Make Invoice"><i class="fal fa-pencil" aria-hidden="true"></i></a> ';
          }
          else
          {
            $button .=' <a href="#" class="btn edit_btn" data-toggle="tooltip" data-placement="left" title="Invoice Created"><i class="fal fa-pencil" aria-hidden="true"></i></a> ';
          }
          
          $button .='  <a href="'.$base_url.'download_delivery_note/'.$record->delivery_note_id.'" class="btn details_btn" data-toggle="tooltip" data-placement="left" title="'.display('download').'"><i class="fal fa-download"></i></a>';

      if($this->permission1->method('manage_delivery_note','update')->access()){
         $button .=' <a href="'.$base_url.'delivery_note_edit/'.$record->delivery_note_id.'" class="btn edit_btn" data-toggle="tooltip" data-placement="left" title="'. display('update').'"><i class="fal fa-pencil" aria-hidden="true"></i></a> ';
     }

        $button .=' <a href="'.$base_url.'delivery_note_delete/'.$record->delivery_note_id.'" class="btn delete_btn" data-toggle="tooltip" data-placement="left" title="'. display('delete').'"><i class="fal fa-trash-alt" aria-hidden="true"></i></a> ';
       

          $details ='  <a href="'.$base_url.'delivery_note_details/'.$record->delivery_note_id.'" class="" >'.$record->delivery_note.'</a>';
               
            $data[] = array( 
                'sl'               =>$sl,
                'delivery_note'    =>$details,
                'salesman'         =>$record->first_name.' '.$record->last_name,
                'customer_name'    =>$record->customer_name,
                'final_date'       =>date("d-M-Y",strtotime($record->date)),
                'total_amount'     =>$record->total_amount,
                'button'           =>$button,
                
            ); 
            $sl++;
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
         );

         return $response; 
    }

    public function delete_delivery_note($delivery_note_id)
    {
        
        $this->db->where('VNo', $delivery_note_id);
        $this->db->delete('acc_transaction');

        $this->db->where('relation_id', $delivery_note_id);
        $this->db->delete('tax_collection');

        $this->db->where('delivery_note_id', $delivery_note_id);
        $this->db->delete('delivery_note_details');

        $this->db->where('delivery_note_id', $delivery_note_id);
        $this->db->delete('delivery_note');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }


    }

public function delivery_note_taxinfo($delivery_note_id){
       return $this->db->select('*')   
            ->from('tax_collection')
            ->where('relation_id',$delivery_note_id)
            ->get()
            ->result_array(); 
    }

        public function retrieve_delivery_note_editdata($delivery_note_id) {
        $this->db->select('a.*, sum(c.quantity) as sum_quantity, a.total_tax as taxs,a. prevous_due,b.customer_name,c.*,c.tax as total_tax,c.product_id,d.product_name,d.product_model,d.tax,d.unit,d.*');
        $this->db->from('delivery_note a');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('delivery_note_details c', 'c.delivery_note_id = a.delivery_note_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->where('a.delivery_note_id', $delivery_note_id);
        $this->db->group_by('d.product_id');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

     public function delivery_note_entry() {

        $tablecolumn         = $this->db->list_fields('tax_collection');

        $num_column          = count($tablecolumn)-4;
        $delivery_note_id          = $this->generator(10);
        $delivery_note_id          = strtoupper($delivery_note_id);
        $createby            = $this->session->userdata('id');
        $createdate          = date('Y-m-d H:i:s');
        $product_id          = $this->input->post('product_id');
        $currency_details    = $this->db->select('*')->from('web_setting')->get()->result_array();
        $quantity            = $this->input->post('product_quantity',TRUE);
        $delivery_note_no_generated= $this->input->post('invoic_no');
        $changeamount        = $this->input->post('change',TRUE);
        if($changeamount > 0){
           $paidamount = $this->input->post('n_total',TRUE);

        }else{
             $paidamount = $this->input->post('paid_amount',TRUE);
        }

     $bank_id = $this->input->post('bank_id',TRUE);
        if(!empty($bank_id)){
       $bankname = $this->db->select('bank_name')->from('bank_add')->where('bank_id',$bank_id)->get()->row()->bank_name;
    
       $bankcoaid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$bankname)->get()->row()->HeadCode;
   }else{
    $bankcoaid='';
   }

        $available_quantity = $this->input->post('available_quantity',TRUE);
       
        $result = array();
        foreach ($available_quantity as $k => $v) {
            if ($v < $quantity[$k]) {
                $this->session->set_userdata(array('error_message' => display('you_can_not_buy_greater_than_available_qnty')));
                redirect('Cdelivery_note');
            }
        }


        $customer_id = $this->input->post('customer_id',TRUE);
       
        //Full or partial Payment record.
        $paid_amount    = $this->input->post('paid_amount',TRUE);
        $transection_id = $this->generator(8);
        $tax_v = 0;
             for($j=0;$j<$num_column;$j++){
                $taxfield        = 'tax'.$j;
                $taxvalue        = 'total_tax'.$j;
              $taxdata[$taxfield]=$this->input->post($taxvalue);
              $tax_v    += $this->input->post($taxvalue);
            }
            $taxdata['customer_id'] = $customer_id;
            $taxdata['date']        = (!empty($this->input->post('delivery_note_date',TRUE))?$this->input->post('delivery_note_date',TRUE):date('Y-m-d'));
            $taxdata['relation_id'] = $delivery_note_id;
            if($tax_v > 0){
            $this->db->insert('tax_collection',$taxdata);
              }


        //Data inserting into delivery_note table
        $datainv = array(
            'delivery_note_id'      => $delivery_note_id,
            'customer_id'     => $customer_id,
            'date'            => (!empty($this->input->post('delivery_note_date',TRUE))?$this->input->post('delivery_note_date',TRUE):date('Y-m-d')),
            'total_amount'    => $this->input->post('grand_total_price',TRUE),
            'total_tax'       => $this->input->post('total_tax',TRUE),
            'delivery_note'         => $this->input->post('delivery_note_no',TRUE),
            'delivery_note_details' => (!empty($this->input->post('inva_details',TRUE))?$this->input->post('inva_details',TRUE):'Thank you for shopping with us'),
            'delivery_note_discount'=> $this->input->post('delivery_note_discount',TRUE),
            'total_discount'  => $this->input->post('total_discount',TRUE),
            'delivery_note_discount'  => 0,
            'paid_amount'     => $this->input->post('paid_amount',TRUE),
            'due_amount'      => $this->input->post('due_amount',TRUE),
            'prevous_due'     => $this->input->post('previous',TRUE),
            'shipping_cost'   => (!empty($this->input->post('shipping_cost',TRUE))?$this->input->post('shipping_cost',TRUE):null),
            'sales_by'        => $this->session->userdata('id'),
            'status'          => 1,
            'payment_type'    =>  $this->input->post('paytype',TRUE),
            'invoicetype'     => $this->input->post('invoicetype',TRUE),
            'bank_id'         =>  (!empty($this->input->post('bank_id',TRUE))?$this->input->post('bank_id',TRUE):null),
        );
   
      $this->db->insert('delivery_note', $datainv);
//  $string =   $this->db->last_query();
//  print_r($string);
// die();
        $prinfo  = $this->db->select('product_id,Avg(rate) as product_rate')->from('product_purchase_details')->where_in('product_id',$product_id)->group_by('product_id')->get()->result(); 
    $purchase_ave = [];
    $i=0;
    foreach ($prinfo as $avg) {
      $purchase_ave [] =  $avg->product_rate*$quantity[$i];
      $i++;
    }
    $sumval   = array_sum($purchase_ave);
    $cusifo   = $this->db->select('*')->from('customer_information')->where('customer_id',$customer_id)->get()->row();
    $headn    = $customer_id.'-'.$cusifo->customer_name;
    $coainfo  = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
    $customer_headcode = $coainfo->HeadCode;

     




  $total_saleamnt = $this->input->post('n_total',TRUE)-(!empty($this->input->post('previous',TRUE))?$this->input->post('previous',TRUE):0);
  $withoutinventory = $total_saleamnt - $sumval;
  $income = $withoutinventory - $this->input->post('total_tax',TRUE);



     $customerinfo = $this->db->select('*')->from('customer_information')->where('customer_id',$customer_id)->get()->row();

        $rate                = $this->input->post('product_rate',TRUE);
        $p_id                = $this->input->post('product_id',TRUE);
        $total_amount        = $this->input->post('total_price',TRUE);
        $discount_rate       = $this->input->post('discount_amount',TRUE);
        $discount_per        = $this->input->post('discount',TRUE);
        $tax_amount          = $this->input->post('tax',TRUE);
        $delivery_note_description = $this->input->post('desc',TRUE);
        $serial_n            = $this->input->post('serial_no',TRUE);
        $sales_unit = $this->input->post('sales_unit',TRUE);
        $item_pcs = $this->input->post('item_pcs',TRUE);
        $unit = $this->input->post('unit',TRUE);
        $Cartons = $this->input->post('Cartons',TRUE);
        $pcs = $this->input->post('pcs',TRUE);
        $tot_ctn = $this->input->post('tot_ctn',TRUE);

        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate     = $rate[$i];
            $product_id       = $p_id[$i];
            $serial_no        = (!empty($serial_n[$i])?$serial_n[$i]:null);
            $total_price      = $total_amount[$i];
            $supplier_rate    = $this->supplier_price($product_id);
            $disper           = $discount_per[$i];
            $discount         = is_numeric($product_quantity) * is_numeric($product_rate) * is_numeric($disper) / 100;
            $tax              = $tax_amount[$i];
            $description      = (!empty($delivery_note_description)?$delivery_note_description[$i]:null);
            $sales_unit       = $sales_unit[$i];
            $item_pcs         = $item_pcs[$i];
            $unit             = $unit[$i];
            $Cartons          = $Cartons[$i];
            $pcs              = $pcs[$i];
            $tot_ctn          = $tot_ctn[$i];
            $data1 = array(
                'delivery_note_details_id' => $this->generator(15),
                'delivery_note_id'         => $delivery_note_id,
                'product_id'         => $product_id,
                'serial_no'          => $serial_no,
                'sales_unit'        => $sales_unit,
                'item_pcs'          => $item_pcs,
                'unit'              => $unit,
                'Cartons'           => $Cartons,
                'pcs'               => $pcs,
                'tot_ctn'           => $tot_ctn,
                'quantity'           => $product_quantity,
                'rate'               => $product_rate,
                'discount'           => $discount,
                'description'        => $description,
                'discount_per'       => $disper,
                'tax'                => $tax,
                'paid_amount'        => $paidamount,
                'due_amount'         => $this->input->post('due_amount',TRUE),
                'supplier_rate'      => $supplier_rate,
                'total_price'        => $total_price,
                'status'             => 1
            );
            if (!empty($quantity)) {
                $this->db->insert('delivery_note_details', $data1);
            }
        }
        $message = 'Mr.'.$customerinfo->customer_name.',
        '.'You have purchase  '.$this->input->post('grand_total_price',TRUE).' '. $currency_details[0]['currency'].' You have paid .'.$this->input->post('paid_amount',TRUE).' '. $currency_details[0]['currency'];
       

   $config_data = $this->db->select('*')->from('sms_settings')->get()->row();
        if($config_data->isdelivery_note == 1){
          $this->smsgateway->send([
            'apiProvider' => 'nexmo',
            'username'    => $config_data->api_key,
            'password'    => $config_data->api_secret,
            'from'        => $config_data->from,
            'to'          => $customerinfo->customer_mobile,
            'message'     => $message
        ]);
      }
    
        return $delivery_note_id;
    }


        public function update_delivery_note() {
        $tablecolumn = $this->db->list_fields('tax_collection');
        $num_column  = count($tablecolumn)-4;
        $delivery_note_id  = $this->input->post('delivery_note_id',TRUE);
        $delivery_note_no  = $this->input->post('delivery_note',TRUE);
        $createby    = $this->session->userdata('id');
        $createdate  = date('Y-m-d H:i:s');
        $customer_id = $this->input->post('customer_id',TRUE);
        $quantity    = $this->input->post('product_quantity',TRUE);
        $product_id  = $this->input->post('product_id',TRUE);

       $changeamount = $this->input->post('change',TRUE);
        if($changeamount > 0){
        $paidamount = $this->input->post('n_total',TRUE);

        }else{
        $paidamount = $this->input->post('paid_amount',TRUE);
        }


   $bank_id = $this->input->post('bank_id',TRUE);
        if(!empty($bank_id)){
       $bankname = $this->db->select('bank_name')->from('bank_add')->where('bank_id',$bank_id)->get()->row()->bank_name;
    
       $bankcoaid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$bankname)->get()->row()->HeadCode;
   }else{
    $bankcoaid='';
   }
   
             $transection_id =$this->generator(8);


            $this->db->where('VNo', $delivery_note_id);
            $this->db->delete('acc_transaction');
            $this->db->where('relation_id', $delivery_note_id);
            $this->db->delete('tax_collection');
      
        $data = array(
            'delivery_note_id'      => $delivery_note_id,
            'customer_id'     => $this->input->post('customer_id',TRUE),
            'date'            => $this->input->post('delivery_note_date',TRUE),
            'total_amount'    => $this->input->post('grand_total_price',TRUE),
            'total_tax'       => $this->input->post('total_tax',TRUE),
            'delivery_note_details' => $this->input->post('inva_details',TRUE),
            'due_amount'      => $this->input->post('due_amount',TRUE),
            'paid_amount'     => $this->input->post('paid_amount',TRUE),
            'delivery_note_discount'=> $this->input->post('delivery_note_discount',TRUE),
            'total_discount'  => $this->input->post('total_discount',TRUE),
            'prevous_due'     => $this->input->post('previous',TRUE),
            'shipping_cost'   => $this->input->post('shipping_cost',TRUE),
            'payment_type'    =>  $this->input->post('paytype',TRUE),
            'invoicetype'     => $this->input->post('invoicetype',TRUE),
            'bank_id'         =>  (!empty($this->input->post('bank_id',TRUE))?$this->input->post('bank_id',TRUE):null),
        );
      

     
        $prinfo  = $this->db->select('product_id,Avg(rate) as product_rate')->from('product_purchase_details')->where_in('product_id',$product_id)->group_by('product_id')->get()->result(); 
    $purchase_ave = [];
    $i=0;
    foreach ($prinfo as $avg) {
      $purchase_ave [] =  $avg->product_rate*$quantity[$i];
      $i++;
    }
   $sumval = array_sum($purchase_ave);

   $cusifo = $this->db->select('*')->from('customer_information')->where('customer_id',$customer_id)->get()->row();
    $headn = $customer_id.'-'.$cusifo->customer_name;
    $coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
    $customer_headcode = $coainfo->HeadCode;



       ///Customer credit for Paid Amount
       $customer_credit = array(
      'VNo'            =>  $delivery_note_id,
      'Vtype'          =>  'INV',
      'VDate'          =>  $createdate,
      'COAID'          =>  $customer_headcode,
      'Narration'      =>  'Customer credit for Paid Amount For Invoice No -'.$delivery_note_no.' Customer '.$cusifo->customer_name,
      'Debit'          =>  0,
      'Credit'         =>  $paidamount,
      'IsPosted'       => 1,
      'CreateBy'       => $createby,
      'CreateDate'     => $createdate,
      'IsAppove'       => 1
    ); 

if ($delivery_note_id != '') {
            $this->db->where('delivery_note_id', $delivery_note_id);
            $this->db->update('delivery_note', $data);
        }


     

         for($j=0;$j<$num_column;$j++){
                $taxfield = 'tax'.$j;
                $taxvalue = 'total_tax'.$j;
              $taxdata[$taxfield]=$this->input->post($taxvalue);
            }
            $taxdata['customer_id'] = $customer_id;
            $taxdata['date']        = (!empty($this->input->post('delivery_note_date',TRUE))?$this->input->post('delivery_note_date',TRUE):date('Y-m-d'));
            $taxdata['relation_id'] = $delivery_note_id;
            $this->db->insert('tax_collection',$taxdata);

        // Inserting for Accounts adjustment.
        ############ default table :: customer_payment :: inflow_92mizdldrv #################

        $delivery_note_d_id  = $this->input->post('delivery_note_details_id',TRUE);
        $sales_unit = $this->input->post('sales_unit',TRUE);
        $item_pcs = $this->input->post('item_pcs',TRUE);
        $unit = $this->input->post('unit',TRUE);
        $Cartons = $this->input->post('Cartons',TRUE);
        $pcs = $this->input->post('pcs',TRUE);
        $tot_ctn = $this->input->post('tot_ctn',TRUE);
        $quantity      = $this->input->post('product_quantity',TRUE);
        $rate          = $this->input->post('product_rate',TRUE);
        $p_id          = $this->input->post('product_id',TRUE);
        $total_amount  = $this->input->post('total_price',TRUE);
        $discount_rate = $this->input->post('discount_amount',TRUE);
        $discount_per  = $this->input->post('discount',TRUE);
        $delivery_note_description = $this->input->post('desc',TRUE);
        $this->db->where('delivery_note_id', $delivery_note_id);
        $this->db->delete('delivery_note_details');
        $serial_n       = $this->input->post('serial_no',TRUE);
        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate     = $rate[$i];
            $product_id       = $p_id[$i];
            $serial_no        = (!empty($serial_n[$i])?$serial_n[$i]:null);
            $sales_unit       = $sales_unit[$i];
            $item_pcs         = $item_pcs[$i];
            $unit             = $unit[$i];
            $Cartons          = $Cartons[$i];
            $pcs              = $pcs[$i];
            $tot_ctn          = $tot_ctn[$i];
            $total_price      = $total_amount[$i];
            $supplier_rate    = $this->supplier_price($product_id);
            $discount         = $discount_rate[$i];
            $dis_per          = $discount_per[$i];
           $desciption        = $delivery_note_description[$i];
            if (!empty($tax_amount[$i])) {
                $tax = $tax_amount[$i];
            } else {
                $tax = $this->input->post('tax');
            }


            $data1 = array(
                'delivery_note_details_id' => $this->generator(15),
                'delivery_note_id'         => $delivery_note_id,
                'product_id'         => $product_id,
                'serial_no'          => $serial_no,
                'quantity'           => $product_quantity,
                'sales_unit'        => $sales_unit,
                'item_pcs'          => $item_pcs,
                'unit'              => $unit,
                'Cartons'           => $Cartons,
                'pcs'               => $pcs,
                'tot_ctn'           => $tot_ctn,
                'rate'               => $product_rate,
                'discount'           => $discount,
                'total_price'        => $total_price,
                'discount_per'       => $dis_per,
                'tax'                => $this->input->post('total_tax',TRUE),
                'paid_amount'        => $paidamount,
                 'supplier_rate'     => $supplier_rate,
                'due_amount'         => $this->input->post('due_amount',TRUE),
                 'description'       => $desciption,
            );
            $this->db->insert('delivery_note_details', $data1);



           

            $customer_id = $this->input->post('customer_id',TRUE);
          
        }

        return $delivery_note_id;
    }


    //POS delivery_note entry
    public function pos_delivery_note_setup($product_id) {
        $product_information = $this->db->select('*')
                ->from('product_information')
                ->join('supplier_product', 'product_information.product_id = supplier_product.product_id')
                ->where('product_information.product_id', $product_id)
                ->get()
                ->row();

        if ($product_information != null) {

            $this->db->select('SUM(a.quantity) as total_purchase');
            $this->db->from('product_purchase_details a');
            $this->db->where('a.product_id', $product_id);
            $total_purchase = $this->db->get()->row();

            $this->db->select('SUM(b.quantity) as total_sale');
            $this->db->from('delivery_note_details b');
            $this->db->where('b.product_id', $product_id);
            $total_sale = $this->db->get()->row();

            $available_quantity = ($total_purchase->total_purchase - $total_sale->total_sale);
          
          $data2 = (object) array(
                        'total_product'  => $available_quantity,
                        'supplier_price' => $product_information->supplier_price,
                        'price'          => $product_information->price,
                        'supplier_id'    => $product_information->supplier_id,
                        'product_id'     => $product_information->product_id,
                        'product_name'   => $product_information->product_name,
                        'product_model'  => $product_information->product_model,
                        'unit'           => $product_information->unit,
                        'tax'            => $product_information->tax,
                        'image'          => $product_information->image,
                        'serial_no'      => $product_information->serial_no,
            );

        

            return $data2;
        } else {
            return false;
        }
    }



 public function searchprod($cid)
    { 
        $this->db->select('*');
        $this->db->from('product_information');
        if($cid !='all'){
        $this->db->where('category_id',$cid);
      }
        $this->db->order_by('product_name','asc');
        $query   = $this->db->get();
        $itemlist=$query->result();
        if($cid = ''){
          return false;
        }else{
           return $itemlist;
        }
       
    }
 public function searchprod_byname($pname= null)
    { 
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->like('product_name',$pname);
        $this->db->order_by('product_name','asc');
        $this->db->limit(20);
        $query = $this->db->get();
        $itemlist=$query->result();
        return $itemlist;
    }


    public function walking_customer(){
       return $data = $this->db->select('*')->from('customer_information')->like('customer_name','walking','after')->get()->result_array();
    }

        public function category_dropdown()
    {
        $data = $this->db->select("*")
            ->from('product_category')
            ->get()
            ->result();

        $list = array('' => 'select_category');
        if (!empty($data)) {
            foreach($data as $value)
                $list[$value->category_id] = $value->category_name;
            return $list;
        } else {
            return false; 
        }
    }

     public function category_list() {
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->where('status',1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

      //Retrieve company Edit Data
    public function retrieve_company() {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

       public function retrieve_setting_editdata() {
        $this->db->select('*');
        $this->db->from('web_setting');
        $this->db->where('setting_id', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
        //Get Supplier rate of a product
    public function supplier_rate($product_id) {
        $this->db->select('supplier_price');
        $this->db->from('supplier_product');
        $this->db->where(array('product_id' => $product_id));
        $query = $this->db->get();
        return $query->result_array();

        $this->db->select('Avg(rate) as supplier_price');
        $this->db->from('product_purchase_details');
        $this->db->where(array('product_id' => $product_id));
        $query = $this->db->get()->row();
        return $query->result_array();
    }

     public function supplier_price($product_id) {
        $this->db->select('supplier_price');
        $this->db->from('supplier_product');
        $this->db->where(array('product_id' => $product_id));
        $supplier_product = $this->db->get()->row();
   

        $this->db->select('Avg(rate) as supplier_price');
        $this->db->from('product_purchase_details');
        $this->db->where(array('product_id' => $product_id));
        $purchasedetails = $this->db->get()->row();
      $price = (!empty($purchasedetails->supplier_price)?$purchasedetails->supplier_price:$supplier_product->supplier_price);
 
        return (!empty($price)?$price:0);
    }


        public function autocompletproductdata($product_name){
            $query=$this->db->select('*')
                ->from('product_information')
                ->like('product_name', $product_name, 'both')
                ->or_like('product_model', $product_name, 'both')
                ->order_by('product_name','asc')
                ->limit(15)
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }


        public function retrieve_delivery_note_html_data($delivery_note_id) {
        $this->db->select('a.total_tax,
                        a.*,
                        b.*,
                        c.*,
                        d.product_id,
                        d.product_name,
                        d.product_details,
                        d.unit,
                        d.product_model,
                        a.paid_amount as paid_amount,
                        a.due_amount as due_amount'
                    );
        $this->db->from('delivery_note a');
        $this->db->join('delivery_note_details c', 'c.delivery_note_id = a.delivery_note_id');
        $this->db->join('customer_information b', 'b.customer_id = a.customer_id');
        $this->db->join('product_information d', 'd.product_id = c.product_id');
        $this->db->where('a.delivery_note_id', $delivery_note_id);
        $this->db->where('c.quantity >', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

     public function user_delivery_note_data($user_id){
   return  $this->db->select('*')->from('users')->where('user_id',$user_id)->get()->row();
 }

   // product information retrieve by product id
    public function get_total_product_invoic($product_id) {
        $this->db->select('SUM(a.quantity) as total_purchase');
        $this->db->from('product_purchase_details a');
        $this->db->where('a.product_id', $product_id);
        $total_purchase = $this->db->get()->row();

        $this->db->select('SUM(b.quantity) as total_sale');
        $this->db->from('delivery_note_details b');
        $this->db->where('b.product_id', $product_id);
        $total_sale = $this->db->get()->row();

        $this->db->select('a.*,b.*');
        $this->db->from('product_information a');
        $this->db->join('supplier_product b', 'a.product_id=b.product_id');
        $this->db->where(array('a.product_id' => $product_id, 'a.status' => 1));
        $product_information = $this->db->get()->row();

        $available_quantity = ($total_purchase->total_purchase - $total_sale->total_sale);
        $tablecolumn = $this->db->list_fields('tax_collection');
               $num_column = count($tablecolumn)-4;
  $taxfield='';
  $taxvar = [];
   for($i=0;$i<$num_column;$i++){
    $taxfield = 'tax'.$i;
    $data2[$taxfield] = (!empty($product_information->$taxfield)?$product_information->$taxfield:0);
    $taxvar[$i]       = (!empty($product_information->$taxfield)?$product_information->$taxfield:0);
    $data2['taxdta']  = $taxvar;
   }

    $content =explode(',', $product_information->serial_no);

        $html = "";
        if (empty($content)) {
            $html .="No Serial Found !";
        }else{
            // Select option created for product
            $html .="<select name=\"serial_no[]\"   class=\"serial_no_1 form-control\" id=\"serial_no_1\">";
                $html .= "<option value=''>".display('select_one')."</option>";
                foreach ($content as $serial) {
                    $html .="<option value=".$serial.">".$serial."</option>";
                }   
            $html .="</select>";
        }

       
            $data2['total_product']  = $available_quantity;
            $data2['supplier_price'] = $product_information->supplier_price;
            $data2['price']          = $product_information->price;
            $data2['supplier_id']    = $product_information->supplier_id;
            $data2['unit']           = $product_information->unit;
            $data2['sales_unit']     = $product_information->salesunit;
            $data2['pcsperboxid']    = $product_information->pcsperboxid;
            $data2['tax']            = $product_information->tax;
            $data2['serial']         = $html;
            $data2['txnmber']        = $num_column;
        

        return $data2;
    }

        public function generator($lenth) {
        $number = array("1", "2", "3", "4", "5", "6", "7", "8", "9");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 8);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }


       public function stock_qty_check($product_id){
        $this->db->select('SUM(a.quantity) as total_purchase');
        $this->db->from('product_purchase_details a');
        $this->db->where('a.product_id', $product_id);
        $total_purchase = $this->db->get()->row();

        $this->db->select('SUM(b.quantity) as total_sale');
        $this->db->from('delivery_note_details b');
        $this->db->where('b.product_id', $product_id);
        $total_sale = $this->db->get()->row();

        $this->db->select('a.*,b.*');
        $this->db->from('product_information a');
        $this->db->join('supplier_product b', 'a.product_id=b.product_id');
        $this->db->where(array('a.product_id' => $product_id, 'a.status' => 1));
        $product_information = $this->db->get()->row();

        $available_quantity = ($total_purchase->total_purchase - $total_sale->total_sale);
        return (!empty($available_quantity)?$available_quantity:0);

    }


    public function bdtask_delivery_note_pos_print_direct($delivery_note_id = null){
        $delivery_note_detail = $this->retrieve_delivery_note_html_data($delivery_note_id);
        $taxfield = $this->db->select('*')
                ->from('tax_settings')
                ->where('is_show',1)
                ->get()
                ->result_array();
        $txregname ='';
        foreach($taxfield as $txrgname){
        $regname = $txrgname['tax_name'].' Reg No  - '.$txrgname['reg_no'].', ';
        $txregname .= $regname;
        }  
        $subTotal_quantity = 0;
        $subTotal_cartoon = 0;
        $subTotal_discount = 0;
        $subTotal_ammount = 0;
        $descript = 0;
        $isserial = 0;
        $is_discount = 0;
        $isunit = 0;
        if (!empty($delivery_note_detail)) {
            foreach ($delivery_note_detail as $k => $v) {
                $delivery_note_detail[$k]['final_date'] = $this->occational->dateConvert($delivery_note_detail[$k]['date']);
                $subTotal_quantity = $subTotal_quantity + $delivery_note_detail[$k]['quantity'];
                $subTotal_ammount = $subTotal_ammount + $delivery_note_detail[$k]['total_price'];
            }

            $i = 0;
            foreach ($delivery_note_detail as $k => $v) {
                $i++;
                $delivery_note_detail[$k]['sl'] = $i;
                 if(!empty($delivery_note_detail[$k]['description'])){
                    $descript = $descript+1;
                    
                }
                 if(!empty($delivery_note_detail[$k]['serial_no'])){
                    $isserial = $isserial+1;
                    
                }
                 if(!empty($delivery_note_detail[$k]['unit'])){
                    $isunit = $isunit+1;
                    
                }
                    if(!empty($delivery_note_detail[$k]['discount_per'])){
                    $is_discount = $is_discount+1;
                    
                }
            }
        }

        
        $totalbal = $delivery_note_detail[0]['total_amount']+$delivery_note_detail[0]['prevous_due'];
        $user_id  = $delivery_note_detail[0]['sales_by'];
        $currency_details = $this->retrieve_setting_editdata();
        $users    = $this->user_delivery_note_data($user_id);
        $data = array(
        'title'                => display('pos_print'),
        'delivery_note_id'           => $delivery_note_detail[0]['delivery_note_id'],
        'delivery_note_no'           => $delivery_note_detail[0]['delivery_note'],
        'customer_name'        => $delivery_note_detail[0]['customer_name'],
        'invoicetype'        => $delivery_note_detail[0]['invoicetype'],
        'customer_address'     => $delivery_note_detail[0]['customer_address'],
        'customer_mobile'      => $delivery_note_detail[0]['customer_mobile'],
        'customer_email'       => $delivery_note_detail[0]['customer_email'],
        'final_date'           => $delivery_note_detail[0]['final_date'],
        'delivery_note_details'      => $delivery_note_detail[0]['delivery_note_details'],
        'total_amount'         => number_format($totalbal, 2, '.', ','),
        'subTotal_cartoon'     => $subTotal_cartoon,
        'subTotal_quantity'    => $subTotal_quantity,
        'delivery_note_discount'     => number_format($delivery_note_detail[0]['delivery_note_discount'], 2, '.', ','),
        'total_discount'       => number_format($delivery_note_detail[0]['total_discount'], 2, '.', ','),
        'total_tax'            => number_format($delivery_note_detail[0]['total_tax'], 2, '.', ','),
        'subTotal_ammount'     => number_format($subTotal_ammount, 2, '.', ','),
        'paid_amount'          => number_format($delivery_note_detail[0]['paid_amount'], 2, '.', ','),
        'due_amount'           => number_format($delivery_note_detail[0]['due_amount'], 2, '.', ','),
        'shipping_cost'        => number_format($delivery_note_detail[0]['shipping_cost'], 2, '.', ','),
        'delivery_note_all_data'     => $delivery_note_detail,
        'previous'             => number_format($delivery_note_detail[0]['prevous_due'], 2, '.', ','),
         'is_discount'         => $is_discount,
        'users_name'           => $users->first_name.' '.$users->last_name,
        'tax_regno'            => $txregname,
        'is_desc'              => $descript,
        'is_serial'            => $isserial,
        'is_unit'              => $isunit,
        'company_info'         => $this->retrieve_company(),
        'currency'             => $currency_details[0]['currency'],
        'position'             => $currency_details[0]['currency_position'],
        'discount_type'        => $currency_details[0]['discount_type'],
        'logo'                 => $currency_details[0]['delivery_note_logo'],

        );

       return $data;

    }


       public function product_list() {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('status',1);
        $this->db->limit(30);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function bdtask_print_settingdata(){
        $this->db->select('*');
        $this->db->from('print_setting');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
}

