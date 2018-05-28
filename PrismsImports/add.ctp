
<style>
    .form-control{

        width:90%;
    }

    .input text{
        width:90%;
    }
    input[pattern]:valid {
        color: green !important;
    }
    input[pattern]:invalid {
        color: red !important;
    }
    .positionAdjustment {
        position: relative;
        top: 6px !important;
    }
    .positionAdjustmentLabel {
        top: 6px !important;
        position: relative;
    }
</style>
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
<section class="content-header">
    <h1>
        PRISMS Import
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/provider/ProviderUsers/"> PRISMS Import</a></li>

    </ol>
</section>
<section class="content">
    <div class="box box-widget widget-user">
		<?php echo $this->Form->create('Prisms', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">    
            </div>
        </div>
        <div class="box-body" style="min-height:450px;">
				<div class="box box-primary"> 
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
										<div class="panel-heading">Import Excel Into Database</div>
										<div class="panel-body"> 
											  <div class="form-group">
												 <label class="control-label col-sm-2" for="email">Excel File:</label>
												 <div class="col-sm-10">
													<?php echo $this->Form->input('import_file', array('label' => false, 'type' => 'file', 'name' => 'import_file',  'required' => true, 'id' => 'import_file', 'class' => '')); ?>
												 </div>
											  </div>
											  <div class="form-group">        
													  <div class="col-sm-offset-2 col-sm-10">
															<div class="checkbox">
															  <label><input type="checkbox" name="truncate"> Truncate</label>
															</div>
													  </div>
													  <div class="form-group">
														 <div class="col-sm-offset-2 col-sm-10">
															<button type="submit" name="submit" class="btn btn-success">Submit</button>
														 </div>
													  </div> 
											</div>  
										</div> 
							</div>
						 </div>
					  </div> 
				</div>
			</div>
		</div> 
		<?php echo $this->Form->end(); ?>
</div> 
</section> 