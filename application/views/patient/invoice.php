<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title;?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="">
    <!-- Stylesheet -->
    <link rel="stylesheet" href=".css">
    <!-- Adding the html2pdf.js library -->
    <script src="p.js"></script>

    <style>
body{
    background-color: #fff;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    font-size: 16px;
}
.color{
    background-color: #F6F6F6;
}
h1,h2,h3,h4,h5,h6{
    margin: 0;
    padding: 0;
}
p{
    margin: 0;
    padding: 0;
}
.container{
    border: 1px solid rgb(106, 104, 104); 
    width: 98%;/*80%*/
    margin-right: auto;
    margin-left: auto;
}
.brand-section{
   /*background-color: #fff;*/
   padding: 30px 60px;
}
.logo{
    width: 50%;
}


.footer{
    float: center;
    text-align: center;
    margin-bottom: 20px;
}




.row{
    display: flex;
    flex-wrap: wrap;
    
}
.col-6{
    width: 50%;
    flex: 0 0 auto;
}
.col-3{
    width: 25%;
    flex: 0 0 auto;
}

.col-4{
    width: 25%;
    flex: 0 0 auto;
}

/*.col-3{
    width: 18%;
    flex: 0 0 auto;
}

.col-5{
    width: 20%;
    flex: 0 0 auto;
}*/

.text-red{
    color: #c4240a;
}
.text-black{
    color: #000000;
}
.text-white{
    color: #fff;
}
.company-details{
    float :left;
    text-align: center;
}
.body-section{
    padding: 00px 60px;
    /*border: 1px solid rgb(211, 45, 45);*/
    
}
.heading{
    font-size: 30px;
    margin-bottom: 08px;
}
.logo-name{
    font-size: 30px;
    margin-bottom: 02px;
    color: darkblue;
}
.sub-heading{
    color: #262626;
    margin-bottom: 05px;
}
table{
    background-color: #fff;
    width: 100%;
    border-collapse: collapse;
}
table thead tr{
    border: 1px solid #111;
    background-color: #f2f2f2;
}
table td {
    vertical-align: middle !important;
    text-align: center;
}
table th, table td {
    padding-top: 08px;
    padding-bottom: 08px;
}
.table-bordered{
    box-shadow: 0px 0px 5px 0.5px gray;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}
.text-right{
    text-align: end;
}
.w-20{
    width: 20%;
}
.float-right{
    float: right;
    margin-right: 7%;
}

#pic{
  background-image: url('data:image/png;base64,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');


    background-position: center;
    background-repeat: no-repeat; 
    background-size: cover;
    width: 180px;
    height: 140px;

    
}




*, *:before, *:after {
    box-sizing: border-box;
}

body {
    background: #F6F6F6;
    user-select: none;
}

#wrapper {
    position: relative;
}

.branch {
    position: relative;
    margin-left: 300px;
}
.branch:before {
    content: "";
    width: 40px;/*width: 50px;*/
    border-top: 2px solid black;
    position: absolute;
    left: -100px;
    top: 50%;
    margin-top: 1px;
}

.entry {
    position: relative;
    min-height: 55px;
}
.entry:before {
    content: "";
    height: 100%;
    border-left: 2px solid black;
    position: absolute;
    left: -60px;/*left: -50px;*/
}

.entry:after {
    content: "";
    width: 40px;/*50*/
    border-top: 2px solid black;
    position: absolute;
    left: -60px;
    top: 50%;
    margin-top: 1px;
}

.entry:first-child:before {
    width: 10px;
    height: 50%;
    top: 50%;
    margin-top: 2px;
    border-radius: 10px 0 0 0;
}

.entry:first-child:after {
    height: 10px;
    border-radius: 10px 0 0 0;
}

.entry:last-child:before {
    width: 10px;
    height: 50%;
    border-radius: 0 0 0 10px;
}

.entry:last-child:after {
    height: 10px;
    border-top: none;
    border-bottom: 2px solid black;
    border-radius: 0 0 0 10px;
    margin-top: -9px;
}

.entry.sole:before {
    display: none;
}

.entry.sole:after {
    width: 50px;
    height: 0;
    margin-top: 1px;
    border-radius: 0;
}

.label {
    display: block;
    min-width: 150px;
    /*padding: 5px 10px;*/
    line-height: 20px;
    text-align: center;
    /*border: 2px solid black;box border*/
    border-radius: 5px;
    position: absolute;
    left: 0x;
    top: 50%;
    margin-top: -15px;
}

hr {
    border: 1px solid black;
    width: 100px;
    margin-bottom: 1%;
    margin-left: 15%;
    
}

.top {
    height: 10px;
    width: 100px;
    background-color: #ff9933;
}

.middle {
    height: 10px;
    width: 100px;
    background-color: white
}

.bottom {
    height: 10px;
    width: 100px;
    background-color: green
}

.flag1{
    width: 49.99%;
    float: left;
}

.flag2{
    width: 49.99%;
    float: right;
}

