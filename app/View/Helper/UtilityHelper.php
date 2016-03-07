<?php
App::uses('AppHelper', 'View/Helper');

class UtilityHelper extends AppHelper {

    public $helpers = array('Html', "Form");

    public function makeEntryTime($first = '') {
        $j = 0;
        if (empty($first)) {
            $j = 1;
        } else {
            $entry[$j] = $first;
            $j++;
        }

        for ($i = $j; $i <= 12; $i++) {
            $entry[$i . ' am'] = $i . ' am';
        }
        for ($i = $j; $i <= 12; $i++) {
            $entry[$i . ' pm'] = $i . ' pm';
        }
        return $entry;
    }

    public function makeExitTime($first = '') {
        $j = 0;

        $j = 0;
        if (empty($first)) {
            $j = 1;
        } else {
            $entry[$j] = $first;
            $j++;
        }

        for ($i = $j; $i <= 12; $i++) {
            $entry[$i . ' am'] = $i . ' am';
        }
        for ($i = $j; $i <= 12; $i++) {
            $entry[$i . ' pm'] = $i . ' pm';
        }

        return $entry;
    }

    public function Editmodal($clubExceptions) {

        $inf = '';

        foreach ($clubExceptions as $clubException) {
            $inf.='<cake:nocache><div id="basic-modal-content" class="basic-modal-content-edit' . $clubException['ClubException']['id'] . '">';

            $inf.='<form id="editException' . $clubException['ClubException']['id'] . '" name="editException' . $clubException['ClubException']['id'] . '">';
            $inf.='<table>';
            $inf.="<tr>";
            $inf.='<td>' . $this->Form->input('exception_date_edit' . $clubException['ClubException']['id'], array("id" => "modal_edit_date_picker" . $clubException['ClubException']['id'], 'value' => $clubException['ClubException']['exception_date'], 'class' => 'datepicker', 'label' => "Date")) . '</td>';
            $inf.='<td>' . $this->Form->input('exception_name_edit' . $clubException['ClubException']['id'], array("id" => "exception_name_edit" . $clubException['ClubException']['id'], 'value' => $clubException['ClubException']['exception_name'], 'label' => "Exception Name")) . '</td>';
            $inf.="&nbsp";
            $inf.="</tr>";
            $inf.="<tr>";
            $inf.= '<td>';
            //. $this->Form->select('open_time_edit' . $clubException['ClubException']['id'], $this->makeEntryTime("Open Time"), array("empty" => false)) .
            $timeArrayOne = $this->makeEntryTime();
            $timeArrayTwo = $this->makeExitTime();
            $inf.='<select name="data[open_time_edit' . $clubException['ClubException']['id'] . ']" id="open_time_edit' . $clubException['ClubException']['id'] . '">';
            $inf.='<option value="0">Open Time</option>';
            foreach ($timeArrayOne as $tempTimeOne) {
                if ($clubException['ClubException']['open_time'] == $tempTimeOne) {
                    $inf.='<option value="' . $tempTimeOne . '" selected="selected">' . $tempTimeOne . '</option>';
                } else {
                    $inf.='<option value="' . $tempTimeOne . '">' . $tempTimeOne . '</option>';
                }
            }
            $inf.='</select>';
            $inf.='</td>';

            $inf.='<td>';
            //. $this->Form->select('close_time_edit' . $clubException['ClubException']['id'], $this->makeExitTime("Close Time"), array("empty" => false)) .
            $inf.='<select name="data[close_time_edit' . $clubException['ClubException']['id'] . ']" id="close_time_edit' . $clubException['ClubException']['id'] . '">';
            $inf.='<option value="0">Close Time</option>';
            foreach ($timeArrayTwo as $tempTimeTwo) {
                if ($clubException['ClubException']['close_time'] == $tempTimeTwo) {
                    $inf.='<option value="' . $tempTimeTwo . '" selected="selected">' . $tempTimeTwo . '</option>';
                } else {
                    $inf.='<option value="' . $tempTimeTwo . '">' . $tempTimeTwo . '</option>';
                }
            }
            $inf.='</select>';
            $inf.='</td>';
            $inf.="</tr>";
            $inf.="<tr><td>";
            $inf.=$this->Form->select('status_time_edit' . $clubException['ClubException']['id'], array("Open" => "Open", "Closed" => "closed"), array("value" => $clubException["ClubException"]["status"], "empty" => false));
            $inf.=$this->Form->input('id', array('id' => 'id', 'value' => $clubException['ClubException']['id'], 'label' => false, 'type' => 'hidden'));
            $inf.="</td>";
            $inf.="</tr>";
            $inf.='<tr><td><a href="#" id="ajax_btn" class="btn btn-success" add=' . $clubException['ClubException']['id'] . '>Save</a>&nbsp;&nbsp;<a href="#" id="ajax_add_modal_btn" class="btn btn-success simplemodal-close">Cancel</a></td></tr>';
            $inf.='</table></form></div></cake:nocache>';
        }

        return $inf;
    }
    
