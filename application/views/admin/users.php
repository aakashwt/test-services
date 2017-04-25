<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                <div class="t-header">
                        <div class="th-title"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> Users List 
                    </div>
                    <div class="current_games_section">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.NO.</th>
                                    <th>Username</th>
                                    <th>Email-id</th>
                                    <th>Verified</th>
                                    <th>Added Date</th>
                                    <th>Last Login</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($users)){ $i = 1; foreach ($users as $value) { ?>
                            <tr>
                                <td><?php echo $i; ?> </td>
                                <td><?php echo $value->UserName; ?> </td>
                                <td><?php echo $value->EmailId; ?> </td>
                                <td><?php echo ($value->UserStatus == 0) ? "No" : "Yes"; ?> </td>
                                <td><?php echo convertDateTime($value->CreatedDate); ?> </td>
                                <td><?php echo convertDateTime($value->ModifiedDate); ?> </td>
                           </tr>
                            <?php $i++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</section>

