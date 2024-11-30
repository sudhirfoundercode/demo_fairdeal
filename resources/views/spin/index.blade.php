@extends('admin.app')
@section('app')



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
          
               <div class="row" style="backgorund-color: #fff; border-radius: 5px;margin-bottom:10px; ">
                     <div class="col-md-12 ">
                        <b class="city" style="font-weight:bold;font-size:18px;">Period No -<span id="games_no"></span></b>
                    </div>
               

                     <div class="col-md-3">
                         <h4 id="result_announce_time"></h4>
                     </div>
                   <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <h4 id="timer"></h4>
                    </div>
               </div>
    


        <div class="row" style="padding-bottom:0px;">
                <div class="card border col-md-1 mt-4" style="height: 90px; display: flex; justify-content: center; align-items: center;"  title="Tap to insert result 1" onclick="result_insert(1)">
                <img style="height: 80px; width: 80px;" src="{{asset('/assets/spin/1.png')}}"></div>
                <div class="card border col-md-1  mt-4" style="height: 90px; display: flex; justify-content: center; align-items: center;" title="Tap to insert result 2" onclick="result_insert(2)"><img style="height: 80px; width: 80px;" src="{{asset('/assets/spin/2.png')}}"></div>
                <div class="card border col-md-1  mt-4" style="height: 90px; display: flex; justify-content: center; align-items: center;" title="Tap to insert result 3" onclick="result_insert(3)"><img style="height: 80px; width: 80px;" src="{{asset('/assets/spin/3.png')}}"></div>
                <div class="card border col-md-1  mt-4" style="height: 90px; display: flex; justify-content: center; align-items: center;" title="Tap to insert result 4" onclick="result_insert(4)"><img style="height: 80px; width: 80px;" src="{{asset('/assets/spin/4.png')}}"></div>
                <div class="card border col-md-1  mt-4" style="height: 90px; display: flex; justify-content: center; align-items: center;" title="Tap to insert result 5" onclick="result_insert(5)"><img style="height: 80px; width: 80px;" src="{{asset('/assets/spin/5.png')}}"></div>
                
                <div class="card border col-md-1  mt-4" style="height: 90px; display: flex; justify-content: center; align-items: center;" title="Tap to insert result 6" onclick="result_insert(6)"><img style="height: 80px; width: 80px;" src="{{asset('/assets/spin/6.png')}}"></div>
                <div class="card border col-md-1  mt-4" style="height: 90px; display: flex; justify-content: center; align-items: center;" title="Tap to insert result 7" onclick="result_insert(7)"><img style="height: 80px; width: 80px;" src="{{asset('/assets/spin/7.png')}}"></div>
                <div class="card border col-md-1  mt-4 " style="height: 90px; display: flex; justify-content: center; align-items: center;" title="Tap to insert result 8" onclick="result_insert(8)"><img style="height: 80px; width: 80px;" src="{{asset('/assets/spin/8.png')}}"></div>
                <div class="card border col-md-1 mt-4 " style="height: 90px; display: flex; justify-content: center; align-items: center;" title="Tap to insert result 9" onclick="result_insert(9)"><img style="height: 80px; width: 80px;" src="{{asset('/assets/spin/9.png')}}"></div>
                <div class="card border col-md-1  mt-4" style="height: 90px; display: flex; justify-content: center; align-items: center;" title="Tap to insert result 0" onclick="result_insert(0)"><img style="height: 80px; width: 80px;" src="{{asset('/assets/spin/0.png')}}"></div>
          </div>

         
           
                     <div class="row">
                @for($i = 1; $i <= 9; $i++)
                    <div class="card border col-md-1">
                        <h1>{{ $i }}</h1>
                        <p id="amount-{{ $i }}">0</p> <!-- Placeholder for amount -->
                    </div>
                @endfor
                <div class="card border col-md-1">
                    <h1>0</h1>
                    <p id="amount-0">0</p> <!-- Placeholder for amount -->
                </div>
            </div>
</div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to fetch the latest bet logs
        function fetchLatestBetLogs() {
            $.ajax({
                url: '/api/spin-betlogs', // Your API route
                method: 'GET',
                success: function(response) {
                    // Update your dashboard with the latest data
                   
                    $('#games_no').text(response.games_no);
                    //$('#period_no_input').val(response.period_no);
                   
                 
                    
                   
                },
                error: function() {
                    console.log('Error fetching bet logs');
                }
            });
        }

        // Call the function when the page loads
        fetchLatestBetLogs();

        // Set an interval to fetch data every 5 seconds (or as needed)
        setInterval(fetchLatestBetLogs, 5000);
    });
</script>


<script>
    $(document).ready(function() {
        // Function to fetch the latest bet logs
        function fetchLatestBetLogs() {
            $.ajax({
                url: '/api/spin-betlogs-amount', // Your API route
                method: 'GET',
                success: function(response) {
                    // Loop through the response and display amount for each matching number
                    response.forEach(function(betLog) {
                        $('#amount-' + betLog.number).text(betLog.amount);
                    });
                },
                error: function() {
                    console.log('Error fetching bet logs');
                }
            });
        }

        // Call the function when the page loads
        fetchLatestBetLogs();

        // Set an interval to fetch data every 5 seconds (or as needed)
        setInterval(fetchLatestBetLogs, 5000);
    });
    
    //// onclick function ///
    
    function result_insert(card_number){
        //alert(`card number is ${card_number}`);
        let period_num = document.getElementById('games_no').textContent;
        // alert(`card number is ${card_number}  and period number is - ${period_num}`);
            fetch('api/auto_spin_ad_result_insert', {
                  method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    },
                 body: JSON.stringify({
                     // Add the data you want to send in the body here, for example:
                    card_number:card_number,
                    period_num: period_num
                  }),
                 })
                .then(response => response.json())  // Assuming the response is JSON
                .then(data =>{
                   if(data.status==200){
                       alert(data.message);
                   }else{
                       alert(data.message);
                   }
                   
                   })
                .catch(error => console.error('Error:', error));

    }
    
    
    
</script>




<script type="text/javascript">    
    setInterval(page_refresh, 1*60000); //NOTE: period is passed in milliseconds
</script>
           
           
           


        </div>
        </div>
        </div>
     </div>

@endsection