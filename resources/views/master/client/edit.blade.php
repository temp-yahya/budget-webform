@extends('layouts.main')
@section("content")

<script type="text/javascript">
    $(document).ready(function () {
        jQuery('#loader-bg').hide();

        $('#group_companies').multiselect({
            buttonWidth: "200px",
            maxHeight: 700,
            onDropdownShown: function(even) {
                this.$filter.find('.multiselect-search').focus();
            },
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            includeSelectAllOption: true,
        });

        //approvedの場合は編集不可
        if(document.getElementById("approve_status").value == "1"){
            $("#clientForm").find('input,textarea,select,button').prop('disabled', true);
            document.getElementById("btn_approve").disabled = false;
        }
    });
   
    function AddNewGroupCompany() {        
        $('#group_companies').multiselect('select','');        
        document.getElementById("group_add_text").readOnly = false;
        document.getElementById("group_add_text").focus();
    }

    function appendContactRow() {
        var objTBL = document.getElementById("contact_list");
        if (!objTBL)
            return;

        insertContactRow("", "", "", true);
    }
    
    function appendUsRow() {
        var objTBL = document.getElementById("us_shareholder_list");
        if (!objTBL)
            return;

        insertUsShareholderRow("", "", "", true);
    }
    
    function appendForeignRow() {
        var objTBL = document.getElementById("foreign_shareholder_list");
        if (!objTBL)
            return;

        insertForeignShareholderRow("", "", "", true);
    }
    
    function appendOfficerRow() {
        var objTBL = document.getElementById("officer_table_list");
        if (!objTBL)
            return;

        insertOfficerRow("", "", "", true);
    }

    function appendDomainRow(){
        var objTBL = document.getElementById("domain_list");
        if (!objTBL)
            return;

        insertDomainRow("", "", "", true);
    }

    function insertDomainRow(name, status, taskId, isNew) {
        // 最終行に新しい行を追加
        var domain_tbody = document.getElementById("domain_body");
        var bodyLength = domain_tbody.rows.length;
        var count = bodyLength + 1;
        var row = domain_tbody.insertRow(bodyLength);

        var imagesUrl = '{{URL::asset('/image')}}';

        // 列の追加
        var c1 = row.insertCell(0);
        var c2 = row.insertCell(1);
        var c3 = row.insertCell(2);
        var c4 = row.insertCell(3);
        var c5 = row.insertCell(4);

        var seqnoSpan = document.createElement("span");
        seqnoSpan.classList.add("seqno-contact");
        seqnoSpan.textContent = count;
        c1.style.verticalAlign = "middle";
        c1.style.textAlign = "center";
        c1.appendChild(seqnoSpan);

        c2.style.verticalAlign = "middle";
        c2.style.textAlign = "center";
        c2.textContent = '@';

        var button = document.createElement("input");
        button.type = "button";
        button.id = "is_registered" + count;
        button.name = "is_registered" + count;
        button.value = "Registered";
        button.style.width = "100%";
        button.classList.add("form-control", "inpcontactjp","btn","btn-primary");
        c4.appendChild(button);

        // 各列に表示内容を設定
        //c1.innerHTML = '<span class="seqno-contact">' + count + '</span>';        
        c3.innerHTML = '<input class="form-control inptitle" type="text" id="domain' + count + '" name="domain' + count + '" value="" style="width: 100%">';        
        c5.innerHTML = '<button class="delbtn btn btn-sm" type="button" id="delBtnContact' + count + '" value="Delete" onclick="return deleteContactRow(this)" style="background-color: transparent"><img src="' + imagesUrl + "/delete.png" + '"></button>';
    }

    function insertContactRow(name, status, taskId, isNew) {
        // 最終行に新しい行を追加
        var contact_tbody = document.getElementById("contact_person_body");
        var bodyLength = contact_tbody.rows.length;
        var count = bodyLength + 1;
        var row = contact_tbody.insertRow(bodyLength);

        var imagesUrl = '{{URL::asset('/image')}}';

        // 列の追加
        var c1 = row.insertCell(0);
        var c2 = row.insertCell(1);
        var c3 = row.insertCell(2);
        var c4 = row.insertCell(3);
        var c5 = row.insertCell(4);
        var c6 = row.insertCell(5);
        var c7 = row.insertCell(6);
        var c8 = row.insertCell(7);
        var c9 = row.insertCell(8);

        // 各列に表示内容を設定
        c1.innerHTML = '<span class="seqno-contact">' + count + '</span>';
        c2.innerHTML = '<input class="form-control inpcontact" type="text" id="contact_person' + count + '" name="contact_person' + count + '" value="" style="width: 100%">';
        c3.innerHTML = '<input class="form-control inptitle" type="text" id="title' + count + '" name="title' + count + '" value="" style="width: 100%">';
        c4.innerHTML = '<input class="form-control inpcontactjp" type="text" id="contact_person_jp' + count + '" name="contact_person_jp' + count + '" value="" style="width: 100%">';
        c5.innerHTML = '<input class="form-control inptelephone" type="text" id="telephone' + count + '" name="telephone' + count + '" value="" style="width: 100%">';
        c6.innerHTML = '<input class="form-control inpcellphone" type="text" id="cellphone' + count + '" name="cellphone' + count + '" value="" style="width: 100%">';
        c7.innerHTML = '<input class="form-control inpfax" type="text" id="fax' + count + '" name="fax' + count + '" value="" style="width: 100%">';
        c8.innerHTML = '<input class="form-control inpemail" type="text" id="email' + count + '" name="email' + count + '" value="" style="width: 100%">';
        c9.innerHTML = '<button class="delbtn btn btn-sm" type="button" id="delBtnContact' + count + '" value="Delete" onclick="return deleteContactRow(this)" style="background-color: transparent"><img src="' + imagesUrl + "/delete.png" + '"></button>';
    }
    
    function insertUsShareholderRow(name, status, taskId, isNew) {
        // 最終行に新しい行を追加
        var us_tbody = document.getElementById("us_shareholder_body");
        var bodyLength = us_tbody.rows.length;
        var count = bodyLength + 1;
        var row = us_tbody.insertRow(bodyLength);

        var imagesUrl = '{{URL::asset('/image')}}';

        // 列の追加
        var c1 = row.insertCell(0);
        var c2 = row.insertCell(1);
        var c3 = row.insertCell(2);
        var c4 = row.insertCell(3);
        
        // 各列に表示内容を設定
        c1.innerHTML = '<span class="seqno-usshareholder">' + count + '</span>';
        c2.innerHTML = '<input class="form-control inpusname" type="text" id="us_name' + count + '" name="us_name' + count + '" value="" style="width: 100%">';
        c3.innerHTML = '<input class="form-control inpuspercent" type="text" id="us_percent' + count + '" name="us_percent' + count + '" value="" style="width: 100%">';        
        c4.innerHTML = '<button class="delusbtn btn btn-sm" type="button" id="delBtnUs' + count + '" value="Delete" onclick="return deleteUsRow(this)" style="background-color: transparent"><img src="' + imagesUrl + "/delete.png" + '"></button>';
    }
    
    function insertForeignShareholderRow(name, status, taskId, isNew) {
        // 最終行に新しい行を追加
        var foreign_tbody = document.getElementById("foreign_shareholder_body");
        var bodyLength = foreign_tbody.rows.length;
        var count = bodyLength + 1;
        var row = foreign_tbody.insertRow(bodyLength);

        var imagesUrl = '{{URL::asset('/image')}}';

        // 列の追加
        var c1 = row.insertCell(0);
        var c2 = row.insertCell(1);
        var c3 = row.insertCell(2);
        var c4 = row.insertCell(3);
        
        // 各列に表示内容を設定
        c1.innerHTML = '<span class="seqno-foreignshareholder">' + count + '</span>';
        c2.innerHTML = '<input class="form-control inpforeignname" type="text" id="foreign_name' + count + '" name="foreign_name' + count + '" value="" style="width: 100%">';
        c3.innerHTML = '<input class="form-control inpforeignpercent" type="text" id="foreign_percent' + count + '" name="foreign_percent' + count + '" value="" style="width: 100%;text-align: right">';        
        c4.innerHTML = '<button class="delforeignbtn btn btn-sm" type="button" id="delBtnForeign' + count + '" value="Delete" onclick="return deleteForeignRow(this)" style="background-color: transparent"><img src="' + imagesUrl + "/delete.png" + '"></button>';
    }
    
    function insertOfficerRow(name, status, taskId, isNew) {
        // 最終行に新しい行を追加
        var officers_tbody = document.getElementById("officers_body");
        var bodyLength = officers_tbody.rows.length;
        var count = bodyLength + 1;
        var row = officers_tbody.insertRow(bodyLength);

        var imagesUrl = '{{URL::asset('/image')}}';

        // 列の追加
        var c1 = row.insertCell(0);
        var c2 = row.insertCell(1);
        var c3 = row.insertCell(2);
        var c4 = row.insertCell(3);
        
        // 各列に表示内容を設定
        c1.innerHTML = '<span class="seqno-officer">' + count + '</span>';
        c2.innerHTML = '<input class="form-control inpofficername" type="text" id="officer_name' + count + '" name="officer_name' + count + '" value="" style="width: 100%">';
        c3.innerHTML = '<input class="form-control inpofficertitle" type="text" id="officer_title' + count + '" name="officer_title' + count + '" value="" style="width: 100%;">';        
        c4.innerHTML = '<button class="delofficerbtn btn btn-sm" type="button" id="delBtnOfficer' + count + '" value="Delete" onclick="return deleteOfficerRow(this)" style="background-color: transparent;width: 100%"><img src="' + imagesUrl + "/delete.png" + '"></button>';
    }

    function deleteContactRow(obj) {
        delRowCommon(obj, "seqno-contact");

        // id/name ふり直し
        var tagElements = document.getElementsByTagName("input");
        if (!tagElements)
            return false;

        var seq = 1;
        reOrderElementTag(tagElements, "inpcontact", "contact_person");
        reOrderElementTag(tagElements, "inptitle", "title");
        reOrderElementTag(tagElements, "inpcontactjp", "contact_person_jp");
        reOrderElementTag(tagElements, "inptelephone", "telephone");
        reOrderElementTag(tagElements, "inpcellphone", "cellphone");
        reOrderElementTag(tagElements, "inpfax", "fax");
        reOrderElementTag(tagElements, "inpemail", "email");

        reOrderElementTag(tagElements, "delbtn", "delBtn");

        //reOrderTaskNo();
    }
    
    function deleteUsRow(obj) {
        delRowCommon(obj, "seqno-usshareholder");

        // id/name ふり直し
        var tagElements = document.getElementsByTagName("input");
        if (!tagElements)
            return false;

        var seq = 1;
        reOrderElementTag(tagElements, "inpusname", "us_name");
        reOrderElementTag(tagElements, "inpuspercent", "us_percent");        
        
        reOrderElementTag(tagElements, "delusbtn", "delBtnUs");

        //reOrderTaskNo();
    }
    
    function deleteForeignRow(obj) {
        delRowCommon(obj, "seqno-foreignshareholder");

        // id/name ふり直し
        var tagElements = document.getElementsByTagName("input");
        if (!tagElements)
            return false;

        var seq = 1;
        reOrderElementTag(tagElements, "inpforeignname", "foreign_name");
        reOrderElementTag(tagElements, "inpforeignpercent", "foreign_percent");        
        
        reOrderElementTag(tagElements, "delforeignbtn", "delBtnForeign");

        //reOrderTaskNo();
    }
    
    function deleteOfficerRow(obj) {
        delRowCommon(obj, "seqno-officer");

        // id/name ふり直し
        var tagElements = document.getElementsByTagName("input");
        if (!tagElements)
            return false;

        var seq = 1;
        reOrderElementTag(tagElements, "inpofficername", "officer_name");
        reOrderElementTag(tagElements, "inpofficertitle", "officer_title");        
        
        reOrderElementTag(tagElements, "delofficerbtn", "delBtnOfficer");

        //reOrderTaskNo();
    }

    function delRowCommon(obj, seqNoId) {
        // 確認
        if (!confirm("この行を削除しますか？"))
            return;

        if (!obj)
            return;

        var objTR = obj.parentNode.parentNode;
        var objTBL = objTR.parentNode;

        if (objTBL)
            objTBL.deleteRow(objTR.sectionRowIndex);

        // <span> 行番号ふり直し
        var tagElements = document.getElementsByTagName("span");
        if (!tagElements)
            return false;

        var seq = 1;
        for (var i = 0; i < tagElements.length; i++)
        {
            //if (tagElements[i].className.match(seqno))
            if (tagElements[i].className === seqNoId)
                tagElements[i].innerHTML = seq++;
        }
    }

    function reOrderElementTag(tagElements, className, idName) {
        var seq = 1;
        for (var i = 0; i < tagElements.length; i++)
        {
            if (tagElements[i].className.match(className)) {
                tagElements[i].setAttribute("id", idName + seq);
                tagElements[i].setAttribute("name", idName + seq);
                ++seq;
            }
        }
    }
    
    function isCheckClientError() {
         //妥当性　エラーチェック        
        var isError = false;
        var errorMessage = "";
        var strRequired = "required<br>";
        var strLength = "characters<br>";
        var name = $("#name").val();
        var fye = $("#fye").val();      
        var vic = $("#vic_status").val();
        var address = $("#address_us").val();
        var mAddress = $("#mailing_address").val();
        var tel = $("#tel1").val();
        var defaultColor = "transparent";
        var errorColor = "red";
        /*
        $("#name").css("background-color",defaultColor);
        if(name == ""){
            isError = true;
            $("#name").css("background-color",errorColor);
        }
        
        $("#fye").css("background-color",defaultColor);
        if(fye == ""){
            isError = true;
            $("#fye").css("background-color",errorColor);
        }
        
        $("#vic_status").css("background-color",defaultColor);
        if(vic == ""){
            isError = true;
            $("#vic_status").css("background-color",errorColor);
        }
        
        $("#address_us").css("background-color",defaultColor);
        if(address == ""){
            isError = true;
            $("#address_us").css("background-color",errorColor);
        }
        
        $("#mailing_address").css("background-color",defaultColor);
        if(mAddress == ""){
            isError = true;
            $("#mailing_address").css("background-color",errorColor);
        }
        
        $("#tel1").css("background-color",defaultColor);
        if(tel == ""){
            isError = true;
            $("#tel1").css("background-color",errorColor);
        }*/
        //桁数取得        
        var clientTypeList = JSON.parse(document.getElementById("client_type_list").value);
        //name
        $("#name").css("background-color",defaultColor);        
        if(name == ""){            
            isError = true;
            $("#name").css("background-color",errorColor);
            errorMessage += "name : " + strRequired;
        }
        if(name.length > parseInt(clientTypeList.client["name"])){
            isError = true;
            $("#name").css("background-color",errorColor); 
            errorMessage += "name : " + parseInt(clientTypeList.client["name"]) + strLength;           
        }

        //fye
        $("#fye").css("background-color",defaultColor);
        if(fye == ""){
            isError = true;
            $("#fye").css("background-color",errorColor);
            errorMessage += "FYE : " + strRequired;
        }
        
        //vic
        $("#vic_status").css("background-color",defaultColor);
        if(vic == ""){
            isError = true;
            $("#vic_status").css("background-color",errorColor);
            errorMessage += "vic : " + strRequired;
        }

        //group companies
        $("#group_companies").css("background-color",defaultColor);
        var groupCompanies = $("#group_companies").val();
        if(groupCompanies.length > parseInt(clientTypeList.client["group_companies"])){
            isError = true;
            $("#group_companies").css("background-color",errorColor);
            errorMessage += "Group Companies : " + parseInt(clientTypeList.client["group_companies"]) + strLength;
        }               

        //website
        $("#website").css("background-color",defaultColor);
        var website = $("#website").val();
        if(website.length > parseInt(clientTypeList.client["website"])){
            isError = true;
            $("#website").css("background-color",errorColor);
            errorMessage += "website : " + strRequired;
        }   
        
        //address us
        $("#address_us").css("background-color",defaultColor);
        if(address == ""){
            isError = true;
            $("#address_us").css("background-color",errorColor);
            errorMessage += "address us : " + strRequired;
        }
              
        if(address.length > parseInt(clientTypeList.client["address_us"])){
            isError = true;
            $("#address_us").css("background-color",errorColor);
            errorMessage += "address us : " + parseInt(clientTypeList.client["address_us"]) + strLength;           
        }   

        //address jp
        $("#address_jp").css("background-color",defaultColor);
        var addressJp = $("#address_jp").val();
        if(addressJp.length > parseInt(clientTypeList.client["address_jp"])){
            isError = true;
            $("#address_jp").css("background-color",errorColor);
            errorMessage += "address jp : " + strRequired;
        }  
        
        //mailing address
        $("#mailing_address").css("background-color",defaultColor);
        if(mAddress == ""){
            isError = true;
            $("#mailing_address").css("background-color",errorColor);
            errorMessage += "mailing address : " + strRequired;
        }

        if(mAddress.length > parseInt(clientTypeList.client["mailing_address"])){
            isError = true;
            $("#mailing_address").css("background-color",errorColor);
            errorMessage += "mailing address : " + parseInt(clientTypeList.client["mailing_address"]) + strLength;           
        }   

        //tel1
        $("#tel1").css("background-color",defaultColor);
        if(tel == ""){
            isError = true;
            $("#tel1").css("background-color",errorColor);
            errorMessage += "tel1 : " + strRequired;
        }

        //tel2
        $("#tel2").css("background-color",defaultColor);
        var tel2 = $("#tel2").val();
        if(tel2.length > parseInt(clientTypeList.client["tel2"])){
            isError = true;
            $("#tel2").css("background-color",errorColor);
            errorMessage += "tel2 : " + parseInt(clientTypeList.client["tel2"]) + strLength;           
        }  

        //tel3
        $("#tel3").css("background-color",defaultColor);
        var tel3 = $("#tel3").val();
        if(tel3.length > parseInt(clientTypeList.client["tel3"])){
            isError = true;
            $("#tel3").css("background-color",errorColor);
            errorMessage += "tel3 : " + parseInt(clientTypeList.client["tel3"]) + strLength;           
        }  

        //fax
        $("#fax").css("background-color",defaultColor);
        var fax = $("#fax").val();
        if(fax.length > parseInt(clientTypeList.client["fax"])){
            isError = true;
            $("#fax").css("background-color",errorColor);
        }  

        //federal id
        $("#federal_id").css("background-color",defaultColor);
        var federalId = $("#federal_id").val();
        if(federalId.length > parseInt(clientTypeList.client["federal_id"])){
            isError = true;
            $("#federal_id").css("background-color",errorColor);
            errorMessage += "federal id : " + parseInt(clientTypeList.client["federal_id"]) + strLength;           
        } 

        //state id
        $("#state_id").css("background-color",defaultColor);
        var stateId = $("#state_id").val();
        if(stateId.length > parseInt(clientTypeList.client["state_id"])){
            isError = true;
            $("#state_id").css("background-color",errorColor);
            errorMessage += "state id : " + parseInt(clientTypeList.client["state_id"]) + strLength;           
        } 

        //edd id
        $("#edd_id").css("background-color",defaultColor);
        var eddId = $("#edd_id").val();
        if(eddId.length > parseInt(clientTypeList.client["edd_id"])){
            isError = true;
            $("#edd_id").css("background-color",errorColor);
            errorMessage += "edd id : " + parseInt(clientTypeList.client["edd_id"]) + strLength;           
        } 

        //note
        $("#note").css("background-color",defaultColor);
        var noteText = $("#note").val();
        if(noteText.length > parseInt(clientTypeList.client["note"])){
            isError = true;
            $("#note").css("background-color",errorColor);
            errorMessage += "note : " + parseInt(clientTypeList.client["note"]) + strLength;           
        } 

        //nature of business
        $("#nature_of_business").css("background-color",defaultColor);
        var nob = $("#nature_of_business").val();
        if(nob.length > parseInt(clientTypeList.client["nature_of_business"])){
            isError = true;
            $("#nature_of_business").css("background-color",errorColor);
            errorMessage += "nature of business : " + parseInt(clientTypeList.client["nature_of_business"]) + strLength;           
        } 

        //incorporation state
        $("#incorporation_state").css("background-color",defaultColor);
        var incState = $("#incorporation_state").val();
        if(incState.length > parseInt(clientTypeList.client["incorporation_state"])){
            isError = true;
            $("#incorporation_state").css("background-color",errorColor);
            errorMessage += "incorporation state : " + parseInt(clientTypeList.client["incorporation_state"]) + strLength;           
        } 
        
        //contact
        var objContactTBL = document.getElementById("contact_person_body");
        var cnt = objContactTBL.rows.length;
        if(cnt == 0){
            errorMessage += "contact person : " + strRequired;           
            isError = true;
        }
        for (var count = 1; count <= cnt; count++) {
            document.getElementById("contact_person" + count).style.backgroundColor = defaultColor;
            if(document.getElementById("contact_person" + count).value == ""){
                document.getElementById("contact_person" + count).style.backgroundColor = errorColor;
                isError = true;
            }
            
            document.getElementById("email" + count).style.backgroundColor = defaultColor;
            if(document.getElementById("email" + count).value == ""){
                document.getElementById("email" + count).style.backgroundColor = errorColor;
                isError = true;
            }
        }

        //group company
        var groupCompanyName = $("#group_companies").val();
        var groupCompanyNameText = $("#group_add_text").val();
        if(groupCompanyName == "" && groupCompanyNameText == ""){
            errorMessage += "group company : " + strRequired;           
            isError = true;
        }

        return [isError,errorMessage];
    }
    
    function saveClient() {        
        jQuery('#loader-bg').show();
        var [isError,errorMessage] = isCheckClientError();   
        if (isError) {
            Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'Error',
                width: '400px',
                html: errorMessage
            });
            return;
        }
        $("#clientForm").find('input,textarea,select,button').prop('disabled', false);
        document.clientForm.submit();
    }

