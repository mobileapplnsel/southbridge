<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
   <!--font-->
   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">
   <!--font-->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/frontend/css/main.css'; ?>">

   <title><?php echo $page_title; ?></title>
</head>

<body>
   <section class="booking_header">
      <div class="container">
         <div class="row">
            <div class="col-md-4">
               <a href="https://rrkresort.com/"><img src="<?php echo base_url(); ?>common/images/logo.png" width="180">
               </a>
            </div>
            <div class="col-md-8">
               <ul class="header-list">
                  <li><a href="https://rrkresort.com/">Home</a></li>
                  <li><a href="tel:+91 9330727184" class="callbtn"><i class="fa fa-phone" aria-hidden="true"></i> +91 9330727184</a></li>
               </ul>
            </div>
         </div>
      </div>
   </section>
   <section class="booking_banner">
      <div class="single-slider owl-carousel">
         <div class="item">
            <img src="<?php echo base_url(); ?>common/images/banner-1.jpg" alt="images">
         </div>
         <div class="item">
            <img src="<?php echo base_url(); ?>common/images/banner-2.jpg" alt="images">
         </div>
         <div class="item">
            <img src="<?php echo base_url(); ?>common/images/banner-3.jpg" alt="images">
         </div>
      </div>
      <div class="booking_form">
         <form action="<?php echo base_url(); ?>check-availability" method="POST" enctype="">
            <ul>
               <li>
                  <label>Check In</label>
                  <input type="date" name="from_date" id="from_date" value="<?php echo $search_data['from_date'];?>">
               </li>
               <li>
                  <label>Check Out</label>
                  <input type="date" name="to_date" id="to_date" value="<?php echo $search_data['to_date'];?>">
               </li>
               <li>
                  <label>&nbsp;</label>
                  <input type="submit" name="submit" value="Check Availability" class="wpcf7-form-control has-spinner wpcf7-submit">
               </li>
            </ul>
         </form>
      </div>
   </section>
   <section class="fare-calendarpart">
      <div class="container">
         <div class="fare-calendarslide owl-carousel">

            <?php
            if (!empty($avl_data)) {
               foreach ($avl_data as $key => $value) {
                  if ($value['from_date'] >= DT && $value['to_date'] <= DT) {
            ?>
                     <div class="item">
                        <div class="calendar-day current_date">
                           <h3><?php echo $value['from_date']; ?></h3>
                           <p>From</p>
                           <p><i class="fa fa-inr"></i> <?php echo $value['discounted_rate']; ?><span></span></p>
                        </div>
                     </div>
                  <?php
                  } else {
                  ?>
                     <div class="item">
                        <div class="calendar-day">
                           <h3><?php echo $value['from_date']; ?></h3>
                           <p>From</p>
                           <p><i class="fa fa-inr"></i> <?php echo $value['discounted_rate']; ?><span></span></p>
                        </div>
                     </div>
                  <?php
                  }
                  ?>

            <?php
               }
            }
            ?>

         </div>
      </div>
   </section>
   <section class="room-part">
      <div class="container">
         <div class="row">
            <div class="col-md-9">

               <?php
               if (!empty($room_data)) 
               {
                  foreach ($room_data as $key => $value) 
                  {
                     $avl_data = (!empty($value['avl_data'])) ? $value['avl_data'] : [];
                     if ($value['avl_status'] == '1') 
                     {
                        $room_id = decode_url($value['rowid']);

                        $chkdata = array('mt_image_uploads.room_id'  => $room_id);
                        $getdata = $this->am->getImgUploads($chkdata, TRUE);

                        /*echo "<pre>";
                        print_r($getdata[0]['file_path']);die;*/
               ?>
                        <div class="room-box">
                           <div class="rm-images">
                              <img src="<?php echo $getdata[0]['file_path']; ?>" class="main-image img-fluid" alt="images">
                              <ul class="thumb-img">
                                 <?php  
                                    foreach ($getdata as $key => $val) 
                                    {
                                 ?>
                                       <li>
                                          <a href="javascript:volid(0)" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>">
                                             <img src="<?php echo $val['file_path']; ?>" class="img-fluid" alt="images">
                                          </a>
                                       </li>
                                 <?php
                                    }
                                 ?>
                                 <!-- <li><a href="javascript:volid(0)" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>"><img src="<?php echo base_url(); ?>common/images/room1.jpg" class="img-fluid" alt="images"></a></li>
                                 <li><a href="javascript:volid(0)" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>"><img src="<?php echo base_url(); ?>common/images/room1.jpg" class="img-fluid" alt="images"></a></li>
                                 <li><a href="javascript:volid(0)" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>"><img src="<?php echo base_url(); ?>common/images/room1.jpg" class="img-fluid" alt="images"></a></li> -->
                              </ul>
                           </div>
                           <div class="rm-info">
                              <div class="row">
                                 <div class="col-md-7">
                                    <h3><?php echo $value['name']; ?></h3>
                                    <p>Bed type: <?php echo ucfirst($value['bedtype']); ?></p>
                                    <p>Max Room capacity: <?php echo $value['roomcap']; ?></p>
                                    <p>Amenities: <?php echo $value['amenities']; ?></p>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="room-price">
                                       <span>
                                          <p class="save-price"><span>You Save</span> <i class="fa fa-inr"></i><?php echo (!empty($avl_data)) ? ($avl_data['actual_rate'] - $avl_data['discounted_rate']) : '0.00'; ?> <span class="tag"><?php echo (!empty($avl_data)) ? $avl_data['discount_percentage'] : '0.00'; ?> %</span></p>
                                          <p class="strike-price"><strike> <i class="fa fa-inr"></i> <?php echo (!empty($avl_data)) ? $avl_data['actual_rate'] : '0.00'; ?></strike></p>
                                       </span>
                                       <p class="main-price"><i class="fa fa-inr"></i> <?php echo (!empty($avl_data)) ? $avl_data['discounted_rate'] : '0.00'; ?></p>
                                       <p class="per-day-price">per room / night</p>
                                       <p class="per-day-price">Excluding GST</p>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="button-list">
                                       <span> <a href="javascript:volid(0)" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>" class="bl-btn rdmore">Read more</a></span>
                                       <span> <a href="#" class="bl-btn" style="background: #308b1f;">Available</a></span>
                                    </div>
                                 </div>
                              </div>
                              <!-- The Modal -->
                              <div class="modal theme_modal" id="myModal_<?php echo $key; ?>">
                                 <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                       <!-- Modal body -->
                                       <div class="modal-body">
                                          <div class="row">
                                             <div class="col-md-5">
                                                <div class="single-slider owl-carousel">
                                                   <?php  
                                                      foreach ($getdata as $key => $val) 
                                                      {
                                                   ?>
                                                         <div class="item">
                                                            <img src="<?php echo $val['file_path']; ?>" alt="images">
                                                         </div>
                                                   <?php
                                                      }
                                                   ?>      
                                                </div>
                                             </div>
                                             <div class="col-md-7">
                                                <h3><?php echo ucwords($value['name']); ?></h3>
                                                <p><?php echo ucwords($value['roomdesc']); ?></p>
                                                <p><strong>BED TYPE</strong></p>
                                                <p><?php echo ucwords($value['bedtype']); ?></p>
                                                <p><strong>ROOM VIEW TYPE</strong></p>
                                                <p><?php echo ucwords($value['viewtype']); ?></p>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- Modal footer -->
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="room-select">
                              <div class="rms-box rm-slcttitle">
                                 <?php echo ($value['withbfast'] == 'yes') ? '<h4>Room With Breakfast</h4>' : 'Room With Breakfast: No'; ?>
                              </div>
                              <div class="rms-box room-guest-details">
                                 <h4>Rooms|Guests</h4>
                                 <p>1 Room(s) <?php echo $value['totaladults']; ?> Adults, <?php echo $value['totalkids']; ?> Kids </p>
                                 <div class="select-box" id="addRooms">
                                    <!-- <div class="row">
                                       <div class="col-sm-12">
                                          <p>No. Of Rooms</p>
                                          <select>
                                             <option value="1">1</option>
                                             <option value="2">2</option>
                                             <option value="3">3</option>
                                             <option value="4">4</option>
                                             <option value="5">5</option>
                                             <option value="6">6</option>
                                          </select>
                                       </div>
                                    </div> -->
                                    <div class="multiple-room-wrap">
                                       <div class="row rminfo-box">
                                          <div class="col-sm-12">
                                             <p><span class="room-text">Room 1</span></p>
                                          </div>
                                          <div class="col-sm-6">
                                             <label class="label-room-booking">Adults</label>
                                             <select id="total_adults" name="total_adults">
                                                <?php
                                                   if($value['totaladults'] > 0)
                                                   {
                                                      for ($i=1; $i <= $value['totaladults'] ; $i++) 
                                                      { 
                                                ?>
                                                         <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                <?php
                                                      }
                                                   }   
                                                   else 
                                                   {
                                                ?>
                                                         <option value="0">0</option>
                                                <?php      
                                                   }   
                                                ?>
                                             </select>
                                          </div>
                                          <div class="col-sm-6">
                                             <label class="label-room-booking">Kids</label>
                                             <select id="total_kids" name="total_kids">
                                                <?php
                                                   if($value['totalkids'] > 0)
                                                   {  
                                                      for ($i=0; $i <= $value['totalkids'] ; $i++) 
                                                      { 
                                                ?>
                                                         <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                <?php
                                                      }
                                                   }
                                                   else 
                                                   {
                                                ?>
                                                         <option value="0">0</option>
                                                <?php      
                                                   }  
                                                ?>
                                             </select>
                                          </div>
                                          <!-- <div class="col-sm-4">
                                             <label class="label-room-booking">(0 < 5 yrs)</label>
                                                   <select name="">
                                                      <option value="0">0</option>
                                                   </select>
                                          </div> -->
                                          <!-- <span class="delete-position"><i class="fa fa-trash-o" aria-hidden="true"></i></span> -->
                                       </div>
                                       <div class="row">
                                          <div class="col-sm-12">
                                             <div class="button-list shrtbtn">
                                                <span> <a href="javascript:volid(0)" class="bl-btn cncbtn">Cancel</a></span>
                                                <span> <a href="javascript:void(0)" class="bl-btn ylbtn" onclick="roomConfermation(<?php echo $room_id;?>);">Confirm</a></span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="rms-box price-small">
                                 <i class="fa fa-inr"></i><?php echo (!empty($avl_data)) ? $avl_data['discounted_rate'] : '0.00'; ?>
                              </div>
                              <div class="rms-box button-list">
                                 <span> <a class="bl-btn ylbtn addrm-btn">Add Rooms</a></span>
                              </div>
                           </div>
                        </div>
                     <?php
                     } else {
                        // not available
                     ?>
                        <div class="room-box">
                           <div class="rm-images">
                              <img src="<?php echo base_url(); ?>common/images/room2.jpg" class="main-image img-fluid" alt="images">
                              <ul class="thumb-img">
                                 <li><a href="javascript:volid(0)" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>"><img src="<?php echo base_url(); ?>common/images/room2.jpg" class="img-fluid" alt="images"></a></li>
                                 <li><a href="javascript:volid(0)" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>"><img src="<?php echo base_url(); ?>common/images/room2.jpg" class="img-fluid" alt="images"></a></li>
                                 <li><a href="javascript:volid(0)" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>"><img src="<?php echo base_url(); ?>common/images/room2.jpg" class="img-fluid" alt="images"></a></li>
                              </ul>
                           </div>
                           <div class="rm-info">
                              <div class="row">
                                 <div class="col-md-7">
                                    <h3><?php echo $value['name']; ?></h3>
                                    <p>Bed type: <?php echo ucfirst($value['bedtype']); ?></p>
                                    <p>Max Room capacity: <?php echo $value['roomcap']; ?></p>
                                    <p>Amenities: <?php echo $value['amenities']; ?></p>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="room-price">
                                       <span>
                                          <p class="save-price"><span>You Save</span> <i class="fa fa-inr"></i><?php echo (!empty($avl_data)) ? ($avl_data['actual_rate'] - $avl_data['discounted_rate']) : '0.00'; ?> <span class="tag"><?php echo (!empty($avl_data)) ? $avl_data['discount_percentage'] : '0.00'; ?> %</span></p>
                                          <p class="strike-price"><strike> <i class="fa fa-inr"></i> <?php echo (!empty($avl_data)) ? $avl_data['actual_rate'] : '0.00'; ?></strike></p>
                                       </span>
                                       <p class="main-price"><i class="fa fa-inr"></i> <?php echo (!empty($avl_data)) ? $avl_data['discounted_rate'] : '0.00'; ?></p>
                                       <p class="per-day-price">per room / night</p>
                                       <p class="per-day-price">Excluding GST</p>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="button-list">
                                       <span> <a href="javascript:volid(0)" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>" class="bl-btn rdmore">Read more</a></span>
                                       <span> <a href="#" class="bl-btn nabtn">Not Available</a></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                         <!-- The Modal -->
                         <div class="modal theme_modal" id="myModal_<?php echo $key; ?>">
                                 <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                       <!-- Modal body -->
                                       <div class="modal-body">
                                          <div class="row">
                                             <div class="col-md-5">
                                                <div class="single-slider owl-carousel">
                                                   <div class="item">
                                                      <img src="<?php echo base_url(); ?>common/images/room2.jpg" alt="images">
                                                   </div>
                                                   <div class="item">
                                                      <img src="<?php echo base_url(); ?>common/images/room2.jpg" alt="images">
                                                   </div>
                                                   <div class="item">
                                                      <img src="<?php echo base_url(); ?>common/images/room2.jpg" alt="images">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-7">
                                                <h3>DELUXE ROOM</h3>
                                                <p><?php echo $value['roomdesc']; ?></p>
                                                <p><strong>BED TYPE</strong></p>
                                                <p><?php echo ucfirst($value['bedtype']); ?></p>
                                                <p><strong>ROOM VIEW TYPE</strong></p>
                                                <p><?php echo $value['viewtype']; ?></p>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- Modal footer -->
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
               <?php
                     }
                  }
               }
               ?>

            </div>


            <div class="col-md-3">
               <div class="sideadd-part">
                  <img src="<?php echo base_url(); ?>common/images/covid-add.jpg" alt="images" class="img-fluid">
               </div>
               <div class="booking-summary-box" id="booking_summary" style="display:none;">
                  <div class="day-list">
                     <div class="row">
                        <div class="col m4">
                           <p><span id="from_date_v"></span> <span>Check In</span></p>
                        </div>
                        <div class="col m4">
                              <span class="num-day-show flow-text" id="night_count"></span>
                        </div>
                        <div class="col m4">
                           <p><span id="to_date_v"></span> <span>Check Out</span></p>
                        </div>
                     </div>
                  </div>
                  <div class="room-summary-box">
                     <!-- <span class="roomBtnedit"><i class="fa fa-pencil" aria-hidden="true"></i></span> -->
                     <p id="room_name"></p>
                     <p><span>Rooms: 1, </span><span id="total_adults_new">Adults: 3, </span><span id="total_kids_new">kids: 0</span></p>
                     <!-- <p id="room_rent">Room Price: <i class="fa fa-inr"></i> 5,000</p> -->
                     <p id="room_rent">Room Price: <i class="fa fa-inr"></i> 5,000</p>
                  </div>
                  <h6>View Breakup</h6>
                  <div id="full-room-pay" class="full-room-pay">
                     <ul class="clearfix">
                        <li class="li_one">Total Amount</li>
                        <li id="total_amount" class="li_two"></li>
                     </ul>
                     <ul class="clearfix">
                        <li class="li_one">SGST (6%)</li>
                        <li id="sgst_amount" class="li_two"></li>
                     </ul>
                     <ul class="clearfix">
                        <li class="li_one">CGST (6%)</li>
                        <li id="cgst_amount" class="li_two"></li>
                     </ul>
                     <ul class="clearfix bold_one">
                        <li class="li_one">Exact Amount</li>
                        <li id="exact_amount" class="li_two"></li>
                     </ul>
                  </div>
                  <div class="pay-btn-wrap">
                     <button type="submit" class="cnt-btn clickbtn">Continue</button>
                  </div>
                  <div class="guest-details">
                     <p>Guest Details</p>
                     <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                           <!-- <a class="nav-link active" data-toggle="pill" href="#personal">Personal</a> -->
                           <a data-toggle="pill" href="#personal" class="nav-link active" onclick="showPersonal();">Personal</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="pill" href="#business" onclick="showBusiness();">Business</a>
                        </li>
                     </ul>
                     <div class="tab-content">
                        <div id="personal" class="tab-pane active">

                              <input type="hidden" id="room_id" value="Personal" name="room_id">
                              <input type="hidden" id="purpose" value="Personal" name="purpose">
                              <input type="text" id="personal_name" placeholder="Name" value="" >
                              <input type="email" id="personal_email" placeholder="Email Id" value="" >
                              <input type="text" id="personal_ph_no" placeholder="Mobile Number" max="10"  value="" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;">
                              <input type="text" id="company_name" placeholder="Company Name" style="display:none" value="">
                              <input type="text" id="company_gstin_no" placeholder="GSTIN" style="display:none" value="">
                              <textarea placeholder="Address" id="personal_address" ></textarea>
                              <input type="button" value="Continue" onclick ="personalSubmit();">
                        </div>
                        <!-- <div id="business" class="tab-pane fade">
                              <input type="hidden" id="purpose_two" value="Business" name="purpose_two">
                              <input type="text" id="company_owner_name" placeholder="Name" value="">
                              <input type="email" id="company_email" placeholder="Email Id" value="">
                              <input type="text" id="company_ph_no" placeholder="Mobile Number" value="" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;">
                              <input type="text" id="company_name" placeholder="Company Name" value="">
                              <input type="text" id="company_gstin_no" placeholder="GSTIN" value="">
                              <input type="submit" value="Continue" onsubmit ="businessSubmit()">
                        </div> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="rm-tabpart">
      <div class="container">
         <!-- Nav pills -->
         <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" data-toggle="pill" href="#about-hotel">About Hotel</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="pill" href="#policies">Policies</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="pill" href="#hotel-map">Hotel Map</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="pill" href="#addon-services">Addon Services</a>
            </li>
         </ul>
         <!-- Tab panes -->
         <div class="tab-content">
            <div id="about-hotel" class="tab-pane active">
               <div class="tab-banner">
                  <img src="<?php echo base_url(); ?>common/images/banner-3.jpg" alt="images" class="img-fluid">
               </div>
               <h3>RUPASI RUPNARAYAN KUTHI</h3>
               <p>Vill. Orphulli, P.o. Orphulli, P.S.-Bagnan,Howrah</p>
               <p><i class="fa fa-envelope" aria-hidden="true"></i> rohondas12@gmail.com / kolaghatrupasi@gmail.com </p>
               <p><i class="fa fa-phone" aria-hidden="true"></i> +91 9330465660 / +91 9330727184</p>
               <p><strong>Description</strong></p>
               <p>Rupasi Rupnarayan Kuthi in Bganan, sited on the bank of the river Rupnarayan, is a remarkable resort across the state. It is the majestic opportunity to step into a luxury resort that plays the role of host to a number of dignitaries and eminent personalities as well as the common people with better sensitivity. It is no exaggeration to say that it is next to the leader in hospitality.</p>
               <p>Rupasi Rupnarayan Kuthi in Bganan, sited on the bank of the river Rupnarayan, is a remarkable resort across the state. It is the majestic opportunity to step into a luxury resort that plays the role of host to a number of dignitaries and eminent personalities as well as the common people with better sensitivity. It is no exaggeration to say that it is next to the leader in hospitality. </p>
               <p>All the rooms and suites of Rupasi Runarayan Kuthi are a wonderful blend of elegance and modern facilities. It is strategically located in the Howrah district. As it is a flourishing art and heritage area, there are some must-visit places nearby.</p>
               <p><strong>Important Tourist Places</strong></p>
               <p>Khargeswar Temple</p>
               <p>Gopegarh Ecopark</p>
               <p>Jora Masjid</p>
               <p>Rasmancha Temple</p>
               <p>Sarat Chandra Chattopadhyay Kuthi</p>
               <p>Jhargram Raj Palace</p>
               <p><strong>Amenities</strong></p>
               <div class="row">
                  <div class="col-md-6">
                     <h6><strong><i class="fa fa-cutlery" aria-hidden="true"></i> F&B :</strong></h6>
                     <p>Welcome drink, Complimentary Breakfast, Food and beverage outlets, Halal food available, Restaurant</p>
                  </div>
                  <div class="col-md-6">
                     <h6><strong><i class="fa fa-futbol-o" aria-hidden="true"></i> Facility :</strong></h6>
                     <p>Terrace, Multilingulal staff, Swimming Pool, Smoke-free property, Lobby, Meeting rooms, Fire safety compliant, Non-smoking rooms, Wheelchair access, Pool, Parking, Outdoor pool, On-Site parking, Free parking, Gym, 24-hour security</p>
                  </div>
                  <div class="col-md-6">
                     <h6><strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Front office :</strong></h6>
                     <p>Contactless checkout, Contactless checkin, Front desk, Express check-out, Express check-in</p>
                  </div>
                  <div class="col-md-6">
                     <h6><strong><i class="fa fa-star" aria-hidden="true"></i> Services :</strong></h6>
                     <p>Complimentary newspaper in lobby, Bell staff, Valet parking, Doctor on call</p>
                  </div>
               </div>
               <div class="details-list">
                  <ul>
                     <li><i class="fa fa-clock-o" aria-hidden="true"></i> Check In : 12:00</li>
                     <li><i class="fa fa-clock-o" aria-hidden="true"></i> Check Out : 10:00</li>
                     <li><i class="fa fa-plane" aria-hidden="true"></i> Netaji Subhash Chandra Bose International Airport (61 K.M)</li>
                     <li><i class="fa fa-bus" aria-hidden="true"></i> Mecheda (13.6 K.M)</li>
                     <li><i class="fa fa-bus" aria-hidden="true"></i> Kolaghat (11 K.M)</li>
                     <li><i class="fa fa-commenting" aria-hidden="true"></i> Feedback Links:</li>
                     <li><i class="fa fa-whatsapp" aria-hidden="true"></i> 9330465660</li>
                  </ul>
               </div>
            </div>
            <div id="policies" class="tab-pane fade">
               <br>
               <h3>Policies</h3>
               <p><strong>Cancellation Policy</strong></p>
               <ol>
                  <li>The refund amount on cancellation on or before 7 days of arrival date is 75%.</li>
                  <li>The refund amount on cancellation on or before 3 days of arrival date is 50%.</li>
                  <li>No refund on cancellation within 3 days of arrival date.</li>
               </ol>
               <p><strong>Child Policy</strong></p>
               <ol>
                  <li>Complimentary up to 6 Years</li>
               </ol>
               <p><strong>Terms and conditions</strong></p>
               <ol>
                  <li>It is mandatory for guests to present valid photo identification at the time of check-in. According to government regulations, a valid Photo ID has to be carried by every person above the age of 18 staying at the hotel.</li>
                  <li>The identification proofs accepted are Driver’s License, Voters Card, Passport. Without a valid ID, the guest will not be allowed to check-in. Note- PAN Cards will not be accepted as valid ID cards.</li>
                  <li>We take at least 14 working days to process refunds. Your bank may debit its own separate charges from refunds made to your credit card or bank account.</li>
                  <li>The standard check-in time is 12:00 PM and the standard check-out time is 11:00 AM. </li>
                  <li>We are pet friendly (terms & conditions apply)</li>
               </ol>
            </div>
            <div id="hotel-map" class="tab-pane fade"><br>
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3687.8372311272074!2d87.89578461482779!3d22.435151385253647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0299d07a3b715f%3A0x1460996a7d6a7e31!2sRupasi%20Rupnarayan%20Kuthi!5e0!3m2!1sen!2sin!4v1642426202486!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div id="addon-services" class="tab-pane fade">
               <br>
               <p><strong>No Addon Services available!</strong></p>
            </div>
         </div>
      </div>
   </section>
   <section class="footer-part">
      <div class="container">
         <p class="text-center">
            <img src="<?php echo base_url(); ?>common/images/footer-logo.png">
         </p>
         <p class="copyright-text">Copyright 2021 Rupasi Rupnarayan Kuthi | All rights reserved Designed By <a href="">LNSEL</a></p>
      </div>
   </section>

   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
               <h1 class="h2">Analytiqu Pay</h1>
               <div class="btn-toolbar mb-2 mb-md-0"></div>
            </div>
         </div>
         <div class="modal-body">
            <div class="login-form">
             <div class="container">
               <div class="row">
                 <div class="col-sm">
                   Order Summary. Processing your order do not refresh...
                 </div>
               </div>
               <div class="row">
                  <form action="https://pgapi.eazypaymentz.com/pg/custreq" method="POST" id="redirectForm">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Attribute</th>
                          <th scope="col">Value</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                           <th scope="row">1</th>
                           <td>Customer Name</td>
                           <td id="c_name"></td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Phone Number</td>
                          <td id="c_ph"></td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Email</td>
                          <td id="c_email"></td>
                        </tr>
                        <tr>
                          <th scope="row">4</th>
                          <td>Amount</td>
                          <td id="amt"></td>
                        </tr>
                      </tbody>
                           <input type="hidden" value="" name="customerName" id="customerName" />
                           <input type="hidden" value="" name="customerPhone"  id="customerPhone" />
                           <input type="hidden" value="" name="customerEmail"  id="customerEmail" />

                           <input type="hidden" value="" name="orderAmount"  id="orderAmount" />
                           <input type="hidden" value="" name="signature"  id="signature" />
                           <input type="hidden" value="" name="notifyUrl"  id="notifyUrl" />
                           <input type="hidden" value="" name="customerid"  id="customerid" />
                           <input type="hidden" value="" name="orderid"  id="orderid" />
                           <input type="hidden" value="" name="orderCurrency"  id="orderCurrency" />
                           <input type="hidden" value="" name="orderNote"  id="orderNote" />
                           <input type="hidden" value="" name="nbactive"  id="nbactive" />
                           <input type="hidden" value="" name="alertUrl"  id="alertUrl" />
                    </table>
                            
               </div>

            </div>
         </div>
         <!-- <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Pay Now</button>
         </div> -->
         </form>
       </div>
     </div>
   </div>

   <script src="<?php echo base_url() . 'common/frontend/js/main.js'; ?>"></script>
