@extends('admin.app')
@section('app')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
          
               <div class="row" style="backgorund-color: #fff; border-radius: 5px;margin-bottom:10px; ">
                     <div class="col-md-12">
                        <b class="city" style="font-weight:bold;font-size:18px;">Period No -<span id="games_sr_num" style="margin-left:25px;font-size:30px"></span></b>
                    </div>

                     <div class="col-md-3">
                         <h4 id="result_announce_time"></h4>
                     </div>
                   <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <h4 id="timer"></h4>
                    </div>
               </div>
    

         <div class="row" id="bet_log_id"></div>
         
        </div>
        </div>
        </div>
     <script>
    document.addEventListener('DOMContentLoaded', () => {
        refreshData();
    });

    function refreshData() {
        fetchData();
       setInterval(fetchData, 1000);
    }

    function fetchData() {
        fetch('/fetch_blue_36', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const bet_log_details = data.data;
            update_bet_log(bet_log_details);
        })
        //document.getElementById('period-number').textContent = data.data.game_sr_num;
        .catch(error => console.error('Error fetching data:', error));
    }
    
    function update_bet_log(bet_log_details){
        var amountHtml = '';
       bet_log_details.forEach((item) => {
            amountHtml += ` <div class="card border col-md-1" onclick="result_insert(${item.number})"> <h3>${item.number}</h3> <p id="amount-${item.number}">${item.amount}</p></div>`;
                    });
       $('#bet_log_id').html(amountHtml);
      document.getElementById('games_sr_num').textContent = bet_log_details[0].games_no;
    //   document.getElementById('games_no_input').value =bet_log_details[0].games_no;
    }
    
   function result_insert(number) {
         let sr_num = document.getElementById('games_sr_num').textContent;
            const data = {
                number: number,
                sr_num: sr_num
            };
            fetch('/api/auto_result_insert_blue', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                   alert(data.message);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
       }
    
</script>
 </div>
@endsection