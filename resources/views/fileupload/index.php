<?php
require_once 'config.php';
require_once 'includes/header.php';

?>

<div class="row">
    <?php

    $upload_types = 'SELECT ID, Document_Name, Mandatory FROM document_uploads';

    $upload_fields = $conn->query($upload_types);
    $fid ='';

    foreach ($upload_fields as $fields) {
        $view = '';
        echo $view = '<div class="col-md-3" >
                                        <div class="pl-3 pt-2 pr-3 pb-2 m-1" style=" background-color:#eee; min-height:140px " >
                                            <div id="Disply_' . $fields['ID'] . '" style="display: none"></div>
                                            <i id="uploaded_'.$fields['ID'].'"></i><br>
                                                <div style=" background-color:#eee; width: 100%;min-height: 50px;">
                                                    <label class="control-label" style="font-size:13px" >' . $fields['Document_Name'] .'</label>
                                                </div>
                                                
                                                <div >
                                                    <input style="float: right;" type="file" id="upload_' . $fields['ID'] . '">
                                                </div>
                                                
                                                <input type="hidden" id="attachment_' . $fields['ID'] . '" value="" >
                                                <div id="queue_' . $fields['ID'] . '"></div>
                                        </div>
                                      </div>';
    }


    ?>

</div>








<?php
require_once 'includes/footer.php';

?>