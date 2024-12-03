@extends('layouts.main')
@section("content")
<style type="text/css">
    .fixed-header {
        position: sticky;
        top:0;
        z-index: 1
    }
</style>
<script type="text/javascript">
$(document).ready(function () {
    jQuery('#loader-bg').hide();
    
    var buttonWidth = "400";
    
    $('#client').multiselect({
        buttonWidth: buttonWidth,
        maxHeight: 700,
        enableFiltering: true,
        onDropdownShown: function(even) {
            this.$filter.find('.multiselect-search').focus();
        },
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
    });
    
    $('#project').multiselect({
        buttonWidth: buttonWidth,
        maxHeight: 700,
        enableFiltering: true,
        onDropdownShown: function(even) {
            this.$filter.find('.multiselect-search').focus();
        },
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
    });
    $('#status').multiselect({
        buttonWidth: buttonWidth,
        maxHeight: 700,        
    });
    $('#pic').multiselect({
        buttonWidth: 200,
        enableFiltering: true,
        maxHeight: 600,
        includeSelectAllOption: true,
    });
    $('#fye').multiselect({
        buttonWidth: 200,
        enableFiltering: true,
        onDropdownShown: function(even) {
            this.$filter.find('.multiselect-search').focus();
        },
        includeSelectAllOption: true,
    });
    $('#vic').multiselect({
        buttonWidth: 200,
        enableFiltering: true,
        onDropdownShown: function(even) {
            this.$filter.find('.multiselect-search').focus();
        },
        includeSelectAllOption: true,
    });
    $('#active_status').multiselect({
        buttonWidth: 200,
        enableFiltering: true,
        onDropdownShown: function(even) {
            this.$filter.find('.multiselect-search').focus();
        },
        includeSelectAllOption: true,
    });
    $('#regist_status').multiselect({
        buttonWidth: 200,
        enableFiltering: true,
        onDropdownShown: function(even) {
            this.$filter.find('.multiselect-search').focus();
        },
        includeSelectAllOption: true,
    });
    
    $('#xxx').tablesorter({
        widgets: ['zebra'],
        widgetOptions : {
            //scroller_height: setHeight(true),
            zebra : [ "normal-row", "alt-row" ]
        }
    });   
    
    setHeight("");
});

$(window).resize(function() {    
    setHeight("");
});

function setHeight(addHeight){    
    var windowHt = $(window).height();
    var setHt = windowHt - 270;
    if(addHeight != ""){
        setHt += addHeight;
    }
    $('#xxx').parent().css('max-height', setHt);      
}


function approveProject(obj,projectId,rowCnt){
    var objText = obj.innerText;
    var table = document.getElementById("project-list-body");
           
    $.ajax({
        url: "project-list/save/" + projectId + "/" + objText,
        dataType: "json",
        success: data => {
            
            if(objText == "Approve"){
                obj.innerText = "Unapprove";
                obj.style.cssText = "width: 80px;background-color: #DCDCDC";    
                table.rows[rowCnt - 1].cells[4].innerText = "Approved";
            } else {
                obj.innerText = "Approve";
                obj.style.cssText = "width: 80px;background-color: #337ab7";
                table.rows[rowCnt - 1].cells[4].innerText = "Approving";
            }
            
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: objText,
                showConfirmButton: false,
                timer: 1500
            });
        },        
    });    
}

function clearFilter() {
    var clientSelectedValue = document.getElementById("client").value;
    var projectSelectedValue = document.getElementById("project").value;
    var groupSelectedValue = document.getElementById("status").value;
    $('#client').multiselect('deselect', clientSelectedValue);
    $('#client').multiselect('select', "");
    $('#project').multiselect('deselect', projectSelectedValue);
    $('#project').multiselect('select', "");
    $('#status').multiselect('deselect', groupSelectedValue);
    $('#status').multiselect('select', "");

    $('#fye').multiselect('deselectAll', false);
    $('#fye').multiselect('updateButtonText');
    $('#vic').multiselect('deselectAll', false);
    $('#vic').multiselect('updateButtonText');
    $('#pic').multiselect('deselectAll', false);
    $('#pic').multiselect('updateButtonText');
    $('#active_status').multiselect('deselectAll', false);
    $('#active_status').multiselect('updateButtonText');
    $('#regist_status').multiselect('deselectAll', false);
    $('#regist_status').multiselect('updateButtonText');
}

