@extends('layouts.master')

@section('content')
<!--new

-->

    <div class="row text-center">

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Clients</p>
                    <h2 class="text-danger"><span data-plugin="counterup">{{$read_clients_count}}</span></h2>
                     
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Matters</p>
                    <h2 class="text-dark"><span data-plugin="counterup">{{$matters_count}}</span> </h2>
                
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Cases</p>
                    <h2 class="text-success"><span data-plugin="counterup">{{$count_CourtBook}}</span></h2>
               
                </div>
            </div>
        </div><!-- end col -->

       

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Total Users</p>
                    <h2 class="text-primary"><span data-plugin="counterup">{{$count_users}}</span> </h2>
                    
                </div>
            </div>
        </div><!-- end col -->
    </div>



    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">Matters Stages</h4>

                <div id="maters" style="height: 460px;"></div>
               
         
            </div> <!-- end card -->
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box">
                 <h4 class="header-title m-t-0 m-b-30">Matters per Practice areas</h4>
                 <div id="practice_areas" style="height: 460px;"></div>          

            </div>
        </div>
    </div>

        <div class="modal fade none-border" id="event-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h3 class="h3">Add events</h3>
                    </div>
                    <div class="modal-body p-20">
                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                    </div>
                    
                </div>

            </div>
        </div>

    <div class="row">

        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
             <div class="card-box">
                <h4 class="header-title m-t-0 m-b-20">Court cases Stages</h4>
                <div class="inbox-widget nicescroll" id="cases" style="height: 460px;"></div>
            </div>
        </div>

       <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">My events</h4>

                <div id="calendar"></div>

            </div>
        </div>
    </div>
              
@endsection