    public function AdminEditmodal($clubExceptions) {

        $inf = '';

        foreach ($clubExceptions as $clubException) {
            $inf.='<cake:nocache><div id="basic-modal-content" class="basic-modal-content-edit' . $clubException['ClubException']['id'] . '">';

            $inf.='<form id="editException' . $clubException['ClubException']['id'] . '" name="editException' . $clubException['ClubException']['id'] . '">';
            $inf.='<table>';
            $inf.="<tr>";
            $inf.='<td>' . $this->Form->input('exception_date_edit' . $clubException['ClubException']['id'], array("id" => "modal_edit_date_picker" . $clubException['ClubException']['id'], 'value' => $clubException['ClubException']['exception_date'], 'class' => 'datepicker', 'label' => "Date")) . '</td>';
            $inf.='<td>' . $this->Form->input('exception_name_edit' . $clubException['ClubException']['id'], array("id" => "exception_name_edit" . $clubException['ClubException']['id'], 'value' => $clubException['ClubException']['exception_name'], 'label' => "Exception Name")) . '</td>';
            $inf.="&nbsp";
            $inf.="</tr>";
            $inf.="<tr>";
            $inf.= '<td>';
            //. $this->Form->select('open_time_edit' . $clubException['ClubException']['id'], $this->makeEntryTime("Open Time"), array("empty" => false)) .
            $timeArrayOne = $this->makeEntryTime();
            $timeArrayTwo = $this->makeExitTime();
            $inf.='<select name="data[open_time_edit' . $clubException['ClubException']['id'] . ']" id="open_time_edit' . $clubException['ClubException']['id'] . '">';
            $inf.='<option value="0">Open Time</option>';
            foreach ($timeArrayOne as $tempTimeOne) {
                if ($clubException['ClubException']['open_time'] == $tempTimeOne) {
                    $inf.='<option value="' . $tempTimeOne . '" selected="selected">' . $tempTimeOne . '</option>';
                } else {
                    $inf.='<option value="' . $tempTimeOne . '">' . $tempTimeOne . '</option>';
                }
            }
            $inf.='</select>';
            $inf.='</td>';

            $inf.='<td>';
            //. $this->Form->select('close_time_edit' . $clubException['ClubException']['id'], $this->makeExitTime("Close Time"), array("empty" => false)) .
            $inf.='<select name="data[close_time_edit' . $clubException['ClubException']['id'] . ']" id="close_time_edit' . $clubException['ClubException']['id'] . '">';
            $inf.='<option value="0">Close Time</option>';
            foreach ($timeArrayTwo as $tempTimeTwo) {
                if ($clubException['ClubException']['close_time'] == $tempTimeTwo) {
                    $inf.='<option value="' . $tempTimeTwo . '" selected="selected">' . $tempTimeTwo . '</option>';
                } else {
                    $inf.='<option value="' . $tempTimeTwo . '">' . $tempTimeTwo . '</option>';
                }
            }
            $inf.='</select>';
            $inf.='</td>';
            $inf.="</tr>";
            $inf.="<tr><td>";
            $inf.=$this->Form->select('status_time_edit' . $clubException['ClubException']['id'], array("Open" => "Open", "Closed" => "closed"), array("value" => $clubException["ClubException"]["status"], "empty" => false));
            $inf.=$this->Form->input('id', array('id' => 'id', 'value' => $clubException['ClubException']['id'], 'label' => false, 'type' => 'hidden'));
            $inf.="</td>";
            $inf.="</tr>";
            $inf.='<tr><td><a href="#" id="admin_ajax_btn" class="btn btn-success" add=' . $clubException['ClubException']['id'] . '>Save</a>&nbsp;&nbsp;<a href="#" id="ajax_add_modal_btn" class="btn btn-success simplemodal-close">Cancel</a></td></tr>';
            $inf.='</table></form></div></cake:nocache>';
        }

        return $inf;
    }

