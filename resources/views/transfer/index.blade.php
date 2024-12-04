@extends('admin.app')
@section('app')
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- Section-2 --}}
                                <h4 class="card-title">Player Transfer Points</h4>
                                <hr>
                                <form action="{{route('transfer.amount')}}" method="POST">
                                    @csrf
                                <div class="form">
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label>Username<small>*</small></label>
                                            <input type="text" id="username" class="form-control" name="username" onkeyup="fetchBalance()" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">Balance</label>
                                            <input type="number" class="form-control" id="balance"  readonly>
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="form">
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label>Amount To Transfer<small>*</small></label>
                                            <input type="text" class="form-control" name="amount">
                                        </div>
                                    </div>
                                </div>                               
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                {{-- End Section-1 --}}
                                    {{-- Section-2 --}}
                                    <h5 class="card-title">Stockez/Agent Transfer Points</h5>
                                <hr>
                                <form action="{{route('Agent.amount')}}" method="POST">
                                    @csrf
                                <div class="form">
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label>Username<small>*</small></label>
                                            <input type="text" id="username1" class="form-control" name="username" onkeyup="fetchBalance1()" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">Balance</label>
                                            <input type="number" class="form-control" id="balance1"  readonly>
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="form">
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label>Amount To Transfer<small>*</small></label>
                                            <input type="text" class="form-control" name="amount">
                                        </div>
                                    </div>
                                </div>                               
                                <button type="submit" class="btn btn-primary"  onclick="submitForm()">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            
            <script>
    function fetchBalance() {
        const username = document.getElementById('username').value;

        if (username) {
            fetch(`/user-balance/${username}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('balance').value = data.balance || 0;
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function submitForm() {
        // Form submission logic here
        alert('Form submitted!');
    }
</script>
<script>
    function fetchBalance1() {
        const username = document.getElementById('username1').value;

        if (username) {
            fetch(`/user-balance/${username}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('balance1').value = data.balance || 0;
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function submitForm() {
        // Form submission logic here
        alert('Form submitted!');
    }
</script>
@endsection