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
                    
                    <?php if(form_error('institution_id')) {?>
                            <?php echo form_error('institution_id'); ?>
                    <?php } ?>
                    <div class="form-group">
                        <?php echo form_label('Select Institution', 'institution_id'); ?>
                        <?php echo form_dropdown('institution_id', $institutions, $institution->id, array("class"=>"form-control")); ?>
                    </div>
                    
                    <?php if(form_error('matric_number')) {?>
                            <?php echo form_error('matric_number'); ?>
                    <?php } ?>
                    <div class="form-group">
                        <?php echo form_label('Matric Number', 'matric_number'); ?>
                        <?php echo form_input('matric_number', $mobilization->matric_number, array("class"=>"form-control")); ?>
                    </div>
                    
                    <?php if(form_error('lastname')) {?>
                            <?php echo form_error('lastname'); ?>
                    <?php } ?>
                    <div class="form-group">
                        <?php echo form_label('Surname', 'lastname'); ?>
                        <?php echo form_input('lastname', $mobilization->lastname, array("class"=>"form-control")); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <?php echo form_submit('save', 'Search', array("class"=>"btn btn-primary")); ?>
                </div>  
            <?php echo form_close(); ?> 
            <?php if(isset($student)): ?>
                <?php if(count($student) > 0): $student = $student[0]; ?>
                    <div style = 'text-align:center;' class="box-body alert alert-success">
                        <h4>You have been mobilized, view details below.</h4>
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
                        </table>
                        <h4 style = "text-align:center;">Click <a href='<?php echo base_url('register'); ?>' >here</a> to continue registration.</h4>
                    </div>
                <?php else: ?>
                    <h1 style = "color:red;text-align:center;" align="center">You have not been mobilized.</h1>
                <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>