<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="t-header">
                        <div class="th-title"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> Categories</div>
                    </div>
                    
                    <div class="t-body tb-padding">
                        <div class="row">

                            <div class="col-sm-12">
                              <form method="POST" action="" enctype="multipart/form-data">
                                  <div class="col-sm-4">
                                    <input type="text" name="name" placeholder="Add New Category" class="form-control" required>
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="file" name="image" class="form-control" onchange="return validateFile(this,'jpg|jpeg|png')" required>
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="submit" name="submit" value="Add" class="btn btn-primary create_btn">
                                  </div>
                              </form><br/><br/><br/><br/>
                            </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-sm-12">
                              <div class="current_games_section">
                                  <table id="example" class="table table-striped table-bordered">
                                      <thead>
                                          <tr>
                                              <th>S.NO.</th>
                                              <th>Name</th>
                                              <th>Image</th>
                                              <th>ACtion</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      <?php if(!empty($categories)){ $i = 1; foreach ($categories as $value) { ?>
                                      <tr>
                                          <td><?php echo addZero($i); ?> </td>
                                          <td><?php echo $value->name; ?> </td>
                                          <td><img style="width:60px;" src="<?php echo base_url().$value->image; ?>" ></td>
                                          <td><a href="<?php echo base_url(); ?>admin/delete_category?id=<?php echo $value->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure ?')">Delete</td>
                                     </tr>
                                      <?php $i++; } } ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
  function validateFile(input,ext,size)
  {
    var file_name = input.value;
    var split_extension = file_name.split(".").pop();
    var extArr = ext.split("|");
    if($.inArray(split_extension.toLowerCase(), extArr ) == -1)
    {
      $(input).val("");
      Ply.dialog('alert','You Can Upload Only .'+extArr.join(", ")+' files !');
      return false;
    }
    if(size != ""){
      
    }
  }
</script>
