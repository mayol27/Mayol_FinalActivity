<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <br> <br>
        <h3 class="text-center">
            Register Account
        </h3>
        <form action="<?php echo base_url()?>main/form_validation" method="post">
            <?php
                if($this->uri->segment(2) == "inserted")
                {
                    echo '<p class="text-success">Data Inserted</p>';
                }
            ?>

            <?php 
               if (isset($user_data)) 
               {
                   foreach($user_data as $row)
                   {
                    ?>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" value="<?php echo $row->$fname;?>" class="form-control" placeholder="Enter first name">
                        <span class="text-danger"><?php echo form_error("fname"); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Enter last name">
                        <span class="text-danger"><?php echo form_error("lname"); ?></span>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="uname" class="form-control" placeholder="Enter user name">
                        <span class="text-danger"><?php echo form_error("uname"); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                        <span class="text-danger"><?php echo form_error("password"); ?></span>
                    </div>
                    <div class="form-group">
                    <input type="hidden" name="hidden_id" value="<?php echo $row->id;?>">
                        <input type="submit" name="update" value="Update" class="btn btn-info">
                    </div>
                    <?php
                   }
               } 
               else
               {
            ?>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" placeholder="Enter first name">
                <span class="text-danger"><?php echo form_error("fname"); ?></span>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" placeholder="Enter last name">
                <span class="text-danger"><?php echo form_error("lname"); ?></span>
            </div>
            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="uname" class="form-control" placeholder="Enter user name">
                <span class="text-danger"><?php echo form_error("uname"); ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
                <span class="text-danger"><?php echo form_error("password"); ?></span>
            </div>
            <div class="form-group">
                <input type="submit" name="insert" value="Insert" class="btn btn-info">
            </div>
            <?php
               }
            ?>
            
        </form>
        <br> <br>
        <h3>Data User</h3>
        <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Account</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if($fetch_data->num_rows() > 0)
                    {
                        foreach($fetch_data->result() as $row)
                        {
                        ?>
                            <tr>
                                <td><?php echo $row->id;?></td>
                                <td><?php echo $row->fname;?></td>
                                <td><?php echo $row->lname;?></td>
                                <td><?php echo $row->uname;?></td>
                                <td>
                                <a href="#" class="delete_data" id="<?php echo $row->id;?>">Delete</a>
                                <!-- <a href="<?php echo base_url();?>main/update_data/<?php echo $row->id;?>">Edit</a> -->
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    else
                    {
                    ?>
                        <tr>
                            <td colspan="3">No Data Found</td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
        </div>
        <script>
            $(document).ready(function()
            {
                $('.delete_data').click(function()
                {
                    var id = $(this).attr("id");
                    if(confirm("Are you sure you want to delete this?"))
                    {
                        window.location="<?php echo base_url();?>main/delete_data/"+id;
                    }
                    else
                    {
                        return false;
                    }
                });
            }); 
        </script>
    <hr>
        <div>
            <br> <br>
            <h3>FILE UPLOAD</h3>
            <br> <br>
            <?php echo form_open_multipart(''); ?>
            <input type="file" name="file_name" class="btn btn-info">
            <br> <br>
            <input type="submit" name="upload" value="Upload" class="btn btn-info" >
            <?php echo form_close(); ?>
            <br> <br>
        </div>
    </div>
</body>
</html>