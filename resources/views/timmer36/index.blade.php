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
         
               
          <!--<form action="{{route('admin_prediction3')}}" method="post">-->
          <!--  @csrf-->
               <!--important input box hidden for prediction insert and also works for custom date selection-->
          <!--   <input type="hidden" class="form-control" id="result_time" style="  font-size: 16px;color:#333;border:none" name="result_time" value="">-->
          <!--         <div class="row ml-4 d-flex" style="margin-bottom: 20px;"> -->
          <!--         <div class="col-md-3 form-group d-flex">-->
          <!--            <b>Enter Sr. Number and number For any upcoming prediction - </b>-->
          <!--         </div>-->
          <!--              <div class="col-md-3 form-group d-flex">-->
          <!--                  <input type="hidden" name="games_no" class="form-control" value=""  id="games_no_input">-->
          <!--                  <input type="text" name="games_num" class="form-control" value="">-->
          <!--               </div>-->
                          
          <!--                  @error('games_no')-->
          <!--                      <div class="alert alert-danger">{{ $message }}</div>-->
          <!--                  @enderror-->
                         
          <!--               <div class="col-md-2 form-group d-flex">-->
          <!--                   <input type="number" name="number" class="form-control" min="1" max="36" placeholder="Result" id="result-number" required>-->
                             
          <!--               </div>-->
          <!--               @error('number')-->
          <!--                      <div class="alert alert-danger">{{ $message }}</div>-->
          <!--                  @enderror-->
          <!--               <div class="col-md-2 form-group d-flex">-->
          <!--                  <button type="submit" class="form-control btn btn-info" id="submit-button"><b>Submit</b></button>-->
          <!--               </div>-->
          <!--               <div class="col-md-2 form-group d-flex mt-1">-->
          <!--                  <a href=""> <i class="fa fa-refresh" aria-hidden="true" style="font-size:30px;"></i></a>-->
          <!--               </div>-->
          <!--         </div>-->
          <!-- </form>-->
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
        fetch('/fetch_timer_36', {
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
            fetch('/api/auto_result_insert', {
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