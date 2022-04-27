$(function() {

    var email = $("#ses_email").val();
    var FID = $("#ses_FID").val();
    var isLogged = $("#ses_issLogged").val();

    function load_cmt() {
        $.ajax({
            url: "./partials/load_cmt.php",
            type: 'post',
            data: {
                FID: FID,
                email: email,
                isLogged: isLogged
            },
            success: function(data) {
                $("#cmt_section").html(data);
            }
        });
    }

    get_movie = function() {
        $.ajax({
            url: "./partials/get_movie.php",
            type: "post",
            data: {
                FID: FID
                    // email: email
            },
            success: function(data) {
                $("#watch_box").html(data);
            }
        });
    }
    get_movie();
    load_cmt();
    setInterval(() => {
        load_cmt();
    }, 60000);
    $("#btn_post_cmt").on("click", function(event) {
        event.preventDefault();
        var FID = $("#FID").val();
        var email = $("#email").val();
        var msg = $("#cmt_msg").val();
        msg = msg.replace(/(\r\n|\n|\r)/gm, " ");

        // console.log(cmt_date);
        $.ajax({
            url: "./partials/set_cmt.php",
            type: "POST",
            data: {
                FID: FID,
                email: email,
                msg: msg,
            },
            success: function(e) {
                if (e == 1) {
                    load_cmt();
                    $("#post_cmt").trigger("reset");
                } else {
                    alert("CMT fail");
                }
            }

        });

    });

    chunkSubstr = function(str, size) {
        const numChunks = Math.ceil(str.length / size)
        const chunks = new Array(numChunks)

        for (let i = 0, o = 0; i < numChunks; ++i, o += size) {
            chunks[i] = str.substr(o, size) + " ";
        }

        return chunks;
    }
    del_cmt = function(CID) {
        $("#delete_cmt_confirm").modal("show");
        $("#del_confirmed").on("click", function() {
            $.ajax({
                url: "./partials/del_cmt.php",
                type: 'post',
                data: {
                    CID: CID
                },
                success: function(e) {
                    if (e == 1) {
                        load_cmt();
                    } else {
                        alert("Delete fail");
                    }
                }
            });
        })

    }
    show_edit_box = function(CID, msg) {
        var edit_ID = "#cmt_edit_" + CID;
        var edit_box = "<input type='hidden' id='editting_CID' value='" + CID + "'>" +
            "<div class='row' id='editting_cmt' style='height: auto'>" +
            "<div class='col-9' style='padding-right: 0px'>" +
            "<textarea class='form-control cmt__edit_box' name='' id='editting_msg'>" + msg + "</textarea> </div>" +
            // "<input type='text' id='editing_msg' class='form-control cmt__edit_box' value='" + msg + "' autocomplete='off'></div>" +
            "<div class='col-3' style='padding:2px; margin: auto 0;'>" +
            "<button type='submit' class='sub_edit_cmt' id='submit_edit'>Save Edit</button>" +
            "<button type='button' onclick='call_cancel_edit(\"" + CID + "\")' class='sub_edit_cmt' id='cancel_edit" + CID + "'>Cancel</button>" +
            "</div> </div>";
        if (!($("#editting_cmt").length)) {
            $(edit_ID).append(edit_box);
            $("#editting_msg").on("click", function() {
                $(this).css('height', "27px");
                $(this).css('height', this.scrollHeight + "px");
            });
            $("#editting_msg").on("input", function(event) {
                $(this).css('height', "27px");
                $(this).css('height', this.scrollHeight + "px");
                if (event.keyCode == 13) {
                    this.style.height = 'auto';
                    $("#submit_edit").trigger("click");
                }
            });
        }
        $("#submit_edit").on("click", function(event) {
            event.preventDefault();
            var CID = $("#editting_CID").val();
            var cmt_date = $("#edit_cmt_date_" + CID).val();
            var msg = '';
            if ($("#editting_msg").val().length > 0) {
                msg = $("#editting_msg").val();
                msg = msg.replace(/(\r\n|\n|\r)/gm, "");
            }
            if (msg == '') {
                del_cmt(CID);
            } else {
                $.ajax({
                    url: "./partials/edit_cmt.php",
                    type: 'post',
                    data: {
                        CID: CID,
                        cmt_date: cmt_date,
                        msg: msg
                    },
                    success: function(event) {
                        if (event == 1) {
                            load_cmt();
                        } else {
                            alert("Code ngu");
                        }
                    }
                });
            }

        });
    }
    call_cancel_edit = function() {
        $("#editting_cmt").remove();
    }


    $("#cmt_msg").on("keyup", function(event) {
        // this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';

        if (event.keyCode == 13) {
            $("#btn_post_cmt").trigger("click");
            this.style.height = "1em";

        }
    });


});