    public function uploader($clubs, $id, $photos) {
        $info = '';
        if (count($photos) >= 8)
            $style = 'display:none;';
        else
            $style = '';

        $info = $this->Form->create('Photo', array('type' => 'file', "id" => "multiform", 'style' => 'position:relative;'));
        $info.= $this->Form->hidden("path", array("value" => $this->webroot, "id" => "w_root"));
        $info.= $this->Form->hidden("total_photo", array("value" => count($photos)));
        $info.= $this->Form->input('photos', array('type' => 'file', 'style' => $style));
        $info.= $this->Form->button('Upload', array('type' => 'submit', "id" => "club_upload", 'style' => $style));
        $info.=$this->Html->image('loading.gifs/loading01@2x.gif', array('class' => '', "id" => "spinner_loading", "style" => 'display: none;height: 32px;left: 85px;position: absolute;top: 52px;width: 32px;'));
        $info.= $this->Form->button('Edit Profile', array('type' => 'button', "id" => "edit_profile_photos"));
        $info.= $this->Form->button('Done', array('type' => 'button', "id" => "done_profile_photos", "style" => "display:none;"));
        if (isset($clubs[0]['Club']["id"])) {
            $info.= $this->Form->hidden('club_id', array("value" => $clubs[0]['Club']["id"], "id" => "club_id"));
        } else {
            $info.= $this->Form->hidden('club_id', array("value" => "", "id" => "club_id"));
        }

        $info.= $this->Form->end();
        return $info;
    }

    public function plupload($path) {
        ?>
        <script type="text/javascript">
            // Custom example logic

            var uploader = new plupload.Uploader({
                runtimes: 'html5,flash,silverlight,html4',
                browse_button: 'pickfiles', // you can pass in id...
                container: document.getElementById('container'), // ... or DOM Element itself
                url: 'upload.php',
                flash_swf_url: '<?php echo WWW_ROOT; ?>/plupload/js/Moxie.swf',
                silverlight_xap_url: '<?php echo WWW_ROOT; ?>/plupload/js/Moxie.xap',
                filters: {
                    max_file_size: '10mb',
                    mime_types: [
                        {title: "Image files", extensions: "jpg,gif,png"},
                        {title: "Zip files", extensions: "zip"}
                    ]
                },
                init: {
                    PostInit: function() {
                        document.getElementById('filelist').innerHTML = '';
                        document.getElementById('uploadfiles').onclick = function() {
                            uploader.start();
                            return false;
                        };
                    },
                    FilesAdded: function(up, files) {
                        plupload.each(files, function(file) {
                            document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                        });
                    },
                    UploadProgress: function(up, file) {
                        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    },
                    Error: function(up, err) {
                        document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
                    }
                }
            });

            uploader.init();

        </script>
        <?php
    }

    public function plupload_uploader() {
        ?>
        <div id="container">
            <a id="pickfiles" href="javascript:;">[Select files]</a>
            <a id="uploadfiles" href="javascript:;">[Upload files]</a>
        </div>

        <br />
        <pre id="console"></pre>
        <?php
    }

