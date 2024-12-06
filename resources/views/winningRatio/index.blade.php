@extends('admin.app')
@section('app')

<div class="row ">
	  <div class="col-md-6">
  <div class="white_shd full margin_bottom_30">
     <div class="full graph_head">
        <div class="heading1 margin_0 d-flex">
           <h2>Blue 36 Game Winning Ratio</h2>  
			<div class="row" style=" padding-left:30px;" id="gmsno">    </div>    
        </div>
     </div>
     <div class="container">
        
		  
	 <form action="#" enctype="multipart/form-data" method="post">
		 @csrf
		 <div class="row">
		  
                    <div class="form-group"> 
                        <div class="col-md-3">
                            <label for="parsantage">Percentage %</label>
    					</div>
        				<div class="col-md-5">
                            <input type="number" step="any" class="form-control"  name="winning_percentage"  value="">
                         </div>
                    </div>
			   <div class="col-md-3">
		                                                    
                        <label for="parsantage"></label>
                         <button type="submit" name="submit" class="btn btn-primary btn-sm">submit</button>
                     
			    </div>
			 
			
		 </div>
		 </form> 
		 
		 
     </div>
  </div>
	  </div>
	  </div>

@endsection