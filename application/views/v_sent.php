<?php $this->load->view('includes/header');?>
<?php $this->load->view('includes/topbar');?>	
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<?php  $this->load->view('includes/menu');?>
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Pesan Terkirim</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-sent"></span> Pesan Terkirim</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable"   >
						  <thead>
							  <tr>
								  <th>Tanggal</th>
								  <th>Penerima</th>
								  <th >Pesan</th>
								  <th>Status</th>
								  <th width="200px">Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php foreach ($q->result() as $value):?>
							<tr>
								<td ><?php echo $value->SendingDateTime?></td>
								<td class="center"><?php echo $value->DestinationNumber?></td>
								<td class="center"> <?php echo $value->TextDecoded?></td>
								<td  class="center">
									<span class="label label-success"><?php echo $value->Status?></span>
								</td>
								<td width="300px"  class="center">
									<a data-rel="tooltip" title="View" class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
										                                           
									</a>									
									<a data-rel="tooltip" title="Delete" class="btn btn-danger" href="#">
										<i class="icon-trash icon-white"></i> 
										
									</a>
								</td>
							</tr>
							<?php endforeach;?>
							
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->		
			
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<?php $this->load->view('includes/copy');?>
		
	</div><!--/.fluid-container-->
	<?php $this->load->view('includes/footer');?>
	