    public function OpenClose($openDaysList) {
        if (empty($openDaysList)) {
            ?>
            <?php
            $tab = '<table class="dayOpen" width="100%">';
            $tab.="<tr>";
            $tab.= "<td>";

            $tab.= $this->Form->input('ClubOpenDay.0.days', array("readonly" => true, "value" => "Saturday", 'label' => false));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.0.open_time', $this->makeEntryTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.0.close_time', $this->makeExitTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->checkbox('ClubOpenDay.0.status', array("data-on-label" => "Open", "data-off-label" => "Close", "checked" => "checked"), array("empty" => false));

            $tab.= "</td>";
            $tab.= "</tr>";

            $tab.= "<tr>";
            $tab.= "<td>";
            $tab.= $this->Form->input('ClubOpenDay.1.days', array("readonly" => true, "value" => "Sunday", 'label' => false));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.1.open_time', $this->makeEntryTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.1.close_time', $this->makeExitTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->checkbox('ClubOpenDay.1.status', array("data-off-label" => "Close", "data-on-label" => "Open", "checked" => "checked"), array("empty" => false));
            $tab.= "</td>";
            $tab.= "</tr>";

            $tab.= "<tr>";
            $tab.= "<td>";
            $tab.= $this->Form->input('ClubOpenDay.2.days', array("readonly" => true, "value" => "Monday", 'label' => false));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.2.open_time', $this->makeEntryTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.2.close_time', $this->makeExitTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->checkbox('ClubOpenDay.2.status', array("data-on-label" => "Open", "data-off-label" => "Close", "checked" => "checked"), array("empty" => false));
            $tab.= "</td>";
            $tab.= "</tr>";
            $tab.= "<tr>";
            $tab.= "<td>";
            $tab.= $this->Form->input('ClubOpenDay.3.days', array("readonly" => true, "value" => "Tuesday", 'label' => false));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.3.open_time', $this->makeEntryTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.3.close_time', $this->makeExitTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->checkbox('ClubOpenDay.3.status', array("data-on-label" => "Open", "data-off-label" => "Close", "checked" => "checked"), array("empty" => false));
            $tab.= "</td>";
            $tab.= "</tr>";
            $tab.= "<tr>";
            $tab.= "<td>";
            $tab.= $this->Form->input('ClubOpenDay.4.days', array("readonly" => true, "value" => "Wednesday", 'label' => false));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.4.open_time', $this->makeEntryTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.4.close_time', $this->makeExitTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->checkbox('ClubOpenDay.4.status', array("data-on-label" => "Open", "data-off-label" => "Close", "checked" => "checked"), array("empty" => false));
            $tab.= "</td>";
            $tab.= "</tr>";
            $tab.= "<tr>";
            $tab.= "<td>";
            $tab.= $this->Form->input('ClubOpenDay.5.days', array("readonly" => true, "value" => "Thursday", 'label' => false));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.5.open_time', $this->makeEntryTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.5.close_time', $this->makeExitTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->checkbox('ClubOpenDay.5.status', array("data-on-label" => "Open", "data-off-label" => "Close", "checked" => "checked"), array("empty" => false));
            $tab.= "</td>";
            $tab.= "<tr>";
            $tab.= "<td>";
            $tab.= $this->Form->input('ClubOpenDay.6.days', array("readonly" => true, "value" => "Friday", 'label' => false));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.6.open_time', $this->makeEntryTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "<td>";
            $tab.= $this->Form->select('ClubOpenDay.6.close_time', $this->makeExitTime(), array("empty" => false, 'class' => 'input-medium'));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->checkbox('ClubOpenDay.6.status', array("data-on-label" => "Open", "data-off-label" => "Close", "checked" => "checked"), array("empty" => false));
            $tab.= "</td>";
            $tab.= "<td>";
            $tab.= $this->Form->button("submit", array("id" => "sub", 'class' => 'btn btn-success'));
            $tab.= "</td>";
            $tab.='</span></table>';
        } else {
            $openTimeArray = $this->makeEntryTime();
            $closeTimeArray = $this->makeExitTime();
            $tab = '<table class="dayOpen" width="100%">';
            
            foreach ($openDaysList as $l => $tempList) {
                $tab.="<tr>";
                $tab.= "<td>";

                $tab.= $this->Form->input('ClubOpenDay.' . $l . '.days', array("value" => $tempList['days'], 'label' => false));
                $tab.= "</td>";
                $tab.= "<td>";
               
                $tab.= "<select name='data[ClubOpenDay][" . $l . "][open_time]' id ='ClubOpenDay" . $l . "OpenTime' class='input-medium'>";
                foreach ($openTimeArray as $key => $val) {
                    if ($key == $tempList['open_time']) {
                        $tab.= "<option value='" . $key . "' selected='selected'>";
                        $tab.=$val;
                        $tab.= "</option>";
                    } else {
                        $tab.= "<option value='" . $key . "'>";
                        $tab.=$val;
                        $tab.= "</option>";
                    }
                    //$m++;
                }
                $tab.= "</select>";

                $tab.= "</td>";
                $tab.= "<td>";
                $tab.= "<select name='data[ClubOpenDay][" . $l . "][close_time]' id ='ClubOpenDay" . $l . "CloseTime' class='input-medium'>";
                foreach ($closeTimeArray as $keyNew => $valNew) {
                    if ($keyNew == $tempList['close_time']) {
                        $tab.= "<option value='" . $keyNew . "' selected='selected'>";
                        $tab.=$valNew;
                        $tab.= "</option>";
                    } else {
                        $tab.= "<option value='" . $keyNew . "'>";
                        $tab.=$valNew;
                        $tab.= "</option>";
                    }
                }
                $tab.= "</select>";
                $tab.= "</td>";
                $tab.= "<td>";
                
                if ($tempList['status'] == 'Open') {
                    $tab.= "<input type='checkbox' checked='checked' id='ClubOpenDay" . $l . "Status' name='data[ClubOpenDay][" . $l . "][status]' data-on-label='Open' data-off-label='Close'>";
                } else {
                    $tab.= "<input type='checkbox' id='ClubOpenDay" . $l . "Status' name='data[ClubOpenDay][" . $l . "][status]' data-on-label='Open' data-off-label='Close'>";
                }
                
                $tab.= "</td>";
                $tab.= "</tr>";               
            }
            $tab.= "<tr>";
            $tab.= "<td colspan='4' align='right'>";
            $tab.= $this->Form->button("submit", array("id" => "sub", 'class' => 'btn btn-success'));
            $tab.= "</td>";
            $tab.= "</tr>";
            $tab.='</span></table>';
        }
        return $tab;
    }

