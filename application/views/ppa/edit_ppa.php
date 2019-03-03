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
            <div style="text-align:center;" class="box-header with-border">
                <h3 class="box-title"><?php echo $sub_header ?></h3>
            </div>
            <?php if(isset($_GET['success']) && $_GET['success'] == "true"){ ?>
                    <div class = "alert alert-success">
                        Place of primary assignment information updated successfully.
                    </div>
            <?php } ?> 
            <?php echo form_open(); ?>
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
                    <?php if(form_error('state_id')) {?>
                        <?php echo form_error('state_id'); ?>
                    <?php } ?>
                    <div class="form-group">
                        <?php echo form_label('Select new state', 'state_id'); ?>
                        <?php echo form_dropdown('state_id', $states, $ppa->state_id, array("class"=>"form-control")); ?>
                    </div>
                    
                    <?php if(form_error('ppa_name')) {?>
                            <?php echo form_error('ppa_name'); ?>
                    <?php } ?>
                    <div class="form-group">
                        <?php echo form_label('Organization Name', 'ppa_name'); ?>
                        <?php echo form_input('ppa_name', $ppa->ppa_name, array("class"=>"form-control")); ?>
                    </div>
                    
                    <?php if(form_error('ppa_address')) {?>
                        <?php echo form_error('ppa_address'); ?>
                    <?php } ?>
                    <div class="form-group">
                        <?php echo form_label('Organization Address', 'ppa_address'); ?>
                        <!--?php echo form_textarea('description', $expense->description, array("class"=>"form-control", "rows"=>"2")); ?-->
                        <textarea name="ppa_address" class="form-control" rows="2" cols="40"><?php echo $ppa->ppa_address ?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <?php echo form_submit('save', 'Update PPA Information', array("class"=>"btn btn-primary")); ?>
                </div>  
            <?php echo form_close(); ?> 
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>