<?php 
      
  $info['modalEdit']= $this->Utility->Editmodal($clubExceptions);
      

  $info['loadException']='<div class="row-fluid">
          <div class="span8">
          <div id="modal">'.$this->Utility->exceptionLoad($clubExceptions).
          '</div></div></div>';

  echo json_encode($info);
?>