function closeOverrall() {
    var imagesUrl = '{{ URL::asset('/image') }}';
    var acWidth = document.getElementById("filter_left").style.height;
    var btnObj = document.getElementById("btn_open_close");
    var closeArea = document.getElementById("close_area");
    
    if (acWidth == "30px") {
        btnObj.src = imagesUrl + "/close.png"
        document.getElementById("filter_left").style.height = "180px";  
        document.getElementById("second_area").style.height = "180px";          
        document.getElementById("third_area").style.height = "180px";          
        closeArea.style.height = "150px";  
        //document.getElementById("btn_open_close").style.cssText = "margin-top: 50px";   
        
        document.getElementById("filter_left").style.visibility = "visible";
        document.getElementById("second_area").style.visibility = "visible";
        document.getElementById("third_area").style.visibility = "visible";
        document.getElementById("add_new").style.visibility = "visible";
        setHeight("");
        
    } else {
        btnObj.src = imagesUrl + "/open.png"
        document.getElementById("filter_left").style.height = "30px";
        document.getElementById("second_area").style.height = "30px";
        document.getElementById("third_area").style.height = "30px";
        //document.getElementById("btn_open_close").style.cssText = "margin-top: 0px";     
        closeArea.style.height = "30px";  
        document.getElementById("filter_left").style.visibility = "hidden";  
        document.getElementById("second_area").style.visibility = "hidden";  
        document.getElementById("third_area").style.visibility = "hidden";  
        document.getElementById("add_new").style.visibility = "hidden";
        setHeight(140);
    }   
    
}

function loadData(){
    var client = $("#client").val();
    var project = $("#project").val();
    var status = $("#status").val();
    var pic = $("#pic").val();
    var fye = $("#fye").val();
    var vic = $("#vic").val();
    var active_status = $("#active_status").val();
    var regist_status = $("#regist_status").val();
    
    if(client == ""){
        client = "blank";
    }
    if(project == ""){
        project = "blank";
    }
    if(status == ""){
        status = "blank";
    }
    if(pic == null){
        pic = "blank";
    }
    if(fye == null){
        fye = "blank";
    }
    if(vic == null){
        vic = "blank";
    }
    if(active_status == null){
        active_status = "blank";
    }
    if(regist_status == null){
        regist_status = "blank";
    }
    
    $.ajax({
        url: "/master/project-list/" + client + "/" + project + "/" + status + "/" + pic + "/" + fye + "/" + vic + "/" + active_status + "/" + regist_status ,
    }).done(function (data) {        
        $("#project-list-body").empty();
        
        for (var cnt = 0; cnt < data.listData.length; cnt++) {
            //regist, not regist絞込
            var isExist = getProjectTaskExistStatus(data.listData[cnt]["project_id"], data.existTask);
            if(regist_status != null && regist_status.length == 1){
                if(regist_status[0] == "0" && isExist == false){
                    continue;
                }else if(regist_status[0] == "1" && isExist == true){
                    continue;
                }
            }
            insertProjectListRow(data.listData[cnt]["client_id"], data.listData[cnt]["project_id"], data.listData[cnt]["client_name"], data.listData[cnt]["project_name"], data.listData[cnt]["is_approval"], data.listData[cnt]["pic"], data.listData[cnt]["is_archive"],isExist);
        }      
        
        $('#xxx').trigger("update");
   

    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
        //alert('error!!!');
        console.log("XMLHttpRequest : " + XMLHttpRequest.status);
        console.log("textStatus     : " + textStatus);
        console.log("errorThrown    : " + errorThrown.message);
    });
}

function getProjectTaskExistStatus(targetProjectId, projectTaskData){
    
    var isExist = false;
    for(var i=0; i<projectTaskData.length; i++){
        if(projectTaskData[i]["project_id"] == targetProjectId){
            isExist = true;
            break;
        }
    }
    return isExist;
}