    function profile_image($profile_photo, $photos) {        
	
        if (isset($profile_photo['id']))
            $pid = $profile_photo['id'];
        else
            $pid = '';
        if (isset($profile_photo['club_id']))
            $club_id = $profile_photo['club_id'];
        if (isset($profile_photo['photos']))
            $path = $this->webroot . 'img/profile/' . $profile_photo["photos"];
        echo'<div style="width:65%"><div class="row-fluid"><div class="span12">';
        if (isset($pid) && isset($club_id) && isset($path)) {
            ?>

            <div class="span3 item">
                <img src="<?php echo $path; ?>" class="profile_img"  style="width:100%" height="75"/>
                     <a href="javascript:void(0)" class="profselected" style="display:none">Profile Picture</a>
            <?php
            echo $this->Html->link($this->Html->image("x.png"), "#", array("class" => "del_profile_photo", 'escape' => false, "pic" => $pid, "club_id" => $profile_photo['club_id'], "style" => "display:none"));
            ?>
            </div>

            <?php
        }
        $span = 1;
		//pr($photos);
        foreach ($photos as $photo) {
            if ($photo["id"] <> $pid) {
                if ($span > 0 && $span % 4 == 0)
                    echo'</div></div><div class="row-fluid"><div class="span12">';

                $path = $this->webroot . 'img/profile/' . $photo["photos"];
                $id = $photo["id"];
                $club_id = $photo["club_id"];
                ?>
                <div class="span3 item">
                    <img src="<?php echo $path; ?>" class="profile_img" style="width:100%" height="75" />
                         <a href="javascript:void(0)" class="prof" onclick="make_profile('<?php echo $id ?>', '<?php echo $club_id; ?>')" style = "display:none">Make Profile</a>
                         <?php
                         echo $this->Html->link($this->Html->image("x.png"), "#", array("class" => "del_profile_photo", 'escape' => false, "pic" => $photo["id"], "club_id" => $club_id, "style" => "display:none"));
                         ?>
                </div>
                <?php
                $span++;
            }
        }
        echo'</div></div></div>';
    }

