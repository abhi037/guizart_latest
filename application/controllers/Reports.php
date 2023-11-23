<?php
  
  /*
    * To change this license header, choose License Headers in Project Properties.
    * To change this template file, choose Tools | Templates
    * and open the template in the editor.
  */
  
  /**
    * @package Razorpay :  CodeIgniter Razorpay Gateway
    *
    * @author TechArise Team
    *
    * @email  info@techarise.com
    *   
    * Description of Razorpay Controller
  */
  if (!defined('BASEPATH'))
    exit('No direct script access allowed');
  
  class Reports extends CI_Controller {
    // construct
    public function __construct() {
      parent::__construct();   
      $this->load->database();
      $this->load->helper('download');
      $this->load->library('session');
      $this->load->library("excel"); 
      /*cache control*/ 
      if ($this->session->userdata('admin_login') != true) {
        if($this->session->userdata('role_id') > 3) {
          $isaaceable=$this->user_model->GetAccess($this->input->server('REDIRECT_QUERY_STRING'), $this->session->userdata('role_id'));
          if($isaaceable->num_rows() <=0) {
            redirect(site_url('login'), 'refresh');
          } 
        } else {
          redirect(site_url('login'), 'refresh');
        } 
      }
    }
    
    public function down()
    {
      header("Content-Disposition: attachment; filename=http://quizart.co.in/uploads/fileName.xls");
      exit();
    }

    public   function action()
    {  
      $this->load->model("crud_model");
      $data = $this->crud_model->tophundred();
      //  print_r($data);
      //  exit();
      $object = new PHPExcel();
      
      $object->setActiveSheetIndex(0);
      
      $table_columns = array("category_name","first_name","last_name", "email", "marks_obt","total_marks","date");
      
      $column = 0;
      
      foreach($table_columns as $field)
      {
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
        $column++;
      }
      
      //$employee_data = $this->excel_export_model->fetch_data();
      
      $excel_row = 2;
      
      foreach($data as $row)
      {
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row["category_name"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row["first_name"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row["last_name"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row["email"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row["marks_obt"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row["total_marks"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row["date"]);
        $excel_row++;
      }
       
      $this_date = date("Y-m-d h:i:s");
      
      $filename='Top_hundred_students-'.$this_date.'.xls'; //save our workbook as this file name
      header('Content-Type: application/vnd.ms-excel; charset=UTF-8'); //mime type
      header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
      header('Cache-Control: max-age=0'); //no cache
      $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      //readfile($objWriter);
      //ob_end_clean();
      $objWriter->save('php://output');
      exit();
    }
    
    public   function consistentaction()
    {  
      $this->load->model("crud_model");
      $data = $this->crud_model->tophundredconsistent();
      //print_r($data);
      //exit();
      $object = new PHPExcel();
      
      $object->setActiveSheetIndex(0);
      
      $table_columns = array("student_id","first_name","last_name", "email", "marks_obt","total_marks");
      
      $column = 0;
      
      foreach($table_columns as $field)
      {
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
        $column++;
      }
      
      //$employee_data = $this->excel_export_model->fetch_data();
      
      $excel_row = 2;
      
      foreach($data as $row)
      {
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row["student_id"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row["first_name"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row["last_name"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row["email"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row["marks_obt"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row["total_marks"]);
        $excel_row++;
      }
      
      $this_date = date("Y-m-d h:i:s");
      
      $filename='Consistent_hundred_students-'.$this_date.'.xls'; //save our workbook as this file name
      header('Content-Type: application/vnd.ms-excel; charset=UTF-8'); //mime type
      header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
      header('Cache-Control: max-age=0'); //no cache
      $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      //readfile($objWriter);
      //ob_end_clean();
      $objWriter->save('php://output');
      
      exit(); 
    }
    
    
    
    //Random hundred students excluding above two, Sub category wise
    
    public   function random()
    {
      
      $this->load->model("crud_model");
      
      $data = $this->crud_model->trandom();
      //  print_r($data);
      //  exit();
      $object = new PHPExcel();
      
      $object->setActiveSheetIndex(0);
      
      $table_columns = array("category_name","first_name","last_name", "email", "marks_obt","total_marks","date");
      
      $column = 0;
      
      foreach($table_columns as $field)
      {
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
        $column++;
      }
      
      //$employee_data = $this->excel_export_model->fetch_data();
      
      $excel_row = 2;
      
      foreach($data as $row)
      {
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row["category_name"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row["first_name"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row["last_name"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row["email"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row["marks_obt"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row["total_marks"]);
        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row["date"]);
        $excel_row++;
      }
      
      $this_date = date("Y-m-d h:i:s");
      
      $filename='Top_hundred_students-'.$this_date.'.xls'; //save our workbook as this file name
      header('Content-Type: application/vnd.ms-excel; charset=UTF-8'); //mime type
      header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
      header('Cache-Control: max-age=0'); //no cache
      $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      //readfile($objWriter);
      //ob_end_clean();
      $objWriter->save('php://output');
      
      exit();  
    }
    
  }
?>