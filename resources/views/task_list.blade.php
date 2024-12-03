@extends('layouts.main')
@section('content') 

<div style="margin-left: 20px">
    <div id="filter_area" style="margin-top: 30px;">
        <div id="filter_left" style="float: left;height: 180px;margin-bottom: 30px">
            <div class="row entry-filter-bottom" style="zoom: 100%">
                <div class="col col-md-3" >
                    <span class="line-height">Client</span>
                </div>
                <div class="col col-md-3">
                    <select id="client" name="client" multiple="multiple" class="form-control select2" data-display="static">                           
                        @foreach ($client as $clients)
                        <option value="{{$clients->id}}">{{$clients->name}}</option>
                        @endforeach
                    </select>
                </div>  
            </div>          

            <div class="row entry-filter-bottom" style="zoom: 100%">
                <div class="col col-md-3">
                    <span class="line-height">PIC</span>
                </div>
                <div class="col col-md-1">                    
                    <select id="pic" name="pic" multiple="multiple" class="form-control">                            
                        @foreach ($pic as $pics)                    
                        <option value="{{$pics->id}}">{{$pics->initial}}</option>
                        @endforeach
                    </select>                                
                </div>
            </div>

            <div class="row entry-filter-bottom" style="zoom: 100%">
                <div class="col col-md-3">
                    <span class="line-height">Staff</span>
                </div>
                <div class="col col-md-1">
                    <select id="sel_staff" name="sel_staff" multiple="multiple" class="form-control" >                            
                        @foreach ($staff as $staffs)
                        <option value="{{$staffs->id}}">{{$staffs->initial}}</option>
                        @endforeach
                    </select>
                </div>
            </div>      
                        
           <!-- <div class="row entry-filter-bottom">
                <div class="col col-md-3">
                    <span class="line-height">Date From</span>
                </div>
                <div class="col col-md-1">
                    <input type="text" style="width:150px;hight:10px;" class="form-control datepicker1" id="filter_date" name="filter_date" placeholder="mm/dd/yyyy" value="">                            
                </div>                 
            </div>
            
            <div class="row entry-filter-bottom">
                <div class="col col-md-3">
                    <span class="line-height">Date To</span>
                </div>
                <div class="col col-md-1">
                    <input type="text" style="width:150px;hight:10px;" class="form-control datepicker1" id="filter_to" name="filter_to" placeholder="mm/dd/yyyy" value="">                            
                </div>                 
            </div>
            
            <div class="row entry-filter-bottom">
                <div class="col col-md-3">
                    <span class="line-height">Status</span>
                </div>
                <div class="col col-md-1">
                    <select id="status" name="status" class="form-control" style="width:150px;hight:10px;">
                        <option value=""></option>
                        <option value="Imcomplete">Imcomplete</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>                 
            </div>-->

            <div class="row entry-filter-bottom">    
                <div class="col col-md-3">
                    
                </div>
                <div class="col col-md-1" >
                    <input type="button" class="btn btn-default" value="Clear" onclick="clearInputFilter()" style="background-color: white;width: 150px;">
                </div>
                <div class="col" >
                    <button id="btn_load" name="btn_load" class="btn btn-primary" type="button" onclick="loadTaskScheduleData()" style="width: 150px;margin-left: 140px">
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="visibility: hidden"></span>
                        <span id="loadingText">Search</span>
                    </button>
                </div>
            </div>
        </div>        
        <div id="filter_left" style="float: left;height: 180px;margin-bottom: 30px;margin-left: 100px">
            <div class="row entry-filter-bottom">
                <div class="col col-md-5">
                    <span class="line-height">Date From</span>
                </div>
                <div class="col col-md-1">
                    <input type="text" style="width:150px;hight:10px;" class="form-control datepicker1" id="filter_date" name="filter_date" placeholder="mm/dd/yyyy" value="" autocomplete="off">                            
                </div>                 
            </div>
            
            <div class="row entry-filter-bottom">
                <div class="col col-md-5">
                    <span class="line-height">Date To</span>
                </div>
                <div class="col col-md-1">
                    <input type="text" style="width:150px;hight:10px;" class="form-control datepicker1" id="filter_to" name="filter_to" placeholder="mm/dd/yyyy" value="" autocomplete="off">                            
                </div>                 
            </div>
            
            <div class="row entry-filter-bottom">
                <div class="col col-md-5">
                    <span class="line-height">Status</span>
                </div>
                <div class="col col-md-1">
                    <select id="status" name="status" class="form-control" style="width:150px;hight:10px;">
                        <option value=""></option>
                        <option value="Imcomplete">Imcomplete</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>                 
            </div>
        </div>
        <div id="filter_left" style="float: left;height: 180px;margin-bottom: 30px;margin-left: 100px">
            <div class="row entry-filter-bottom">
                <div class="col col-md-5">
                    <span class="line-height">Phase</span>
                </div>
                <div class="col col-md-1">
                <select id="phase_status" name="phase_status" class="form-control" style="width:150px;hight:10px;">
                        <option value=""></option>
                        <option value="Phase">Phase</option>
                        <option value="ToDo">ToDoList</option>
                    </select>
                </div>                 
            </div>
            <div class="row entry-filter-bottom" style="zoom: 100%">
                <div class="col col-md-5">
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
                <div class="col col-md-5">
                    <span class="line-height">Group</span>
                </div>
                <div class="col col-md-1">
                    <select id="group" name="group" class="form-control" style="width:150px;hight:10px;">                            
                        <option value=""></option>
                        <option value="Phase">Phase</option>  
                        <option value="Project">Project</option>  
                    </select>
                </div>
            </div>     
        </div>
    </div>
       
    <table class="table" id="task_schedule">
        <thead>
            <tr>
                <th style="width: 20px">No.</th>
                <th style="width: 20px">Link</th>
                <th style="width: 50px">Staff</th>                
                <th style="width: 60px">Due Date</th>
                <th style="width: 60px">FYE</th>
                <th style="width: 200px">Client</th>
                <th style="width: 150px">Project</th>
                <th style="width: 50px">Status</th>
                <th style="width: 50px">Phase</th>
                <th style="width: 200px">Task</th>
                <th style="width: 200px">Description</th>
                <th style="width: 350px">Memo</th>
            </tr>
        </thead>
        <tbody id="task_schedule_body"></tbody>
    </table>
  
</div>
<script>
    // "global" vars, built using blade
    var imagesUrl = '{{ URL::asset('/image') }}';
</script>
<script src="{{ asset('js/taskSchedule.js') }}"></script>
@endsection