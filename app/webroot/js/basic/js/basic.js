/*
 * SimpleModal Basic Modal Dialog
 * http://simplemodal.com
 *
 * Copyright (c) 2013 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 */
var club_submit = "../Clubs/ajaxadd";
function make_profile(imageid, clubid)
{
//		alert(imageid+'-'+clubid);

    $.ajax({
        type: "POST",
        url: "../Photos/makeprofile",
        data: {imageid: imageid, clubid: clubid}
    }).done(function(msg) {
        alert("successfully made profile picture");
    });
}

function del_exception(exception_id)
{
    $.ajax({
        type: "POST",
        url: "../ClubExceptions/ajaxdelete",
        data: {exid: exception_id, club_id: $("#ClubId").val()}
    }).done(function(msg) {
        //$( msg ).appendTo( $( ".container" ) );
        $("#tbl_exception").html(msg);
    });
    return false;
}


$(function($) {

    var url = "../Clubs/uploaderNew";

    //form submit
    $('#sub').click(function(e) {

        var club_open = new Object();
        var club_open_time = new Object();
        var club_close_time = new Object();
        var club_status = new Object();

        var club_name = $("#club_name").val();
        var club_des = $("#short_des").val();


        club_open['a'] = $("#ClubOpenDay0Days").val();
        club_open['b'] = $("#ClubOpenDay1Days").val();
        club_open['c'] = $("#ClubOpenDay2Days").val();
        club_open['d'] = $("#ClubOpenDay3Days").val();
        club_open['e'] = $("#ClubOpenDay4Days").val();
        club_open['f'] = $("#ClubOpenDay5Days").val();
        club_open['g'] = $("#ClubOpenDay6Days").val();



        club_open_time['a'] = $("#ClubOpenDay0OpenTime").val();
        club_open_time['b'] = $("#ClubOpenDay1OpenTime").val();
        club_open_time['c'] = $("#ClubOpenDay2OpenTime").val();
        club_open_time['d'] = $("#ClubOpenDay3OpenTime").val();
        club_open_time['e'] = $("#ClubOpenDay4OpenTime").val();
        club_open_time['f'] = $("#ClubOpenDay5OpenTime").val();
        club_open_time['g'] = $("#ClubOpenDay6OpenTime").val();




        club_close_time['a'] = $("#ClubOpenDay0CloseTime").val();
        club_close_time['b'] = $("#ClubOpenDay1CloseTime").val();
        club_close_time['c'] = $("#ClubOpenDay2CloseTime").val();
        club_close_time['d'] = $("#ClubOpenDay3CloseTime").val();
        club_close_time['e'] = $("#ClubOpenDay4CloseTime").val();
        club_close_time['f'] = $("#ClubOpenDay5CloseTime").val();
        club_close_time['g'] = $("#ClubOpenDay6CloseTime").val();

        if ($("#ClubOpenDay0Status").is(':checked'))
            club_status['a'] = "Open";
        else
            club_status['a'] = "Closed";

        if ($("#ClubOpenDay1Status").is(':checked'))
            club_status['b'] = "Open";
        else
            club_status['b'] = "Closed";

        if ($("#ClubOpenDay2Status").is(':checked'))
            club_status['c'] = "Open";
        else
            club_status['c'] = "Closed";

        if ($("#ClubOpenDay3Status").is(':checked'))
            club_status['d'] = "Open";
        else
            club_status['d'] = "Closed";

        if ($("#ClubOpenDay4Status").is(':checked'))
            club_status['e'] = "Open";
        else
            club_status['e'] = "Closed";


        if ($("#ClubOpenDay5Status").is(':checked'))
            club_status['f'] = "Open";
        else
            club_status['f'] = "Closed";

        if ($("#ClubOpenDay6Status").is(':checked'))
            club_status['g'] = "Open";
        else
            club_status['g'] = "Closed";

        var club_open_json = JSON.stringify(club_open);
        var club_open_time_json = JSON.stringify(club_open_time);
        var club_close_time_json = JSON.stringify(club_close_time);
        var club_status_json = JSON.stringify(club_status);

        $.ajax({
            type: "POST",
            url: club_submit,
            data: {id: $("#club_id").val(), name: club_name, description: club_des, club_open: club_open_json, club_open_time: club_open_time_json, club_close_time: club_close_time_json, club_status: club_status_json}
        }).done(function(msg) {
            $("#Informations").html(msg)
        });
    })


    var wroot_path = ($("#w_root").val())
    // Load dialog on click
    $('#basic-modal #basic').click(function(e) {
        $('#basic-modal-content').modal();
        $("#exception_date").datepicker();
        $("#exception_date").datepicker("option", "dateFormat", "yy-mm-dd");
        return false;
    });

    $('#ajax_btn').click(function(e) {
        e.preventDefault();
        if ($("#exception_name").val() == "")
        {
            alert("Enter Exception Name");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "../ClubExceptions/add",
            data: {club_id: $("#ClubId").val(), exception_date: $("#exception_date").val(), exception_name: $("#exception_name").val(), open_time: $("#open_time").val(), close_time: $("#close_time").val(), status: $("#status option:selected").val()}
        }).done(function(msg) {
            $("#tbl_exception").html(msg);
            $.modal.close();
        });
        return false;
    });

    $('#admin_ajax_btn').click(function(e) {
        e.preventDefault();
        if ($("#exception_name").val() == "")
        {
            alert("Enter Exception Name");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "../admin/ClubExceptions/add",
            data: {club_id: $("#ClubId").val(), exception_date: $("#exception_date").val(), exception_name: $("#exception_name").val(), open_time: $("#open_time").val(), close_time: $("#close_time").val(), status: $("#status option:selected").val()}
        }).done(function(msg) {
            $("#tbl_exception").html(msg);
            $.modal.close();
        });
        return false;
    });

    function getDoc(frame) {
        var doc = null;
        // IE8 cascading access check
        try {
            if (frame.contentWindow) {
                doc = frame.contentWindow.document;
            }
        } catch (err) {
        }

        if (doc) { // successful getting content
            return doc;
        }

        try { // simply checking may throw in ie8 under ssl or mismatched protocol
            doc = frame.contentDocument ? frame.contentDocument : frame.document;
        } catch (err) {
            // last attempt
            doc = frame.document;
        }
        return doc;
    }

    $("#last").click(function(e) {

        return true;
    });

    $("#multiform").submit(function(e)
    {
        e.preventDefault();

        var formObj = $(this);
        var formURL = "../Clubs/uploaderNew";

        if (window.FormData !== undefined)  // for HTML5 browsers
        {

            var formData = new FormData(this);
            $.ajax({
                url: formURL,
                type: 'POST',
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data, textStatus, jqXHR)
                {

                    var obj = $.parseJSON(data);
                    var pathIm = (obj.path)
                    var xhref = '<a href="javascript:void(0)" onclick="make_profile(' + obj.id + ',' + $("#ClubId").val() + ')">Profile</a></div>';
                    var path = wroot_path + 'img/profile/' + pathIm;
                    $("#profile_img").append('<div class="span3 item"><img src="' + path + '" class="profile_img"  width="100" height="100"/ >' + xhref)
                },
                error: function(jqXHR, textStatus, errorThrown)
                {

                }
            });
            e.preventDefault();
        }
        else  //for olden browsers
        {
            //generate a random id
            var iframeId = 'unique' + (new Date().getTime());

            //create an empty iframe
            var iframe = $('<iframe src="javascript:false;" name="' + iframeId + '" />');

            //hide it
            iframe.hide();

            //set form target to iframe
            formObj.attr('target', iframeId);

            //Add iframe to body
            iframe.appendTo('body');
            iframe.load(function(e)
            {
                var doc = getDoc(iframe[0]);
                var docRoot = doc.body ? doc.body : doc.documentElement;
                var data = docRoot.innerHTML;
                //data is returned from server.

            });

        }

    });
    return false;
});