function insertProjectListRow(clientId, projectId, clientName, projectName, status, pic, isArchive, isExist) {
    // 最終行に新しい行を追加
    var specific_tbody = document.getElementById("project-list-body");
    var bodyLength = specific_tbody.rows.length;
    var count = bodyLength + 1;
    var row = specific_tbody.insertRow(bodyLength);
    var isApprove = document.getElementById("is-approve").value;

    var archiveStatus = "Active";
    if(isArchive == "1"){
        archiveStatus = "Archived";
    }

    var taskExistStatus = "Not Registered";
    if(isExist){
        taskExistStatus = "Registered";
    }
    
    // 列の追加
    var c1 = row.insertCell(0);
    var c2 = row.insertCell(1);    
    var c7 = row.insertCell(2);
    var c3 = row.insertCell(3);
    var c4 = row.insertCell(4);
    var c5 = row.insertCell(5);
    //if(isApprove == 1){
        var c6 = row.insertCell(6);
    //}
    var c8 = row.insertCell(7);
    var c9 = row.insertCell(8);
    
    // 各列に表示内容を設定
    c1.innerHTML = '<a href="project/' + clientId + '/' + projectName + '"' + ' target="_blank"><img src="' + '{{ URL::asset('/image') }}' + '/view.png"></a>';
    c2.innerHTML = '<span>' + projectId + '</span>';
    c7.innerHTML = '<span>' + pic + '</span>';
    c3.innerHTML = '<span>' + clientName + '</span>';
    c4.innerHTML = '<span>' + projectName + '</span>';   
    /*if(isApprove == 1){
        if(status != 1){
            c6.innerHTML = '<button class="btn btn-xs btn-primary" style="width: 61px" onclick="approveProject(this,' + projectId + ')">Approve</button>';
        }else {        
            c6.innerHTML = '<button class="btn btn-xs btn-primary" style="width: 61px;background-color: #DCDCDC" onclick="approveProject(this,' + projectId + ')" disabled>Approved</button>';
        }        
    }else {      
        if(status != 1){
            c5.innerHTML = '<span>Approving</span>';
        }else {        
            c5.innerHTML = '<span>Approved</span>';
        }  
    }*/
     if(status != 1){
         c5.innerHTML = '<span>Approving</span>';
         if(isApprove == 1){
             c6.innerHTML = '<button class="btn btn-xs btn-primary" style="width: 80px" onclick="approveProject(this,' + projectId + "," + count + ')">Approve</button>';
         }
     }else {
         c5.innerHTML = '<span>Approved</span>';
         if(isApprove == 1){
             c6.innerHTML = '<button class="btn btn-xs btn-primary" style="width: 80px;background-color: #DCDCDC" onclick="approveProject(this,' + projectId + "," + count + ')">Unapprove</button>';
         }
     }
     c8.innerHTML = '<span>' + archiveStatus + '</span>';
     c9.innerHTML = '<span>' + taskExistStatus + '</span>';
    
}