</script>
<div style="margin-left: 20px;margin-top: 20px">
    <!--<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">                            
                    <div class="panel-body">-->
    <a href="{{ url("master/client") }}" title="Back"><button class="btn btn-primary btn-sm">Back</button></a>
    <br />
    <br />

    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    
    <input type="hidden" id="client_type_list" value="{{$retTypeArray}}">
    <form method="POST" id="clientForm" name="clientForm" action="/master/client/{{ $client->id }}" class="form-horizontal" autocomplete="off">
        {{ csrf_field() }}
        {{ method_field("PUT") }}
        <input type="hidden" id="harvest_client_id" name="harvest_client_id" value="{{isset($clientHarvest->id) ? $clientHarvest->id : ''}}">
        <input type="hidden" id="approve_status" name="approve_status" value="{{isset($client->is_approve) ? $client->is_approve : ''}}">
        <div style="float: left;margin-right: 10px">
            <table class="table table-borderless">                                
                <tbody>
                    <tr style="height: 50px">
                        <th width="150px" style="vertical-align: middle;">ID</th>
                        <td style="vertical-align: middle;"><span id="clientId">{{$client->id}}</span> </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Name</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="name" type="text" id="name" value="{{$client->name}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">FYE</th>
                        <td style="vertical-align: middle;">                            
                            <select id="fye" name="fye" class="form-control">  
                                <option value=""></option>
                                <option value="1/31" @if($client->fye == "1/31") selected @endif>1/31</option>
                                <option value="2/28" @if($client->fye == "2/28") selected @endif>2/28</option>
                                <option value="3/31" @if($client->fye == "3/31") selected @endif>3/31</option>
                                <option value="4/30" @if($client->fye == "4/30") selected @endif>4/30</option>
                                <option value="5/31" @if($client->fye == "5/31") selected @endif>5/31</option>
                                <option value="6/30" @if($client->fye == "6/30") selected @endif>6/30</option>
                                <option value="7/31" @if($client->fye == "7/31") selected @endif>7/31</option>
                                <option value="8/31" @if($client->fye == "8/31") selected @endif>8/31</option>
                                <option value="9/30" @if($client->fye == "9/30") selected @endif>9/30</option>
                                <option value="10/31" @if($client->fye == "10/31") selected @endif>10/31</option>
                                <option value="11/30" @if($client->fye == "11/30") selected @endif>11/30</option>
                                <option value="12/31" @if($client->fye == "12/31") selected @endif>12/31</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Vic Status</th>
                        <td style="vertical-align: middle;">
                            <!--<input class="form-control" name="vic_status" type="text" id="vic_status" value="{{$client->vic_status}}">-->
                            <select id="vic_status" name="vic_status" class="form-control" >                            
                                <option value="VIC" @if($client->vic_status == "VIC") selected @endif>VIC</option>
                                <option value="IC" @if($client->vic_status == "IC") selected @endif>IC</option>
                                <option value="C" @if($client->vic_status == "C") selected @endif>C</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Group Companies</th>
                        <td style="vertical-align: middle;">
                            <!--<input class="form-control" name="group_companies" type="text" id="group_companies" value="{{$client->group_companies}}">-->
                            <select class="form-control" name="group_companies" id="group_companies">
                                <option value=""></option>
                                @foreach($clientGroup as $data)
                                <option value="{{$data->group_companies}}" @if($data->group_companies == $client->group_companies) selected @endif>{{$data->group_companies}}</option>
                                @endforeach
                            </select>
                            </select><input type="button" id="group_add_new" name="group_add_new" value="Add New" style="height: 30px;font-size: 10px;background-color: #3C8DBC;color: white;" onclick="AddNewGroupCompany()"><br>
                            <input class="form-control" id="group_add_text" name="group_add_text" type="text" value="" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Website</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="website" type="text" id="website" value="{{$client->website}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Address US</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="address_us" type="text" id="address_us" value="{{$client->address_us}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Address JP</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="address_jp" type="text" id="address_jp" value="{{$client->address_jp}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Mailing Address</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="mailing_address" type="text" id="mailing_address" value="{{$client->mailing_address}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Tel1</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="tel1" type="text" id="tel1" value="{{$client->tel1}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Tel2</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="tel2" type="text" id="tel2" value="{{$client->tel2}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Tel3</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="tel3" type="text" id="tel3" value="{{$client->tel3}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Fax</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="fax" type="text" id="fax" value="{{$client->fax}}"></td>
                    </tr>                                
                </tbody>
            </table>
        </div>    

        <div style="float: left;margin-right: 10px">
            <table class="table table-borderless">                  
                <tbody>                
                    <tr>
                        <th style="vertical-align: middle;">Federal ID</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="federal_id" type="text" id="federal_id" value="{{$client->federal_id}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">State ID</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="state_id" type="text" id="state_id" value="{{$client->state_id}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Edd ID</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="edd_id" type="text" id="edd_id" value="{{$client->edd_id}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Note</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="note" type="text" id="note" value="{{$client->note}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">PIC</th>
                        <td style="vertical-align: middle;">
                           <!-- <input class="form-control" name="initial" type="text" id="initial" value="{{$client->initial}}">-->
                            <select id="pic" name="pic" class="form-control" >                            
                                @foreach ($picData as $items)
                                <option value="{{$items->id}}" @if($items->id == $client->pic) selected @endif>{{$items->initial}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Nature of Business</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="nature_of_business" type="text" id="nature_of_business" value="{{$client->nature_of_business}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Incorporation Date</th>
                        <td style="vertical-align: middle;"><input class="form-control datepicker1" name="incorporation_date" type="text" id="incorporation_date" value="{{$client->incorporation_date}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Incorporation State</th>
                        <td style="vertical-align: middle;"><input class="form-control" name="incorporation_state" type="text" id="incorporation_state" value="{{$client->incorporation_state}}"></td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Business Started</th>
                        <td style="vertical-align: middle;"><input class="form-control datepicker1" name="business_started" type="text" id="business_started" value="{{$client->business_started}}"></td>
                    </tr>
                    <tr style="height: 30px"></tr>
                    <tr>
                        <th style="vertical-align: middle;">Status</th>
                        <td style="vertical-align: middle;">
                            <select id="archive" name="archive" class="form-control" >
                                <option value="1" @if($client->is_archive == 1) selected @endif>Archived</option>
                                <option value="0" @if($client->is_archive != 1) selected @endif>Active</option>                            
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Harvest Client ID</th>
                        <td style="vertical-align: middle;">
                            {{isset($clientHarvest->id) ? $clientHarvest->id : ""}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="float: left">
            <div><label style="font-size: 20px;width: 180px">Contact Person</label><input type="button" id="contact_list" name="contact_list" class="btn btn-primary btn-sm project-button" value="Add" onclick="appendContactRow()"></div>
            <table border="0" id="contact_person_table" class="table table-sm" style="font-size: 12px;table-layout: fixed;width: 650px">                
                <thead>
                    <tr>
                        <th class="project-font-size" style="text-align:center; width:40px;">No</th>
                        <th class="project-font-size" style="width: 200px">Contact Person</th>
                        <th class="project-font-size" style="width: 120px">Title</th>
                        <th class="project-font-size" style="width: 200px">Contact Person 日本語</th>
                        <th class="project-font-size" style="width: 100px">TelePhone</th>
                        <th class="project-font-size" style="width: 100px">Cell Phone</th>
                        <th class="project-font-size" style="width: 100px">FAX</th>
                        <th class="project-font-size" style="width: 150px">Email</th>
                        <th style="width:40px;"> </th>
                    </tr> 
                </thead>
                <tbody id="contact_person_body">
                    @foreach($contactPersonList as $items)
                    <tr>
                        <td style="vertical-align: middle;text-align: center"><span class="seqno-contact">{{$loop->index + 1}}</span></td>
                        <td><input class="form-control inpcontact" type="text" id="contact_person{{$loop->index + 1}}" name="contact_person{{$loop->index + 1}}" value="{{$items->person}}" style="width: 100%"></td>
                        <td><input class="form-control inptitle" type="text" id="title{{$loop->index + 1}}" name="title{{$loop->index + 1}}" value="{{$items->person_title}}" style="width: 100%"></td>
                        <td><input class="form-control inpcontactjp" type="text" id="contact_person_jp{{$loop->index + 1}}" name="contact_person_jp{{$loop->index + 1}}" value="{{$items->person_jp}}" style="width: 100%"></td>
                        <td><input class="form-control inptelephone" type="text" id="telephone{{$loop->index + 1}}" name="telephone{{$loop->index + 1}}" value="{{$items->tel}}" style="width: 100%"></td>
                        <td><input class="form-control inpcellphone" type="text" id="cellphone{{$loop->index + 1}}" name="cellphone{{$loop->index + 1}}" value="{{$items->mobile_phone}}" style="width: 100%"></td>
                        <td><input class="form-control inpfax" type="text" id="fax{{$loop->index + 1}}" name="fax{{$loop->index + 1}}" value="{{$items->fax}}" style="width: 100%"></td>
                        <td><input class="form-control inpemail" type="text" id="email{{$loop->index + 1}}" name="email{{$loop->index + 1}}" value="{{$items->email}}" style="width: 100%"></td>
                        <td><button class="delbtn btn btn-sm" type="button" id="delBtnContact{{$loop->index + 1}}" value="Delete" onclick="return deleteContactRow(this)" style="background-color: transparent"><img src="{{URL::asset('/image')}}/delete.png"></button></td>                      
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div><label style="font-size: 20px;width: 180px">Domain</label><input type="button" id="domain_list" name="domain_list" class="btn btn-primary btn-sm project-button" value="Add" onclick="appendDomainRow()"></div>
            <table border="0" id="domain_table" class="table table-sm" style="font-size: 12px;table-layout: fixed;width: 550px">                
                <thead>
                    <tr>
                        <th class="project-font-size" style="text-align:center; width:20px;">No</th>
                        <th class="project-font-size" style="text-align:center; width:20px;">@</th>
                        <th class="project-font-size" style="width: 80px">Domain</th>
                        <th class="project-font-size" style="width: 50px">Registerd?</th>                        
                        <th style="width:40px;"> </th>
                    </tr> 
                </thead>
                <tbody id="domain_body">
                    @foreach($domainData as $items)
                    <tr>
                        <td style="vertical-align: middle;text-align: center"><span class="seqno-contact">{{$loop->index + 1}}</span></td>
                        <td style="vertical-align: middle;text-align: center">@</td>
                        <td><input class="form-control inptitle" type="text" id="domain{{$loop->index + 1}}" name="domain{{$loop->index + 1}}" value="{{$items->domain}}" style="width: 100%"></td>
                        <td><input class="btn btn-primary inpcontactjp" type="button" id="is_registered{{$loop->index + 1}}" name="is_registered{{$loop->index + 1}}" value="{{$items->is_resistered == '0' ? 'Registered' : 'Unregistered'}}" style="width: 100%"></td>                        
                        <td><button class="delbtn btn btn-sm" type="button" id="delBtnContact{{$loop->index + 1}}" value="Delete" onclick="return deleteContactRow(this)" style="background-color: transparent"><img src="{{URL::asset('/image')}}/delete.png"></button></td>                      
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="float: left;margin-top: 20px;margin-bottom: 20px"> 
                <div><label style="font-size: 20px;width: 180px">US Shareholders</label><input type="button" id="us_list" name="us_list" class="btn btn-primary btn-sm project-button" value="Add" onclick="appendUsRow()"></div>
                <table class="table" border="0" id="us_shareholder_list" style="width: 400px">
                    <thead>                    
                        <tr>
                            <th class="project-font-size" style="text-align:center; width:40px;">No</th>
                            <th class="project-font-size" style="width: 250px">Name</th>
                            <th class="project-font-size" style="width: 70px">%</th>  
                            <th style="width:40px;"> </th>
                        </tr> 
                    </thead>
                    <tbody id="us_shareholder_body">
                        @foreach($usList as $items)
                        <tr>                          
                            <td style="vertical-align: middle;text-align: center"><span class="seqno-usshareholder">{{$loop->index + 1}}</span></td>
                            <td><input class="form-control inpusname" type="text" id="us_name{{$loop->index + 1}}" name="us_name{{$loop->index + 1}}" value="{{$items->name}}" style="width: 100%"></td>
                            <td><input class="form-control inpuspercent" type="text" id="us_percent{{$loop->index + 1}}" name="us_percent{{$loop->index + 1}}" value="{{$items->percent}}" style="width: 100%;text-align: right"></td>
                            <td><button class="delusbtn btn btn-sm" type="button" id="delBtnForeign{{$loop->index + 1}}" value="Delete" onclick="return deleteUsRow(this)" style="background-color: transparent;width: 100%"><img src="{{URL::asset('/image')}}/delete.png"></button></td>                                                   
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="float: left;margin-top: 20px;margin-left: 110px">
                <div><label style="font-size: 20px;width: 200px">Foreign Shareholders</label><input type="button" id="foreign_list" name="foreign_list" class="btn btn-primary btn-sm project-button" value="Add" onclick="appendForeignRow()"></div>
                <table class="table" border="0" id="foreign_shareholder_list" style="width: 400px">
                    <thead>                    
                        <tr>
                            <th class="project-font-size" style="text-align:center; width:40px;">No</th>
                            <th class="project-font-size" style="width: 250px">Name</th>
                            <th class="project-font-size" style="width: 70px">%</th>                   
                        </tr> 
                    </thead>
                    <tbody id="foreign_shareholder_body">
                        @foreach($foreignList as $items)
                        <tr>                          
                            <td style="vertical-align: middle;text-align: center"><span class="seqno-foreignshareholder">{{$loop->index + 1}}</span></td>
                            <td><input class="form-control inpforeignname" type="text" id="foreign_name{{$loop->index + 1}}" name="foreign_name{{$loop->index + 1}}" value="{{$items->name}}" style="width: 100%"></td>
                            <td><input class="form-control inpforeignpercent" type="text" id="foreign_percent{{$loop->index + 1}}" name="foreign_percent{{$loop->index + 1}}" value="{{$items->percent}}" style="width: 100%;text-align: right"></td>
                            <td><button class="delforeignbtn btn btn-sm" type="button" id="delBtnForeign{{$loop->index + 1}}" value="Delete" onclick="return deleteForeignRow(this)" style="background-color: transparent;width: 100%"><img src="{{URL::asset('/image')}}/delete.png"></button></td>                                                   
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>     

            <div style="width: 440px">
                <div><label style="font-size: 20px;width: 180px">Officers</label><input type="button" id="officers_list" name="officers_list" class="btn btn-primary btn-sm project-button" value="Add" onclick="appendOfficerRow()"></div>
                <table class="table" id="officer_table_list">
                    <thead>                   
                        <tr>
                            <th class="project-font-size" style="text-align:center; width:40px;">No</th>
                            <th class="project-font-size" style="width: 200px">Name</th>
                            <th class="project-font-size" style="width: 200px">Title</th>   
                            <th style="width:40px;"> </th>
                        </tr> 
                    </thead>
                    <tbody id="officers_body">    
                        @foreach($officer as $items)
                        <tr>
                            <td style="vertical-align: middle;text-align: center"><span class="seqno-officer">{{$loop->index + 1}}</span></td>
                            <td><input class="form-control inpofficername" type="text" id="officer_name{{$loop->index + 1}}" name="officer_name{{$loop->index + 1}}" value="{{$items->name}}" style="width: 100%"></td>
                            <td><input class="form-control inpofficertitle" type="text" id="officer_title{{$loop->index + 1}}" name="officer_title{{$loop->index + 1}}" value="{{$items->title}}" style="width: 100%"></td>
                            <td><button class="delofficerbtn btn btn-sm" type="button" id="delBtnOfficer{{$loop->index + 1}}" value="Delete" onclick="return deleteOfficerRow(this)" style="background-color: transparent;width: 100%"><img src="{{URL::asset('/image')}}/delete.png"></button></td>                            
                        </tr>                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
     
        <div style="clear: both"></div>

        <div class="form-group" style="float: left;width: 400px">            
            <div class="col-md-4">
                <input class="btn btn-primary" type="button" onclick="saveClient()" value="Update">                
            </div>   
            @if($isApprove == 1)                
            <div class="col-md-4" style="margin-left: 100px">                            
                @if($client->is_approve == 1)                    
                <button style="height: 34px;width: 100px;background-color: #C0C0C0" class="btn btn-primary btn-sm" id="btn_approve" name="btn_approve" onclick="saveClient()" >Unapprove</button>
                @else    
                <button style="height: 34px;width: 100px;" class="btn btn-primary btn-sm" onclick="saveClient()" id="btn_unapprove" name="btn_unapprove" >Approve</button>
                @endif  
            </div>               
        @endif
        </div>           
    </form>

</div>

<script type="text/javascript">     
    $('.datepicker1').datepicker({
        format: "mm/dd/yyyy",
        language: "en",
        autoclose: true,
        orientation: 'bottom left'
    });
</script>
<!--</div>
</div>
</div>
</div>
</div>-->
@endsection