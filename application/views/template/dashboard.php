<div class = "col-md-12">
    <div class="row">
        <div class="col-sm-6" style="margin-bottom: 2px;">
            <h4>
                <span id="ctl00_lblCurrentUsername" class="label label-success" style="font-weight:normal;">
                    <?php echo $student['email']; ?>
                </span>
            </h4>
        </div>
        <div class="col-sm-6" style="text-align: right;">
            <h6 class="comment-date">
                <span id="ctl00_lblDate">
                    Today's Date: <?php echo date_format(date_create(), "D M d, Y")//Thursday, June 14, 2018 ?>
                </span>
            </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 class = "alert alert-success"><span>Your Dashboard</span> <span style = "float:right; text-align:right;"><a style ='text-decoration: none;' href = 'slogout'>Logout</a></span></h3>
            <div id="dvedit1">
                <div class="tabsection">
                    <div style="padding: 4px; font-size: medium; font-family: Trebuchet MS; text-align: left">
                        <div>
                            <div class="col-md-12">
                                <fieldset id="ctl00_ContentPlaceHolder2_grpDetails" class="pnlwidth" style="border: solid thin rgba(0,0,0,.3); text-align: left; padding-bottom: 10px;">
                                    <legend style="font-size: small; border: solid thin rgba(0,0,0,.3); padding: 2px; background: #f4f4f4; font-weight: bold">Basic Details</legend>
                                    <div id="ctl00_ContentPlaceHolder2_divdetails" class="col-md-10" style="font-size: small;">
                                        Batch: <b><?php echo $student['batch_title'];?></b><br>
                                        Name: <b><?php echo $student['firstname'];?> <?php echo $student['middlename'];?> <?php echo $student['lastname']; ?></b><br> 
                                        Gender: <b><?php echo $student['gender']; ?></b><br> 
                                        GSM No.: <b><?php echo $student['GSM']; ?></b><br> 
                                        Email: <b><?php echo $student['email']; ?></b><br>
                                    </div>
                                    <div id="ctl00_ContentPlaceHolder2_divpixbox" class="col-md-2" style="vertical-align: top; text-align: left">
                                        <div class="author-photo">
                                            <img id="ctl00_ContentPlaceHolder2_Image12" src="<?php echo base_url('assets/passports/'); echo $student['passport'];?>"  alt="No Passport" style="height:100px;width:100px;border-width:0px;">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ctl00_ContentPlaceHolder2_dvSlip" class="col-md-12" style="margin: 7px">
                <div class="col-md-2 author-info">
                    <img id="ctl00_ContentPlaceHolder2_Image2" src="<?php echo base_url('assets/ui/'); ?>img/pic5.png" style="height:100px;width:100px;border-width:0px;">
                </div>
                <div id="ctl00_ContentPlaceHolder2_div2" class="col-md-10">
                    <span class="control-label" style="text-align: center;">To print your slip as tender for complete NYSC registration</span><br>
                    <a id="ctl00_ContentPlaceHolder2_lnkPrint" class="btn btn-success" href="print-green-card" style="font-size:11pt;">Print Slip</a><br>
                    <span class="text-danger" style="font-weight: bold; font-size: small;">Ensure you print your green card slip, sign it and bring it to camp. It is compulsory for registration in camp</span>
                </div>
            </div>
            <?php if(count($student_dep) > 0){?>
                <div id="ctl00_ContentPlaceHolder2_dvSlip" class="col-md-12" style="margin: 7px">
                    <div class="col-md-2 author-info">
                        <img id="ctl00_ContentPlaceHolder2_Image2" src="<?php echo base_url('assets/ui/'); ?>img/pic5.png" style="height:100px;width:100px;border-width:0px;">
                    </div>
                    <div id="ctl00_ContentPlaceHolder2_div2" class="col-md-10">
                        <span class="control-label" style="text-align: center;">To print your deployment slip</span><br>
                        <a class="btn btn-success" href="print-deployment-letter" style="font-size:11pt;">Print Slip</a><br>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>