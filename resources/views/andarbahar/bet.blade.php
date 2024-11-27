@extends('admin.app')
@section('app')

<!-- Custom CSS -->
<style>
    body {
        background-color: #f8f9fa;
    }

    h1 {
        font-size: 32px;
        font-weight: bold;
    }

    .input-box {
        width: 100px;
        height: 40px;
        text-align: center;
    }

    .form-input {
        width: 200px;
        height: 40px;
    }

    .btn-submit {
        background-color: teal;
        color: white;
        border-radius: 5px;
        height: 40px;
        width: 100px;
    }

    .btn-refresh {
        background-color: transparent;
        border: none;
        height: 40px;
        width: 50px;
    }

    .ml-3 {
        margin-left: 12px;
    }

    .mt-5 {
        margin-top: 50px;
    }

    .mt-4 {
        margin-top: 20px;
    }
</style>

<div class="container-fluid" style="margin-bottom: 60px;">
    <div class="row d-flex justify-content-center align-items-center mb-5">
        <div class="col-md-10"></div>
        <div class="col-md-2" id="time" style="color:black;font-size:20px;font-weight:bold;"></div>
    </div>
    <!--<form action="{{ route('andar_bahar.bet') }}" method="post">-->
        <!--@csrf-->
        
        <!-- Period Number and Total Amount -->
        <div class="d-flex justify-content-between align-items-center">
            <div style="font-weight:bold;font-size:30px;">
                <b class="text-center">Period No - </b>
                <b class="text-center" id="period-number"></b>
            </div>
            <div id="total-bets">
                <b style="font-size: 20px;">Total Amount: </b>
                <b style="font-size: 20px;" id="total-amount"></b>₹
            </div>
        </div>
        
        <!-- Andar and Bahar Cards -->
        <div class="d-flex justify-content-center mt-4">
            <div class="card text-center btn-andar" style="width: 200px; cursor: pointer; border: none; background: linear-gradient(to right, red, purple);" onclick="result_insert(1)">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 24px; color: white; margin: 0;">Andar</h5>
                </div>
            </div>

            <div class="card text-center btn-bahar ml-3" style="width: 200px; cursor: pointer; border: none; background: linear-gradient(to right, green, purple);" onclick="result_insert(2)">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 24px; color: white; margin: 0;">Bahar</h5>
                </div>
            </div>
        </div>
        
        <!-- Input Boxes -->
        <div class="d-flex justify-content-center mt-4">
            <input type="text" class="form-control input-box" id="andar-amount" value="" readonly>
            <input type="text" class="form-control input-box ml-3" id="bahar-amount" value="" readonly>
        </div>
        
        <!-- Betting Form Inputs -->
        
        <!--<div class="d-flex justify-content-center mt-4">-->
        <!--    <input type="text" class="form-control form-input" name="period_no" id="submit_period_num" value="">-->
        <!--    <select class="form-select form-input ml-3" name="bet_option">-->
        <!--        <option value="Andar">Andar</option>-->
        <!--        <option value="Bahar">Bahar</option>-->
        <!--    </select>-->
        <!--    <button class="btn btn-submit ml-3" type="submit">Submit</button>-->
        <!--    <button class="btn btn-refresh ml-3" type="button"></button>-->
        <!--</div>-->
    <!--</form>-->
    
    <!--<form method="post" action="{{route('update_andar_bahar_win_per')}}">-->
    <!--    @csrf-->
        <!-- Percentage Input -->
    <!--    <div class="d-flex justify-content-center mt-4">-->
    <!--        <input type="text" class="form-control form-input" name="winning_percentage" value="{{ $winningPercentage }}">%-->
    <!--        <button class="btn btn-submit ml-3" type="submit">Submit</button>-->
    <!--    </div>-->
    <!--</form>-->
</div>

<!--<form action="{{route('andarbahar.update')}}" method="post">-->
<!--            @csrf-->
               <!--important input box hidden for prediction insert and also works for custom date selection-->
<!--             <input type="hidden" class="form-control" id="result_time" style="  font-size: 16px;color:#333;border:none" name="result_time" value="">-->
<!--                   <div class="row ml-4 d-flex" style="margin-bottom: 20px;"> -->
                  
<!--                        <div class="col-md-4 form-group d-flex">-->
                           
                           
<!--                         </div>-->
                         
                            <!--add code by sudhir-->
                            
<!--                            <div class="col-md-2 form-group d-flex">-->
<!--                             <input type="number" name="jackpot" class="form-control" min="1" max="12" placeholder="Jackpot Multiplier" id="result-number" >-->
                             
<!--                         </div>-->
                            <!--end add code -->
                            
                            
<!--                         <div class="col-md-2 form-group d-flex">-->
<!--                            <button type="submit" class="form-control btn btn-info" id="submit-button"><b>Submit</b></button>-->
<!--                         </div>-->
<!--                         <div class="col-md-2 form-group d-flex mt-1">-->
<!--                            <a href=""> <i class="fa fa-refresh" aria-hidden="true" style="font-size:30px;"></i></a>-->
<!--                         </div>-->
<!--                   </div>-->
<!--           </form>-->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        refreshData();
        updateClock();
        setInterval(updateClock, 1000);
    });
    
    function updateClock() {
        const timerElement = document.getElementById('time');
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;
        timerElement.textContent = timeString;
    }
    
    
    function refreshData() {
        fetchData();
        setInterval(fetchData, 1000);
    }
    
    function fetchData() {
        fetch('api/fetch_andar_bahar', {
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
            console.log('Fetched data:', data);
            $('#andar-amount').val(data.data.andar_amount); // Use the correct field for Andar
            $('#bahar-amount').val(data.data.bahar_amount); // Corrected from bahar-amount to bahar_amount
           // $('#submit_period_num').val(data.data.game_sr_num);
            
            // Calculate total amount and update the UI
            const totalAmount = (data.data.andar_amount + data.data.bahar_amount) / 2;
            document.getElementById('total-amount').textContent = totalAmount.toFixed(2); // Format to 2 decimal places
            document.getElementById('period-number').textContent = data.data.game_sr_num;
        })
        .catch(error => console.error('Error fetching data:', error));
    }
    
    function result_insert(card_number){
        //alert(`card number is ${card_number}`);
        let period_num = document.getElementById('period-number').textContent;
        // alert(`card number is ${card_number}  and period number is - ${period_num}`);
            fetch('api/auto_ab_ad_result_insert', {
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

@endsection