</body>

</html>

<script type="text/javascript">
   function roomConfermation(room_id) 
   {
      var from_date        = $.trim($('#from_date').val());
      var to_date          = $.trim($('#to_date').val());
      var total_adults     = $.trim($('#total_adults').val());
      var total_kids       = $.trim($('#total_kids').val());

      var from_date_new  = new Date(from_date);
      var to_date_new    = new Date(to_date);

      // end - start returns difference in milliseconds 
      var diff = new Date(to_date_new - from_date_new);

      // get days
      var nights = diff/1000/60/60/24;
      
      if(nights == 1)
      {
         var night = nights +'<br>Night';
      }   
      else
      {
         var night = nights +'<br>Nights';
      }   


      $('#room_id').val(room_id);

      $('#night_count').html(night);
      $('#from_date_v').html(from_date_new.toShortFormat());
      $('#to_date_v').html(to_date_new.toShortFormat());

      var total_adults_new = "Adults: "+total_adults;
      var total_kids_new = " Kids: "+total_kids;

      $('#total_adults_new').html(total_adults_new);
      $('#total_kids_new').html(total_kids_new);

      $.ajax({
         type:"POST",
         url: "<?php echo base_url(); ?>get-room-details",
         data:{room_id: room_id,from_date : from_date , to_date : to_date}, 
         success:function(data)
         {
            $('#room_name').html(data.room_name);
            var rent = 'Room Price: <i class="fa fa-inr"></i> '+data.discounted_rate;
            $('#room_rent').html(rent);

            var tot = nights * data.discounted_rate;
            var total_amount = '<i class="fa fa-inr"></i> '+ tot;
            $('#total_amount').html(total_amount);

            var sgst = (tot * 6)/100;;
            var cgst = (tot * 6)/100;;

            var sgst_amount = '<i class="fa fa-inr"></i> '+ sgst;
            var cgst_amount = '<i class="fa fa-inr"></i> '+ cgst;

            $('#sgst_amount').html(sgst_amount);
            $('#cgst_amount').html(cgst_amount);

            var exactAmount = parseInt(tot)+parseInt(sgst)+parseInt(cgst);

            var exact_amount = '<i class="fa fa-inr"></i> '+ exactAmount;

            $('#exact_amount').html(exact_amount);
         }
      });

      $('#booking_summary').show();
      $("#addRooms").removeClass("show-box");
   }

   Date.prototype.toShortFormat = function() 
   {

       let monthNames =["Jan","Feb","Mar","Apr",
                        "May","Jun","Jul","Aug",
                        "Sep", "Oct","Nov","Dec"];
       
       let day = this.getDate();
      
       let monthIndex = this.getMonth();
       let monthName = monthNames[monthIndex];
       
       let year = this.getFullYear();
       
       return `${day}-${monthName}`;  
   }

   function showPersonal()
   {
      $('#purpose').val('Personal');

      $('#company_name').hide();
      $('#company_gstin_no').hide();
      $('#company_name').val(" ");
      $('#company_gstin_no').val(" ");
      $('#personal_address').show();
   }

   function showBusiness()
   {
      $('#purpose').val('Business');

      $('#company_name').show();
      $('#company_gstin_no').show();
      $('#personal_address').hide();
      $('#personal_address').val(" ");
   }

   function personalSubmit()
   {
      var flag = 0;

      var room_id             = $.trim($("#room_id").val()); 
      var purpose             = $.trim($("#purpose").val()); 
   
      var personal_name       = $.trim($("#personal_name").val()); 
      var personal_email      = $.trim($("#personal_email").val().toLowerCase()); 
      var personal_ph_no      = $.trim($("#personal_ph_no").val()); 
      var personal_address    = $.trim($("#personal_address").val()); 
   
      var from_date           = $.trim($('#from_date').val());
      var to_date             = $.trim($('#to_date').val());
      var total_adults        = $.trim($('#total_adults').val());
      var total_kids          = $.trim($('#total_kids').val());

      var company_name        = $.trim($('#company_name').val());
      var company_gstin_no    = $.trim($('#company_gstin_no').val());

      if(personal_name == "")
      {
         $("#personal_name").css("border-color", "red");
         flag = flag + 1;
         return false;
      }  
      else
      {
         $("#personal_name").css("border-color", "green");
      }   

      if(personal_email == "")
      {
         $("#personal_email").css("border-color", "red");
         flag = flag + 1;
         return false;
      }
      else
      {
         var format = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
         if (format.test(personal_email))
         {
            $("#personal_email").css("border-color", "green");
         }  
         else 
         {
            $("#personal_email").css("border-color", "red");
            flag = flag + 1;
            return false;
         }        
      } 

      if(personal_ph_no == "")
      {
         $("#personal_ph_no").css("border-color", "red");
         flag = flag + 1;
         return false;
      } 
      else
      {
         var filter = /^[7-9][0-9]{9}$/;
         if (filter.test(personal_ph_no))
         {
            $("#personal_ph_no").css("border-color", "green");
         }  
         else 
         {
            $("#personal_ph_no").css("border-color", "red");
            flag = flag + 1;
            return false;
         }   
         
      }

      if(personal_address == "")
      {
         $("#personal_address").css("border-color", "red");
         flag = flag + 1;
         return false;
      }
      else
      {
         $("#personal_address").css("border-color", "green");
      } 

      var from_date_new       = new Date(from_date);
      var to_date_new         = new Date(to_date);
      var diff                = new Date(to_date_new - from_date_new);
      var nights              = diff/1000/60/60/24;

      var room_rent_html      = $.trim($('#room_rent').html());
      var total_amount_html   = $.trim($('#total_amount').html());
      var sgst_amount_html    = $.trim($('#sgst_amount').html());
      var cgst_amount_html    = $.trim($('#cgst_amount').html());
      var exact_amount_html   = $.trim($('#exact_amount').html());

      var room_rent           = $.trim(room_rent_html.replace('Room Price: <i class="fa fa-inr"></i> ', ''));
      var total_amount        = $.trim(total_amount_html.replace('<i class="fa fa-inr"></i> ', ''));
      var sgst_amount         = $.trim(sgst_amount_html.replace('<i class="fa fa-inr"></i> ', ''));
      var cgst_amount         = $.trim(cgst_amount_html.replace('<i class="fa fa-inr"></i> ', ''));
      var exact_amount        = $.trim(exact_amount_html.replace('<i class="fa fa-inr"></i> ', ''));

      if(flag == 0)
      {
            $.ajax({
                        type:"POST",
                        url: "<?php echo base_url(); ?>create-booking",
                        data:{
                                 room_id: room_id,
                                 purpose : purpose, 
                                 from_date : from_date, 
                                 to_date : to_date,
                                 total_adults : total_adults,
                                 total_kids : total_kids,
                                 personal_name : personal_name,
                                 personal_email : personal_email,
                                 personal_ph_no : personal_ph_no,
                                 personal_address : personal_address,
                                 company_name : company_name,
                                 company_gstin_no : company_gstin_no,
                                 nights : nights,
                                 room_rent : room_rent,
                                 total_amount : total_amount,
                                 sgst_amount : sgst_amount,
                                 cgst_amount : cgst_amount,
                                 exact_amount : exact_amount
                              },
                        success:function(data)
                        {
                           console.log(data);

                           $('#c_name').html(data.customerName);
                           $('#customerName').val(data.customerName);

                           $('#c_ph').html(data.customerPhone);
                           $('#customerPhone').val(data.customerPhone);

                           $('#c_email').html(data.customerEmail);
                           $('#customerEmail').val(data.customerEmail);

                           $('#amt').html(data.orderAmount+'.00');
                           $('#orderAmount').val(data.orderAmount);

                           $('#signature').val(data.signature);
                           $('#notifyUrl').val(data.returnUrl);
                           $('#customerid').val(data.appId);
                           $('#orderid').val(data.orderId);
                           $('#orderCurrency').val(data.orderCurrency);
                           $('#orderNote').val(data.orderNote);
                           $('#nbactive').val(data.nbactive);
                           $('#alertUrl').val(data.alerturl);

                           $('#exampleModal').modal('show');

                           setTimeout(
                               function() {
                                 $("#redirectForm").submit();
                               }, 3000);
                        }
                  });
      } 
   }
</script>