.bg{
    background-image:url('img/My\ Alianza.png');
    background-size: 100px;
    background-repeat: no-repeat;
    padding: 50px;

}

.bg1{
    background-image:url('img/wchsa.png');
    background-size: 100px;
    background-repeat: no-repeat;
    padding: 50px;
    
}

.bg2{
    background-image:url('img/UKP.png ');
    background-size: 100px;
    background-repeat: no-repeat;
    padding: 50px;
}

h1{
    font-size: 40px;
}



@media screen and (max-width: 480px){
    .container h1{
        font-size: 15px;
        font-weight: bold;
    }
    .container h3{
        font-size: 12px;
        font-weight: bold;
    }
    .bg{
        background-image:url('img/My\ Alianza.png');
        background-size: 45px;
        background-repeat: no-repeat;
        padding: 30px;

    }
    .bg1{
        background-image:url('img/wchsa.png');
        background-size: 45px;
        background-repeat: no-repeat;
        padding: 30px;
        
    }
    .bg2{
        background-image:url('img/UKP.png ');
        background-size: 45px;
        background-repeat: no-repeat;
        padding: 30px;
    }
    .container img{
        width: 45px;
        height: 45px;
    }

    hr {
        border: 1px solid black;
        width: 80px;
        margin-left: 75.5%;
    }

    .top {
        height: 5px;
        width: 60px;
        background-color: #ff9933;
    }
    
    .middle {
        height: 5px;
        width: 60px;
        background-color: white
    }
    
    .bottom {
        height: 5px;
        width: 60px;
        background-color: green
    }
    
    .flag1{
        width: 24.99%;
        float: left;
    }
    
    .flag2{
        width: 24.99%;
        float: right;
    }
      
    
    .branch {
        position: relative;
        margin-left: 60px;
    }

    .branch:before {
        content: "";
        width: 50px;
        border-top: 2px solid black;
        position: absolute;
        left: -100px;
        top: 50%;
        margin-top: 1px;
    }
    
    .entry {
        position: relative;
        min-height: 28px;
    }
    .entry:before {
        content: "";
        height: 100%;
        border-left: 2px solid black;
        position: absolute;
        left: -50px;
    }
    
    .entry:after {
        content: "";
        width: 28px;
        border-top: 2px solid black;
        position: absolute;
        left: -50px;
        top: 50%;
        margin-top: 1px;
    }
    
    .entry:first-child:before {
        width: 10px;
        height: 50%;
        top: 50%;
        margin-top: 2px;
        border-radius: 7px 0 0 0;
    }
    
    .entry:first-child:after {
        height: 10px;
        border-radius: 7px 0 0 0;
    }
    
    .entry:last-child:before {
        width: 10px;
        height: 50%;
        border-radius: 0 0 0 7px;
    }
    
    .entry:last-child:after {
        height: 10px;
        border-top: none;
        border-bottom: 2px solid black;
        border-radius: 0 0 0 7px;
        margin-top: -9px;
    }
    
    .entry.sole:before {
        display: none;
    }
    
    .entry.sole:after {
        width: 50px;
        height: 0;
        margin-top: 1px;
        border-radius: 0;
    }
    
    .label {
        display: block;
        min-width: 150px;
        padding: 5px 10px;
        line-height: 10px;
        text-align: center;
        /*border: 2px solid black;box border*/
        border-radius: 2px;
        position: absolute;
        left: 0x;
        top: 50%;
        margin-top: -15px;
    }
}



/* CSS */
.button-24 {
    background: #42dcff;
    border: 1px solid #000000;
    border-radius: 6px;
    box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
    box-sizing: border-box;
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    font-family: nunito,roboto,proxima-nova,"proxima nova",sans-serif;
    font-size: 12px;
    font-weight: 800;
    line-height: 16px;
    min-height: 40px;
    outline: 0;
    padding: 12px 14px;
    text-align: center;
    text-rendering: geometricprecision;
    text-transform: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
  }
  
  .button-24:hover,
  .button-24:active {
    background-color: initial;
    background-position: 0 0;
    color: #4265ff;
  }
  
  .button-24:active {
    opacity: .5;
  }
    

    </style>
    
