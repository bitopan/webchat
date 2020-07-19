<?php
require_once 'config.php';
require_once 'includes/header.php';

?>
<div class="container pt-3 pb-3" >

    <ul class="nav nav-tabs" id="myTab" role="tablist">
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" id="write-tab" data-toggle="tab" href="#write" role="tab" aria-controls="write" aria-selected="true">Write</a>-->
<!--        </li>-->
        <li class="nav-item">
            <a class="nav-link active" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="false">Upload</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
<!--        <div class="tab-pane fade" id="write" role="tabpanel" aria-labelledby="write-tab">-->
<!--            <h3 class="pb-3 pt-3">-->
<!--                Prescription Module to be implemented-->
<!--            </h3>-->
<!--        </div>-->
        <div class="tab-pane fade show active pb-3 pt-3" id="upload" role="tabpanel" aria-labelledby="upload-tab">
            <div class="row">

                <input id="opdnumber" type="hidden" value="<?=$_GET['opd']?>" >
                <div class="col-md-6">
                    <div class="row" >

                        <?php

                        $upload_types = 'SELECT ID, Document_Name, Mandatory FROM document_uploads WHERE Document_Type = 1';

                        $upload_fields = $conn->query($upload_types);
                        $fid ='';

                        foreach ($upload_fields as $fields) {
                            $view = '';
                            echo $view = '<div class="col-md-10" >
                                        <div class="pl-3 pt-2 pr-3 pb-2 m-1" style=" background-color:#eee; border-radius: 5px; min-height:140px " >
                                            <div id="Disply_' . $fields['ID'] . '" style="display: none"></div>
                                            <i id="uploaded_'.$fields['ID'].'"></i><br>
                                                <div style="width: 100%;min-height: 50px;">
                                                    <label class="control-label" style="font-size:15px" >' . $fields['Document_Name'] .'</label>
                                                </div>
                                                
                                                <div>
                                                    <input style="float: right;" type="file" id="upload_' . $fields['ID'] . '">
                                                </div>
                                                
                                                <input type="hidden" id="attachment_' . $fields['ID'] . '" value="" >
                                                <div id="queue_' . $fields['ID'] . '"></div>
                                                <small style="color: #0009; font-size: 10px;"> (jpeg/jpg/pdf ) files only </small>
                                        </div>
                                      </div>';
                        }


                        ?>




                    </div>
                </div>

                <div class="col-md-6" >

                    <div class="row pt-3 pb-3" >
                        <div class="col-md-10">

                            <div class="panel panel-default">
                                <div class="panel-heading">  <h4 >Patient Profile</h4></div>
                                <div class="panel-body">

                                    <div class="box box-info">

                                        <div class="box-body">

                                            <hr style="margin:5px 0 5px 0;">


                                            <div class="row" >
                                                <div class="col-md-5 tital " >OPD No. : </div>
                                                <div class="col-md-7 "><?=$_GET['opd']?> </div>
                                            </div>

                                            <div class="row" >
                                                <div class="col-md-5 tital " >Chief Complaints: </div>
                                                <div class="col-md-7 ">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                </div>
                                            </div>


                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <button disabled id="save-upload" class="btn btn-block uploadifive-button">Notify Patient</button>
                </div>


            </div>
        </div>
    </div>

</div>








<?php
require_once 'includes/footer.php';

?>