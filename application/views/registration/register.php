    <section class="content-header">
        <h1  style="text-align:center;" >
            <?php echo $header ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10 col-md-offset-1">
          <!-- general form elements -->
          <div class="box box-primary"> 
            <?php if(isset($_GET['success']) && $_GET['success'] == "true"){ ?>
                <div class = "alert alert-success">
                    You have completed your registration successfully, you can login to print your call-up and deployment letter.
                </div>
            <?php } ?> 
            <?php if($is_active == 1){ ?>
                <div style="text-align:center;" class="box-header with-border">
                    <h3 class="box-title"><?php echo $sub_header ?></h3>
                </div>
                <?php echo form_open_multipart(); ?>
                    <div class="box-body">
                        <?php if(count($error) > 0){ ?>
                            <?php foreach($error as $er){ ?>
                                <div class = "alert alert-error">
                                    <?php echo $er ?>
                                </div>
                        <?php 
                            } 
                        } 
                        ?> 

                        <h4 style = 'color:blue;text-align: center;'>Corp Personal Detail</h4>
                        <?php if(form_error('lastname')) {?>
                                <?php echo form_error('lastname'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Surname', 'lastname'); ?>
                            <?php echo form_input('lastname', $student->lastname, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('firstname')) {?>
                                <?php echo form_error('firstname'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('First Name', 'firstname'); ?>
                            <?php echo form_input('firstname', $student->firstname, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('middlename')) {?>
                                <?php echo form_error('middlename'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Middle Name', 'middlename'); ?>
                            <?php echo form_input('middlename', $student->middlename, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('dob')) {?>
                                <?php echo form_error('dob'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Date of Birth', 'dob'); ?>
                            <?php echo form_input('dob', $student->dob, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('email')) {?>
                                <?php echo form_error('email'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Email Address', 'email'); ?>
                            <?php echo form_input('email', $student->email, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('cemail')) {?>
                                <?php echo form_error('cemail'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Confirm Email Address', 'cemail'); ?>
                            <?php echo form_input('cemail', $cemail, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('GSM')) {?>
                                <?php echo form_error('GSM'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('GSM No', 'GSM'); ?>
                            <?php echo form_input('GSM', $student->GSM, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('gender')) {?>
                                <?php echo form_error('gender'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Gender', 'gender'); ?>
                            <?php echo form_dropdown('gender', array(""=>"--Select Gender--",'Male'=>"Male", "Female"=>"Female"), $student->gender, array("class"=>"form-control")); ?>
                        </div>
                        
                        <?php if(form_error('marital_status')) {?>
                                <?php echo form_error('marital_status'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Marital Status', 'marital_status'); ?>
                            <?php echo form_dropdown('marital_status', array(""=>"--Select Marital Status--",'Single'=>"Single", "Married"=>"Married", "Divorced"=>"Divorced", "Widowed"=>"Widowed"), $student->marital_status, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('state_of_origin')) {?>
                            <?php echo form_error('state_of_origin'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('State of Origin', 'state_of_origin'); ?>
                            <?php echo form_dropdown('state_of_origin', 
                                array(""=>"--Select State of Origin--", 'Federal Capital City'=>'Federal Capital City', 'Abia'=>'Abia',
                                    'Adamawa'=>'Adamawa','Akwa Ibom'=>'Akwa Ibom','Anambra'=>'Anambra'
                                    ,'Bauchi'=>'Bauchi','Bayelsa'=>'Bayelsa','Benue'=>'Benue',
                                    'Borno'=>'Borno','Cross River'=>'Cross River','Delta'=>'Delta',
                                    'Ebonyi'=>'Ebonyi','Edo'=>'Edo','Ekiti'=>'Ekiti','Enugu'=>'Enugu',
                                    'Gombe'=>'Gombe','Imo'=>'Imo','Jigawa'=>'Jigawa','Kaduna'=>'Kaduna',
                                    'Kano'=>'Kano','Kastina'=>'Kastina','Kebbi'=>'Kebbi','Kogi'=>'Kogi',
                                    'Kwara'=>'Kwara','Lagos'=>'Lagos','Nassarawa'=>'Nassarawa','Niger'=>'Niger',
                                    'Ogun'=>'Ogun','Ondo'=>'Ondo','Osun'=>'Osun','Oyo'=>'Oyo', 'Plateau'=>'Plateau', 
                                    'Rivers'=>'Rivers', 'Sokoto'=>'Sokoto', 'Taraba'=>'Taraba', 'Yobe'=>'Yobe', 'Zamfara'=>'Zamfara'), 
                                $student->state_of_origin, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('address')) {?>
                                <?php echo form_error('address'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Home Address', 'address'); ?>
                            <!--?php echo form_textarea('description', $expense->description, array("class"=>"form-control", "rows"=>"2")); ?-->
                            <textarea name="address" class="form-control" rows="2" cols="40"><?php echo $student->address ?></textarea>
                        </div>

                        <div class="form-group">
                            <?php echo form_label('Student Passport', 'passport'); ?>
                            <?php echo form_upload('passport'); ?>
                        </div>

                        <h4 style = 'color:blue;text-align: center;'>Corp Next of Kin Detail</h4>

                        <?php if(form_error('kin_name')) {?>
                                <?php echo form_error('kin_name'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Next of kin name', 'kin_name'); ?>
                            <?php echo form_input('kin_name', $student->kin_name, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('kin_GSM')) {?>
                                <?php echo form_error('kin_GSM'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Next of kin GSM No', 'kin_GSM'); ?>
                            <?php echo form_input('kin_GSM', $student->kin_GSM, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('kin_address')) {?>
                                <?php echo form_error('kin_address'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Next of kin address', 'kin_address'); ?>
                            <!--?php echo form_textarea('description', $expense->description, array("class"=>"form-control", "rows"=>"2")); ?-->
                            <textarea name="kin_address" class="form-control" rows="2" cols="40"><?php echo $student->kin_address ?></textarea>
                        </div>

                        <?php if(form_error('kin_relationship')) {?>
                                <?php echo form_error('kin_relationship'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Next of kin relationship', 'kin_relationship'); ?>
                            <?php echo form_input('kin_relationship', $student->kin_relationship, array("class"=>"form-control")); ?>
                        </div>

                        <h4 style = 'color:blue;text-align: center;'>Corp Education Detail</h4>

                        <?php if(form_error('institution_id')) {?>
                                <?php echo form_error('institution_id'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Institution', 'institution_id'); ?>
                            <?php echo form_dropdown('institution_id', $institutions, $student->institution_id, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('matric_number')) {?>
                                <?php echo form_error('matric_number'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Matric Number', 'matric_number'); ?>
                            <?php echo form_input('matric_number', $student->matric_number, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('date_of_grad')) {?>
                                <?php echo form_error('date_of_grad'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Date of Graduation', 'date_of_grad'); ?>
                            <?php echo form_input('date_of_grad', $student->date_of_grad, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('class_of_degree')) {?>
                                <?php echo form_error('class_of_degree'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Class of Degree', 'class_of_degree'); ?>
                            <?php echo form_dropdown('class_of_degree', $institutions, $student->class_of_degree, array("class"=>"form-control")); ?>
                        </div>

                        <h4 style = 'color:blue;text-align: center;'>Corp Kit Detail</h4>

                        <?php if(form_error('trouser_size')) {?>
                                <?php echo form_error('trouser_size'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Trouser Size', 'trouser_size'); ?>
                            <?php echo form_dropdown('trouser_size', array(''=>'--Select--', 'small'=>'Small', 'medium'=>'Medium', 'large'=>'Large', 'extra large'=>'Extra Large'), $student->trouser_size, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('trouser_length')) {?>
                                <?php echo form_error('trouser_length'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Trouser length (Inches)', 'trouser_length'); ?>
                            <?php echo form_input('trouser_length', $student->trouser_length, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('trouser_waist')) {?>
                                <?php echo form_error('trouser_waist'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Trouser Waist (Inches)', 'trouser_waist'); ?>
                            <?php echo form_input('trouser_waist', $student->trouser_waist, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('trouser_bottom')) {?>
                                <?php echo form_error('trouser_bottom'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Trouser Bottom (Inches)', 'trouser_bottom'); ?>
                            <?php echo form_input('trouser_bottom', $student->trouser_bottom, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('shirt_size')) {?>
                                <?php echo form_error('shirt_size'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Shirt Size', 'shirt_size'); ?>
                            <?php echo form_dropdown('shirt_size', array(''=>'--Select--', 'small'=>'Small', 'medium'=>'Medium', 'large'=>'Large', 'extra large'=>'Extra Large'), $student->shirt_size, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('shirt_length')) {?>
                                <?php echo form_error('shirt_length'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Shirt Length (Inches)', 'shirt_length'); ?>
                            <?php echo form_input('shirt_length', $student->shirt_length, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('canvas_size')) {?>
                                <?php echo form_error('canvas_size'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Canvas Size', 'canvas_size'); ?>
                            <?php echo form_input('canvas_size', $student->canvas_size, array("class"=>"form-control")); ?>
                        </div>

                        <h4 style = 'color:blue;text-align: center;'>Corp Login Details</h4>

                        <?php if(form_error('password')) {?>
                                <?php echo form_error('password'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Password', 'password'); ?>
                            <?php echo form_password('password', $user->password, array("class"=>"form-control")); ?>
                        </div>

                        <?php if(form_error('cpassword')) {?>
                                <?php echo form_error('cpassword'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Confirm Password', 'cpassword'); ?>
                            <?php echo form_password('cpassword', $cpassword, array("class"=>"form-control")); ?>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo form_submit('save', 'Upload Information', array("class"=>"btn btn-primary")); ?>
                    </div>  
                <?php echo form_close(); ?>
            <?php }else{ ?>
                <div style="text-align:center;color:red;" class="box-header with-border">
                    <h3 class="box-title">Registration has closed for the last batch, you have to wait for the next batch.</h3>
                </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>