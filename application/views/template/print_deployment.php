<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>
            Welcome to the NYSC Portal
        </title>
        <style>
            body{
                //background-image:url("<?php //echo base_url('assets/ui/'); ?>img/bg.png"); 
                //background-repeat: repeat-x;
            }
            .mynav{
                background-color:white;
            }
        </style>
        <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/bootstrap.min.css">
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/ui/'); ?>css/favicon.ico" />
        <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/blue.css">
    </head>
    <body>
        <div id = 'green_card' class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-12">
                        <h2 style = 'text-align:center;color: #398439;font-weight: 1000;'>NATIONAL YOUTH SERVICE CORPS</h2>
                        <h2 style = 'text-align:center;color: #398439;'>...Service and Humility</h2>
                        <p style = 'text-align:center;'>National Headquarters, Yakubu Gowon House,<br />Plot 416, Tigris Crescent, off Aguiyi Ironsi street, Maitama, Abuja<br />Corps Member's Personal Details (Batch B, 2017)</p>
                        <h3 style = 'text-align:center;color: #398439;font-weight: 1000;'>Corps Member's Personal Details (Batch <?php echo $student['batch_title']; ?>)</h3>
                        <table class = "table tab-default">
                            <tr>
                                <td><b>Full Name:</b> <?php echo $student['firstname'];?> <?php echo $student['middlename'];?> <?php echo $student['lastname']; ?></td>
                                <td><b>Email:</b> <?php echo $student['email'];?></td>
                                <td rowspan = '4'><img src = '<?php echo base_url('assets/passports/').$student['passport'];?>' height ='120' width = '120' /></td>
                            </tr>
                            <tr>
                                <td><b>Date of Birth:</b> <?php echo $student['dob']; ?></td>
                                <td><b>Place of Birth:</b> Kaduna </td>
                            </tr>
                            <tr>
                                <td><b>Gender:</b> <?php echo $student['gender']; ?></td>
                                <td><b>Marital Status:</b> <?php echo $student['marital_status']; ?></td>
                            </tr>
                        </table>
                        <h2>Contact:</h2>
                        <b>Present Address:</b> <?php echo $student['address']; ?><br />
                        <b>GSM Number:</b> <?php echo $student['GSM']; ?><br />
                        
                        <h2>Next of Kin Details:</h2>
                        <table class = "table tab-default">
                            <tr>
                                <th>Names</th>
                                <th>GSM Number</th>
                                <th>Address</th>
                                <th>Relationship</th>
                            </tr>
                            <tr>
                                <td><?php echo $student['kin_name']; ?></td>
                                <td><?php echo $student['kin_GSM']; ?></td>
                                <td><?php echo $student['kin_address']; ?></td>
                                <td><?php echo $student['kin_relationship']; ?></td>
                            </tr>
                        </table>
                        <h2>Educational Qualification Details:</h2>
                        <table class = "table tab-default">
                            <tr>
                                <th>Institution</th>
                                <th>Matriculation Number</th>
                                <th>Graduated Date</th>
                                <th>Grade</th>
                            </tr>
                            <tr>
                                <td><?php echo $student['institution_title']; ?></td>
                                <td><?php echo $student['matric_number']; ?></td>
                                <td><?php echo $student['date_of_grad']; ?></td>
                                <td><?php echo $student['class_of_degree']; ?></td>
                            </tr>
                        </table>
                        <h2>Kits Specification Details:</h2>
                        <table class = "table tab-default">
                            <tr>    
                                <th>Kit</th>
                                <th>Size</th>
                                <th>Length</th>
                                <th>Waist</th>
                                <th>Chest</th>
                                <th>Neck</th>
                                <th>Bottom</th>
                            </tr>
                            <tr>
                                <td>Shirt</td>
                                <td><?php echo $student['shirt_size']; ?></td>
                                <td><?php echo $student['shirt_length']; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>White Canvas</td>
                                <td><?php echo $student['canvas_size']; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Trouser</td>
                                <td><?php echo $student['trouser_size']; ?></td>
                                <td><?php echo $student['trouser_length']; ?></td>
                                <td><?php echo $student['trouser_waist']; ?></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $student['trouser_bottom']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url('assets/ui/'); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url('assets/ui/'); ?>js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $('dropdown-toggle').dropdown();
        </script>
        <script>
              function printDiv(divName){
                  window.print();
                  window.location = '<?php echo base_url('dashboard'); ?>';
              }
              printDiv('green_card');
        </script>
    </body>
</html>