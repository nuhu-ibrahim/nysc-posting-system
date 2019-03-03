<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="login-box-body">
            <h3 class="login-box-msg">Sign in to the system</h3>
            <?php echo $this->upload->display_errors('<div class="alert alert-error">', '</div>'); ?>
            <?php echo form_open(); ?>
                <?php if(count($error) > 0){ ?>
                    <?php foreach($error as $er){ ?>
                        <div class = "alert alert-error">
                            <?php echo $er ?>
                        </div>
                <?php 
                    } 
                } 
                ?> 

                <?php if(form_error('email')) {?>
                        <?php echo form_error('email'); ?>
                <?php } ?>
                <div class="form-group has-feedback">
                    <?php echo form_input('email', $email, array("class"=>"form-control", "placeholder"=>"Email")); ?>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <?php if(form_error('password')) {?>
                        <?php echo form_error('password'); ?>
                <?php } ?>
                <div class="form-group has-feedback">
                    <?php echo form_password('password', $password, array("class"=>"form-control", "placeholder"=>"Password")); ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <?php echo form_submit('save', 'Sign In', array("class"=>"btn btn-primary btn-block btn-flat")); ?>
                    </div>
                    <!-- /.col -->
                </div>
            <?php echo form_close(); ?> 
        </div>
    </div>
</div>