/*
function setProjectData(){
    
    var client = $('#client').val();
    if(client == ""){
        client = "blank";
    }    
    
    $.ajax({
        url: "/project/data/" + client + "/",
    }).done(function (data) {        
        $('#project').children().remove();
        var project = document.getElementById('project');
        document.createElement('option')
        var option = document.createElement('option');
        option.setAttribute('value', "blank");
        option.innerHTML = "&nbsp;";
        project.appendChild(option);
        for(var i = 0; i < data.projectData.length; i++){
            var option = document.createElement('option');
            option.setAttribute('value', data.projectData[i].project_name);
            option.innerHTML = data.projectData[i].project_name;
            project.appendChild(option);
        };
        
        $('#project').multiselect('rebuild');    

    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
        //alert('error!!!');
        console.log("XMLHttpRequest : " + XMLHttpRequest.status);
        console.log("textStatus     : " + textStatus);
        console.log("errorThrown    : " + errorThrown.message);
    });    
    
}
*/
</script>
<div id="div1" style="margin-left: 20px;margin-top: 20px">
    <!--<form method="GET" action="{{ url("master/project-list") }}" accept-charset="UTF-8" role="search">-->
    <div id="filter_left" style="float: left;height: 180px;margin-bottom: 0px;">
        <div class="row entry-filter-bottom" style="zoom: 100%">
            <div class="col col-md-2" >
                <span class="line-height">Client</span>
            </div>
            <div class="col col-md-8">
                <select id="client" name="client" class="form-control select2" data-display="static" onchange="setProjectData(false)">    
                    <option value="">&nbsp;</option>
                    @foreach ($clientList as $clients)
                    <option value="{{$clients->id}}">{{$clients->name}}</option>
                    @endforeach
                </select>
            </div>
            
        </div>

        <div class="row entry-filter-bottom" style="zoom: 100%">
            <div class="col col-md-2">
                <span class="line-height">Project</span>
            </div>
            <div class="col col-md-1">
                <select id="project" name="project" style="width: 200px" class="form-control">     
                    <option value="">&nbsp;</option>
                    @foreach ($projectList as $projects)
                    <option value="{{$projects->project_name}}">{{$projects->project_name}}</option>
                    @endforeach
                </select>
            </div>                
        </div>

        <div class="row entry-filter-bottom" style="zoom: 100%">
            <div class="col col-md-2">
                <span class="line-height">Status</span>
            </div>
            <div class="col col-md-1">
                <select id="status" name="status" style="width: 200px" class="form-control">     
                    <option value="">&nbsp;</option>
                    <option value="1">Approved</option>  
                    <option value="0">Unapproved</option>  
                </select>
            </div>                
        </div>
        <!--<div class="input-group">       
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                    <span>Search</span>
                </button>
            </span>
        </div>-->
        <div class="row entry-filter-bottom">                           
            <div class="col col-md-2" >
                <input type="button" id="clear" class="btn btn-default" value="Clear" onclick="clearFilter()" style="background-color: white;width: 150px;margin-left: 109px">
            </div>
            <div class="col col-md-1" style="margin-left: 180px;" >
                <!--<button class="btn btn-primary" type="submit" style="width: 150px">
                    <span>Search</span>
                </button>-->
                <input class="btn btn-primary" type="button" value="Search" style="width: 150px" onclick="loadData()">
            </div>            
        </div>
    </div>

    <div id="second_area" style="float: left;">
        <div class="row entry-filter-bottom" style="zoom: 100%">
            <div class="col col-md-2">
                <span class="line-height">PIC</span>
            </div>
            <div class="col col-md-7">                
                <select id="pic" name="pic" multiple="multiple" class="form-control">                            
                    @foreach ($picData as $pics)                    
                    <option value="{{$pics->id}}">{{$pics->initial}}</option>
                    @endforeach
                </select>
            </div>            
        </div>

        <div class="row entry-filter-bottom" style="zoom: 100%">
            <div class="col col-md-2">
                <span class="line-height">FYE</span>
            </div>
            <div class="col col-md-1">
                <select id="fye" name="fye" class="form-control" multiple="multiple" >                            
                    <option value="1">1/31</option>
                    <option value="2">2/28</option>
                    <option value="3">3/31</option>
                    <option value="4">4/30</option>
                    <option value="5">5/31</option>
                    <option value="6">6/30</option>
                    <option value="7">7/31</option>
                    <option value="8">8/31</option>
                    <option value="9">9/30</option>
                    <option value="10">10/31</option>
                    <option value="11">11/30</option>
                    <option value="12">12/31</option>
                </select>
            </div>
        </div>       

        <div class="row entry-filter-bottom" style="zoom: 100%">
            <div class="col col-md-2">
                <span class="line-height">VIC</span>
            </div>
            <div class="col col-md-1">
                <select id="vic" name="vic" multiple="multiple" class="form-control" >                            
                    <option value="1">VIC</option>
                    <option value="2">IC</option>
                    <option value="3">C</option>
                </select>
            </div>
        </div>
        
       <a href="{{ url("/master/project/") }}" class="btn btn-primary" target="_blank" type="button" id="add_new" style="margin-top: 0px;margin-left: 50px;width: 100px" onclick="">Add New</a>
    </div>

    <div id="third_area" style="float: left;margin-left: 100px;width: 450px">
        <div class="row entry-filter-bottom" style="zoom: 100%">
            <div class="col col-md-3">
                <span class="line-height">Active</span>
            </div>
            <div class="col col-md-1">
                <select id="active_status" name="active_status" multiple="multiple" class="form-control" >                                                
                    <option value="0">Active</option>
                    <option value="1">Archive</option>
                </select>
            </div>
        </div>
        <div class="row entry-filter-bottom" style="zoom: 100%">
            <div class="col col-md-3">
                <span class="line-height">Phase Tasks</span>
            </div>
            <div class="col col-md-1">
                <select id="regist_status" name="regist_status" multiple="multiple" class="form-control" >                                                
                    <option value="0">Registered</option>
                    <option value="1">Not Registered</option>
                </select>
            </div>
        </div>
    </div>
    <div id="close_area" style="float: left;">
        <input type="image" id="btn_open_close" src="{{ URL::asset('/image') }}/close.png" onclick="closeOverrall();return;" style="height: 20px;width: 20px;margin-left: 0px;margin-top: 5px">
       <br><br><br><br><br>              
    </div>
<!--</form>-->
    

<!--<br/>
<br/>-->

<div style="clear: both"></div>
<div class="table-responsive" style="height: 3000px">    
    <table id="xxx" class="table table-borderless" style="font-family: Source Sans Pro;font-size: 14px;width: 850px">
        <thead>                                
            <tr>
                <th class="fixed-header" style="width: 50px">Link</th>
                <th class="fixed-header" style="width: 100px;">Project ID</th>
                <th class="fixed-header" style="width: 50px;">PIC</th>
                <th class="fixed-header" style="width: 200px;">Client</th>
                <th class="fixed-header" style="width: 200px;">Project</th>                
                <th class="fixed-header" style="width: 50px;text-align: center">Status</th>                   
                <th class="fixed-header" style="width: 100px;text-align: center">Approve</th>                                                    
                <th class="fixed-header" style="width: 50px;text-align: center">Archive</th>   
                <th class="fixed-header" style="width: 150px;text-align: center">Task Registered</th>   
            </tr>
        </thead>
        <tbody id="project-list-body"></tbody>
    </table>

</div>
            <input type="hidden" id="is-approve" name="is-approve" value="{{$isApprove}}">
</div>

                <!--</div>
            </div>
        </div>
    </div>
</div>-->
@endsection
