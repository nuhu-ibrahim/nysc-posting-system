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
            <?php if($is_active == 0){ ?>
                <div style="text-align:center; color:red;" class="box-header with-border">
                    <h3 class="box-title">No active batch, you cannot view student deployment status.</h3>
                </div>
            <?php }else{ ?>
                <div style="text-align:center;" class="box-header with-border" >
                    <h3 class="box-title"><?php echo $sub_header; ?></h3>
                </div> 
                <?php if(isset($_GET['success']) && $_GET['success'] == "true"){ ?>
                    <div class = "alert alert-success">
                        Student redeployed successfully.
                    </div>
                <?php } ?> 
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
                        <?php if(form_error('matric_number')) {?>
                                <?php echo form_error('matric_number'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Matric Number', 'matric_number'); ?>
                            <?php echo form_input('matric_number', $matric_number, array("class"=>"form-control")); ?>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo form_submit('save', 'Confirm Deployment Status', array("class"=>"btn btn-primary")); ?>
                    </div>  
                <?php //echo form_close(); ?> 
                <?php if(isset($student)): ?>
                    <?php if(count($student) > 0): $student = $student[0]; ?>
                        <div style = 'text-align:center;' class="box-body alert alert-success">
                            <h4>Student has been mobilized, view details below and choose new deployment state.</h4>
                        </div>
                        <?php //echo form_open(); ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <?php echo form_hidden('matric_number2', $matric_number, array("class"=>"form-control")); ?>
                                </div>
                                <?php if(form_error('state_id')) {?>
                                    <?php echo form_error('state_id'); ?>
                                <?php } ?>
                                <div class="form-group">
                                    <?php echo form_label('Select new state', 'state_id'); ?>
                                    <?php echo form_dropdown('state_id', $states, $state->state_id, array("class"=>"form-control")); ?>
                                </div>
                            </div>
                            
                        <div class="panel-body">
                            <table class = 'table table-bordered table-striped'>
                                <tr>
                                    <th>Matriculation Number : </th>
                                    <td><h4><?php echo $student['matric_number'] ?></h4></td>
                                </tr>
                                <tr>
                                    <th>Institution Name : </th>
                                    <td><h4><?php echo $student['institution_title'] ?></h4></td>
                                </tr>
                                <tr>
                                    <th>Batch Name : </th>
                                    <td><h4><?php echo $student['batch_title'] ?></h4></td>
                                </tr>
                                <tr>
                                    <th>Student Name : </th>
                                    <td><h4><?php echo $student['firstname'].' '.$student['lastname'] ?></h4></td>
                                </tr>
                                <tr>
                                    <th>Date of Birth : </th>
                                    <td><h4><?php echo $student['dob'] ?></h4></td>
                                </tr>
                                <tr>
                                    <th>Deployment State : </th>
                                    <td><h4><?php echo $student['state_title'] ?></h4></td>
                                </tr>
                                <tr>
                                    <th>Place of Primary Assignment : </th>
                                    <td><h4><?php echo $student['ppa_name'] ?></h4></td>
                                </tr>
                            </table>
                        </div>
                        <div class="box-footer">
                            <?php echo form_submit('save2', 'Redeploy Student', array("class"=>"btn btn-primary")); ?>
                        </div>  
                    <?php else: ?>
                        <h1 style = "color:red;" align="center">Student has not been deployed.</h1>
                    <?php endif; ?>
                <?php endif; ?>
                    <?php echo form_close(); ?>
            <?php } ?> 
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>