    public function exceptionLoad($clubExceptions) {
        $tbl = '';
        $tbl.='<table id="tbl_exception" class="table table-bordered gry">
        <tr>
            <td>Date</td>
            <td>Event</td>
            <td>Status</td>
            <td>Action</td>
            </tr>';
        foreach ($clubExceptions as $clubException):
            $idD = $clubException['ClubException']['id'];
        if($clubException['ClubException']['status'] == "Closed"){
            $status = "Closed";
        }else{
            $status = "Open ". $clubException['ClubException']['open_time']." to ".$clubException['ClubException']['close_time'];
        }
            $tbl.='<tr>
                <td>' . $clubException['ClubException']['exception_date'] . '</td>' .
                    '<td>' . $clubException['ClubException']['exception_name'] . '</td>' .
                    '<td>' . $status . '</td>' .
                    '<td><a id="edit_exception" exc="' . $idD . '" href="#">Edit</a>&nbsp;|&nbsp;<a id="del_exception" href="javascript:void(0)" onclick="del_exception(' . $idD . ')">Delete</a></td>'
                . '</tr>';

        endforeach;
        //$tbl.="</div>";
        $tbl.='</table>';
        return $tbl;
    }

    public function basicmodal() {
        ?>
        <table>
        <?php
        echo "<tr>";
        echo '<td>' . $this->Form->input('exception_date') . '</td>';
        echo '<td>' . $this->Form->input('exception_name') . '</td>';
        echo "<td>&nbsp;</td>";
        echo "</tr>";
        echo "<tr>";
        echo '<td>' . $this->Form->select('open_time', $this->makeEntryTime("Open time"), array("empty" => false)) . '</td>';
        echo '<td>' . $this->Form->select('close_time', $this->makeExitTime("Close time"), array("empty" => false)) . '</td>';
        echo "</tr>";
        echo "<tr><td>";
        echo $this->Form->select('status', array("Open" => "Open", "Closed" => "closed"), array("empty" => false));
        echo "</td>";
        echo "</tr>";
        ?>
            <tr>
                <td><a href='#' id='ajax_add_modal_btn' class="btn btn-success">Save</a>&nbsp;&nbsp;<a href='#' id='ajax_add_modal_btn' class="btn btn-success simplemodal-close">Cancel</a></td>
            </tr>

        </table>

            <?php
        }
    public function adminbasicmodal() {
        ?>
        <table>
        <?php
        echo "<tr>";
        echo '<td>' . $this->Form->input('exception_date') . '</td>';
        echo '<td>' . $this->Form->input('exception_name') . '</td>';
        echo "<td>&nbsp;</td>";
        echo "</tr>";
        echo "<tr>";
        echo '<td>' . $this->Form->select('open_time', $this->makeEntryTime("Open time"), array("empty" => false)) . '</td>';
        echo '<td>' . $this->Form->select('close_time', $this->makeExitTime("Close time"), array("empty" => false)) . '</td>';
        echo "</tr>";
        echo "<tr><td>";
        echo $this->Form->select('status', array("Open" => "Open", "Closed" => "closed"), array("empty" => false));
        echo "</td>";
        echo "</tr>";
        ?>
            <tr>
                <td><a href='#' id='admin_ajax_add_modal_btn' class="btn btn-success">Save</a>&nbsp;&nbsp;<a href='#' id='ajax_add_modal_btn' class="btn btn-success simplemodal-close">Cancel</a></td>
            </tr>

        </table>

            <?php
        }

    }
    ?>