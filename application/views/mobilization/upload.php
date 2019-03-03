    <section class="content-header">
        <h1  style="text-align:center;" >
            <?php echo $header ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8 col-md-offset-2">
          <!-- general form elements -->
          <div class="box box-primary">
            <?php if($is_active == 0){ ?>
                <div style="text-align:center; color:red;" class="box-header with-border">
                    <h3 class="box-title">No active batch, you cannot upload students.</h3>
                </div>
            <?php }else{ ?>
                <div style="text-align:center;" class="box-header with-border" >
                    <h3 class="box-title"><?php echo $sub_header; ?></h3>
                </div> 
                <?php if(isset($_GET['success']) && $_GET['success'] == "true"){ ?>
                        <div class = "alert alert-success">
                            Students Information Uploaded Successfully.
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
                        <?php if(form_error('institution_id')) {?>
                                <?php echo form_error('institution_id'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Institution Post', 'institution_id'); ?>
                            <?php echo form_dropdown('institution_id', $institutions, $institution->id, array("class"=>"form-control")); ?>
                        </div>
                        
                        <div class="form-group">
                            <?php echo form_label('Students Information', 'students'); ?>
                            <?php echo form_upload('students'); ?>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo form_submit('save', 'Upload Students', array("class"=>"btn btn-primary")); ?>
                    </div>  
                <?php echo form_close(); ?> 
            <?php } ?> 
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>