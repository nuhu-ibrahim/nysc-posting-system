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
            <div style="text-align:center;" class="box-header with-border" >
              <h3 class="box-title"><?php echo $sub_header ?></h3>
            </div> 
            <?php if($ppas): ?>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th>State Title</th> 
                            <th>PPA Name</th> 
                            <th>PPA Address</th> 
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php $num = 0 ?>
                        <?php foreach($ppas as $ppa) { ?>
                            <tr>
                                <td><?php echo ++$num ?></td>
                                <td><?php echo $ppa['state_title'] ?></td>
                                <td><?php echo $ppa['ppa_name'] ?></td>
                                <td><?php echo $ppa['ppa_address'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?php echo base_url('/edit-ppa'); ?>/<?php echo $ppa['ppa_id'] ?>">Edit</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/No</th>
                            <th>State Title</th> 
                            <th>PPA Name</th> 
                            <th>PPA Address</th> 
                            <th>Action</th> 
                        </tr>
                    </tfoot>
                </table>
            <?php else: ?>
                <h1 align="center">No place of primary assignment has been added yet!.</h1>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>