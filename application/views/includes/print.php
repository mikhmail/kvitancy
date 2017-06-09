<!DOCTYPE html> 
<html>
<head>
  <title><?=$this->uri->segment(2);?>_<?=$this->uri->segment(3);?></title>
  <meta charset="utf-8">
  <script src="<?php echo base_url(); ?>assets/jquery-1.7.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/jquery.calculation.js"></script>
</head>
<body>
<?php $this->load->view($main_content); ?>