</head>
<body>
  <div class="elem">

    <div class="container color">
      <div class="brand-section color">
          <div class="row">
              <div class="col-6">
                <div class="company-details">
                  <p class="logo-name"><b> Dental Clinic</b></p>
                  <p class="text-black">Mumbai, India</p>
                  <p class="text-black">Tel: +919920864080</p>
                </div>
              </div>
              <div class="col-6" style=" padding-left: 25%;">
                  <a class="main-logo " href="https://www.sarvisolutions.com/"><div id="pic"></div></a>
              </div>
          </div>
      </div>



      <div class="body-section color"> 
          <h1 class="heading" style="text-align: center;"><?php echo $page_title;?></h1>
          <br>
          <div class="row">
              <div class="col-6">
                  <p class="sub-heading">Patient Name : <span>MR. <?php echo $pre_record[0]->user_first_name.' '.$pre_record[0]->user_last_name;?></span></p>
                  <p class="sub-heading">Patient ID :<span><?php echo $pre_record[0]->pre_patient_id;?></span></p>
                  <!-- <p class="sub-heading">Address :<span>  </span></p> -->
                  <p class="sub-heading">Phone :<span>+91<?php echo $pre_record[0]->user_phone_number;?></span></p>
              </div>
              <div class="col-6" style="text-align: end;">
                  <p class="sub-heading">Prescription No. :<span><?php echo date('Ymd',strtotime($pre_record[0]->pre_created_on)).$pre_record[0]->pre_id;?></span></p>
                  <p class="sub-heading">Date :<span><?php echo date("d-M-y h:i A",strtotime($pre_record[0]->pre_created_on));?></span></p>
                  <p class="sub-heading">Doctor :<span>MR./Mrs. : <?php echo $pre_record[0]->doctor_first_name.' '.$pre_record[0]->doctor_last_name;?></span></p>
                <!--<p class="sub-heading"><span></span></p>-->
              </div>
          </div>
      </div>

      <div class="body-section color">
          <h3 class="heading"></h3>
          <br>
          <table class="table-bordered">
              <thead>
                  <tr>
                      <th>#</th>
                      <th class="w-20">Medicine </th>
                      <th class="w-20">Power</th>
                      <th class="w-20">Timings</th>
                      <th class="w-20">Course</th>
                      <th class="w-20">Take Time</th>
                  </tr>
              </thead>
              <tbody>
                <?php 

                    if (isset($pre_record[0]->pre_details_in_detail)) {
                        $predetail_array=json_decode($pre_record[0]->pre_details_in_detail);
                        //print_r($predetail_array);
                        if($predetail_array)foreach ($predetail_array as $key1 => $value1) {
                            if (is_array($value1)) {

                                //echo $key1.', <br>';
                                if($key1=='pre_details'){
                                    $i=1;
                                    foreach ($value1 as $key2 => $value2) {
                                        ?>

                  <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $predetail_array->pre_details[$key2];?></td>
                      <td><?php echo $predetail_array->medicine_weight[$key2];?></td>
                      <td><?php echo $predetail_array->medicine_timings[$key2];?></td>
                      <td><?php echo $predetail_array->medicine_day_course[$key2];?></td>
                      <td><?php echo $predetail_array->medicine_tab_after_before[$key2];?></td>
                  </tr>
                  <?php
                                    //echo .' &nbsp;'.$predetail_array->medicine_timings[$key2].' &nbsp;'.$predetail_array->medicine_day_course[$key2].' &nbsp; <br>';
                                    $i++;
                                    }
                                }

                            }
                        }
                    }

                ?>

              </tbody>
          </table>
          <br>
      </div>

      <div class="body-section color"> 
        <div class="row">
            <?php 
                    if (isset($pre_record[0]->pre_lab_test)) { 
                        if ($pre_record[0]->pre_lab_test!="" && $pre_record[0]->pre_lab_test!="null") {
                            
                        ?>
            <div class="col-3">
                
                <p class="sub-heading">Lab Test : </p>
                    
                <p class="sub-heading">
                    <?php 

                        $pre_lab_test_array=json_decode($pre_record[0]->pre_lab_test);

                        if($pre_lab_test_array)foreach ($pre_lab_test_array as $key1 => $value1) {
                            echo $value1.', <br>';
                        }
                    
                    //echo $value->pre_advice;
                    ?>  
                </p>
            </div>
            <?php 
                    }
                }
             ?>
            <div class="col-3">
                <p class="sub-heading">Advice : </p>
                <p class="sub-heading"><?php echo $pre_record[0]->pre_advice;?></p>
            </div>
            <!-- <div class="col-6" style="text-align: end;">
                <p class="sub-heading">Sub Total :<span>&#8377; 100</span></p>
                <p class="sub-heading">Grand Total :<span>&#8377; 100</span></p>
                <p class="sub-heading">Amount Received :<span>&#8377; 0</span></p>
                <p class="sub-heading">Amount To Be Paid :<span>&#8377; 100</span></p>
            </div> -->
        </div>
    </div>

  </div>      

  </div>




        <!-- Adding a button to trigger the PDF download event -->
        <br>
        <br>
        <!-- <button class="download button-24">Download PDF</button>
        
        <script>
            let div = document.querySelector(".elem");
            let btn = document.querySelector(".download");
            btn.addEventListener('click', () => {
                html2pdf().from(div).save()
            })
        </script> -->

</body>
</html>




<!--<tr>
  <td colspan="5" class="text-right">Sub Total</td>
    <td> 10.5</td>
</tr>
<tr>
  <td colspan="5" class="text-right">Tax Total %1X</td>
    <td> 2</td>-
</tr>
<tr>
  <td colspan="5" class="text-right">Grand Total</td>
    <td> 12.5</td>
</tr>
<tr>
  <td colspan="4" class="text-right">Grand Total</td>
    <td> 12.5</td>
</tr>
<tr>
  <td colspan="3" class="text-right">Grand Total</td>
    <td> 12.5</td>
</tr>-->