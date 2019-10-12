<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <h3>Upload Image</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image_file" id="image_file">
            <br> <br>
            <input type="submit" value="Upload" name="upload">
        </form>
        <br> <br>
        <div id="upload_image">

        </div>
    </div>
</body>
</html>
<script>
$(ducument).ready(function()
{
    $('#upload_form').on('submit',function(e)
    {
        e.preventDefault();
        if($('#upload_file').val() == "")
        {
            alert("Please Select File");
        }
        else
        {
            $.ajax({
                url:"<?php echo base_url();?>main/ajax_upload",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    $('#uploaded_image').html(data);
                }
            })
        }
    });
});
</script>