     <!-- Begin Page Content -->

     <div class="container-fluid" id="div_form">
         <!-- Page Heading -->
         <h1 class="h3 mb-4 text-gray-800">Job Title</h1>
         <div class="row">
             <div class="col-md-12">

                 <form id="form_id" name="form_id">
                     <div class="card shadow mb-4">
                         <div class="card-header font-weight-bold text-primary">
                             Add Job Title
                         </div>
                         <div class="card-body">
                             <input type="hidden" name="uuid" id="uuid" value="" />
                             <div class="row">
                                 <div class="col-md-6 form-group">
                                     <div class="mb-3"><label class="form-label">Job Title Name<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" id="job_title_name" name="job_title_name">
                                     </div>
                                 </div>
 
                                 <div class="col-md-6 form-group">
                                     <div class="mb-3"><label class="form-label">Department<span class="text-danger">*</span></label>
                                        <select class="form-control" name="department_id" id="department_id"></select>
                                    </div>
                                 </div>

                             </div>
                             <div class="row">
                             <div class="col-md-12 form-group">
                                     <div class="mb-3"><label class="form-label">Job Description<span class="text-danger">*</span></label>
                                     <textarea name="job_title_description" id="job_title_description"class="form-control"></textarea>
                                     </div>
                                 </div>
                             </div>


                         </div>
                         <div class="card-footer text-right">
                             <button type="reset" class="btn btn-secondary" onClick="return formReset('hide')">Cancel</button>
                             <button type="submit" class="btn btn-primary submit">Submit</button>

                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <div class="container-fluid">
         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 <div class="row">
                     <div class="col-md-6">
                         <h6 class="m-0 font-weight-bold text-primary">List of job Titles</h6>
                     </div>
                     <div class="col-md-6 text-right">
                         <button type="button" class="btn btn-sm btn-primary" id="btn_add" onClick="formReset('show')">
                             <i class="fas fa-plus font-size-16 mr-1"></i> Add Job Yitle
                         </button>

                     </div>
                 </div>


             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>Job Title Name</th>
                                 <th>Job Description</th>
                                 <th>Department</th>
                                 <th>Status</th>
                                 <th>Created At</th>
                                 <th>Action</th>

                             </tr>
                         </thead>

                         <tbody>

                         </tbody>
                     </table>
                 </div>
             </div>
         </div>

     </div>
     <!-- /.container-fluid -->

     <script src="<?= base_url('assets') ?>/js/job_title/job_title.js"></script>