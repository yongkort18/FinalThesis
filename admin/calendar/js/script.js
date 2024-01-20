   
   var calendar;
    var Calendar = FullCalendar.Calendar;
    var events = [];
    $(function() {
        if (!!scheds) { 
            Object.keys(scheds).map(k => {
                var row = scheds[k]; 
                // Format start and end properties to show only the date
                events.push({
                    id: row.id,
                    title: row.email,
                    start: formatDate(row.date)
                });
            });
        
        } 
        // Function to format date as 'YYYY-MM-DD'
      // Function to format date as 'YYYY-MM-DD'
        function formatDate(date) {
            let formattedDate = new Date(date);
            formattedDate.setUTCHours(0, 0, 0, 0); // Set UTC hours, minutes, seconds, and milliseconds to 0
            return formattedDate.toISOString().split('T')[0];
        }

        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()
 
      
        calendar = new Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'prev,next today',
                right: 'dayGridMonth,dayGridWeek,list',
                center: 'title',
            },
            selectable: true,
            themeSystem: 'bootstrap',
            //Random default events
            events: events,
            eventClick: function(info) {
                var _details = $('#event-details-modal')
                var id = info.event.id
                if (!!scheds[id]) {
                    _details.find('#title').text(scheds[id].email)
                    _details.find('#description').text(scheds[id].user_name) 
                    _details.find('#phone').text(scheds[id].number)
              // Assuming scheds[id].sdate is a Date object or a date string
                    let startDate = new Date(scheds[id].sdate);
                    let options = { year: 'numeric', month: 'long', day: 'numeric' };
                 let formattedStartDate = startDate.toLocaleDateString('en-US', options);
                    

                    // Set the text content of the element with ID 'start'
                    _details.find('#start').text(formattedStartDate);

                    // _details.find('#end').text(scheds[id].edate)
                    _details.find('#edit,#delete').attr('data-id', id)
                    _details.modal('show')
                } else {
                    alert("Event is undefined");
                }
            },
            eventDidMount: function(info) {
                // Do Something after events mounted
            },
            editable: false
        });

        calendar.render();

        // Form reset listener
        $('#schedule-form').on('reset', function() {
            $(this).find('input:hidden').val('')
            $(this).find('input:visible').first().focus()
        })


        

    })