@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

 <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {    
       var record={!! json_encode($stages) !!};
       console.log(record);
       // Create our data table.
       var data = new google.visualization.DataTable();
        data.addColumn('string', 'Stages');
        data.addColumn('number', 'No. of cases');
       for(var k in record){
            var v = record[k];
           
             data.addRow([k,v]);
          console.log(v);
          }
        var options = {
          title: '',
          is3D: true,
          curveType: 'none',
        };        
        var chart = new google.visualization.BarChart(document.getElementById('cases'));
        chart.draw(data, options);        
      }
    </script>



 <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {    
       var record={!! json_encode($matter_array) !!};
       console.log(record);
       // Create our data table.
       var data = new google.visualization.DataTable();
        data.addColumn('string', 'Stage');
        data.addColumn('number', 'No. of matters');
       for(var k in record){
            var v = record[k];
           
             data.addRow([k,v]);
          console.log(v);
          }
        var options = {
          title: '',
          is3D: true,
          curveType: 'none',
        };        
        var chart = new google.visualization.PieChart(document.getElementById('maters'));
        chart.draw(data, options);        
      }
    </script>

     <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {    
       var record={!! json_encode($practicearea) !!};
       console.log(record);
       // Create our data table.
       var data = new google.visualization.DataTable();
        data.addColumn('string', 'Practice area');
        data.addColumn('number', 'No. of matters');
       for(var k in record){
            var v = record[k];
           
             data.addRow([k,v]);
          console.log(v);
          }
        var options = {
          title: '',
          is3D: true,
          curveType: 'none',
        };        
        var chart = new google.visualization.BarChart(document.getElementById('practice_areas'));
        chart.draw(data, options);        
      }
    </script>




  <script>
    // var defaultEvents;
      !function($) {
        "use strict";
        
        var CalendarApp = function() {
            this.$body = $("body")
            this.$modal = $('#event-modal'),
            this.$event = ('#external-events div.external-event'),
            this.$calendar = $('#calendar'),
            this.$saveCategoryBtn = $('.save-category'),
            this.$categoryForm = $('#add-category form'),
            this.$extEvents = $('#external-events'),
            this.$calendarObj = null
        };


  
    CalendarApp.prototype.onDrop = function (eventObj, date) { 
        var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];
            // render the event on the calendar
            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }
    },
    /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
 
            var $this = this;
            var form = $("<form></form>");
            form.append("<h5>"+calEvent.title+"</h5>");
            form.append("<p>"+calEvent.description+"</p>");
            form.append("<legend></legend>");
            form.append("<p> From: "+new Date(calEvent.start).toLocaleString()+"</p>");
            form.append("<p> To: "+new Date(calEvent.end).toLocaleString()+"</p>");         
           
            $this.$modal.modal({
                backdrop: 'static'
            });

            $this.$modal.find('.modal-body').empty().prepend(form).end().find('.save-event').hide().end().find('.h3').hide().end().click(function () {                
                $this.$modal.modal('hide');
            });
       },
    /* on select */
    CalendarApp.prototype.onSelect = function (start, end, allDay) {
        var $this = this;
            $this.$modal.modal({
                backdrop: 'static'
            });
            var form = $("<form></form>");
            form.append("<div class='row'></div>");
            form.find(".row")
                .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Title</label><input class='form-control' type='text' name='title'/></div></div>")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Start Date</label><input type='date' class='form-control' name='start_date'/></div></div>")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Start Time</label><input type='time' class='form-control' name='start_time'/></div></div>")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>End Date</label><input type='date' class='form-control' name='end_date'/></div></div>")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>End Time</label><input type='time' class='form-control' name='end_time'/></div></div>")
                .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Description</label><textarea class='form-control'  type='text' name='description'></textarea></div></div>")
                .find("select[name='category']")
                .append("</div></div>");
             $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                form.submit();
            });
            $this.$modal.find('form').on('submit', function () {
                var title = form.find("input[name='title']").val();
                var description = form.find("textarea[name='description']").val();
                var start_date = form.find("input[name='start_date']").val();
                var start_time = form.find("input[name='start_time']").val();
                var end_date = form.find("input[name='end_date']").val();
                var end_time = form.find("input[name='end_time']").val();
                var categoryClass = form.find("select[name='category'] option:checked").val();
 
                if (title !== null && title.length != 0) {
                    $this.$calendarObj.fullCalendar('renderEvent', {
                        title:title,
                        start:start,
                        end: end,
                        allDay: false,
                        className: categoryClass
                    }, true);  
                    $this.$modal.modal('hide');

                    // save the invent
                $.ajax({
                    type: "POST",
                    url: "{!! route('matter_event.store') !!}",
                    data: { 
                        title:title,
                        description:description,
                        start:start_date,
                        start_time:start_time,
                        end:end_date,
                        end_time:end_time,
                        _token: "{{Session::token()}}" },
                    success: function(result){
                        console.log(result);
                    }
                });

                }
                else{
                    alert('You have to give a title to your event');
                }
                return false;
                
            });
            $this.$calendarObj.fullCalendar('unselect');
    },
    CalendarApp.prototype.enableDrag = function() {
        //init events
        $(this.$event).each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    }
    /* Initializing */
    CalendarApp.prototype.init = function() {
        this.enableDrag();
        /*  Initialize the calendar  */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var today = new Date($.now());

        // console.log("Today: "+today);

        var defaultEvents;

      
            $.ajax({
                async: false,
                type: "GET",
                
                url: "{!! route('matter_event.show','user_events') !!}",
                data: { 
                    _token: "{{Session::token()}}" },
                success: function(result){
                   defaultEvents=result; 

              }

            });

                var $this = this;
 
                $this.$calendarObj = $this.$calendar.fullCalendar({                    
                    events:defaultEvents,
                    slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
                    minTime: '08:00:00',
                    maxTime: '19:00:00',  
                    defaultView: 'month',  
                    handleWindowResize: true,   
                    height: $(window).height() - 200,   
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    drop: function(date) { $this.onDrop($(this), date); },
                    select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
                    eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }

                });
            
       

           
         
        

        //on new event
        this.$saveCategoryBtn.on('click', function(){
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                $this.$extEvents.append('<div class="external-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fa fa-move"></i>' + categoryName + '</div>')
                $this.enableDrag();
            }

        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),

//initializing CalendarApp
function($) {
    "use strict";
    $.CalendarApp.init()
}(window.jQuery);



  </script>
@endpush
