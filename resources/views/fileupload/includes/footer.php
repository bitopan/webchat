
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script src="uploadify/jquery.uploadifive.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify/uploadifive.css">

<link rel="stylesheet" href="assets/geek/style.css" >
<script src="assets/geek/script.js" ></script>






<script>

    //file upload script
    <?php

    foreach ($upload_fields as $fields){?>
    $(function () {
        $('#upload_<?php echo $fields['ID'];  ?>').uploadifive({
            'auto': true,
            'formData': {'ID': '<?php echo $fields['ID'];  ?>'},
            'queueID': 'queue_<?php echo $fields['ID'];  ?>',
            'queueSizeLimit': 100,
            'simUploadLimit': 1,
            // 'fileType': 'image',
            'fileTypeExts': '*.jpg;*.png;*.jpeg;*.pdf;',
            'width': 170,
            'buttonText': 'Click here to upload',
            'multi': false,
            'uploadScript': 'uploadifive.php',
            'onUploadComplete': function (file, data) {
                // console.log(file,data);
                // console.log(file.type)


                var check = '<div style="float: left; color: green;" ><i class="fa fa-check"> <i/></div>';
                var cross = '<div onclick="alert()" style="float: right; color: red;" ><i class="fa fa-times"></i></div>';

                $('#uploaded_<?php echo $fields['ID']; ?>').html(check).show().append(cross);
                $('#save-upload').removeAttr('disabled');

                if (file.type == 'image/jpeg' || file.type == 'image/png' || file.type == 'image/jpg') {
                    $('#Disply_<?php echo $fields['ID'];?>').html('<img src="' + data + '" alt="Broken" width="100%">').css({
                        "display": "block",
                        "min-height": "96px"
                    });
                } else if (file.type == 'application/pdf') {
                    $('#Disply_<?php echo $fields['ID'];?>').html('<div ><img style="width:50%"  src= "assets/images/pdf.png"  ></div>').css({
                        "display": "block",
                        "min-height": "96px"
                    });

                }

                $('#uploadifive-upload_<?php echo $fields['ID']; ?>').css("display", "none");

                var data1 = data.split("||");
                if (data1[0].trim() == "Uploaded") {
                    $('#attachment_<?php echo $fields['ID']; ?>').val(data1[1]);			//link save in hidden field
                }
            }
        });
    });

    <?php
    }
    ?>

    
    $('#save-upload').on('click',async function () {
        let data = {};

        data.opd = $('#opdnumber').val();
        data.prescription = '1';
        data.action = 'savePrecription';
        let ajax_call = await ajaxCall(data);

        if (ajax_call.response) {
            if (ajax_call.hasOwnProperty('message')) {
                showAlert("success", ajax_call.message);
            }else if (ajax_call.hasOwnProperty('failure')) {
                showAlert("warning", ajax_call.failure);
            }
        } else {
            showAlert("warning", ajax_call.message);
        }

    })
    
    

</script>



</body>
</html>